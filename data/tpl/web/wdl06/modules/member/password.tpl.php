<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>

<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('password',array('op'=>'info'));?>">消费密码说明</a></li>
	<li class="active"><a href="<?php  echo $this->createWebUrl('password');?>">消费密码管理</a></li>
</ul>

<div class="main">
	<form method="post" class="form-horizontal">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">删？</th>
					<th style="width:150px;">店员名称</th>
					<th style="width:100px;">消费密码</th>
				</tr>
			</thead>
			<tbody id="list">
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><input type="checkbox" name="delete[]" value="<?php  echo $item['id'];?>" /></td>
					<td><input type="text" name="title[<?php  echo $item['id'];?>]" class="span6" value="<?php  echo $item['name'];?>" /></td>
					<td><input type="text" name="password[<?php  echo $item['id'];?>]" class="span6" value="" placeholder="密码已保密，重新输入可重置密码" /></td>
				</tr>
				<?php  } } ?>
			</tbody>
			<tbody style="border-top:0;">
			<tr>
				<td></td>
				<td colspan="2">
					<a href="javascript:;" onclick="addItem()"><i class="icon-plus-sign-alt"></i> 添加</a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	</form>
</div>
<script type="text/javascript">
<!--
	function addItem() {
		var html = '' +
				'<tr>' +
					'<td></td>' +
					'<td><input type="text" name="title-new[]" class="span6" value="" /></td>' +
					'<td><input type="text" name="password-new[]" class="span6" value="" /></td>' +
				'</tr>';
		$('#list').append(html);
	}
	function deleteItem(o) {
		$(o).parent().parent().remove();
	}
//-->
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>