<?php
/**
 * The bug view file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: bug.html.php 5107 2013-07-12 01:46:12Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<div id='featurebar'>
  <div class='f-left'>
    <?php
    echo "<span id='assignedToTab'>"  . html::a(inlink('bug', "type=assignedTo"),  $lang->bug->assignToMe)    . "</span>";
    echo "<span id='openedByTab'>"    . html::a(inlink('bug', "type=openedBy"),    $lang->bug->openedByMe)    . "</span>";
    echo "<span id='resolvedByTab'>"  . html::a(inlink('bug', "type=resolvedBy"),  $lang->bug->resolvedByMe)  . "</span>";
    echo "<span id='closedByTab'>"    . html::a(inlink('bug', "type=closedBy"),    $lang->bug->closedByMe)    . "</span>";
    ?>
  </div>
</div>
<form method='post' action='<?php echo $this->createLink('bug', 'batchEdit', "productID=0");?>'>
  <table class='table-1 fixed tablesorter colored' id='bugList'>
    <?php $vars = "type=$type&orderBy=%s&recTotal=$recTotal&recPerPage=$recPerPage&pageID=$pageID"; ?>
    <thead>
    <tr class='colhead'>
      <th class='w-id'>        <?php common::printOrderLink('id',         $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-severity'>  <?php common::printOrderLink('severity',   $orderBy, $vars, $lang->bug->severityAB);?></th>
      <th class='w-pri'>       <?php common::printOrderLink('pri',        $orderBy, $vars, $lang->priAB);?></th>
      <th class='w-type'>      <?php common::printOrderLink('type',       $orderBy, $vars, $lang->typeAB);?></th>
      <th>                     <?php common::printOrderLink('title',      $orderBy, $vars, $lang->bug->title);?></th>
      <th class='w-user'>      <?php common::printOrderLink('openedBy',   $orderBy, $vars, $lang->openedByAB);?></th>
      <th class='w-user'>      <?php common::printOrderLink('resolvedBy', $orderBy, $vars, $lang->bug->resolvedByAB);?></th>
      <th class='w-resolution'><?php common::printOrderLink('resolution', $orderBy, $vars, $lang->bug->resolutionAB);?></th>
      <th class='w-140px'><?php echo $lang->actions;?></th>
    </tr>
    </thead>
    <tbody>
    <?php $canBatchEdit  = common::hasPriv('bug', 'batchEdit');?>
    <?php foreach($bugs as $bug):?>
    <tr class='a-center'>
      <td class='a-left'>
        <?php if($canBatchEdit):?><input type='checkbox' name='bugIDList[]' value='<?php echo $bug->id;?>' /><?php endif;?>
        <?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), sprintf('%03d', $bug->id), '_blank');?>
      </td>
      <td><span class='<?php echo 'severity' . $lang->bug->severityList[$bug->severity]?>'><?php echo isset($lang->bug->severityList[$bug->severity]) ? $lang->bug->severityList[$bug->severity] : $bug->severity;?></span></td>
      <td><span class='<?php echo 'pri' . $lang->bug->priList[$bug->pri]?>'><?php echo isset($lang->bug->priList[$bug->pri]) ? $lang->bug->priList[$bug->pri] : $bug->pri?></span></td>
      <td><?php echo $lang->bug->typeList[$bug->type]?></td>
      <td class='a-left nobr'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?></td>
      <td><?php echo $users[$bug->openedBy];?></td>
      <td><?php echo $users[$bug->resolvedBy];?></td>
      <td><?php echo $lang->bug->resolutionList[$bug->resolution];?></td>
      <td class='a-right'>
        <?php
        $params = "bugID=$bug->id";
        common::printIcon('bug', 'confirmBug', $params, $bug, 'list', '', '', 'iframe', true);
        common::printIcon('bug', 'assignTo',   $params, '', 'list', '', '', 'iframe', true);
        common::printIcon('bug', 'resolve',    $params, $bug, 'list', '', '', 'iframe', true);
        common::printIcon('bug', 'close',      $params, $bug, 'list', '', '', 'iframe', true);
        common::printIcon('bug', 'edit',       $params, '', 'list');
        ?>
      </td>
    </tr>
    <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr><td colspan='9'>
      <?php if($bugs and $canBatchEdit):?>
      <div class='f-left'>
      <?php echo html::selectAll() . html::selectReverse() . html::submitButton($lang->edit);?>
      </div>
      <?php endif;?>
      <?php $pager->show();?>
      </td></tr>
    </tfoot>
  </table>
</form>
<?php js::set('listName', 'bugList')?>
<script language='javascript'>$("#<?php echo $type;?>Tab").addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
