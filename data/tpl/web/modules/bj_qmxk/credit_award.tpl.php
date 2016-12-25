<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('site/module/award', array('name' => 'bj_qmxk', 'op' => 'post'));?>">添加积分商品</a></li>
	<li <?php  if($operation == 'display'&&$modules!='credit') { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('site/module/award', array('name' => 'bj_qmxk', 'op' => 'display'));?>">管理积分商品</a></li>
	<li <?php  if($operation == 'display'&&$modules=='credit') { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('site/module/credit', array('name' => 'bj_qmxk', 'op' => 'display'));?>">兑换申请管理</a></li>
</ul>
<?php  if($operation == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
		<h4>编辑奖品</h4>
		<table class="tb">
			<tr>
				<th><label for="">奖品名称</label></th>
				<td>
					<input type="text" name="title" class="span5" value="<?php  echo $item['title'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">宣传图</label></th>
				<td>
					<?php echo tpl_form_field_image('logo', $item['logo'] =='' ? $setting['thumb'] : $item['logo']);?>
					<span class="help-block"></span>
				</td>
			</tr>
			<tr>
				<th><label for="">剩余可兑换奖品数</label></th>
				<td>
					<input type="text" name="amount" class="span2" value="<?php  echo $item['amount'];?>" />
					<span class="help-block">此设置项设置该奖品剩余奖品数。为0时不对外显示，不接受兑换。</span>
				</td>
			</tr>
			<tr>
				<th><label for="">兑奖截止日期</label></th>
				<td>
				<?php  echo tpl_form_field_date('deadline',$item['deadline'], true)?>
					<!--<input type="text" name="deadline" class="span2" value="<?php  echo $item['deadline'];?>" />-->
					<span class="help-block">超过该日期后不可兑奖!</span>
				</td>
			</tr>

			<tr>
				<th><label for="">奖品实际价格</label></th>
				<td>
					<input type="text" name="price" class="span2" value="<?php  echo $item['price'];?>" />
					<span class="help-block">此设置项设置奖品价格。</span>
				</td>
			</tr>
			<tr>
				<th><label for="">兑换消耗积分数</label></th>
				<td>
					<input type="text" name="credit_cost" class="span2" value="<?php  echo $item['credit_cost'];?>" />
					<span class="help-block">此设置项设置该奖品剩余奖品数。为0时不对外显示，不接受兑换。</span>
				</td>
			</tr>
			<tr>
				<th>内容</th>
				<td>
					<textarea style="height:400px; width:100%;" class="span7 richtext-clone" name="content" cols="70"><?php  echo $item['content'];?></textarea>
				</td>
			</tr>
		<tr>
			<th></th>
			<td>
				<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</td>
		</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
<!--
	kindeditor($('.richtext-clone'));
//-->
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="min-width:150px;">奖品名称</th>
					<th style="width:100px;">剩余数量</th>
					<th style="width:100px;">价格</th>
					<th style="width:100px;">消耗积分</th>
					<th style="width:400px;">描述</th>
					<th style="text-align:right; min-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['title'];?></td>
					<td><?php  echo $item['amount'];?></td>
					<td><?php  echo $item['price'];?></td>
					<td><?php  echo $item['credit_cost'];?></td>
					<td><?php  echo htmlspecialchars_decode($item['content'])?></td>
					<td style="text-align:right;">
						<a href="<?php  echo create_url('site/module/award', array('name' => 'bj_qmxk', 'award_id' => $item['award_id'], 'op' => 'post'))?>" title="编辑" class="btn btn-small"><i class="icon-edit"></i></a>
						<a href="<?php  echo create_url('site/module/award', array('name' => 'bj_qmxk', 'award_id' => $item['award_id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除" class="btn btn-small"><i class="icon-remove"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<!--tr>
				<td colspan="8">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr-->
		</table>
	</div>
</div>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
