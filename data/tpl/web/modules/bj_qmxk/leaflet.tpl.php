<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="max-width:20px;">海报ID</th>
					<th style="max-width:300px;">海报名称</th>
					<th style="max-width:20px;">状态</th>
					<th style="text-align:right; max-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($mylist)) { foreach($mylist as $item) { ?>
				<tr style="color:green">
					<td><?php  echo $item['channel'];?></td>
					<td><?php  echo $item['title'];?></td>
          <td><?php  if($item['active']) { ?>使用中<?php  } ?></td>
          <td style="text-align:right;">
            <a href="<?php  echo $this->CreateWebUrl('Spread', array('op' => 'active', 'channel'=>$item['channel']))?>" title="设置为当前使用的海报" class="btn btn-small"><i class="icon-heart"></i></a>
            <a href="<?php  echo $this->CreateWebUrl('Spread', array('op' => 'post', 'channel'=>$item['channel']))?>" title="编辑" class="btn btn-small"><i class="icon-edit"></i></a>
            <a href="<?php  echo $this->CreateWebUrl('Spread', array('op' => 'delete', 'channel'=>$item['channel']))?>" title="删除" onclick="return confirm('此操作不可恢复，确定？');return false;" class="btn btn-small"><i class="icon-remove"></i></a>
          </td>
         </tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
	</div>
</div>

