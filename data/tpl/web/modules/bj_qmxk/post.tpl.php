<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
  <form action="<?php  echo $this->createWebUrl('Spread')?>" method="post" onsubmit="return shareHandler.doAdd(this)" class="form-horizontal form" enctype="multipart/form-data">
		

    <h4>专属二维码设置</h4>
		<table class="tb">
		<tr>
				<th><label for="">海报类型<span class="red">*</span></label></th>
				<td>
          <label for="msgtype1" class="radio inline"><input autocomplete="off" type="radio" name="msgtype"  id="msgtype1" value="1" 
          	<?php  if($item['msgtype']==1) { ?>checked="checked" <?php  } else { ?> <?php  if($item['msgtype']!=2) { ?> checked="checked"<?php  } ?><?php  } ?>> 商场首页</label>
					<label for="msgtype2" class="radio inline"><input autocomplete="off" type="radio" name="msgtype"   id="msgtype2" value="2"  <?php  if($item['msgtype']==2) { ?>checked="checked"<?php  } ?>> 关注公众号</label>
				
				</td>
			</tr>
			  <tr>
				<th><label for="">名称<span class="red">*</span></label></th>
				<td>
          <input type="text" id="title" name="title" class="span10" value="<?php  echo $item['title'];?>"  />
				</td>
			</tr>
      <tr>
				<th>背景图*</th>
				<td>
					<?php  echo tpl_form_field_image('bg', $item['bg']);?>
          <div class="help-block">图片格式必须为jpg，大小建议为：530像素 * 800像素，图片大小建议控制在200KB以内</div>
				</td>
			</tr>
          
		<tr>
				<th><label for="">生成期间等等的提示</label></th>
				<td>
          <input type="text" id="notice" name="notice" class="span10" value="<?php  echo $item['notice'];?>"  /> <div class="help-block">如果空则不给于提醒</div>
				</td>
			</tr>
			<tr>
				<th><label for="">二维码位置</label></th>
				<td>
					<label for="qrleft" class="checkbox inline" style="margin-right:15px;">左边距(px)</label>
					<input type="text" class="span1" placeholder="" name="qrleft" value="<?php  echo $item['qrleft'];?>">
					<label for="qrtop" class="checkbox inline" style="margin-right:15px;">上边距(px)</label>
					<input type="text" class="span1" placeholder="" name="qrtop" value="<?php  echo $item['qrtop'];?>">
					<label for="qrwidth" class="checkbox inline" style="margin-right:15px;">宽度(px)</label>
					<input type="text" class="span1" placeholder="" name="qrwidth" value="<?php  echo $item['qrwidth'];?>">
					<label for="qrheight" class="checkbox inline" style="margin-right:15px;">高度(px)</label>
					<input type="text" class="span1" placeholder="" name="qrheight" value="<?php  echo $item['qrheight'];?>">
				</td>
			</tr>
			<tr>
				<th><label for="">头像位置</label></th>
				<td>
					<label for="avatarenable" class="checkbox inline" style="margin-right:3px;">显示头像</label>
					<input type="checkbox" name="avatarenable" value="1" <?php  if($item['avatarenable']) { ?> checked<?php  } ?>></label>
					<label for="avatarleft" class="checkbox inline" style="margin-right:15px;">左边距(px)</label>
					<input type="text" class="span1" placeholder="" name="avatarleft" value="<?php  echo $item['avatarleft'];?>">
					<label for="avatartop" class="checkbox inline" style="margin-right:15px;">上边距(px)</label>
					<input type="text" class="span1" placeholder="" name="avatartop" value="<?php  echo $item['avatartop'];?>">
					<label for="avatarwidth" class="checkbox inline" style="margin-right:15px;">宽度(px)</label>
					<input type="text" class="span1" placeholder="" name="avatarwidth" value="<?php  echo $item['avatarwidth'];?>">
					<label for="avatarheight" class="checkbox inline" style="margin-right:15px;">高度(px)</label>
					<input type="text" class="span1" placeholder="" name="avatarheight" value="<?php  echo $item['avatarheight'];?>">
				</td>
			</tr>
			<tr>
				<th><label for="">姓名位置</label></th>
				<td>
					<label for="nameenable" class="checkbox inline" style="margin-right:3px;">显示姓名</label>
					<input type="checkbox" name="nameenable" value="1" <?php  if($item['nameenable']) { ?> checked<?php  } ?>></label>
					<label for="nameleft" class="checkbox inline" style="margin-right:15px;">左边距(px)</label>
					<input type="text" class="span1" placeholder="" name="nameleft" value="<?php  echo $item['nameleft'];?>">
					<label for="nametop" class="checkbox inline" style="margin-right:15px;">上边距(px)</label>
					<input type="text" class="span1" placeholder="" name="nametop" value="<?php  echo $item['nametop'];?>">
					<label for="namesize" class="checkbox inline" style="margin-right:15px;">字体大小(pt)</label>
					<input type="text" class="span1" placeholder="" name="namesize" value="<?php  echo $item['namesize'];?>">
				</td>
			</tr>
  
      <tr>
			<th></th>
			<td>
				<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		    <input type="hidden" name="channel" value="<?php  echo $item['channel'];?>" />
		    <input type="hidden" name="op" value="post" />
			</td>
		</tr>
		</table>
	</form>
</div>

<script type="text/javascript">
<!--
  kindeditor($('.richtext-clone'));

  var shareHandler = {
		'doAdd' : function(form) {
			var parent = $(form);
			if ($('#title', parent).val() == '') {
				message('请输入标题！', '', 'error');
				return false;
			}
			return true;
		},
	};
//-->
</script>


