<?php
/**
 * The complete file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     task
 * @version     $Id: complete.html.php 935 2010-07-06 07:49:24Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php 
include '../../common/view/header.html.php';
include '../../common/view/chosen.html.php';
js::set('holders', $lang->bug->placeholder);
js::set('page', 'assignedto');
?>
<br /><br />
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">bug指派</span>
</div>
<form method='post' target='hiddenwin'>
  <input type="hidden" name="mailto[]" value=""/>
  <table class='table-1'>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr>
    <tr>
        <td class="rowhead" style="vertical-align:top;">标题</td>
        <td style="word-wrap:break-word"><?php echo '#' . $bug->id . '&nbsp;' . $bug->title;?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->bug->assignedTo;?></th>
      <td><?php echo html::select('assignedTo', $users, $bug->assignedTo, "class='text-3'");?></td>
    </tr> 
    <!--
    <tr>
      <td class='rowhead'><?php echo $lang->bug->mailto;?></td>
      <td><?php echo html::select('mailto[]', $users, str_replace(' ', '', $bug->mailto), 'class="w-p98" multiple');?></td>
    </tr>
    -->
    <tr>
      <td class='rowhead'><?php echo $lang->comment;?></td>
      <td><?php echo html::textarea('comment', '', "rows='8' class='w-p85'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton() . html::linkButton($lang->goback, $this->server->http_referer);?></td>
    </tr>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
