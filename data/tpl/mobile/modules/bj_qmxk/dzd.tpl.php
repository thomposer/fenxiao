<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<!DOCTYPE html>
<html>
<head>
	<title>我的小店基本信息</title>
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
</head>
<body>
<?php  if(empty($main_off)) { ?><div class="main"><?php  } ?>
<style>
body{background:#efefef url(./source/modules/workover/style/img/1.jpg) no-repeat fixed top;}
.head{height:60px; line-height:60px;  padding:5px; 5px; color:#fff;border-bottom: 1px solid #a5d7de; background:url(./source/modules/workover/style/img/11.jpg) no-repeat fixed top;}
.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; color:#FFF; text-decoration:none;}
.head .bn.pull-right{position:absolute; right:5px; top:0;}
.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;}
.head .order{background:#F9F9F9; position:absolute; z-index:9999; right:0;}
.head .order li > a{display:block; padding:0 10px; min-width:100px; height:35px; line-height:35px; font-size:16px; color:#666; text-decoration:none; border-top:1px #EEE solid;}
.head .order li > a i{display:inline-block; width:20px;}
.head .order li.icon-caret-up{font-size:20px;color:#F9F9F9;position:absolute;top:-11px;right:16px;}
.navbar-fixed-bottom{max-width:700px; margin:0 auto; background-color:#f9f9f9; border-top:1px #DDD solid; padding:5px 0; overflow:hidden; height:50px;}
.navbar-fixed-bottom > a{display:inline-block; color:#769cdc; height:40px; line-height:40px; font-size:14px; text-decoration:none; text-align:center; width:100%;}
.navbar-fixed-bottom > .pull-left{border-right:1px #d4d4d4 solid; width:90px; position:absolute; left:0; top:5px;}
.navbar-fixed-bottom > .pull-right{border-left:1px #d4d4d4 solid; width:90px; position:absolute; right:0; top:5px;}
/**/
.form-horizontal{margin:5px; background:#fafafa; padding:20px 10px 10px 10px; overflow:hidden;}
.form-horizontal label{color:#555;}
.form-horizontal .sendverify{margin-right:15px; width:100%;}
.form-horizontal .resolve{background:#FFF; border-top:2px #769cdc solid; padding:10px;}
.form-horizontal .resolve .resolver, .resolve .date{text-align:right; color:#888;}
.form-horizontal .resolve .resolver{color:#779cdc;}
/**/
.list{background:#fafafa; padding:10px; margin:5px;}
.list .hd{border-bottom:1px #DDD dotted; margin-bottom:5px; padding-bottom:5px;}
.list .hd > span{display:block;}
.list .hd > span.title{font-size:16px; color:#000;}
.list .hd > span.date{color:#666; font-size:12px;}
.list .content{color:#545454; line-height:25px;}
.list .content .author{color:#999; text-align:right; margin-top:10px;}
.list .reply{background:#FFF; border-top:2px #769cdc solid; padding:10px; margin-top:10px; overflow:hidden;}
.list .reply > .pull-left .label, .list .reply > .pull-right .label{display:inline-block;text-align:left;line-height:20px;padding:3px 5px;white-space:normal;}
.list .reply > .pull-right{width:60%; margin-bottom:10px; text-align:right;}
.list .reply > .pull-left{width:60%; margin-bottom:10px;}
.list .reply .reply-more{display:none;}
.list .reply .reply-more-btn{float:left;width:100%;margin-bottom:-13px; text-align:center; cursor:pointer; border-top:1px #DDD dotted; margin-top:10px; padding-top:10px;}
.list .reply .reply-more-btn span{padding:5px 30px; background:#9dc0fb; color:#FFF;}
/**/
.table{background:#FFF;}
.table thead th{background:#ecedee; color:#686868; font-weight:normal; border-bottom:1px #c0c0c0 solid !important;}
.table tbody td{border-color:#e4e6e6 !important;}
.table tbody td a{color:#333;}
/**/
.home-box{overflow:hidden; margin:10px 5px;}
.home-box > a{float:left; display:block; width:<?php  echo 100/3;?>%; text-align:center; margin-bottom:10px; text-decoration:none; color:#769cdc;}
.home-box > a div{background:#C8E1FA; margin:0 5px; padding:5px 0;}
.home-box > a div i{display:block; font-size:30px;}
.home-box > a div span{display:block; margin-top:10px;}
/**/
.tips{background:#fafafa; margin:5px;  padding:10px; text-align:center; font-size:16px; color:#555;}
.tips .icon{border-bottom:1px #DDD dotted; margin-bottom:10px; padding-bottom:10px;}
.tips .icon i{font-size:50px; color:#769cdc;}
/**/
.pagination {margin:8px 0; padding: 5px 0;}
.pagination ul li {float:left;}
.pagination ul li.active a {background-color:#428bca; color:white;}
/**/
.width-auto {width:auto;}
.pull-right {float:right;}
.pull-left {float:left;}
.head .title {letter-spacing: 1em;}


</style>


	<style>
.step .con{width:50%; float:left; margin-bottom:20px;}
.step .con > div{background:#EEE; color:#EEE; width:90%; height:50px; position:relative; text-align:center;}
.step .con > div .img-circle{background:#BBB; display:inline-block; width:20px; height:20px; line-height:20px; margin-top:6px;}
.step .con > div .step-name{display:block; color:#BBB;}
.step .con .pull-left .icon-caret-right{position:absolute; right:-15px; top:0; font-size:50px;}
.step .active > div{background:#D9D9D9; color:#D9D9D9;}
.step .active > div .img-circle{background:#3276b1; color:#FFF;}
.step .active > div .step-name{color:#333;}
</style>
<style>
.form-horizontal .control-label{margin-bottom:5px; font-size:14px;}
.form-group{margin-bottom:10px;}
</style>
<form class="form-horizontal img-rounded" role="form" method="post" onsubmit="return checkInfo(this);">
			<input type="hidden" name="id" value="<?php  echo $item['id'];?>">
<div class="form-group">
	<label for="starttime" class="col-sm-3 control-label"></label>
	<div class="col-sm-9">

	</div>
</div>
<div class="form-group">
	<label for="endtime" class="col-sm-3 control-label">店铺名称</label>
	<div class="col-sm-9">
		<input type="text" id="dzdtitle" name="dzdtitle" value="<?php  echo $profile['dzdtitle'];?>"  class="form-control" placeholder="输入店铺名称" />
	</div>
</div>
<div class="form-group">
	<label for="endtime" class="col-sm-3 control-label">转发话术</label>
	<div class="col-sm-9">
		<input type="text" id="dzdsendtext" name="dzdsendtext" value="<?php  echo $profile['dzdsendtext'];?>"  class="form-control" placeholder="输入转发话术" />
	</div>
</div>
	
		<div class="form-group">
		<label for="ctime" class="col-xs-3 control-label">真实姓名</label>
		<div class="col-xs-9">
		<input type="text" id="realname" name="realname" value="<?php  echo $profile['realname'];?>" class="form-control" placeholder="输入真实姓名" />
		</div>
	</div>
	
		<div class="form-group">
		<label for="ctime" class="col-xs-3 control-label">手机号码</label>
		<div class="col-xs-9">
		<input type="tel" id="mobile" name="mobile" value="<?php  echo $profile['mobile'];?>" class="form-control" placeholder="输入手机号码" />
		</div>
	</div>
	
<div class="form-group">
	<div class="col-xs-12">
		<button type="submit" name="submit" value="yes" class="btn btn-primary btn-lg" style="width:100%;">提交设置</button>
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
	</div>
</div>
</form>

</div>
  <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />


<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
  <?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>