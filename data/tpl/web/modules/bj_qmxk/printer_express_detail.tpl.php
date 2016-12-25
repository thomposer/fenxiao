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
		
<script type="text/javascript" src="./source/modules/bj_qmxk/recouse/utils.js"></script>
<script type="text/javascript" src="./source/modules/bj_qmxk/recouse/transport.js"></script>
		
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

 	    <form action=""  method="post" id="theForm" name="theForm"  enctype="multipart/form-data" class="form-horizontal form">
 	    	<h4>快递单打印模板</h4>
			   	  <table class="tb">
			
			　<tr>
				<th>模板名称</th>
				<td><input name="print_name" type="text" value="<?php  echo $entry['name'];?>" />	</td>
		　　</tr>
		　<tr>
				<th>寄件公司</th>
				<td><input name="print_from_compy" type="text" value="<?php  echo $entry['print_from_compy'];?>" />	</td>
		　　</tr>
		　<tr>
				<th>寄件人</th>
				<td><input name="print_from_uname" type="text" value="<?php  echo $entry['print_from_uname'];?>" />	</td>
		　　</tr>
			　<tr>
				<th>寄件地址</th>
				<td><input name="print_from_addr" type="text" value="<?php  echo $entry['print_from_addr'];?>" />	</td>
		　　</tr>
			　<tr>
				<th>寄件电话</th>
				<td><input name="print_from_tel" type="text" value="<?php  echo $entry['print_from_tel'];?>" />	</td>
		　　</tr>
		<input name="expresscode" type="hidden" value="" />
					
		<tr>
					<th>打印模板</th>
					<td>
								<table width="100%" style="border-collapse:collapse;border-spacing:0;border:1px solid #888;">
									<tr>
										<td>
											       <table width="100%" cellpadding="0" cellspacing="0" border="0" height="50">
          <tr>
            <td >
              <select  onchange="javascript:call_flash('lable_add', this);">
                <option value="" selected="selected">--选择插入标签--</option>
                <option value="buyer">购货人</option>
                <option value="consignee">收货姓名</option>
                <option value="tel">收货电话</option>
                <option value="address">收货地址</option>
               <option value="pay_type">支付方式</option>
               <option value="dispatch_type">配送方式</option>
               <option value="dispatch_sn">发货单号</option>
               <option value="order_sn">订单编号</option>
               <option value="time">下单时间</option>
               <option value="time">订单金额</option>
               <option value="time">商品金额</option>
               <option value="dispatch_price">配送费用</option>
               <option value="print_time">打印时间</option>
               <option value="print_from_compy">寄件公司</option>
               <option value="print_from_uname">寄件人</option>
               <option value="print_from_addr">寄件地址</option>
               <option value="print_from_tel">寄件电话</option>
                   <option value="print_data_year">年</option>
               <option value="print_data_month">月</option>
               <option value="print_data_day">日</option>
                        </select>
              <input type="button" name="del" id="del" value="删除标签" onclick="javascript:call_flash('lable_del', this);">
            </td>
            <td >
              <input type="file" name="expresspic"  >
              <input type="submit"  name="picupload" value="上传打印单图片" onmouseover="innsert_flash_value()" onclick="innsert_flash_value()" >
              快递单图片大小：874px*483px
            </td>
             <td >
             	   <input type="hidden" name="old_expresspic" value="<?php  echo $entry['expresspic'];?>" >
              <input type="submit" name="delpic"   value="删除打印单图片" onmouseover="innsert_flash_value()" onclick="innsert_flash_value()"  >
            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
											
										</td>
									</tr>
										<tr>
										<td>
											
											<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="1024" height="600" id="test">
      <param name="movie" value="../data/print/pint.swf">
      <param name="quality" value="high">
      <param name="menu" value="false">
      <param name="wmode" value="transparent">
      <param name="FlashVars" value="bcastr_config_bg=<?php  if(!empty($entry['expresspic'])) { ?><?php  echo "http://".$_SERVER['HTTP_HOST']?>/resource/attachment/<?php  echo $entry['expresspic'];?><?php  } ?>&swf_config_lable=<?php  echo $entry['printerconfig'];?>">
      <param name="allowScriptAccess" value="sameDomain"/>
      <embed src="./source/modules/bj_qmxk/recouse/pint.swf" wmode="transparent" FlashVars="bcastr_config_bg=<?php  if(!empty($entry['expresspic'])) { ?><?php  echo "http://".$_SERVER['HTTP_HOST']?>/resource/attachment/<?php  echo $entry['expresspic'];?><?php  } ?>&swf_config_lable=<?php  echo $entry['printerconfig'];?>" menu="false" quality="high" width="1024" height="600" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" allowScriptAccess="sameDomain" name="test" swLiveConnect="true"/>
      </object>
													<textarea id="printerconfig"  name="printerconfig" value="<?php  echo $entry['printerconfig'];?>"  style="display:none"  >
									</textarea>
										</td>
									</tr>
								</table>
				
				
				
				
					
							</td>
				</tr>
				<tr>
					<th></th>
				<td >
					
					<button name="submit" type="submit"  class="btn btn-primary span3" value="提交" onmouseover="innsert_flash_value()" onclick="innsert_flash_value()">提交</button>
					   <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				
						
				</td>
			</tr>
			
		</table>

				</form>

