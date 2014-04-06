<?php
/**
 * The action->dynamic view file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: action->dynamic.html.php 1477 2011-03-01 15:25:50Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='featurebar'>
  <?php 
  echo '<span id="today">'      . html::a(inlink('dynamic', "productID=$productID&type=today"),      $lang->action->dynamic->today)      . '</span>';
  echo '<span id="yesterday">'  . html::a(inlink('dynamic', "productID=$productID&type=yesterday"),  $lang->action->dynamic->yesterday)  . '</span>';
  echo '<span id="twodaysago">' . html::a(inlink('dynamic', "productID=$productID&type=twodaysago"), $lang->action->dynamic->twoDaysAgo) . '</span>';
  echo '<span id="thisweek">'   . html::a(inlink('dynamic', "productID=$productID&type=thisweek"),   $lang->action->dynamic->thisWeek)   . '</span>';
  echo '<span id="lastweek">'   . html::a(inlink('dynamic', "productID=$productID&type=lastweek"),   $lang->action->dynamic->lastWeek)   . '</span>';
  echo '<span id="thismonth">'  . html::a(inlink('dynamic', "productID=$productID&type=thismonth"),  $lang->action->dynamic->thisMonth)  . '</span>';
  echo '<span id="lastmonth">'  . html::a(inlink('dynamic', "productID=$productID&type=lastmonth"),  $lang->action->dynamic->lastMonth)  . '</span>';
  echo '<span id="all">'        . html::a(inlink('dynamic', "productID=$productID&type=all"),        $lang->action->dynamic->all)        . '</span>';
  echo "<span id='account'>"    . html::select('account', $users, $account, "onchange=changeUser(this.value,$productID)") . '</span>';
  ?>
</div>

<table class='table-1 colored tablesorter fixed'>
  <thead>
  <tr class='colhead'>
    <th class='w-150px'><?php echo $lang->action->date;?></th>
    <th class='w-user'> <?php echo $lang->action->actor;?></th>
    <th class='w-100px'><?php echo $lang->action->action;?></th>
    <th class='w-80px'> <?php echo $lang->action->objectType;?></th>
    <th class='w-id'>   <?php echo $lang->idAB;?></th>
    <th><?php echo $lang->action->objectName;?></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($actions as $action):?>
  <?php $module = $action->objectType == 'case' ? 'testcase' : $action->objectType;?>
  <tr class='a-center'>
    <td><?php echo $action->date;?></td>
    <td><?php isset($users[$action->actor]) ? print($users[$action->actor]) : print($action->actor);?></td>
    <td><?php echo $action->actionLabel;?></td>
    <td><?php echo $lang->action->objectTypes[$action->objectType];?></td>
    <td><?php echo $action->objectID;?></td>
    <td class='a-left'><?php echo html::a($action->objectLink, $action->objectName);?></td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='6'><?php $pager->show();?></td></tr></tfoot>
</table>
<script>$('#<?php echo $type;?>').addClass('active')</script>
<?php include '../../common/view/footer.html.php';?>
