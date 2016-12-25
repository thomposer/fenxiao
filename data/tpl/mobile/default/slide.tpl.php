<?php defined('IN_IA') or exit('Access Denied');?><style>
.box_swipe {
  overflow: hidden;
  position: relative;
}
.box_swipe ul {
  overflow: hidden;
  position: relative;
}
.box_swipe ul > li {
  float:left;
  width:100%;
  position: relative;
}
.box_swipe ul > li a{
	color:#FFF;
	text-decoration:none;
}
.box_swipe ul > li .title{
	position: absolute;
	bottom: 6px;
	display: block;
	width: 70%;
	height:20px;
	padding:0 10px;
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	color:#FFF;
	z-index:100;
}
.box_swipe>ol{
	height:20px;
	position: relative;
	z-index:10;
	margin-top:-25px;
	text-align:right;
	padding-right:15px;
	background-color:rgba(0,0,0,0.3);
}
.box_swipe>ol>li{
	display:inline-block;
	margin-bottom:1px;
	width:8px;
	height:8px;
	background-color:#757575;
	border-radius: 8px;
}
.box_swipe>ol>li.on{
	background-color:#ffffff;
}
</style>
<div id="banner_box" class="box_swipe">
	<ul>
	<?php  $slide = modulefunc('site', 'site_slide_search', array (
  'func' => 'site_slide_search',
  'limit' => '4',
  'item' => 'row',
  'assign' => 'slide',
)); if(is_array($slide)) { foreach($slide as $i => $row) { ?>
		<li>
			<a href="<?php  if($row['url'] == $_W['siteroot']) { ?>#<?php  } else { ?><?php  echo $row['url'];?><?php  } ?>">
				<img src="<?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" style="width:100%;" />
			</a>
			<span class="title"><?php  echo $row['title'];?></span>
		</li>
	<?php  } } ?>
	</ul>
	<ol>
	<!-- 此处的slide变量是通过上方标签到的 -->
	<?php  $slideNum = 1;?>
	<?php  if(is_array($slide)) { foreach($slide as $vv) { ?>
		<li<?php  if($slideNum == 1) { ?> class="on"<?php  } ?>></li>
		<?php  $slideNum++;?>
	<?php  } } ?>
	</ol>
</div>
<script>
$(function() {
	new Swipe($('#banner_box')[0], {
		speed:500,
		auto:3000,
		callback: function(){
			var lis = $(this.element).next("ol").children();
			lis.removeClass("on").eq(this.index).addClass("on");
		}
	});
});
</script>