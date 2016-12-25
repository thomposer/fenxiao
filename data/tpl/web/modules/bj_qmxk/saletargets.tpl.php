<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">

	<li <?php  if($op == 'salereport') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'salereport'))?>">零售生意报告</a></li>
	<li <?php  if($op == 'orderstatistics' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'orderstatistics'))?>">订单统计</a></li>
	<li <?php  if($op == 'saledetails' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saledetails'))?>">商品销售明细</a></li>
	<li <?php  if($op == 'saletargets' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saletargets'))?>">销售指标分析</a></li>
	<li <?php  if($op == 'productsaleranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsaleranking'))?>">商品销售排行</a></li>
<li <?php  if($op == 'productsalestatistics') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsalestatistics'))?>">商品访问与购买比</a></li>
<li <?php  if($op == 'memberranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'memberranking'))?>">会员消费排行</a></li>
<li <?php  if($op == 'fansrange' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'fansrange'))?>">代理粉丝排行</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='user' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics'))?>">会员增长统计</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='agent' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics','usertype'=>'agent'))?>">代理增长统计</a></li>

</ul>

 <div class="main">
 
		<div class="stat">
		<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<i class="icon-lightbulb"></i> 查询网店的销售指标(注：其中订单数指完成的订单数；订单总金额指完成的订单总金额。)
		</div>
			<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="op" value="saletargets" />
		<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
		
			
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
							<span class="brand">销售指标分析</span>
					</div>
				</div>
			
				<div class="sub-item" id="table-list">
	<h4 class="sub-title">平均每位客户订单金额</h4>
					<div class="sub-content">
						<table class="table table-hover">
											<thead class="navbar-inner">
										<tr>
											<th class="row-hover" style="width:200px">订单总金额</th>
											<th class="row-hover" style="width:200px">总会员数</th>
											<th class="row-hover" style="width:200px">平均每位客户订单金额</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"><?php  echo $allorderprice;?>
											</td>
											<td style="text-align: center;width:200px"><?php  echo $allmembercount;?>
											</td>
											<td style="text-align: center;"><?php echo round(($allorderprice/($allmembercount==0?1:$allmembercount)),2);?>%
											</td>
										
								
										</tr>
									</tbody>
						</table>
					</div>
					<?php  echo $pager;?>
				</div>
				
				
						<div class="sub-item" id="table-list">
			<h4 class="sub-title">平均每次访问订单金额</h4>
							<div class="sub-content">
								<table class="table table-hover">
													<thead class="navbar-inner">
										<tr>
											<th class="row-hover" style="width:200px">订单总金额</th>
											<th class="row-hover" style="width:200px">总访问次数</th>
											<th class="row-hover" style="width:200px">平均每次访问订单金额</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"><?php  echo $allorderprice;?>
											</td>
											<td style="text-align: center;width:200px"><?php  echo $allorderviewcount;?>
											</td>
											<td style="text-align: center;"><?php echo round(($allorderprice/($allorderviewcount==0?1:$allorderviewcount)),2);?>%
											</td>
										
								
										</tr>
									</tbody>
								</table>
							</div>
							<?php  echo $pager;?>
						</div>
						
						
							<div class="sub-item" id="table-list">
			<h4 class="sub-title">订单转化率</h4>
							<div class="sub-content">
								<table class="table table-hover">
											<thead class="navbar-inner">
										<tr>
											<th class="row-hover"  style="width:200px">总订单数</th>
											<th class="row-hover" style="width:200px">总访问次数</th>
											<th class="row-hover"  style="width:200px">订单转化率</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"><?php  echo $allordercount;?>
											</td>
											<td style="text-align: center;width:200px"><?php  echo $allorderviewcount;?>
											</td>
											<td style="text-align: center;"><?php  echo round(($allordercount/$allorderviewcount)*100,2);?>%
											</td>
										
								
										</tr>
									</tbody>
								</table>
							</div>
							<?php  echo $pager;?>
						</div>
						
						
							<div class="sub-item" id="table-list">
			<h4 class="sub-title">注册会员购买率</h4>
							<div class="sub-content">
								<table class="table table-hover">
											<thead class="navbar-inner">
										<tr>
											<th class="row-hover"  style="width:200px">有过订单的会员</th>
											<th class="row-hover" style="width:200px">总会员数</th>
											<th class="row-hover"  style="width:200px">注册会员购买率</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"  ><?php  echo $haveordermembercount;?>
											</td>
											<td style="text-align: center;width:200px"><?php  echo $allmembercount;?>
											</td>
											<td style="text-align: center;"  ><?php echo round(($haveordermembercount/($allmembercount==0?1:$allmembercount))*100,2);?>%
											</td>
										
								
										</tr>
									</tbody>
								</table>
							</div>
							<?php  echo $pager;?>
						</div>
						
						
							<div class="sub-item" id="table-list">
			<h4 class="sub-title">平均会员订单量</h4>
							<div class="sub-content">
								<table class="table table-hover">
									<thead class="navbar-inner">
										<tr>
											<th class="row-hover"  style="width:200px">总订单数</th>
											<th class="row-hover" style="width:200px">总会员数</th>
											<th class="row-hover"  style="width:200px">平均会员订单量</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;"><?php  echo $allordercount;?>
											</td>
											<td style="text-align: center;width:200px"><?php  echo $allmembercount;?>
											</td>
											<td style="text-align: center;"><?php echo round(($allordercount/($allmembercount==0?1:$allmembercount))*100,2);?>%
											</td>
										
								
										</tr>
									</tbody>
								</table>
							</div>
							<?php  echo $pager;?>
						</div>
			</div>
		</div>
    </div>
    	</form>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
