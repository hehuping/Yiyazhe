<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	//初始化，判断登录
	public function _initialize(){
		$ip = get_client_ip();
		$iplist = array('127.0.0.1','0.0.0.0','localhost');
		if(!in_array_case($ip, $iplist)){
			$this->error("非法来源");
		}
	}
    public function index(){
    	
    }
    
    //获取卷皮XML（淘宝API调用）
    private function getDate($url='http://api.juanpi.com/open/juanpi'){
    	//卷皮商品XML接口
    	$content = file_get_contents($url);
    	$xml  =  simplexml_load_string ( $content );
    	//解析到商品详情数组
    	$goodlist = $xml->goodslist->deal;
    	$shop='';
    	$goods_model = M('goods');
    	//遍历商品详情数组
    	foreach ($goodlist as $k=>$v){
    		$att = $v->attributes();
    		$pid = substr($v->deal_taobao_link, strpos($v->deal_taobao_link, "=")+1);
    		 
    		$arr=$this->getDetail($pid);
    		
    		echo $att."<br>";
    		//echo $v->deal_class.":".$v->deal_class_id."<br>";
    		if(strpos($v->deal_taobao_link, 'taobao'))$shop="淘宝";else $shop="天猫";
    		if(strpos($v->deal_detail, '中老年'))continue;
    		if(strpos($v->deal_detail, '妈妈'))continue;
    		$data = array(
    				'title'=>(string)$v->deal_title,
    				'class_id'=>(int)$v->deal_class_id,
    				'price'=>(string)$v->deal_price[0],
    				'oldprice'=>(float)$v->deal_cost_price,
    				'gurl'=>(string)$v->deal_taobao_link,
    				'gimage'=>(string)$v->deal_image,
    				'shop'=>$shop,
    				'fromwhere'=>(string)$v->deal_type,
    				'star_time'=>(string)$v->deal_start_time,
    				'end_time'=>(string)$v->deal_end_time,
    				'detail'=>(string)$v->deal_detail,
    				'delimg'=>$arr['image'],
    				'yishou'=>(int)$arr['yishou'][0],
    				'status'=>1,
    				'addtime'=>date("Y-m-d H:i:s")
    				 
    		);
    		
    		if($goods_model->add($data)){
    			echo $v->deal_title.'添加成功 <br>';
    		}else{
    			echo $v->deal_title.'添加失败 <br>';
    		}
    	}
    	
    }
    
    public function getJiukuayou(){
    	$this->getDate("http://api.juanpi.com/open/jiukuaiyou");
    }
    public function getJuanpi(){
    	$this->getDate("http://api.juanpi.com/open/jiukuaiyou");
    }
    
    //调用淘宝API获取已售
    private function  getDetail($id){
    	
    	define('M_ROOT', dirname(dirname(__FILE__)));
    	$ss =  M_ROOT;
    	$str =  str_replace("\\","/", $ss);
    
    	include_once ($str."/API/taobao/TopSdk.php");
    
    	$c = new \TopClient;
    	$c->appkey = '23151279';
    	$c->secretKey = 'ae2aff080e8f3fe602b0dd6e94d7f15f';
    	//淘宝客商品详情查询
    	$req = new \TbkItemInfoGetRequest;
    	$req->setFields("volume,num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url");
    	$req->setPlatform(1);
    	$req->setNumIids($id);
    	$resp = $c->execute($req);
    	 
    	//淘宝客商品详情(有销量)
    	$reqs = new \TbkItemsDetailGetRequest;
    	$reqs->setTrackIids($id);
    	$reqs->setFields("num_iid,seller_id,nick,title,price,volume,pic_url,item_url,shop_url,click_url");
    	$reqs->setNumIids($id);
    	$resps = $c->execute($reqs);
    	 
    	$tt = $resp->results->n_tbk_item;
    
    	foreach ($tt->small_images->string as $k=>$v){
    		$all.=$v.',';
    	}
    	$back['image'] = $all;
    
    	$yishou = $resps->tbk_items->tbk_item->volume;
    	 
    	$back['yishou']=$yishou;
    	return $back;
    	
    
    }
}