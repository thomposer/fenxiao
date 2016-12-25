<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
<?php  if(empty($shareid)) { ?>
	<li <?php  if($operation == 'display' && $status == '1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1,'from_user'=>$_GPC['from_user']))?>">待发货</a></li>
	<li <?php  if($operation == 'display' && $status == '0') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 0,'from_user'=>$_GPC['from_user']))?>">待付款</a></li>
	<li <?php  if($operation == 'display' && $status == '2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 2,'from_user'=>$_GPC['from_user']))?>">待收货</a></li>
	<li <?php  if($operation == 'display' && $status == '3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 3,'from_user'=>$_GPC['from_user']))?>">已完成</a></li>
	<li <?php  if($operation == 'display' && $status == '-2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -2,'from_user'=>$_GPC['from_user']))?>">退款中</a></li>
<li <?php  if($operation == 'display' && $status == '-3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -3,'from_user'=>$_GPC['from_user']))?>">换货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-4') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -4,'from_user'=>$_GPC['from_user']))?>">退货中</a></li>
		<li <?php  if($operation == 'display' && $status == '-1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -1,'from_user'=>$_GPC['from_user']))?>">已关闭</a></li>
	<li <?php  if($operation == 'display' && $status == '-99') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -99,'from_user'=>$_GPC['from_user']))?>">全部订单</a></li>
<?php  } else { ?>
		<li <?php  if($operation == 'display' && $status == '1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1,'shareid' => $_GPC['shareid']))?>">待发货</a></li>
	<li <?php  if($operation == 'display' && $status == '0') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 0,'shareid'=>$_GPC['shareid']))?>">待付款</a></li>
	<li <?php  if($operation == 'display' && $status == '2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 2,'shareid'=>$_GPC['shareid']))?>">待收货</a></li>
	<li <?php  if($operation == 'display' && $status == '3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 3,'shareid'=>$_GPC['shareid']))?>">已完成</a></li>
	<li <?php  if($operation == 'display' && $status == '-2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -2,'shareid'=>$_GPC['shareid']))?>">退款中</a></li>
<li <?php  if($operation == 'display' && $status == '-3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -3,'shareid'=>$_GPC['shareid']))?>">换货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-4') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -4,'shareid'=>$_GPC['shareid']))?>">退货中</a></li>
		<li <?php  if($operation == 'display' && $status == '-1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -1,'shareid'=>$_GPC['shareid']))?>">已关闭</a></li>
	<li <?php  if($operation == 'display' && $status == '-99') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -99,'shareid'=>$_GPC['shareid']))?>">全部订单</a></li>

	<?php  } ?>
</ul>

