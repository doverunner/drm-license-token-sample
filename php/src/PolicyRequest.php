<?php

namespace PallyCon;


class PolicyRequest
{
    public $_policyVersion;
    public $_playbackPolicy;
    public $_securityPolicyArr;
    public $_externalKey;

    public function __construct(PlaybackPolicyRequest $playbackPolicyRequest=null
                                    , $securityPolicyArr=null
                                    , ExternalKeyRequest $externalKeyRequest=null)
    {
        if(!empty($playbackPolicyRequest)) {
            $this->_playbackPolicy =$playbackPolicyRequest ;
        }
        if(!empty($securityPolicyArr)) {
            $this->_securityPolicyArr = $securityPolicyArr;
        }
        if(!empty($externalKeyRequest)) {
            $this->_externalKey = $externalKeyRequest;
        }
        $this->_policyVersion = 2;
    }

    public function toArray(){
        $arr= [];
        $securityPolicyArr = [];
        $arr["policy_version"] = $this->_policyVersion;
        if(isset($this->_playbackPolicy)){
            $arr["playback_policy"] = $this->_playbackPolicy->toArray();
        }
        if(isset($this->_securityPolicyArr)){
            foreach ($this->_securityPolicyArr as $securityPolicy) {
                array_push($securityPolicyArr, $securityPolicy->toArray());
            }
            $arr["security_policy"] = $securityPolicyArr;
        }
        if(isset($this->_externalKey)){
            $arr["external_key"] = $this->_externalKey->toArray();
        }

        return $arr;
    }

    public function toJsonString(){
        return json_encode($this->toArray());
    }

    /**
     * @return int
     */
    public function getPolicyVersion()
    {
        return $this->_policyVersion;
    }

    /**
     * @param int $policyVersion
     */
    public function setPolicyVersion($policyVersion)
    {
        $this->_policyVersion = $policyVersion;
    }

    /**
     * @return PlaybackPolicyRequest
     */
    public function getPlaybackPolicy()
    {
        return $this->_playbackPolicy;
    }

    /**
     * @param $playbackPolicyRequest
     */
    public function setPlaybackPolicy(PlaybackPolicyRequest $playbackPolicyRequest)
    {
        $this->_playbackPolicy = get_object_vars($playbackPolicyRequest);
    }

    /**
     * @return SecurityPolicyRequest
     */
    public function getSecurityPolicy()
    {
        return $this->_securityPolicyArr;
    }

    /**
     * @param $securityPolicyRequestArr
     */
    public function setSecurityPolicy($securityPolicyRequestArr)
    {
        $this->_securityPolicyArr = $securityPolicyRequestArr;
    }

    public function pushSecurityPolicy(SecurityPolicyRequest $securityPolicyRequest)
    {
        array_push($this->_securityPolicyArr,  $securityPolicyRequest);
    }

    /**
     * @return ExternalKeyRequest
     */
    public function getExternalKey()
    {
        return $this->_externalKey;
    }

    /**
     * @param $externalKeyRequest
     */
    public function setExternalKey(ExternalKeyRequest $externalKeyRequest)
    {
        $this->_externalKey = get_object_vars($externalKeyRequest);
    }





}