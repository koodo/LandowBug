<?php
/**
 * The link story view of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: linkstory.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='querybox'></div>
<form method='post'>
  <table align='center' class='table-1 tablesorter a-center fixed'> 
    <thead>
    <tr class='colhead'>
      <th class='w-id'><?php echo $lang->idAB;?></th>
      <th class='w-pri'><?php echo $lang->priAB;?></th>
      <th><?php echo $lang->story->product;?></th>
      <th><?php echo $lang->story->title;?></th>
      <th><?php echo $lang->story->plan;?></th>
      <th class='w-user'><?php echo $lang->openedByAB;?></th>
      <th class='w-hour'><?php echo $lang->story->estimateAB;?></th>
    </tr>
    </thead>
    <tbody>
    <?php $storyCount = 0;?>
    <?php foreach($allStories as $story):?>
    <?php if(isset($prjStories[$story->id])) continue;?>
    <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id");?>
    <tr>
      <td class='a-left'>
        <input type='checkbox' name='stories[]'  value='<?php echo $story->id;?>'/> 
        <input type='hidden'   name='products[]' value='<?php echo $story->product;?>' />
        <?php echo html::a($storyLink, $story->id);?>
      </td>
      <td><span class='<?php echo 'pri' . $lang->story->priList[$story->pri]?>'><?php echo $lang->story->priList[$story->pri];?></span></td>
      <td><?php echo html::a($this->createLink('product', 'browse', "productID=$story->product"), $products[$story->product], '_blank');?></td>
      <td class='a-left nobr'><?php echo html::a($storyLink, $story->title);?></td>
      <td><?php echo $story->planTitle;?></td>
      <td><?php echo $users[$story->openedBy];?></td>
      <td><?php echo $story->estimate;?></td>
    </tr>
    <?php $storyCount ++;?>
    <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='7' class='a-left'>
          <?php 
          if($storyCount)  echo html::selectAll() . html::selectReverse() . html::submitButton();
          if(!$storyCount) echo $lang->project->whyNoStories;
          ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
<script type='text/javascript'>$(function(){ajaxGetSearchForm()});</script>
<?php include '../../common/view/footer.html.php';?>
