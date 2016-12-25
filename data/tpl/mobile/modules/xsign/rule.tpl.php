<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<html>
    <head>
    	 <meta charset="utf-8">
   <!--   <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
 <meta content="telephone=no, address=no" name="format-detection">
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <title>签到</title>
    <!-- meta viewport -->
    <!-- CSS -->
    <link rel="stylesheet" href="./source/modules/xsign/template/style/css/base.css" onerror="_cdnFallback(this)">        
    <link rel="stylesheet" href="./source/modules/xsign/template/style/css/checkin_rule.css?x=1" onerror="_cdnFallback(this)">    </head>
    </head>
<body class=" ">
        <!-- container -->
    <div class="container ">
                <div class="apps-game">
        <div class="checkin-rule-wrap">
        <div class="checkin-rule-title">
            签到规则：
        </div>
        <div class="checkin-rule-content" style="line-height: 23px;">
        	<?php  echo $reply['content'];?>
        </div>
         <div class="checkin-rule-footer">
            
            <div class="checkin-rule-footer-opt">
                <a href="javascript:history.go(-1)" class="btn btn-opt">返回签到</a>
            </div>
        </div>
     
    </div>    </div>

       <div class="js-footer" style="min-height: 1px;">
        
    <div class="footer">
        <div class="copyright">
                           <div class="ft-copyright">
   &copy<?php  echo $_W['account']['name'];?>
</div>
        </div>
    </div>
    </div>            </div>

        
    </body>
</html>