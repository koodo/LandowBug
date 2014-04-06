<?php include $this->app->getModuleRoot() . 'common/view/dropmenu.html.php';?>
<div id='featurebar'>
  <div class='f-left'>
  <?php
    // 所有任务
    echo "<span id='allTab'>"; common::printLink('project', 'task', "project=$projectID&type=all", $lang->project->allTasks); echo '</span>' ;
    
    echo $lang->bug->spliter;
    
    // 燃尽图
    if($project->type == 'sprint') print "<span id='burnTab'>" and common::printLink('project', 'burn', "project=$projectID", $lang->project->burn); print '</span>' ;
        
    echo $lang->bug->spliter;
    
    echo "<span id='assignedtomeTab'>"; common::printLink('project', 'task', "project=$projectID&type=assignedtome", $lang->project->assignedToMe); echo  '</span>' ;
    
    echo "<span id='statusTab'>";
    echo html::select('status', $lang->project->statusSelects, isset($status) ? $status : '', "onchange='switchStatus({$projectID}, this.value)'");
    echo "</span>";
    
    
    echo "<span id='groupTab'>";
    echo html::select('groupBy', $lang->project->groups, isset($groupBy) ? $groupBy : '', "onchange='switchGroup($projectID, this.value)'");
    echo "</span>";

    #if($this->methodName == 'task') echo "<span id='bysearchTab'><a href='#' class='link-icon'><i class='icon-search icon icon-large'></i>&nbsp;{$lang->project->byQuery}</a></span> ";
    ?>
  </div>
  <div class='f-right'>
    <?php 
    if(!isset($browseType)) $browseType = '';
    if(!isset($orderBy))    $orderBy = '';
    #common::printIcon('task', 'report', "project=$projectID&browseType=$browseType");

    #echo '<span class="link-button dropButton">';
    #echo html::a("#", "<i class='icon-upload-alt'></i> " . $lang->export, '', "id='exportAction' onclick=toggleSubMenu(this.id,'bottom',0) title='{$lang->export}'");
    #echo '</span>';

    #echo '<span class="link-button dropButton">';
    #echo html::a("#", "<i class='icon-download-alt'></i> " . $lang->import, '', "id='importAction' onclick=toggleSubMenu(this.id,'bottom',0) title='{$lang->import}'");
    #echo '</span>';

    // 批量添加
    common::printIcon('task', 'batchCreate', "projectID=$projectID");
    
    // 建任务
    common::printIcon('task', 'create', "project=$projectID"); 
    ?>
  </div>
</div>

<!--<div id='exportActionMenu' class='listMenu hidden'>
  <ul>
  <?php 
  $misc = common::hasPriv('task', 'export') ? "class='export'" : "class=disabled";
  $link = common::hasPriv('task', 'export') ?  $this->createLink('task', 'export', "project=$projectID&orderBy=$orderBy") : '#';
  echo "<li>" . html::a($link, $lang->task->export, '', $misc) . "</li>";
  ?>
  </ul>
</div>-->

<!--<div id='importActionMenu' class='listMenu hidden'>
  <ul>
  <?php 
  $misc = common::hasPriv('project', 'importTask') ? '' : "class=disabled";
  $link = common::hasPriv('project', 'importTask') ?  $this->createLink('project', 'importTask', "project=$project->id") : '#';
  echo "<li>" . html::a($link, $lang->project->importTask, '', $misc) . "</li>";

  $misc = common::hasPriv('project', 'importBug') ? '' : "class=disabled";
  $link = common::hasPriv('project', 'importBug') ?  $this->createLink('project', 'importBug', "project=$project->id") : '#';
  echo "<li>" . html::a($link, $lang->project->importBug, '', $misc) . "</li>";
  ?>
  </ul>
</div>-->

<?php foreach(glob(dirname(dirname(__FILE__)) . "/ext/view/featurebar.*.html.hook.php") as $fileName) include_once $fileName; ?>
