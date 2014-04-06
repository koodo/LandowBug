<?php
/**
 * The html template file of confirm method of upgrade module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: confirm.html.php 4129 2013-01-18 01:58:14Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<style>body{background:white}</style>
<div class='yui-d0' style='margin-top:50px'>
  <form method='post' action='<?php echo inlink('execute');?>'>
  <table align='center' class='table-6 f-14px'>
    <caption><?php echo $lang->upgrade->confirm;?></caption>
    <tr>
      <td class='a-center'><textarea rows='20' class='area-1'><?php echo $confirm;?></textarea></td>
    <tr>
      <td class='a-center'><?php echo html::submitButton($lang->upgrade->sureExecute) . html::hidden('fromVersion', $fromVersion);?></td>
    </tr>
  </table>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>
