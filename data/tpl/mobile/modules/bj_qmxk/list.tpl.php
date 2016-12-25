<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<?php  if($theone['ischeck'] == 1) { ?>
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjcommon.css?x=466866" rel="stylesheet" type="text/css" />
<?php  } ?>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-1.6.2.min.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.lazyload.js?x=<?php echo BJ_QMXK_VERSION;?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".row_list img").lazyload({
		placeholder: "<?php echo BJ_QMXK_ROOT;?>/recouse/images//img_bg4.png",
		effect: "fadeIn"
	});
	$("#submit").click(function() {
		if($("#search_word").val()){
			$("#searchForm").submit();
		} else {
			alert("请输入关键词！");
			return false;
		}
	});
});
</script>

</head>
<body style="margin:0 auto; padding:0 auto">


 <?php  if($theone['ischeck'] == 1 ) { ?>

   
  
 
<div id="viewport" class="viewport">
  <div class="slider card card-nomb" style="visibility: visible;">
    <!-- banner轮播Start -->
    <script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/TouchSlide.1.1.js"></script>
    <div id="focus" class="focus">
      <div class="hd">
        <ul>
        </ul>
      </div>
      <div class="bd">
        <ul>
       <?php  if(is_array($advs)) { foreach($advs as $adv) { ?>
        <li><a href="<?php  if(empty($adv['link'])) { ?><?php  } else { ?>http://<?php  echo $adv['link'];?><?php  } ?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $adv['thumb'];?>" /></a></li>
		<?php  } } ?>
        </ul>
      </div>
    </div>
    <script type="text/javascript">
	TouchSlide({ 
		slideCell:"#focus",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul",
		delayTime:600,
		interTime:4000,
		effect:"leftLoop", 
		autoPlay:true,//自动播放
		autoPage:true, //自动分页
		switchLoad:"_src" //切换加载，真实图片路径为"_src" 
	});
	</script>
    <!-- banner轮播End -->
  </div>

<div id="home-page" data-role="page" data-member-sn="ejWCX" data-member-subscribe="true">
  <div role="main" class="ui-content ">

  







 


	<div class="WX_search1" style="float:left; width:100%" id="mallHead">
	<form class="WX_search_frm1" action="mobile.php" id="searchForm" name="searchForm">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="eid" value="<?php  echo $_GPC['eid'];?>" />
		<input type="hidden" name="name" value="bj_qmxk" />
		<input type="hidden" name="do" value="Search" />
		<input type="hidden" name="weid" value="<?php  echo $_GPC['weid'];?>" />
        <input name="keyword" id="search_word" class="WX_search_txt hd_search_txt_null" placeholder="请输入商品名进行搜索！" ptag="37080.5.2" type="search" value=""  AUTOCOMPLETE="off"/> 
    <div class="WX_me">
        <a href="javascript:;" id="submit" class="WX_search_btn_blue"  style="background:#ffcc00"  >搜索</a>      
    </div>
	 </form>
</div>


	 <?php  } ?>
		
 	 <?php  if(!empty($theone['terms']) ) { ?>
  <div class="zidingyi">
 <?php  echo $theone['terms'];?>
 </div> <?php  } ?>

 
