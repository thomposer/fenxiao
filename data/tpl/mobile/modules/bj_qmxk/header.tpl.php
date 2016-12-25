<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html<?php  if($initNG) { ?> ng-app<?php  } ?>>
<head>
	<title><?php  if($title) { ?><?php  echo $title;?><?php  } else { ?><?php  if(!empty($_W['account']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } ?><?php  } ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- Mobile Devices Support @begin -->
	<meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
	<meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
	<meta content="no-cache" http-equiv="pragma">
	<meta content="0" http-equiv="expires">
	<meta content="telephone=no, address=no" name="format-detection">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<!-- Mobile Devices Support @end -->
	<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="./resource/script/common.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<?php  if($bootstrap_type == 3) { ?>
	<link type="text/css" rel="stylesheet" href="./themes/mobile/default/style/bootstrap.css?x=<?php echo BJ_QMXK_VERSION;?>">
	<script type="text/javascript" src="./themes/mobile/default/script/bootstrap.min.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<?php  } else { ?>
	<link type="text/css" rel="stylesheet" href="./resource/style/bootstrap.css?x=<?php echo BJ_QMXK_VERSION;?>">
	<script type="text/javascript" src="./resource/script/bootstrap.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<?php  } ?>
<?php  if($initNG) { ?><script type="text/javascript" src="./resource/script/angular.min.js?x=<?php echo BJ_QMXK_VERSION;?>"></script><?php  } ?>
	<link type="text/css" rel="stylesheet" href="./resource/style/font-awesome.min.css?x=<?php echo BJ_QMXK_VERSION;?>" />
	<link type="text/css" rel="stylesheet" href="./themes/mobile/default/style/common.mobile.css?x=<?php echo BJ_QMXK_VERSION;?>">
	<script type="text/javascript" src="./resource/script/cascade.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<script type="text/javascript" src="./themes/mobile/default/script/jquery.touchwipe.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	<script type="text/javascript" src="./themes/mobile/default/script/swipe.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
	
</head>
<?php  if($bootstrap_type != 3) { ?>
<style>
/*重定义bootstrap样式*/
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{width:100%; margin-bottom:0; box-sizing:border-box; -webkit-box-sizing:border-box; -moz-box-sizing:border-box;}
input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{height:30px;}
.input-append, .input-prepend{width:100%; margin-bottom:0;}
select{padding:0 5px; line-height:28px; -webkit-appearance:button;}
.checkbox.inline{margin-top:0;}
.checkbox.inline + .checkbox.inline {margin-left:0;}
.checkbox input[type="checkbox"]{filter:alpha(opacity:0); opacity:0;}
.file{position:relative;}
.file input[type="file"]{position:absolute; top:0; left:0; width:100%; filter:alpha(opacity:0); opacity:0;}
.file button{width:100%; text-align:left;}
.form-item{border-left:3px #ED2F2F solid; padding-left:10px; height:30px; line-height:30px; background:#F7F7F7; margin-bottom:10px;}
</style>
<?php  } ?>
<body>
<?php  if(empty($main_off)) { ?><div class="main"><?php  } ?>