<?php
/**
 * The start file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     task
 * @version     $Id: start.html.php 935 2010-07-06 07:49:24Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('confirmFinish', $lang->task->confirmFinish);?>
<form method='post' target='hiddenwin' onsubmit='return checkLeft();'>
  <table class='table-1'>
    <caption><?php echo $task->name;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->task->realStarted;?></th>
      <td><?php echo html::input('realStarted', helper::today(), "class='text-2 date'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->task->consumed;?></th>
      <td><?php echo html::input('consumed', $task->consumed, "class='text-2'") . $lang->task->hour;?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->task->left;?></th>
      <td><?php echo html::input('left', $task->left, "class='text-2'") . $lang->task->hour;?></td>
    </tr>
    <tr>
      <td class='rowhead'><?php echo $lang->comment;?></td>
      <td><?php echo html::textarea('comment', '', "rows='6' class='w-p98'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton(); ?></td>
    </tr>
  </table>
  <?php include '../../common/view/action.html.php';?>
</form>
<?php include '../../common/view/footer.html.php';?>
