<?php defined('IN_IA') or exit('Access Denied');?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  if($level==1) { ?>一级会员<?php  } ?><?php  if($level==2) { ?>二级会员<?php  } ?><?php  if($level==3) { ?>三级会员<?php  } ?>名单</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
     <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/pr4.css?v=<?php echo BJ_QMXK_VERSION;?>">
     
     

   
</head>
<body>
     <!--   <nav class="tab-bar">
            <section class="left-small">
                <a href="<?php  echo $this->createMobileUrl('fansindex')?>" class="menu-icon"><span></span></a>
            </section>
            <section class="middle tab-bar-section">
                <h1 class="title">会员名单</h1>
            </section>
        </nav>-->
 <?php  if(empty($fansall)) { ?>
       
       
                
                   <div class="disorder-none"><i class="icon-none"></i><span class="nonetext">您还没有<?php  if($level==1) { ?>一级<?php  } ?><?php  if($level==2) { ?>二级<?php  } ?><?php  if($level==3) { ?>三级<?php  } ?><?php  if($level<=3) { ?><?php  if($flag==1) { ?>代理<?php  } else { ?>会员<?php  } ?><?php  } ?><?php  if($level==4) { ?>推广点击<?php  } ?><?php  if($level==5) { ?>成功关注<?php  } ?>！</span></div>
        
            
       
			
			<?php  } else { ?>
<div class="list-myorder" style="margin-top:10px;">
    
		 
    <ul class="ul-product" >
	
	
	
        		  <?php  if(is_array($fansall)) { foreach($fansall as $fans) { ?>
        <li>
       
                <span class="pic">
                    <img src="<?php  if(empty($fans['avatar'])) { ?><?php echo BJ_QMXK_ROOT;?>/style/images/yh.png<?php  } else { ?><?php  echo $fans['avatar'];?><?php  } ?>"></span>
                <div class="text">
                    <span class="pro-name">昵称：<?php  echo $fans['realname'];?></span>
                    
                     <div class="pro-pric"><span>关注时间：</span><?php  echo date('Y-m-d', $fans['createtime']);?></div>
                      <div class="pro-pric"><span>推荐上级：</span><?php  echo $this->getParentNickName($fans['from_user']);?></div>
              
                </div>
        
            
        </li>
			
			<?php  } } ?>
		
        
    </ul>
    
   


    

  
    
</div>
	<?php  } ?>
<!--01 end-->
<?php  echo $pager;?>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
