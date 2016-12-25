<?php defined('IN_IA') or exit('Access Denied');?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  echo $profile['realname'];?>专属二维码</title>
     <link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
  <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
</head>

<body class="body-gray" >

    <!--topbar begin-->
    <div >
        <nav class="tab-bar">
            <section class="left-small">
                <a href="javascript:history.back();" class="menu-icon"><span></span></a>
            </section>
            <section class="middle tab-bar-section">
                <h1 class="title">长按识别图中二维码关注</h1>
            </section>
        </nav>
    </div>
    <!--topbar end-->
    <!--content begin-->
    <div class="qrcode">
        <img src="<?php echo BJ_QMXK_ROOT;?>/style/images/share/share<?php  echo $id;?>.png?t=<?php  echo time()?>">
        <!-- <a class="qrcode-address" href="#">可转发朋友圈或是印宣传单上</a>
        <a href="#" class="qrcode-a">长按二维码可保存到手机</a>-->

    </div>
    <!--content end-->
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
	</div>
</body>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</html>
