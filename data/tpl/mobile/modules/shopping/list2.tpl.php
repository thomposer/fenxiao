<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php  if(empty($_W['isajax'])) { ?>
<?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<style>
.show-more {padding-bottom:30px;}
</style>
<link type="text/css" rel="stylesheet" href="./source/modules/shopping/images/style.css">
<div class="head">
	<a href="javascript:;" onclick="$('.head .order').toggleClass('hide');" class="bn pull-left"><i class="icon-reorder"></i></a>
	<span class="title">
            <?php  if($_GPC['isnew']==1) { ?>新品推荐<?php  } ?>
            <?php  if($_GPC['ishot']==1) { ?>热卖商品<?php  } ?>
            <?php  if($_GPC['isdiscount']==1) { ?>折扣商品<?php  } ?>
            <?php  if($_GPC['istime']==1) { ?>限时卖<?php  } ?>
            <?php  if($_GPC['pcate']) { ?> - <?php  echo $category[$_GPC['pcate']]['name'];?><?php  } ?>
            <?php  if($_GPC['ccate']) { ?> - <?php  echo $children[$_GPC['pcate']][$_GPC['ccate']]['name'];?><?php  } ?>
        </span>
	<a href="<?php  echo $this->createMobileUrl('mycart')?>" class="bn pull-right"><i class="icon-shopping-cart"></i><span class="buy-num img-circle" id="carttotal"><?php  echo $carttotal;?></span></a>
	<ul class="unstyled order hide">
		<?php  if(is_array($category)) { foreach($category as $item) { ?>
		<li>
			<a href="<?php  echo $this->createMobileUrl('list2', array('pcate' => $item['id']))?>" class="bigtype"><i class="icon-folder-open-alt"></i> <?php  echo $item['name'];?></a>
			<?php  if(is_array($children[$item['id']])) { foreach($children[$item['id']] as $child) { ?>
			<a href="<?php  echo $this->createMobileUrl('list2', array('ccate' => $child['id']))?>" class="smtype"><i class="icon-folder-open-alt"></i> <?php  echo $child['name'];?></a>
			<?php  } } ?>
		</li>
		<?php  } } ?>
	</ul>
</div>
<style type='text/css'>
    .sel { background:#e9342a; color:#fff;}
    .nosel { background:#fff;color:#000}
</style>
 
 
<div class="shopping-main">
     
	<form action="mobile.php" method="get">
		<input type="hidden" name="act" value="<?php  echo $_GPC['act'];?>" />
		<input type="hidden" name="eid" value="<?php  echo $_GPC['eid'];?>" />
		<input type="hidden" name="name" value="<?php  echo $_GPC['name'];?>" />
		<input type="hidden" name="do" value="<?php  echo $_GPC['do'];?>" />
		<input type="hidden" name="weid" value="<?php  echo $_GPC['weid'];?>" />
                   <?php  if($_GPC['isnew']==1) { ?><input type="hidden" name="isnew" value="1" /><?php  } ?>
            <?php  if($_GPC['ishot']==1) { ?><input type="hidden" name="ishot" value="1" /><?php  } ?>
            <?php  if($_GPC['isdiscount']==1) { ?><input type="hidden" name="isdiscount" value="1" /><?php  } ?>
            <?php  if($_GPC['istime']==1) { ?>
            <input type="hidden" name="istime" value="1" />
            <?php  } ?>
            <input type="hidden" name="sort" value="<?php  echo $sort;?>" />
		<div class="input-group">
			<input type="text" class="form-control input-lg" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入<?php  if($_GPC['isnew']==1) { ?>新品推荐<?php  } ?><?php  if($_GPC['ishot']==1) { ?>热卖商品<?php  } ?><?php  if($_GPC['isdiscount']==1) { ?>折扣商品<?php  } ?><?php  if($_GPC['istime']==1) { ?>限时卖<?php  } ?>关键字">
			<span class="input-group-btn">
				<button class="btn btn-danger btn-lg" type="submit">搜索</button>
			</span>
		</div>
	</form>
    
  
                
	<div class="list" id="list">
            
     <div style='float:left;height:30px;margin:auto;width:100%;margin-top:10px;'>
   
   <div <?php  if($sort==0) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-left-radius: 5px;border-bottom-left-radius:5px;border:1px solid #e9342a;text-align: center;float:left;width:25%' onclick="location.href='<?php  echo $sorturl;?>&sort=0&sortb0=<?php  echo $sortb00;?>'">
        按时间 <?php  if($sort==0) { ?><?php  if($sortb0=="desc") { ?><i class="icon-arrow-down"></i><?php  } else { ?><i class="icon-arrow-up"></i><?php  } ?><?php  } ?>
    </div>
         
    <div <?php  if($sort==1) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #e9342a;margin-left:-1px;float:left;width:25%;text-align: center;' onclick="location.href='<?php  echo $sorturl;?>&sort=1&sortb1=<?php  echo $sortb11;?>'">
        按销量 <?php  if($sort==1) { ?><?php  if($sortb1=="desc") { ?><i class="icon-arrow-down"></i><?php  } else { ?><i class="icon-arrow-up"></i><?php  } ?><?php  } ?>
    </div>
     <div <?php  if($sort==2) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border:1px solid #e9342a;margin-left:-1px;float:left;width:25%;text-align: center;' onclick="location.href='<?php  echo $sorturl;?>&sort=2&sortb2=<?php  echo $sortb22;?>'">
       按人气 <?php  if($sort==2) { ?><?php  if($sortb2=="desc") { ?><i class="icon-arrow-down"></i><?php  } else { ?><i class="icon-arrow-up"></i><?php  } ?><?php  } ?>
    </div>
    <div <?php  if($sort==3) { ?>class='sel'<?php  } else { ?>class="nosel"<?php  } ?> style='border-top-right-radius: 5px;margin-left:-1px;border-bottom-right-radius:5px;text-align: center;border:1px solid #e9342a;float:left;width:25%' onclick="location.href='<?php  echo $sorturl;?>&sort=3&sortb3=<?php  echo $sortb33;?>'">
        按价格 <?php  if($sort==3) { ?><?php  if($sortb3=="desc") { ?><i class="icon-arrow-down"></i><?php  } else { ?><i class="icon-arrow-up"></i><?php  } ?><?php  } ?>
    </div>
  
</div>
            
		<div class="list-tips">  
                    <?php  if($_GPC['isnew']==1) { ?>新品推荐<?php  } ?>
            <?php  if($_GPC['ishot']==1) { ?>热卖商品<?php  } ?>
            <?php  if($_GPC['isdiscount']==1) { ?>折扣商品<?php  } ?>
            <?php  if($_GPC['istime']==1) { ?>限时卖<?php  } ?>  共<b><?php  echo $total;?></b>种</div>
<?php  } ?>
<?php  if(is_array($list)) { foreach($list as $item) { ?>
<div class="list-item img-rounded">
	<div>
		<a href="<?php  echo $this->createMobileUrl('detail', array('id' => $item['id']))?>"><img src="<?php  echo $_W['attachurl'];?><?php  echo $item['thumb'];?>"></a>
		<span class="title"><a href="<?php  echo $this->createMobileUrl('detail', array('id' => $item['id']))?>"><?php  echo $item['title'];?></a><?php  if($item['type'] == '2') { ?>(虚拟)<?php  } ?></span>
		<?php  if($item['istime']==1) { ?>
                 <span style='text-align: center;margin-left:10px;margin-right:10px;color:white;font-size:11px;' class='label label-danger' id="time_<?php  echo $item['id'];?>"><?php  echo $item['timelaststr'];?></span>
                 <script language='javascript'>
                     var total_time_<?php  echo $item['id'];?> = <?php  echo $item['timelast'];?>;  
                         var int_time_<?php  echo $item['id'];?>  = setInterval(function(){
                             d(<?php  echo $item['id'];?>);
                         },1000);
                     </script>
                <?php  } ?>
	</div>
	<span class="sold">
		<span class="soldnum pull-left">已售<?php  echo $item['sales'];?>件</span>
		<span class="price pull-right"><?php  echo $item['marketprice'];?>元 <?php  if($item['unit']) { ?> / <?php  echo $item['unit'];?><?php  } ?></span>
	</span>
<!--	<div class="add-cart" onclick="order.add(<?php  echo $item['id'];?>)"><i class="icon-shopping-cart"></i> 添加到购物车</div>-->
</div>
<?php  } } ?>
<?php  if(empty($_W['isajax'])) { ?>
	</div>
	<div class="show-more"><a href="javascript:;" onclick="loadPage('<?php  echo $pindex;?>', 'list')" class="img-rounded" id="pager">浏览更多商品</a></div>
</div>
<script type="text/javascript">
	function loadPage(pindex, container) {
		pindex = parseInt(pindex) + 1;
                $('#pager').html('正在加载数据...');
		$.get(location.href, {'page' : pindex}, function(html){
			if (html.indexOf('list-item') > -1) {
				$('#'+container).append(html);
				$('#pager').get(0).onclick = function(){
					loadPage(pindex, container);
				}
                                $('#pager').html("浏览更多商品");
			} else {
				$('#pager').html('已经显示全部商品');
			}
		});
	}
          
function d(id){
            eval("total_time_" + id+"--");
            var total_time = eval("total_time_" + id);
          
           var days = parseInt(total_time/86400)
           
           var remain = parseInt(total_time%86400);
            var hours = parseInt(remain/3600)
              var remain = parseInt(remain%3600);
    
     var mins = parseInt(remain/60);
     var secs = parseInt(remain%60);
     
            if (total_time <= 0) {
                $("#time_" + id).html( "时间到了");
                var int_time =  eval("int_time_" + id);
                window.clearInterval(int_time);
          
            } else {
                
                var ret = "";
                if(days>0){
                    days = days+"";
                    if(days.length<=1) { days="0"+days;}
                    ret+=days+" 天 ";
                }
                if(hours>0){
                    hours = hours+"";
                    if(hours.length<=1) { hours="0"+hours;}
                    ret+=hours+":";
                }
                if(mins>0){
                        mins = mins+"";
                    if(mins.length<=1) { mins="0"+mins;}
                    ret+=mins+":";
                }
              
                       secs = secs+"";
                     if(secs.length<=1) { secs="0"+secs;}
                     ret+=secs;
             
     
                $("#time_" + id).html( "倒计时 " +ret);
            }
        }

</script>
 
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('footerbar', TEMPLATE_INCLUDEPATH);?>
<?php  } ?>