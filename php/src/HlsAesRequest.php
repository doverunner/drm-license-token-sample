<?php
namespace PallyCon;

use PallyCon\Exception\PallyConTokenException;

class HlsAesRequest
{
    private $_trackType;
    private $_key;
    private $_iv;
    private $_keyId;

    /**
     * HlsAesRequest constructor.
     * @param string $trackType
     * @param $key
     * @param $iv
     * @param $keyId
     * @throws PallyConTokenException
     */
    public function __construct($trackType="ALL", $key, $iv, $keyId)
    {
        if(!$this->checkHex32($key)){
            throw new PallyConTokenException(1044);
        }
        if(!$this->checkHex32($iv)){
            throw new PallyConTokenException(1045);
        }
        if(!$this->checkHex32($keyId)){
            throw new PallyConTokenException(1046);
        }
        $this->_trackType = $trackType;
        $this->_key = $key;
        $this->_iv = $iv;
        $this->_keyId = $keyId;

    }

    private function checkHex32($key){
        return preg_match('/[[:xdigit:]]{32}/', $key);
    }

    public function toArray(){
        $arr= [];

        $arr["track_type"] = $this->_trackType;
        if(isset($this->_key)){
            $arr["key"] = $this->_key;
        }
        if(isset($this->_iv)){
            $arr["iv"] = $this->_iv;
        }
        if(isset($this->_keyId)){
            $arr["key_id"] = $this->_keyId;
        }
        return $arr;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->_key = $key;
    }

    /**
     * @return mixed
     */
    public function getIv()
    {
        return $this->_iv;
    }

    /**
     * @param mixed $iv
     */
    public function setIv($iv)
    {
        $this->_iv = $iv;
    }
}
