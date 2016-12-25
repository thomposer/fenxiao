<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
 	<li ><a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">会员信息</a></li>	
 	<?php  if($_GPC['from_user']) { ?><li class="active"><a >会员余额充值详情</a></li><li><a href="<?php  echo create_url('site/module', array('do' => 'ordermy', 'op' => 'display','name' => 'bj_qmxk','weid'=>$_W['weid'],'from_user'=>$_GPC['from_user']))?>">会员订单</a></li> <?php  } ?>
</ul>
    <div class="main">
	
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return validate(this);">
			<h4>会员充值 </h4>
			<table class="tb">
				<tr>
					<th style="text-align: right;"><label>真实姓名:</label></th>
					<td >
						&nbsp;&nbsp;<?php  echo $profile['realname'];?>
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>联系方式:</label></th>
					<td >
						&nbsp;&nbsp;<?php  echo $profile2['mobile'];?>
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>当前余额:</label></th>
					<td style="color:#f00;">
						&nbsp;&nbsp;<?php  echo $profile2['credit2'];?>
					</td>
				</tr>
					<tr>
					<th style="text-align: right;"><label>操作方式:</label></th>
							<td> &nbsp;&nbsp;
            <input type="radio" name="credit2type" value="1" id="credit2type" checked>余额充值
            &nbsp;&nbsp;&nbsp;
           <input type="radio" name="credit2type" value="2" id="credit2type">余额提现（该操作仅作金额显示记录，具体提现到微信支付还是支付宝，需要人工打款！）
          
        </td>
				</tr>
	
				<tr>
					<th style="text-align: right;"><label>操作金额:</label></th>
					<td>
						<input type="text" name="chargenum" class="span1" value="" /><input type="hidden"  name="from_user" value="<?php  echo $_GPC['from_user'];?>" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						<input name="submit" type="submit" value="提 交" class="btn btn-primary span2">
					</td>
				</tr>
				
				
			</table>
		</form>
		<div class="stat">
		
			<div class="stat-div">
				
				<div class="sub-item" id="table-list">
					<h4 class="sub-title" style="float:right;color:red;">总数：<?php  echo $total;?> <a href="">刷新</a> </h4>
					<h4 class="sub-title">帐变明细</h4>

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">日期</th>
									<th class="row-hover">类型</th>
									<th class="row-hover">金额</th>
									<th class="row-hover">账户余额</th>
									<th class="row-hover">说明</th>
								</tr>
							</thead>
							<tbody>
							
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo date('Y-m-d H:i:s', $v['createtime'])?>
									</td>
									<td style="text-align: center;">
										<?php  if($v['type']=='addgold') { ?>充值<?php  } ?>	<?php  if($v['type']=='usegold') { ?>消费<?php  } ?> 
										
									</td>
									<td style="text-align: center;">
											<?php  if($v['type']=='addgold') { ?>+<?php  } ?><?php  if($v['type']=='usegold') { ?>-<?php  } ?><?php  echo $v['fee'];?>	
									</td>
									<td style="text-align:center;">
										<?php  echo $v['credit2'];?>		
									</td>
									<td style="text-align: center;">
										<?php  echo $v['tag'];?>								
									</td>
								</tr>
									
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
    </div>


<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>