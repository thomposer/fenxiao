<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<i class="icon-lightbulb"></i> 用户通过微信发送此处设置的关键字时，将会回复进入该模块的图文信息。
		</div>
		<input type="hidden" name="id" value="<?php  echo $rule['rule']['id'];?>">
		<h4><?php  echo $_W['modules'][$entry['module']]['title'];?>功能封面(<?php  echo $entry['title'];?>)</h4>
		<table class="tb">
			<tr>
				<th><label for="">规则名称</label></th>
				<td>
					<input type="text" id="rule-name" class="span6" placeholder="" value="<?php  echo $entry['title'];?>" readonly="readonly" /> &nbsp;
					<label for="adv-setting" class="checkbox inline">
						<input type="checkbox" id="adv-setting" hideclass="adv-setting"<?php  if($rule['rule']['displayorder'] > 0) { ?> checked='true'<?php  } ?>> 高级设置
					</label>
					<span class="help-block">您可以给这条规则起一个名字, 方便下次修改和查看.<a class="iconEmotion" href="javascript:;" inputid="rule-name"><i class="icon-github-alt"></i> 表情</a></span>
				</td>
			</tr>
			<tr class="hide adv-setting">
				<th><label for="">状态</label></th>
				<td>
					<label for="status_1" class="radio inline"><input type="radio" name="status" id="status_1" value="1" <?php  if($rule['rule']['status'] == 1 || empty($rule['rule']['status']) || empty($rule['rule'])) { ?> checked="checked"<?php  } ?> /> 启用</label>
					<label for="status_0" class="radio inline"><input type="radio" name="status" id="status_0" value="0" <?php  if(!empty($rule) && !empty($rule['rule']) && $rule['rule']['status'] == 0) { ?> checked="checked"<?php  } ?> /> 禁用</label>
					<span class="help-block"></span>
				</td>
			</tr>
			<tr class="hide adv-setting">
				<th><label for="">是否置顶</label></th>
				<td>
					<label for="radio_1" class="radio inline"><input type="radio" name="istop" id="radio_1" onclick="$('#displayorder').hide();" value="1" <?php  if(!empty($rule['rule']['displayorder']) && $rule['rule']['displayorder'] == 255) { ?> checked="checked"<?php  } ?> /> 置顶</label>
					<label for="radio_0" class="radio inline"><input type="radio" name="istop" id="radio_0" onclick="$('#displayorder').show();$('#rule-displayorder').val(0)" value="0" <?php  if($rule['rule']['displayorder'] < 255) { ?> checked="checked"<?php  } ?> /> 普通</label>
					<span class="help-block">“置顶”时无论在什么情况下均能触发且使终保持最优先级，<span style="color:red">置顶设置过多，会影响系统效率，建议不要超过100个</span>；否则参考设置的“优先级”值</span>
				</td>
			</tr>
			<tr id="displayorder" class="hide adv-setting" <?php  if(!empty($rule['rule']['displayorder']) && $rule['rule']['displayorder'] == 255) { ?> style="display:none;"<?php  } ?>>
				<th><label for="">优先级</label></th>
				<td>
					<input type="text" id="rule-displayorder" class="span2" placeholder="" name="displayorder" value="<?php  echo $rule['rule']['displayorder'];?>">
					<span class="help-block">规则优先级，越大则越靠前，最大不得超过254</span>
				</td>
			</tr>
			<tr>
				<th><label for="">触发关键字</label></th>
				<td>
					<input type="text" class="span6" placeholder="" name="keywords" value="<?php  echo $rule['keywords'];?>" /> &nbsp;
					<span class="help-block">当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。</span>
				</td>
			</tr>
			<?php  if(!empty($reply)) { ?>
			<tr>
				<th><label for="">直接引用URL</label></th>
				<td>
					<input type="text" class="span6" placeholder="" value="<?php  echo $_W['siteroot'];?><?php  if(empty($entry['url'])) { ?><?php  echo create_url('mobile/entry', array('eid' => $entry['eid'], 'weid' => $reply['weid']))?><?php  } else { ?><?php  echo $entry['url'];?><?php  } ?>" /> &nbsp;
					<span class="help-block">此处不同于关键字回复，是直接指向到入口的URL。您可以在自定义菜单（有oauth权限）或是其它位置直接使用。</span>
				</td>
			</tr>
			<?php  } ?>
			<tr>
				<th><label for="">回复</label></th>
				<td>
					<div class="alert alert-block hide adv-setting">
						<div><span style="display:inline-block; width:150px; font-weight:600;">[from]</span>粉丝用户的OpenID</div>
						<div><span style="display:inline-block; width:150px; font-weight:600;">[to]</span>当前公众号的OpenID</div>
						<div><span style="display:inline-block; width:150px; font-weight:600;">[rule]</span>当前回复的回复编号</div>
					</div>
					<span class="help-block hide adv-setting" style="margin:5px 0;">可在回复内容的任何地方使用预定义标记来表示特定内容</span>
					<div class="alert alert-block alert-new wrap-item">
						<table id="form" class="tb reply-news-edit">
							<tr>
								<th>标题</th>
								<td>
									<input type="text" id="title" class="span7" placeholder="" name="title" value="<?php  echo $reply['title'];?>">
								</td>
							</tr>
							<tr>
								<th>封面</th>
								<td>
									<?php  echo tpl_form_field_image('thumb', $reply['thumb']);?>
								</td>
							</tr>
							<tr>
								<th>描述</th>
								<td>
									<textarea style="height:80px;" class="span7" cols="70" id="description" name="description"><?php  echo $reply['description'];?></textarea>
								</td>
							</tr>
							<tr>
								<th>来源</th>
								<td>
									<input type="text" class="span7" id="url" name="url" value="<?php  echo $reply['url'];?>">
									<span class="help-block">此项为空则表示使用默认链接，设置来源后打开该条图文将跳转到指定链接（注：外部链接需加http://）</span>
								</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					<input type="hidden" name="module" value="<?php  echo $modulename;?>" />
					<input type="hidden" name="entry" value="<?php  echo $_GPC['entry'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
<!--
	function formcheck(form) {
		if (form['name'].value == '') {
			message('抱歉，规则名称为必填项，请返回修改！', '', 'error');
			return false;
		}
		if ($(':text[name="keywords"]').val() == '' && $('.keyword-name-new').val() == '' && $('.keyword-type-new').val() != '4') {
			message('抱歉，您至少要设置一个触发关键字！', '', 'error');
			return false;
		}
		$(':text[name="keywords"]').val($(':text[name="keywords"]').val().replace(/，/g, ','));
		return true;
	}

//-->
</script>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
