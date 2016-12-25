<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>

<link rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
	<div class="main">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
		<h4>首页类型设置</h4>
		<table class="tb">
				<tr>
					<th>首页类型选择</th>
					<td>
						
						<label class="radio inline"><input type="radio"  name="ischeck" value="1" <?php  if($theone['ischeck'] == 1) { ?> checked="checked"<?php  } ?> /> 普通商城首页</label>
						<label class="radio inline"><input type="radio"  name="ischeck" value="0" <?php  if($theone['ischeck'] == 0) { ?> checked="checked"<?php  } ?> /> 单页面首页</label>
						<label class="radio inline"><input type="radio"  name="ischeck" value="2" <?php  if($theone['ischeck'] == 2) { ?> checked="checked"<?php  } ?> /> 店中店模式</label>
						<div class="help-block">如果选择普通商城，下方内容就是首页自定义区显示内容，如果选择单页面，那下方内容显示就是单页面内容！</div>
					</td>
		
				<tr>
					<th>单页面和首页自定义区</th>
					<td>
						<textarea id="terms" style="height:550px;" name="terms" class="span7" cols="60"><?php  echo $theone['terms'];?></textarea>
						<div class="help-block">单页面首页和首页自定义区域显示的内容，支持HTML代码！</div>
					</td>
				</tr>
			<tr>
					<th></th>
					<td>
						<input type="hidden"  name="id" value="<?php  echo $theone['id'];?>" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
					</td>
				</tr>
			</table>
		</form>
    </div>
<script>


			KindEditor.ready(function(K) {
				var editor;
			
					if (editor) {
						editor.remove();
						editor = null;
					}
					editor = K.create('textarea[name="terms"]', {
						allowFileManager : true,
		uploadJson : "./index.php?act=attachment&do=upload",
		fileManagerJson : "./index.php?act=attachment&do=manager",
						newlineTag : 'br'
					});
			
				
			});







</script>
	
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>

