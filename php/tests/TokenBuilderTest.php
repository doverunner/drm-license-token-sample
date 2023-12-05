<?php
namespace Test;

use PallyCon\Exception\PallyConTokenException;
use PallyCon\PlaybackPolicyRequest;
use PallyCon\TokenBuilder;
use PHPUnit\Framework\TestCase;

class TokenBuilderTest extends TestCase{
    public function testBuild(){
        $tokenBuilder = new TokenBuilder();

        //expireDate Setting
        $playbackPolicyRequest = new PlaybackPolicyRequest(true, 0, "2020-01-15T00:00:00Z");

        $policyRequest = $tokenBuilder->playbackPolicy($playbackPolicyRequest)->build();

        $this->assertEquals("{\"policy_version\":2,\"playback_policy\":{\"persistent\":true,\"expire_date\":\"2020-01-15T00:00:00Z\"}}",  $policyRequest->toJsonString());

        //duration Setting
        $playbackPolicyRequest = new PlaybackPolicyRequest(true, 160);

        $policyRequest = $tokenBuilder->playbackPolicy($playbackPolicyRequest)->build();

        $this->assertEquals("{\"policy_version\":2,\"playback_policy\":{\"persistent\":true,\"license_duration\":160}}",  $policyRequest->toJsonString());
    }
}