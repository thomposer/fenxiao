<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
	<ul class="nav nav-tabs">
		<?php  if($id) { ?>
		<li class="active"><a href="<?php  echo create_url('account/post', array('id' => $id))?>"><i class="icon-edit"></i> 编辑公众号</a></li>
		<li><a href="<?php  echo create_url('account/payment', array('id' => $id))?>"><i class="icon-money"></i> 编辑支付选项</a></li>
		<?php  } else { ?>
		<li class="active"><a href="<?php  echo create_url('account/post')?>"><i class="icon-plus"></i> 添加公众号</a></li>
		<?php  } ?>
		<li><a href="<?php  echo create_url('account/display')?>">管理公众号</a></li>
	</ul>
	<div class="main">
	<div class="stat">
		<div class="stat-div">
			<div class="navbar navbar-static-top">
				<div class="navbar-inner">
					<div class="pull-left">
						<ul class="nav">
							<li class="active"><a href="#accont-common" data-toggle="tab">普通模式</a></li>
							<li><a href="#accont-press" data-toggle="tab">一键获取模式</a></li>
						</ul>
					</div>
				</div>
			</div>
			<form action="" method="post" class="form-horizontal tab-content" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php  echo $wechat['weid'];?>" />
			<input type="hidden" name="parentid" value="<?php  echo $parentwechat['weid'];?>" />
			<div id="accont-common" class="tab-pane fade active in">
				<div class="sub-item">
					<h4 class="sub-title">普通模式</h4>
				</div>
				<div class="sub-item" id="table-list">
					<div class="sub-content">
						<table class="tb">
							<?php  if(!empty($parentwechat)) { ?>
							<tr>
								<th><label for="">父公众号</label></th>
								<td>
									<input type="text" readonly class="span6" value="<?php  echo $parentwechat['name'];?>" autocomplete="off">
								</td>
							</tr>
							<?php  } ?>
							<tr>
								<th><label for="">公众号名称</label></th>
								<td>
									<input type="text" name="name" class="span6" value="<?php  echo $wechat['name'];?>" autocomplete="off">
									<!--label for="adv-setting" class="checkbox inline">
										<input type="checkbox" id="adv-setting" hideclass="adv-setting"<?php  if($wechat['key'] && $wechat['secret']) { ?> checked='true'<?php  } ?>> 服务号
									</label-->
									<span class="help-block">您可以给此公众号起一个名字, 方便下次修改和查看.</span>
								</td>
							</tr>
							<tr>
								<th><label for="">公众号类型</label></th>
								<td>
									<?php  if(!empty($parentwechat)) { ?>
									<?php  if($parentwechat['type'] == 1) { ?>微信公众平台<?php  } ?>
									<?php  if($parentwechat['type'] == 2) { ?> 易信公众平台<?php  } ?>
									<input type="hidden" name="type" value="<?php  echo $parentwechat['type'];?>">
									<?php  } else { ?>
									<select name="type" id="type" onchange="verifyGen()">
										<option value="1" <?php  if($wechat['type'] == 1) { ?> selected<?php  } ?>>微信公众平台</option>
										<option value="2" <?php  if($wechat['type'] == 2) { ?> selected<?php  } ?>>易信公众平台</option>
									</select>
									<?php  } ?>
								</td>
							</tr>
							<tr>
								<th><label for="">公众号接口权限</label></th>
								<td>
									<label for="status_1" class="radio inline"><input autocomplete="off" type="radio" name="level" id="status_1" value="0" <?php  if(empty($wechat['level'])) { ?> checked<?php  } ?> /> 普通订阅号</label>
									<label for="status_2" class="radio inline"><input autocomplete="off" type="radio" name="level" id="status_2" value="1" <?php  if($wechat['level'] == 1) { ?> checked<?php  } ?> /> 认证订阅号/普通服务号</label>
									<label for="status_3" class="radio inline"><input autocomplete="off" type="radio" name="level" id="status_3" value="2" <?php  if($wechat['level'] == 2) { ?> checked<?php  } ?> /> 认证服务号</label>
								</td>
							</tr>
							<?php  if(!empty($id)) { ?>
							<tr>
								<th style="color:red">接口地址</th>
								<td>
									<input type="text" class="span6" value="<?php  echo $_W['siteroot'];?>api.php?hash=<?php  echo $wechat['hash'];?>" readonly="readonly" autocomplete="off"/>
									<div class="help-block">设置“微信公众平台接口”配置信息中的接口地址</div>
								</td>
							</tr>
							<tr>
								<th style="color:red">微信Token</th>
								<td>
									<input type="text" name="wetoken" class="span6" value="<?php  echo $wechat['token'];?>" readonly="readonly" /> <a href="javascript:;" onclick="tokenGen();">生成新的</a>
									<div class="help-block">与微信公众平台接入设置值一致，必须为英文或者数字，长度为3到32个字符. 请妥善保管, Token 泄露将可能被窃取或篡改微信平台的操作数据.</div>
								</td>
							</tr>
							<tr>
								<th style="color:red">EncodingAESKey</th>
								<td>
									<input type="text" name="EncodingAESKey" class="span6" value="<?php  echo $wechat['EncodingAESKey'];?>" readonly="readonly" /> <a href="javascript:;" onclick="EncodingAESKey();">生成新的</a>
									<div class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为43个字符. 请妥善保管, EncodingAESKey 泄露将可能被窃取或篡改平台的操作数据.</div>
								</td>
							</tr>
							<?php  } ?>
							<tr class="">
								<th>公众号AppId</th>
								<td>
									<input type="text" name="key" class="span6" value="<?php  echo $wechat['key'];?>" autocomplete="off"/>
									<div class="help-block">请填写微信公众平台后台的AppId</div>
								</td>
							</tr>
							<tr class="">
								<th>公众号AppSecret</th>
								<td>
									<input type="text" name="secret" class="span6" value="<?php  echo $wechat['secret'];?>" autocomplete="off"/>
									<div class="help-block">请填写微信公众平台后台的AppSecret, 只有填写这两项才能管理自定义菜单</div>
								</td>
							</tr>
							<tr>
								<th><label for="">公众帐号</label></th>
								<td>
									<input type="text" name="account" class="span6" value="<?php  echo $wechat['account'];?>" autocomplete="off" />
									<span class="help-block">您的微信帐号或是易信帐号，本平台支持管理多个公众号</span>
								</td>
							</tr>
							<tr>
								<th><label for="">原始帐号</label></th>
								<td>
									<input type="text" name="original" class="span6" value="<?php  echo $wechat['original'];?>" autocomplete="off" />
									<span class="help-block">微信公众帐号的原ID串，<a href="index.php?act=help&amp;do=wx_uid" target="blank">怎么查看微信的原始帐号？</a></span>
								</td>
							</tr>
							<tr>
								<th><label for="">二维码</label></th>
								<td>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-preview thumbnail" style="width: 160px; height: 160px;"><?php  if(file_exists(IA_ROOT . '/resource/attachment/qrcode_'.$wechat['weid'].'.jpg')) { ?><img class="img-polaroid" src="<?php  echo $_W['attachurl'];?>/qrcode_<?php  echo $wechat['weid'];?>.jpg?time=<?php  echo time()?>" width="150" /><?php  } ?></div>
										<div>
											<span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists">更改</span><input name="qrcode" type="file" /></span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
										</div>
									</div>
									<span class="help-block">只支持JPG图片</span>
								</td>
							</tr>
							<tr>
								<th><label for="">头像</label></th>
								<td>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-preview thumbnail" style="width: 95px; height: 95px;"><?php  if(file_exists(IA_ROOT . '/resource/attachment/headimg_'.$wechat['weid'].'.jpg')) { ?><img class="img-polaroid" src="<?php  echo $_W['attachurl'];?>/headimg_<?php  echo $wechat['weid'];?>.jpg?time=<?php  echo time()?>" width="85" /><?php  } ?></div>
										<div>
											<span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists">更改</span><input name="headimg" type="file" /></span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
										</div>
									</div>
									<span class="help-block">只支持JPG图片</span>
								</td>
							</tr>
							<tr>
								<th></th>
								<td>
									<input name="submit" type="submit" value="提交" class="btn btn-primary span2" />
									<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="accont-press" class="tab-pane fade">
				<div class="sub-item">
					<h4 class="sub-title">一键获取模式 <small>设置用户名密码后，程序会自动采集您的公众号相关信息。</small></h4>
				</div>
				<div class="sub-item" id="table-list">
					<div class="sub-content">
						<table class="tb">
							<tr>
								<th><label for="">公众登录用户</label></th>
								<td>
									<input type="text" name="wxusername" id="username" class="span6" value="<?php  echo $wechat['username'];?>" autocomplete="off" onblur="verifyGen()" />
									<span class="help-block">请输入你的公众平台用户名</span>
								</td>
							</tr>
							<tr>
								<th><label for="">公众登录密码</label></th>
								<td>
									<input type="password" name="wxpassword" class="span6" value="" autocomplete="off"  />
									<span class="help-block">请输入你的公众平台密码</span>
								</td>
							</tr>
							
							<?php  if(!empty($wechat['username'])) { ?>
							<tr>
								<th></th>
								<td>
									<input name="sync" type="submit" value="同步微信公众平台帐号信息" class="btn span4" />
									<div class="help-block">填写公众号帐号密码后，如果发现信息没有同步成功，请点击此选项进行手动同步。</div>
								</td>
							</tr>
							<?php  } ?>
							<tr>
								<th></th>
								<td>
									<input name="submit" type="submit" value="提交" class="btn btn-primary span2" />
									<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	</div>
<script type="text/javascript">
<!--
	var codeurl = {'1':'https://mp.weixin.qq.com/cgi-bin/verifycode', '2':'https://plus.yixin.im/captcha'};
	function verifyGen() {
		if ($('#username').val()) {
			var type = $('#type').val() ? $('#type').val() : 1;
			$('#imgverify').attr('src', codeurl[type] + '?username='+$('#username').val()+'&r='+Math.round(new Date().getTime()));
			$('#imgverify').parent().parent().parent().show();
		} else {
			//message('请先输入微信公众平台用户名');
		}
	}
	function EncodingAESKey() {
		var letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		var token = '';
		for(var i = 0; i < 43; i++) {
			var j = parseInt(Math.random() * 61 + 1);
			token += letters[j];
		}
		$(':text[name="EncodingAESKey"]').val(token);
	}
	verifyGen();
//-->
</script>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