</div>

<script>





<!--
var display_yes = (Browser.isIE) ? 'block' : 'table-row-group';
/**
 * 与模板Flash编辑器通信
 */
function call_flash(type, currt_obj)
{
  //获取flash对象
  var obj = this_obj("test");

  //执行操作
  switch (type)
  {
    case 'bg_delete': //删除打印单背景图片

      var result_del = obj.bg_delete();

      //执行成功 修改页面上传窗口为显示 生效
      if (result_del)
      {
        document.getElementById('pic_control_upload').style.display = display_yes;
        document.getElementById('pic_control_del').style.display = 'none';

        var the_form = this_obj("theForm");
        the_form.bg.disabled = "";
        the_form.bg.value = "";
        the_form.upload.disabled = "";
        the_form.upload_del.disabled = "disabled";
      }

    break;

    case 'bg_add': //添加打印单背景图片

      var result_add = obj.bg_add(currt_obj);

      //执行成功 修改页面上传窗口为隐藏 失效
      if (result_add)
      {
        document.getElementById('pic_control_upload').style.display = 'none';
        document.getElementById('pic_control_del').style.display = display_yes;

        var the_form = this_obj("theForm");
        the_form.bg.disabled = "disabled";
        the_form.upload.disabled = "disabled";
        the_form.upload_del.disabled = "";
      }

    break;

    case 'lable_add': //插入标签

      if (typeof(currt_obj) != 'object')
      {
        return false;
      }

      if (currt_obj.value == '')
      {
        alert(no_select_lable);

        return false;
      }

      var result = obj.lable_add('t_' + currt_obj.value, currt_obj.options[currt_obj.selectedIndex].text, 150, 50, 20, 100, 'b_' + currt_obj.value);
      if (!result)
      {
        alert(no_add_repeat_lable);

        return false;
      }

    break;

    case 'lable_del': //删除标签

      var result_del = obj.lable_del();

      if (result_del)
      {
        //alert("删除成功！");
      }
      else
      {
        alert(no_select_lable_del);
      }

    break;

    case 'lable_Location_info': //获取标签位置信息

      var result_info = obj.lable_Location_info();

      return result_info;

    break;
  }

  return true;

}
function innsert_flash_value()
{
document.getElementById("printerconfig").innerText= call_flash('lable_Location_info', '');	
}

/**
 * 获取页面Flash编辑器对象
 */
function this_obj(flash_name)
{
  var _obj;

  if (Browser.isIE)
  {
      _obj = window[flash_name];
  }
  else
  {
      _obj = document[flash_name];
  }

  if (typeof(_obj) == "undefined")
  {
    _obj = document[flash_name];
  }
  
  return _obj;

}
</script>