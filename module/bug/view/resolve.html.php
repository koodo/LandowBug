<?php
/**
 * The resolve file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: resolve.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">解决bug</span>
</div>
<form method='post' target='hiddenwin'>
  <!--<input type="hidden" value="<?php echo $bug->openedBy;?>" name="assignedTo" />-->
  <input type="hidden" value="<?php echo helper::now();?>" name="resolvedDate" />
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
      <td class='rowhead'><?php echo $lang->bug->resolution;?></td>
      <td><?php unset($lang->bug->resolutionList['tostory']); echo html::select('resolution', $lang->bug->resolutionList, '', 'class=select-3 onchange=setDuplicate(this.value)');?></td>
    </tr>
    <tr id='duplicateBugBox' style='display:none'>
      <td class='rowhead'><?php echo $lang->bug->duplicateBug;?></td>
      <td><?php echo html::input('duplicateBug', '', 'class=text-3');?></td>
    </tr>
    <tr>
      <td class='rowhead'><?php echo $lang->bug->resolvedBuild;?></td>
      <td><?php echo html::select('resolvedBuild', $builds, $bug->openedBuild, 'class=select-3');?></td>
    </tr>
    <!--
    <tr>
      <td class='rowhead'><?php #echo $lang->bug->resolvedDate;?></td>
      <td><?php #echo html::input('resolvedDate', helper::now(), "class='select-3'");?></td>
    </tr>
    <tr>
      <td class='rowhead'><?php #echo $lang->bug->assignedTo;?></td>
      <td><?php #echo html::select('assignedTo', $users, $bug->openedBy, 'class=select-3');?></td>
    </tr>
    -->
    <tr>
      <td class='rowhead'><?php echo $lang->comment;?></td>
      <td><?php echo html::textarea('comment', '', "rows='10' class='w-p85'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton('提交') . html::linkButton($lang->goback, $this->session->bugList);?></td>
    </tr>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
