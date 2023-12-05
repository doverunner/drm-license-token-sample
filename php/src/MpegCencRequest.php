<?php
namespace PallyCon;

use PallyCon\Exception\PallyConTokenException;

class MpegCencRequest
{
    private $_trackType;
    public $_keyId;
    public $_key;
    public $_iv = null;

    function __construct($trackType="ALL", $keyId, $key, $iv=null)
    {
        $this->_trackType = $trackType;
        if(!$this->checkHex32($keyId)){
            throw new PallyConTokenException(1040);
        }
        if(!$this->checkHex32($key)){
            throw new PallyConTokenException(1041);
        }

        $this->_keyId = $keyId;
        $this->_key = $key;

        if( !empty($iv) ){
            if($this->checkHex32($keyId)){
                $this->_iv = $iv;
            }else{
                throw new PallyConTokenException(1042);
            }
        }
    }

    private function checkHex32($key){
        return preg_match('/[[:xdigit:]]{32}/', $key);
    }

    public function toArray(){
        $arr= [];

        $arr["track_type"] = $this->_trackType;
        if(isset($this->_keyId)){
            $arr["key_id"] = $this->_keyId;
        }
        if(isset($this->_key)){
            $arr["key"] = $this->_key;
        }
        if(isset($this->_iv)){
            $arr["iv"] = $this->_iv;
        }
        return $arr;
    }

    /**
     * @return mixed
     */
    public function getKeyId()
    {
        return $this->_keyId;
    }

    /**
     * @param mixed $keyId
     */
    public function setKeyId($keyId)
    {
        $this->_keyId = $keyId;
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