<?php
/**
 * The edit view of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     task
 * @version     $Id: edit.html.php 4897 2013-06-26 01:13:16Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php js::set('oldStoryID', $task->story); ?>
<?php js::set('confirmChangeProject', $lang->task->confirmChangeProject); ?>
<?php js::set('changeProjectConfirmed', false); ?>
<form method='post' enctype='multipart/form-data' target='hiddenwin' id='dataform'>
<div id='titlebar'>
  <div id='main'>TASK #<?php echo $task->id . $lang->colon . html::input('name', $task->name, 'class="text-1"');?></div>
  <div><?php echo html::submitButton();?></div>
</div>

<table class='cont-rt5'>
  <tr valign='top'>
    <td>
      <table class='table-1 bd-none'>
        <tr class='bd-none'><td class='bd-none'>
          <fieldset>
            <legend><?php echo $lang->task->desc;?></legend>
            <?php echo html::textarea('desc', $task->desc, "rows='8' class='area-1'");?>
          </fieldset>
          <fieldset>
            <legend><?php echo $lang->comment;?></legend>
            <?php echo html::textarea('comment', '',  "rows='5' class='area-1'");?>
          </fieldset>
          <fieldset>
            <legend><?php echo $lang->files;?></legend>
            <?php echo $this->fetch('file', 'buildform');?>
          </fieldset>
        </td></tr>
      </table>
      <div class='a-center'><?php echo html::submitButton() . html::linkButton($lang->goback, $this->inlink('view', "taskID=$task->id")) .html::hidden('consumed', $task->consumed);?></div>
      <?php include '../../common/view/action.html.php';?>
    </td>
    <td class='divider'></td>
    <td class='side'>
      <fieldset>
        <legend><?php echo $lang->task->legendBasic;?></legend>
        <table class='table-1'> 
          <tr>
            <th class='rowhead w-p20'><?php echo $lang->task->project;?></th>
            <td><?php echo html::select('project', $projects, $task->project, 'class="select-1" onchange="loadAll(this.value)"');?></td>
          </tr>  
          <tr>
            <th class='rowhead w-p20'><?php echo $lang->task->module;?></th>
            <td><span id="moduleIdBox"><?php echo html::select('module', $modules, $task->module, 'class="select-1" onchange="loadModuleRelated()"');?></span></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->story;?></th>
            <td><span id="storyIdBox"><?php echo html::select('story', $stories, $task->story, 'class=select-1');?></span></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->assignedTo;?></th>
            <td><span id="assignedToIdBox"><?php echo html::select('assignedTo', $members, $task->assignedTo, 'class=select-1');?></span></td> 
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->type;?></th>
            <td><?php echo html::select('type', $lang->task->typeList, $task->type, 'class=select-1');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->status;?></th>
            <td><?php echo html::select('status', (array)$lang->task->statusList, $task->status, 'class=select-1');?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->pri;?></th>
            <td><?php echo html::select('pri', $lang->task->priList, $task->pri, 'class=select-1');?> 
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->task->mailto;?></td>
            <td><?php echo html::select('mailto[]', $users, str_replace(' ' , '', $task->mailto), 'class="text-1" multiple');?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->task->legendEffort;?></legend>
        <table class='table-1'> 
          <tr>
            <th class='rowhead'><?php echo $lang->task->estStarted;?></th>
            <td><?php echo html::input('estStarted', $task->estStarted, "class='text-1 date'");?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->realStarted;?></th>
            <td><?php echo html::input('realStarted', $task->realStarted, "class='text-1 date'");?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->deadline;?></th>
            <td><?php echo html::input('deadline', $task->deadline, "class='text-1 date'");?></td>
          </tr>  
          <tr>
            <th class='rowhead w-p20'><?php echo $lang->task->estimate;?></th>
            <td><?php echo html::input('estimate', $task->estimate, "class='text-1'");?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->consumed;?></th>
            <td><?php echo $task->consumed . ' '; common::printIcon('task', 'recordEstimate',   "taskID=$task->id", $task, 'list', '', '', 'iframe', true);?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->task->left;?></th>
            <td><?php echo html::input('left', $task->left, "class='text-1'");?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->task->legendLife;?></legend>
        <table class='table-1'> 
          <tr>
            <th class='rowhead w-p20'><?php echo $lang->task->openedBy;?></th>
            <td><?php echo $users[$task->openedBy];?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->finishedBy;?></th>
            <td><?php echo html::select('finishedBy', $members, $task->finishedBy, 'class=select-1');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->finishedDate;?></th>
            <td><?php echo html::input('finishedDate', $task->finishedDate, 'class="text-1"');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->canceledBy;?></th>
            <td><?php echo html::select('canceledBy', $users, $task->canceledBy, 'class="select-1"');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->canceledDate;?></th>
            <td><?php echo html::input('canceledDate', $task->canceledDate, 'class="text-1"');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->closedBy;?></th>
            <td><?php echo html::select('closedBy', $users, $task->closedBy, 'class="select-1"');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->closedReason;?></th>
            <td><?php echo html::select('closedReason', $lang->task->reasonList, $task->closedReason, 'class="select-1"');?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->task->closedDate;?></th>
            <td><?php echo html::input('closedDate', $task->closedDate, 'class="text-1"');?></td>
          </tr>
        </table>
      </fieldset>
    </td>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>
