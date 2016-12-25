<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
 
<li><a href="<?php  echo $this->createWebUrl('express',array('op' =>'display'))?>">物流方式</a></li>
         
    <li <?php  if($operation == 'display') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('dispatch',array('op' =>'display'))?>">配送方式</a></li>
    <li<?php  if($operation == 'post') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('dispatch',array('op' =>'post'))?>">添加配送方式</a></li>
    <?php  if(!empty($dispatch['id']) && $operation== 'post') { ?> <li class="active"><a href="<?php  echo $this->createWebUrl('dispatch',array('op' =>'post','id'=>$dispatch['id']))?>">编辑物流方式</a></li> <?php  } ?>
<!--    <li><a href="<?php  echo $this->createWebUrl('template',array('op' =>'display'))?>">模板管理</a></li>-->
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>显示顺序</th>					
                    <th>配送方式</th>
                    <th>配送类型</th>
                    <th>首重价格</th>
                    <th>续重价格</th>

                    <th >操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['displayorder'];?></td>
                    <td><?php  echo $item['dispatchname'];?></td>
                    <td><?php  if($item['dispatchtype']==0) { ?>
                    先付款后发货<?php  } else { ?>货到付款<?php  } ?></td>
                    <td><?php  echo $item['firstprice'];?></td>
                    <td><?php  echo $item['secondprice'];?></td>
                    <td style="text-align:left;"><a href="<?php  echo $this->createWebUrl('dispatch', array('op' => 'post', 'id' => $item['id']))?>">修改</a> <a href="<?php  echo $this->createWebUrl('dispatch', array('op' => 'delete', 'id' => $item['id']))?>">删除</a> </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
        <input type="hidden" name="id" value="<?php  echo $dispatch['id'];?>" />
        <h4>配送方式设置</h4>
        <table class="tb">
            <tr>
                <th><label for="">排序</label></th>
                <td>
                    <input type="text" name="displayorder" class="span6" value="<?php  echo $dispatch['displayorder'];?>" />
                </td>
            </tr>
            <tr>
                <th><span class='red'>*</span><label for="">配送名称</label></th>
                <td>
                    <input type="text" name="dispatchname" id='dispatchname' class="span6" value="<?php  echo $dispatch['dispatchname'];?>" />
                </td>
            </tr>
             <tr>
                <th><span class='red'>*</span><label for="">配送类型</label></th>
                <td>
                   
                        <select name="dispatchtype" id="dispatchtype">
                            <option value="0" <?php  if($dispatch['dispatchtype']==0) { ?>selected<?php  } ?>>先付款后发货</option>
                            <option value="1" <?php  if($dispatch['dispatchtype']==1) { ?>selected<?php  } ?>>货到付款</option>
                        </select> 
 
           
            <tr>
                <th><span class='red'>*</span><label for="">重量设置</label></th>
                <td>
                    <div class="input-append input-prepend">
                        <span class="add-on">首重重量</span>
                        <select name="firstweight" id="firstweight" class='span1'>
                            <option value="500" <?php  if($dispatch['firstweight']==500) { ?>selected<?php  } ?>>0.5</option>
                            <option value="1000" <?php  if($dispatch['firstweight']==1000 || empty($dispatch['firstweight'])) { ?>selected<?php  } ?>>1</option>
                            <option value="1200" <?php  if($dispatch['firstweight']==1200) { ?>selected<?php  } ?>>1.2</option>
                            <option value="2000" <?php  if($dispatch['firstweight']==2000) { ?>selected<?php  } ?>>2</option>
                            <option value="5000" <?php  if($dispatch['firstweight']==5000) { ?>selected<?php  } ?>>5</option>
                            <option value="10000" <?php  if($dispatch['firstweight']==10000) { ?>selected<?php  } ?>>10</option>
                            <option value="20000" <?php  if($dispatch['firstweight']==20000) { ?>selected<?php  } ?>>20</option>
                            <option value="50000" <?php  if($dispatch['firstweight']==50000) { ?>selected<?php  } ?>>50</option>

                        </select> <span class="add-on">KG</span>

                    </div>
                    <div class="input-append input-prepend">
                        <span class="add-on">续重重量</span>
                        <select name="secondweight" id="secondweight" class='span1'>
                              <option value="500" <?php  if($dispatch['secondweight']==500) { ?>selected<?php  } ?>>0.5</option>
                            <option value="1000" <?php  if($dispatch['secondweight']==1000 || empty($dispatch['secondweight'])) { ?>selected<?php  } ?>>1</option>
                            <option value="1200" <?php  if($dispatch['secondweight']==1200) { ?>selected<?php  } ?>>1.2</option>
                            <option value="2000" <?php  if($dispatch['secondweight']==2000) { ?>selected<?php  } ?>>2</option>
                            <option value="5000" <?php  if($dispatch['secondweight']==5000) { ?>selected<?php  } ?>>5</option>
                            <option value="10000" <?php  if($dispatch['secondweight']==10000) { ?>selected<?php  } ?>>10</option>
                            <option value="20000" <?php  if($dispatch['secondweight']==20000) { ?>selected<?php  } ?>>20</option>
                            <option value="50000" <?php  if($dispatch['secondweight']==50000) { ?>selected<?php  } ?>>50</option>

                        </select> <span class="add-on">KG</span>

                    </div>
                </td>
            </tr>	

            <tr>
                <th><span class='red'>*</span><label for="">价格设置</label></th>
                <td>
                    <div class="input-append input-prepend">
                        <span class="add-on">首重价格</span>
                        <input type="text" name="firstprice" id='firstprice' class="span1" value="<?php  echo $dispatch['firstprice'];?>" />
