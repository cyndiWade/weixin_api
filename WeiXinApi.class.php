<?php 

class WeiXinApi {
	
	public $debug = false;
	
	
	//信息交互
	public function run()
	{
		/*get post data, May be due to the different environments
		* 接收微信推送过来的信息
		* @ ToUserName		消息接收方微信号，一般为公众平台账号微信号
		* @ FromUserName 	消息发送方微信号
		* @ CreateTime 			消息创建时间
		* @ MsgType 				文本消息为text
		* @ Content 				发送者的消息内容
		*/
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	
		
	}
	
	
	
	/*
	*===========================================================
	* 文本的xml
	*文本消息的处理xml transmitText($object, $content, $flag = 0)
	*图文消息处理xml   transmitNews($object, $arr_item, $flag = 0)
	*音乐处理xml      transmitMusic($object, $musicArray, $flag = 0)
	*===========================================================
	*/
	//文本消息的处理xml
	private function transmitText($object, $content, $flag = 0)
	{
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		<FuncFlag>%s</FuncFlag>
		</xml>";
		$resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
		return $resultStr;
	}
	
	//图文消息处理xml
	private function transmitNews($object, $arr_item, $flag = 0){
		if(!is_array($arr_item))
			return;
	
		$itemTpl = "<item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>";
		$item_str = "";
		foreach ($arr_item as $item)
			$item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['Picurl'], $item['Url'].'/user_code/'.$object->FromUserName);
	
		$newsTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[news]]></MsgType>
		<ArticleCount>%s</ArticleCount>
		<Articles>
		$item_str</Articles>
		<FuncFlag>%s</FuncFlag>
		</xml>";
	
		$resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $flag);
		return $resultStr;
	}
	
	
	/**
	 * 身份验证
	 * @param String $token  (必须跟微信号里面填入的一样)
	 */
	private function auth($token){
		 
		if(empty($_GET['signature'])) return;
		 
		/* 获取数据 */
		$data = array($_GET['timestamp'], $_GET['nonce'], $token);
		$sign = $_GET['signature'];
		 
		/* 对数据进行字典排序 */
		sort($data,SORT_STRING);
	
		/* 生成签名 */
		$signature = sha1(implode($data));
	
		return $signature === $sign;
	}
		
	
	//记录日志文件
	private function _Void_log($data) {
		if ($this->debug == true) {
			file_put_contents(date('y-m-d.txt'),$data."\n",FILE_APPEND);
		}
	}
}

?>