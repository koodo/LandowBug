<?php
/**
 * The html template file of step4 method of install module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	 ZenTaoPMS
 * @version	 $Id: step4.html.php 4129 2013-01-18 01:58:14Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<?php if(isset($error)):?>
<table class='table-6' align='center'>
<caption><?php echo $lang->install->error;?></caption>
  <tr><td><?php echo $error;?></td></tr>
  <tr><td><?php echo html::commonButton($lang->install->pre, "onclick='javascript:history.back(-1)'");?></td></tr>
</table>
<?php elseif(isset($success)):?>
<table class='table-6' align='center'>
  <caption><?php echo $lang->install->success;?></caption>
  <tr><td><?php echo $lang->install->afterSuccess;?></td></tr>
  <tr><td><?php echo html::commonButton($lang->install->pre, "onclick='javascript:history.back(-1)'");?></td></tr>
</table>
<?php else:?>
<form method='post' target='hiddenwin'>
<table class='table-6' align='center'>
  <caption><?php echo $lang->install->getPriv;?></caption>
  <tr>
    <th class='rowhead'><?php echo $lang->install->company;?></th>
    <td><?php echo html::input('company');?></td>
  </tr>
  <tr>
    <th class='rowhead'><?php echo $lang->install->account;?></th>
    <td><?php echo html::input('account');?></td>
  </tr>
  <tr>
    <th class='rowhead'><?php echo $lang->install->password;?></th>
    <td><?php echo html::input('password') .  html::checkBox('importDemoData', $lang->install->importDemoData);?></td>
  </tr>
  <tr class='a-center'>
    <td colspan='2'><?php echo html::submitButton();?></td>
  </tr>
</table>
</form>
<?php endif;?>
<?php include '../../common/view/footer.lite.html.php';?>
