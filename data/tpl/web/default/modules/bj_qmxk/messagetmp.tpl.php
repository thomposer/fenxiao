<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>

<link rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
	<div class="main">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
					<h4>提醒设置</h4>
        <table class="tb">
            <tr>
                <th>新订单邮件提醒</th>
                <td>
                    <input type="text" name="noticeemail" class="span5" value="<?php  echo $settings['noticeemail'];?>" />(为空则不会发邮件提醒)
                </td>
            </tr>
            
        </table>
        <table class="tb">
            <tr>
                <th>购买成功通知</th>
                <td>
                    <input type="text" name="paymsgTemplateid" class="span5" value="<?php  echo $settings['paymsgTemplateid'];?>" />
                </td>
            </tr>
            <tr>
				<th colspan="2">
					<div class="help-block">在<a href="http://mp.weixin.qq.com" target="_blank">http://mp.weixin.qq.com</a>登录后，依次点击"消息模板",点击"模板库"，选择编号为TM00001的模板点击"详情"，再点击"添加"。添加成功后查看“我的模板”，将模板ID填写到这里</div>
				</th>
			</tr>
        </table>
			   	<h4>提醒模板</h4>
				<script type="text/javascript"> 
　　String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) { 
　 if (!RegExp.prototype.isPrototypeOf(reallyDo)) { 
return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith); 
} else { 
return this.replace(reallyDo, replaceWith); 
} 
} 