<?php  if($operation == 'display') { ?>
<form action="" target="_blank">
	<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="order" />
				<input type="hidden" name="op" value="normal_print" />
	<input type="hidden" name="print_orderid" id="print_orderid" value="" />
		<div id="modal-normalprint" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
			<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>发货单打印</h3></div>
			<div class="modal-body">
				<table class="tb">
					<tr>
						<th><label for="">打印模板</label></th>
						<td>
								<select name="print_modle_id"  >
				<?php  if(is_array($normal_order_list)) { foreach($normal_order_list as $item) { ?>
<option value="<?php  echo $item['id'];?>" data-name=""><?php  echo $item['name'];?></option>

				<?php  } } ?>
                                        </select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer"><button type="submit"  class="btn btn-primary span2" name="do_normal_print" >打印</button>&nbsp;<button type="button"  aria-hidden="true" data-dismiss="modal" class="btn span2"  type="button">关闭</button></div>
		</div>
</form>

<form action="" target="_blank">
	<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="order" />
				<input type="hidden" name="op" value="express_print" />
	<input type="hidden" name="print_express_orderid" id="print_express_orderid" value="" />
		<div id="modal-expressprint" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
			<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>快递单打印</h3></div>
			<div class="modal-body">
				<table class="tb">
					<tr>
						<th><label for="">打印模板</label></th>
						<td>
								<select name="print_modle_id"  >
				<?php  if(is_array($express_order_list)) { foreach($express_order_list as $item) { ?>
<option value="<?php  echo $item['id'];?>" data-name=""><?php  echo $item['name'];?></option>

				<?php  } } ?>
                                        </select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer"><button type="submit"  class="btn btn-primary span2" name="do_normal_print" >打印</button>&nbsp;<button type="button"  aria-hidden="true" data-dismiss="modal" class="btn span2"  type="button">关闭</button></div>
		</div>
</form>

<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="order" />
				<input type="hidden" name="op" value="display" />
					<input type="hidden" name="status" value="<?php  echo $status;?>" />
				<table class="table sub-search">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">订单编号：</td>
			<td style="width:100px">
<input name="ordersn" type="text" value="<?php  echo $param_ordersn;?>" />
			</td>	
			<td style="width:50px"><input type="submit" name="" value="查询" class="btn btn-primary"></td>
			<td style="width:100px"><button type="submit" name="orderstatisticsEXP01" value="orderstatisticsEXP01" class="btn btn-warning btn-lg">导出excel</button>
			</td>
			
			<td >&nbsp;</td>
						</tr>
			
						
					</tbody>
				</table>
				
	</form>
			
<div class="main">
	<div >
	
	
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:80px;">订单编号</th>
					<th style="width:100px;">收货人姓名</th>
					<th style="width:80px;">联系电话</th>
					<th style="width:80px;">支付方式</th>
					<?php  if(empty($shareid)) { ?>
					<th style="width:50px;">运费</th>			
                    <?php  } ?>
					<th style="width:50px;">总价</th>             
<!--				<th style="width:50px;">类型</th>-->
					<th style="width:50px;">状态</th>
					<th style="width:110px;">下单时间</th>
					<?php  if(!empty($shareid)) { ?>
						<th style="width:50px;">1级佣金</th>	<?php  if($cfg['globalCommissionLevel']>=2) { ?>		
					<th style="width:50px;">2级佣金</th>	    <?php  } ?>	<?php  if($cfg['globalCommissionLevel']>=3) { ?>		
						<th style="width:50px;">3级佣金</th>			  <?php  } ?>	
                    <?php  } ?>
					<?php  if(empty($shareid)) { ?>
					<th style="width:160px;">操作<?php  if($status==1) { ?>&nbsp;&nbsp;<button type="buttom" onclick="location.href='<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1,'dobatch'=>1))?>';" name="sendbatexpress" value="sendbatexpress" class="btn btn-warning btn-lg">批量发货</button><?php  } ?></th>
					<?php  } ?>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['ordersn'];?></td>
					<td><?php  echo $address[$item['addressid']]['realname'];?></td>
					<td><?php  echo $address[$item['addressid']]['mobile'];?></td>
					<td><?php  if($item['paytype'] == 1) { ?><span class="label label-important">余额支付</span><?php  } ?><?php  if($item['paytype'] == 2) { ?><span class="label label-important">在线支付</span><?php  } ?><?php  if($item['paytype'] == 3) { ?><span class="label label-warning">货到付款</span><?php  } ?></td>
					<?php  if(empty($shareid)) { ?>
                                        <td><?php  echo $item['dispatchprice'];?></td>
					<?php  } ?>
					<td><?php  echo $item['price'];?> 元</td>
<!--					<td><?php  if($item['goodstype']) { ?>实物<?php  } else { ?>虚拟<?php  } ?></td>-->
					<td>
							<?php  if($item['status'] == 0) { ?><span class="label label-warning" >待付款</span><?php  } ?>
						<?php  if($item['status'] == 1) { ?><span class="label label-important" >待发货</span><?php  } ?>
						<?php  if($item['status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
							<?php  if($item['status'] ==3) { ?><span class="label label-success" >已完成</span><?php  } ?>
							<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
							<?php  if($item['status'] == -2) { ?><span class="label label-important">退款中</span><?php  } ?>
							<?php  if($item['status'] == -3) { ?><span class="label label-important">换货中</span><?php  } ?>
							<?php  if($item['status'] ==-4) { ?><span class="label label-important">退货中</span><?php  } ?>
							<?php  if($item['status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($item['status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
						
						</td>
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<?php  if(!empty($shareid)) { ?>
							<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission'];?>元<?php  } else { ?><?php  echo $item['commission'];?>元<?php  } ?></td><?php  if($cfg['globalCommissionLevel']>=2) { ?>		
							<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission2'];?>元<?php  } else { ?><?php  echo $item['commission2'];?>元<?php  } ?></td><?php  } ?>	<?php  if($cfg['globalCommissionLevel']>=3) { ?>		
									<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission3'];?>元<?php  } else { ?><?php  echo $item['commission3'];?>元<?php  } ?></td><?php  } ?>
                    <?php  } ?>
					<?php  if(empty($shareid)) { ?>
					<td><a href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['id'],'from_user'=>$_GPC['from_user']))?>">查看详情</a>
						&nbsp;&nbsp;
						
							<a   onclick="document.getElementById('print_orderid').value='<?php  echo $item['id'];?>';$('#modal-normalprint').modal()" href="javascript:;">发货单打印</a>

						&nbsp;&nbsp;
						<a   onclick="document.getElementById('print_express_orderid').value='<?php  echo $item['id'];?>';$('#modal-expressprint').modal()" href="javascript:;">快递单打印</a>
						</td>
					<?php  } ?>
				</tr>
				<?php  } } ?>
			</tbody>
			<!--tr>
				<td></td>
				<td colspan="3">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr-->
		</table>
		<?php  echo $pager;?>
	</div>
</div>
<?php  } else if($operation == 'detail') { ?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<?php  if($item['transid']) { ?><div style="margin:10px 0; width:auto;" class="alert alert-error"><i class="icon-lightbulb"></i> 此为微信支付订单，必须要提交发货状态！</div><?php  } ?>
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>">
		<h4>订单信息</h4>
		<table class="tb">

			<tr>
				<th ><label for="">收货人姓名:</label></th>
				<td >
					<?php  echo $item['user']['realname'];?>
				</td>
				<th ><label for="">联系电话:</label></th>
				<td >
					<?php  echo $item['user']['mobile'];?>
				</td>
			</tr>
			
			<tr>
				<th><label for="">订单编号:</label></th>
				<td>
					<?php  echo $item['ordersn'];?>
				</td>
				<th><label for="">总金额:</label></th>
				<td>
					<?php  echo $item['price'];?> 元 （商品: <?php  echo $item['goodsprice'];?> 元 运费: <?php  echo $item['dispatchprice'];?> 元)
				</td>
			</tr>
			<tr>
			<th><label for="">下单时间：</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
				</td>
				<th><label for="">收货地址：</label></th>
				<td>
					<?php  echo $item['user']['province'];?><?php  echo $item['user']['city'];?><?php  echo $item['user']['area'];?><?php  echo $item['user']['address'];?>
				</td>
			</tr>
			<?php  if(!empty($item['updatetime'])) { ?>
				<tr>
			<th><label for="">订单完成时间：</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $item['updatetime'])?>
				</td>
			<th></th>
				<td></td>
			</tr>
			<?php  } ?>
				<tr>
				<th><label for="">配送方式：</label></th>
				<td>
					<?php  if(empty($dispatch)) { ?>自提<?php  } else { ?>快递配送<?php  } ?>  <?php  if(!empty($item['expresssn'])) { ?>【<a target="_blank" href="http://www.kuaidi100.com/chaxun?com=<?php  echo $item['expresscom'];?>&nu=<?php  echo $item['expresssn'];?>"><?php  echo $item['expresscom'];?><?php  echo $item['expresssn'];?></a>】<?php  } ?>
				</td>
					<th><label for="">支付方式：</label></th>
				<td>
					<?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
					<?php  if($item['paytype'] == 2) { ?>在线支付<?php  } ?>
					<?php  if($item['paytype'] == 3) { ?>货到付款<?php  } ?>
				</td>
			</tr>
			
			
			<tr>
				<th><label for="">分销员：</label></th>
				<td><?php  if(!empty($member[$item['shareid']])) { ?>
					<?php  echo $member[$item['shareid']];?>
					<?php  } else { ?> -- <?php  } ?>
				</td>
						<th><label for="">订单状态：</label></th>
				<td>
						<?php  if($item['status'] == 0) { ?><span class="label label-warning" >待付款</span><?php  } ?>
						<?php  if($item['status'] == 1) { ?><span class="label label-important" >待发货</span><?php  } ?>
						<?php  if($item['status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
						<?php  if($item['status'] ==3) { ?><span class="label label-success" >已完成</span><?php  } ?>
						<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
						<?php  if($item['status'] == -2) { ?><span class="label label-important">退款中</span><?php  } ?>
						<?php  if($item['status'] == -3) { ?><span class="label label-important">换货中</span><?php  } ?>
						<?php  if($item['status'] ==-4) { ?><span class="label label-important">退货中</span><?php  } ?>
						<?php  if($item['status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($item['status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
				</td>
			</tr>
			
			<tr>
					<th >买家留言：</th>
				<td>
			<textarea style='width:300px;border: none;' name="remark" cols="70" readonly="readonly"><?php  echo $item['remark'];?></textarea>
				</td>
				<th >	<?php  if(($item['status'] <=-2)) { ?><label for="">	<?php  if(($item['status'] == -2||$item['status'] == -6)) { ?>退款<?php  } ?><?php  if(($item['status'] == -3)) { ?>换货<?php  } ?><?php  if(($item['status'] == -4||$item['status'] == -5) ) { ?>退货<?php  } ?>原因</label><?php  } ?></th>
				<td >
					<?php  if(($item['status'] <=-2)) { ?><textarea readonly="readonly" style='width:300px;border: none;' type="text"><?php  echo $item['rsreson'];?></textarea>		<?php  } ?>
				</td>
			
			</tr>
		<!--	<tr>
				<th><label for="">价钱</label></th>
				<td>
					<?php  echo $item['price'];?> 元 （商品: <?php  echo $item['goodsprice'];?> 元 运费: <?php  echo $item['dispatchprice'];?> 元)
				</td>
			</tr>-->
		
			<!--<tr>
				<th><label for="">付款方式</label></th>
				<td>
					<?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
					<?php  if($item['paytype'] == 2) { ?>在线支付<?php  } ?>
					<?php  if($item['paytype'] == 3) { ?>货到付款<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">订单状态</label></th>
				<td>
					<?php  if($item['status'] == 0) { ?><span class="label label-info">待付款</span><?php  } ?>
					<?php  if($item['status'] == 1) { ?><span class="label label-info">待发货</span><?php  } ?>
					<?php  if($item['status'] == 2) { ?><span class="label label-info">待收货</span><?php  } ?>
					<?php  if($item['status'] == 3) { ?><span class="label label-success">已完成</span><?php  } ?>
					<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">下单日期</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
				</td>
			</tr>-->
			<!--<tr>
				<th>备注</th>
				<td>
					<textarea style="height:150px;" class="span7" name="remark" cols="70"><?php  echo $item['remark'];?></textarea>
				</td>
			</tr>-->
		</table>
		<!--<h4>用户信息</h4>
		<table class="tb">
			<tr>
				<th><label for="">姓名</label></th>
				<td>
					<?php  echo $item['user']['realname'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">手机</label></th>
				<td>
					<?php  echo $item['user']['mobile'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">QQ</label></th>
				<td>
					<?php  echo $item['user']['qq'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">地址</label></th>
				<td>
					<?php  echo $item['user']['province'];?><?php  echo $item['user']['city'];?><?php  echo $item['user']['area'];?><?php  echo $item['user']['address'];?>
				</td>
			</tr>
		</table>
		<h4>商品列表</h4>-->
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">ID</th>
					<th style="min-width:350px;">商品标题</th>
                                        <th style="min-width:250px;">商品规格</th>
					<th style="width:100px;">商品编号</th>
					<th style="width:100px;">商品条码</th>
                                        
					<!--<th style="width:100px;">销售价/成本价</th>
					<th style="width:100px;">属性</th>-->
                                        <th style="width:80px;color:red;">成交价</th>
					<th style="width:50px;">数量</th>
					<?php  if(!empty($member[$item['shareid']])) { ?>
					
					<th style="width:50px;">1级佣金</th>
					 <?php  } ?>
					 <?php  if(!empty($member[$item['shareid2']])) { ?>
					
					<th style="width:50px;">2级佣金</th>
					 <?php  } ?>
					 <?php  if(!empty($member[$item['shareid3']])) { ?>
					
					<th style="width:50px;">3级佣金</th>
					 <?php  } ?>
					<!--<th style="text-align:right; min-width:60px;">操作</th>-->
				</tr>
			</thead>
			<?php  $i=1;?>
			<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
			<tr>
				<td><?php  echo $i;$i++?></td>
				<td><?php  if($category[$goods['pcate']]['name']) { ?>
                                    <span class="text-error">[<?php  echo $category[$goods['pcate']]['name'];?>] </span><?php  } ?><?php  if($children[$goods['pcate']][$goods['ccate']]['1']) { ?>
                                    <span class="text-info">[<?php  echo $children[$goods['pcate']][$goods['ccate']]['1'];?>] </span><?php  } ?>
                                  <a target="_blank" href="<?php  echo $this->createWebUrl('goods', array('id' => $goods['id'], 'op' => 'post'))?>"> <?php  echo $goods['title'];?></a>
                                
                                </td>
                                <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				<td><?php  echo $goods['goodssn'];?></td>
				<td><?php  echo $goods['productsn'];?></td>
                               
				<!--td><?php  echo $category[$goods['pcate']]['name'];?> - <?php  echo $children[$goods['pcate']][$goods['ccate']]['1'];?></td-->
				<!--<td style="background:#f2dede;"><?php  echo $goods['marketprice'];?>元 / <?php  echo $goods['productprice'];?>元</td>
				<td><?php  if($goods['status']==1) { ?><span class="label label-success">上架</span><?php  } else { ?><span class="label label-error">下架</span><?php  } ?>&nbsp;<span class="label label-info"><?php  if($goods['type'] == 1) { ?>实体商品<?php  } else { ?>虚拟商品<?php  } ?></span></td>-->
                                 <td style='color:red;font-weight:bold;'><?php  echo $goods['orderprice'];?></td>
				<td><?php  echo $goods['total'];?></td>
					<?php  if(!empty($item['shareid'])) { ?>
					
					<td ><?php  echo $goods['commission']*$goods['total']?></td>
					 <?php  } ?>
					 <?php  if(!empty($item['shareid2'])) { ?>
						<td ><?php  echo $goods['commission2']*$goods['total']?></td>
					 <?php  } ?>
					 <?php  if(!empty($item['shareid3'])) { ?>
						<td ><?php  echo $goods['commission3']*$goods['total']?></td>
					 <?php  } ?>
				<!--<td style="text-align:right;">
					<a href="<?php  echo $this->createWebUrl('goods', array('id' => $goods['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('goods', array('id' => $goods['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
				</td>-->
			</tr>
			<?php  } } ?>
		</table>

		<table class="tb">
			<tr>
				<th></th>
				<td>
					
					
							<?php  if(empty($item['status'])) { ?>
						<button type="submit" class="btn btn-danger span2" onclick="return confirm('确认付款此订单吗？'); return false;" name="confrimpay" value="confrimpay">确认付款</button>
					<?php  } ?>
					
						<?php  if($item['status']==1) { ?>
						<button type="button" class="btn btn-primary span2" name="confirmsend" onclick="$('#modal-confirmsend').modal()" value="confirmsend">确认发货</button>
					
				<?php  } ?>
						 
						<?php  if($item['status']==2) { ?>
						<button type="submit" class="btn btn-danger span2" name="cancelsend" onclick="return confirm('取消发货此订单吗？'); return false;" value="cancelsend">取消发货</button>
  		<?php  } ?>
						
					
					<?php  if($item['status']==2) { ?>
					<button type="submit" class="btn btn-success span2" onclick="return confirm('确认完成此订单吗？'); return false;" name="finish" value="finish">完成订单</button>
		<?php  } ?>
							<?php  if(($item['status']==-2||$item['status']==1)&&$item['paytype']!=3) { ?>
						<button type="submit" class="btn btn-danger span2" onclick="return confirm('确认退款此订单吗？'); return false;" name="returnpay" value="returnpay">确认退款</button>
					<?php  } ?>
						<?php  if($item['status']==-3) { ?>
						<button type="button" class="btn btn-danger span2" onclick="$('#modal-confirmsend').modal(); " name="resend" value="resend">确认换货</button>
				<?php  } ?>
					<?php  if($item['status']==-4) { ?>
						<button type="submit" class="btn btn-danger span2" onclick="return confirm('确认退货此订单吗？'); return false;" name="returngood" value="returngood">确认退货</button>
				<?php  } ?>
				<?php  if($item['status']==-2||$item['status']==-3||$item['status']==-4) { ?>
					<button type="submit" class="btn span2" name="cancelreturn" onclick="return confirm('此订单要退回申请吗？'); return false;" value="cancelreturn">退回申请</button>
					<?php  } ?>
				
				<?php  if($item['status']==0||$item['status']==1||$item['status']==2) { ?>
					<button type="submit" class="btn span2" name="close" onclick="return confirm('永久关闭此订单吗？'); return false;" value="close">关闭订单</button>
					<?php  } ?>
					
					
					
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
		<div id="modal-confirmsend" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
			<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>快递信息</h3></div>
			<div class="modal-body">
				<table class="tb">
					<tr>
						<th><label for="">是否需要快递</label></th>
						<td>
							<label for="radio_1" class="radio inline"><input type="radio" name="isexpress" id="radio_1" value="1" onclick="$('#expresspanel').show();" checked autocomplete="off"> 是</label>
							<label for="radio_2" class="radio inline"><input type="radio" name="isexpress" id="radio_2" value="0" onclick="$('#expresspanel').hide();" autocomplete="off"> 否</label>
						</td>
					</tr>
					<tbody id="expresspanel">
						<tr>
							<th><label for="">快递公司</label></th>
							<td>
								<select name="express" id='express'>
                                                                    
                                                                      

									<option value="" data-name="">其他快递</option>
<option value="shunfeng" data-name="顺丰">顺丰</option>
<option value="shentong" data-name="申通">申通</option>
<option value="yunda" data-name="韵达快运">韵达快运</option>
<option value="tiantian" data-name="天天快递">天天快递</option>
<option value="yuantong" data-name="圆通速递">圆通速递</option>
<option value="zhongtong" data-name="中通速递">中通速递</option>
<option value="ems" data-name="ems快递">ems快递</option>
<option value="huitongkuaidi" data-name="汇通快运">汇通快运</option>
<option value="quanfengkuaidi" data-name="全峰快递">全峰快递</option>
<option value="zhaijisong" data-name="宅急送">宅急送</option>
<option value="aae" data-name="aae全球专递">aae全球专递</option>
<option value="anjie" data-name="安捷快递">安捷快递</option>
<option value="anxindakuaixi" data-name="安信达快递">安信达快递</option>
<option value="biaojikuaidi" data-name="彪记快递">彪记快递</option>
<option value="bht" data-name="bht">bht</option>
<option value="baifudongfang" data-name="百福东方国际物流">百福东方国际物流</option>
<option value="coe" data-name="中国东方（COE）">中国东方（COE）</option>
<option value="changyuwuliu" data-name="长宇物流">长宇物流</option>
<option value="datianwuliu" data-name="大田物流">大田物流</option>
<option value="debangwuliu" data-name="德邦物流">德邦物流</option>
<option value="dhl" data-name="dhl">dhl</option>
<option value="dpex" data-name="dpex">dpex</option>
<option value="dsukuaidi" data-name="d速快递">d速快递</option>
<option value="disifang" data-name="递四方">递四方</option>
<option value="fedex" data-name="fedex（国外）">fedex（国外）</option>
<option value="feikangda" data-name="飞康达物流">飞康达物流</option>
<option value="fenghuangkuaidi" data-name="凤凰快递">凤凰快递</option>
<option value="feikuaida" data-name="飞快达">飞快达</option>
<option value="guotongkuaidi" data-name="国通快递">国通快递</option>
<option value="ganzhongnengda" data-name="港中能达物流">港中能达物流</option>
<option value="guangdongyouzhengwuliu" data-name="广东邮政物流">广东邮政物流</option>
<option value="gongsuda" data-name="共速达">共速达</option>
<option value="hengluwuliu" data-name="恒路物流">恒路物流</option>
<option value="huaxialongwuliu" data-name="华夏龙物流">华夏龙物流</option>
<option value="haihongwangsong" data-name="海红">海红</option>
<option value="haiwaihuanqiu" data-name="海外环球">海外环球</option>
<option value="jiayiwuliu" data-name="佳怡物流">佳怡物流</option>
<option value="jinguangsudikuaijian" data-name="京广速递">京广速递</option>
<option value="jixianda" data-name="急先达">急先达</option>
<option value="jjwl" data-name="佳吉物流">佳吉物流</option>
<option value="jymwl" data-name="加运美物流">加运美物流</option>
<option value="jindawuliu" data-name="金大物流">金大物流</option>
<option value="jialidatong" data-name="嘉里大通">嘉里大通</option>
<option value="jykd" data-name="晋越快递">晋越快递</option>
<option value="kuaijiesudi" data-name="快捷速递">快捷速递</option>
<option value="lianb" data-name="联邦快递（国内）">联邦快递（国内）</option>
<option value="lianhaowuliu" data-name="联昊通物流">联昊通物流</option>
<option value="longbanwuliu" data-name="龙邦物流">龙邦物流</option>
<option value="lijisong" data-name="立即送">立即送</option>
<option value="lejiedi" data-name="乐捷递">乐捷递</option>
<option value="minghangkuaidi" data-name="民航快递">民航快递</option>
<option value="meiguokuaidi" data-name="美国快递">美国快递</option>
<option value="menduimen" data-name="门对门">门对门</option>
<option value="ocs" data-name="OCS">OCS</option>
<option value="peisihuoyunkuaidi" data-name="配思货运">配思货运</option>
<option value="quanchenkuaidi" data-name="全晨快递">全晨快递</option>
<option value="quanjitong" data-name="全际通物流">全际通物流</option>
<option value="quanritongkuaidi" data-name="全日通快递">全日通快递</option>
<option value="quanyikuaidi" data-name="全一快递">全一快递</option>
<option value="rufengda" data-name="如风达">如风达</option>
<option value="santaisudi" data-name="三态速递">三态速递</option>
<option value="shenghuiwuliu" data-name="盛辉物流">盛辉物流</option>
<option value="sue" data-name="速尔物流">速尔物流</option>
<option value="shengfeng" data-name="盛丰物流">盛丰物流</option>
<option value="saiaodi" data-name="赛澳递">赛澳递</option>
<option value="tiandihuayu" data-name="天地华宇">天地华宇</option>
<option value="tnt" data-name="tnt">tnt</option>
<option value="ups" data-name="ups">ups</option>
<option value="wanjiawuliu" data-name="万家物流">万家物流</option>
<option value="wenjiesudi" data-name="文捷航空速递">文捷航空速递</option>
<option value="wuyuan" data-name="伍圆">伍圆</option>
<option value="wxwl" data-name="万象物流">万象物流</option>
<option value="xinbangwuliu" data-name="新邦物流">新邦物流</option>
<option value="xinfengwuliu" data-name="信丰物流">信丰物流</option>
<option value="yafengsudi" data-name="亚风速递">亚风速递</option>
<option value="yibangwuliu" data-name="一邦速递">一邦速递</option>
<option value="youshuwuliu" data-name="优速物流">优速物流</option>
<option value="youzhengguonei" data-name="邮政包裹挂号信">邮政包裹挂号信</option>
<option value="youzhengguoji" data-name="邮政国际包裹挂号信">邮政国际包裹挂号信</option>
<option value="yuanchengwuliu" data-name="远成物流">远成物流</option>
<option value="yuanweifeng" data-name="源伟丰快递">源伟丰快递</option>
<option value="yuanzhijiecheng" data-name="元智捷诚快递">元智捷诚快递</option>
<option value="yuntongkuaidi" data-name="运通快递">运通快递</option>
<option value="yuefengwuliu" data-name="越丰物流">越丰物流</option>
<option value="yad" data-name="源安达">源安达</option>
<option value="yinjiesudi" data-name="银捷速递">银捷速递</option>
<option value="zhongtiekuaiyun" data-name="中铁快运">中铁快运</option>
<option value="zhongyouwuliu" data-name="中邮物流">中邮物流</option>
<option value="zhongxinda" data-name="忠信达">忠信达</option>
<option value="zhimakaimen" data-name="芝麻开门">芝麻开门</option>
								</select>
                                                            <input type='hidden' class='input span3' name='expresscom' id='expresscom'  />
							</td>
						</tr>
						<tr>
							<th><label for="">快递单号</label></th>
							<td>
								<input type="text" name="expresssn" class="span5" />
							</td>
						</tr>
					</tbody>
				</table>
				<div id="module-menus"></div>
			</div>
			<div class="modal-footer"><button type="submit" class="btn btn-primary span2" name="confirmsend" value="yes">确认发货</button><a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a></div>
		</div>
		<div id="modal-cancelsend" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
			<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>取消发货</h3></div>
			<div class="modal-body">
				<table class="tb">
					<tr>
						<th><label for="">取消发货原因</label></th>
						<td>
							<textarea style="height:150px;" class="span5" name="cancelreson" cols="70" autocomplete="off"></textarea>
						</td>
					</tr>
				</table>
				<div id="module-menus"></div>
			</div>
			<div class="modal-footer"><button type="submit" class="btn btn-primary span2" name="cancelsend" value="yes">取消发货</button><a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a></div>
		</div>
		<div id="modal-close" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
			<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>关闭订单</h3></div>
			<div class="modal-body">
				<table class="tb">
					<tr>
						<th><label for="">关闭订单原因</label></th>
						<td>
							<textarea style="height:150px;" class="span5" name="reson" cols="70" autocomplete="off"></textarea>
						</td>
					</tr>
				</table>
				<div id="module-menus"></div>
			</div>
			<div class="modal-footer"><button type="submit" class="btn btn-primary span2" name="close" value="yes">关闭订单</button><a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a></div>
		</div>
	</form>
</div>
<script language='javascript'>
     $(function(){
         <?php  if(!empty($express)) { ?>
             $("#express").val("<?php  echo $express['express_url'];?>");
             $("#expresscom").val(  $("#express").find("option:selected").attr("data-name"));
         <?php  } ?>
             
        $("#express").change(function(){
          
            var obj = $(this);  
            var sel =obj.find("option:selected").attr("data-name");
            $("#expresscom").val(  sel.val() );
        });
      
    })
    
</script>
<?php  } ?>

