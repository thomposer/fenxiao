<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>

<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display' && $modules!='promotion') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'display'))?>">幻灯片</a></li>
    <li<?php  if($operation == 'post' && $modules!='promotion') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'post'))?>">添加幻灯片</a></li>
	 <li<?php  if($operation == 'display' &&  $modules!='adv') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('promotion',array('op' =>'display'))?>">促销活动管理</a></li>
	  <li<?php  if($operation == 'post' && $modules!='adv') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('promotion',array('op' =>'post'))?>">添加促销活动</a></li>
	   
    <?php  if(!empty($adv['id']) && $operation== 'post') { ?> <li class="active"><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'post','id'=>$adv['id']))?>">编辑物流方式</a></li> <?php  } ?>
<!--    <li><a href="<?php  echo $this->createWebUrl('template',array('op' =>'display'))?>">模板管理</a></li>-->
</ul>
<?php  if($operation == 'post') { ?>
<div class="main">

		
		
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
		 <input type="hidden" name="id" value="<?php  echo $pro['id'];?>" />
		<h4>促销活动设置</h4>
				<table class="tb">
					<tbody>
					<tr>
					<td>
					<label for="">促销活动类型 </label></td>
				
					<td>
					
					<label class="radio inline"><input  name="radioPromotionType" type="radio" value="0" <?php  if($pro['promoteType']==0) { ?> checked="checked" <?php  } ?> onclick="to_change()">满件免运费</label>
					<label class="radio inline"><input  name="radioPromotionType" type="radio"  value="1" <?php  if($pro['promoteType']==1) { ?>checked="checked"<?php  } ?> onclick="to_change()">满额免运费</label>
				
					</td>
					</tr>
					<tr>
				
					<td><label for=""><span id='money' <?php  if($pro['promoteType']==0) { ?> style='display:none;'<?php  } ?>>*满足金额(元) </span>	<span id='num' <?php  if($pro['promoteType']==1) { ?> style='display:none;'<?php  } ?> >*满足数量(件)</span></label></td>
				<td><input type="text" name="promotionmoney" class="span3" value="<?php  echo (int)$pro['condition']?>" /></td>
					</tr>
					<tr>
					<td><label for="">*促销活动名称</label></td>
						
					<td><input type="text" name="promotionname" class="span3" value="<?php  echo $pro['pname'];?>" /></td>
					</tr>
						<tr>
							<td><label for="">起始日期</label></td>
			<td style="width:100px">
		
				
				 <?php echo tpl_form_field_date('start_time', !empty($pro['starttime']) ? date('Y-m-d H:i',$pro['starttime']) : date('Y-m-d H:i'), 1)?> 
                
			</td>	
			
			</tr>
			<tr>
			<td><label for="">终止日期</label></td>
			<td>
		
				      <?php echo tpl_form_field_date('end_time', !empty($pro['endtime']) ? date('Y-m-d H:i',$pro['endtime']) : date('Y-m-d H:i'), 1)?>
			</td>
				
			<td>&nbsp;</td>
						</tr>
						<tr>
					<td style="width:130px">描述</td>
					<td><textarea name="description" class="span6" cols="70"><?php  echo $pro['description'];?></textarea></td>
					</tr>
						<tr>
								<td></td>	
							<td><input type="submit" name="submit" value="提交" class="btn btn-primary span2" style="height:30px"> 
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /></td>
						</tr>
					</tbody>
				</table>
			</form>
	
</div>
<SCRIPT LANGUAGE="JavaScript">
   <!--
    function to_change(){
        var obj  = document.getElementsByName('radioPromotionType');
        for(var i=0;i<obj.length;i++){
            if(obj[i].checked==true){
                if(obj[i].value==0){
						document.getElementById('num').style.display="block";
				document.getElementById('money').style.display="none";
		
                }else if(obj[i].value==1){
		
                   		document.getElementById('num').style.display="none";
          document.getElementById('money').style.display="block"; 
                }
            }
        }
    }
  //-->
  <!--
   function formcheck() {
        if ($("#advname").isEmpty()) {
            Tip.focus("advname", "请填写幻灯片名称!", "right");
            return false;
        }
       
        return true;
    }
    -->
    </SCRIPT>
<?php  } else if($operation == 'display') { ?>
<div class="main">
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">ID</th>
                    <th style="width:60px;">名称</th>					
                    <th>类型</th>
                    <th >开始时间</th>
                    <th >结束时间</th>
					<th >满足条件</th>
					<th >描述</th>
					<th >操作</th>
                </tr>
            </thead>
            <tbody>
        	<?php  if(is_array($prolist)) { foreach($prolist as $proitem) { ?>
                <tr>
					<td><?php  echo $proitem['id'];?></td>
                    <td><?php  echo $proitem['pname'];?></td>
                    <td><?php  if($proitem['promoteType']==0 ) { ?>满件免运费<?php  } else { ?>满额免运费<?php  } ?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $proitem['starttime']);?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $proitem['endtime']);?></td>
					<td><?php  if($proitem['promoteType']==0 ) { ?>满<span style="color:#FF0000"><?php  echo (int)$proitem['condition']?></span>件免运费<?php  } else { ?>满<span style="color:#FF0000"><?php  echo  $proitem['condition']?></span>元免运费<?php  } ?></td>
					<td><?php  echo $proitem['description'];?></td>
                    <td style="text-align:left;"><a href="<?php  echo $this->createWebUrl('promotion', array('op' => 'post', 'id' => $proitem['id']))?>">修改</a> <a href="<?php  echo $this->createWebUrl('promotion', array('op' => 'delete', 'id' => $proitem['id']))?>">删除</a> </td>
                </tr>
               <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>

<?php  } ?>
<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/jquery-ui.css" />
<style type="text/css">a{color:#007bc4/*#424242*/; text-decoration:none;}a:hover{text-decoration:underline}ol,ul{list-style:none}body{height:100%; font:12px/18px Tahoma, Helvetica, Arial, Verdana, "\5b8b\4f53", sans-serif; color:#51555C;}img{border:none}.demo{width:500px; margin:20px auto}.demo h4{height:32px; line-height:32px; font-size:14px}.demo h4 span{font-weight:500; font-size:12px}.demo p{line-height:28px;}input{width:200px; height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3}pre{padding:6px 0 0 0; color:#666; line-height:20px; background:#f7f7f7}.ui-timepicker-div .ui-widget-header { margin-bottom: 8px;}.ui-timepicker-div dl { text-align: left; }.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }.ui-timepicker-div td { font-size: 90%; }.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }.ui_tpicker_hour_label,.ui_tpicker_minute_label,.ui_tpicker_second_label,.ui_tpicker_millisec_label,.ui_tpicker_time_label{padding-left:20px}</style>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-slide.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-timepicker-addon.js"></script><script type="text/javascript">
    $(function() {
        $('#start_time').timepicker({});
        $('#end_time').timepicker({});
    });
	
	
</script>
  

<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>