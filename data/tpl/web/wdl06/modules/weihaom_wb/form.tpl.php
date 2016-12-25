<?php defined('IN_IA') or exit('Access Denied');?><input type="hidden" name="reply_id" value="<?php  echo $reply['id'];?>" />
<div class="alert alert-block alert-new">
	<h4 class="alert-heading">别踩白块儿游戏介绍</h4>
	<table>
		<tbody>
            <tr>
				<th>标题</th>
				<td>
					<input type="text" value="<?php  echo $reply['title'];?>" class="span5" name="title">
					<div class="help-block">用户发送关键词返回的图文主题。</div>
				</td>
			</tr>
			
			<tr>
				<th>封面</th>
				<td><?php  echo tpl_form_field_image('cover', $reply['cover'])?></td>
			</tr>
			
			<tr>
				<th>描述</th>
				<td>
					<textarea style="height:150px;" name="description" class="span7" cols="60"><?php  echo $reply['description'];?></textarea>
					<div class="help-block">用于图文显示的简介</div>
				</td>
			</tr>
			
		</tbody>
	
			<tr>
				<th>主题说明</th>
				<td>
					<input type="text" name="title1" id="title" class="span5" value="<?php  echo $reply['title1'];?>" />
				</td>
			</tr>
			<tr>
				<th>游戏说明</th>
					<td>
						<textarea name="description1" class="span6" cols="70" style="height:80px"><?php  echo $reply['description1'];?></textarea>
					</td>
			</tr>
			<tr>
				<th>前景图</th>
				<td>
					<?php  echo tpl_form_field_image('fimg', $reply['fimg']);?>
					<span class="help-block" style="clear:both">建议图片大小不超过300K(148*148),以免影响展示效果</span>		
				</td>
			</tr>	
			<tr>
				<th>后景图</th>
				<td>
					<?php  echo tpl_form_field_image('bimg', $reply['bimg']);?>
					<span class="help-block" style="clear:both">建议图片大小不超过300K(148*148),以免影响展示效果</span>		
				</td>
			</tr>
				
		</table>
	
</div>
<script type="text/javascript">
	KindEditor.ready(function(K) {
	var editor = KindEditor.editor({
		allowFileManager : true,
		uploadJson : "./index.php?act=attachment&do=upload",
		fileManagerJson : "./index.php?act=attachment&do=manager",
 
	});
	$("#file_upload-button").click(function() {
		editor.loadPlugin("multiimage", function() {
			editor.plugin.multiImageDialog({
				imageUrl : $("#upload-image-url-logo").val(),
				clickFn : function(urlList) {
						var div =$('#fileList');
						K.each(urlList, function(i, data) {
							html='<li class="imgbox"><a class="thumb_close" href="javascript:void(0)" title="删除"></a><input type="hidden" value="'+data.filename+'" name="thumb_url[]"><span class="item_box"><img src="'+data.url+'"></span></li>';
							div.append(html);
						});
						editor.hideDialog();
					}
		});
		});
	});
});	
	$("a.thumb_close").live("click ", function (n) {
	   $(this).parent().remove();
	});
	function validate() {
		if($.trim($(':text[name="title1"]').val()) == '') {
			message('必须填写主题说明.', '', 'error');
			return false;
		}
		if($.trim($('textarea[name="description1"]').val()) == '') {
			message('必须填写游戏说明.', '', 'error');
			return false;
		}
		if($.trim($(':text[name="fimg"]').val()) == '') {
			message('请上传前景图.', '', 'error');
			return false;
		}
		if($.trim($(':text[name="bimg"]').val()) == '') {
			message('请上传后景图.', '', 'error');
			return false;
		}
		return true;
	}
</script>
<script type="text/javascript">
kindeditor($('#rule'));
</script>
