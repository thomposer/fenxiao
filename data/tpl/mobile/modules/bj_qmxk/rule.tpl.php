<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title>帮助说明</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/style/css/style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
<meta name="mobileOptimized" content="width" />
<meta name="handheldFriendly" content="true" />
<meta http-equiv="Cache-Control" content="max-age=0" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
</head>
<body style="background: #eee">
	
<section class="main animated fadeInDown">
	<div class="main-box">
	
		<div class="rule-detail border-box">
			<?php  echo $rule;?>
		</div>
	</div>
</section>
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo BJ_QMXK_ROOT;?>/style/js/com.js"></script>


<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>