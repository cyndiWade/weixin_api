<?php

#相应类
include "../config.php";
include "../wechat.class.php";

$weObj = new Wechat($options);

$weObj->valid();

$type = $weObj->getRev()->getRevType();

switch($type) {
	case Wechat::MSGTYPE_TEXT:
		$data = array(
			0=>array(
				'Title'=>'您好！欢迎关注我们，更多功能请联系管理员开通',
				'Description'=>'您好！欢迎关注我们，更多功能请联系管理员开通',
				'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
				#'Url'=>'http://www.domain.com/1.html'
			),
			1=>array(
				'Title'=>'您好！欢迎关注我们，更多功能请联系管理员开通',
				'Description'=>'您好！欢迎关注我们，更多功能请联系管理员开通',
				'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
				#'Url'=>'http://www.domain.com/1.html'
			),
		);
		$weObj->news($data)->reply();
		
			//$weObj->text("您好，欢饮关注我们，更多功能请联系管理员")->reply();
			break;
	case Wechat::MSGTYPE_EVENT:
		
			$RevEvent = $weObj->getRevEvent();
			
			switch($RevEvent['key']) {
				case 'rselfmenu_1_0':
					$Str_msg = '您好，我是公司简介，详细请联系管理员编辑';
					break;
				case 'rselfmenu_1_1':
					$Str_msg = '您好，我是公司新闻，详细请联系管理员编辑';
					break;
				case 'rselfmenu_2_0':
					$Str_msg = '您好，我是企业招聘，详细请联系管理员编辑';
					break;
				case 'rselfmenu_2_1':
					$Str_msg = '您好，我是联系我们，详细请联系管理员编辑';
					break;
			}
			
			$data = array(
					0=>array(
							'Title'=>$Str_msg,
							'Description'=>$Str_msg,
							'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
							#'Url'=>'http://www.domain.com/1.html'
					),
					1=>array(
							'Title'=>$Str_msg,
							'Description'=>$Str_msg,
							'PicUrl'=>'http://pic29.nipic.com/20130530/8053706_110622293106_2.jpg',
							#'Url'=>'http://www.domain.com/1.html'
					),
			);
			
			$weObj->news($data)->reply();
			break;
	case Wechat::MSGTYPE_IMAGE:
			break;
	default:
			$weObj->text("help info")->reply();
}


 