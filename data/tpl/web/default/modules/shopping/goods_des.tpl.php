<?php defined('IN_IA') or exit('Access Denied');?><table class="tb">
<!--            <tr>
                <th><span class="white">*</span>商品简介</th>
                <td>
                    <textarea style="height:150px;" class="span7" id="description" name="description" cols="70"><?php  echo $item['description'];?></textarea>
                </td>
            </tr>-->
            <tr>
                <th><span class="red">*</span>商品详情</th>
                <td>
                    <textarea style="height:500px; width:90%;" class="span7 richtext-clone" name="content" cols="70"><?php  echo $item['content'];?></textarea>
                </td>
            </tr>
</table>