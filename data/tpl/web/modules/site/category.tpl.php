<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($foo == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post'))?>">添加分类</a></li>
	<li <?php  if($foo == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('foo' => 'display'))?>">管理分类</a></li>
</ul>
<?php  if($foo == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return check(this)">
	<input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />
		<h4>分类详细设置</h4>
		<table class="tb">
			<?php  if(!empty($category['name'])) { ?>
			<tr>
				<th><label for="">访问地址</label></th>
				<td>
					<a href="<?php  echo $this->createMobileUrl('list', array('cid' => $category['id'], 'weid' => $_W['weid']))?>" target="_blank"><?php  echo $this->createMobileUrl('list', array('cid' => $category['id'], 'weid' => $_W['weid']))?></a>
					<span class="help-block">您可以根据此地址，添加回复规则，设置访问。</span>
				</td>
			</tr>
			<?php  } ?>
			<tr>
				<th></th>
				<td></td>
			</tr>
			<?php  if(!empty($parentid)) { ?>
			<tr>
				<th><label for="">上级分类</label></th>
				<td>
					<?php  echo $parent['name'];?>
				</td>
			</tr>
			<?php  } ?>
			<tr>
				<th><label for="">排序</label></th>
				<td>
					<input type="text" name="displayorder" class="span6" value="<?php  echo $category['displayorder'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">分类名称</label></th>
				<td>
					<input type="text" name="cname" class="span6" value="<?php  echo $category['name'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">分类描述</label></th>
				<td>
					<textarea name="description" class="span6" cols="70"><?php  echo $category['description'];?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="">是否作为首页使用</label></th>
				<td>
					<label for="radio_1" class="radio inline"><input onclick="restoreDefaultItem()" type="radio" name="ishomepage" id="radio_1" value="1" autocomplete="off" <?php  if(!empty($category['ishomepage'])) { ?> checked<?php  } ?>/> 是</label>
					<label for="radio_2" class="radio inline"><input onclick="restoreDefaultItem()" type="radio" name="ishomepage" id="radio_2" value="0" autocomplete="off" <?php  if(empty($category['ishomepage']) || empty($category['ishomepage'])) { ?> checked<?php  } ?>/> 否</label>
					<div class="help-block">开启此选项后，分类将模板将直接引用首页模板（index.html），分类的二级分类将作为导航显示</div>	
				</td>
			</tr>
			<tr>
				<th><label for="">选择分类模板</label></th>
				<td>
					<select name="template" class="span3" id="template" onchange="getTemplateFiles(this)">
						<option value="">使用默认设置</option>
						<?php  if(is_array($template)) { foreach($template as $v) { ?>
						<option value="<?php  echo $v['name'];?>"<?php  if($category['template'] == $v['name']) { ?> selected="selected"<?php  } ?>><?php  echo $v['title'];?>（<?php  echo $v['name'];?>）</option>
						<?php  } } ?>
					</select>
					<select name="file" class="span3" id="file">
						<option value="">请选择分类模板文件</option>
						<?php  if(is_array($files)) { foreach($files as $file) { ?>
						<option value="<?php  echo $file;?>" <?php  if($category['templatefile'].'.html' == $file) { ?> selected<?php  } ?>><?php  echo $file;?></option>
						<?php  } } ?>
					</select>
					<span class="help-block">新建分类风格时，请在您选择的风格目录下新建“site”文件夹，然后可以在此选择指定的模板文件。例如：/themes/mobile/style1/site/list_1.html 新建此文件可以在此处选择。</span>
				</td>
			</tr>
			<tr>
				<th><label for="">直接链接</label></th>
				<td>
					<input type="text" class="span6" placeholder="" name="linkurl" value="<?php  echo $category['linkurl'];?>">
					<span class="help-block">链接必须是以http://或是https://开头</span>
				</td>
			</tr>
		</table>
		<div id="style">
			<h4>导航样式</h4>
			<table class="tb">
				<tr>
					<th><label for="">图标类型</label></th>
					<td>
						<label for="icontype1" class="radio inline"><input type="radio" <?php  if(empty($category['icontype']) || $category['icontype'] == 1) { ?> checked<?php  } ?> value="1" name="icontype" id="icontype1" onclick="$('#iconsys').show();$('#iconuser').hide();colorpicker();" autocomplete="off"> 系统内置</label>&nbsp;&nbsp;&nbsp;
						<label for="icontype2" class="radio inline"><input type="radio" <?php  if($category['icontype'] == 2) { ?> checked<?php  } ?> value="2" name="icontype" id="icontype2" onclick="$('#iconsys').hide();$('#iconuser').show();" autocomplete="off"> 自定义上传</label>
					</td>
				</tr>
				<tbody id="iconsys" <?php  if($category['icontype'] == 2) { ?> style="display:none;"<?php  } ?>>
					<tr>
						<th>系统图标</th>
						<td>
							<div class="input-append" style="display:block; margin-top:5px;">
								<input class="span3" type="text" name="icon[icon]" id="icon" value="<?php  if(!empty($category['css']['icon']['icon'])) { ?><?php  echo $category['css']['icon']['icon'];?><?php  } ?>" placeholder=""><button class="btn" onclick="w = ajaxshow('<?php  echo create_url('site/icon')?>', '图标列表', {width : 800});return false;">选择图标</button>
							</div>
							<span class="help-block">导航的背景图标，系统提供了丰富的图标ICON。</span>
						</td>
					</tr>
					<tr>
						<th><label for="">图标颜色</label></th>
						<td>
							<?php  echo tpl_form_field_color('icon[color]', $category[css]['icon']['color']);?>
							<span class="help-block">图标颜色，上传图标时此设置项无效</span>
						</td>
					</tr>
					<tr>
						<th>图标大小</th>
						<td>
							<input class="span2" type="text" name="icon[size]" id="icon" value="<?php  if($category['css']['icon']['size']) { ?><?php  echo $category['css']['icon']['size'];?><?php  } else { ?>35<?php  } ?>"><span class="help-inline">PX</span>
							<span class="help-block">图标的尺寸大小，单位为像素，上传图标时此设置项无效</span>
						</td>
					</tr>
				</tbody>
				<tbody id="iconuser"  <?php  if(empty($category['icontype']) || $category['icontype'] == 1) { ?> style="display:none;"<?php  } ?>>
					<tr>
						<th><label for="">上传图标</label></th>
						<td>
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-preview thumbnail" style="width: 50px; height: 50px;"><?php  if($category['icon']) { ?><img src="<?php  echo $_W['attachurl'];?><?php  echo $category['icon'];?>" width="50" /><?php  } ?></div>
								<div>
									<span class="btn-file">
										<span class="btn fileupload-new">选择图片</span>
										<span class="btn fileupload-exists">更改</span>
										<input name="icon" type="file" />
									</span>
									<?php  if($category['icon']) { ?><button type="submit" name="fileupload-delete" value="<?php  echo $category['icon'];?>" class="btn fileupload-new">删除</button><?php  } ?>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
								</div>
							</div>
							<input type="hidden" name="icon_old" value="<?php  echo $category['icon'];?>" />
							<span class="help-block">自定义上传图标图片，“系统图标”优先于此项</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<table class="tb">
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
	function getTemplateFiles(obj) {
		$('#file').empty();
		$('#file').append('<option value="">请选择分类模板文件</option>');
		if (!$(obj).val()) {
			return false;
		}

		$.getJSON('<?php  echo $this->createWebUrl('category', array('foo' => 'templatefiles'))?>', {'template' : $(obj).val(), 'ishomepage' : $('input[name="ishomepage"]:checked').val() == '1' ? 1 : 0}, function(s){
			if (s.message.status != 0) {
				message(s.message.message, '', 'error');
				return;
			}
			$('#file').empty();
			if (s.message.message) {
				for (i in s.message.message) {
					$('#file').append('<option value="'+s.message.message[i]+'">'+s.message.message[i]+'</option>');
				}
			} 
		});
	}

	function check(form) {
		if (!form['cname'].value) {
			message('请输入分类名称！', '', 'error');
			return false;
		}
		if (!$('input[name="ishomepage"]:checked').val() && form['template'].value && !form['file'].value) {
			message('请指定分类模板文件', '', 'error');
			return false;
		}
	}

	function restoreDefaultItem() {
		$("#template option[value='']").attr('selected', true);
		$('#file').empty();
		$('#file').append('<option value="">请选择分类模板文件</option>');
	}
//-->
</script>
<?php  } else if($foo == 'display') { ?>
<div class="main">
	<div class="category">
		<form action="" method="post" onsubmit="return formcheck(this)">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:10px;"></th>
					<th style="width:60px;">显示顺序</th>
					<th>分类名称</th>
					<th>链接</th>
					<th style="width:80px;">设为栏目</th>
					<th style="width:120px;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($category)) { foreach($category as $row) { ?>
				<tr>
					<td><?php  if(count($children[$row['id']]) > 0) { ?><a href="javascript:;"><i class="icon-chevron-down"></i></a><?php  } ?></td>
					<td><input type="text" class="span1" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
					<td><div class="type-parent"><?php  echo $row['name'];?>&nbsp;&nbsp;<?php  if(empty($row['parentid'])) { ?><a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post', 'parentid' => $row['id']))?>" title="添加子分类"><i class="icon-plus-sign-alt"></i></a><?php  } ?></div></td>
					<td><input type="text" class="span3" value="<?php  echo $this->createMobileUrl('list', array('cid' => $row['id'], 'weid' => $_W['weid']))?>"></td>
					<td><?php echo $row['nid'] ? '是' : '否'?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('article', array('foo' => 'post', 'pcate' => $row['id']))?>" title="添加文章" class="btn btn-small"><i class="icon-plus"></i></a>
						<a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post', 'id' => $row['id']))?>" title="编辑" class="btn btn-small"><i class="icon-edit"></i></a>
						<a href="<?php  echo $this->createWebUrl('category', array('foo' => 'delete', 'name' => 'site', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除" class="btn btn-small"><i class="icon-remove"></i></a>
					</td>
				</tr>
				<?php  if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $row) { ?>
				<tr>
					<td></td>
					<td><input type="text" class="span1" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
					<td><div class="type-child"><?php  echo $row['name'];?>&nbsp;&nbsp;<?php  if(empty($row['parentid'])) { ?><a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post', 'parentid' => $row['id']))?>"><i class="icon-plus-sign-alt" title="添加子分类"><i class="icon-plus-sign-alt"></i></a><?php  } ?></div></td>
					<td><input type="text" class="span3" value="<?php  echo $this->createMobileUrl('list', array('cid' => $row['id'], 'weid' => $_W['weid']))?>"></td>
					<td><?php echo $row['enabled'] ? '是' : '否'?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('article', array('foo' => 'post', 'pcate' => $row['parentid'], 'ccate' => $row['id']))?>" title="添加文章" class="btn btn-small"><i class="icon-plus"></i></a>
						<a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post', 'id' => $row['id']))?>" title="编辑" class="btn btn-small"><i class="icon-edit"></i></a>
						<a href="<?php  echo $this->createWebUrl('category', array('foo' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除" class="btn btn-small"><i class="icon-remove"></i></a>
				</td>
				</tr>
				<?php  } } ?>
			<?php  } } ?>
				<tr>
					<td></td>
					<td colspan="5">
						<a href="<?php  echo $this->createWebUrl('category', array('foo' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加新分类</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="5">
						<input name="submit" type="submit" class="btn btn-primary" value="提交">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
</div>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