<span class="add-on">元</span>
                    </div>
                      <div class="input-append input-prepend">
                        <span class="add-on">续重价格</span>
                        <input type="text" name="secondprice" id='secondprice' class="span1" value="<?php  echo $dispatch['secondprice'];?>" />
<span class="add-on">元</span>
                    </div>
                    
                    <span class='help-block'>根据重量来计算运费，当物品不足《首重重量》时，按照《首重费用》计算，超过部分按照《续重重量》和《续重费用》乘积来计算</span>
                </td>
            </tr>	
 <tr>
                <th><label for="">物流公司</label></th>
                <td>
                    <select name='express'>
                        <option value="" <?php  if(empty($dispatch['express'])) { ?>selected<?php  } ?>><?php  echo $express['express_name'];?></option>
                        <?php  if(is_array($express)) { foreach($express as $ex) { ?>
<option value="<?php  echo $ex['id'];?>" <?php  if($dispatch['express']==$ex['id']) { ?>selected<?php  } ?>><?php  echo $ex['express_name'];?></option>
<?php  } } ?>
                    </select>
                </td>
            </tr>
           <tr>
                <th><label for="">介绍</label></th>
                <td>
                    <textarea name="description" class="span6 rich" cols="70"><?php  echo $dispatch['description'];?></textarea>
                </td>
            </tr>
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
<script language='javascript'>
    function formcheck() {
        if ($("#dispatchname").isEmpty()) {
            Tip.focus("dispatchname", "请填写配送方式名称!", "right");
            return false;
        }
        if (!$("#firstprice").isNumber()) {
            Tip.select("firstprice", "请填写数字首重价格!", "top");
            return false;
        }
        if (!$("#secondprice").isNumber()) {
              Tip.select("secondprice", "请填写数字续重价格!", "top");
            return false;
        }
        return true;
    }
    $(function() {
        $("#common_corp").change(function() {

            var obj = $(this);
            var sel = obj.find("option:selected");

            $("#dispatch_name").val(sel.attr("data-name"));
            $("#dispatch_url").val(sel.attr("data-url"));
        });

    })
</script>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>