<?php
/**
 * The manage child product view of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: managechilds.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='doc3'>
  <form method='post'>
    <table align='center' class='table-5 a-left'> 
      <caption><?php echo $lang->project->manageChilds;?></caption>
      <tr>
        <td>
        <?php
        echo html::checkbox("childs", $projects, $childProjects);
        ?>
        </td>
      </tr>
      <tr><td class='a-center'><input type='submit' name='submit' /></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
