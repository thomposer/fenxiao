<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<form action="" method="post" class="form-horizontal form">
	<div class="main">
		<h4>参数设置</h4>
		<table class="tb">
			<tr>
				<th>设置初始化粉丝数</th>
				<td>
				<input type="text" class="span6" placeholder="" name="n" value="<?php  echo $settings['n'];?>">
					<span class="help-block">便于准确统计，请到公众号后台查看，这里主要是用来校准关注人数的</span>
				</td>
			</tr>
			<tr>
				<th>用于封面描述内容</th>
				<td>
				<textarea style="height:200px; width:80%;" class="span7 richtext-clone" name="desc" cols="70" id="reply-add-text"><?php  echo $settings['desc'];?></textarea>
					<span class="help-block">可用参数：{name}为公众号名称，{numx}为会员号</span>
				</td>
			</tr>
		</table>	
	</div>
	<input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>