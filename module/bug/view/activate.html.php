<?php
/**
 * The activate file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: activate.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<br />
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">挂起bug</span>
</div>
<form method='post' enctype='multipart/form-data' target='hiddenwin'>
    <table class='table-1'>
        <tr>
            <th class='rowhead'> </th>
            <td> </td>
        </tr> 
        <tr>
            <td class='rowhead'><?php echo $lang->bug->assignedTo; ?></td>
            <td><?php echo html::select('assignedTo', $members, $bug->assignedTo, 'class=select-3'); ?></td>
        </tr>
        <tr>
            <td class='rowhead'><?php echo $lang->bug->openedBuild; ?></td>
            <td><?php echo html::select('openedBuild[]', $builds, $bug->openedBuild, 'class=select-3'); ?></td>
        </tr>
        <tr>
            <td class='rowhead'><?php echo $lang->comment; ?></td>
            <td><?php echo html::textarea('comment', '', "rows='8' class='w-p90'"); ?></td>
        </tr>
        <tr>
            <td colspan='2' class='a-center'><?php echo html::submitButton() . html::linkButton($lang->goback, $this->session->bugList); ?></td>
        </tr>
        <tr>
            <th class='rowhead'> </th>
            <td> </td>
        </tr> 
    </table>
</form>
<?php include '../../common/view/footer.html.php'; ?>
