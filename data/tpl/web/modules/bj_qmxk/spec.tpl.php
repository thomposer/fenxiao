<?php defined('IN_IA') or exit('Access Denied');?> <div class="alert alert-new spec_item" style='width:100%;' id='spec_<?php  echo $spec['id'];?>' >
            <input name="spec_id[]" type="hidden" class="span3 spec_id" value="<?php  echo $spec['id'];?>"/>
                                            
            <table  class="tb">
                <tr>
                    <td style='width:80px;'>规格名:</td>
                    <td>
                           <input name="spec_title[<?php  echo $spec['id'];?>]" type="text" class="span3  spec_title" value="<?php  echo $spec['title'];?>"/>
                           <span class='help-inline'>
                               (比如: 颜色)
                           </span>
                </tr>
                <tr>
                    <td>规格项:</td>
                    <td id='spec_item_<?php  echo $spec['id'];?>' class='spec_item_items'> 
                         <?php  if(is_array($spec['items'])) { foreach($spec['items'] as $specitem) { ?>
                            <?php  include $this->template('spec_item')?>
                         <?php  } } ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="javascript:;" id="add-specitem-<?php  echo $spec['id'];?>" specid='<?php  echo $spec['id'];?>' class='btn add-specitem' onclick="addSpecItem('<?php  echo $spec['id'];?>')"><i class="icon-plus"></i> 添加规格项</a>
                        <a href="javascript:void(0);" class='btn btn-danger' onclick="removeSpec('<?php  echo $spec['id'];?>')"><i class="icon-plus"></i> 删除规格</a>
                    </td>
                </tr>
              
                
            </table>
        </div>        