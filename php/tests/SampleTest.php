<?php
namespace Test;

use PallyCon\Exception\PallyConTokenException;
use PallyCon\ExternalKeyRequest;
use PallyCon\HlsAesRequest;
use PallyCon\MpegCencRequest;
use PallyCon\NcgRequest;
use PallyCon\OutputProtectRequest;
use PallyCon\PallyConDrmTokenClient;
use PallyCon\PlaybackPolicyRequest;
use PallyCon\SecurityPolicyFairplay;
use PallyCon\SecurityPolicyNcg;
use PallyCon\SecurityPolicyPlayReady;
use PallyCon\SecurityPolicyRequest;
use PallyCon\SecurityPolicyWidevine;
use PallyCon\TokenBuilder;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * simple streaming license test
     */
    public function testSimpleRuleSample(){
        $config = include "config/config.php";
        try {
            $pallyConTokenClient = new PallyConDrmTokenClient();

            /** --------------------------------------------------------
             * Sample Data
             */
            $playbackPolicyRequest = new PlaybackPolicyRequest(true, 1000);

            /**----------------------------------------------------------*/

            /* create token rule build */
            $policyRequest = (new TokenBuilder)
                ->playbackPolicy($playbackPolicyRequest)
                ->build();

            /* create token */
            $result = $pallyConTokenClient
                ->playReady()
                ->siteId($config["siteId"])
                ->accessKey($config["accessKey"])
                ->siteKey($config["siteKey"])
                ->userId("testUser")
                ->cid("testCID")
                ->policy($policyRequest)
                ->execute();

            $this->assertEquals(json_encode([
                "policy_version" => 2,
                "playback_policy" => [
                    "persistent" => true, "license_duration"=>1000]]), json_encode($pallyConTokenClient->getPolicy()->toArray()));

            echo "testSimpleRuleSample :".json_encode($pallyConTokenClient->getPolicy()->toArray()) . "\n";
        }catch (PallyConTokenException $e){
            $result = $e->toString();
        }
        echo $result . "\n";;

    }

    /**
     * simple offline streaming license test
     */
    public function testOfflineSimpleRuleSample(){
        $config = include "config/config.php";
        try {
            $pallyConTokenClient = new PallyConDrmTokenClient();

            /** --------------------------------------------------------
             * Sample Data
             */
            $playbackPolicyRequest = new PlaybackPolicyRequest(true, 0, "", 2000, 2000);

            /**----------------------------------------------------------*/

            /* create token rule build */
            $policyRequest = (new TokenBuilder)
                ->playbackPolicy($playbackPolicyRequest)
                ->build();

            /* create token */
            $result = $pallyConTokenClient
                ->playReady()
                ->siteId($config["siteId"])
                ->accessKey($config["accessKey"])
                ->siteKey($config["siteKey"])
                ->userId("testUser")
                ->cid("testCID")
                ->policy($policyRequest)
                ->execute();

            $this->assertEquals(json_encode([
                "policy_version" => 2,
                "playback_policy" => [
                    "persistent" => true, "rental_duration"=>2000, "playback_duration"=>2000]]), json_encode($pallyConTokenClient->getPolicy()->toArray()));

            echo "testOfflineSimpleRuleSample :".json_encode($pallyConTokenClient->getPolicy()->toArray()) . "\n";
        }catch (PallyConTokenException $e){
            $result = $e->toString();
        }
        echo $result . "\n";

    }

    /**
     *
     */
    public function testFullRuleSample(){
        $config = include "config/config.php";

        try {
            $pallyConTokenClient = new PallyConDrmTokenClient();

            /** --------------------------------------------------------
             * Sample Data
             */
            $playbackPolicyRequest = new PlaybackPolicyRequest( true, 0, "2020-01-15T00:00:00Z");

            $securityPolicyWidevine = new SecurityPolicyWidevine(1, 'HDCP_V1');
            $securityPolicyPlayReady = new SecurityPolicyPlayReady(3000, 200, 200);
            $securityPolicyFairplay = new SecurityPolicyFairplay(1,true,false);
            $securityPolicyNcg = new SecurityPolicyNcg(false, false, 1);

            $securityPolicyAll = new SecurityPolicyRequest("ALL", $securityPolicyWidevine
                                        , $securityPolicyPlayReady, $securityPolicyFairplay, $securityPolicyNcg);

            $hlsAesRequest = new HlsAesRequest("ALL", "123456781234FF781234567812345678", "123456781234FF781234567812345678", "123456781234FF781234567812345678");
            $mpegCencRequest = new MpegCencRequest("ALL", "113456781234FF781234567812345678", "113456781234FF781234567812345678");
            $ncgRequest = new NcgRequest("123456781234FF78123456781234567812345678123456781234567812345678");
            $externalKeyRequest = new ExternalKeyRequest(array($mpegCencRequest), array($hlsAesRequest), $ncgRequest);

            /*----------------------------------------------------------*/

            /* create token rule build*/
            $policyRequest = (new TokenBuilder)
                ->playbackPolicy($playbackPolicyRequest)
                ->securityPolicy(array($securityPolicyAll))
                ->externalKey($externalKeyRequest)
                ->build();

            /* create token */
            $result = $pallyConTokenClient
                ->playReady()
                ->siteId($config["siteId"])
                ->accessKey($config["accessKey"])
                ->siteKey($config["siteKey"])
                ->userId("testUser")
                ->cid("testCID")
                ->policy($policyRequest)
                ->responseFormat("custom")
                ->execute();

            $this->assertEquals(json_encode([
                "policy_version" => 2,
                "playback_policy" => [
                    "persistent" => true,
                    "expire_date" => "2020-01-15T00:00:00Z"
                ],
                "security_policy" => [[
                    "track_type" => "ALL",
                    "widevine" => [
                        "security_level" => 1,
                        "required_hdcp_version" => "HDCP_V1"
                    ],
                    "playready" =>[
                        "security_level"=>3000,
                        "digital_video_protection_level" => 200,
                        "analog_video_protection_level" => 200
                    ],
                    "fairplay" =>[
                        "hdcp_enforcement"=>1,
                        "allow_airplay"=>true,
                        "allow_av_adapter"=>false
                    ],
                    "ncg" =>[
                        "allow_mobile_abnormal_device"=>false,
                        "allow_external_display"=>false,
                        "control_hdcp"=>1
                    ]
                ]],
                "external_key" => [
                    "mpeg_cenc" => [[
                        "track_type" => "ALL",
                        "key_id" => "113456781234FF781234567812345678",
                        "key" => "113456781234FF781234567812345678"
                    ]],
                    "hls_aes" => [[
                        "track_type" => "ALL",
                        "key" => "123456781234FF781234567812345678",
                        "iv" => "123456781234FF781234567812345678",
                        "key_id" => "123456781234FF781234567812345678",
                    ]],
                    "ncg" => [
                        "cek" => "123456781234FF78123456781234567812345678123456781234567812345678"
                    ],
                ]

            ]), json_encode($pallyConTokenClient->getPolicy()->toArray()));

            $this->assertEquals("custom", $pallyConTokenClient->getResponseFormat());
            echo "testFullRuleSample :".json_encode($pallyConTokenClient->getPolicy()->toArray()) . "\n";
        }catch (PallyConTokenException $e){
            $result = $e->toString();
        }

        echo "testFullRuleSample : " . $result . "\n";
    }
}