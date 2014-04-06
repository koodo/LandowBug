<?php
/**
 * The edit view of tree module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id: edit.html.php 4795 2013-06-04 05:59:58Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<form method='post' class='mt-10px' id='dataform'>
  <table class='table-1'> 
    <caption><?php echo $lang->tree->edit;?></caption>
    <?php $hidden = ($type != 'story' and $module->type == 'story');?>
    <tr <?php if($hidden) echo "style='display:none'";?>>
      <th class='rowhead'><?php echo $lang->tree->parent;?></th>
      <td><?php echo html::select('parent', $optionMenu, $module->parent, "class='select-1'");?></td>
    </tr>
    <tr <?php if($hidden) echo "style='display:none'";?>>
      <th class='rowhead'><?php echo $lang->tree->name;?></th>
      <td><?php echo html::input('name', $module->name, "class='text-1'");?></td>
    </tr>
    <?php if($type == 'bug'):?>
    <tr>
      <th class='rowhead'><?php echo $lang->tree->owner;?></th>
      <td><?php echo html::select('owner', $users, $module->owner, "class='select-1'", true);?></td>
    </tr>  
    <?php endif;?>
    <tr>
      <td colspan='2' class='a-center'>
      <?php echo html::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.lite.html.php';?>
