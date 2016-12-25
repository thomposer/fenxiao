<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<div class="main">
 
    <form action="" method="post" class="form-horizontal form">
        <h4>提醒设置</h4>
        <table class="tb">
            <tr>
                <th>提醒接收邮箱</th>
                <td>
                    <input type="text" name="noticeemail" class="span5" value="<?php  echo $settings['noticeemail'];?>" />
                </td>
            </tr>
            
        </table>
        <h4>商城信息</h4>
        <table class="tb">
            <tr>
                <th>品牌名称</th>
                <td>
                    <input type="text" name="shopname" class="span5" value="<?php  echo $settings['shopname'];?>" />
                </td>
            </tr>

            <tr>
                <th><label for="">官方网址</label></th>
                <td>
                    <input type="text" name="officialweb" class="span6" value="<?php  echo $settings['officialweb'];?>" />
                </td>
            </tr>				
            <tr>
                <th>品牌图片</th>
                <td>
                    <?php  echo tpl_form_field_image('logo', $settings['logo']);?>
                </td>
            </tr>				
           	
               <tr>
                <th>联系电话：</th>
                <td><input type="text" id="phone" name="phone"  class="span7" value="<?php  echo $settings['phone'];?>"> </td>
            </tr>
            <tr>
                <th>所在地址：</th>
                <td><input type="text" id="address" name="address"  class="span7" value="<?php  echo $settings['address'];?>"> </td>
            </tr>
          
               <tr>
                <th>品牌介绍：</th>
                <td>
                    <textarea style="height:200px;" id="description" name="description" class="span7 description" cols="60"><?php  echo $settings['description'];?></textarea>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>
        </table>

    </form>
</div>
<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="./resource/script/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
 
<script type="text/javascript">
    kindeditor($(".description"));
    </script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>