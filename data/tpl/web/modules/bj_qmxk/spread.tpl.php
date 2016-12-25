<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'leaflet') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('spread', array('op' => 'leaflet'));?>">海报列表</a></li>
  <li <?php  if($op == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('spread', array('op' => 'post'));?>">新建海报</a></li>
	<!--<li <?php  if($op == 'log') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('spread', array('op' => 'log'));?>">推广统计（数据跟分销系统打通）</a></li>
	<li <?php  if($op == 'log') { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('site/module', array('weid' => $_W['weid'], 'do' => 'fansmanager', 'name' => 'bj_qmxk' ));?>">推广统计</a></li>-->
	
</ul>
<?php  if($op == 'leaflet') { ?>
<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<form action="<?php  echo $this->createWebUrl('Spread')?>" method="post" onsubmit="return shareHandler.doAdd(this)" class="form-horizontal form" enctype="multipart/form-data">
				<input type="checkbox" name="boolrule" value="1" <?php  if($boolrule==true) { ?> checked<?php  } ?> >自动绑定"分销专属二维码"关键字,绑定后，可以直接在自定义菜单或是直接回复关键词【分销专属二维码】来调用二维码海报功能
				<input type="hidden" name="op" value="checkspreadrule" />
						<input name="submit" type="submit" value="提交" class="btn btn-primary span1">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</form>
		</div>
<?php  } ?>
<?php  if($op == 'post') { ?>
  <?php  include $this->template('post', TEMPLATE_INCLUDEPATH);?>
<?php  } ?>
<?php  if($op == 'leaflet') { ?>
  <?php  include $this->template('leaflet', TEMPLATE_INCLUDEPATH);?>
<?php  } ?>
<?php  if($op == 'log') { ?>
  <?php  include $this->template('log', TEMPLATE_INCLUDEPATH);?>
<?php  } ?>
<?php  if($op == 'user') { ?>
  <?php  include $this->template('user', TEMPLATE_INCLUDEPATH);?>
<?php  } ?>



<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
