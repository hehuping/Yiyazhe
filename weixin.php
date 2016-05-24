<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
			/**/
                $MsgType = $postObj->MsgType;
				$PicUrl = $postObj->PicUrl;
				$MediaId = $postObj->MediaId;
				$MsgId = $postObj->MsgId;
			/**/
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				if(!empty( $keyword ))
                {
              		/*$msgType = "text";
                	$contentStr = "Welcome to wechat world!$fromUsername,$toUsername";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;*/


					$Url = 'http://s2.juancdn.com/bao/160523/7/4/57429a03151ad16a468b45c7_400x400.jpg';
					$rep = "<xml>
							 <ToUserName><![CDATA[$fromUsername]]></ToUserName>
							 <FromUserName><![CDATA[$toUsername]]></FromUserName>
							 <CreateTime>$time</CreateTime>
							 <MsgType><![CDATA[image]]></MsgType>
							 <PicUrl><![CDATA[$Url]]></PicUrl>
							 <MediaId><![CDATA[$MediaId]]></MediaId>
							 </xml>";
					echo $rep;

                }elseif($MsgType == "image"){
					$Url = 'http://s2.juancdn.com/bao/160523/7/4/57429a03151ad16a468b45c7_400x400.jpg';
					$rep = "<xml>
							 <ToUserName><![CDATA[$fromUsername]]></ToUserName>
							 <FromUserName><![CDATA[$toUsername]]></FromUserName>
							 <CreateTime>$time</CreateTime>
							 <MsgType><![CDATA[image]]></MsgType>
							 <PicUrl><![CDATA[$Url]]></PicUrl>
							 <MediaId><![CDATA[$MediaId]]></MediaId>
							 <MsgId>$MsgId</MsgId>
							 </xml>";

					/*$textTpl = "<xml>
							<ToUserName><![CDATA[$fromUsername]]></ToUserName>
							<FromUserName><![CDATA[$toUsername]]></FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[$MediaId]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";*/
					//$msgType = 'text';
                	//$contentStr = 'images'.$PicUrl;
                	echo $rep;
                }

        }else {
        	echo "";
        	exit;
        }
    }
	
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>