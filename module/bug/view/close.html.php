<?php
/**
 * The close file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: close.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<br />
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">关闭bug</span>
</div>
<form method='post' target='hiddenwin'>
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
      <td class='rowhead'><?php echo $lang->comment;?></td>
      <td><?php echo html::textarea('comment', '', "rows='10' class='w-p85'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton() . html::linkButton($lang->goback, $this->session->bugList);?></td>
    </tr>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
