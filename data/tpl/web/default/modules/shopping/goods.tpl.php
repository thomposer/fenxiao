<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript" src="./resource/script/jquery-ui-1.10.3.min.js"></script>
<ul class="nav nav-tabs">
	<li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op' => 'post'))?>">添加商品</a></li>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('goods', array('op' => 'display'))?>">管理商品</a></li>
</ul>
<?php  if($operation == 'post') { ?>

<link type="text/css" rel="stylesheet" href="./source/modules/shopping/images/uploadify_t.css" />
<style type='text/css'>
    .tab-pane { padding:20px 0 20px 0;}
    
</style>

<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return formcheck();">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <h4>添加商品</h4>
    <ul class="nav nav-tabs" id="myTab"> 
          <li class="active"><a href="#tab_basic">基本信息</a></li>
          <li><a href="#tab_des">商品描述</a></li>
          <li><a href="#tab_param">自定义属性</a></li>
         <li><a href="#tab_option">商品规格</a></li>
          
          <li><a href="#tab_other">其他设置</a></li>
        </ul>
           
        <div class="tab-content">
          <div class="tab-pane  active" id="tab_basic"><?php  include $this->template('goods_basic', TEMPLATE_INCLUDEPATH);?></div>
          <div class="tab-pane" id="tab_des"><?php  include $this->template('goods_des', TEMPLATE_INCLUDEPATH);?></div>
          <div class="tab-pane" id="tab_param"><?php  include $this->template('goods_param', TEMPLATE_INCLUDEPATH);?></div>
          <div class="tab-pane" id="tab_option"><?php  include $this->template('goods_option', TEMPLATE_INCLUDEPATH);?></div>
          <div class="tab-pane" id="tab_other"><?php  include $this->template('goods_other', TEMPLATE_INCLUDEPATH);?></div>
        </div>
     <table class="tb">
      <tr>
                <th></th>
                <td>
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>
</table>
    </form>
</div>
<div id="specWin" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:100px;" class="row-hover">名称<i></i></th>
				<th style="text-align:right;">操作</th>
			</tr>
		</thead>
		<tbody id="spec-items">
		<?php  if(is_array($specs)) { foreach($specs as $field) { ?>
			<?php  $json = json_encode($field);?>
			<tr>
				<td><input  name="spec[]" type="text" value="<?php  echo $field['title'];?>"></td>
				<td style="text-align:right;">
					<?php  if(is_array($field['content'])) { foreach($field['content'] as $item) { ?>
					<span class="label label-info"><?php  echo $item;?></span>
					<?php  } } ?>
				</td>
				<td><a href="javascript:;" onclick='addSpec(<?php  echo $json;?>)'>添加</a></td>
			</tr>
		<?php  } } ?>
		</tbody>
	</table>
</div>
<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="./resource/script/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="./resource/script/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript">
<!--
	var category = <?php  echo json_encode($children)?>;
	kindeditor($('.richtext-clone'));
 
          $(function () {
              
              window.optionchanged = false;
            $('#myTab a').click(function (e) {
              e.preventDefault();//阻止a链接的跳转行为
              $(this).tab('show');//显示当前选中的链接及关联的content
            })
          });
          
              
        
    function formcheck(){
        if($("#pcate").val()=='0'){
            Tip.focus("pcate","请选择商品分类!","right");
            return false;
        }
        if($("#goodsname").isEmpty()) {
            $('#myTab a[href="#tab_basic"]').tab('show');
            Tip.focus("goodsname","请输入商品名称!","right");
            return false;
        }
        <?php  if(empty($id)) { ?>
           if ($.trim($(':file[name="thumb"]').val()) == '') {
            $('#myTab a[href="#tab_basic"]').tab('show');
                         $('#myTab a[href="#tab_basic"]').tab('show');
                        Tip.focus('thumb_div', '请上传缩略图.', 'right');
                        return false;
          }
        <?php  } ?>
                                    
        if($("#goodsname").isEmpty()) {
            $('#myTab a[href="#tab_basic"]').tab('show');
            Tip.focus("goodsname","请输入商品名称!","right");
            return false;
        }
       var full =  checkoption();
       if(!full){return false;}
       if(optionchanged){
             $('#myTab a[href="#tab_option"]').tab('show');
             message('规格数据有变动，请重新点击 [刷新规格项目表] 按钮!','','error');
             return false;
       }
       return true;
     
    }
    
    function checkoption(){
        
         var full = true;
         if( $("#hasoption").get(0).checked){
               $(".spec_title").each(function(i){
                    if( $(this).isEmpty()) {
                        $('#myTab a[href="#tab_option"]').tab('show');
                        Tip.focus(".spec_title:eq(" + i + ")","请输入规格名称!","top");
                        full =false;
                        return false;
                    }

                });
                $(".spec_item_title").each(function(i){
                    if( $(this).isEmpty()) {
                        $('#myTab a[href="#tab_option"]').tab('show');
                        Tip.focus(".spec_item_title:eq(" + i + ")","请输入规格项名称!","top");
                        full =false;
                        return false;
                    }

                });
                
         }
            if(!full) { return false; }
           return full;
           
    }
    
    
//-->
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
	<div class="search">
		<form action="site.php" method="get">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="do" value="goods" />
		<input type="hidden" name="op" value="display" />
		<input type="hidden" name="name" value="shopping" />
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>关键字</th>
					<td>
						<input class="span6" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
					</td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
						<select name="status">
							<option value="1" <?php  if(!empty($_GPC['status'])) { ?> selected<?php  } ?>>上架</option>
							<option value="0" <?php  if(empty($_GPC['status'])) { ?> selected<?php  } ?>>下架</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>分类</th>
					<td>
						<select class="span3" style="margin-right:15px;" name="cate_1" onchange="fetchChildCategory(this.options[this.selectedIndex].value)">
							<option value="0">请选择一级分类</option>
							<?php  if(is_array($category)) { foreach($category as $row) { ?>
							<?php  if($row['parentid'] == 0) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GPC['cate_1']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } ?>
							<?php  } } ?>
						</select>
						<select class="span3" id="cate_2" name="cate_2">
							<option value="0">请选择二级分类</option>
							<?php  if(!empty($_GPC['cate_1']) && !empty($children[$_GPC['cate_1']])) { ?>
							<?php  if(is_array($children[$_GPC['cate_1']])) { foreach($children[$_GPC['cate_1']] as $row) { ?>
							<option value="<?php  echo $row['0'];?>" <?php  if($row['0'] == $_GPC['cate_2']) { ?> selected="selected"<?php  } ?>><?php  echo $row['1'];?></option>
							<?php  } } ?>
							<?php  } ?>
						</select>
					</td>
				</tr>
				<tr>
				 <tr class="search-submit">
					<td colspan="2"><button class="btn pull-right span2"><i class="icon-search icon-large"></i> 搜索</button></td>
				 </tr>
			</tbody>
		</table>
		</form>
	</div>
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">ID</th>
					<th style="min-width:150px;">商品标题</th>
                                        <th>商品属性(点击可修改)</th>
					<th style="width:100px;">商品编号</th>
					<th style="width:100px;">商品条码</th>
					<th style="width:100px;">状态</th>
                                        
					<th style="text-align:right; min-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['id'];?></td>
					<td><?php  if(!empty($category[$item['pcate']])) { ?><span class="text-error">[<?php  echo $category[$item['pcate']]['name'];?>] </span><?php  } ?><?php  if(!empty($children[$item['pcate']])) { ?><span class="text-info">[<?php  echo $children[$item['pcate']][$item['ccate']]['1'];?>] </span><?php  } ?><?php  echo $item['title'];?>
                                        
                                        
                                        </td>
                                        <td>
                                        <label data='<?php  echo $item['isnew'];?>' class='label <?php  if($item['isnew']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'new')">新品</label>
                                        <label data='<?php  echo $item['ishot'];?>' class='label <?php  if($item['ishot']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'hot')">热卖</label>
                                        <label data='<?php  echo $item['isrecommand'];?>' class='label <?php  if($item['isrecommand']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'recommand')">首页</label>
                                        <label data='<?php  echo $item['isdiscount'];?>' class='label <?php  if($item['isdiscount']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'discount')">折扣</label></td>
					<td><?php  echo $item['goodssn'];?></td>
					<td><?php  echo $item['productsn'];?></td>
					<td><?php  if($item['status']) { ?><span class="label label-success">上架</span><?php  } else { ?><span class="label label-error">下架</span><?php  } ?>&nbsp;<span class="label label-info"><?php  if($item['type'] == 1) { ?>实体商品<?php  } else { ?>虚拟商品<?php  } ?></span></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			<tr>
				<td></td>
				<td colspan="6">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr>
		</table>
		<?php  echo $pager;?>
	</div>
</div>
<script type="text/javascript">
<!--
	var category = <?php  echo json_encode($children)?>;
    function setProperty(obj,id,type){
        
       $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('setgoodsproperty')?>"
            ,{id:id,type:type, data: obj.getAttribute("data")}
            ,function(d){
                  $(obj).html($(obj).html().replace("...",""));
                  $(obj).attr("data",d.data)
                  if(d.result==1){
                        $(obj).toggleClass("label-info");
                  }
            },"json");
    }
//-->
</script>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
