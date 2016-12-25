<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content=" initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="./source/modules/bigwheel/template/style/style.css" media="all" />
	<script type="text/javascript" src="./source/modules/bigwheel/template/style/zepto.js"></script>
	<script type="text/javascript" src="./source/modules/bigwheel/template/style/alert.js"></script>	
    <title>大转盘</title>
</head>
<body class="activity-lottery-winning">
    <div class="main">
       
        <div id="outercont">
            <div id="outer-cont">
                <div id="outer"><img src="./source/modules/bigwheel/template/style/activity-lottery-3.png"></div>
            </div>
            <div id="inner-cont">
                <div id="inner">
                    <img src="./source/modules/bigwheel/template/style/activity-lottery-2.png">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="boxcontent boxyellow" id="result" <?php  if(!(!empty($awardone)&&empty($fans['tel']))) { ?>style="display:none"<?php  } ?>>
                <div class="box">
                    <div class="title-orange"><span>恭喜你中奖了</span></div>
                    <div class="Detail">
                        <p>你中了：<span class="red" id="prizetype"><?php  if(empty($awardone['name'])) { ?>感谢参与<?php  } else { ?><?php  echo $awardone['name'];?> -  <?php  echo $awardone['description'];?><?php  } ?></span></p>
                        <p style="display:none">兑奖<?php  echo $reply['sn_rename'];?>：<span class="red" id="sncode"><?php  echo $awardone['award_sn'];?></span></p>
						<!--<p class="red" id="P1">你已经兑奖成功,本SN码自动作废! </p>-->
						<p class="red" id="red">本次兑奖码已经关联你的微信号，你可向公众号发送【<?php  $tempArr=explode(',',$reply['keyword']);echo $tempArr['0'];?>】进行查询!  </p>
                        <p><input name="tel" class="px" id="tel" value="<?php  echo $_W['fans']['mobile'];?>" type="text" placeholder="用户请输入您的<?php  echo $reply['tel_rename'];?>"></p>
                        <p><input class="pxbtn" name="提 交" id="save-btn" type="button" value="用户提交"></p>
                    </div>
                </div>
            </div>
			<?php  if($isshare==1) { ?>
            <div class="boxcontent boxyellow">
				<div class="box">
					<div class="title-orange">参与方法:</div>
					<div class="Detail"><?php  echo htmlspecialchars_decode($reply['share_txt'])?></div>
					</div>
				</div>
			</div>	
			<?php  } ?>			
            <div class="boxcontent boxyellow">
                <div class="box">
                    <div class="title-green"><span>奖项设置：</span></div>
                    <div class="Detail">
                        <?php  echo $awardstr;?>                                                                                                                                        </div>
					</div>
				</div>
            </div>
            <div class="boxcontent boxyellow">
                <div class="box">
                    <div class="title-green">活动说明：</div>
                    <div class="Detail">
						<p class="red" ><?php  echo $detail;?></p>
						<p class="green" >活动时间: <br><?php  echo date('Y-m-d H:i',$reply['starttime']);?> 至 <?php  echo date('Y-m-d H:i',($reply['endtime']+86399));?></p>
						<p><?php  echo $reply['description'];?></p>
                    </div>
                </div>
            </div>
			<?php  if(!empty($award)) { ?>
			<div class="boxcontent boxwhite">
				<div class="box">
					<div class="title-red"><span>恭喜你中奖了</span></div>
					<div class="Detail">
						<?php  if(is_array($award)) { foreach($award as $row) { ?>
						<p>你中了：<span class="red" id="name"><?php  if(empty($row['name'])) { ?>感谢参与<?php  } else { ?><?php  echo $row['name'];?>  -  <?php  echo $row['description'];?> <?php  } ?></span></p>
						<p>兑奖<?php  echo $reply['sn_rename'];?>：<span class="red" id="sncode" ><?php  echo $row['award_sn'];?></span></p>
						<?php  } } ?>
						<p class="red">本次兑奖码已经关联你的微信号，你可以发送【<?php  echo $tempArr['0'];?>】进行查询.<br/>
						<?php  echo $reply['ticket_information'];?></p>
					</div>
				</div>
			</div>	
			<?php  } ?>			
        </div>
	</div>

    <script type="text/javascript">
        $(function () {
            window.requestAnimFrame = (function () {
                return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60)
                }
            })();
            var totalDeg = 360 * 3 + 0;
            var steps = [];
            var lostDeg = [30, 90, 150, 210, 270, 330];
            var prizeDeg = [6, 66, 126, 186, 246, 306];
            var prize, sncode,prizename,prizedes;
            var count = 0;
            var now = 0;
            var a = 0.01;
            var outter, inner, timer, running = false;
            function countSteps() {
                var t = Math.sqrt(2 * totalDeg / a);
                var v = a * t;
                for (var i = 0; i < t; i++) {
                    steps.push((2 * v * i - a * i * i) / 2)
                }
                steps.push(totalDeg)
            }
            function step() {
                outter.style.webkitTransform = 'rotate(' + steps[now++] + 'deg)';
                outter.style.MozTransform = 'rotate(' + steps[now++] + 'deg)';
                if (now < steps.length) {
                    running = true;
                    requestAnimFrame(step)
                } else {
                    running = false;
                    setTimeout(function () {
                        if (prize != null) {
                            $("#sncode").text(sncode);
                            $("#prizetype").text(prizename + " - " + prizedes);
                            $("#result").slideToggle(500);
                            //$("#outercont").slideUp(500)
                        } else {
                            alert("<?php  echo $reply['repeat_lottery_reply'];?>")
                        }
                    },
                    200)
                }
            }
