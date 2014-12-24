<?php
include "wechat.class.php";
$options = array(
		'token'=>'xxxxxxxxxxbbbbbbccc12312313', //填写你设定的key
		'appid'=>'wx7eef422040790669', //填写高级调用功能的app id
		'appsecret'=>'00ef54e09ac370c5fb67d7e78ca15723 ', //填写高级调用功能的密钥
	);
$weObj = new Wechat($options);
$weObj->valid();

$type = $weObj->getRev()->getRevType();

switch($type) {
	case Wechat::MSGTYPE_TEXT:
			$weObj->text("hello, I'm wechat")->reply();
			break;
	case Wechat::MSGTYPE_EVENT:
			$AA = $weObj->getRevEvent();
			$weObj->text($AA['key'])->reply();
			break;
	case Wechat::MSGTYPE_IMAGE:
			break;
	default:
			$weObj->text("help info")->reply();
}


 
 