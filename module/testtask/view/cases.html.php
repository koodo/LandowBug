<?php
/**
 * The view file of case module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     case
 * @version     $Id: view.html.php 594 2010-03-27 13:44:07Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php js::set('confirmUnlink', $lang->testtask->confirmUnlinkCase)?>
<script language="Javascript">
var browseType = '<?php echo $browseType;?>';
var moduleID   = '<?php echo $moduleID;?>';
</script>

<div id='featurebar'>
  <div class='f-left'>
    <?php
    echo "<span id='bymoduleTab' onclick=\"browseByModule('$browseType')\"><a href='#'>" . $lang->testtask->byModule . "</a></span> ";
    echo "<span id='allTab'>" . html::a($this->inlink('cases', "taskID=$taskID&browseType=all&param=0"), $lang->testtask->allCases) . "</span>";
    echo "<span id='assignedtomeTab'>" . html::a($this->inlink('cases', "taskID=$taskID&browseType=assignedtome&param=0"), $lang->testtask->assignedToMe) . "</span>";
    echo "<span id='bysearchTab' onclick=\"browseBySearch('$browseType')\"><a href='#' class='link-icon'><i class='icon-search icon'></i>&nbsp;{$lang->testcase->bySearch}</a></span> ";
    ?>
  </div>
  <div class='f-right'>
    <?php
    common::printIcon('testtask', 'linkCase', "taskID=$task->id");
    common::printIcon('testcase', 'export', "productID=$productID&orderBy=`case`_desc&taskID=$task->id");
    common::printRPN($this->session->testtaskList, '');
    ?>
  </div>
</div>
<div id='querybox' class='<?php if($browseType !='bysearch') echo 'hidden';?>'></div>

<form method='post' name='casesform'>
<table class='cont-lt1'>
  <tr valign='top'>
    <td class='side <?php echo $treeClass;?>'>
      <div class='box-title'><?php echo $productName;?></div>
      <div class='box-content'><?php echo $moduleTree;?></div>
    </td>
    <td class='divider <?php echo $treeClass;?>'></td>
    <td>
    <?php $vars = "taskID=$task->id&browseType=$browseType&param=$param&orderBy=%s&recToal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
      <table class='table-1 colored tablesorter datatable mb-zero fixed' id='caseList'>
        <thead>
          <tr class='colhead'>
            <th class='w-id'><nobr><?php common::printOrderLink('id',            $orderBy, $vars, $lang->idAB);?></nobr></th>
            <th class='w-pri'>     <?php common::printOrderLink('pri',           $orderBy, $vars, $lang->priAB);?></th>
            <th>                   <?php common::printOrderLink('title',         $orderBy, $vars, $lang->testcase->title);?></th>
            <th class='w-type'>    <?php common::printOrderLink('type',          $orderBy, $vars, $lang->testcase->type);?></th>
            <th class='w-user'>    <?php common::printOrderLink('assignedTo',    $orderBy, $vars, $lang->testtask->assignedTo);?></th>
            <th class='w-user'>    <?php common::printOrderLink('lastRunner',    $orderBy, $vars, $lang->testtask->lastRunAccount);?></th>
            <th class='w-100px'>   <?php common::printOrderLink('lastRunDate',   $orderBy, $vars, $lang->testtask->lastRunTime);?></th>
            <th class='w-80px'>    <?php common::printOrderLink('lastRunResult', $orderBy, $vars, $lang->testtask->lastRunResult);?></th>
            <th class='w-status'>  <?php common::printOrderLink('status',        $orderBy, $vars, $lang->statusAB);?></th>
            <th class='w-100px {sorter: false}'><?php echo $lang->actions;?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $canBatchEdit   = common::hasPriv('testcase', 'batchEdit');
          $canBatchAssign = common::hasPriv('testtask', 'batchAssign');
          $canBatchRun    = common::hasPriv('testtask', 'batchRun');
          ?>
          <?php foreach($runs as $run):?>
          <tr class='a-center'>
            <td class='a-left'>
              <?php if($canBatchEdit or $canBatchAssign or $canBatchRun):?>
              <input type='checkbox' name='caseIDList[]' value='<?php echo $run->case;?>'/> 
              <?php endif;?>
              <?php printf('%03d', $run->case);?>
            </td>
            <td><span class='<?php echo 'pri' . $run->pri?>'><?php echo $run->pri?></span></td>
            <td class='a-left nobr'><?php echo html::a($this->createLink('testcase', 'view', "caseID=$run->case&version=$run->version&from=testtask"), $run->title, '_blank');?>
            </td>
            <td><?php echo $lang->testcase->typeList[$run->type];?></td>
            <td><?php $assignedTo = $users[$run->assignedTo]; echo substr($assignedTo, strpos($assignedTo, ':') + 1);?></td>
            <td><?php $lastRunner = $users[$run->lastRunner]; echo substr($lastRunner, strpos($lastRunner, ':') + 1);?></td>
            <td><?php if(!helper::isZeroDate($run->lastRunDate)) echo date(DT_MONTHTIME1, strtotime($run->lastRunDate));?></td>
            <td class='<?php echo $run->lastRunResult;?>'><?php if($run->lastRunResult) echo $lang->testcase->resultList[$run->lastRunResult];?></td>
            <td class='<?php echo $run->status;?>'><?php echo ($run->version < $run->caseVersion) ? "<span class='warning'>{$lang->testcase->changed}</span>" : $lang->testtask->statusList[$run->status];?></td>
            <td class='a-center'>
              <?php
              common::printIcon('testtask', 'runCase',    "id=$run->id", '', 'list', '', '', 'runCase');
              common::printIcon('testtask', 'results',    "id=$run->id", '', 'list', '', '', 'iframe');

              if(common::hasPriv('testtask', 'unlinkCase'))
              {
                  $unlinkURL = $this->createLink('testtask', 'unlinkCase', "caseID=$run->id&confirm=yes");
                  echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"caseList\",confirmUnlink)", '<i class="icon-green-testtask-unlinkCase"></i>', '', "class='link-icon' title='{$lang->testtask->unlinkCase}'");
              }

              common::printIcon('testcase', 'createBug', "product=$productID&extra=projectID=$task->project,buildID=$task->build,caseID=$run->case,runID=$run->id", $run, 'list', 'createBug');
              ?>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='10'>
              <?php if($runs):?>
              <div class='f-left'>

              <?php 
              if($canBatchEdit or $canBatchAssign or $canBatchRun) echo html::selectAll() . html::selectReverse();
              if($canBatchEdit)
              {
                  $actionLink = $this->createLink('testcase', 'batchEdit', "productID=$productID");
                  echo html::commonButton($lang->edit, "onclick=\"setFormAction('$actionLink')\"");
              }
              if($canBatchAssign)
              {
                  $actionLink = inLink('batchAssign', "taskID=$task->id");
                  echo html::select('assignedTo', $users);
                  echo html::commonButton($lang->testtask->assign, "onclick=\"setFormAction('$actionLink')\"");
              }
              if($canBatchRun)
              {
                  $actionLink = inLink('batchRUN', "productID=$productID&orderBy=id_desc&from=testtask");
                  echo html::commonButton($lang->testtask->runCase, "onclick=\"setFormAction('$actionLink')\"");
              }
              ?>

              </div>
              <?php endif;?>
              <?php echo $pager->show();?>
            </td>
          </tr>
        <tfoot>
      </table>
    </td>
  </tr>
</table>
</form>   
<?php include '../../common/view/footer.html.php';?>
