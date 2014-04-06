<?php
/**
 * The browse view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testtask
 * @version     $Id: browse.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php js::set('confirmDelete', $lang->testtask->confirmDelete)?>
<table class='table-1 colored tablesorter fixed' id='taskList'>
  <caption class='caption-tl'>
    <div class='f-left'><?php echo $lang->testtask->browse;?></div>
    <div class='f-right'><?php common::printIcon('testtask', 'create', "product=$productID");?></div>
  </caption>
  <thead>
  <?php $vars = "productID=$productID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
  <tr class='colhead'>
    <th class='w-id'>  <?php common::printOrderLink('id',      $orderBy, $vars, $lang->idAB);?></th>
    <th>               <?php common::printOrderLink('name',    $orderBy, $vars, $lang->testtask->name);?></th>
    <th>               <?php common::printOrderLink('project', $orderBy, $vars, $lang->testtask->project);?></th>
    <th>               <?php common::printOrderLink('build',   $orderBy, $vars, $lang->testtask->build);?></th>
    <th class='w-user'><?php common::printOrderLink('owner',   $orderBy, $vars, $lang->testtask->owner);?></th>
    <th class='w-80px'><?php common::printOrderLink('begin',   $orderBy, $vars, $lang->testtask->begin);?></th>
    <th class='w-80px'><?php common::printOrderLink('end',     $orderBy, $vars, $lang->testtask->end);?></th>
    <th class='w-50px'><?php common::printOrderLink('status',  $orderBy, $vars, $lang->statusAB);?></th>
    <th class='w-100px {sorter:false}'><?php echo $lang->actions;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($tasks as $task):?>
  <tr class='a-center'>
    <td><?php echo html::a(inlink('view', "taskID=$task->id"), sprintf('%03d', $task->id));?></td>
    <td class='a-left' title="<?php echo $task->name?>"><?php echo html::a(inlink('view', "taskID=$task->id"), $task->name);?></td>
    <td class='a-left' title="<?php echo $task->projectName?>"><?php echo html::a($this->createLink('project', 'story', "projectID=$task->project"), $task->projectName);?></td>
    <td class='a-left' title="<?php echo $task->buildName?>"><?php $task->build == 'trunk' ? print('Trunk') : print(html::a($this->createLink('build', 'view', "buildID=$task->build"), $task->buildName));?></td>
    <td><?php echo $users[$task->owner];?></td>
    <td><?php echo $task->begin?></td>
    <td><?php echo $task->end?></td>
    <td><?php echo $lang->testtask->statusList[$task->status];?></td>
    <td class='a-center'>
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
  <tfoot><tr><td colspan='9'><?php $pager->show();?></td></tr></tfoot>
</table>
<?php include '../../common/view/footer.html.php';?>
