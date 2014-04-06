<?php
/**
 * The resutls view file of testtask of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testtask
 * @version     $Id: results.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<h1>CASE#<?php echo $case->id. $lang->colon . $case->title;?></h1>
<fieldset>
  <legend><?php echo $lang->testcase->precondition;?></legend>
  <?php echo $case->precondition;?>
</fieldset>
<?php foreach($results as $result):?>
<table class='table-1'>
  <caption>
    <div class='f-left'>RESULT#<?php echo $result->id . ' ' . $result->date . ' ' . $users[$result->lastRunner] . ' ' . $lang->testtask->runCase . ':'. " <span class='$result->caseResult'>" . $lang->testcase->resultList[$result->caseResult] . '</span>';?></div>
    <?php if(isset($build)):?><div class='f-right'><?php echo $lang->testtask->build . $lang->colon . $build;?></div><?php endif;?>
  </caption>
  <tr>
    <th class='w-30px'><?php echo $lang->testcase->stepID;?></th>
    <th class='w-p40'><?php echo $lang->testcase->stepDesc;?></th>
    <th class='w-p20'><?php echo $lang->testcase->stepExpect;?></th>
    <th><?php echo $lang->testcase->result;?></th>
    <th class='w-p20'><?php echo $lang->testcase->real;?></th>
  </tr>
  <?php 
  $i = 1;
  foreach($result->stepResults as $key => $stepResult):
  ?>
  <tr>
    <th><?php echo $i;?></th>
    <td><?php if(isset($stepResult['desc'])) echo nl2br($stepResult['desc']);?></td>
    <td><?php if(isset($stepResult['expect'])) echo nl2br($stepResult['expect']);?></td>
    <?php if(!empty($stepResult['result'])):?>
    <td class='<?php echo $stepResult['result'];?> a-center'><?php echo $lang->testcase->resultList[$stepResult['result']];?></td>
    <td><?php echo $stepResult['real'];?></td>
  </tr>
    <?php else:?>
    <td></td>
    <td></td>
  </tr>
    <?php endif; $i++;?>
  <?php endforeach;?>
</table>
<?php endforeach;?>
</div>
