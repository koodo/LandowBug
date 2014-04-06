<?php
/**
 * The bug view file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: bug.html.php 4771 2013-05-05 07:41:02Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php include './featurebar.html.php';?>
<div id='featurebar'>
  <div class='f-left'>
    <?php
    echo "<span id='assignedToTab'>"  . html::a(inlink('bug', "account=$account&type=assignedTo"), $lang->user->assignedTo) . "</span>";
    echo "<span id='openedByTab'>"    . html::a(inlink('bug', "account=$account&type=openedBy"),   $lang->user->openedBy)   . "</span>";
    echo "<span id='resolvedByTab'>"  . html::a(inlink('bug', "account=$account&type=resolvedBy"), $lang->user->resolvedBy) . "</span>";
    echo "<span id='closedByTab'>"    . html::a(inlink('bug', "account=$account&type=closedBy"),   $lang->user->closedBy)   . "</span>";
    ?>
  </div>
</div>
<table class='table-1 tablesorter fixed'>
  <thead>
  <tr class='colhead'>
    <th class='w-id'><?php echo $lang->idAB;?></th>
    <th class='w-severity'><?php echo $lang->bug->severityAB;?></th>
    <th class='w-pri'><?php echo $lang->priAB;?></th>
    <th class='w-type'><?php echo $lang->typeAB;?></th>
    <th><?php echo $lang->bug->title;?></th>
    <th class='w-user'><?php echo $lang->openedByAB;?></th>
    <th class='w-user'><?php echo $lang->bug->resolvedBy;?></th>
    <th class='w-resolution'><?php echo $lang->bug->resolutionAB;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($bugs as $bug):?>
  <tr class='a-center'>
    <td><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->id, '_blank');?></td>
    <td><?php echo $lang->bug->severityList[$bug->severity]?></td>
    <td><span class='<?php echo 'pri' . $lang->bug->priList[$bug->pri]?>'><?php echo $lang->bug->priList[$bug->pri]?></span></td>
    <td><?php echo $lang->bug->typeList[$bug->type]?></td>
    <td class='a-left nobr'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?></td>
    <td><?php echo $users[$bug->openedBy];?></td>
    <td><?php echo $users[$bug->resolvedBy];?></td>
    <td><?php echo $lang->bug->resolutionList[$bug->resolution];?></td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='8'><?php echo $pager->show();?></td></tr></tfoot>
</table>
<script language='javascript'>$("#<?php echo $type;?>Tab").addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
