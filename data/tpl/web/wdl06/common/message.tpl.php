<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
body{background:#fff;margin:0px;}
#showbox{background:#fff; width:400px; height:150px; border:1px solid #c6c6c6; box-shadow:2px 2px 2px #e6e6e6; overflow:hidden; margin:0 auto; margin-top:40px;}
#showbox h4{ font-size:12px; margin-top:30px;line-height:16px; text-align:center;}
#showbox p{ width:400px;text-align:center;}
#title{height:30px; overflow:hidden; text-align: center; font: bold 14px/30px '微软雅黑'; color:#333;background:#f8f8f8; border-bottom:1px solid #c6c6c6;}
#main{width: 400px; height: 200px; overflow: hidden;text-align: center; font: 12px/20px 微软雅黑; color: #be0000;}.text{font: 12px/20px 微软雅黑; color: #be0000;}
</style>
    <div id="showbox"><div id="title">提示信息</div>
	<div id="main">
				<?php  if($type == 'sql') { ?>
			<h4>MYSQL 错误：</h4>
			<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
			<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
		<?php  } else { ?>
		<h4><?php  echo $msg;?></h4>
        <?php  if($redirect) { ?>
		<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
		<script type="text/javascript">
			setTimeout(function () {
				location.href = "<?php  echo $redirect;?>";
			}, 3000);
		</script>
		<?php  } else { ?>
				<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./index.php?act=welcome">首页</a>]</p>
                <?php  } ?>
		<?php  } ?>
					</div></div>

<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
