<?php
session_start();
include ('../../includes/config.php');
if(isset($_SESSION['wspanel_user'])){
	$kcf=array(
		'disabled' =>false,
		'uploadURL'=>'../../img',
		'uploadDir'=>'',
		'types'=>array(
			'company'	=>'*img',
			'contents'	=>'*img',
			'galery'	=>'*img',
			'locations'	=>'*img',
			'news'		=>'*img',
			'services'	=>'*img'
		)
	);
	if(isset($_SESSION['KCF'])) $kcf=array_merge($kcf,$_SESSION['KCF']);
	if(isset($_SESSION['KCF_TEMP'])) $kcf=array_merge($kcf,$_SESSION['KCF_TEMP']);
	unset($_SESSION['KCF_TEMP']);
	if(isset($kcf['path'])) $kcf['uploadURL']='../../'.$kcf['path'];
	unset($kcf['path']);
}else{
	$kcf=array();
}
