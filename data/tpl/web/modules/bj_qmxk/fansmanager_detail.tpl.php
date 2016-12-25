<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<div class="form form-horizontal">
		<h4>代理详细信息</h4>
		<table class="tb">
		<form action="">
			<input type="hidden" name="id" value="<?php  echo $user['id'];?>">
			<input type="hidden" name="op" value="status">
			<input type="hidden" name="act" value="module" />
			<input type="hidden" name="name" value="bj_qmxk" />
			<input type="hidden" name="do" value="fansmanager" />
			
			<tr>
				<th style="width:200px"><label>设置权限</label></th>
				<td style="text-align: left;">
					<label class="radio inline"><input type="radio" name="status" value="1" <?php  if($user['status']==1) { ?>checked<?php  } ?>>可用</label>
					<label class="radio inline" ><input type="radio" name="status" value="0" <?php  if($user['status']==0) { ?>checked<?php  } ?>>禁用</label>
				</td>
			</tr>
			<tr style="display:none;">
				<th style="width:200px"><label>是否为代理</label></th>
				<td style="text-align: left;">
					<input type="hidden" name="flag" value="1" >
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">真实姓名</label></th>
				<td>
					<?php  if($user['realname']!="") { ?> <?php  echo $user['realname'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<?php  if($user['dzdflag']==1&&$user['flag']==1) { ?>
					<tr>
				<th style="width:200px"><label for="">店中店名称</label></th>
				<td>
					<?php  if($user['dzdtitle']!="") { ?> <?php  echo $user['dzdtitle'];?><?php  } else { ?><?php  } ?>
				</td>
			</tr>
				<tr>
				<th style="width:200px"><label for="">店中店转发话术</label></th>
				<td>
					<?php  if($user['dzdsendtext']!="") { ?> <?php  echo $user['dzdsendtext'];?><?php  } else { ?><?php  } ?>
				</td>
			</tr>
			<?php  } ?>
			<tr>
				<th style="width:200px"><label for="">手机号码</label></th>
				<td>
					<?php  if($user['mobile']!="") { ?> <?php  echo $user['mobile'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">注册时间</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $user['createtime']);?>
				</td>
			</tr>			
			<tr>
				<th><label for="">银行卡号</label></th>
				<td>
					<?php  if($user['banktype']!="") { ?> <?php  echo $user['banktype'];?>－<span id="bankcard"><?php  echo $user['bankcard'];?></span> <?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">支付宝号</label></th>
				<td>
					<?php  if($user['alipay']!="") { ?> <?php  echo $user['alipay'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">微信号码</label></th>
				<td>
					<?php  if($user['wxhao']!="") { ?> <?php  echo $user['wxhao'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">当前佣金</label></th>
				<td>
					<?php  echo $user['commission'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">备注</label></th>
				<td>
					<textarea name="content"><?php  echo $user['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="button" class="btn btn-primary span3" name="submit" onclick="history.go(-1)" value="返回" />
					<input type="submit" class="btn btn-primary span3" name="submit"  value="提交" />
				</td>
			</tr>
			</form>
		</table>
	</div>
</div>

<script type="text/javascript">
window.onload = function(){
	var bankcard = "<?php  echo $user['bankcard'];?>";
	//var bankcard = bankcard.toString();
	if(bankcard != ''){
		var card = '';
		for(var i=0; i<5; i++){
			card = card + bankcard.substr(4*i,4) + ' ';
		}
		window.document.getElementById('bankcard').innerHTML = card;
	}
}

</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
