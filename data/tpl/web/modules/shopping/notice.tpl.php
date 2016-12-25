<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('notice', array('op' => 'display'))?>">管理</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
	<div class="search">
		<form action="site.php" method="get">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="do" value="notice" />
		<input type="hidden" name="op" value="display" />
		<input type="hidden" name="name" value="shopping" />
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>关键字</th>
					<td>
						<input class="span6" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
					</td>
				</tr>
				<tr>
					<th>类型</th>
					<td>
						<select name="type">
							<option value="0" selected>维权和告警</option>
							<option value="1" <?php  if($type==1) { ?> selected<?php  } ?>>维权</option>
							<option value="2" <?php  if($type==2) { ?> selected<?php  } ?>>告警</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
						<select name="status">
							<option value="-1" selected="selected">所有</option>
							<option value="0" <?php  if($status==0) { ?> selected="selected"<?php  } ?>>未解决</option>
							<option value="1" <?php  if($status==1) { ?> selected="selected" <?php  } ?>>用户同意</option>
							<option value="2" <?php  if($status==2) { ?> selected="selected" <?php  } ?>>用户拒绝</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>日期范围</th>
					<td>
						<button style="margin:0;" class="btn span5" id="date-range" type="button"><span class="date-title"><?php  echo date('Y-m-d', $starttime)?> 至 <?php  echo date('Y-m-d', $endtime)?></span> <i class="icon-caret-down"></i></button>
						<input name="starttime" type="hidden" value="<?php  echo date('Y-m-d', $starttime)?>" />
						<input name="endtime" type="hidden" value="<?php  echo date('Y-m-d', $endtime)?>" />
					</td>
				</tr>
				<tr>
				 <tr class="search-submit">
					<td colspan="2"><button class="btn pull-right span2"><i class="icon-search icon-large"></i> 搜索</button></td>
				 </tr>
			</tbody>
		</table>
		</form>
	</div>
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:5%;">ID</th>
					<th style="width:10%;">投诉单号</th>
					<th style="width:10%;">订单号</th>
					<th style="width:5%;">类型</th>
					<th style="width:5%;">状态</th>
					<th style="width:5%;">投诉人</th>
					<th style="width:10%;">理由</th>
					<th style="width:10%;">期待解决方案</th>
					<th style="width:10%;">备注</th>
					<th style="width:10%;">投诉日期</th>
					<th style="text-align:right;width:10%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['id'];?></td>
					<td style="word-break: break-all;"><?php  echo $item['feedbackid'];?></td>
					<td style="word-break: break-all;"><?php  echo $item['transid'];?></td>
					<td><?php  echo $this->getFeedbackType($item['type']);?></td>
					<td><?php  echo $this->getFeedbackStatus($item['status']);?></td>
					<td><?php  echo $item['address']['realname'];?></td>
					<td><?php  echo $item['reason'];?></td>
					<td><?php  echo $item['solution'];?></td>
					<td><?php  echo $item['remark'];?></td>
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('order', array('id' => $item['order']['id'], 'op' => 'detail'))?>">订单详情</a>
							&nbsp;&nbsp;
						<a href="<?php  echo $this->createWebUrl('notice', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="./resource/style/daterangepicker.css" />
<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>
<script type="text/javascript">
	$('#date-range').daterangepicker({
		format: 'YYYY-MM-DD',
		startDate: $(':hidden[name=starttime]').val(),
		endDate: $(':hidden[name=endtime]').val(),
		locale: {
			applyLabel: '确定',
			cancelLabel: '取消',
			fromLabel: '从',
			toLabel: '至',
			weekLabel: '周',
			customRangeLabel: '日期范围',
			daysOfWeek: moment()._lang._weekdaysMin.slice(),
			monthNames: moment()._lang._monthsShort.slice(),
			firstDay: 0
		}
	}, function(start, end){
		$('#date-range .date-title').html(start.format('YYYY-MM-DD') + ' 至 ' + end.format('YYYY-MM-DD'));
		$(':hidden[name=starttime]').val(start.format('YYYY-MM-DD'));
		$(':hidden[name=endtime]').val(end.format('YYYY-MM-DD'));
	});
</script>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
