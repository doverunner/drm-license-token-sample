<?php
namespace PallyCon;


interface PallyConDrmToken
{
    public function playready();
    public function widevine();
    public function fairplay();
    public function ncg();
    public function policy(PolicyRequest $token);
    public function siteId($siteId);
    public function userId($userId);
    public function cid($cid);
    public function accessKey($accessKey);
    public function siteKey($siteKey);
    public function getDrmType();
    public function getSiteId();
    public function getPolicy();
    public function execute();
    public function toJsonString();
}