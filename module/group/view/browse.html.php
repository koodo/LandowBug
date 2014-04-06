<?php
/**
 * The browse view file of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: browse.html.php 4769 2013-05-05 07:24:21Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('confirmDelete', $lang->group->confirmDelete);?>
<table align='center' class='table-1 tablesorter fixed' id='groupList'>
  <caption class='caption-tl pb-10px'>
    <div class='f-left'><?php echo $lang->group->browse;?></div>
    <div class='f-right'><?php common::printIcon('group', 'create');?></div>
  </caption>
  <thead>
  <tr class='colhead'>
   <th class='w-id'><?php echo $lang->group->id;?></th>
   <th class='w-100px'><?php echo $lang->group->name;?></th>
   <th><?php echo $lang->group->desc;?></th>
   <th class='w-p60'><?php echo $lang->group->users;?></th>
   <th class='w-120px {sorter:false}'><?php echo $lang->actions;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($groups as $group):?>
  <?php $users = implode(' ', $groupUsers[$group->id]);?>
  <tr class='a-center'>
    <td class='strong'><?php echo $group->id;?></td>
    <td class='a-left'><?php echo $group->name;?></td>
    <td class='a-left'><?php echo $group->desc;?></td>
    <td class='a-left' title='<?php echo $users;?>'><?php echo $users;?></td>
    <td class='a-center'>
      <?php $lang->group->managepriv = $lang->group->managePrivByGroup;?>
      <?php common::printIcon('group', 'managepriv',   "type=byGroup&param=$group->id", '', 'list');?>
      <?php $lang->group->managemember = $lang->group->manageMember;?>
      <?php common::printIcon('group', 'managemember', "groupID=$group->id", '', 'list');?>
      <?php common::printIcon('group', 'edit',         "groupID=$group->id", '', 'list');?>
      <?php common::printIcon('group', 'copy',         "groupID=$group->id", '', 'list');?>
      <?php
      if(common::hasPriv('group', 'delete'))
      {
          $deleteURL = $this->createLink('group', 'delete', "groupID=$group->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"groupList\",confirmDelete)", '<i class="icon-green-common-delete"></i>', '', "class='link-icon' title='{$lang->group->delete}'");
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <?php if(common::hasPriv('group', 'managePriv')):?>
  <tfoot>
    <tr><td colspan='5' class='a-center'><?php echo html::linkButton($lang->group->managePrivByModule, inlink('managePriv', 'type=byModule'));?></td></tr>
  </tfoot>
  <?php endif;?>
</table>
<?php include '../../common/view/footer.html.php';?>
