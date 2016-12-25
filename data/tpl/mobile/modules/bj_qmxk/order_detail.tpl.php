<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<link type="text/css" rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/images/style.css">
<div class="head">
	<a href="javascript:history.back();" class="bn pull-left"><i class="icon-angle-left"></i></a>
	<span class="title">订单详情</span>
	<a href="<?php  echo $this->createMobileUrl('mycart')?>" class="bn pull-right"><i class="icon-bj_qmxk-cart"></i></a>
</div>
 
<div class="myoder img-rounded" style='padding-bottom: 10px;'>
	<div class="myoder-hd">
		<span class="pull-left">订单编号：<?php  echo $item['ordersn'];?></span>
		<span class="pull-right"> <?php  echo date('Y-m-d H:i', $item['createtime'])?></span>
	</div>
    
	<?php  if(is_array($goods)) { foreach($goods as $g) { ?>
	<div class="myoder-detail">
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $g['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $g['thumb'];?>" width="160"></a>
		<div class="pull-left">
			<div class="name"><a href="<?php  echo $this->createMobileUrl('detail', array('id' => $g['id']))?>"><?php  echo $g['title'];?></a></div>
			<div class="price">
				<span><?php  echo $g['marketprice'];?> 元<?php  if($g['unit']) { ?> / <?php  echo $g['unit'];?><?php  } ?></span>
				<span class="num"><?php  echo $g['total'];?><?php  if($g['unit']) { ?> <?php  echo $g['unit'];?><?php  } ?></span>
			</div>
		</div>
	</div>
	<?php  } } ?>
	<div class="myoder-express">
		<span class="express-company">状态</span>
		<span class="express-num">
			<?php  if($item['status'] == 0) { ?><span class="text-warning">待付款</span>			<?php  } ?>
			<?php  if($item['status'] == 1) { ?><span class="text-danger">待发货</span>			<?php  } ?>
			<?php  if($item['status'] == 2) { ?><span class="text-warning">待收货</span>			<?php  } ?>
			<?php  if($item['status'] == 3) { ?><span class="text-success">已完成</span>			<?php  } ?>
			<?php  if($item['status'] == -1) { ?><span class="text-success">已关闭</span>			<?php  } ?>
			<?php  if($item['status'] == -2) { ?><span class="text-danger">退款中</span>			<?php  } ?>
			<?php  if($item['status'] == -3) { ?><span class="text-danger">换货中</span>			<?php  } ?>
			<?php  if($item['status'] == -4) { ?><span class="text-danger">退货中</span>			<?php  } ?>
			<?php  if($item['status'] == -5) { ?><span class="text-success">已退货</span>			<?php  } ?>
			<?php  if($item['status'] == -6) { ?><span class="text-success">已退款</span>			<?php  } ?>
		</span>
	</div>
	<div class="myoder-express">
		<span class="express-company">配送方式</span>
		<span class="express-num"><?php  echo $dispatch['dispatchname'];?></span>
	</div>
	<?php  if(($item['status'] == '2' || $item['status']==3) && !empty($item['expresssn'])) { ?>
	<div class="myoder-express">
            <span class="express-company">快递: <?php  echo $item['expresscom'];?></span>
		<span class="express-num">
                    单号: <?php  echo $item['expresssn'];?>
                    
		 </span>
	</div>
        <div class="myoder-total" style='margin-bottom:10px;'>
		<a href="http://m.kuaidi100.com/index_all.html?type=<?php  echo $item['express'];?>&postid=<?php  echo $item['expresssn'];?>#input" class="btn btn-success pull-right btn-sm" >查看快递</a>
	</div>
        
	<?php  } ?>
    <?php  if(!empty($item['remark'])) { ?>
             <div class="myoder-express" style='margin-top:10px;'>
		<span class="express-company">订单备注</span>
		
	</div>
  
        <div style='float:left;margin:10px;overflow:hidden;word-break:break-all;width:100%;'>
            <?php  echo $item['remark'];?>
        </div> 
        <?php  } ?>
	<div class="myoder-total" style='margin-bottom:30px;'>
		<span>共计：<span class="false">
                     <?php  if($item['dispatchprice']<=0) { ?>
                        <?php  echo $item['price'];?> 元
                        <?php  } else { ?>
                        <?php  echo $item['price'];?> 元 (含运费 <?php  echo $item['dispatchprice'];?> 元) 
                        <?php  } ?>
                    </span></span>
                    
                    
                    

		
	
		
		<?php  if(($item['status'] == 0||($item['paytype'] ==3&&$item['status'] ==1)) ) { ?>
		<div class="pull-right">
		支付方式：
	<select style="margin-right:15px;width:150px" name="payment"  id="payment" autocomplete="off">
			<?php  if(is_array($dispatchlist)) { foreach($dispatchlist as $d) { ?>
                <option value="<?php  echo $d['id'];?>" <?php  if(($dispatch['id']==$d['id']) ) { ?>selected	<?php  } ?> ><?php  echo $d['dispatchname'];?></option>
                   <?php  } } ?>
              <select>
		<a href="javascript:;" onclick="topay();" class="btn btn-danger btn-sm">立即支付</a>
		<script>
	function topay()
	{
location.href ="<?php  echo $this->createMobileUrl('pay', array('orderid' => $item['id']))?>&dispatchid="+document.getElementById('payment').value;	
}</script>
		</div>
	<?php  } ?>
		<?php  if(($item['paytype'] ==3&&$item['status'] ==1)||$item['status'] ==0) { ?>
		<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'cancelsend'))?>" class="btn btn-success pull-right btn-sm" onclick="return confirm('确认取消该订单吗？'); ">取消订单</a>
		<?php  } ?>
	
	<?php  if($item['status'] == 2) { ?>
		<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'confirm'))?>" class="btn btn-success pull-right btn-sm" onclick="return confirm('点击确认收货前，请确认您的商品已经收到。确定收货吗？'); ">确认收货</a>
		<?php  } ?>
			<?php  if(($item['status'] == 1&&$item['paytype'] != 3) ) { ?>
		<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'returnpay'))?>" class="btn btn-warning pull-right btn-sm" >申请退款</a>
	
			<?php  } ?>
		
				<?php  if(($item['status'] == 3&&!empty($item['updatetime'])) ) { ?>
		<a href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'resendgood'))?>" class="btn btn-warning pull-right btn-sm" >申请换货</a>
		<a  style="margin-right:10px" href="<?php  echo $this->createMobileUrl('myorder', array('orderid' => $item['id'], 'op' => 'returngood'))?>" class="btn btn-warning pull-right btn-sm" >申请退货</a>
		
				<?php  } ?>
		
		
		
		
		
		
		
		
	</div>
</div>
 
 
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>

<script>
t_hideOptionMenu()();
</script>