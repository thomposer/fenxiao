<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php  if($_GPC['istime'] == 1) { ?>限时秒杀<?php  } else { ?>商品列表<?php  } ?></title>
	<meta content="telephone=no" name="format-detection" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/search_new.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/xmapp.css"/>
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjcommon.css?x=4454" rel="stylesheet" type="text/css" />
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjlist.css" rel="stylesheet" type="text/css" />

</head>

<body style=" margin:0 auto;">




		<div class="tab">
			
			<!--Tab 标签end-->

<!-- 分类浏览begin -->
<!-- 排序begin -->

<?php  if($_GPC['istime'] == 1) { ?>

<div>
<img style="max-width: 100%;height: auto;width: auto\9;vertical-align:bottom;vertical-align:top;" src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/mstop.jpg">
</div>
<?php  } else { ?>

<div class="paixu">
<div class="tab">
<a <?php  if($sort==1) { ?>  class="price on"<?php  } else { ?>class="price"<?php  } ?> onclick="location.href='<?php  echo $sorturl;?>&sort=1&sortb1=<?php  echo $sortb11;?>'">销量↓</a>
<a <?php  if($sort==0) { ?>  class="time on"<?php  } else { ?>class="time"	 <?php  } ?> onclick="location.href='<?php  echo $sorturl;?>&sort=0&sortb0=<?php  echo $sortb00;?>'">时间↓</a>
<a <?php  if($sort==2) { ?>  class="renqi on"<?php  } else { ?>class="renqi"<?php  } ?> onclick="location.href='<?php  echo $sorturl;?>&sort=2&sortb2=<?php  echo $sortb22;?>'">人气↓</a>
<a <?php  if($sort==3) { ?>  class="click on"<?php  } else { ?>class="click"<?php  } ?> onclick="location.href='<?php  echo $sorturl;?>&sort=3&sortb3=<?php  echo $sortb33;?>'">价格↓</a>
</div>
</div>
<?php  } ?>
<!-- 排序end -->
    <div style="padding-top:10px;"></div>
	
	
	<div class="os_panel">
              
                    <ul class="os_box_list" id="m2Con">
                  <?php  if(is_array($list)) { foreach($list as $item) { ?>	
                          <li>
						  

						  
						  
                              <a href="<?php  echo $this->createMobileUrl('detail', array('id' => $item['id']))?>" class="item">
							  
							  						<!--  <?php  if($item['istime']==1) { ?>
	 
	 <p style="width:120px; height:30px; position:absolute; z-index:20; left:0px; bottom:80px;border-color:#ccc;"><em style="width:30px; height:30px; display:block;  float:left; text-align:center; line-height:30px; font-style:normal;background:#f95f19; color:#fff;">秒杀</em><span style="width:80px; height:30px; padding:0px 5px; line-height:30px; text-align:left; float:left;background:rgba(239,239,239,0.85); color:#ff0000;">¥<?php  echo $item['marketprice'];?></span></p>
	
 	 <?php  } ?> -->
                                 
                                  <div class="img"><img src="<?php  echo $_W['attachurl'];?><?php  echo $item['thumb'];?>"  onload="setLoadTime1();"></div>
								  
								  
								  
								   <?php  if($item['istime']==1) { ?>
         

								  
                                  <div class="txt"><?php  echo $item['title'];?></div>
								  <div class="buy">
                                      <span class="price"><strong><em>¥<?php  echo $item['marketprice'];?></em></strong><del>¥<?php  echo $item['productprice'];?></del></span>
                                    
                                  </div>
								  	
                                  
                                
								  
					 <?php  } else { ?>			  
							<div class="txt"><?php  echo $item['title'];?></div>	  
								  <div class="buy">
                                      <span class="price"><strong><em>¥<?php  echo $item['marketprice'];?></em></strong><del>¥<?php  echo $item['productprice'];?></del></span>
                                    
                                  </div>
								  <?php  } ?> 
                              </a>
                          </li>
                 	<?php  } } ?>
                   </ul>
                  
               </div>
	
	
	
	
	




<!-- 分类浏览end -->
		</div>
	</div>
﻿<!--页面底部-->
		<div class="viewport">
			<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
		</div>







<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>

<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>


<script type="text/javascript">
		var global_loading=document.getElementById("global_loading");
		global_loading.parentNode.removeChild(global_loading);
</script>



<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
<?php  echo $this->getKFcode();?>