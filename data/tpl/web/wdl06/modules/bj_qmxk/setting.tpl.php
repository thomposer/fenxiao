<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>

<link rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
<div class="main">
 
    <form action="" method="post" class="form-horizontal form">
      

		<h4>商城设置</h4>
        <table class="tb">
        		<!--  <tr>
                <th>授权</th>
                <td>
                   <a href="<?php  echo $this->createWebUrl('auth', array('op' => 'doauth'))?>">同步授权</a>
                </td>
            </tr> -->
            	 <tr>
                <th>订单自动确认收货</th>
                <td>
                    <input type="text" name="autofinish" class="span1" value="<?php  echo $settings['autofinish'];?>"  />
                    	<div class="help-block">为空或者0则不开启订单自动确认收货功能！根据发货时间计算。单位：天</div>
                </td>
            </tr>
					 	<tr>
					<th>退换货期限</th>
					<td>
						<input type="text" id="rebacktime" name="rebacktime" class="span1" cols="60" value="<?php  echo $settings['rebacktime'];?>" />
						<div class="help-block">退换货申请所需要的周期，单位：天，该数字不能大于或者等于佣金申请周期</div>
					</td>
				</tr>
			<tr>
                <th>未关注引导页面</th>
                <td>
                    <input type="text" name="ydyy" class="span7" value="<?php  echo $settings['ydyy'];?>" /> 请到把引导页面链接缩短成短网址形式，以防止报错！<a target="_blank" href="http://www.dwz.cn">百度短网址</a>
                </td>
            </tr>
            	<tr>
                <th>商城首页标题</th>
                <td>
                    <input type="text" name="shopname" class="span2" value="<?php  echo $settings['shopname'];?>" />
                </td>
            </tr>
           <tr>
					<th>帮助说明</th>
					<td>
						<textarea id="rule" style="height:150px;" name="rule" class="span7" cols="60"><?php  echo $theone['rule'];?></textarea>
						<div class="help-block">个人中心帮助说明和我要分销链接底部的相关说明</div>
					</td>
				</tr>
				<tr>
					<th>帮助说明引用链接</th>
					<td>
						<input type="text" id="clickcredit1" name="clickcredit1" class="span7" cols="60" value="<?php  echo $_W['siteroot'].$this->createMobileUrl('rule')?>" />
						<div class="help-block">在微信公众号自定义菜单上面直接引用该链接</div>
					</td>
				</tr>
            	 <tr>
                <th>底部版权</th>
                <td>
                   名称： <input type="text" name="footer" class="span2" value="<?php  echo $settings['footer'];?>" /> 链接: <input type="text" name="footerurl" class="span3" value="<?php  echo $settings['footerurl'];?>" /> 
                </td>
            </tr>
            	 <tr>
                <th style="width:160px">快商客服：</th>
                <td>
                	<input type="text" name="kfcode" class="span9" value="<?php  echo $settings['kfcode'];?>" />
                </td>
            </tr>
			
			<tr>
                <th>客服QQ：</th>
                <td>
                    <input type="text" name="qq" class="span2" value="<?php  echo $settings['qq'];?>"  />
                    	<div class="help-block">客服QQ号码！</div>
                </td>
            </tr>
			
			
			
			
			
			</table>
		 <h4>分销参数设置</h4>
        <table class="tb">
        	<tr>
				<th>成为代理条件</th>
				<td>
					
				<label class="radio inline"><input type="radio"  name="promotertimes" value="1" <?php  if($theone['promotertimes'] == 1) { ?> checked="checked"<?php  } ?> /> 无条件</label>
				<label class="radio inline"><input type="radio"  name="promotertimes" value="0" <?php  if($theone['promotertimes'] == 0) { ?> checked="checked"<?php  } ?> /> 购买一单</label>
				<label class="radio inline"><input type="radio"  name="promotertimes" value="2" <?php  if($theone['promotertimes'] == 2) { ?> checked="checked"<?php  } ?> /> 达到单数</label>
				<input type="text"  name="promotercount" class="span1" cols="60" value="<?php  echo $theone['promotercount'];?>" />
				<label class="radio inline"><input type="radio"  name="promotertimes" value="3" <?php  if($theone['promotertimes'] == 3) { ?> checked="checked"<?php  } ?> /> 达到金额</label>
			
					<input type="text"  name="promotermoney" class="span1" cols="60" value="<?php  echo $theone['promotermoney'];?>" />
				
					<div class="help-block">选择成为代理的条件，默认注册账号后无条件成为代理！</div>
				</td>
			</tr>
			
        	<tr>
				<th>成为代理订单状态</th>
				<td>
				<label class="radio inline"><input type="radio"  name="orderstatus" value="1" <?php  if($settings['orderstatus'] == 1) { ?> checked="checked"<?php  } ?> /> 支付完成</label>
				<label class="radio inline"><input type="radio"  name="orderstatus" value="0" <?php  if($settings['orderstatus'] == 0) { ?> checked="checked"<?php  } ?> /> 订单完成</label>
				<div class="help-block">选择成为代理的订单状态，与上两条叠加使用！</div>
				</td>
			</tr>			
			
			<tr>
                <th>佣金打款限额</th>
                <td>
                    <input type="text" name="zhifuCommission" class="span1" value="<?php  echo $settings['zhifuCommission'];?>"  />
                    	<div class="help-block">满足此金额的佣金才能打款！</div>
                </td>
            </tr>
			<tr>
				<th>佣金申请周期</th>
				<td>
					<input type="text" id="commtime" name="commtime" class="span1" cols="60" value="<?php  echo $settings['commtime'];?>" />
					<div class="help-block">申请佣金所需要的周期，单位：天</div>
				</td>
			</tr>
					
            	
			<tr>
				<th>点击或扫描积分</th>
				<td>
					<input type="text" id="clickcredit" name="clickcredit" class="span1" cols="60" value="<?php  echo $theone['clickcredit'];?>" />
					<div class="help-block">通过分布到朋友圈或是直接分享到朋友的链接，或是通过扫描分享的二维码图片过来的粉丝，一次增加多少积分。</div>
				</td>
			</tr>
			<tr>
            	<th>分佣方式</th>
            	<td>
					<script>
						var type1=<?php  if($settings['commissionType'] == 0||empty($settings['commissionType'])) { ?>true<?php  } else { ?>false<?php  } ?>;
						var type2=<?php  if($settings['commissionType'] == 1) { ?>true<?php  } else { ?>false<?php  } ?>;
					</script>
					<label class="radio inline"><input type="radio" id="commissionType1"   name="commissionType" value="0"  onchange="type2=false;if(type1==true){type1=false;return;}if(confirm('分佣模式即将改变成【省钱模式】，数据变动较大，是否确认更改')){document.getElementById('commissionType2').checked=false;document.getElementById('commissionType1').checked=true;}else{document.getElementById('commissionType1').checked=false;document.getElementById('commissionType2').checked=true;}" <?php  if($settings['commissionType'] == 0||empty($settings['commissionType'])) { ?> checked="checked"<?php  } ?> /> 普通模式</label>（<a onclick="document.getElementById('s1').style.display='block';document.getElementById('s2').style.display='block';document.getElementById('s3').style.display='none';document.getElementById('s4').style.display='none';">点击查看说明</a>） 
					<label class="radio inline"><input type="radio" id="commissionType2" name="commissionType" value="1" onchange="type1=false;if(type2==true){type2=false;return;}if(confirm('分佣模式即将改变成【省钱模式】，数据变动较大，是否确认更改')){document.getElementById('commissionType1').checked=false;document.getElementById('commissionType2').checked=true;}else{document.getElementById('commissionType2').checked=false;document.getElementById('commissionType1').checked=true;}"  <?php  if($settings['commissionType'] == 1) { ?> checked="checked"<?php  } ?> /> 省钱模式</label>（<a  onclick="document.getElementById('s3').style.display='block';document.getElementById('s4').style.display='block';document.getElementById('s1').style.display='none';document.getElementById('s2').style.display='none';">点击查看说明</a>）
				</td>
				<tr style="color:#595959;">
					<th><span id="s1">普通模式说明：</span><span id="s3">省钱模式说明：</span></th>
					<td>
						<span id="s2" style="width:850px">
			按照商品的销售价格来分佣金，三个级别都是这样。比如：比如按商品100的销售价来算，一级代理佣金15% 二级代理佣金10% 三级代理佣金5%，结算的时候，一级拿到15元，二级拿到10元，三级拿到5元，商家总支出30元。
						</span>
						<span id="s4" style="width:850px">
							按照上级获取的佣金，来计算下级的佣金比例，帮商家省下更少的佣金支出。比如：假设商品单价100，一级设置10%，二级也是10%，三级也是10%，那一级可以抽取10块钱佣金（100*10%），二级可以抽取1块钱佣金（10*10%），三级可以抽取0.1元佣金（1*10%），那商家总共要支出佣金是11.1元（10+1+0.1）
						</span>
					</td>
				</tr>
					<script>
					 	document.getElementById('s1').style.display='none';
					 	document.getElementById('s2').style.display='none';
					 	document.getElementById('s3').style.display='none';
					 	document.getElementById('s4').style.display='none';
					</script>
					 
            <tr>
                <th>分销等级</th>
                <td>
                   	<select  class="span3" name="globalCommissionLevel" id="globalCommissionLevel" onchange="changecommission(this)">
						<option value="1" >等级1</option>
						<option value="2" >等级2</option>
						<option value="3" >等级3</option>
				 
					</select>
			
                </td>
            </tr>
            <tr>
                <th>1级整站佣金</th>
                <td>
                    <input type="text" name="globalCommission" class="span1" value="<?php  echo $settings['globalCommission'];?>"  />%
                </td>
            </tr>
            <tr>
                <th ><span id='tr2_1'>2级整站佣金</span></th>
                <td  ><span id='tr2_2'>
                    <input type="text" name="globalCommission2" class="span1" value="<?php  echo $settings['globalCommission2'];?>"  /><span style="dispaly:inline">%</span></span>
                </td>
            </tr>
            <tr id='tr3'>
                <th  style="min-width:60px"><span id='tr3_1'>3级整站佣金</span></th>
                <td  style="min-width:60px"><span id='tr3_2'>
                    <input type="text" name="globalCommission3" class="span1" value="<?php  echo $settings['globalCommission3'];?>" /><span style="dispaly:inline">%</span></span>
                </td>
            </tr>
            			<script>
							function changecommission(select)
							{
									if(select.value>=1)
								{
									document.getElementById('tr2_1').style.display="none";
									document.getElementById('tr2_2').style.display="none";
									
										document.getElementById('tr3_1').style.display="none";
										document.getElementById('tr3_2').style.display="none";
								}
								
								if(select.value>=2)
								{
									document.getElementById('tr2_1').style.display="block";
									document.getElementById('tr2_2').style.display="block";
											
								}
									if(select.value>=3)
								{
										document.getElementById('tr3_1').style.display="block";
										document.getElementById('tr3_2').style.display="block";
								}
							}
							document.getElementById('globalCommissionLevel').value="<?php echo $settings['globalCommissionLevel']?$settings['globalCommissionLevel']:'3'?>";
				 changecommission(document.getElementById('globalCommissionLevel'));
						
							</script>
							
			   <tr>
                <th>转发图片：</th>
                <td>
                    <?php  echo tpl_form_field_image('logo', $settings['logo']);?>
                </td>
            </tr>
		 <tr>
                <th>转发话术：</th>
                <td>
                	   	<input type="text" name="description" class="span9" value="<?php  echo $settings['description'];?>" />
                </td>
            </tr>
			<!--<tr>
                <th>首页限时特卖<br>显示条数</th>
                <td>
                    <input type="text" name="indexss" class="span1" value="<?php  echo $settings['indexss'];?>" />
                </td>
            </tr>-->
        </table>
       <!-- <h4>商城信息</h4>
        <table class="tb">
            <tr>
                <th>品牌名称</th>
                <td>
                   
                </td>
            </tr>

            <tr>
                <th><label for="">官方网址</label></th>
                <td>
                    <input type="text" name="officialweb" class="span6" value="<?php  echo $settings['officialweb'];?>" />
                </td>
            </tr>				
        				
           	
               <tr>
                <th>联系电话：</th>
                <td><input type="text" id="phone" name="phone"  class="span7" value="<?php  echo $settings['phone'];?>"> </td>
            </tr>
            <tr>
                <th>所在地址：</th>
                <td><input type="text" id="address" name="address"  class="span7" value="<?php  echo $settings['address'];?>"> </td>
            </tr>
          
      
          <tr>
                <th></th>
                <td>
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>-->
	
 
    
			<table class="tb">
				<!--<h4>借用高级认证</h4>　　<tr>
				<th>AppId：</th>
				<td><input type="text" name="appid" class="span3" value="<?php  echo $settings['appid'];?>" /></td>
		　　</tr>
			<tr>
				<th>AppSecret：</th>
				<td><input type="text" name="secret" class="span5" value="<?php  echo $settings['secret'];?>" /></td>
			</tr>			
			<tr>
				<th colspan="2">
					<div class="help-block">借用说明：必需设置借用高级认证号的"网页授权获取用户基本信息"的回调域名为你公众号第三方平台的全域名。
					如：你的域名为：weixin.baijiaweixin.com.cn ，你必需让借用高级认证号设置"网页授权获取用户基本信息"的回调域名为:weixin.baijiaweixin.com.cn</div>
				</th>
			</tr>
			
			<tr>
				<th colspan="2">
					<div class="help-block">使用的AppId和AppSecret在 [开发者中心]，可以找到。</div>
				</th>
			</tr>-->
			<!--<tr>
				<th colspan="2"><a href="./source/modules/hldpm/template/image/help.jpg" target='_blank'><img src="./source/modules/hldpm/template/image/help.jpg" width="500"></a></th>
			</tr>		-->	
			<tr>
				<th colspan="2">
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
					   <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</th>
			</tr>
	</table>

    </form>
</div>
<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="./resource/script/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
 
<script type="text/javascript">
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

//kindeditor($('#terms'));

kindeditor($('#rule'));

</script>


<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>