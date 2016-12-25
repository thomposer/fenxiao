<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
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

 <div class="main">
 
		<div class="stat">
		<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<i class="icon-lightbulb"></i> 查看生意情况，您可以按月或按日分别查看商城订单交易量、交易额
		</div>
			<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="op" value="salereport" />
		<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
		
			
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
							<span class="brand">零售生意报告</span>
					</div>
				</div>
				<h4 class="sub-title">按月统计&nbsp;&nbsp;&nbsp;
					<select name="dropMonthForYaer" >
		<?php  if(is_array($years)) { foreach($years as $v) { ?>
	<option value="<?php  echo $v['year'];?>"  <?php  if($v['checked'] == 1) { ?>selected="selected"<?php  } ?>><?php  echo $v['year'];?></option>
			<?php  } } ?>
</select>
								年&nbsp;&nbsp;
							
				
					<label class="radio inline"><input type="radio" name="radioMonthForSaleType" value="0" <?php  if($radioMonthForSaleType == 0) { ?>checked=""<?php  } ?>>交易量</label>
					<label class="radio inline"><input type="radio" name="radioMonthForSaleType" value="1" <?php  if($radioMonthForSaleType == 1) { ?>checked=""<?php  } ?>>交易额</label>
				<input type="submit" name="" value="查询" class="btn btn-primary">
				&nbsp;&nbsp;
		
							<button type="submit" name="salereportEXP01" value="salereportEXP01" class="btn btn-warning btn-lg">导出excel</button>
					<span class="pull-right" style="padding:10px 10px 0 0;">总<?php  if($radioMonthForSaleType == 1 ) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $allcount;?></span>，最高峰<?php  if($radioMonthForSaleType == 1 ) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $topcount;?></span></span>
					</h4>
				<div class="sub-item" id="table-list">

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">月份</th>
									<th class="row-hover"><?php  if($radioMonthForSaleType == 1 ) { ?>交易额 <?php  } else { ?> 交易量<?php  } ?></th>
									<th class="row-hover">比例示意图</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($datas)) { foreach($datas as $v) { ?>
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['month'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['count'];?>
									</td>
									<td style="text-align: left;">
										<img width="<?php  echo (4*$v['persent'])?>px" height="15" style="margin-left:60px;background: url(<?php echo BJ_QMXK_ROOT;?>/recouse/images/lenth.gif);height: 15px;"><?php  echo $v['persent'];?>%
									</td>
								
						
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					<?php  echo $pager;?>
				</div>
				
				
				
				<h4 class="sub-title">按日统计&nbsp;&nbsp;&nbsp;
					
					<select name="dropdayForYaer" >
		<?php  if(is_array($years)) { foreach($years as $v) { ?>
	<option value="<?php  echo $v['year'];?>"  <?php  if($v['checked'] == 1) { ?>selected="selected"<?php  } ?>><?php  echo $v['year'];?></option>
			<?php  } } ?>
</select>
								年&nbsp;&nbsp;&nbsp;
							
					<select name="selectmonthSale" class="span1">	
	<option value="1" <?php  if($selectmonthSale == 1 ) { ?>selected="selected" <?php  } ?>>1</option>
	<option value="2" <?php  if($selectmonthSale == 2 ) { ?>selected="selected" <?php  } ?>>2</option>
	<option value="3" <?php  if($selectmonthSale == 3 ) { ?>selected="selected" <?php  } ?>>3</option>
	<option value="4" <?php  if($selectmonthSale == 4 ) { ?>selected="selected" <?php  } ?>>4</option>
	<option value="5" <?php  if($selectmonthSale == 5 ) { ?>selected="selected" <?php  } ?>>5</option>
	<option value="6" <?php  if($selectmonthSale == 6 ) { ?>selected="selected" <?php  } ?>>6</option>
	<option value="7" <?php  if($selectmonthSale == 7 ) { ?>selected="selected" <?php  } ?>>7</option>
	<option value="8" <?php  if($selectmonthSale == 8 ) { ?>selected="selected" <?php  } ?>>8</option>
	<option value="9" <?php  if($selectmonthSale == 9 ) { ?>selected="selected" <?php  } ?>>9</option>
	<option value="10" <?php  if($selectmonthSale == 10 ) { ?>selected="selected" <?php  } ?>>10</option>
	<option value="11" <?php  if($selectmonthSale == 11 ) { ?>selected="selected" <?php  } ?>>11</option>
	<option value="12" <?php  if($selectmonthSale == 12 ) { ?>selected="selected" <?php  } ?>>12</option>

</select>月
				
					<label class="radio inline"><input type="radio" name="radiodayForSaleType" value="0" <?php  if($radiodayForSaleType == 0) { ?>checked=""<?php  } ?>>交易量</label>
					<label class="radio inline"><input type="radio" name="radiodayForSaleType" value="1" <?php  if($radiodayForSaleType == 1) { ?>checked=""<?php  } ?>>交易额</label>
		<input type="submit" name="t2" value="查询" class="btn btn-primary">
						<button type="submit" name="salereportEXP02" value="salereportEXP02" class="btn btn-warning btn-lg">导出excel</button>
		<span class="pull-right" style="padding:10px 10px 0 0;">总<?php  if($radiodayForSaleType == 1 ) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $dayallcount;?></span>，最高峰<?php  if($radiodayForSaleType == 1 ) { ?>交易额<?php  } else { ?>交易量<?php  } ?>：<span style="color:red; "><?php  echo $daytopcount;?></span></span>
					
		
		</h4>
				<div class="sub-item" id="table-list">

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">日期</th>
									<th class="row-hover" style="width:200px"><?php  if($radiodayForSaleType == 1 ) { ?>交易额<?php  } else { ?>交易量<?php  } ?></th>
									<th class="row-hover" >比例示意图</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($daydatas)) { foreach($daydatas as $v) { ?>
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['day'];?>
									</td>
									<td style="text-align: center;width:200px">
										<?php  echo $v['count'];?>
									</td>
									<td style="text-align: left;">
										<img width="<?php  echo (4*$v['persent'])?>px" height="15" style="margin-left:100px;background: url(<?php echo BJ_QMXK_ROOT;?>/recouse/images/lenth.gif);height: 15px;"><?php  echo $v['persent'];?>%
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
    	</form>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
