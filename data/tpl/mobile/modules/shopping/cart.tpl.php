<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript" src="./source/modules/shopping/images/jquery.gcjs.js"></script>
<link type="text/css" rel="stylesheet" href="./source/modules/shopping/images/style.css">
<style>
.shopcart-footer{margin-bottom:30px;}
</style>
<div class="head">
	<a href="javascript:history.back();" class="bn pull-left"><i class="icon-angle-left"></i></a>
	<span class="title">购物车</span>
                 <a href="javascript:void(0)" onclick="clearCart()" class="bn pull-right" style="font-size:18px;"><i class="icon-trash"></i> 清空</a>
</div>
<div class="shopcart-main img-rounded">
<!--	<div class="shopcart-hd">
		<span class="pull-left"><?php  if(empty($_W['account']['name'])) { ?>维航团队<?php  } else { ?><?php  echo $_W['account']['name'];?><?php  } ?>>></span>
		<a class="pull-right icon-remove-sign" href="<?php  echo $this->createMobileUrl('clear');?>" onclick="return confirm('此操作不可恢复，确认？'); return false;"></a>
	</div>-->
<div style='text-align:center;padding:50px 0 50px 0; <?php  if(count($list)>0) { ?>display:none<?php  } ?>' id='cartempty'>
    <img src='./source/modules/shopping/images/icon_cart_empty.png' /><br/><br/>
    <span style='color:#adadad'>您的购物车空空如也，赶紧去选购吧~~</span>
</div>
 
	<?php  if(is_array($list)) { foreach($list as $item) { ?>
	<?php  $price += $item['totalprice'];?>
        
                  <?php  $goods = $item['goods']?>
                    <span id="stock_<?php  echo $item['id'];?>" style='display:none'><?php  echo $goods['total'];?></span>
	<div class="shopcart-item" id='item_<?php  echo $item['id'];?>' style='height:<?php  if(!empty($goods['optionname'])) { ?>130px;<?php  } else { ?>120px<?php  } ?>'>
		<img src="<?php  echo $_W['attachurl'];?><?php  echo $goods['thumb'];?>">
		<div class="shopcart-item-detail">
                    <div class="name"><?php  echo $goods['title'];?><?php  if($goods['unit']) { ?><?php  } ?></div>
                     <?php  if(!empty($goods['optionname'])) { ?><div class="price">规格：<span><?php  echo $goods['optionname'];?></span></div><?php  } ?>
                       
                        <div class="price">单价：<span id="singleprice_<?php  echo $item['id'];?>"><?php  echo $goods['marketprice'];?></span> 元<?php  if(!empty($goods['unit'])) { ?> / <?php  echo $goods['unit'];?><?php  } ?></div>
			<div class="price">小计：<span class='singletotalprice' id="goodsprice_<?php  echo $item['id'];?>"><?php  echo $item['totalprice'];?></span> 元</div>
			<div class="input-group">
				<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" onclick="reduceNum(<?php  echo $item['id'];?>)"><i class="icon-minus"></i></button>
				</span>
				<input type="tel" class="form-control input-sm pricetotal goodsnum" style="border-left:0;" value="<?php  echo $item['total'];?>" price="<?php  echo $goods['marketprice'];?>" pricetotal="<?php  echo $item['totalprice'];?>" id="goodsnum_<?php  echo $item['id'];?>" cartid='<?php  echo $item['id'];?>' maxbuy="<?php  echo $goods['maxbuy'];?>" />
				<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" onclick="addNum(<?php  echo $item['id'];?>,<?php  echo $goods['maxbuy'];?>)"><i class="icon-plus"></i></button>
				</span>
			</div>
		</div>
		<a href="javascript:;" onclick="removeCart(<?php  echo $item['id'];?>)" class="shopcart-item-remove"><i class="icon-remove"></i> 删除</a>
	</div>
                   
                  <?php  $n++;?>
	<?php  } } ?>
</div>
<div style='height:80px;width:100%;'>&nbsp;</div>
<div id='cartfooter' class="shopcart-footer" <?php  if(count($list)<=0) { ?>style='display:none'<?php  } ?>'>
	<span class="pull-left">合计：<span id="pricetotal"><?php  echo $price;?></span> 元</span>
	<a href="<?php  echo $this->createMobileUrl('confirm')?>" class="btn btn-success pull-right">立即结算</a>
</div>
</div>
<script type="text/javascript">
    $(function(){
        $(".goodsnum").blur(function(){
            var id = $(this).attr("cartid");
            if($(this).isInt()){
              var num = parseInt( $("#goodsnum_" + id).val() );
              var maxbuy = parseInt( $(this).attr("maxbuy") );
              var mb = maxbuy;
              var stock =$("#stock_" + id).html()==''?-1:parseInt($("#stock_" + id).html());
              if(mb>stock && stock!=-1){
                  mb = stock;
              }
         
              if(num>mb && mb>0){
                    tip("最多只能购买 " + mb + " 件!",true);
                    $("#goodsnum_" + id).val(mb);
                    return;
                }
               updateCart(id,num);
            }
            else{
                $(this).val("1");
                updateCart(id,1);
            }
            
        })
        
    })
function clearCart(){
    if (confirm('确定要清空购物车吗？')) {
        tip("正在处理数据...");
        $.getJSON('<?php  echo $this->createMobileUrl('mycart',array('op'=>'clear'));?>', function(s){
            $(".shopcart-item").remove();
            $("#cartempty").show();
            $("#cartfooter").hide();
            tip_close();
        });
    }
}
function removeCart(id){
    if (confirm('您确定要删除此商品吗？')) {
        tip("正在处理数据...");
        var url  = '<?php  echo $this->createMobileUrl('mycart', array('op'=>'remove'))?>' + "&id=" + id;
        $.getJSON(url, function(s){
            $("#item_" + s.cartid).remove();
            if($(".shopcart-item").length<=0){
                $("#cartempty").show();
                $("#cartfooter").hide();
            }
            tip_close();
            canculate();
        });
    }
}
function updateCart(id,num){
    
      var url  = '<?php  echo $this->createMobileUrl('mycart', array('op'=>'update'))?>' + "&id=" + id+"&num=" + num;
      $.getJSON(url, function(s){
        
      });
}
function checkMaxBuy(id, maxbuy){
    
   
}
function addNum(id,maxbuy){
    var mb = maxbuy;
     var stock =$("#stock_" + id).html()==''?-1:parseInt($("#stock_" + id).html());
              if(mb>stock && stock!=-1){
                  mb = stock;
              }
 
    var num = parseInt( $("#goodsnum_" + id).val() ) + 1;
    if(num>mb && mb>0){
        tip("最多只能购买 " + mb + " 件!",true);
        return;
    }
    $("#goodsnum_" + id).val(num);
    var price = parseFloat( $("#singleprice_"+id).html() ) * num;
    $("#goodsprice_" + id).html(price);
    canculate();
    updateCart(id,num);
}
function reduceNum(id){
    var num = parseInt( $("#goodsnum_" + id).val() );
    if(num-1<=0){
        return;
    }
    num--;
    $("#goodsnum_" + id).val(num);
    var price = parseFloat( $("#singleprice_"+id).html() ) * num;
    $("#goodsprice_" + id).html(price);
    canculate();
    updateCart(id,num);
}
function canculate(){
    var total = 0;
    $(".singletotalprice").each(function(){
 
        total+=parseFloat( $(this).html() );
    });
 
    $("#pricetotal").html(total);
}
</script>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('footerbar', TEMPLATE_INCLUDEPATH);?>