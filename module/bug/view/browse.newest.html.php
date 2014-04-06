
      <!-- copy 数据列表 ------------------------------------------------------------------------>
      <td>          
          <div class="ldBuglist">
              <div class="ldbTitle" style="">
                  <i class="icon-bug-s2"></i>
                  <span style="text-indent:10px">最新的BUG</span>
                  <a class="btn-more" href="<?php echo helper::createLink('bug', 'browse', "productid=$productID&browseType=newest&param=0"); ?>">更多...</a>
              </div>
        <table class='table-1 fixed colored tablesorter datatable buglist' id='bugList'>
          <?php $vars = "productID=$productID&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
          <thead>
          <!-- 数据项 -->
          <tr class='colhead'>
            <!-- 标题 -->
            <th colspan="6" class="th-left-ind1">标题</th>
            <!--<th colspan="6" class="th-left-ind1"><?php #common::printOrderLink('title', $orderBy, $vars, '标题');?></th>-->
            <!--<th class='w-id'><?php #common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>-->
            
            <!-- 优先级 -->
            <!--<th colspan="2"><?php #common::printOrderLink('severity',    $orderBy, $vars, '优先级');?></th>-->
            <th colspan="1">优先级</th>
            <!--<th class='w-pri'><?php common::printOrderLink('pri', $orderBy, $vars, $lang->priAB);?></th>-->

            <?php if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <!--<th class='w-80px'><?php common::printOrderLink('status', $orderBy, $vars, $lang->bug->statusAB);?></th>-->
            <?php endif;?>
            <!-- 
            <?php if($browseType == 'needconfirm'):?>
            <th class='w-200px'><?php common::printOrderLink('story', $orderBy, $vars, $lang->bug->story);?></th>
            <th class='w-50px'><?php echo $lang->actions;?></th>
            <?php else:?>
            <th class='w-user'><?php common::printOrderLink('openedBy', $orderBy, $vars, $lang->openedByAB);?></th>

            <?php if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <th class='w-date'><?php common::printOrderLink('openedDate', $orderBy, $vars, $lang->bug->openedDateAB);?></th>
            <?php endif;?>
            -->
            
            <th colspan="1">模块</th>
            
            <th colspan="1">版本</th>
            
            <!-- 分配人 -->
            <!--<th colspan="2" ><?php common::printOrderLink('assignedTo',       $orderBy, $vars, '分配人');?></th>-->
            <th colspan="1">分配人</th>
            
            <!--
            <th class='w-user'><?php common::printOrderLink('resolvedBy',       $orderBy, $vars, $lang->bug->resolvedByAB);?></th>
            <th class='w-resolution'><?php common::printOrderLink('resolution', $orderBy, $vars, $lang->bug->resolutionAB);?></th>
            <?php if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <th class='w-date'><?php common::printOrderLink('resolvedDate',     $orderBy, $vars, $lang->bug->resolvedDateAB);?></th>
            <?php endif;?>

            <th class='w-140px {sorter:false}'><?php echo $lang->actions;?></th>-->
            <?php endif;?>
          </tr>
          <!-- 数据项 -->
          </thead>
          <tbody>
          <?php foreach($bugs as $bug):?>
          <?php $bugLink = inlink('view', "bugID=$bug->id");?>
          <tr class='a-center'>
             
            <!-- bug ID -->
            <!--<td class='<?php echo $bug->status;?>' style="font-weight:bold">
              <input type='checkbox' name='bugIDList[]'  value='<?php echo $bug->id;?>'/> 
              <?php #echo html::a($bugLink, sprintf('%03d', $bug->id));?>
            </td>-->
            
            <!-- 标题 -->
            <?php $class = 'confirm' . $bug->confirmed;?>
            <td class='a-left' colspan="6" title="<?php echo $bug->title;?>"><?php echo html::a($bugLink, common::bugTitleAtID($bug->title,$bug->id));?></td>

            <td colspan="1"><span class='<?php echo 'severity' . $bug->severity;?>'><?php echo common::bug_serverity($bug->severity);?></span></td>
            
            <!--优先级|P <td><span class='<?php echo 'pri' . $lang->bug->priList[$bug->pri];?>'><?php echo $lang->bug->priList[$bug->pri];?></span></td>-->

            <!--<?php if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <td><?php echo $lang->bug->statusList[$bug->status];?></td>
            <?php endif;?>-->

            <?php if($browseType == 'needconfirm'):?>
            <td class='a-left' colspan="2" title="<?php echo $bug->storyTitle?>"><?php echo html::a($this->createLink('story', 'view', "stoyID=$bug->story"), $bug->storyTitle, '_blank');?></td>
            <td><?php $lang->bug->confirmStoryChange = $lang->confirm; common::printIcon('bug', 'confirmStoryChange', "bugID=$bug->id", '', 'list', '', 'hiddenwin')?></td>
            <?php else:?>
            
            <td colspan="1"><?php echo $bug->module->mname;?></td>
            
            <td colspan="1"><?php echo $builds[$bug->openedBuild];?></td>
            
            <!-- 分配人 -->
            <td colspan="1"><?php echo zget($users, $bug->openedBy, $bug->openedBy);?></td>

            <!-- 创建日期 -->
            <!--<?php if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <td><?php echo substr($bug->openedDate, 5, 11)?></td>
            <?php endif;?>-->

            <!-- 被指派|处理人 -->
            <!--<td colspan="2" class="td-dealer" <?php if($bug->assignedTo == $this->app->user->account) echo 'class="red"';?>><?php echo zget($users, $bug->assignedTo, $bug->assignedTo);?></td>-->
            
            <!-- 解决人 -->
            <!--<td><?php #echo zget($users, $bug->resolvedBy, $bug->resolvedBy)?></td>-->
            
            <!-- 方案 -->
            <!--<td><?php #echo $lang->bug->resolutionList[$bug->resolution];?></td>-->

            <!-- 解决日期 -->
            <?php #if($this->cookie->windowWidth >= $this->config->wideSize):?>
            <!--<td><?php #echo substr($bug->resolvedDate, 5, 11)?></td>-->
            <?php #endif;?>

            <!--<td class='a-right'>
              <?php/*
              $params = "bugID=$bug->id";
              common::printIcon('bug', 'confirmBug', $params, $bug, 'list', '', '', 'iframe', true);
              common::printIcon('bug', 'assignTo',   $params, '',   'list', '', '', 'iframe', true);
              common::printIcon('bug', 'resolve',    $params, $bug, 'list', '', '', 'iframe', true);
              common::printIcon('bug', 'close',      $params, $bug, 'list', '', '', 'iframe', true);
              common::printIcon('bug', 'edit',       $params, $bug, 'list');
              common::printIcon('bug', 'create',     "product=$bug->product&extra=bugID=$bug->id", $bug, 'list', 'copy');
              */?>
            </td>-->
            <?php endif;?>
          </tr>
          <?php endforeach;?>
          </tbody>
        </table>
          </div>
      </td>
      <!-- copy 数据列表 ------------------------------------------------------------------------>