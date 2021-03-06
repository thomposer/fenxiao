<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
.card{position:relative; width:300px; max-height:318px; overflow:hidden;}
.cardsn{position:absolute; color:#666; right:20px; bottom:10px; text-shadow:0 -1px 0 rgba(255, 255, 255, 0.5); font-size:16px;}
.cardtitle{position:absolute; right:20px; top:10px; color:#ffffff; font-size:16px; text-shadow:0 -1px 0 rgba(255, 255, 255, 0.5);}
.cardlogo{position:absolute; top:10px; left:20px;}
</style>
<div class="main">
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
	<h4>会员卡设置</h4>
	<table class="tb">
		<tr>
			<th><label for="">会员卡预览<span style="color:red">*</span></label></th>
			<td>
				<div class="card img-rounded">
					<div class="cardsn" style="<?php  if(!empty($setting['color']['number'])) { ?><?php  echo $setting['color']['number'];?><?php  } ?>"></div>
					<div class="cardtitle" style="<?php  if(!empty($setting['color']['title'])) { ?><?php  echo $setting['color']['title'];?><?php  } ?>"><?php  if(!empty($setting['title'])) { ?><?php  echo $setting['title'];?><?php  } ?></div>
					<div class="cardlogo"><img src="<?php  if(!empty($setting['logo'])) { ?><?php  echo $_W['attachurl'];?><?php  echo $setting['logo'];?><?php  } ?>"></div>
					<img class="cardbg" src="<?php  if(empty($setting['background']['image'])) { ?>./source/modules/member/images/card/1.png<?php  } else { ?>./source/modules/member/images/card/<?php  echo $setting['background']['image'];?>.png<?php  } ?>">
				</div>
			</td>
		</tr>
		<tr>
			<th><label for="">会员卡设置</label></th>
			<td>
				<div class="alert alert-block alert-new" id="cardmain">
					<table>
						<tr>
							<th><label for="">名称<span style="color:red">*</span></label></th>
							<td><input type="text" name="title" value="<?php  echo $setting['title'];?>" class="span5"></td>
						</tr>
						<tr>
							<th><label for="">名称颜色</label></th>
							<td>
								<?php  echo tpl_form_field_color('color-title', $setting['color']['title']);?>
							</td>
						</tr>
						<tr>
							<th><label for="">卡号颜色</label></th>
							<td>
								<?php  echo tpl_form_field_color('color-number', $setting['color']['number']);?>
							</td>
						</tr>
						<tr>
							<th><label for="">卡号设置<span style="color:red">*</span></label></th>
							<td>
								<input name="format" type="text" class="span3" value="<?php  echo $setting['format'];?>"/>
								<span class="help-block">
								<p>"*"代表任意随机数字，<span style="color:red">"#"代表流水号码, "#"必须连续出现,且只能存在一组.</span></p>
								<p>卡号规则样本："WQ2013*****#####***"</p>
								注意：规则位数过小会造成卡号生成重复概率增大，过多的重复卡密会造成卡密生成终止
								卡密规则中不能带有中文及其他特殊符号
								为了避免卡密重复，随机位数最好不要少于8位
								</span>
							</td>
						</tr>
						<tr>
							<th><label for="">背景图案</label></th>
							<td>
								<label for="isshow1" class="radio inline"><input type="radio" name="background" value="system" id="isshow1" onclick="$('#system').show();$('#user').hide();" <?php  if($setting['background']['background'] == 'system') { ?> checked<?php  } ?> autocomplete="off"> 系统</label>&nbsp;&nbsp;&nbsp;
								<label for="isshow2" class="radio inline"><input type="radio" name="background" value="user" id="isshow2" onclick="$('#system').hide();$('#user').show();" <?php  if($setting['background']['background'] == 'user') { ?> checked<?php  } ?> autocomplete="off"> 自定义</label>
								<span class="help-block"></span>
							</td>
						</tr>
						<tr id="system" <?php  if($setting['background']['background'] != 'system') { ?> style="display:none;"<?php  } ?>>
							<th></th>
							<td>
								<select style="width: 227px" class="input-large valid" id="select_bg" name="system-bg">
									<?php  for ($i=1; $i<=23; $i++) {?>
									<option value="<?php  echo $i;?>" <?php  if($setting['background']['image'] == $i) { ?> selected<?php  } ?>>背景<?php  echo $i;?></option>
									<?php  } ?>
								</select>
							</td>
						</tr>
						<tr id="user" <?php  if($setting['background']['background'] != 'user') { ?> style="display:none;"<?php  } ?>>
							<th></th>
							<td>
								<?php echo tpl_form_field_image('user-bg', $setting['background']['background'] == 'user' ? $setting['background']['image'] : '');?>
							</td>
						</tr>
						<tr>
							<th><label for="">LOGO</label></th>
							<td>
								<?php  echo tpl_form_field_image('logo', $setting['logo']);?>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<th><label for="">会员卡资料</label></th>
			<td>
				<div class="alert alert-block alert-new">
					<table class="table table-hover">
						<thead>
							<tr>
								<th style="min-width:200px;">资料名称</th>
								<th style="width:40px;">必填</th>
								<th style="width:160px;">关联默认值</th>
								<th style="width:120px;"></th>
							</tr>
						</thead>
						<tbody id="re-items">
							<?php  if(is_array($setting['fields'])) { foreach($setting['fields'] as $item) { ?>
								<tr>
									<td><input name="fields[title][]" type="text" class="span3" value="<?php  echo $item['title'];?>"/></td>
									<td><input type="checkbox" title="必填项"  <?php  if($item['require']) { ?> checked="checked"<?php  } ?>/></td>
									<td>
										<select name="fields[bind][]" class="span2">
											<?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?>
											<?php  if(!empty($v)) { ?>
											<option value="<?php  echo $k;?>"<?php  if($k == $item['bind']) { ?> selected="selected"<?php  } ?>><?php  echo $v;?></option>
											<?php  } ?>
											<?php  } } ?>
										</select>
										<input type="hidden" name="fields[require][]" value="<?php  if($item['require']) { ?>1<?php  } else { ?>0<?php  } ?>"/>
									</td>
									<td><?php  if(!$hasData) { ?><a href="javascript:;" class="icon-move" title="拖动调整此条目显示顺序" style="margin-top:10px;"></a> &nbsp; <a href="javascript:;" onclick="deleteItem(this)" class="icon-remove-sign" style="margin-top:10px;" title="删除此条目"></a><?php  } ?></td>
								</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
				<div class="alert alert-block alert-new">
					<a href="javascript:;" onclick="addItem();">添加填写项目 <i class="icon-plus-sign" title="添加填写项目"></i></a>
				</div>
				<span class="help-block">预约成功启动以后(已经有粉丝用户提交给预约信息), 将不能再修改调查项目, 请仔细编辑. </span>
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
</div>
<script type="text/javascript" src="./resource/script/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript">
<!--
	$(function(){
		$('#re-items').sortable({handle: '.icon-move'});
		$(':checkbox').each(function(){
			$(this).click(function(){
				if($(this).attr('checked') == 'checked') {
					$(this).parent().parent().find(':hidden[name="fields[require][]"]').val('1');
				} else {
					$(this).parent().parent().find(':hidden[name="fields[require][]"]').val('0');
				}
			});
		});
		//会员卡预览
		$('#cardmain').mouseover(function() {
			var a = $('input[name="title"]').val();
			var b = $('input[name="color-title"]').val();
			var c = $('input[name="color-number"]').val();
			var d = '卡号：'+$('input[name="format"]').val();
			if($("#system").css("display") != 'none') {
				var e = './source/modules/member/images/card/'+$('select[name="system-bg"]').val()+'.png';
				$('.cardbg').attr("src", e);
			} else if($("#user").css("display") != 'none') {
				var e = $('input[name="user-bg"]').val();
				$('.cardbg').attr("src", "<?php  echo $_W['attachurl'];?>"+e);
			}
			var f = "<?php  echo $_W['attachurl'];?>"+$('input[name="logo"]').val();
			$('.cardtitle').html(a).css("color", b);
			$('.cardsn').html(d).css("color", c);
			$('.cardlogo img').attr("src", f);
		});
	});
	function addItem() {
		var html = '' +
				'<tr>' +
					'<td><input name="fields[title][]" type="text" class="span3" /></td>' +
					'<td><input type="checkbox" title="必填项" /></td>' +
					'<td>' +
						'<select name="fields[bind][]" class="span2">' +
						<?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?><?php  if(!empty($v)) { ?>'<option value="<?php  echo $k;?>"><?php  echo $v;?></option>' + <?php  } ?><?php  } } ?>
						'</select>' +
						'<input type="hidden" name="fields[require][]" />' +
					'</td>' +
					'<td><a href="javascript:;" class="icon-move" title="拖动调整此条目显示顺序" style="margin-top:10px;"></a> &nbsp; <a href="javascript:;" onclick="deleteItem(this)" class="icon-remove-sign" style="margin-top:10px;" title="删除此条目"></a></td>' +
				'</tr>';
		$('#re-items').append(html);
	}
	function deleteItem(o) {
		$(o).parent().parent().remove();
	}
//-->
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>