<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php  if(empty($_W['setting']['copyright']['sitename'])) { ?>分销系统，微信公众平台<?php  } else { ?><?php  echo $_W['setting']['copyright']['sitename'];?><?php  } ?></title>
    <meta name="keywords" content="<?php  if(empty($_W['setting']['copyright']['keywords'])) { ?>分销系统，微信公众平台<?php  } else { ?><?php  echo $_W['setting']['copyright']['keywords'];?><?php  } ?>" />
    <meta name="description" content="<?php  if(empty($_W['setting']['copyright']['description'])) { ?>分销系统，微信公众平台<?php  } else { ?><?php  echo $_W['setting']['copyright']['description'];?><?php  } ?>" />
    <!-- link type="text/css" rel="stylesheet" href="./resource/style/bootstrap.css" /-->
    <link href="./themes/web/wdl06/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="./resource/style/font-awesome.css" />
    <link type="text/css" rel="stylesheet" href="./themes/web/wdl06/css/common.css?v=<?php echo TIMESTAMP;?>" />
    <script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="./resource/script/bootstrap.js"></script>
    <script type="text/javascript" src="./resource/script/common.js?v=<?php echo TIMESTAMP;?>"></script>
    <script type="text/javascript" src="./resource/script/emotions.js"></script>
    <script type="text/javascript">
        cookie.prefix = '<?php  echo $_W['config']['cookie']['pre'];?>';
    </script>

    <script src="./themes/web/wdl06/js/ace/ace-elements.min.js"></script>
    <script src="./themes/web/wdl06/js/ace/ace.min.js"></script>

    <!-- ace styles -->

    <link rel="stylesheet" href="./themes/web/wdl06/css/ace/ace.min.css" />
    <link rel="stylesheet" href="./themes/web/wdl06/css/ace/ace-rtl.min.css" />
    <link rel="stylesheet" href="./themes/web/wdl06/css/ace/ace-skins.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="./themes/web/wdl06/css/ace/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="./themes/web/wdl06/js/ace/ace-extra.min.js"></script>



    <!--[if IE 7]>
    <link rel="stylesheet" href="./resource/style/font-awesome-ie7.min.css">
    <![endif]-->
    <!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="./resource/style/bootstrap-ie6.min.css">
    <link rel="stylesheet" type="text/css" href="./resource/style/ie.css">
    <![endif]-->
    <style>
        body{background-color: #F8FAFC;}
    </style>
</head>
<body scrolling="no" style="overflow:visible;">
<?php  if(!empty($GLOBALS['handlestips'])) { ?>
<div class="alert alert-error" style="margin:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;"><i class="icon-warning-sign"></i> 此模块含有特殊回复处理，请在配置完模块后，去 <a href="<?php  echo create_url('rule/system/message')?>">特殊消息类型处理</a> 页面进行启用配置。</a></div>
<?php  } ?>
