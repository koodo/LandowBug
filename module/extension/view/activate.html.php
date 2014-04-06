<?php
/**
 * The deactivate view file of extension module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     extension
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<table class='table-1'>
  <caption><?php echo $title;?></caption>
  <tr>
    <td valign='middle'>
     <?php
    if(isset($error) and $error)
    {
        echo $error;
    }
    else
    {
        echo "<h3 class='a-center success'>{$title}</h3>";
        echo "<p class='a-center'>" . html::commonButton($lang->extension->viewInstalled, 'onclick=parent.location.href="' . inlink('browse', 'type=installed') . '"') . '</p>';
    }
    ?>
    </td>
  </tr>
</table>
</body>
</html>
