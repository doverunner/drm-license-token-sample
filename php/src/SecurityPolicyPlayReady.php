<?php

namespace PallyCon;


use PallyCon\Exception\PallyConTokenException;

class SecurityPolicyPlayReady
{
    public $_securityLevel;
    public $_digitalVideoProtectionLevel;
    public $_analogVideoProtectionLevel;
    public $_digitalAudioProtectionLevel;
    public $_requireHdcpType1;


    public function __construct($securityLevel=150
                                    , $digitalVideoProtectionLevel=null
                                    , $analogVideoProtectionLevel=null
                                    , $digitalAudioProtectionLevel=null
                                    , $requireHdcpType1= null)
    {
        if(is_numeric($securityLevel)){
            $this->_securityLevel = $securityLevel;
        }else{
            throw new PallyConTokenException(1027);
        }
        if(!empty($digitalVideoProtectionLevel)) {
            if (is_numeric($digitalVideoProtectionLevel)) {
                $this->_digitalVideoProtectionLevel = $digitalVideoProtectionLevel;
            } else {
                throw new PallyConTokenException(1028);
            }
        }
        if(!empty($analogVideoProtectionLevel)) {
            if (is_numeric($analogVideoProtectionLevel)) {
                $this->_analogVideoProtectionLevel = $analogVideoProtectionLevel;
            } else {
                throw new PallyConTokenException(1029);
            }
        }
        if(!empty($digitalAudioProtectionLevel)) {
            if (is_numeric($digitalAudioProtectionLevel)) {
                $this->_digitalAudioProtectionLevel = $digitalAudioProtectionLevel;
            } else {
                throw new PallyConTokenException(1030);
            }
        }
        if(!empty($requireHdcpType1)) {
            if (is_bool($requireHdcpType1)) {
                $this->_requireHdcpType1 = $requireHdcpType1;
            } else {
                throw new PallyConTokenException(1032);
            }
        }
    }

    public function toArray()
    {
        $arr = [];
        if (isset($this->_securityLevel)) {
            $arr["security_level"] = $this->_securityLevel;
        }
        if (isset($this->_digitalVideoProtectionLevel)) {
            $arr["digital_video_protection_level"] = $this->_digitalVideoProtectionLevel;
        }
        if (isset($this->_analogVideoProtectionLevel)) {
            $arr["analog_video_protection_level"] = $this->_analogVideoProtectionLevel;
        }
        if (isset($this->_digitalAudioProtectionLevel)) {
            $arr["digital_audio_protection_level"] = $this->_digitalAudioProtectionLevel;
        }
        if (isset($this->_requireHdcpType1)) {
            $arr["require_hdcp_type1"] = $this->_requireHdcpType1;
        }

        return $arr;
    }

    /**
     * @return int|string
     */
    public function getSecurityLevel()
    {
        return $this->_securityLevel;
    }

    /**
     * @param int|string $securityLevel
     */
    public function setSecurityLevel($securityLevel)
    {
        $this->_securityLevel = $securityLevel;
    }

    /**
     * @return int|string
     */
    public function getDigitalVideoProtectionLevel()
    {
        return $this->_digitalVideoProtectionLevel;
    }

    /**
     * @param int|string $digitalVideoProtectionLevel
     */
    public function setDigitalVideoProtectionLevel($digitalVideoProtectionLevel)
    {
        $this->_digitalVideoProtectionLevel = $digitalVideoProtectionLevel;
    }

    /**
     * @return int|string
     */
    public function getAnalogVideoProtectionLevel()
    {
        return $this->_analogVideoProtectionLevel;
    }

    /**
     * @param int|string $analogVideoProtectionLevel
     */
    public function setAnalogVideoProtectionLevel($analogVideoProtectionLevel)
    {
        $this->_analogVideoProtectionLevel = $analogVideoProtectionLevel;
    }

    /**
     * @return int|string
     */
    public function getDigitalAudioProtectionLevel()
    {
        return $this->_digitalAudioProtectionLevel;
    }

    /**
     * @param int|string $digitalAudioProtectionLevel
     */
    public function setDigitalAudioProtectionLevel($digitalAudioProtectionLevel)
    {
        $this->_digitalAudioProtectionLevel = $digitalAudioProtectionLevel;
    }



    /**
     * @return bool
     */
    public function isRequireHdcpType1()
    {
        return $this->_requireHdcpType1;
    }

    /**
     * @param bool $requireHdcpType1
     */
    public function setRequireHdcpType1($requireHdcpType1)
    {
        $this->_requireHdcpType1 = $requireHdcpType1;
    }
}
