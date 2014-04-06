<?php
/**
 * The linkcase view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testtask
 * @version     $Id: linkcase.html.php 4411 2013-02-22 00:56:04Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='querybox'></div>
<form method='post'>
<table class='table-1 colored tablesorter fixed'>
  <caption class='caption-tl'>
    <div class='f-left'><?php echo $lang->testtask->unlinkedCases;?></div>
    <div class='f-right'>
      <?php
      $lang->testtask->linkCase = $lang->testtask->linkByStory;
      common::printIcon('testtask', 'linkCase', "taskID=$taskID&param=bystory");
      $lang->testtask->linkCase = $lang->testtask->linkByBug;
      common::printIcon('testtask', 'linkCase', "taskID=$taskID&param=bybug");
      common::printRPN($this->session->testtaskList);
      ?>
    </div>
  </caption>
  <thead>
  <tr class='colhead'>
    <th class='w-id'><?php echo $lang->idAB;?></th>
    <th class='w-60px'><nobr><?php echo $lang->testtask->linkVersion;?></nobr></th>
    <th class='w-pri'><?php echo $lang->priAB;?></th>
    <th><?php echo $lang->testcase->title;?></th>
    <th class='w-type'><?php echo $lang->testcase->type;?></th>
    <th class='w-user'><?php echo $lang->openedByAB;?></th>
    <th class='w-status'><?php echo $lang->statusAB;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($cases as $case):?>
  <tr class='a-center'>
    <td class='a-left'>
      <input type='checkbox' name='cases[]' value='<?php echo $case->id;?>' />
      <?php echo html::a($this->createLink('testcase', 'view', "testcaseID=$case->id"), sprintf('%03d', $case->id));?>
    </td>
    <td class='a-center'><?php echo html::select("versions[$case->id]", array_combine(range($case->version, 1), range($case->version, 1)), '', 'class=select-1');?> </td>
    <td><span class='<?php echo 'pri' . $case->pri?>'><?php echo $case->pri?></span></td>
    <td class='a-left'>
      <?php
      echo $case->title . ' ( ';
      for($i = $case->version; $i >= 1; $i --)
      {
          echo html::a($this->createLink('testcase', 'view', "caseID=$case->id&version=$i"), "#$i", '_blank');
      }
      echo ')';
      ?>
    </td>
    <td><?php echo $lang->testcase->typeList[$case->type];?></td>
    <td><?php echo $users[$case->openedBy];?></td>
    <td><?php echo $lang->testcase->statusList[$case->status];?></td>
  </tr>
  </tbody>
  <?php endforeach;?>
  <tfoot> 
  <tr>
    <td colspan='7'>
      <?php if($cases):?>
      <div class='f-left'><?php echo html::selectAll() . html::selectReverse() . html::submitButton();?></div>
      <?php endif;?>
      <div class='f-right'><?php $pager->show();?></div>
    </td>
  </tr>
  </tfoot>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>
