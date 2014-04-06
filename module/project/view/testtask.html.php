<?php
/**
 * The browse view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testtask
 * @version     $Id: browse.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('confirmDelete', $lang->testtask->confirmDelete)?>
<table class='table-1 colored tablesorter fixed' id='taskList'>
  <caption class='caption-tl pb-10px'>
    <div class='f-left'><?php echo $lang->testtask->browse;?></div>
    <div class='f-right'><?php common::printIcon('testtask', 'create', "product=0&project=$projectID");?></div>
  </caption>
  <thead>
  <tr class='colhead'>
    <th class='w-id'><?php echo $lang->idAB;?></th>
    <th><?php echo $lang->testtask->name;?></th>
    <th><?php echo $lang->testtask->build;?></th>
    <th class='w-user'><?php echo $lang->testtask->owner;?></th>
    <th class='w-100px'><?php echo $lang->testtask->begin;?></th>
    <th class='w-100px'><?php echo $lang->testtask->end;?></th>
    <th class='w-80px'><?php echo $lang->statusAB;?></th>
    <th class='w-100px {sorter:false}'><?php echo $lang->actions;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($tasks as $task):?>
  <tr class='a-center'>
    <td><?php echo html::a($this->createLink('testtask', 'view', "taskID=$task->id"), sprintf('%03d', $task->id));?></td>
    <td class='a-left' title="<?php echo $task->name?>"><?php echo html::a($this->createLink('testtask', 'view', "taskID=$task->id"), $task->name);?></td>
    <td title="<?php echo $task->buildName?>"><?php $task->build == 'trunk' ? print('Trunk') : print(html::a($this->createLink('build', 'view', "buildID=$task->build"), $task->buildName));?></td>
    <td><?php echo $users[$task->owner];?></td>
    <td><?php echo $task->begin?></td>
    <td><?php echo $task->end?></td>
    <td><?php echo $lang->testtask->statusList[$task->status];?></td>
    <td>
      <?php
      common::printIcon('testtask', 'cases',    "taskID=$task->id", '', 'list');
      common::printIcon('testtask', 'linkCase', "taskID=$task->id", '', 'list');
      common::printIcon('testtask', 'edit',     "taskID=$task->id", '', 'list');

      if(common::hasPriv('testtask', 'delete'))
      {
          $deleteURL = $this->createLink('testtask', 'delete', "taskID=$task->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"taskList\",confirmDelete)", '<i class="icon-green-common-delete"></i>', '', "class='link-icon' title='{$lang->testtask->delete}'");
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
</table>
<?php include '../../common/view/footer.html.php';?>
