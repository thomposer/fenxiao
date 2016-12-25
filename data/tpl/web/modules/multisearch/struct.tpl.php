<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('struct', array('op' => 'post'));?>">创建查询结构</a></li>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('struct', array('op' => 'display'));?>">管理</a></li>
</ul>
<?php  if($operation == 'post') { ?>
<style>
.moresetting td{border-top:0; padding-top:0;}
</style>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<input type="hidden" name="id" value="<?php  echo $search['id'];?>">
		<h4>创建查询结构</h4>
		<table class="tb">
			<tr>
				<th><label for="">名称</label></th>
				<td>
					<input type="text" class="span5" name="title" value="<?php  echo $search['title'];?>">
				</td>
			</tr>
			<tr>
				<th>简介</th>
				<td>
					<textarea style="height:100px;" class="span5" name="description" cols="70"><?php  echo $search['description'];?></textarea>
				</td>
			</tr>
			<tr>
				<th>是否支持预约</th>
				<td>
					<label for="radio_1" class="radio inline"><input type="radio" name="isresearch" id="radio_1" value="1" <?php  if(empty($search) || $search['isresearch'] == 1) { ?> checked<?php  } ?>> 是</label>
					<label for="radio_0" class="radio inline"><input type="radio" name="isresearch" id="radio_0" value="0" <?php  if(!empty($search) && $search['isresearch'] == 0) { ?> checked<?php  } ?>> 否</label>
					<span class="help-block">设置此项后，用户可在此查询结果中填写相关信息预约</span>
				</td>
			</tr>
			<tr>
				<th>封面</th>
				<td>
					<?php  echo tpl_form_field_image('cover', $search['cover'])?>
				</td>
			</tr>
			<tr>
				<th>模板</th>
				<td>
					<select name="template">
						<option value="default">默认模板</option>
						<?php  if(is_array($template)) { foreach($template as $temp) { ?>
						<option value="<?php  echo $temp;?>" <?php  if($temp == $search['template']) { ?> selected<?php  } ?>><?php  echo $temp;?></option>
						<?php  } } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>咨询电话</th>
				<td>
					<input type="text" class="span5" name="mobile" value="<?php  echo $search['mobile'];?>">
					<div class="help-block">用户在查询数据时，可拨打该电话进行咨询。</div>
				</td>
			</tr>
			<tr>
				<th>接收通知email</th>
				<td>
					<input type="text" class="span5" name="noticeemail" value="<?php  echo $search['noticeemail'];?>">
					<div class="help-block">设置当用户预约时，系统自动发送通知到此Email中。使用前请先设置系统的发送邮件相关参数，<a href="<?php  echo create_url('setting/common')?>" target="main">点击前往设置</a>。</div>
				</td>
			</tr>
		</table>
		<div class="alert alert-info">新建字段变量时，请注意不要使用name,id等这些系统常用变量，推荐您在变量之前加入您的前缀例如：my_name,my_id来避免冲突。</div>
		<h4>查询项管理</h4>
		<table class="table">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;" class="row-first">排序</td>
					<th style="width:100px;" class="row-hover">名称 <span title="必填项" class="text-error">*</span><i></i></th>
					<th style="width:100px;" class="row-hover">变量名 <span title="必填项" class="text-error">*</span><i></i></th>
					<th style="width:50px;">必填项<i></i></th>
					<th style="width:50px;">查询项<i></i></th>
					<th style="width:100px;">类型<i></i></th>
					<th style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody id="form-items">
			<?php  if(is_array($search['fields'])) { foreach($search['fields'] as $field) { ?>
				<?php  if($field['type'] == 1) { ?>
				<tr >
					<td><input type="text" class="span1" name="fields[displayorder][<?php  echo $field['id'];?>]" value="<?php  echo $field['displayorder'];?>"></td>
					<td><input type="text" class="span3" name="fields[title][<?php  echo $field['id'];?>]" value="<?php  echo $field['title'];?>" placeholder="请认真填写名称"></td>
					<td><input type="text" class="span3" disabled name="fields[variable][<?php  echo $field['id'];?>]" value="<?php  echo $field['variable'];?>" placeholder="变量名切勿与以上所填重复"></td>
					<td><input type="checkbox" checkvalue="required" <?php  if($field['required']) { ?>checked<?php  } ?>><input type="hidden" id="required" name="fields[required][<?php  echo $field['id'];?>]" value="<?php  echo $field['required'];?>"></td>
					<td><input type="checkbox" checkvalue="search" <?php  if($field['search']) { ?>checked<?php  } ?> disabled><input type="hidden" id="search" name="fields[search][<?php  echo $field['id'];?>]" value="<?php  echo $field['search'];?>"></td>
					<td><select name="fields[bind][<?php  echo $field['id'];?>]" class="span2" disabled><?php  if(is_array($this->types)) { foreach($this->types as $k => $v) { ?><option value="<?php  echo $k;?>" <?php  if($field['bind'] == $k) { ?> selected<?php  } ?>><?php  echo $v;?></option><?php  } } ?></select></td>
					<td  style="text-align:right;"><a onclick="return confirm('删除操作不可恢复，确认吗？');return false;" href="<?php  echo $this->createWebUrl('struct', array('op' => 'delete', 'id' => $field['id'], 'type' => 'field', 'reid' => $field['reid']))?>" class="btn btn-small" title="删除"><i class="icon-remove"></i></a></td>
				</tr>
				<tr class="moresetting">
					<td></td>
					<td colspan="6">
						<div><textarea name="fields[description][<?php  echo $field['id'];?>]" style="width:820px; height:20px; margin-bottom:10px;" placeholder="请认真填写描述信息"><?php  echo $field['description'];?></textarea></div>
						<div><textarea name="fields[options][<?php  echo $field['id'];?>]" style="width:820px; height:20px;" placeholder="请认真填写扩展项信息，每个项目须用逗号分隔"><?php  echo $field['options'];?></textarea></div>
					</td>
				</tr>
				<?php  } ?>
			<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="7">
					<a href="javascript:;" onclick="addFormItem()"><i class="icon-plus-sign-alt"></i> 添加新项目</a>
				</td>
			</tr>
		</table>
		<div id="researchform" <?php  if(empty($search['isresearch'])) { ?>style="display:none;"<?php  } ?>>
			<h4>预约项管理</h4>
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th style="width:30px;" class="row-first">排序</td>
						<th style="width:100px;" class="row-hover">名称<i></i></th>
						<th style="width:100px;" class="row-hover">变量名 <span title="必填项" class="text-error">*</span><i></i></th>
						<th style="width:60px;">必填项<i></i></th>
						<th style="width:100px;">绑定会员资料<i></i></th>
						<th style="width:100px;">自定义类型<i></i></th>
						<th style="width:350px;">描述<i></i></th>
						<th style="text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody id="research-items">
				<?php  if(is_array($search['fields'])) { foreach($search['fields'] as $field) { ?>
					<?php  if($field['type'] == 2) { ?>
					<tr class="fields-new">
						<td><input type="text" class="span1" name="fields[displayorder][<?php  echo $field['id'];?>]" value="<?php  echo $field['displayorder'];?>"></td>
						<td><input type="text" class="span2 ntitle" name="fields[title][<?php  echo $field['id'];?>]" value="<?php  echo $field['title'];?>"></td>
						<td><input type="text" class="span2 nvariable" disabled name="fields[variable][<?php  echo $field['id'];?>]" value="<?php  echo $field['variable'];?>" placeholder="变量名切勿与以上所填重复"></td>
						<td><input type="checkbox" checkvalue="required" <?php  if($field['required']) { ?>checked<?php  } ?> title="查询项"><input type="hidden" id="required" name="fields[required][<?php  echo $field['id'];?>]"  value="<?php  echo $field['required'];?>"></td>
						<td><select name="fields[bind][<?php  echo $field['id'];?>]" class="span2 nbind"><option value="" class="bnull">不关联粉丝信息</option><?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?><option value="<?php  echo $v['field'];?>" <?php  if($field['bind'] == $v['field']) { ?> selected<?php  } ?>><?php  echo $v['title'];?></option><?php  } } ?></select></td>
						<td><select name="fields[field][<?php  echo $field['id'];?>]" class="span2 nfield"><option value="" class="fnull">请选择资料类型</option><?php  if(is_array($this->types)) { foreach($this->types as $k => $v) { ?><option value="<?php  echo $k;?>" <?php  if($field['bind'] == $k) { ?> selected<?php  } ?>><?php  echo $v;?></option><?php  } } ?></select></td>
						<td><input  name="fields[description][<?php  echo $field['id'];?>]" style="width:90%" type="text" value="<?php  echo $field['description'];?>"></td>
						<td style="text-align:right;"><a onclick="return confirm('删除操作不可恢复，确认吗？');return false;" href="<?php  echo $this->createWebUrl('struct', array('op' => 'delete', 'id' => $field['id'], 'type' => 'field'))?>" class="btn btn-small" title="删除"><i class="icon-remove"></i></a></td>
					</tr>
					<?php  } ?>
				<?php  } } ?>
				</tbody>
				<tr>
					<td colspan="6">
						<a href="javascript:;" onclick="addResearchItem()"><i class="icon-plus-sign-alt"></i> 添加新项目</a>
					</td>
				</tr>
			</table>
			<h4>预约处理状态管理</h4>
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th style="width:100px;" class="row-hover">名称<i></i></th>
						<th style="text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody id="status-items">
				<?php  if(is_array($search['status'])) { foreach($search['status'] as $field) { ?>
					<tr>
						<td><input  name="status[]" type="text" value="<?php  echo $field;?>"></td>
						<td style="text-align:right;"><a onclick="if (confirm('删除操作不可恢复，确认吗？')){$(this).parent().parent().next().remove();}return false;" href="<?php  echo $this->createWebUrl('struct', array('op' => 'delete', 'id' => $field['id'], 'type' => 'field'))?>" class="btn btn-small" title="删除"><i class="icon-remove"></i></a></td>
					</tr>
				<?php  } } ?>
				</tbody>
				<tr>
					<td colspan="6">
						<a href="javascript:;" onclick="addStatusItem()"><i class="icon-plus-sign-alt"></i> 添加新项目</a>
					</td>
				</tr>
			</table>
		</div>
		<table class="tb">
			<tr>
				<td colspan="6">
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">

	$(function(){
		$(".nbind").change(function(){
			if($(this).val() != '') {
				$(this).parents(".fields-new").find(".fnull").attr("selected",true);
			}
		});
		$(".nfield").change(function(){
			if($(this).val() != '') {
				$(this).parents(".fields-new").find(".bnull").attr("selected",true);
			}
		});
		
		$(':checkbox').each(function(){
			$(this).click(function(){
				if($(this).attr('checked') == 'checked') {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('1');
				} else {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('0');
				}
			});
		});
		//描述和扩展项
		$(".moresetting").delegate("textarea", "focus", function(){
			$(this).css("height", "90px");
		});
		$(".moresetting").delegate("textarea", "focusout", function() {
			$(this).css("height", "20px");
		});

		//预约隐藏控制
		isresearch();
		$('input[name="isresearch"]').click(function() {
			isresearch($(this).val());
		});
	});

	function isresearch(a) {
		if(typeof(a) == "undefined") var a = $('input[name="isresearch"][checked]').val();
		if(a == 1) {
			$('#researchform').show();
		} else {
			$('#researchform').hide();
		}
	}
	function addFormItem() {
		var html = '' +
				'<tr>' +
					'<td><input name="fields-new[displayorder][]" type="text" class="span1" /></td>' +
					'<td><input name="fields-new[title][]" type="text" class="span3" placeholder="请认真填写名称" /></td>' +
					'<td><input name="fields-new[variable][]" type="text" class="span3" placeholder="变量名切勿与以上所填重复" /></td>' +
					'<td><input type="checkbox" title="查询项" checkvalue="required" /><input type="hidden" name="fields-new[required][]" id="required" /></td>' +
					'<td><input type="checkbox" title="必填项" checkvalue="search" /><input type="hidden" name="fields-new[search][]" id="search" /></td>' +
					'<td>' +
						'<select name="fields-new[bind][]" class="span2">' +
						<?php  if(is_array($this->types)) { foreach($this->types as $k => $v) { ?><?php  if(!empty($v)) { ?>'<option value="<?php  echo $k;?>"><?php  echo $v;?></option>' + <?php  } ?><?php  } } ?>
						'</select>' +
					'</td>' +
					'<td><input type="hidden" name="fields-new[type][]" value="1" /><a href="javascript:;" onclick="$(this).parent().parent().next().remove();$(this).parent().parent().remove();" class="btn btn-small" title="删除"><i class="icon-remove"></i></a></td>'+
				'</tr>'+
				'<tr class="moresetting">'+
				'	<td></td>'+
				'	<td colspan="6">'+
				'		<div><textarea name="fields-new[description][]" onfocus="" onfocusout="" style="width:820px; height:20px; margin-bottom:10px;" placeholder="请认真填写描述信息"></textarea></div>'+
				'		<div><textarea name="fields-new[options][]" onfocus="" onfocusout="" style="width:820px; height:20px;" placeholder="请认真填写扩展项信息，每个项目须用逗号分隔"></textarea></div>'+
				'	</td>'+
				'</tr>';
		$('#form-items').append(html);
		$(':checkbox').each(function(){
			$(this).click(function(){
				if($(this).attr('checked') == 'checked') {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('1');
				} else {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('0');
				}
			});
		});
		//描述和扩展项
		$(".moresetting").delegate("textarea", "focus", function(){
			$(this).css("height", "90px");
		});
		$(".moresetting").delegate("textarea", "focusout", function() {
			$(this).css("height", "20px");
		});
	}

	function addResearchItem() {
		var html = '' +
				'<tr class="fields-new">' +
					'<td><input name="fields-new[displayorder][]" type="text" class="span1" /></td>' +
					'<td><input name="fields-new[title][]" type="text" class="span2 ntitle" /></td>' +
					'<td><input name="fields-new[variable][]" id="variable" type="text" class="span2 nvariable" placeholder="变量名切勿与以上所填重复" /></td>' +
					'<td><input type="checkbox" title="必填项" checkvalue="required" /><input type="hidden" name="fields-new[required][]" id="required" /></td>' +
					'<td>' +
						'<select id="fields-new[bind][]" name="fields-new[bind][]" class="span2 nbind" onchange="$(this).parent().parent().find(\'#variable\').val($(this).val())"><option value="" class="bnull">不关联粉丝信息</option>' +
						<?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?>'<option value="<?php  echo $v['field'];?>"><?php  echo $v['title'];?></option>' + <?php  } } ?>
						'</select>' +
					'</td>' +
					'<td><select name="fields-new[field][]" class="span2 nfield"><option value="" class="fnull">请选择资料类型</option><?php  if(is_array($this->types)) { foreach($this->types as $k => $v) { ?><option value="<?php  echo $k;?>"><?php  echo $v;?></option><?php  } } ?></select></td>'+
					'<td><input type="text" style="width:90%" name="fields-new[description][]"></td>' +
					'<td style="text-align:right;"><input type="hidden" name="fields-new[type][]" value="2" /><a href="javascript:;" onclick="$(this).parent().parent().remove();" class="btn btn-small" title="删除此条目"><i class="icon-remove"></i></a></td>' +
				'</tr>';
		$('#research-items').append(html);
		$(':checkbox').each(function(){
			$(this).click(function(){
				if($(this).attr('checked') == 'checked') {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('1');
				} else {
					$(this).parent().find(':hidden[id="'+$(this).attr('checkvalue')+'"]').val('0');
				}
			});
		});
		$(".nbind").change(function(){
			if($(this).val() != '') {
				$(this).parents(".fields-new").find(".fnull").attr("selected",true);
			}
		});
		$(".nfield").change(function(){
			if($(this).val() != '') {
				$(this).parents(".fields-new").find(".bnull").attr("selected",true);
			}
		});
	}
	

	function addStatusItem() {
		var html = '' +
				'<tr>' +
					'<td><input name="status[]" type="text" class="span3" /></td>' +
					'<td style="text-align:right;"><a href="javascript:;" onclick="$(this).parent().parent().remove();" class="btn btn-small" title="删除此条目"><i class="icon-remove"></i></a></td>' +
				'</tr>';
		$('#status-items').append(html);
	}
	
	function formcheck(){
		var bool = true;
		var colarr=new Array();
		var col;
		var vararr = new Array();
		var i;
		$(".fields-new").each(function(index){
			var value1 = $(this).children().find(".ntitle").val().trim();
			if(value1 == "") {
				message('预约项名称不能为空.', '', 'error');
				bool = false;
				return false;
			}
		    if(value1 !=""){
				for(col in colarr){
					if(colarr[col]==value1){
						message('预约项名称重复，请设置不同的预约项名称.', '', 'error');
						bool = false;
						return false;
					}		
				}
				colarr[index+1]=value1;	
			}	

		    var value2 = $(this).children().find(".nvariable").val().trim();
			if(value2 == "") {
				message('预约项变量名不能为空.', '', 'error');
				bool = false;
				return false;
			}
		    if(value2 !=""){
				for(i in vararr){
					if(vararr[i]==value2){
						message('预约项变量名重复，请设置不同的预约项变量名.', '', 'error');
						bool = false;
						return false;
					}		
				}
				vararr[index+1]=value2;	
			}	

			if($(this).children().find(".nbind").val() == "" && $(this).children().find(".nfield").val() == "") {
				message('绑定会员资料和自定义类型必选择一项.', '', 'error');
				bool = false;
				return false;
			}
			$(this).css('background','');
 		});
		return bool;
	}

