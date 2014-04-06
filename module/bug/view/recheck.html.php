<?php
/**
 * The confirm file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: resolve.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/kindeditor.html.php';
include '../../common/view/chosen.html.php';
js::set('holders', $lang->bug->placeholder);
js::set('page', 'suspend');
?>
<form method='post' style='margin-top:80px;'>
  <table class='table-1'>
    <caption><?php echo $bug->title;?></caption>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr>
    <tr>
      <td class='rowhead'>不通过原因</td>
      <td><?php echo html::textarea('comment', '', "rows='8' style='width:85%'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton('提交') . html::linkButton($lang->goback, $this->server->http_referer);?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
