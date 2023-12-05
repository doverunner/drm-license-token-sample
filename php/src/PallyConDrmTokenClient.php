<?php
namespace PallyCon;

require "PallyConDrmToken.php";

use PallyCon\PolicyRequest;
use PallyCon\Exception\PallyConTokenException;

define("IV","0123456789abcdef");

class PallyConDrmTokenClient implements PallyConDrmToken {

    private $_drmType = "PlayReady";
    private $_policy;
    private $_encPolicy;
    private $_siteId;
    private $_userId;
    private $_cid;
    private $_timestamp;
    private $_hash;
    private $_siteKey;
    private $_accessKey;
    private $_responseFormat = "original";
    private $_keyRotation = false;

    public function __construct()
    {
        $this->_timestamp = gmdate("Y-m-d\TH:i:s\Z");
    }

    public function playready(){
        $this->_drmType = "PlayReady";
        return $this;
    }
    public function widevine(){
        $this->_drmType = "Widevine";
        return $this;
    }
    public function fairplay(){
        $this->_drmType = "FairPlay";
        return $this;
    }
    public function ncg(){
        $this->_drmType = "NCG";
        return $this;
    }
    public function policy(PolicyRequest $policyRequest){
        $this->_policy = $policyRequest;
        return $this;
    }

    public function siteId($siteId){
        $this->_siteId = $siteId;
        return $this;
    }
    public function userId($userId){
        $this->_userId = $userId;
        return $this;
    }
    public function cid($cid){
        $this->_cid = $cid;
        return $this;
    }

    public function accessKey($accessKey){
        $this->_accessKey = $accessKey;
        return $this;
    }
    public function siteKey($siteKey){
        $this->_siteKey = $siteKey;
        return $this;
    }

    public function responseFormat($responseFormat)
    {
        $this->_responseFormat = $responseFormat;
        return $this;
    }

    public function keyRotation($keyRotation){
        $this->_keyRotation = $keyRotation;
        return $this;
    }

    public function getDrmType(){
        return $this->_drmType;
}
    public function getSiteId(){
        return $this->_siteId;
    }
    public function getPolicy(){
        return $this->_policy;
    }
    public function getCid(){
        return $this->_cid;
    }

    public function getSiteKey()
    {
        return $this->_siteKey;
    }

    public function getAccessKey()
    {
        return $this->_accessKey;
    }

    public function getResponseFormat()
    {
        return $this->_responseFormat;
    }

    public function getKeyRotation()
    {
        return $this->_keyRotation;
    }


    public function execute(){
        try{
            $this->checkValidation();
            $this->_encPolicy = $this->createPolicy();
            $this->_hash = $this->createHash();
            $result = base64_encode(json_encode(["drm_type"=> $this->_drmType
                , "site_id"=> $this->_siteId
                , "user_id"=> $this->_userId
                , "cid"=> $this->_cid
                , "policy"=> $this->_encPolicy
                , "timestamp"=> $this->_timestamp
                , "response_format"=> $this->_responseFormat
                , "hash"=> $this->_hash
                , "key_rotation"=> $this->_keyRotation
            ]));
            return $result;
        } catch (PallyConTokenException $e){
            throw $e;
        }
    }

    public function toJsonString(){
        return json_encode(["drm_type"=> $this->_drmType
            , "site_id"=> $this->_siteId?$this->_siteId:null
            , "user_id"=> $this->_userId?$this->_userId:null
            , "cid"=> $this->_cid?$this->_cid:null
            , "policy"=> $this->_encPolicy?$this->_encPolicy:null
            , "timestamp"=> $this->_timestamp
            , "response_format"=> $this->_responseFormat
            , "hash"=> $this->_hash?$this->_hash:null
            , "key_rotation"=> $this->_keyRotation
        ]);
    }

    private function createPolicy(){
        $policyRequest = $this->getPolicy();

        return openssl_encrypt(json_encode($policyRequest->toArray()), "AES-256-CBC", $this->_siteKey, false, IV);
    }

    private function createHash(){
        $body = $this->_accessKey
            . $this->_drmType
            . $this->_siteId
            . $this->_userId
            . $this->_cid
            . $this->_encPolicy
            . $this->_timestamp;
        return base64_encode(hash("sha256", $body, true));
    }

    /**
     * @throws PallyConTokenException
     */
    private function checkValidation()
    {
        if(empty($this->_userId)){
            throw new PallyConTokenException(1000);
        }
        if(empty($this->_cid)){
            throw new PallyConTokenException(1001);
        }
        if(empty($this->_siteId)){
            throw new PallyConTokenException(1002);
        }
        if(empty($this->_accessKey)){
            throw new PallyConTokenException(1003);
        }
        if(empty($this->_siteKey)){
            throw new PallyConTokenException(1004);
        }
        if(empty($this->_policy)){
            throw new PallyConTokenException(1005);
        }
    }




}
//class student {
//    public function __construct($firstname, $lastname) {
//        $this->firstname = $firstname;
//        $this->lastname = $lastname;
//    }
//}
//$myObj = new student("Alex", "Stokes");
//echo "Before conversion:".'</br>';
//var_dump($myObj);
//$myArray = json_decode(json_encode($myObj), true);
//echo "After conversion:".'</br>';
//var_dump($myArray);
?>