function run(){
     running = true;
                        timer = setInterval(function () {
                            i += 5;
                            outter.style.webkitTransform = 'rotate(' + i + 'deg)';
                            outter.style.MozTransform = 'rotate(' + i + 'deg)'
                        },
                        1)
}
            function start(deg) {
                deg = deg || lostDeg[parseInt(lostDeg.length * Math.random())];
                running = true;
                clearInterval(timer);
                totalDeg = 360 * 2 + deg;
                steps = [];
                now = 0;
                countSteps();
                requestAnimFrame(step)
            }
            window.start = start;
            outter = document.getElementById('outer');
            inner = document.getElementById('inner');
            i = 10;
            $("#inner").click(function () {
	  if (running) return;
                /*if (prize != null) {
                    alert("亲，你不能再参加本次活动了喔！下次再来吧~");
                    return
                }*/
 
                $.ajax({
                    url: "<?php  echo $this->createMobileUrl('getaward', array('id' => $id))?>",
                    dataType: "json",
                    data: {
                        t: Math.random()
                    },
                    beforeSend: function () {
                       
                    },
                    success: function (data) {
                        if (data.success) {
                            
                            if(data.success==1) {
                                run();
                                prize = data.prizetype;
                                prizename = data.name;
                                prizedes = data.award;
                                sncode = data.sn;							
                                start(prizeDeg[data.prizetype - 1]);
                                
                                if($("#count").length>0){
							$("#count").text(parseInt($("#count").text())+1);
						}
						if($("#totalcount").length>0){
							$("#totalcount").text(parseInt($("#totalcount").text())+1)
						}
                                                
                            }
                            else{
                                  prize = null;  clearInterval(timer);
                                  alert( data.msg );
                            }
                        } else {
                            prize = null;run();
                            start();
                            
                            if($("#count").length>0){
							$("#count").text(parseInt($("#count").text())+1);
						}
						if($("#totalcount").length>0){
							$("#totalcount").text(parseInt($("#totalcount").text())+1)
						}
                                                
                        }
                        running = false;
                        count++;
						
                    },
                    error: function () {
                        prize = null;
                        start();
                        running = false;
                        count++;
                    },
                    timeout: 15000
                })
				 
            })
        });
        $("#save-btn").bind("click",function () {
            var btn = $(this);
            var tel = $("#tel").val();
            if (tel == '') {
                alert("请输入手机号");
                return
            }

            var submitData = {
                    code: $("#sncode").text(),
                    tel: tel,
            };
           	$.post('<?php  echo $this->createMobileUrl('settel', array('id' => $id))?>', submitData, function(data) {
			if (data.success == true) {
				alert(data.msg);
				$("#result").slideUp(500);
				return
			} else {}
			},"json")
        });

        document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        window.shareData = {
            "imgUrl": "<?php  echo $shareimg;?>",
            "timeLineLink": "<?php  echo $sharelink;?>",
            "sendFriendLink": "<?php  echo $sharelink;?>",
            "weiboLink":  "<?php  echo $sharelink;?>",
            "tTitle":  "<?php  echo $sharetitle;?>",
            "tContent": "<?php  echo $sharedesc;?>",
            "fTitle":  "<?php  echo $sharetitle;?>",
            "fContent": "<?php  echo $sharedesc;?>",
            "wContent": "<?php  echo $sharedesc;?>",
        };
        // 发送给好友
        WeixinJSBridge.on('menu:share:appmessage', function (argv) {
            WeixinJSBridge.invoke('sendAppMessage', {
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.sendFriendLink,
                "desc": window.shareData.fContent,
                "title": window.shareData.fTitle
            }, function (res) {
                _report('send_msg', res.err_msg);
            })
        });
alert( window.shareData.tTitle);
        // 分享到朋友圈
        WeixinJSBridge.on('menu:share:timeline', function (argv) {
            WeixinJSBridge.invoke('shareTimeline', {
                "img_url": window.shareData.imgUrl,
                "img_width": "640",
                "img_height": "640",
                "link": window.shareData.timeLineLink,
                "desc": window.shareData.tContent,
                "title": window.shareData.tTitle
            }, function (res) {
                _report('timeline', res.err_msg);
            });
        });

        // 分享到微博
        WeixinJSBridge.on('menu:share:weibo', function (argv) {
            WeixinJSBridge.invoke('shareWeibo', {
                "content": window.shareData.wContent,
                "url": window.shareData.weiboLink,
            }, function (res) {
                _report('weibo', res.err_msg);
            });
        });
        }, false)
    </script>
<footer style="text-align:center; color:#ffd800;margin:20px"><a>&copy;<?php  if(empty($reply['copyright'])) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?><?php  echo $reply['copyright'];?><?php  } ?></a></footer>
</body>
</html>
</body>
</html>
