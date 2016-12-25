<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<div class="alert alert-block alert-new">
	<table id="form" class="tb reply-news-edit">
		<tr>
			<th>标题</th>
			<td>
				<input type="text" id="title" class="span7" placeholder="" name="title" value="<?php  echo $setting['title'];?>">
			</td>
		</tr>
		<tr>
			<th>封面</th>
			<td>
				<!-- 此处增加class="reply-news-edit-cover-1"为编辑状态，反之则不显示封面图片，隐藏删除按钮 -->
				<div id="" class="uneditable-input reply-edit-cover">
					<div class="detail">
						<span class="pull-right">大图片建议尺寸：700像素 * 300像素</span>
						<input type="button" id="news-picture" fieldname="thumb" class="btn btn-mini reply-edit-cover-upload" value="<i class='icon-upload-alt'></i> 上传" style="" />
						<button type="button" class="btn btn-mini reply-news-edit-cover-remove" id="upload-delete" onclick="doDeleteItemImage(this, '<?php  echo create_url('site/module/deleteimage', array('name' => 'bj_qmxk'))?>')" style="<?php  if(empty($setting['picurl'])) { ?> display:none;<?php  } ?>"><i class="icon-remove"></i> 删除</button>
					</div>
					<input type="hidden" name="thumb_old" value="<?php  echo $news['picurl'];?>">
					<?php  if(!empty($setting)) { ?>
					<div id="upload-file-view" class="upload-view">
						<img width="100" src="<?php  echo $_W['attachurl'];?><?php  echo $setting['picurl'];?>">&nbsp;&nbsp;
					</div>
					<?php  } else { ?>
					<div id="upload-file-view" class="upload-view"></div>
					<?php  } ?>
				</div>
			</td>
		</tr>
		<tr>
			<th>描述</th>
			<td>
				<textarea style="height:80px;" class="span7" cols="70" id="description" name="description"><?php  echo $setting['description'];?></textarea>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
<!--
	kindeditor();
	$('.reply-edit-cover-upload').each(function(){
		kindeditorUploadBtn($(this));
	});
//-->
</script>
