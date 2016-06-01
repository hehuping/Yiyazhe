<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/31
 * Time: 17:47
 */

namespace Home\Controller;
use Think\Controller;

class FaceController extends Controller
{
    public function chose(){

        layout(false);
        $this->display();
    }

    public function dopost(){
        $respons = array('s' => 0);
        import("Org.Net.Faceset");
        import("Org.Net.Facepp");
        $facepp = new \Facepp();
        $faceset = new \Faceset('hehe');
        $data = I("img");
        $arr = array(
                        'data:image/jpg;base64,',
                        'data:image/png;base64,',
                        'data:image/jpeg;base64,',
        );
        $rand = 'abcdefg';
        $file_name = time().str_shuffle($rand);
        $data = str_replace($arr,'',$data);
        $img = base64_decode($data);
        $handle = file_put_contents("./wpic/".$file_name.".jpg",$img);
        $size = filesize("./wpic/".$file_name.".jpg");

        if($size > 1024*1024*5){
            $respons['s'] = 2;
            $respons['error'] = "图片太大了，不能超过5M";
            echo json_encode($respons);
            die;
        }

        if($size > 1024*1024){
            $image = new \Think\Image();
            $image->open("./wpic/".$file_name.".jpg");
            $image->thumb(1200, 1200,\Think\Image::IMAGE_THUMB_FILLED)->save("./wpic/".$file_name.".jpg");
        }

        $imageins = M('image');

        if($handle){
            $params['img']          = $_SERVER['DOCUMENT_ROOT']."wpic/$file_name.jpg";
            $params['attribute']    = 'gender,age,race,smiling';
            $rep = $facepp->execute('/detection/detect',$params);

            if(empty($rep['body'])){
                $respons['s'] = 1;
                $respons['error'] = "图像无法识别";

                echo json_encode($respons);
                die;
            }

           $rs = json_decode($rep['body']);
            foreach($rs->face as $k=>$v){
                $data = array(
                    'face_id' => $v->face_id,
                    'img_id' => $rs->img_id,
                    //'url' => $rs->url,
                    'pic_name' => $file_name.".jpg",
                );
                //写入数据库
                $imageins->add($data);
                //加入集合
                $faceset->addFace($v->face_id);
                $respons['age'] = $v->attribute->age->value;
                $respons['race'] = $v->attribute->race->value;
                $respons['smiling'] = $v->attribute->smiling->value;
                $respons['gender'] = $v->attribute->gender->value;
            }
        }

       echo json_encode($respons);
       // $facepp->execute('',array());
        //echo json_encode($rep);
    }

}