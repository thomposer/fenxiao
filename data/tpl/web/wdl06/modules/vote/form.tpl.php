<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<input type="hidden" name="reply_id" value="<?php  echo $reply['id'];?>" />
<div class="alert alert-block alert-new">
    <h4 class="alert-heading">添加投票信息</h4>
    <table>
        <tbody>
            <?php  if(!empty($reply['id'])) { ?>
            <tr>
                <th>菜单</th>
                <td><a href="javascript:;" onclick='result()'>查看投票结果</a>
                    <a href="<?php  echo create_url('site/module', array('do' => 'votelist', 'name' => 'vote', 'id' => $reply['rid']))?>">查看投票记录</a>
                </td>
            </tr><?php  } ?>
            <tr>
                <th><span class="red">*</span>投票标题</th>
                <td>
                    <input type="text" id="title" class="span7" placeholder="" name="title" value="<?php  echo $reply['title'];?>">
                </td>
            </tr>
            <tr>
                <th>投票图片</th>
                <td><?php  echo tpl_form_field_image('thumb',$reply['thumb']);?>
                </td>
            </tr>
            <tr>
                <th>投票内容</th>
                <td>
                    <textarea style="height:150px;" id="description" name="description" class="span7" cols="60"><?php  echo $reply['description'];?></textarea>
                    <div class="help-block">用于投票的说明</div>
                </td>
            </tr>
        </tbody>
    </table>

    <h4 class="alert-heading">投票设置 </h4>
    <table>
        <tr>
            <th><span class="red">*</span>投票限制</th>
            <td>
                <label class="radio inline"  style='margin-right:10px;margin-top:5px;'>
                    <input type="radio" name="votelimit" value="0" <?php  if($reply['votelimit'] == 0) { ?> checked="checked"<?php  } ?>/>
                           时间限制
                </label>
                <?php  echo tpl_form_field_daterange('datelimit', array('starttime'=>$reply['starttime'],'endtime'=>$reply['endtime']),array('time'=>true))?>
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <label class="radio inline">
                  <input type="radio" name="votelimit" value="1"  <?php  if($reply['votelimit'] == 1) { ?> checked="checked"<?php  } ?>/>
                           人数限制
                </label>
                <div class="input-prepend input-append" style='margin-left:10px;'>
                    <span class="add-on">共</span>
                    <input type="text" class="span1" name="votetotal" id="votetotal" value="<?php  echo $reply['votetotal'];?>" />
                    <span class="add-on">人</span>
                </div>

            </td>
        </tr>
         <th>每人投票次数</th>
            <td>

                <div class="input-prepend input-append">
                    <span class="add-on">共</span>
                    <input type="text" class="span1" name="votetimes" id="votetimes" value="<?php  echo $reply['votetimes'];?>" />
                    <span class="add-on">次</span>
                </div>
 <div class="help-block">限制每人投票次数，0为不限制</div>
            </td>
        </tr>
        <tr>
            <th>投票选项类型</th>
            <td>
                <label class="radio inline"><input type="radio" name="votetype" value="0" <?php  if($reply['votetype'] == 0) { ?> checked="true" <?php  } ?>>单选</label>&nbsp;&nbsp;
                <label class="radio inline"><input type="radio" name="votetype" value="1" <?php  if($reply['votetype'] == 1) { ?> checked="true" <?php  } ?>>多选</label>&nbsp;&nbsp;
            </td>
        </tr>
         <tr>
            <th>投票类型</th>
            <td>
                <label class="radio inline"><input type="radio" name="isimg" onclick="changeTo('text')" id='isimg' value="0" <?php  if($reply['isimg'] == 0) { ?> checked="true" <?php  } ?>>文本</label>&nbsp;&nbsp;
                <label class="radio inline"><input type="radio" name="isimg" onclick="changeTo('image')" value="1" <?php  if($reply['isimg'] == 1) { ?> checked="true" <?php  } ?>>图片</label>&nbsp;&nbsp;
            </td>
        </tr>
        <tr>
            <th><label for="">投票选项</label></th>
            <td>
                <div class="alert alert-block alert-new" style="width:500px">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>选项标题</th>
                                <th>选项图片</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td colspan="3" style='padding-left:0;padding-right:0'>
                                    <input type='hidden' id='itemlen' name='itemlen' value='<?php  echo $len;?>' />
                                    <div id="re-items" style='width:500px'>
                                        <?php  if(is_array($options)) { foreach($options as $o) { ?>


                                        <div class='voteitem' style='float:left;width:225px;margin-bottom:5px;margin-right:5px;padding:5px;border:1px solid #ccc'>
    <input name="option_title[]" type="text" class="span3 item_title" value="<?php  echo $o['title'];?>"/>
    <input name="option_id[]" type="hidden" class="span3" value="<?php  echo $o['id'];?>"/>

    <div class="fileupload fileupload-new  <?php  if(empty($reply['isimg'])) { ?>hide<?php  } ?> item-image" tabindex="-1" data-provides="fileupload" style='margin-top:5px;width:225px;'>
        <div id="thumb0_span" tabindex="-1" class="fileupload-preview thumbnail" style="float:left;;width: 100px; height: 100px;">
            <?php  if(!empty($o['thumb'])) { ?><img src="<?php  echo img_url($o['thumb'])?>" width="100" /><?php  } ?></div>
        <div style='float:left;margin-left:5px;'>
            <span class="btn btn-file">
                <span class="fileupload-new">选择图片</span><span class="fileupload-exists">更改</span><input name="option_thumb_<?php  echo $o['id'];?>" type="file" class='vote_img_file' /></span>
            <br/><a href="#" class="btn fileupload-exists" data-dismiss="fileupload" style='margin-top:5px'>移除</a>
            <input type="hidden" name="option_thumb_old_<?php  echo $o['id'];?>" value="<?php  echo $o['thumb'];?>" class='vote_img_old' />
        </div>
    </div>


    <div style='margin-top:5px;width:225px;float:left;'>
        <a href="javascript:;" onclick="deleteItem(this)" style="margin-top:10px;"  title="删除">删除投票项 <i class='icon-remove'></i></a>
    </div>
</div>
                           <?php  } } ?>
                                        </div>
                                   </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div id="items_div" tabindex="-1" class="alert alert-block alert-new" style="width:500px">
                    <?php  if($hasData) { ?>
                    <a href="javascript:;">已经存在投票, 不能修改投票信息</a>
                    <?php  } else { ?>
                    <a href="javascript:;" onclick="addItem();">添加投票选项 <i class="icon-plus-sign" title="添加投票选项"></i></a>
                    <?php  } ?>
                </div>
                <span class="help-block">投票开始后(已经有粉丝用户投票), 将不能再修改投票信息, 请仔细编辑. </span>
            </td>
        </tr>
        </tbody>
    </table>

    <h4 class="alert-heading">分享设置</h4>
    <table>
        <tbody>
        <th>分享标题：</th>
        <td>
            <input type="text" id="share_title" class="span7" placeholder="" name="share_title" value="<?php  echo $reply['share_title'];?>">
            <div class="help-block">分享的文字，用户显示分享给用户的介绍!</div>
        </td>
        </tr>
        <tr>
            <th>分享描述：</th>
            <td>
                <textarea style="height:60px;" name="share_desc" class="span7" cols="60"><?php  echo $reply['share_desc'];?></textarea>
            </td>
        </tr>
        <th>分享地址：</th>
        <td>
            <input type="text" id="share_url" class="span7" placeholder="" name="share_url" value="<?php  echo $reply['share_url'];?>">
            <div class="help-block">分享的链接! 推荐用微信平台的素材库，转成短地址。<a target="_blank" href="http://www.dwz.cn/">短网址转换</a></div>
        </td>
        </tr>
        <th>分享说明：</th>
        <td>
            <textarea style="height:200px; width:100%;" id='share_txt' class="span7 richtext-clone" name="share_txt" cols="70"><?php  echo $reply['share_txt'];?></textarea>
            <span class="help-block">如分享地址为空，则显示这里文字，分享后用户需关注公共号,才可以参加活动! </span>
        </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    //kindeditor($('#rule'));
    kindeditor($('#share_txt'));
    //kindeditorUploadBtn($('#user-picture'));
