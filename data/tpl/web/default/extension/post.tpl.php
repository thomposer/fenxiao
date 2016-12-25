<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include template('extension/service-tabs', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<h4>添加服务 <small>服务是最常用的一类回复, 如天气预报, 笑话, 百科, 翻译等简单功能</small></h4>
		<table class="tb">
			<tr>
				<th><label for="">服务名称</label></th>
				<td>
					<input type="text" class="span4" placeholder="" name="service" value="<?php  echo $rule['rule']['name'];?>">
				</td>
			</tr>
			<tr>
				<th><label for="">功能介绍</label></th>
				<td>
					<input type="text" class="span8" placeholder="" name="description" value="<?php  echo htmlspecialchars($row['description']);?>"/>
				</td>
			</tr>
			<tr>
				<th><label for="">状态</label></th>
				<td>
					<label for="status_1" class="radio inline"><input type="radio" name="status" id="status_1" value="1" <?php  if($rule['rule']['status'] == 1 || empty($rule['rule']['status'])) { ?> checked="checked"<?php  } ?> /> 启用</label>
					<label for="status_0" class="radio inline"><input type="radio" name="status" id="status_0" value="0" <?php  if(!empty($rule) && $rule['rule']['status'] == 0) { ?> checked="checked"<?php  } ?> /> 禁用</label>
				</td>
			</tr>
			<tr>
				<th><label for="">触发关键字</label></th>
				<td>
					<input type="text" class="span6" placeholder="" name="keywords" value="<?php  echo $rule['keywords'];?>" /> &nbsp;
					<label for="adv-keyword" class="checkbox inline">
						<input type="checkbox" id="adv-keyword" /> 高级触发
					</label>
					<span class="help-block">当用户的对话内容符合以上的关键字定义时，会触发这个回复定义。多个关键字请使用逗号隔开。</span>
				</td>
			</tr>
			<tr class="hide adv-keyword">
				<th><label for="">高级触发规则</label></th>
				<td>
					<div class="keyword-list list" id="keyword-list">
						<?php  if(is_array($rule['keyword'])) { foreach($rule['keyword'] as $item) { ?>
						<?php  if($item['type'] != '1') { ?>
						<div class="item" id="keyword-item-<?php  echo $item['id'];?>">
							<?php  include template('rule/item', TEMPLATE_INCLUDEPATH);?>
						</div>
						<?php  } ?>
						<?php  } } ?>
					</div>
					<a href="javascript:;" onclick="keywordHandler.buildForm()" class="add-kw-button"><i class="icon-plus"></i> 添加关键字</a>
				</td>
			</tr>
			<tr>
				<th><label for="">回复</label></th>
				<td>
					<div class="alert alert-block">
						<div><span style="display:inline-block; width:150px; font-weight:600;">[from]</span>粉丝用户的OpenID</div>
						<div><span style="display:inline-block; width:150px; font-weight:600;">[to]</span>当前公众号的OpenID</div>
						<div><span style="display:inline-block; width:150px; font-weight:600;">[rule]</span>当前回复的回复编号</div>
					</div>
					<span class="help-block" style="margin:5px 0;">可在回复内容的任何地方使用预定义标记来表示特定内容</span>
					<div id="module-form">
						<div class="alert alert-block alert-new">
							<a class="close" data-dismiss="alert">×</a>
							<h4 class="alert-heading">添加处理接口</h4>
							<table>
								<tr>
									<th>接口类型：</th>
									<td>
										<label for="radio_1" class="radio inline" onclick="$('#remote').show();$('#location').hide();$('input[id=long]').attr('checked', 'checked');"><input type="radio" name="type" id="long"  value="1" <?php  if(strexists($row['apiurl'], 'http://')) { ?> checked="checked"<?php  } ?> /> 远程地址</label>
										<label for="radio_0" class="radio inline" onclick="$('#remote').hide();$('#location').show();$('input[id=local]').attr('checked', 'checked');"><input type="radio" name="type" id="local"  value="0" <?php  if(!strexists($row['apiurl'], 'http://')) { ?> checked="checked"<?php  } ?> /> 本地文件</label>
									</td>
								</tr>
								<tbody id="remote" <?php  if(!strexists($row['apiurl'], 'http://')) { ?>style="display:none;"<?php  } ?>>
								<tr>
									<th>远程地址：</th>
									<td>
										<input type="text" id="" class="span7" placeholder="" name="apiurl" value="<?php  echo $row['apiurl'];?>">
										<div class="help-block" style="margin-top:10px;">
											<ol style="margin-top:10px;">
												<li>使用远程地址接口，你可以兼容其他的微信公众平台管理工具。</li>
												<li>你应该填写其他平台提供给你保存至公众平台的URL和Token</li>
												<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
												<li>具体请<a href="http://www.we7.cc/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li>
											</ol>
										</div>
									</td>
								</tr>
								<tr>
									<th style="color:red">Token</th>
									<td>
										<input type="text" name="wetoken" class="span6" value="<?php  echo $row['token'];?>" />
										<div class="help-block">与目标平台接入设置值一致，必须为英文或者数字，长度为3到32个字符.</div>
									</td>
								</tr>
								</tbody>
								<tbody id="location" <?php  if(strexists($row['apiurl'], 'http://')) { ?> style="display:none;"<?php  } ?>>
								<tr>
									<th>文件列表：</th>
									<td>
										<select name="apilocal"><option value="0">请选择本地文件</option><?php  if(is_array($apis)) { foreach($apis as $file) { ?><option <?php  if($row['apilocal'] == $file) { ?> selected="selected"<?php  } ?> value="<?php  echo $file;?>"><?php  echo $file;?></option><?php  } } ?></select>
										<div class="help-block" style="margin-top:10px;">
											<ol style="margin-top:10px;">
												<li>使用本地文件扩展你可以快速的扩展维航功能。</li>
												<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
												<li>本地文件存放在模块文件夹内（/source/modules/userapi/api）下。</li>
												<li>具体请<a href="http://www.we7.cc/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li>
											</ol>
										</div>
									</td>
								</tr>
								</tbody>

								<tr>
									<th>默认回复文字</th>
									<td>
										<input type="text" id="" class="span7" placeholder="" name="default-text" value="<?php  echo $row['default_text'];?>">
										<div class="help-block">当接口无回复时，则返回用户此处设置的文字信息，优先级高于“默认回复URL”</div>
									</td>
								</tr>
								<tr>
									<th>缓存时间</th>
									<td><input type="text" id="" class="span7" placeholder="" name="cachetime" value="<?php  echo $row['cachetime'];?>">
										<div class="help-block">接口返回数据将缓存在维航系统中的时限，默认为0不缓存。</div></td>
								</tr>
							</table>
						</div>

					</div>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/html" id="keyword-item-html">
<?php  unset($item); include template('rule/item', TEMPLATE_INCLUDEPATH);?>
</script>
<script type="text/javascript">
<!--
	$(function(){
		$('#adv-setting').click(function(){
			if(this.checked) {
				$('.adv-setting').show();
			} else {
				$('.adv-setting').hide();
			}
		});
		$('#adv-keyword').click(function(){
			if(this.checked) {
				$('.adv-keyword').show();
			} else {
				$('.adv-keyword').hide();
			}
		});
	<?php  if($rule['kwd-adv']) { ?>
		$('#adv-keyword').attr('checked', 'checked');
		$('.adv-keyword').show();
	<?php  } ?>
	});
	var keywordHandler = {
		'buildForm' : function() {
			var obj = buildAddForm('keyword-item-html', $('#keyword-list'));
			obj.find('.btn-group .btn').on('click', function(){
				$(this).parent().next().html($(this).attr('description'));
				obj.find('#keyword-type-new').val($(this).attr('value'));
			});
			obj.find('#form').show();
			obj.find('#show').hide();
		},
		'doAdd' : function(itemid) {
			var parent = $('#' + itemid);
			if ($('.keyword-name-new', parent).val() == '' && $('.keyword-type-new', parent).val() != 4) {
				message('请输入关键字！', '', 'error');
				return false;
			}
			if($('.keyword-type-new', parent).val() == 4) {
				$('.keyword-name-new', parent).val('');
			}
			var typetips = $('.active', parent).html();
			$('#show #type', parent).html(typetips);
			$('#show #content', parent).html($('.keyword-name-new', parent).val());
			$('#show', parent).css('display', 'block');
			$('#form', parent).css('display', 'none');
		},
		'doEditItem' : function(itemid) {
			$('#keyword-list .item').each(function(){
				$('#form', $(this)).css('display', 'none');
				$('#show', $(this)).css('display', 'block');
			});
			doEditItem(itemid);
		}
	};

	function buildModuleForm(module) {
		try {
			$.ajax({
			  url: "<?php  echo create_url('member/module', array('do' => 'form', 'id' => $rule['rule']['id']))?>",
			  type: "GET",
			  data: {'name' : module.toLowerCase()},
			  dataType: "html"
			}).done(function(s) {
				if (s && s.indexOf('"type":"error"') >= 0) {
					message('请重新选择公众号！', '<?php  echo create_url('rule/post')?>', 'error');
					return false;
				}
				formCheckers = [];
				$('#module-form').html(s);
			});
		}
		catch (e) {
		}
	}

	function formcheck(form) {
		if (form['name'].value == '') {
			message('抱歉，规则名称为必填项，请返回修改！', '', 'error');
			return false;
		}
		if ($(':text[name="keywords"]').val() == '' && $('.keyword-name-new').val() == '' && $('.keyword-type-new').val() != 4) {
			message('抱歉，您至少要设置一个触发关键字！', '', 'error');
			return false;
		}
		$(':text[name="keywords"]').val($(':text[name="keywords"]').val().replace(/，/g, ','));
		return true;
	}

	<?php  if(empty($rid)) { ?>
	$(function(){
		keywordHandler.buildForm();
	});
	<?php  } else { ?>
	$('.btn-group .btn').on('click', function(){
		$(this).parent().next().html($(this).attr('description'));
		$(this).parent().parent().find('#keyword-type-new').val($(this).attr('value'));
	});
	<?php  } ?>
//-->
</script>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