</script> 
		<table class="tb">
				<tr>
					<th>下级购买商品通知</th>
					<td>
								<textarea id="gmsptz" style="height:150px;" name="gmsptz" class="span7" cols="60" onkeyup="document.getElementById('gmsptzdiv').innerText=this.value.replaceAll('{order_sn}','SN032144',false).replaceAll('{order_price}','2999.99',false).replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false);"><?php  echo $msgtemplate['gmsptz'];?></textarea>
									  <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
					<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="gmsptzdiv"><?php  echo $msgtemplate['gmsptz'];?></div>
			
								
								
								<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="gmsptzenable" value="1" <?php  if($msgtemplate['gmsptzenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="gmsptzenable" value="0" <?php  if($msgtemplate['gmsptzenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，订单编号：{order_sn}，订单金额：{order_price}，下级昵称：{agent_name}，时间：{time}
				<br/>
					
							</td>
						<script>
							document.getElementById('gmsptz').onkeyup();
							</script>
				</tr>
						<tr>
					<th>新增粉丝通知<br/>(分享关注)</th>
					<td><textarea id="tjrtz" style="height:150px;" name="tjrtz" class="span7" cols="60" onkeyup="document.getElementById('tjrtzdiv').innerText=this.value.replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false);"><?php  echo $msgtemplate['tjrtz'];?></textarea>
												  <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
										<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="tjrtzdiv"><?php  echo $msgtemplate['tjrtz'];?></div>
							
							<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="tjrtzenable" value="1" <?php  if($msgtemplate['tjrtzenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="tjrtzenable" value="0" <?php  if($msgtemplate['tjrtzenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，下级昵称：{agent_name}，时间：{time}
				<br/>
						
					</td>
						<script>
							document.getElementById('tjrtz').onkeyup();
							</script>
				</tr>
				
						<tr>
					<th>新增粉丝通知<br/>(二维码关注)</th>
					<td><textarea id="tjrtzewm" style="height:150px;" name="tjrtzewm" class="span7" cols="60" onkeyup="document.getElementById('tjrtzewmdiv').innerText=this.value.replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false);"><?php  echo $msgtemplate['tjrtzewm'];?></textarea>
					 <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
						<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="tjrtzewmdiv"><?php  echo $msgtemplate['tjrtzewm'];?></div>
							
						
							<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="tjrtzewmenable" value="1" <?php  if($msgtemplate['tjrtzewmenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="tjrtzewmenable" value="0" <?php  if($msgtemplate['tjrtzewmenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，下级昵称：{agent_name}，时间：{time}
				<br/>
						
					</td>
						<script>
							document.getElementById('tjrtzewm').onkeyup();
							</script>
				</tr>
				
				
					<tr>
					<th>新增代理通知</th>
					<td><textarea id="tjrtzdl" style="height:150px;" name="tjrtzdl" class="span7" cols="60" onkeyup="document.getElementById('tjrtzdldiv').innerText=this.value.replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false);"><?php  echo $msgtemplate['tjrtzdl'];?></textarea>
						 <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
							<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="tjrtzdldiv"><?php  echo $msgtemplate['tjrtzdl'];?></div>
						
							
								<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="tjrtzdlenable" value="1" <?php  if($msgtemplate['tjrtzdlenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="tjrtzdlenable" value="0" <?php  if($msgtemplate['tjrtzdlenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，下级昵称：{agent_name}，时间：{time}
				<br/>
					</td>	<script>
							document.getElementById('tjrtzdl').onkeyup();
							</script>
				</tr>
			<tr>
					<th>下级代理的确认收货通知</th>
					<td><textarea id="xjdlshtz" style="height:150px;" name="xjdlshtz" class="span7" cols="60" onkeyup="document.getElementById('xjdlshtzdiv').innerText=this.value.replaceAll('{order_sn}','SN032144',false).replaceAll('{order_price}','2999.99',false).replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false);"><?php  echo $msgtemplate['xjdlshtz'];?></textarea>
					 <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
						<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="xjdlshtzdiv"><?php  echo $msgtemplate['xjdlshtz'];?></div>
						
						
							<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="xjdlshtzenable" value="1" <?php  if($msgtemplate['xjdlshtzenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="xjdlshtzenable" value="0" <?php  if($msgtemplate['xjdlshtzenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，订单编号：{order_sn}，订单金额：{order_price}，下级昵称：{agent_name}，时间：{time}
				<br/>
					</td><script>
							document.getElementById('xjdlshtz').onkeyup();
							</script>
				</tr>
				
						<tr>
					<th>佣金申请通知</th>
					<td><textarea id="yjsqtz" style="height:150px;" name="yjsqtz" class="span7" cols="60"  onkeyup="document.getElementById('yjsqtzdiv').innerText=this.value.replaceAll('{agent_name}','小王',false).replaceAll('{time}','2015-01-01 21:51:32',false).replaceAll('{agent_money}','969.99',false);"><?php  echo $msgtemplate['yjsqtz'];?></textarea>
						 <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
							<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="yjsqtzdiv"><?php  echo $msgtemplate['yjsqtz'];?></div>
						
							
							<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="yjsqtzenable" value="1" <?php  if($msgtemplate['yjsqtzenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="yjsqtzenable" value="0" <?php  if($msgtemplate['yjsqtzenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，下级昵称：{agent_name}，时间：{time}，申请佣金：{agent_money}
				<br/>
					</td><script>
							document.getElementById('yjsqtz').onkeyup();
							</script>
				</tr>
				
						<tr>
					<th>商家已打款的通知</th>
					<td><textarea id="sjytktz" style="height:150px;" name="sjytktz" class="span7" cols="60"   onkeyup="document.getElementById('sjytktzdiv').innerText=this.value.replaceAll('{agent_level}','2',false).replaceAll('{time}','2015-01-01 21:51:32',false).replaceAll('{agent_money}','989.99',false);"><?php  echo $msgtemplate['sjytktz'];?></textarea>
					 <img src="./resource/image/noavatar_middle.gif" style="width:34px;height:34px;margin-left:6px; " class="img-rounded">
					<div class="btn btn-success" style="margin-left: 4px;max-width: 300px;text-align:left;" id="sjytktzdiv"><?php  echo $msgtemplate['sjytktz'];?></div>
						
					
						<br/>是否启用：
									<label class="radio inline"><input type="radio"  name="sjytktzenable" value="1" <?php  if($msgtemplate['sjytktzenable'] == 1) { ?> checked="checked"<?php  } ?> /> 启用</label>
						<label class="radio inline"><input type="radio"  name="sjytktzenable" value="0" <?php  if($msgtemplate['sjytktzenable'] == 0) { ?> checked="checked"<?php  } ?> /> 关闭</label>，分佣等级(1,2,3)：{agent_level}，时间：{time}，打款佣金：{agent_money}
				<br/>
					</td><script>
							document.getElementById('sjytktz').onkeyup();
							</script>
				</tr>
					<tr>
					<th></th>
					<td>
						
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input name="submit2" type="submit" value="提交" class="btn btn-primary span3">
					</td>
				</tr>
			</table>
		</form>
    </div>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>

