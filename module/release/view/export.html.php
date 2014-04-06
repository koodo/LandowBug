<?php
/**
 * The export stories or bugs to html view file of release module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<script>
function setDownloading()
{
    if($.browser.opera) return true;   // Opera don't support, omit it.

    $.cookie('downloading', 0);
    time = setInterval("closeWindow()", 300);
    return true;
}

function closeWindow()
{
    if($.cookie('downloading') == 1 || i >= 30)
    {
        parent.$.fn.colorbox.close();
        $.cookie('downloading', null);
        clearInterval(time);
    }
    i ++;
}
</script>
<br /><br />
<form method='post' target='hiddenwin' onsubmit='setDownloading();'>
  <table class='table-1'>
    <caption><?php echo $lang->export;?></caption>
    <tr>
      <td class='a-center'>
        <?php echo $lang->setFileName;?>
        <?php echo html::input('fileName', '', 'size=15') . ".html";?>
        <?php echo html::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.lite.html.php';?>
