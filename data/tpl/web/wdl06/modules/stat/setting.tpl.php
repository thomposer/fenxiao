<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript">
	$(function(){
		$(':radio[name="msg_history"]').click(function(){
			if($(':radio[name=msg_history]:checked').val() == '1') {
				$('.msgd').show();
			} else {
				$('.msgd').hide();
			}
		});
	});
</script>
	<div class="main">
		<form action="" method="post" class="form-horizontal form">
			<h4>统计分析 <small>设定公众号码统计分析的相关功能，这个设置是针对当前公众号的</small></h4>
			<table class="tb">
				<tr>
					<th>开启历史消息记录</th>
					<td>
						<label for="msg_history_1" class="radio inline"><input type="radio" name="msg_history" value="1" <?php  if($settings['msg_history'] == '1') { ?>checked="checked"<?php  } ?>> 是</label>
						<label for="msg_history_0" class="radio inline"><input type="radio" name="msg_history" value="0"  <?php  if($settings['msg_history'] == '0') { ?>checked="checked"<?php  } ?>> 否</label>
						<div class="help-block">开启此项后，系统将记录用户与系统的往来消息记录。</div>
					</td>
				</tr>
				<tr class="msgd<?php  if($settings['msg_history'] == '0') { ?> hide<?php  } ?>">
					<th>历史消息记录天数</th>
					<td>
						<input type="text" name="msg_maxday" class="span2" value="<?php  echo $settings['msg_maxday'];?>" />
						<div class="help-block">设置保留历史消息记录的天数，为0则为保留全部。</div>
					</td>
				</tr>
				<tr>
					<th>开启利用率统计</th>
					<td>
						<label for="rule_use_1" class="radio inline"><input type="radio" name="use_ratio" value="1" <?php  if($settings['use_ratio'] == '1') { ?>checked="checked"<?php  } ?>> 是</label>
						<label for="rule_use_0" class="radio inline"><input type="radio" name="use_ratio" value="0"  <?php  if($settings['use_ratio'] == '0') { ?>checked="checked"<?php  } ?>> 否</label>
						<div class="help-block">开启此项后，系统将记录系统中的规则的使用情况，并生成走势图。</div>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</table>
		</form>
	</div>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