function changeTo(t){
    if(t=='image'){
        $(".item-image").show();
    }
    else{
        $(".item-image").hide();
    }
}
        function doDeleteItemImage(obj, id) {
            var filename = $('input#' + id + "-value").val();
                    $('.' + id + "_preview").html("");
                    $(obj).html("正在删除...").attr("disabled", true);
                    ajaxopen('./index.php?act=attachment&do=delete&filename=' + filename, function(){
                    $(obj).html("<i class='icon-upload-alt'></i> 删除").hide().removeAttr("disabled");
                    });
            }
    function addItem() {
        var url = "<?php  echo create_url('site/module',array('do'=>'item','name'=>'vote'))?>"+"&type=" +($("#isimg").get(0).checked?"text":"image");
        $.ajax({
           //'url': "./source/modules/vote/template/item.html" ,
           "url": url ,
           success:function(data){
               $("#itemlen").val( parseInt($("#itemlen").val()) + 1);
               $('#re-items').append(data);
           }

        });
        return;

    }
    function deleteItem(o) {
        $(o).parent().parent().remove();
    }
function result(){

    ajaxshow("<?php  echo create_url('site/module', array('do' => 'result', 'name' => 'vote', 'id' => $reply['rid']))?>","查看票数");
}
    $(function(){


    })


    var itemcheck = function(){
          if($("#title").isEmpty()){
              Tip.focus("title",'请填写投票标题!',"right");
              return false;
          }
          if($(".voteitem").length<=1){
               Tip.focus("items_div",'至少二个投票选项!',"bottom");
              return false;
          }
          var full = true;
          $(".item_title").each(function(i){
              if( $(this).isEmpty()) {

                  Tip.focus(".item_title:eq(" + i + ")","请输入投票选项标题!","top");
                  full =false;
                  return false;
              }

          });

             if(!$("#isimg").get(0).checked){
                  $(".item-image").each(function(i){
                     //if( $(this).isEmpty()) {
                     if($(".vote_img_old",$(this)).isEmpty() && $(".vote_img_file",$(this)).isEmpty()){
                       Tip.focus(".item-image:eq(" + i + ")","请上传投票选项图片!","top");
                         full =false;
                         return false;
                     }
                });
              }
          return full;
    }
</script>