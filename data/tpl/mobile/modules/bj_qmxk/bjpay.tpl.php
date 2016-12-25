<?php defined('IN_IA') or exit('Access Denied');?><?php  $bootstrap_type = 3;?>
<?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>

   <style>
        .wx_loading{position:fixed;top:0;left:0;bottom:0;right:0;z-index:90;background-color:rgba(0,0,0,0);font-family:Helvetica,STHeiti STXihei,Microsoft JhengHei,Microsoft YaHei,Arial;line-height:1.5}.wx_loading_inner{text-align:center;background-color:rgba(0,0,0,0.5);color:#fff;position:fixed;top:50%;left:50%;margin-left:-70px;margin-top:-48px;width:140px;border-radius:6px;font-size:14px;padding:58px 0 10px 0}.wx_loading_icon{position:absolute;top:15px;left:50%;margin-left:-16px;width:24px;height:24px;border:2px solid #fff;border-radius:24px;-webkit-animation:gif 1s infinite linear;animation:gif 1s infinite linear;clip:rect(0 auto 12px 0)}@keyframes gif{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes gif{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}
    </style>

<div class="wx_loading" id="wxloading">
        <div class="wx_loading_inner">
            <i class="wx_loading_icon"></i>
            正在提交订单请稍后...
        </div>
   </div>
	<?php  if($paytype==2) { ?>

		<form action="<?php  echo create_url('mobile/cash/alipay', array('weid' => $_W['weid']));?>" method="post" style="display:none;">
			<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
			<button class="btn btn-warning btn-lg" type="submit" id="actionbton"  name="alipay">支付宝支付</button>
		</form>
	<script type="text/javascript">
			document.getElementById('actionbton').click();
	</script>
	<?php  } ?>
	<?php  if($paytype==1) { ?>

		<form action="<?php  echo create_url('mobile/cash/wechat', array('weid' => $_W['weid']));?>" method="post" style="display:none;">
			<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
			<button class="btn btn-warning btn-lg" type="submit" id="actionbton"  value="wechat">微信支付</button>
		</form>
	<script type="text/javascript">
		document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
			$('#actionbton').removeAttr('disabled');
			$('#actionbton').html('微信支付');
					document.getElementById('actionbton').click();
		});
	</script>
	<?php  } ?>

	<?php  if($paytype==3) { ?>

		<form action="" method="post" style="display:none;">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			<button class="btn btn-warning btn-lg" name="credit2submit"  type="submit" id="credit2submit"  value="credit">余额支付</button>
		</form>
	<script type="text/javascript">
			document.getElementById('credit2submit').click();
	</script>
	<?php  } ?>
	<?php  if($paytype==0) { ?>
	
		<form action="" method="post" style="display:none;">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		<button type="submit" name="codsubmit" value="yes" id="actionbton" class="btn btn-warning btn-lg">货到付款</button>
		</form>
	<script type="text/javascript">
			document.getElementById('actionbton').click();
	</script>
	<?php  } ?>