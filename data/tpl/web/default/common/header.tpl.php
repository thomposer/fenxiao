<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"<?php  if(!empty($initNG)) { ?> ng-app<?php  } ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php  if(empty($_W['setting']['copyright']['sitename'])) { ?>维航 - 微信公众平台自助引擎 -  Powered by WE7.CC<?php  } else { ?><?php  echo $_W['setting']['copyright']['sitename'];?><?php  } ?></title>
<meta name="keywords" content="<?php  if(empty($_W['setting']['copyright']['keywords'])) { ?>维航,微信,微信公众平台<?php  } else { ?><?php  echo $_W['setting']['copyright']['keywords'];?><?php  } ?>" />
<meta name="description" content="<?php  if(empty($_W['setting']['copyright']['description'])) { ?>微信公众平台自助引擎，简称维航，维航是一款免费开源的微信公众平台管理系统。<?php  } else { ?><?php  echo $_W['setting']['copyright']['description'];?><?php  } ?>" />
<link type="text/css" rel="stylesheet" href="./resource/style/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="./resource/style/font-awesome.css" />
<link type="text/css" rel="stylesheet" href="./resource/style/jquery.mCustomScrollbar.css" />
<link type="text/css" rel="stylesheet" href="./resource/style/common.css?v=<?php echo TIMESTAMP;?>" />
<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="./resource/script/bootstrap.js"></script> 
<?php  if(!empty($initNG)) { ?><script type="text/javascript" src="./resource/script/angular.min.js"></script> <?php  } ?>
<script type="text/javascript" src="./resource/script/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="./resource/script/common.js?v=<?php echo TIMESTAMP;?>"></script>
<script type="text/javascript" src="./resource/script/emotions.js"></script>
<script type="text/javascript">
cookie.prefix = '<?php  echo $_W['config']['cookie']['pre'];?>';
window.UEDITOR_HOME_URL = '<?php  echo $_W['siteroot'];?>';
</script>
<!--[if IE 7]>
<link rel="stylesheet" href="./resource/style/font-awesome-ie7.min.css">
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="./resource/style/bootstrap-ie6.min.css">
<link rel="stylesheet" type="text/css" href="./resource/style/ie.css">
<![endif]-->
</head>
<body <?php  if($action == 'frame') { ?>style="height:100%; overflow:hidden;" scroll="no"<?php  } ?>>
<?php  if(!empty($GLOBALS['handlestips'])) { ?>
<div class="alert alert-error" style="margin:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;"><i class="icon-warning-sign"></i> 此模块含有特殊回复处理，请在配置完模块后，去 <a href="<?php  echo create_url('rule/system/message')?>">特殊消息类型处理</a> 页面进行启用配置。</a></div>
<?php  } ?>
