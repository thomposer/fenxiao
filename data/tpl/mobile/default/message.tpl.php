<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('header', TEMPLATE_INCLUDEPATH);?>
<style>
/*提示信息*/
.message{margin:10% 10px 40% 10px; overflow:hidden; padding-left:80px;}
.message i{float:left; font-size:60px; margin-left:-70px;}
.message h3{line-height:30px;}
.message span{color:#666; font-size:14px; line-height:23px; display:block;}
</style>
<div class="alert alert-<?php  echo $type;?> message">
	<i class="icon-<?php  if($type == 'success') { ?>ok<?php  } ?><?php  if($type == 'error') { ?>remove<?php  } ?><?php  if($type == 'block' || $type == 'sql') { ?>warning-sign<?php  } ?><?php  if($type == 'info') { ?>info-sign<?php  } ?>"></i>
	<?php  if($type == 'sql') { ?>
		<h3>MYSQL 错误：</h3>
		<span><?php  echo cutstr($msg['sql'], 300, 1);?></span>
		<span><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></span>
	<?php  } else { ?>
	<h3><?php  if($type == 'success') { ?>成功<?php  } ?><?php  if($type == 'error') { ?>错误<?php  } ?><?php  if($type == 'block') { ?>警告<?php  } ?><?php  if($type == 'info') { ?>提示<?php  } ?></h3>
	<span><?php  echo $msg;?></span>
	<?php  if($redirect) { ?>
	<p style="margin-top:20px;"><a href="<?php  echo $redirect;?>">正在跳转</a></p>
	<script type="text/javascript">
		setTimeout(function () {
			location.href = "<?php  echo $redirect;?>";
		}, 3000);
	</script>
	<?php  } else { ?>
	<p style="margin-top:20px;">[<a href="javascript:history.go(-1);">返回上一页</a>] &nbsp; [<a href="<?php  echo create_url('mobile/channel', array('name' => 'index', 'weid' => $_W['weid']))?>">首页</a>]</p>
	<?php  } ?>
	<?php  } ?>
</div>
<?php  include template('footer', TEMPLATE_INCLUDEPATH);?>
