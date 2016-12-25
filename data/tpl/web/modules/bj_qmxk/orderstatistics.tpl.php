<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">

	<li <?php  if($op == 'salereport') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'salereport'))?>">零售生意报告</a></li>
	<li <?php  if($op == 'orderstatistics' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'orderstatistics'))?>">订单统计</a></li>
	<li <?php  if($op == 'saledetails' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saledetails'))?>">商品销售明细</a></li>
	<li <?php  if(op == 'saletargets' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saletargets'))?>">销售指标分析</a></li>
	<li <?php  if($op == 'productsaleranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsaleranking'))?>">商品销售排行</a></li>
<li <?php  if($op == 'productsalestatistics') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsalestatistics'))?>">商品访问与购买比</a></li>
<li <?php  if($op == 'memberranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'memberranking'))?>">会员消费排行</a></li>
<li <?php  if($op == 'fansrange' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'fansrange'))?>">代理粉丝排行</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='user' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics'))?>">会员增长统计</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='agent' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics','usertype'=>'agent'))?>">代理增长统计</a></li>

</ul>
<style>
	.c_hidden {
clear: both;
display: none;
background-color: #f6faf1;
width: 100%;
}
	</style>
	<script>
		$(function(){
	$("#TabOrders tr").not(".table_title,.c_hidden").click(function(){

	            //$(this).next("tr").removeClass("c_hidden");
	            if($(this).next("tr").is(":hidden")){
	                $(this).next("tr").removeClass("c_hidden");
	                  
	            }else{
	                $(this).next("tr").addClass("c_hidden");
	            }     
	
	});
});
</script>
		
		</script>
<div class="main">

				<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<i class="icon-lightbulb"></i> 查询有购买记录客户的订单统计，您可以按时间查询客户的总订单数和总订单金额。
		</div>
		
		<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="op" value="orderstatistics" />
				<table class="table sub-search">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">会员名：</td>
			<td style="width:120px">
	<input name="realname" type="text"  class="span3" value="<?php  echo $realname;?>">
			</td>	
			<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">收货人：</td>
			<td style="width:120px">
			<input name="addressname" type="text"  class="span3" value="<?php  echo $addressname;?>">
			</td>
			<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">订单号：</td>
				<td>
			<input name="ordersn" type="text"  class="span3" value="<?php  echo $ordersn;?>">
			</td>
						</tr>
						
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">起始日期：</td>
			<td style="width:100px">
	<?php  if(!empty($start_time)) { ?>
				<?php  echo tpl_form_field_date2('start_time', date('Y-m-d',$start_time), false)?>
				<?php  } else { ?>  <?php  echo tpl_form_field_date2('start_time', date('Y-m-d',time()), false)?>
				<?php  } ?>
			</td>	
			<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">终止日期：</td>
			<td>
				<?php  if(!empty($end_time)) { ?>
				<?php  echo tpl_form_field_date2('end_time', date('Y-m-d',$end_time), false)?>
				<?php  } else { ?>  <?php  echo tpl_form_field_date2('end_time', date('Y-m-d',time()), false)?>
				<?php  } ?>
			</td>
			<td>&nbsp;</td>	<td>&nbsp;</td>
						</tr>
						
						<tr>
								<td></td>	
							<td><input type="submit" name="" value="查询" class="btn btn-primary" style="height:30px"></td><td></td>
									<td>	<button type="submit" name="orderstatisticsEXP01" value="orderstatisticsEXP01" class="btn btn-warning btn-lg">导出excel</button></td>	
							<td>
							</td>	<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</form>
		
		
	<div style="padding:10px;">

		<table class="table table-hover" id="TabOrders" style="width:100%;border-collapse:collapse;">
			<thead class="navbar-inner">
				<tr class="table_title">
					<th width="85"  >订单号</th>
					<th width="41" >下单时间</th>
				<th width="41" >总订单金额</th>
						<th width="42" >付款方式</th>
					<th width="42" >用户名</th>
					<th width="42" >收货人</th>
				</tr>
			</thead>
			<tbody>
		<?php  $index=0;$countmoney=0?>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<?php  $index++;?>
				<tr>
					<td><?php  echo $item['ordersn'];?></td>
					<td><?php  echo date('Y-m-d  H:i:s',$item['createtime'])?></td>
					<td><?php  $countmoney=$countmoney+$item['price']?> <?php  echo $item['price'];?><?php  if(!empty($item['dispatchprice'])&&$item['dispatchprice']>0 ) { ?>&nbsp;(运费：<?php  echo $item['dispatchprice'];?>)<?php  } ?></td>
					<td><?php  if($item['paytype'] == 1) { ?><span class="label label-important">余额支付</span><?php  } ?><?php  if($item['paytype'] == 2) { ?><span class="label label-important">在线支付</span><?php  } ?><?php  if($item['paytype'] == 3) { ?><span class="label label-warning">货到付款</span><?php  } ?></td>
						<td><?php  echo $item['realnamestr'];?></td>
						<td><?php  echo $item['tdrealname'];?></td>
				</tr>	
				
				<tr  style="background: #e0dcce;" class="c_hidden">
		
			<td colspan="6">
        <table width="100%">
        
         <tbody>
         				<?php  if(is_array($item['ordergoods'])) { foreach($item['ordergoods'] as $itemgoods) { ?>
         	<tr style="background: #e0dcce;">
         <td><img src="./resource/attachment/<?php  echo $itemgoods['thumb'];?>" style="border-width:0px;width: 200px; height: 150px;"></td>
         <td><span class="Name"><?php  echo $itemgoods['title'];?></span><br/> <span class="colorC">规格：<?php  echo $itemgoods['optionname'];?></span>
	      </td>
         <td>商品单价：<?php  echo $itemgoods['price'];?></td>
         <td>购买数量：<?php  echo $itemgoods['total'];?></td>
         <td>总价(元)：<strong class="colorG"><?php  echo round(($itemgoods['total']*$itemgoods['price']),2)?></strong></td>
        </tr>
        <?php  } } ?>
       
       
        </tbody></table>	   
	   </td></tr>	
	   <script>
	   	document.getElementById('i<?php  echo $item['ordersn'];?>').style.display='none';
	   	</script>
	   				<?php  } } ?>
			
				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" /></td>
			</tr>
			<h4 class="sub-title">
				<span>当前页共计<span style="color:red; "><?php  echo $index?></span>个,订单金额共计<span style="color:red; "><?php  echo $countmoney?></span>元</span>
		</h4>
		</table>
		
		<?php  echo $pager;?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/jquery-ui.css" />
<style type="text/css">a{color:#007bc4/*#424242*/; text-decoration:none;}a:hover{text-decoration:underline}ol,ul{list-style:none}body{height:100%; font:12px/18px Tahoma, Helvetica, Arial, Verdana, "\5b8b\4f53", sans-serif; color:#51555C;}img{border:none}.demo{width:500px; margin:20px auto}.demo h4{height:32px; line-height:32px; font-size:14px}.demo h4 span{font-weight:500; font-size:12px}.demo p{line-height:28px;}input{width:200px; height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3}pre{padding:6px 0 0 0; color:#666; line-height:20px; background:#f7f7f7}.ui-timepicker-div .ui-widget-header { margin-bottom: 8px;}.ui-timepicker-div dl { text-align: left; }.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }.ui-timepicker-div td { font-size: 90%; }.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }.ui_tpicker_hour_label,.ui_tpicker_minute_label,.ui_tpicker_second_label,.ui_tpicker_millisec_label,.ui_tpicker_time_label{padding-left:20px}</style>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-slide.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-timepicker-addon.js"></script><script type="text/javascript">
    $(function() {
        $('#start_time').timepicker({});
        $('#end_time').timepicker({});
    });
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>