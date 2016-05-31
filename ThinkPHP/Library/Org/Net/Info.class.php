<?php

/**
 * Created by PhpStorm.
 * User: hehuping
 * Date: 2016/5/31
 * Time: 17:15
 * email: 595549109@qq.com
 */
include_once 'facepp_sdk.php';
class Info
{
    private $facepp;

    public function __construct()
    {
        $this->facepp = new Facepp();
    }

    public function getFace($face_id){
        return $rep =  $this->facepp->execute('/info/get_face',array('face_id' => $face_id));
    }

    public function getImage($img_id){
        return $rep =  $this->facepp->execute('/info/get_image',array('img_id' => $img_id));
    }
}