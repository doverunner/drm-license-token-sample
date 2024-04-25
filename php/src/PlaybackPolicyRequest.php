<?php

namespace PallyCon;


use PallyCon\Exception\PallyConTokenException;

class PlaybackPolicyRequest {
    public $_limit;
    public $_persistent;
    public $_licenseDuration;
    public $_expireDate;
    public $_rentalDuration;
    public $_playbackDuration;
    public $_allowedTrackTypes;
    public $_maxStreamPerUser;

    /**
     * PlaybackPolicyRequest constructor.
     * @param bool $persistent
     * @param int $licenseDuration
     * @param string $expireDate
     * @param $rentalDuration
     * @param $playbackDuration
     * @throws PallyConTokenException
     */
    public function __construct($persistent=false, $licenseDuration=0, $expireDate= "", $rentalDuration=0, $playbackDuration=0, $maxStreamPerUser=0)
    {
        if(!is_null($persistent)) {
            if(is_bool($persistent)){
                $this->_persistent = $persistent;
            }else{
                throw new PallyConTokenException(1009);
            }
        }
        if(!empty($licenseDuration)) {
            if(is_numeric($licenseDuration)){
                $this->_licenseDuration = $licenseDuration;
            }else{
                throw new PallyConTokenException(1010);
            }
        }
        if(!empty($expireDate)) {
            if(preg_match('/[0-9]{4}-[0,1][0-9]-[0-5][0-9]T[0-2][0-9]:[0-5][0-9]:[0-5][0-9]Z/', $expireDate)){
                $this->_expireDate = $expireDate;
            }else{
                throw new PallyConTokenException(1011);
            }
        }
        if(!empty($rentalDuration)) {
            if(is_numeric($rentalDuration)){
                $this->_rentalDuration = $rentalDuration;
            }else{
                throw new PallyConTokenException(1049);
            }
        }
        if(!empty($playbackDuration)) {
            if(is_numeric($playbackDuration)){
                $this->_playbackDuration = $playbackDuration;
            }else{
                throw new PallyConTokenException(1050);
            }
        }
        if(!empty($maxStreamPerUser)) {
            if(is_numeric($maxStreamPerUser)){
                $this->_maxStreamPerUser = $maxStreamPerUser;
            }else{
                throw new PallyConTokenException(1051);
            }
        }
    }

    public function toArray(){
        $arr= [];
        if(isset($this->_persistent)){
            $arr["persistent"] = $this->_persistent;
        }
        if(isset($this->_licenseDuration)){
            $arr["license_duration"] = $this->_licenseDuration;
        }
        if(isset($this->_expireDate)){
            $arr["expire_date"] = $this->_expireDate;
        }
        if(isset($this->_rentalDuration)){
            $arr["rental_duration"] = $this->_rentalDuration;
        }
        if(isset($this->_playbackDuration)){
            $arr["playback_duration"] = $this->_playbackDuration;
        }
        if(isset($this->_allowedTrackTypes)){
            $arr["allowed_track_types"] = $this->_allowedTrackTypes;
        }
        if(isset($this->_maxStreamPerUser)){
            $arr["max_stream_per_user"] = $this->_maxStreamPerUser;
        }
        return $arr;
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->_persistent;
    }

    /**
     * @param bool $persistent
     */
    public function setPersistent($persistent)
    {
        $this->_persistent = $persistent;
    }

    /**
     * @return int|string
     */
    public function getLicenseDuration()
    {
        return $this->_licenseDuration;
    }

    /**
     * @param int|string $licenseDuration
     */
    public function setLicenseDuration($licenseDuration)
    {
        $this->_licenseDuration = $licenseDuration;
    }

    /**
     * @return string
     */
    public function getExpireDate()
    {
        return $this->_expireDate;
    }

    /**
     * @param string $expireDate
     */
    public function setExpireDate($expireDate)
    {
        $this->_expireDate = $expireDate;
    }

    /**
     * @return mixed
     */
    public function getAllowedTrackTypes()
    {
        return $this->_allowedTrackTypes;
    }

    /**
     * @param mixed $allowedTrackTypes
     */
    public function setAllowedTrackTypes($allowedTrackTypes)
    {
        $this->_allowedTrackTypes = $allowedTrackTypes;
    }



}
?>