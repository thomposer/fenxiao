<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
 	<li  class="active"><a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">会员信息</a></li>	
 	
</ul>
    <div class="main">
		<div class="stat">
				<form >
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="charge" />
				<input type="hidden" name="op" value="list" />
				

				<table class="table sub-search">
				<table class="table sub-search">
					<tbody>
								<td style="width:80px;text-align: right;font-weight: bold;">姓名</td>
							<td style="width:150px;">
								<input type="text"  name="realname" value="<?php  echo $gprealname;?>"/> 
							</td>
								<td style="width:80px;text-align: right;font-weight: bold;">
								手机
							</td>
								<td style="width:150px;">
								<input type="text"  name="mobile"  value="<?php  echo $gpmobile;?>"/>
							</td>			<td>	</td>
						</tr>
							<td ></td>
							<td>
							 <input type="submit" name="submit" value="搜索" class="btn btn-primary">
							</td><td>	</td><td>	</td><td>	</td>
						</tr>
					
						
					</tbody>
					</table>
						
		</form>
			<div class="stat-div">
				
				<div class="sub-item" id="table-list">
					<h4 class="sub-title" style="float:right;color:red;">总数：<?php  echo $total;?></h4>
					<h4 class="sub-title">名单</h4>

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">姓名</th>
									<th class="row-hover">电话</th>
									<th class="row-hover"> 账户余额</th>
									<th class="row-hover">积分</th>
									<th class="row-hover">操作</th>
								</tr>
							</thead>
							<tbody>
							
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['realname'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['mobile'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['credit2'];?>
									</td>
									<td style="text-align:center;">
									<?php  echo $v['credit1'];?>
									</td>
									<td style="text-align: center;">

										<a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'post','name' => 'bj_qmxk','weid'=>$_W['weid'],'chargeType'=>'charge','from_user'=>$v['from_user']))?>" class="btn btn-primary">余额管理</a>
									&nbsp;
										<a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'post','name' => 'bj_qmxk','weid'=>$_W['weid'],'chargeType'=>'credit1','from_user'=>$v['from_user']))?>" class="btn btn-primary">充值积分</a>
								&nbsp;
										<a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1,'from_user'=>$v['from_user']))?>" class="btn btn-primary">会员订单</a>
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