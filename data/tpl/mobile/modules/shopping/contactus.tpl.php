<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<link type="text/css" rel="stylesheet" href="./source/modules/shopping/images/style.css">
<div class="head">
  <a href="javascript:history.back();" class="bn pull-left"><i class="icon-angle-left"></i></a>
    <span class="title">品牌介绍</span>
    <a href="<?php  echo $this->createMobileUrl('list')?>" class="bn pull-right"><i class="icon-home"></i></a>
</div>

<div class="tabbable" style="padding-bottom:30px;">
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
<div class="mobile-div img-rounded" style="text-align: center; padding:10px;font-weight:bold;overflow:hidden;word-break:break-all">
     <?php  if(!empty($cfg['logo'])) { ?>
 <img src="<?php  echo $_W['attachurl'];?><?php  echo $cfg['logo'];?>" width="100%" />
 <?php  } ?>
 
 <?php  if(!empty($cfg['shopname'])) { ?>
<br/><br/><?php  echo $cfg['shopname'];?>
 <?php  } else { ?>
<br/><br/>品牌介绍
 <?php  } ?>
  </div>
 
            <div class="mobile-div img-rounded">
                
                <?php  if(!empty($cfg['phone'])) { ?>
                <a href="tel:<?php  echo $cfg['phone'];?>" class="mobile-li"><i class="icon-hand-up pull-right"></i>
                 电话： <?php  echo $cfg['phone'];?></a>
                <?php  } ?>
                
                <?php  if(!empty($cfg['address'])) { ?>
                <a href="http://api.map.baidu.com/geocoder?address=<?php  echo $cfg['address'];?>&output=html" class="mobile-li"><i class="icon-hand-up pull-right"></i>
                地址：	<?php  echo $cfg['address'];?></a>
                <?php  } ?>
                
            </div>
             <?php  if(!empty($cfg['description'])) { ?>
              <div class="mobile-div img-rounded " style='overflow:hidden;word-break:break-all;padding:10px;'>
                  <?php  echo $cfg['description'];?>
              </div>
             <?php  } ?>

        </div>






    </div>
</div>

<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('footerbar', TEMPLATE_INCLUDEPATH);?>