<?php defined('IN_IA') or exit('Access Denied');?><style type='text/css'>
    .datepicker { width:120px;}
</style>
<table class="tb">
  <tr>
        <th>商品地址</th>
        <td>
          
           <input type="text" name="goodurltest" id="goodurltest" class="span6" value="<?php  echo $_W['siteroot'];?>mobile.php?act=module&id=<?php  echo $item['id'];?>&name=bj_qmxk&do=detail&weid=<?php  echo $_W['weid'];?>"  readonly/>
        </td>
    </tr>
  
    <tr>
        <th><span class="red">*</span><label for="">商品名称</label></th>
        <td>
            <input type="text" name="goodsname" id="goodsname" class="span6" value="<?php  echo $item['title'];?>" />
        </td>
    </tr>
      <tr>
                <th><label for="">商品属性</label></th>
                <td>
                    <label for="isrecommand" class="checkbox inline">
                        <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php  if($item['isrecommand'] == 1) { ?>checked="true"<?php  } ?> /> 首页推荐
                    </label>
                        <label for="issendfree" class="checkbox inline">
                        <input type="checkbox" name="issendfree" value="1" id="isnew" <?php  if($item['issendfree'] == 1) { ?>checked="true"<?php  } ?> /> 包邮
                    </label>
                     <!--<label for="isnew" class="checkbox inline">
                        <input type="checkbox" name="isnew" value="1" id="isnew" <?php  if($item['isnew'] == 1) { ?>checked="true"<?php  } ?> /> 新品推荐
                    </label>
                     <label for="ishot" class="checkbox inline">
                        <input type="checkbox" name="ishot" value="1" id="isnew" <?php  if($item['ishot'] == 1) { ?>checked="true"<?php  } ?> /> 热卖推荐
                    </label>
                     <label for="isdiscount" class="checkbox inline">
                        <input type="checkbox" name="isdiscount" value="1" id="isnew" <?php  if($item['isdiscount'] == 1) { ?>checked="true"<?php  } ?> /> 折扣商品
                    </label>-->
                    <label for="istime" class="checkbox inline">
                        <input type="checkbox" name="istime" id='istime' value="1" id="isnew" <?php  if($item['istime'] == 1) { ?>checked="true"<?php  } ?> /> 限时秒杀
                    </label>
                      <?php echo tpl_form_field_date('timestart', !empty($item['timestart']) ? date('Y-m-d H:i',$item['timestart']) : date('Y-m-d H:i'), 1)?> - 
                      <?php echo tpl_form_field_date('timeend', !empty($item['timeend']) ? date('Y-m-d H:i',$item['timeend']) : date('Y-m-d H:i'), 1)?>
                </td>
            </tr>
             <tr>
        <th>限时秒杀调用地址：</th>
        <td>
          
           <input type="text" name="goodurltest" id="goodurltest" class="span7" value="<?php  echo $_W['siteroot'];?><?php  echo $this->createMobileUrl('list2',array('istime'=>1))?>"  readonly/>
        </td>
    </tr>

      <tr>
        <th><span class="red">*</span> 分类</th>
        <td>
            <select class="span3" style="margin-right:15px;" id="pcate" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
                <option value="0">请选择一级分类</option>
                <?php  if(is_array($category)) { foreach($category as $row) { ?>
                <?php  if($row['parentid'] == 0) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                <?php  } ?>
                <?php  } } ?>
            </select>
            <select class="span3" id="cate_2" name="ccate" autocomplete="off">
                <option value="0">请选择二级分类</option>
                <?php  if(!empty($item['ccate']) && !empty($children[$item['pcate']])) { ?>
                <?php  if(is_array($children[$item['pcate']])) { foreach($children[$item['pcate']] as $row) { ?>
                <option value="<?php  echo $row['0'];?>" <?php  if($row['0'] == $item['ccate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['1'];?></option>
                <?php  } } ?>
                <?php  } ?>
            </select>
           
        </td>
    </tr>
     <tr>
                <th><span class="red">*</span><label for="">商品图</label></th>
                <td>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                            <img src="./resource/attachment/<?php  echo $item['thumb'];?>" alt="" onerror="$(this).remove();"></div>
                        <div>
                            <span class="btn btn-file"  id="thumb_div" tabindex="-1"><span class="fileupload-new">选择图片</span>
                                <span class="fileupload-exists">更改</span><input name="thumb" id="thumb" type="file" /></span>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
                        </div>
                    </div>
                    <span class="help-block">商品的缩略图 商品图片尺寸建议 305*305</span>
                </td>
            </tr>

 <tr>
                <th><span class="red">*</span><label for="">商城首页推广图片</label></th>
                <td>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 100px;">
                            <img src="./resource/attachment/<?php  echo $item['xsthumb'];?>" alt="" onerror="$(this).remove();"></div>
                        <div>
                            <span class="btn btn-file"  id="xsthumb_div" tabindex="-1"><span class="fileupload-new">选择图片</span>
                                <span class="fileupload-exists">更改</span><input name="xsthumb" id="xsthumb" type="file" /></span>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
                        </div>
                    </div>
                    
                </td>
            </tr>
    <tr>
        <th>商品详情页轮番图</th>
        <td><!---批量上传-->
            <div class="photo_list">
                <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                <span id="selectimage" tabindex="-1" class="btn btn-primary"><i class="icon-plus"></i> 上传照片</span><span style="color:red;">
                    <input name="piclist" type="hidden" value="<?php  echo $item['piclist'];?>" /></span>
                <div id="file_upload-queue" class="uploadify-queue"></div>
                <ul class="ipost-list ui-sortable" id="fileList">

                    <?php  if(is_array($piclist)) { foreach($piclist as $v) { ?>
                    <li class="imgbox" style="list-type:none">
                        <a class="item_close" href="javascript:;" onclick="deletepic(this);" title="删除"></a>
                        <span class="item_box">
                            <img src="<?php  echo $_W['attachurl'];?><?php  echo $v['attachment'];?>" style="max-height:100%;">
                        </span>
                        <input type="hidden" value="<?php  echo $v['attachment'];?>" name="attachment[]">
                    </li>
                    <?php  } } ?>
                </ul>
                

        </td>

        <!--批量上传结束-->

    </tr>
    <tr>
        <th><label for="">商品编号</label></th>
        <td>
            <input type="text" name="goodssn" class="span3" value="<?php  echo $item['goodssn'];?>" /> 商品条码 <input type="text" name="productsn" class="span3" value="<?php  echo $item['productsn'];?>" />
        </td>
    </tr>
    <tr class="trp">
        <th><label for="">商品价格</label></th>
        <td>

         
            <div class="input-append input-prepend">
                <span class="add-on">销售价</span>
                <input type="text" name="marketprice" id="marketprice" class="span2" value="<?php  echo $item['marketprice'];?>" />
                <span class="add-on">元</span>
            </div>
             <div class="input-append input-prepend">
                <span class="add-on">市场价</span>
                <input type="text" name="productprice" id="productprice" class="span2" value="<?php  echo $item['productprice'];?>" />
                <span class="add-on">元</span>
            </div>
          <!--  <div class="input-append input-prepend">
                <span class="add-on">成本价</span>
                <input type="text" name="costprice" id="costprice" class="span2" value="<?php  echo $item['costprice'];?>" />
                <span class="add-on">元</span>
            </div> -->
            
        </td>
    </tr>
    <tr class="trp">
        <th><label for="">重量</label></th>
        <td>
            <div class="input-append">
                <input type="text" name="weight" id='weight' class="span2" value="<?php  echo $item['weight'];?>" />
                <span class="add-on">克</span>
            </div>
        </td>
    </tr>
    <tr class="trp">
        <th><label for="">库存</label></th>
        <td>

            <div class="input-append">
                <input type="text" name="total" id="total" class="span2" value="<?php  echo $item['total'];?>" />   
                <span class="add-on">件</span>
            </div>
              <span class="help-block">当前商品的库存数量，-1则表示不限制。</span>

        </td>
    </tr>
      <tr>
        <th><label for="">减库存方式</label></th>
        <td>
            <label for="totalcnf1" class="radio inline"><input type="radio" name="totalcnf" value="0" id="totalcnf1" <?php  if(empty($item) || $item['totalcnf'] == 0) { ?>checked="true"<?php  } ?> /> 拍下减库存</label>
            &nbsp;&nbsp;&nbsp;
            <label for="totalcnf2" class="radio inline"><input type="radio" name="totalcnf" value="1" id="totalcnf2"  <?php  if(!empty($item) && $item['totalcnf'] == 1) { ?>checked="true"<?php  } ?> /> 付款减库存</label>
            &nbsp;&nbsp;&nbsp;
            <label for="totalcnf3" class="radio inline"><input type="radio" name="totalcnf" value="2" id="totalcnf3"  <?php  if(!empty($item) && $item['totalcnf'] == 2) { ?>checked="true"<?php  } ?> /> 永不减库存</label>
          
        </td>
    </tr>

     <tr>
        <th><label for="">购买积分</label></th>
        <td>

            <div class="input-append">
                <input type="text" name="credit" id="credit" class="span3" value="<?php  echo $item['credit'];?>" />
                <span class="add-on">分</span>
            </div>
            <p class="help-block">会员购买积分, 如果不填写，则默认为不奖励积分</p>
        </td>
    </tr>
	<tr>
        <th><label for="">1级佣金比例</label></th>
        <td>
            <div class="input-append">
                <input type="text" name="commission"  class="span3" value="<?php  echo $item['commission'];?>" />
                <span class="add-on">%</span>
            </div>
            <p class="help-block">1级佣金的比例,不填使用系统默认！</p>
        </td>
    </tr>
     <?php  if($cfg['globalCommissionLevel']>=2) { ?>
    	<tr>
        <th><label for="">2级佣金比例</label></th>
        <td>
            <div class="input-append">
                <input type="text" name="commission2"  class="span3" value="<?php  echo $item['commission2'];?>" />
                <span class="add-on">%</span>
            </div>
            <p class="help-block">2级佣金的比例,不填使用系统默认！</p>
        </td>
    </tr>
    <?php  } else { ?>
    <input type="hidden" name="commission2"  class="span3" value="<?php  echo $item['commission2'];?>" />
                
    <?php  } ?>
    <?php  if($cfg['globalCommissionLevel']>=3) { ?>
     	<tr>
        <th><label for="">3级佣金比例</label></th>
        <td>
            <div class="input-append">
                <input type="text" name="commission3"  class="span3" value="<?php  echo $item['commission3'];?>" />
                <span class="add-on">%</span>
            </div>
            <p class="help-block">3级佣金的比例,不填使用系统默认！</p>
        </td>
    </tr>
       <?php  } else { ?>
         <input type="hidden" name="commission3"  class="span3" value="<?php  echo $item['commission3'];?>" />
           
     <?php  } ?>
	 <tr>
                <th><label for="">是否上架销售</label></th>
                <td>
                    <label for="isshow1" class="radio inline"><input type="radio" name="status" value="1" id="isshow1" <?php  if($item['status'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="isshow2" class="radio inline"><input type="radio" name="status" value="0" id="isshow2"  <?php  if($item['status'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                    <span class="help-block"></span>
                </td>
            </tr>
</table>

<script language="javascript">
    
$(function(){
	 
	var i = 0;
	$('#selectimage').click(function() {
		var editor = KindEditor.editor({
			allowFileManager : false,
			imageSizeLimit : '30MB',
			uploadJson : './index.php?act=attachment&do=upload'
		});
		editor.loadPlugin('multiimage', function() {
			editor.plugin.multiImageDialog({
				clickFn : function(list) {
					if (list && list.length > 0) {
						for (i in list) {
							if (list[i]) {
								html =	'<li class="imgbox" style="list-type:none">'+
								'<a class="item_close" href="javascript:;" onclick="deletepic(this);" title="删除"></a>'+
								'<span class="item_box"> <img src="'+list[i]['url']+'" style="height:80px"></span>'+
								'<input type="hidden" name="attachment-new[]" value="'+list[i]['filename']+'" />'+
								'</li>';
								$('#fileList').append(html);
								i++;
							}
						}
						editor.hideDialog();
					} else {
						alert('请先选择要上传的图片！');
					}
				}
			});
		});
	});
});
function deletepic(obj){
	if (confirm("确认要删除？")) {
		var $thisob=$(obj);
		var $liobj=$thisob.parent();
		var picurl=$liobj.children('input').val();
		$.post('<?php  echo $this->createMobileUrl('ajaxdelete',array())?>',{ pic:picurl},function(m){
			if(m=='1') {
				$liobj.remove();
			} else {
				alert("删除失败");
			}
		},"html");	
	}
}

    </script>