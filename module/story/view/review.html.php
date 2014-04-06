<?php
/**
 * The view file of review method of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     story
 * @version     $Id: review.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<script language='Javascript'>
var assignedTo = '<?php $story->lastEditedBy ? print($story->lastEditedBy) : print($story->openedBy);?>';
</script>
<form method='post' target='hiddenwin'>
  <table class='table-1'>
    <caption><?php echo $story->title;?></caption>
    <tr>
      <th class='w-100px rowhead'><?php echo $lang->story->reviewedDate;?></th>
      <td><?php echo html::input('reviewedDate', helper::today(), 'class=text-3');?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->reviewResult;?></th>
      <td><?php echo html::select('result', $lang->story->reviewResultList, '', 'class=select-3 onchange="switchShow(this.value)"');?></td>
    </tr>
    <tr id='rejectedReasonBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->story->rejectedReason;?></th>
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
    <?php if($story->status == 'changed' or ($story->status == 'draft' and $story->version > 1)):?>
    <tr id='preVersionBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->story->preVersion;?></th>
      <td><?php echo html::radio('preVersion', array_combine(range($story->version - 1, 1), range($story->version - 1, 1)), $story->version - 1);?></td>
    </tr>
    <?php endif;?>
    <tr>
      <th class='rowhead'><?php echo $lang->story->assignedTo;?></th>
      <td><?php echo html::select('assignedTo', $users, $story->lastEditedBy ? $story->lastEditedBy : $story->openedBy, 'class=select-3');?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->reviewedBy;?></th>
      <td><?php echo html::select('reviewedBy[]', $users, $app->user->account, "class='text-1' multiple data-placeholder='{$lang->story->chosen->reviewedBy}'");?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->comment;?></th>
      <td><?php echo html::textarea('comment', '', "rows='8' class='area-1'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'>
      <?php echo html::submitButton();?>
      <?php echo html::linkButton($lang->goback, $app->session->storyList ? $app->session->storyList : inlink('view', "storyID=$story->id"));?>
      </td>
    </tr>
  </table>
</form>
<?php include './affected.html.php';?>
<?php include '../../common/view/action.html.php';?>
<?php include '../../common/view/footer.html.php';?>
