<?php
namespace PallyCon;
use PallyCon\ExternalKeyRequest;
use PallyCon\PlaybackPolicyRequest;
use PallyCon\PolicyRequest;
use PallyCon\SecurityPolicyRequest;
use PallyCon\Exception\PallyConTokenException;

class TokenBuilder
{
    private $_playbackPolicyRequest;
    private $_securityPolicyRequestArr;
    private $_externalKeyRequest;

    /**
     * @param mixed $playbackPolicyRequest
     * @return TokenBuilder
     */
    public function playbackPolicy(PlaybackPolicyRequest $playbackPolicyRequest){
        if(!empty($playbackPolicyRequest)){
            $this->_playbackPolicyRequest = $playbackPolicyRequest;
        }

        return $this;
    }

    /**
     * @param mixed $securityPolicyRequestArr
     * @return TokenBuilder
     */
    public function securityPolicy($securityPolicyRequestArr){
        if(!empty($securityPolicyRequestArr)) {
            $this->_securityPolicyRequestArr = $securityPolicyRequestArr;
        }
        return $this;
    }

    /**
     * @param mixed $externalKeyRequest
     * @return TokenBuilder
     */
    public function externalKey(ExternalKeyRequest $externalKeyRequest){
        if(!empty($externalKeyRequest)){
            $this->_externalKeyRequest = $externalKeyRequest;
        }

        return $this;
    }

    public function build()
    {
        $policyRequest = new PolicyRequest($this->_playbackPolicyRequest
            , $this->_securityPolicyRequestArr
            , $this->_externalKeyRequest);
        return $policyRequest;
    }

    /**
     * @return playbakcPolicyRequest
     */
    public function getPlaybackPolicyRequest()
    {
        return $this->_playbackPolicyRequest;
    }

    /**
     * @return securityPolicyRequest Array
     */
    public function getSecurityPolicyRequest()
    {
        return $this->_securityPolicyRequestArr;
    }


    /**
     * @return externalKeyRequest
     */
    public function getExternalKeyRequest()
    {
        return $this->_externalKeyRequest;
    }

}