<?php
/**
 * The importtask view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: importtask.html.php 4669 2013-04-23 02:28:08Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<form method='post' target='hiddenwin'>
  <table class='table-1 fixed tablesorter'>
    <caption>
    <?php
    $projects = array(0 => $lang->project->fromproject) + $projects;
    echo $lang->project->selectProject . ':';
    echo html::select('fromproject', $projects, $fromProject, "onchange='reload($projectID, this.value)'");
    ?>
    </caption>
    <thead>
    <tr class='colhead'>
      <th class='w-id'><?php echo $lang->idAB;?></th>
      <th class='w-150px {sorter:false}'><?php echo $lang->project->name ?></th>
      <th class='w-pri'><?php echo $lang->priAB;?></th>
      <th class='w-p30'><?php echo $lang->task->name;?></th>
      <th class='w-user'><?php echo $lang->task->assignedTo;?></th>
      <th class='w-hour'><?php echo $lang->task->leftAB;?></th>
      <th class='w-date'><?php echo $lang->task->deadlineAB;?></th>
      <th class='w-status'><?php echo $lang->statusAB;?></th>
      <th><?php echo $lang->task->story;?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($tasks2Imported as $task):?>
    <?php $class = $task->assignedTo == $app->user->account ? 'style=color:red' : '';?>
    <tr class='a-center'>

      <td>
      <input type='checkbox' name='tasks[]' value='<?php echo $task->id;?>' />
      <?php if(!common::printLink('task', 'view', "task=$task->id", sprintf('%03d', $task->id))) printf('%03d', $task->id);?>
      </td>

      <td><?php echo substr($projects[$task->project], 2);?></td>
      <td><span class='<?php echo 'pri' . $task->pri?>'><?php echo $task->pri;?></span></td>
      <td class='a-left nobr'><?php if(!common::printLink('task', 'view', "task=$task->id", $task->name)) echo $task->name;?></td>
      <td <?php echo $class;?>><?php echo $task->assignedToRealName;?></td>
      <td><?php echo $task->left;?></td>
      <td class=<?php if(isset($task->delay)) echo 'delayed';?>><?php if(substr($task->deadline, 0, 4) > 0) echo $task->deadline;?></td>
      <td class=<?php echo $task->status;?> ><?php echo $lang->task->statusList[$task->status];?></td>
      <td class='a-left nobr'>
        <?php 
        if($task->storyID)
        {
            if(common::hasPriv('story', 'view'))
            {
                echo html::a($this->createLink('story', 'view', "storyid=$task->storyID"), $task->storyTitle);
            }
            else
            {
                echo $task->storyTitle;
            }
        }
        ?>
      </td>
    </tr>
    <?php endforeach;?>
    </tbody>
  </table>
  <div><?php echo html::selectAll() . html::selectReverse() . html::submitButton($lang->project->importTask);?></div>
</form>
<?php include '../../common/view/footer.html.php';?>
