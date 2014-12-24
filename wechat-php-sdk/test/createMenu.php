<?php

#创建菜单

include "../config.php";
include "../wechat.class.php";

$weObj = new Wechat($options); 

$newmenu =  array(
	"button"=>array(
		array('type'=>'click','name'=>'公司介绍','key'=>'rselfmenu_1_0',),
		
		array('type'=>'click','name'=>'公司新闻','key'=>'rselfmenu_1_1',),
		
		array (
			'name' => '其他',
			'sub_button' => array (
				array ('type' => 'click','name' => '企业招聘','key' => 'rselfmenu_2_0'),
				array ('type' => 'click','name' => '联系我们','key' => 'rselfmenu_2_1')
			),
		),
	),
);

$delete_result = $weObj->deleteMenu();
$crete_result = $weObj->createMenu($newmenu);//创建

$menu = $weObj->getMenu();	//获取菜单

print_r($delete_result);
print_r($crete_result);
print_r($menu);
 
