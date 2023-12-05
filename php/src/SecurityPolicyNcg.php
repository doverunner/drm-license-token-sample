<?php

namespace PallyCon;


use PallyCon\Exception\PallyConTokenException;

class SecurityPolicyNcg
{
    public $_allowMobileAbnormalDevice;
    public $_allowExternalDisplay;
    public $_controlHdcp;

    public function __construct($allowMobileAbnormalDevice = null, $allowExternalDisplay = null, $controlHdcp = null)
    {
        if (!is_null($allowMobileAbnormalDevice)) {
            if (is_bool($allowMobileAbnormalDevice)) {
                $this->_allowMobileAbnormalDevice = $allowMobileAbnormalDevice;
            } else {
                throw new PallyConTokenException(1036);
            }
        }
        if (!is_null($allowMobileAbnormalDevice)) {
            if (is_bool($allowExternalDisplay)) {
                $this->_allowExternalDisplay = $allowExternalDisplay;
            } else {
                throw new PallyConTokenException(1037);
            }
        }
        if (!empty($controlHdcp)) {
            if (is_numeric($controlHdcp)) {
                $this->_controlHdcp = $controlHdcp;
            } else {
                throw new PallyConTokenException(1038);
            }
        }
    }

    public function toArray()
    {
        $arr = [];
        if (isset($this->_allowMobileAbnormalDevice)) {
            $arr["allow_mobile_abnormal_device"] = $this->_allowMobileAbnormalDevice;
        }
        if (isset($this->_allowExternalDisplay)) {
            $arr["allow_external_display"] = $this->_allowExternalDisplay;
        }
        if (isset($this->_controlHdcp)) {
            $arr["control_hdcp"] = $this->_controlHdcp;
        }

        return $arr;
    }

    /**
     * @return bool
     */
    public function isAllowMobileAbnormalDevice()
    {
        return $this->_allowMobileAbnormalDevice;
    }

    /**
     * @param bool $allowMobileAbnormalDevice
     */
    public function setAllowMobileAbnormalDevice($allowMobileAbnormalDevice)
    {
        $this->_allowMobileAbnormalDevice = $allowMobileAbnormalDevice;
    }

    /**
     * @return bool
     */
    public function isAllowExternalDisplay()
    {
        return $this->_allowExternalDisplay;
    }

    /**
     * @param bool $allowExternalDisplay
     */
    public function setAllowExternalDisplay($allowExternalDisplay)
    {
        $this->_allowExternalDisplay = $allowExternalDisplay;
    }

    /**
     * @return int|string
     */
    public function getControlHdcp()
    {
        return $this->_controlHdcp;
    }

    /**
     * @param int|string $controlHdcp
     */
    public function setControlHdcp($controlHdcp)
    {
        $this->_controlHdcp = $controlHdcp;
    }

}
