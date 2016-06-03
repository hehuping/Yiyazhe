<?php

/**
 * Created by PhpStorm.
 * User: hehuping
 * Date: 2016/5/31
 * Time: 10:13
 * email: 595549109@qq.com
 */
include_once'facepp_sdk.php';

class Faceset
{
    private $facesetName;
    private $facepp;
    private $message = array('status' => 0);
    private $facesetList;
    private $is_exist;

    public function __construct($facesetName)
    {
        $this->facepp = new Facepp();
        $this->facesetName = $facesetName;
        $this->is_exist = $this->checkFacesetExist();
    }

    /*
     * 返回该App中的所有Faceset
     *
     * */
    public function getFacesetList(){
        $facesetList =  $this->facepp->execute('/info/get_faceset_list',array());
        return $this->facesetList = json_decode($facesetList['body']);
    }

    /*
     * 判断个集合是否存在
     * */
    public function checkFacesetExist(){
        $this->facesetList = $this->getFacesetList();
        foreach($this->facesetList->faceset as $value){
            if($value->faceset_name == $this->facesetName){
                return true;
            }
        }
        $this->message['content'] = "集合名不存在";
        return false;
    }

    /*
     *   创建一个Faceset
     * faceset_ 必须在App中全局唯一。
 	 * face_id  一组用逗号分隔的face_id
     * tag      Faceset相关的tag，
     * */
    public function createFaceset($face_id='', $tag=''){
        $parame = array(
            'faceset_name' => $this->facesetName,
            'tag' => $tag,
        );
        empty($face_id) ? '' : $parame['face_id'] = $face_id;
        return $rep =  $this->facepp->execute('/faceset/create',$parame);

    }

    /*
     * 删除一组Faceset
     * 当不传入facesetName时，则默认删除当前集合
     * */
    public function deleteFaceset($facesetName=''){
        empty($facesetName) ? $facesetName = $this->facesetName : $facesetName;
        return $rep =  $this->facepp->execute('/faceset/delete',array('faceset_name' => $facesetName));
    }

    /*
     *将一组Face加入到一个Faceset中
     * */
    public function addFace($face_id){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/faceset/add_face',array('faceset_name' => $this->facesetName, 'face_id' => $face_id));
        }else{
            return $this->getMessage();
        }
    }

    /*
     * 删除Faceset中的一个或多个Face
     * */
    public function removeFace($face_id){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/faceset/remove_face',array('faceset_name' => $this->facesetName, 'face_id' => $face_id));
        }else{
            return $this->getMessage();
        }
    }

    /*
     * 设置faceset的name和tag
     * */
    public function setInfo($newName, $newTag){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/faceset/set_info',array('faceset_name' => $this->facesetName, 'name' => $newName, 'tag' => $newTag));
        }else{
            return $this->getMessage();
        }
    }

    /*
     * 获取一个faceset的信息, 包括name, id, tag, 以及相关的face等信息
     * */
    public function getInfo(){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/faceset/get_info',array('faceset_name' => $this->facesetName));
        }else{
            return $this->getMessage();
        }
    }

    /*
     * /train/search
     * 针对search功能对一个faceset进行训练。
     * */
    public function trainSearch(){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/train/search',array('faceset_name' => $this->facesetName));
        }else{
            return $this->getMessage();
        }
    }

    /**
     * 寻找faceset里面最相似的脸
     * */
    public function search($key_face_id, $count=3){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/recognition/search',array('key_face_id' => $key_face_id, 'faceset_name' => $this->facesetName, 'count' => $count));
        }else{
            return $this->getMessage();
        }
    }

    public function getSession($session_id){
        return $rep =  $this->facepp->execute('/info/get_session',array('session_id' => $session_id));

    }


    /*
     * 获取ERROR
     * */
    public function getMessage(){
        return $this->message;
    }

}