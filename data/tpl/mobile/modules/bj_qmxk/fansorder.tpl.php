<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title>我推荐的订单</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/style/css/oder.css?r=<?php  echo time()?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
<meta name="mobileOptimized" content="width" />
<meta name="handheldFriendly" content="true" />
<meta http-equiv="Cache-Control" content="max-age=0" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
 <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">

</head>

<body  class="body-gray my-memvers">

    <!--count-->
    <section class="member-count">
        <h2 class="member-count-title"><i class="icon-chunk-gray"><i class="icon-chunk-blue"></i></i><span>推荐订单数据</span></h2>
        <div class="row member-count-row">
            <div class="small-4 columns member-count-column"><span class="member-count-label">今日新增</span><em class="member-count-number"><?php  echo $countToday;?></em></div>
            <div class="small-4 columns member-count-column"><span class="member-count-label">昨日新增</span><em class="member-count-number"><?php  echo $countYestay;?></em></div>
            <div class="small-4 columns member-count-column"><span class="member-count-label">订单总数</span><em class="member-count-number"><?php  echo $allcount;?></em></div>
        </div>
    </section>
    <!--count-->

	
	    <section class="member-browse">
        <h2 class="member-browse-title"><i class="icon-chunk-gray"><i class="icon-chunk-blue"></i></i><span>详细订单记录</span></h2>
        <ul class="member-browse-ul">
            <?php  if(empty($list)) { ?>
				<p >暂无</p>
				<?php  } else { ?>
				<?php  if(is_array($list)) { foreach($list as $order) { ?>
            <li class="member-browse-li">
                <div class="row member-browse-summey">
                    <a class="member-browse-summey-info" href="#" >                 
                        <div class="member-browse-nt">                           
                            <span class="member-browse-name" style="font-weight:bold;"><?php  echo $order['level']?>级订单：<?php  echo $order['ordersn'];?><span class="pro-price">【
						<?php  if($order['status'] == 0) { ?>待付款<?php  } ?>
						<?php  if($order['status'] == 1) { ?>待发货<?php  } ?>
						<?php  if($order['status'] == 2) { ?>待收货<?php  } ?>
							<?php  if($order['status'] ==3) { ?>已完成<?php  } ?>
							<?php  if($order['status'] == -1) { ?>已关闭<?php  } ?>
							<?php  if($order['status'] == -2) { ?>退款中<?php  } ?>
							<?php  if($order['status'] == -3) { ?>换货中<?php  } ?>
							<?php  if($order['status'] ==-4) { ?>退货中<?php  } ?>
							<?php  if($order['status'] == -5) { ?>已退货<?php  } ?>
						<?php  if($order['status'] == -6) { ?>已退款<?php  } ?>
                             】</span></span>
                        </div>
                    </a>                   
                </div>
              	<?php  if(is_array($order['commissions'])) { foreach($order['commissions'] as $v) { ?>
                <div class="member-browser-pro-list" >
                    
                    <a class="member-browser-pro-a" href="#"><span class="pro-img">
                        <img src="<?php  echo $_W['attachurl'].$v['thumb']?>"></span><p class="pro-info"><span class="pro-name" style="color:#999;"><?php  echo $v['title'];?></span><span class="pro-price">预估佣金：<strong>+<?php  echo $v['commission']?></strong></span><span class="pro-price">&nbsp;&nbsp;&nbsp;&nbsp;数量：<strong><?php  echo $v['total']?></strong></span></p>
                    </a>
                    
                </div>
            	<?php  } } ?>
				
				
				     <div class="row member-browse-summey">
                    <a class="member-browse-summey-info" href="#" >                 
                        <div class="member-browse-nt">                           
                            <span class="member-browse-name" style="color:#999;">购买人：<?php  echo $order['realname']?>&nbsp;&nbsp;&nbsp;&nbsp;金额：<?php  echo $order['price'];?>&nbsp;&nbsp;&nbsp;&nbsp;日期：<?php  echo date('Y-m-d', $order['createtime'])?></span>
                        </div>
                    </a>                   
                </div>
				
            </li>
			<?php  } } ?>
			
			<?php  } ?>
			
			
            
        </ul>
    </section>
<?php  echo $pager;?>
</div>
	

<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>


<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo BJ_QMXK_ROOT;?>/style/js/com.js"></script>

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>