<?php
/**
 * The erase view file of extension module of ZenTaoPMS.
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
      echo "<h3 class='a-center success'>{$title}</h3>";
      if($removeCommands)
      {
          echo "<p class='strong'>{$lang->extension->unremovedFiles}</p>";
          echo join($removeCommands, '<br />');
      }
      echo "<p class='a-center'>" . html::commonButton($lang->extension->viewAvailable, 'onclick=parent.location.href="' . inlink('browse', 'type=available') . '"') . '</p>';
      ?>
    </td>
  </tr>
</table>
</body>
</html>
