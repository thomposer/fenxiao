<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	
	<li <?php  if($op == 'create_express') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'create_express'));?>">新建快递单模板</a></li>
	<li <?php  if($op == 'express') { ?>class="active"<?php  } ?> <?php  if($op == 'edit_express') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'express'))?>">快递单模板管理</a></li>
	
	<li <?php  if($op == 'create_normal') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'create_normal'));?>">新建发货单打印模板</a></li>
	<li <?php  if($op == 'normal') { ?>class="active"<?php  } ?> <?php  if($op == 'edit_normal') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('printer', array('op' => 'normal'));?>">发货单打印模板管理</a></li>
	
</ul>

<link rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript"> 
　　String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) { 
　 if (!RegExp.prototype.isPrototypeOf(reallyDo)) { 
return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith); 
} else { 
return this.replace(reallyDo, replaceWith); 
} 
} 


</script> 
<div class="main">

 	    <form action=""  method="post" class="form-horizontal form">
 	    	<h4>发货单打印模板</h4>
			   	  <table class="tb">
			
			　<tr>
				<th>模板名称</th>
				<td><input name="print_name" type="text" value="<?php  echo $entry['name'];?>" />&nbsp;<a href="javascript:;" onclick="insertTemplate()">预设模板</a>	</td>
		　　</tr>
		<tr>
					<th>打印模板</th>
					<td>
								
						<table style="width:100%">
							<tr>
								<td style="width:80%">
								<textarea id="gmsptz" style="height:400px;width:100%" name="gmsptz" class="span7" cols="60" ><?php  echo $entry['printerconfig'];?>
									</textarea>
								</td>
								<td style="width:10px" ">
								</td>
										<td style="width:19%">
							购货人：{buyer} <br/>
							收货人姓名：{consignee} <br/>
							收货人电话：{tel}<br/>
							收货人地址：{address} <br/>
							支付方式：{pay_type}<br/>
							配送方式：{dispatch_type}<br/>
							 发货单号：{dispatch_sn}<br/>
							订单编号：{order_sn}<br/>
							下单时间：{time}<br/>
							订单商品列表(多行)：{good_line}<br/>
							订单总金额：{order_price}<br/>
							商品总金额：{good_price}<br/>
							配送费用：{dispatch_price}<br/>
							打印时间：{print_time}<br/>
								</td>
							</tr>
						</table>
				<br/>
					
							</td>
				</tr>
				<tr>
					<th></th>
				<td >
					
					<button name="submit" type="submit"  class="btn btn-primary span3" value="提交">提交</button>
					   <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</form>
						  <form action="" method="post" class="form-horizontal form" target="_blank" onsubmit="return priview()">
						  	
										<textarea id="previewtmp"  name="previewtmp"  cols="60" >
									</textarea>
					&nbsp&nbsp;&nbsp;	<button name="printview" type="submit"  class="btn btn-primary span3" value="提交" onmouseover="priview()" onclick="priview()">预览</button>
					
					   <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</form>
				</td>
			</tr>
			
		</table>

		

</div>

<textarea id="template1" style="display:none" name="template1" >
									

<style type="text/css">
body,td {font-size:13px;}
</style>

<h1 align="center">订单信息</h1>
<table width="100%" cellpadding="1">
    <tr>
        <td width="8%">购 货 人：</td><td>{buyer}</td>
        <td align="right">下单时间：</td><td>{time}</td>
        <td align="right">支付方式：</td><td>{pay_type}</td>
    </tr>
    <tr>
        <td width="8%">订单编号：</td><td>{order_sn}</td>
        <td align="right">配送方式：</td><td>{dispatch_type}</td>
        <td align="right">发货单号：</td><td>{dispatch_sn}</td>
    </tr>
    <tr>
        <td >收货地址：</td>
        <td colspan="5">
        {address}
        收货人：{consignee}&nbsp;
        <!-- 邮政编码 -->
        电话：{tel}&nbsp; <!-- 联系电话 -->
        <!-- 手机号码 -->
        </td>
    </tr>
</table>
<p>
{good_line}
</p>
<table width="100%" border="0">
    <tr align="right">
        <td>                       
        + 配送费用：￥{dispatch_price}元                        
        = 订单总金额：￥{good_price}元        </td>
    </tr>
    <tr align="right">
        <td>
        <!-- 如果已付了部分款项, 减去已付款金额 -->
        
        <!-- 如果使用了余额支付, 减去已使用的余额 -->
        
        <!-- 如果使用了积分支付, 减去已使用的积分 -->
        
        <!-- 如果使用了红包支付, 减去已使用的红包 -->
        
        <!-- 应付款金额 -->
        = 应付款金额：￥{order_price}元        </td>
    </tr>
</table>
<table width="100%" border="0">
            
    <tr><!-- 网店名称, 网店地址, 网店URL以及联系电话 -->
        <td>
        店铺地址：&nbsp;&nbsp;店铺电话：        </td>
    </tr>
    <tr align="right"><!-- 订单操作员以及订单打印的日期 -->
        <td>打印时间：{print_time}&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>
									 
									</textarea>
<script>
	document.getElementById("previewtmp").style.display="none";


function kindeditor2(selector, callback) {
	UE_SELECTOR.push(selector);
	if (UE_LOADING) {
		return false;
	}
	if (!UE) {
		UE_LOADING = true;
		$.getScript('./source/modules/bj_qmxk/recouse/ueditor.config.js', function(){
			$.getScript('./resource/script/ueditor/ueditor.all.min.js',function(){
				$.getScript('./resource/script/ueditor/lang/zh-cn/zh-cn.js',function(){
					UE_LOADING = false;
					UEditor(UE_SELECTOR, callback);
				});
			});
		});
	} else {
		UEditor(UE_SELECTOR, callback);
	}
}
	var editor;
	function ue_callback(obj, teditor)
	{
		editor=teditor;
	}
	
kindeditor2($('#gmsptz'),ue_callback);

	function priview()
	{
		document.getElementById("previewtmp").innerText=editor.getContent();
		return true;
	}
	
	function insertTemplate()
	{
		editor.setContent(document.getElementById('template1').innerText);	
	}

</script>