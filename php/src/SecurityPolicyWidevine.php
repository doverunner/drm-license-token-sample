<?php

namespace PallyCon;


use PallyCon\Exception\PallyConTokenException;

class SecurityPolicyWidevine
{
    public $_securityLevel;
    public $_requiredHdcpVersion;
    public $_requiredCgmsFlags;
    public $_disableAnalogOutput;
    public $_hdcpSrmRule;
    public $_overrideDeviceRevocation;
    public $_enableLicenseCipher;

    public function __construct($securityLevel=1, $requiredHdcpVersion=null
        , $requiredCgmsFlags=null, $disableAnalogOutput=null, $hdcpSrmRule=null, $overrideDeviceRevocation=false, $enableLicenseCipher=false)
    {
        if(is_numeric($securityLevel)){
            $this->_securityLevel = $securityLevel;
        }else{
            throw new PallyConTokenException(1022);
        }
        if(!empty($requiredHdcpVersion)){
            $this->_requiredHdcpVersion = $requiredHdcpVersion;
        }
        if(!empty($requiredCgmsFlags)){
            $this->_requiredCgmsFlags = $requiredCgmsFlags;
        }
        if(!empty($disableAnalogOutput)){
            $this->_disableAnalogOutput = $disableAnalogOutput;
        }
        if(!empty($hdcpSrmRule)){
            $this->_hdcpSrmRule = $hdcpSrmRule;
        }
        if(!empty($overrideDeviceRevocation)){
            $this->_overrideDeviceRevocation = $overrideDeviceRevocation;
        }
        if(!empty($enableLicenseCipher)){
            $this->_enableLicenseCipher = $enableLicenseCipher;
        }
    }

    public function toArray()
    {
        $arr = [];
        if (isset($this->_securityLevel)) {
            $arr["security_level"] = $this->_securityLevel;
        }
        if (isset($this->_requiredHdcpVersion)) {
            $arr["required_hdcp_version"] = $this->_requiredHdcpVersion;
        }
        if (isset($this->_requiredCgmsFlags)) {
            $arr["required_cgms_flags"] = $this->_requiredCgmsFlags;
        }
        if (isset($this->_disableAnalogOutput)) {
            $arr["disable_analog_output"] = $this->_disableAnalogOutput;
        }
        if (isset($this->_hdcpSrmRule)) {
            $arr["hdcp_srm_rule"] = $this->_hdcpSrmRule;
        }
        if (isset($this->_overrideDeviceRevocation)) {
            $arr["override_device_revocation"] = $this->_overrideDeviceRevocation;
        }
        if (isset($this->_enableLicenseCipher)) {
            $arr["enable_license_cipher"] = $this->_enableLicenseCipher;
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
     * @return mixed
     */
    public function getRequiredHdcpVersion()
    {
        return $this->_requiredHdcpVersion;
    }

    /**
     * @param mixed $requiredHdcpVersion
     */
    public function setRequiredHdcpVersion($requiredHdcpVersion)
    {
        $this->_requiredHdcpVersion = $requiredHdcpVersion;
    }

    /**
     * @return mixed
     */
    public function getRequiredCgmsFlags()
    {
        return $this->_requiredCgmsFlags;
    }

    /**
     * @param mixed $requiredCgmsFlags
     */
    public function setRequiredCgmsFlags($requiredCgmsFlags)
    {
        $this->_requiredCgmsFlags = $requiredCgmsFlags;
    }

    /**
     * @return mixed
     */
    public function getDisableAnalogOutput()
    {
        return $this->_disableAnalogOutput;
    }

    /**
     * @param mixed $disableAnalogOutput
     */
    public function setDisableAnalogOutput($disableAnalogOutput)
    {
        $this->_disableAnalogOutput = $disableAnalogOutput;
    }

    /**
     * @return mixed
     */
    public function getHdcpSrmRule()
    {
        return $this->_hdcpSrmRule;
    }

    /**
     * @param mixed $hdcpSrmRule
     */
    public function setHdcpSrmRule($hdcpSrmRule)
    {
        $this->_hdcpSrmRule = $hdcpSrmRule;
    }

    /**
     * @return mixed
     */
    public function getOverrideDeviceRevocation()
    {
        return $this->_overrideDeviceRevocation;
    }

    /**
     * @param mixed $overrideDeviceRevocation
     */
    public function setOverrideDeviceRevocation($overrideDeviceRevocation)
    {
        $this->_overrideDeviceRevocation = $overrideDeviceRevocation;
    }

  }