<?php  if($theone['ischeck'] == 1 ) { ?>

    <div class="home-categories"  >
       <?php  if(is_array($category)) { foreach($category as $row) { ?>
    		<?php  if($row['isrecommand']==1&&$row['total']>0) { ?> 
      <div class="category-container" style="background-color:#ffffff;">
		  <div class="category-name" style="height:40px;padding-top:15px;">
	          <a class="category-url" href="<?php  echo $this->createMobileUrl('list2', array('pcate' => $row['id']))?>">
	              <div class="name-border" style="background:#ff9900;" ></div>
	              <div class="name" style="font-size:20px;"   ><?php  echo $row['name'];?></div>
					     <div class="name-more">
                  <i class="icons-arrow-right2"></i>
                </div>
                  <div class="text-more" style=" height:30px;"> <a href="<?php  echo $this->createMobileUrl('list2', array('pcate' => $row['id']))?>" style="color:#ff9900;border:1px #FF9900 solid; border-radius:8px;padding-left:2px;">查看更多</a></div>
				
	            </div>

	          	</a>
			  </div>
			
	
          <ul class="os_box_list" >
		  
         

	
		<?php  if(is_array($rlist)) { foreach($rlist as $item) { ?>
			 <?php  if($row['id'] == $item['pcate']) { ?>
			 	
                          <li>
                              <a href="<?php  echo $this->createMobileUrl('detail', array('id' => $item['id']))?>" class="item">
                                 
                                  <div class="img"><img src="<?php  echo $_W['attachurl'];?><?php  echo $item['thumb'];?>"  usesrc="1" alt=""></div>
                                  <div class="txt"><?php  echo $item['title'];?></div>
                                  
                                  <div class="buy">
                                      <span class="price"><strong><em>¥<?php  echo $item['marketprice'];?></em></strong><del>¥<?php  echo $item['productprice'];?></del></span>
                                  
                                  </div>
                              </a>
                          </li>
						  
						  <?php  } ?>
		  <?php  } } ?>

       
		
          </ul>
   			 <?php  } ?>
       <?php  } } ?>
    </div>

 </div>
</div>         
 </div>
	<div class="viewport">
	<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
		</div>



<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
﻿<!--页面底部-->



<?php  } ?>
<?php  if($shownotice == true) { ?>

<style>
.mui-bar-tab {<?php  if($theone['ischeck'] == 1) { ?>top: 0;<?php  } else { ?>bottom: 0;<?php  } ?>display: table;width: 100%;height: 50px;padding: 0;table-layout: fixed;border-top: 0;border-bottom: 0;}
.mui-bar {position: fixed;right: 0;left: 0;z-index: 10;height: 44px;padding-right: 10px;padding-left: 10px;filter:alpha(opacity=50); background:rgba(49, 48, 48, 0.5) none repeat scroll 0 0 !important;border-bottom: 0;-webkit-backface-visibility: hidden;backface-visibility: hidden;}
.mui-btn {position: relative;top: 7px;z-index: 20;padding: 6px 12px 7px;margin-top: 0;font-weight: 400;}
.mui-btn-warning {color: #fff;background-color: #f0ad4e;border: 1px solid #f0ad4e;float: right;margin-right: 5px;font-size: 15px;line-height: 21px;}
</style>
   <nav class="mui-bar mui-bar-tab" style="z-index:99999;font-family: Helvetica,STHeiti STXihei, Microsoft JhengHei, Microsoft YaHei, Arial;">
                <img src="<?php  if(empty($fans['avatar'])) { ?><?php echo BJ_QMXK_ROOT;?>/style/images/yh.png<?php  } else { ?><?php  echo $fans['avatar'];?><?php  } ?>" style="width:40px;height:40px;float:left;margin:5px;">
                <div style="color:#ffffff;font-size:12px;font-weight:500;line-height:20px;float:left;margin-top: 5px;"><span style="color:#31FF00;font-size:13px;"><?php  echo $fans['nickname'];?></span><br>您还未关注<?php  echo $_W['account']['name'];?>！</div>
                <button onClick="location.href='<?php  echo $ydyy;?>';" class="mui-btn mui-btn-warning" style="float:right;margin-right:15px;font-size:15px;">点击关注</button>
            </nav>
   
<?php  } ?>
<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
Zepto(function($){
   var $nav = $('.global-nav'), $btnLogo = $('.global-nav__operate-wrap');
   //点击箭头，显示隐藏导航
   $btnLogo.on('click',function(){
     if($btnLogo.parent().hasClass('global-nav--current')){
       navHide();
     }else{
       navShow();
     }
   });
   var navShow = function(){
     $nav.addClass('global-nav--current');
   }
   var navHide = function(){
     $nav.removeClass('global-nav--current');
   }
   
   $(window).on("scroll", function() {
		if($nav.hasClass('global-nav--current')){
			navHide();
		}
	});
})
function get_search_box(){
	try{
		document.getElementById('get_search_box').click();
	}catch(err){
		document.getElementById('keywordfoot').focus();
 	}
}
</script>

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>

<?php  if(!empty($qq)) { ?>
<div style="position:fixed;right:5px;bottom:70px;"><div id="to_user_list" style="color:#323232;outline-style:none;text-decoration:none;width:78px;display:block;height:16px;padding:7px 7px 8px;border-top-left-radius:25px;border-top-right-radius:25px;border-bottom-right-radius:25px;border-bottom-left-radius:25px;box-shadow:rgba(0, 0, 0, 0.4) 0px 0px 2px 0px;background-color:#00BC06;"><div id="to_user_list_icon_div" class="rel left" style="float:left;position:relative;width:20px;height:16px;border-top-left-radius:10px;border-top-right-radius:10px;border-bottom-right-radius:10px;border-bottom-left-radius:10px;background-color:#FFFFFF;"><span class="to_user_list_icon_em_a abs" style="margin:0px;padding:0px;list-style:none;position:absolute;width:2px;height:2px;border-top-left-radius:1px;border-top-right-radius:1px;border-bottom-right-radius:1px;border-bottom-left-radius:1px;top:8px;left:4px;background-color:#00BA0A;"><a target="_blank"><span style="color:#FFFFFF;"> </span></a></span><span class="to_user_list_icon_em_b abs" style="margin:0px;padding:0px;list-style:none;position:absolute;width:2px;height:2px;border-top-left-radius:1px;border-top-right-radius:1px;border-bottom-right-radius:1px;border-bottom-left-radius:1px;top:8px;left:9px;background-color:#00BA0A;"><a target="_blank"><span style="color:#FFFFFF;"> </span></a></span><span class="to_user_list_icon_em_c abs" style="margin:0px;padding:0px;list-style:none;position:absolute;width:2px;height:2px;border-top-left-radius:1px;border-top-right-radius:1px;border-bottom-right-radius:1px;border-bottom-left-radius:1px;top:8px;right:4px;background-color:#00BA0A;"><a  target="_blank"><span style="color:#FFFFFF;"> </span></a></span><span class="to_user_list_icon_em_d abs" style="margin:0px;padding:0px;list-style:none;position:absolute;width:0px;height:0px;border-style:solid;border-width:4px;top:14px;left:6px;border-color:#FFFFFF transparent transparent;"><a target="_blank"><span style="color:#FFFFFF;"> </span></a></span></div><p id="to_user_list_txt" class="left" style="margin-top:0px;margin-bottom:0px;padding:0px 3px 0px 4px;list-style:none;float:left:5px;color:#FFFFFF;font-size:12px;line-height:16px;"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $qq;?>&site=qq&menu=yes" target="_blank"><span style="color:#FFFFFF;"> 联系客服</span></a></p></div></div>
<?php  } ?>






</body>
</html>
<?php  echo $this->getKFcode();?>