<div class='block linkbox1' id='projectbox'>
<?php if(count($projectStats) == 0):?>
<table class='table-1 a-center' height='138px'>
  <caption><i class="icon icon-th-large"></i>&nbsp;<?php echo $lang->my->home->projects;?></caption>
  <tr>
    <td valign='middle'>
      <table class='a-left bd-none' align='center'>
        <tr>
          <td><?php echo html::a($this->createLink('project', 'create'), $lang->my->home->createProject);?></td>
          <td><?php echo $lang->my->home->help; ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php else:?>
  <table class='table-1 fixed colored'>
    <tr class='colhead'>
      <th colspan="4"><div class='f-left'><i class="icon icon-th-large"></i>&nbsp; <?php echo $lang->project->name;?></div></th>
      <th colspan="1"><?php echo $lang->project->end;?></th>
      <!--<th><?php echo $lang->statusAB;?></th>-->
      <th colspan="1"><?php echo $lang->project->totalEstimate;?></th>
      <th colspan="1"><?php echo $lang->project->totalConsumed;?></th>
      <th colspan="1"><?php echo $lang->project->totalLeft;?></th>
      <th colspan="1"><?php echo $lang->project->progess;?></th>
      <th colspan="1"><?php echo $lang->project->burn;?></th>
    </tr>
    <?php foreach($projectStats as $project):?>
    <tr class='a-center'>
      <td colspan="4"><?php echo html::a($this->createLink('project', 'task', 'project=' . $project->id), $project->name, '', "title=$project->name");?></td>
      <td colspan="1"><?php echo $project->end;?></td>
      <!--<td><?php echo $lang->project->statusList[$project->status];?></td>-->
      <td colspan="1"><?php echo $project->hours->totalEstimate;?></td>
      <td colspan="1"><?php echo $project->hours->totalConsumed;?></td>
      <td colspan="1"><?php echo $project->hours->totalLeft;?></td>
      <td colspan="1">
        <?php if($project->hours->progress):?><img src='<?php echo $defaultTheme;?>images/main/green.png' width=<?php echo $project->hours->progress;?> height='13' text-align: /><?php endif;?>
        <small><?php echo $project->hours->progress;?>%</small>
      </td>
      <td colspan="1" values='<?php echo join(',', $project->burns);?>'></td>
   </tr>
   <?php endforeach;?>
  </table>
<?php endif;?>
</div>
