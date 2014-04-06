<?php
/**
 * The copy view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: copy.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<form method='post' target='hiddenwin'>
  <table align='center' class='table-4'> 
    <caption><?php echo $lang->group->copy;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->group->name;?></th>
      <td><?php echo html::input('name', $group->name, "class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->group->desc;?></th>
      <td><?php echo html::textarea('desc', $group->desc, "rows='5' class='area-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->group->option;?></th>
      <td><?php echo html::checkbox('options', $lang->group->copyOptions);?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
