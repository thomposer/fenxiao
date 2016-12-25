<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">

	<li <?php  if($op == 'salereport') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'salereport'))?>">零售生意报告</a></li>
	<li <?php  if($op == 'orderstatistics' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'orderstatistics'))?>">订单统计</a></li>
	<li <?php  if($op == 'saledetails' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saledetails'))?>">商品销售明细</a></li>
	<li <?php  if(op == 'saletargets' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saletargets'))?>">销售指标分析</a></li>
	<li <?php  if($op == 'productsaleranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsaleranking'))?>">商品销售排行</a></li>
<li <?php  if($op == 'productsalestatistics') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsalestatistics'))?>">商品访问与购买比</a></li>
<li <?php  if($op == 'memberranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'memberranking'))?>">会员消费排行</a></li>
<li <?php  if($op == 'fansrange' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'fansrange'))?>">代理粉丝排行</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='user' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics'))?>">会员增长统计</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='agent' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics','usertype'=>'agent'))?>">代理增长统计</a></li>

</ul>

<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/highcharts/highcharts.js"></script>
<div class="main">
				<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="op" value="userincreasestatistics" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="usertype"  value="<?php  echo $usertype;?>" />
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
    	 credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '最近7天<?php echo $usertype=='agent'?"代理":"会员"?>增长值'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}人</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(126,86,134,.9)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata1)) { foreach($chartdata1 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>


<script type="text/javascript">
$(function () {
	
    $('#container2').highcharts({
    		credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '按月查看<?php echo $usertype=='agent'?"代理":"会员"?>增长( <?php  echo $dropMonthForYaer;?>年<?php  echo $selectmonthSale;?>月 )'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}人</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(248,161,63,1)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata2)) { foreach($chartdata2 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
<script type="text/javascript">
$(function () {
    $('#container3').highcharts({
    		 credits: {
          enabled:false
				},
        chart: {
            type: 'column'
        },
        title: {
            text: '按年查看<?php echo $usertype=='agent'?"代理":"会员"?>增长( <?php  echo $dropMonthForYaer2;?>年 )'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{point.y}人</b>'
        },
        series: [{
            name: 'Population',  
             color: 'rgba(165,170,217,1)',
            data: [
        		<?php  $index=0?>
            	<?php  if(is_array($chartdata3)) { foreach($chartdata3 as $item) { ?>
                ['<?php  echo $item['dates'];?>', <?php  echo $item['counts'];?>],	
          <?php  $index++?>
                	<?php  } } ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
		
<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
<br/><br/>

<div style="padding:10px 10px 0 0; width:auto;">
		&nbsp;&nbsp;按月统计&nbsp;&nbsp;&nbsp;
					<select name="dropMonthForYaer" class="span2" >
		<?php  if(is_array($years)) { foreach($years as $v) { ?>
	<option value="<?php  echo $v['year'];?>"  <?php  if($v['checked'] == 1) { ?>selected="selected"<?php  } ?>><?php  echo $v['year'];?></option>
			<?php  } } ?>
</select>
								年&nbsp;&nbsp;				<select name="selectmonthSale" class="span1">	
	<option value="1" <?php  if($selectmonthSale == 1 ) { ?>selected="selected" <?php  } ?>>1</option>
	<option value="2" <?php  if($selectmonthSale == 2 ) { ?>selected="selected" <?php  } ?>>2</option>
	<option value="3" <?php  if($selectmonthSale == 3 ) { ?>selected="selected" <?php  } ?>>3</option>
	<option value="4" <?php  if($selectmonthSale == 4 ) { ?>selected="selected" <?php  } ?>>4</option>
	<option value="5" <?php  if($selectmonthSale == 5 ) { ?>selected="selected" <?php  } ?>>5</option>
	<option value="6" <?php  if($selectmonthSale == 6 ) { ?>selected="selected" <?php  } ?>>6</option>
	<option value="7" <?php  if($selectmonthSale == 7 ) { ?>selected="selected" <?php  } ?>>7</option>
	<option value="8" <?php  if($selectmonthSale == 8 ) { ?>selected="selected" <?php  } ?>>8</option>
	<option value="9" <?php  if($selectmonthSale == 9 ) { ?>selected="selected" <?php  } ?>>9</option>
	<option value="10" <?php  if($selectmonthSale == 10 ) { ?>selected="selected" <?php  } ?>>10</option>
	<option value="11" <?php  if($selectmonthSale == 11 ) { ?>selected="selected" <?php  } ?>>11</option>
	<option value="12" <?php  if($selectmonthSale == 12 ) { ?>selected="selected" <?php  } ?>>12</option>

</select>月	<input type="submit" name="" value="查询" class="btn btn-primary">
	</div>
<div id="container2" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
<br/><br/>
<div style="padding:10px 10px 0 0; width:auto;">
		&nbsp;&nbsp;按月统计&nbsp;&nbsp;&nbsp;
					<select name="dropMonthForYaer2" class="span2" >
		<?php  if(is_array($years2)) { foreach($years2 as $v) { ?>
	<option value="<?php  echo $v['year'];?>"  <?php  if($v['checked'] == 1) { ?>selected="selected"<?php  } ?>><?php  echo $v['year'];?></option>
			<?php  } } ?>
</select>
								年	<input type="submit" name="" value="查询" class="btn btn-primary">
	</div>
<div id="container3" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
</div></form>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>