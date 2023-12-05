<?php

namespace Test;

error_reporting(E_ALL);
ini_set('display_errors', "1");


use PallyCon\SecurityPolicyWidevine;
use PHPUnit\Framework\TestCase;

use PallyCon\Exception\PallyConTokenException;
use PallyCon\PallyConDrmTokenClient;
use PallyCon\PolicyRequest;
use PallyCon\PlaybackPolicyRequest;
use PallyCon\SecurityPolicyRequest;
use PallyCon\OutputProtectRequest;
use PallyCon\ExternalKeyRequest;
use PallyCon\HlsAesRequest;
use PallyCon\MpegCencRequest;
use PallyCon\NcgRequest;
use PallyCon\TokenBuilder;


class PallyConDrmTokenClientTest extends TestCase
{
    private $_config;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->_config = include "config/config.php";
    }

    public function testDrmType(){
        $pallyconTokenDrmClient = new PallyConDrmTokenClient();

        $pallyconTokenDrmClient->playready();
        $this->assertEquals("PlayReady", $pallyconTokenDrmClient->getDrmType());
        $pallyconTokenDrmClient->widevine();
        $this->assertEquals("Widevine", $pallyconTokenDrmClient->getDrmType());
        $pallyconTokenDrmClient->fairplay();
        $this->assertEquals("FairPlay", $pallyconTokenDrmClient->getDrmType());
    }

    public function testRequireValue(){
        $pallyconTokenDrmClient = new PallyConDrmTokenClient();
        try{
            $pallyconTokenDrmClient->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode() . "\n";
            $this->assertEquals(1000, $e->getCode());
        }

        try{
            $pallyconTokenDrmClient->userId("testUser")->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode(). "\n";
            $this->assertEquals(1001, $e->getCode());
        }

        try{
            $pallyconTokenDrmClient->cid("test-cid")->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode(). "\n";
            $this->assertEquals(1002, $e->getCode());
        }

        try{
            $pallyconTokenDrmClient->siteId($this->_config["siteId"])->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode(). "\n";
            $this->assertEquals(1003, $e->getCode());
        }
        try{
            $pallyconTokenDrmClient->siteId($this->_config["accessKey"])->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode(). "\n";
            $this->assertEquals(1003, $e->getCode());
        }
        try{
            $pallyconTokenDrmClient->siteId($this->_config["siteKey"])->execute();
        }catch (PallyConTokenException $e){
            echo $e->getCode(). "\n";
            $this->assertEquals(1003, $e->getCode());
        }
    }
    public function testFullRule()
    {
        $pallyconTokenDrmClient = new PallyConDrmTokenClient();

        $playbackPolicyRequest = new PlaybackPolicyRequest(true, 0, "2020-01-15T00:00:00Z");

        $securityPolicyWidevine = new SecurityPolicyWidevine(5);

        $securityPolicyReqeust = new SecurityPolicyRequest("ALL", $securityPolicyWidevine);

        $hlsAesRequest = new HlsAesRequest("ALL", "12345678123456781234567812345678", "12345678123456781234567812345678", "12345678123456781234567812345678");
        $mpegCencRequest = new MpegCencRequest("ALL", "11345678123456781234567812345678", "11345678123456781234567812345678");
        $ncgRequest = new NcgRequest("1234567812345678123456781234567812345678123456781234567812345678");

        $externalKeyRequest = new ExternalKeyRequest(array($mpegCencRequest), array($hlsAesRequest), $ncgRequest);


        /* create token rule */
        $policyRequest = (new TokenBuilder)
            ->playbackPolicy($playbackPolicyRequest)
            ->securityPolicy(array($securityPolicyReqeust))
            ->externalKey($externalKeyRequest)
            ->build();

        $pallyconTokenDrmClient->playready()
            ->siteId($this->_config["siteId"]);

        echo("testFullRule : ".$policyRequest->toJsonString());

        $this->assertEquals(json_encode([
            "policy_version" => 2,
            "playback_policy" => [
                "persistent" => true,
                "expire_date" => "2020-01-15T00:00:00Z"
            ],
            "security_policy" => [[
                "track_type" => "ALL",
                "widevine" => [
                    "security_level" => 5
                ]
            ]],
            "external_key" => [
                "mpeg_cenc" => [[
                    "track_type" => "ALL",
                    "key_id" => "11345678123456781234567812345678",
                    "key" => "11345678123456781234567812345678"
                ]],
                "hls_aes" => [[
                    "track_type" => "ALL",
                    "key" => "12345678123456781234567812345678",
                    "iv" => "12345678123456781234567812345678",
                    "key_id" => "12345678123456781234567812345678",
                ]],
                "ncg" => [
                    "cek" => "1234567812345678123456781234567812345678123456781234567812345678"
                ],
            ]

        ]), json_encode($policyRequest->toArray()));
    }
}
