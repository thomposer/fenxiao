<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	
	<li <?php  if($op == 'create_express') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'create_express'));?>">新建快递单模板</a></li>
	<li <?php  if($op == 'express') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'express'))?>">快递单模板管理</a></li>
	
	<li <?php  if($op == 'create_normal') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'create_normal'));?>">新建发货单打印模板</a></li>
	<li <?php  if($op == 'normal') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'normal'));?>">发货单打印模板管理</a></li>
	
</ul>


<div class="main">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th class="row-hover" style="text-align: center;">序号</th>
					<th class="row-hover" style="text-align: center;">模板名称</th>
					<th class="row-hover" style="text-align: center;">修改时间</th>
					<th class="row-hover" style="text-align: center;">是否默认</th>
					<th class="row-hover" style="text-align: center;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  $index=1?>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td style="text-align: center;"><?php  echo $index++;?></td>
					<td style="text-align: center;"><?php  echo $item['name'];?></td>
					<td style="text-align: center;"><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<td style="text-align: center;"><?php echo $item['isdefault']==1?'是':'否'?></td>
					<td  style="text-align: center;"><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'set_express','id'=>$item['id']));?>">设为默认模板</a>&nbsp;&nbsp;&nbsp;
						<a target="_blank" href="<?php  echo $this->createWebUrl('printer', array('op' => 'preview_express', 'id' => $item['id']))?>">预览</a>&nbsp;&nbsp;&nbsp;
						<a href="<?php  echo $this->createWebUrl('printer', array('op' => 'edit_express', 'id' => $item['id']))?>">编辑</a>&nbsp;&nbsp;&nbsp;
						<a onclick="return confirm('此操作不可恢复，确认删除？');" href="<?php  echo $this->createWebUrl('printer', array('op' => 'del_express', 'id' => $item['id']))?>">删除</a></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
</div>
