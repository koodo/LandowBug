<?php
/**
 * The close view file of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     story
 * @version     $Id: close.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<form method='post' target='hiddenwin'>
  <table class='table-1'>
    <caption><?php echo $story->title;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->story->closedReason;?></th>
      <td><?php echo html::select('closedReason', $lang->story->reasonList, '', 'class=select-3 onchange="setStory(this.value)"');?></td>
    </tr>
    <tr id='duplicateStoryBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->story->duplicateStory;?></th>
      <td><?php echo html::input('duplicateStory', '', 'class=text-3');?></td>
    </tr>
    <tr id='childStoriesBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->story->childStories;?></th>
      <td><?php echo html::input('childStories', '', 'class=text-3');?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->comment;?></th>
      <td><?php echo html::textarea('comment', '', "rows='8' class='w-p98'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'>
      <?php echo html::submitButton();?>
      <?php echo html::linkButton($lang->goback, $app->session->storyList ? $app->session->storyList : inlink('view', "storyID=$story->id"));?>
      </td>
    </tr>
  </table>
  <?php include '../../common/view/action.html.php';?>
</form>
<?php include '../../common/view/footer.html.php';?>