</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
<div class="stat">
	<h4 class="sub-title">预约项管理</h4>
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:100px;">名称<i></i></th>
				<th style="width:350px;">描述<i></i></th>
				<th style="text-align:right;">操作</th>
			</tr>
		</thead>
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<tr>
				<td style="width:100px;"><?php  echo $item['title'];?></td>
				<td style="width:350px;"><?php  echo $item['description'];?></td>
				<td style="text-align:right;">
					<a href="<?php  echo $this->createWebUrl('content', array('op' => 'post', 'reid' => $item['id']))?>" data-toggle="tooltip" title="添加记录" class="btn btn-small"><i class="icon-plus"></i></a>
					<a href="<?php  echo $this->createWebUrl('content', array('op' => 'display', 'reid' => $item['id']))?>" data-toggle="tooltip" title="管理记录" class="btn btn-small"><i class="icon-table"></i></a>
					<?php  if($item['isresearch']) { ?><a href="<?php  echo $this->createWebUrl('research', array('op' => 'display', 'reid' => $item['id']))?>" data-toggle="tooltip" title="管理预约" class="btn btn-small"><i class="icon-list-alt"></i></a><?php  } ?>
					<a href="<?php  echo $this->createWebUrl('struct', array('op' => 'post', 'id' => $item['id']))?>" data-toggle="tooltip" title="管理结构" class="btn btn-small"><i class="icon-edit"></i></a>
					<a href="<?php  echo $this->createWebUrl('struct', array('op' => 'delete', 'id' => $item['id'], 'type' => 'item'))?>" data-toggle="tooltip" title="删除" class="btn btn-small"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php  } } ?>
	</table>
	<?php  echo $pager;?>
</div>
</div>
<script>
$(function() {
	$('.stat table a').tooltip();
});
</script>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>