<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/30
 * Time: 11:20
 * email: 595549109@qq.com
 */

include_once 'facepp_sdk.php';

class Group
{
    private $groupName = '';                        // 组名称
    private $groupList = array();                   // 组列表
    private $message = array('status' => false);    // 错误信息
    private $facepp;                                //实例化CURL
    private $is_exist;                              //组名是否存在

    //初始化组名
    public function __construct($groupName)
    {
        $this->facepp = new Facepp();
        $this->groupName = $groupName;
       $this->is_exist = $this->checkGroup();
    }

    //获取组列表
    public function getGroupList()
    {
        $groupList =  $this->facepp->execute('/info/get_group_list',array());
        return $this->groupList = json_decode($groupList['body']);

    }

    //验证组名是否存在
    protected function checkGroup(){
        $this->groupList = $this->getGroupList();
        if(!empty($this->groupList)){
                foreach($this->groupList->group as $k=>$v){
                    if($this->groupName == $v->group_name){
                        return true;
                    }
                }
            $this->message['content'] = "组名不存在";
            return false;
        }else{
            $this->message ['content'] = "暂时还没有分组";
            return false;
        }
    }

    //新建一个分组
    public function createGroup($tag, array $person){
        $person_name = isset($person['person_name']) ? $person['person_name'] : '';
        $person_id = isset($person['person_id']) ? $person['person_id'] : '';
        return $rep =  $this->facepp->execute('/group/create',array('group_name' => $this->groupName, 'tag' => $tag, 'person_name' => $person_name, 'persion_id' => $person_id));
    }

    //删除当前分组
    public function deleteGroup(){
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/group/delete',array('group_name' => $this->groupName));
        }else{
            return $this->getMessage();
        }
    }

    /*
     * 将一组Person加入到一个Group中。
     * $person 一组用逗号分隔的person_id或person_name，表示将这些Person加入到相应Group中。
     * */
    public function addPerson($person){
        $person_name = isset($person['person_name']) ? $person['person_name'] : '';
        $person_id = isset($person['person_id']) ? $person['person_id'] : '';
        if($this->is_exist){
            return $rep =  $this->facepp->execute('/group/add_person',array('group_name' => $this->groupName, 'person_name' => $person_name, 'person_id' => $person_id));
        }else{
            return $this->getMessage();
        }
    }

    /*
     *  从Group中删除一组Person
     * 一组用逗号分割的person_id列表或者person_name列表，表示将这些person从该Group中删除。
     * 开发者也可以指定person_id=all, 表示删掉该Group中所有Person。
     * */
    public function removePerson($person){
        $person_name = isset($person['person_name']) ? $person['person_name'] : '';
        $person_id = isset($person['person_id']) ? $person['person_id'] : '';
        return $rep =  $this->facepp->execute('/group/remove_person',array('group_name' => $this->groupName, 'person_name' => $person_name, 'persion_id' => $person_id));
    }

    /*
     *  设置Group的name和tag
     * */
    public function setInfo($newName, $newTag){
        if($this->is_exist){
            $rep =  $this->facepp->execute('/group/set_info',array('group_name' => $this->groupName, 'name' => $newName, 'tag' => $newTag));
            return json_decode($rep['body']);
        }else{
            return $this->getMessage();
        }
    }

    /*
     * /group/get_info
     *  获取Group的信息，包括Group中的Person列表，Group的tag等信息
     * */
    public function getInfo(){
        if($this->is_exist){
            $rep =  $this->facepp->execute('/group/get_info',array('group_name' => $this->groupName));
            return json_decode($rep['body']);
        }else{
            return $this->getMessage();
        }
    }


    //获取错误信息
    public function getMessage(){
        return $this->message;
    }
}