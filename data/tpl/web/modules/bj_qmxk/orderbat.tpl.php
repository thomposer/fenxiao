<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
<?php  if(empty($shareid)) { ?>
		<li <?php  if($operation == 'display' && $status == '1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1))?>">待发货</a></li>
	<li <?php  if($operation == 'display' && $status == '0') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 0))?>">待付款</a></li>
	<li <?php  if($operation == 'display' && $status == '2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 2))?>">待收货</a></li>
	<li <?php  if($operation == 'display' && $status == '3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 3))?>">已完成</a></li>
	<li <?php  if($operation == 'display' && $status == '-2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -2))?>">退款中</a></li>
<li <?php  if($operation == 'display' && $status == '-3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -3))?>">换货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-4') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -4))?>">退货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -1))?>">已关闭</a></li>
	<li <?php  if($operation == 'display' && $status == '-99') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -99))?>">全部订单</a></li>
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

<form action="" method="post">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="order" />
				<input type="hidden" name="op" value="display" />
					<input type="hidden" name="status" value="<?php  echo $status;?>" />
				
			 <span style="float:left;margin-left:30px;padding-top:15px;">批量设置快递公司:<select  name="expressall" id="expressall" >
									<?php  include $this->template('orderbatexpress', TEMPLATE_INCLUDEPATH);?>
								</select> </span>
   
<div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					 	<?php  if($status==1) { ?>		<th style="width:30px;"> <input type="checkbox" class="check_all" /></th>
				<th style="width:100px;" id="expressno">快递公司</th>      <?php  } ?>
					<th style="width:120px;">快递单号</th>
					<th style="width:80px;">订单编号</th>
					<th style="width:100px;">收货人姓名</th>
					<th style="width:100px;">联系电话</th>
					<th style="width:60px;">支付方式</th>
					<th style="width:50px;">运费</th>			
					<th style="width:50px;">总价</th>           
					<th style="width:150px;">下单时间</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody id="allorders">
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
						<td class="with-checkbox"><?php  if($status==1) { ?>	  <input type="checkbox" onchange="onchangcheckbox();" name="check[]" value="<?php  echo $item['id'];?>"></td>
							<td  ><select onchange="onchangcheckbox();" name="express<?php  echo $item['id'];?>" id="express<?php  echo $item['id'];?>" >
									<?php  include $this->template('orderbatexpress', TEMPLATE_INCLUDEPATH);?>
								</select> <input type='hidden'  name='expresscom<?php  echo $item['id'];?>' id='expresscom<?php  echo $item['id'];?>'  />
								<?php  } ?></td>
				
				
				<td><input type="text" id="expressno<?php  echo $item['id'];?>" name="expressno<?php  echo $item['id'];?>"  placeholder="请输入快递单号"  value="">
								</td>
					<td><?php  echo $item['ordersn'];?>
								</td>
					<td><?php  echo $address[$item['addressid']]['realname'];?></td>
					<td><?php  echo $address[$item['addressid']]['mobile'];?></td>
					<td><?php  if($item['paytype'] == 1) { ?><span class="label label-important">余额支付</span><?php  } ?><?php  if($item['paytype'] == 2) { ?><span class="label label-important">在线支付</span><?php  } ?><?php  if($item['paytype'] == 3) { ?><span class="label label-warning">货到付款</span><?php  } ?></td>
			
                                        <td><?php  echo $item['dispatchprice'];?></td>
					<td><?php  echo $item['price'];?> 元</td>
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<td><a   onclick="document.getElementById('print_express_orderid').value='<?php  echo $item['id'];?>';$('#modal-expressprint').modal()" href="javascript:;">快递单打印</a>
					<br/>
						
							<a   onclick="document.getElementById('print_orderid').value='<?php  echo $item['id'];?>';$('#modal-normalprint').modal()" href="javascript:;">发货单打印</a>

</td>
				
				</tr>
				<?php  } } ?>
				
				
			</tbody>
			
		</table>
		<table><tr><td style="width:150px"><button type="submit"  name="sendbatexpress" value="sendbatexpress" class="btn btn-warning btn-lg">批量发货</button></td></tr></table>
		 <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</form>
		<?php  echo $pager;?>
	</div>
</div>
<script>

	function onchangcheckbox()
	{
		
                 
                    $("input[name='check[]']").each(function(){ 
          
            var obj = $("#express"+$(this).val());  
            var sel =obj.find("option:selected").attr("data-name");
        
            $("#expresscom"+$(this).val()).val(  sel );
										}); 
											
		
	}
	onchangcheckbox();
     $(function(){
                  $("#expressall").change(function(){
          var obj = $(this);
          var target_val =obj.find("option:selected").val();
          $("#allorders select").each(function() {
            var obj = $(this);
            console.log(obj);
            obj.val(target_val);
          });
          	onchangcheckbox();
        });
            $(".check_all").click(function(){
            var checked = $(this).get(0).checked;
                    $("input[type=checkbox]").attr("checked", checked);
                    
            });
             });
	</script>
<?php  } ?>
