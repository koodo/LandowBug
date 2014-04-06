<?php
/**
 * The batch create view of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<form method='post' enctype='multipart/form-data' target='hiddenwin'>
  <table align='center' class='table-1 fixed'> 
    <caption><?php echo $lang->story->product . $lang->colon . $lang->story->batchCreate;?></caption>
    <tr>
      <th class='w-20px'><?php echo $lang->idAB;?></th> 
      <th class='w-200px'><?php echo $lang->story->module;?></th>
      <th class='w-180px'><?php echo $lang->story->plan;?></th>
      <th class='red'><?php echo $lang->story->title;?></th>
      <th class='w-200px'><?php echo $lang->story->spec;?></th>
      <th class='w-50px'><?php echo $lang->story->pri;?></th>
      <th class='w-60px'><?php echo $lang->story->estimate;?></th>
      <th class='w-50px'><?php echo $lang->story->review;?></th>
    </tr>
    <?php for($i = 0; $i < $config->story->batchCreate; $i++):?>
    <?php $moduleID = $i == 0 ? $moduleID : 'same';?>
    <?php $planID   = $i == 0 ? '' : 'same';?>
    <tr class='a-center'>
      <td><?php echo $i+1;?></td>
      <td><?php echo html::select("module[$i]", $moduleOptionMenu, $moduleID, 'class=select-1');?></td>
      <td><?php echo html::select("plan[$i]", $plans, $planID, 'class=select-1');?></td>
      <td><?php echo html::input("title[$i]", $storyTitle, "class='text-1'");?></td>
      <td><?php echo html::textarea("spec[$i]", $spec, "rows='1' class='text-1'");?></td>
      <td><?php echo html::select("pri[$i]", (array)$lang->story->priList, $pri, 'class=select-1');?></td>
      <td><?php echo html::input("estimate[$i]", $estimate, "class='text-1'");?></td>
      <td><?php echo html::select("needReview[$i]", $lang->story->reviewList, 0, "class='text-1'");?></td>
    </tr>  
    <?php endfor;?>
    <tr><td colspan='8' class='a-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
