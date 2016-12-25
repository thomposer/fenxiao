<?php
/**
*$paytype 付款方式
*$goods订单列表
*$order 订单信息
*$address 联系地址
*/
 $body = "";
$goodsstr="";
 if (!empty($goods)) {
    foreach ($goods as $row) {

                        $goodsstr .= "\n{$row['title']} ({$ordergoods[$row['id']]['total']})\n";
                    }
        }

$body .= "产品名称：$row[title] \n";
$body .= "总金额：$order[price] \n";
   		$body .= "收货人：$address[realname] \n";
      $body .= "地区：$address[province] - $address[city] - $address[area]\n";
      $body .= "详细地址：$address[address] \n";
      $body .= "手机：$address[mobile] \n";
      
      //发送格式
      //此格式的消息模板为：
      //		您好，您已购买成功。
			//		商品信息：{{name.DATA}}
			//		{{remark.DATA}}
      $datas=array(
							'first'=>array('value'=>'订单提交成功，请您收到货时付款！','color'=>'#173177'),
							'product'=> array('value'=>$goodsstr,'color'=>'#173177'),
								'price'=> array('value'=>$order['price'],'color'=>'#173177'),
								'time'=> array('value'=>date('Y-m-d', time()),'color'=>'#173177'),
								'remark'=> array('value'=>$body,'color'=>'#173177'),
			);
			$data=json_encode($datas); //发送的消息模板数据
	  
?>
	