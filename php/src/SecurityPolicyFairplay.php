<?php

namespace PallyCon;


use PallyCon\Exception\PallyConTokenException;

class SecurityPolicyFairplay
{
    public $_hdcpEnforcement;
    public $_allowAirplay;
    public $_allowAvAdapter;

    public function __construct($hdcpEnforcement=null, $allowAirplay=null, $allowAvAdapter=null)
    {
        if(!is_null($hdcpEnforcement)){
            if(is_numeric($hdcpEnforcement)){
                $this->_hdcpEnforcement = $hdcpEnforcement;
            }else{
                throw new PallyConTokenException(1033);
            }
        }
        if(!is_null($allowAirplay)) {
            if (is_bool($allowAirplay)) {
                $this->_allowAirplay = $allowAirplay;
            } else {
                throw new PallyConTokenException(1034);
            }
        }
        if(!is_null($allowAvAdapter)) {
            if (is_bool($allowAvAdapter)) {
                $this->_allowAvAdapter = $allowAvAdapter;
            } else {
                throw new PallyConTokenException(1035);
            }
        }
    }

    public function toArray()
    {
        $arr = [];
        if (isset($this->_hdcpEnforcement)) {
            $arr["hdcp_enforcement"] = $this->_hdcpEnforcement;
        }
        if (isset($this->_allowAirplay)) {
            $arr["allow_airplay"] = $this->_allowAirplay;
        }
        if (isset($this->_allowAvAdapter)) {
            $arr["allow_av_adapter"] = $this->_allowAvAdapter;
        }

        return $arr;
    }

    /**
     * @return int|string
     */
    public function getHdcpEnforcement()
    {
        return $this->_hdcpEnforcement;
    }

    /**
     * @param int|string $hdcpEnforcement
     */
    public function setHdcpEnforcement($hdcpEnforcement)
    {
        $this->_hdcpEnforcement = $hdcpEnforcement;
    }

    /**
     * @return bool
     */
    public function isAllowAirplay()
    {
        return $this->_allowAirplay;
    }

    /**
     * @param bool $allowAirplay
     */
    public function setAllowAirplay($allowAirplay)
    {
        $this->_allowAirplay = $allowAirplay;
    }

    /**
     * @return bool
     */
    public function isAllowAvAdapter()
    {
        return $this->_allowAvAdapter;
    }

    /**
     * @param bool $allowAvAdapter
     */
    public function setAllowAvAdapter($allowAvAdapter)
    {
        $this->_allowAvAdapter = $allowAvAdapter;
    }

  }
