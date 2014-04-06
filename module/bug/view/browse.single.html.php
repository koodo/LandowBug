
      <!-- copy 数据列表 ------------------------------------------------------------------------>
      <td>          
          <div class="ldBuglist">
              <div class="ldbTitle" style="">
                  <i class="icon-bug-s3"></i>
                  <span style="text-indent:0"><?php echo $lang->bug->$browseType;?></span>
                  <div class='f-right'>
                    <?php common::printIcon('bug', 'create', "productID=$productID&extra=moduleID=$moduleID");?>
                  </div>
              </div>
        <table class='table-1 fixed colored tablesorter datatable buglist' id='bugList'>
          <?php $vars = "productID=$productID&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
          <thead>
          <!-- 数据项 -->
          <tr class='colhead'>
              
            <th colspan="6" class="th-left-ind1">标题</th>
            
            <th colspan="1"><?php common::printOrderLink('severity', $orderBy, $vars, '优先级');?></th>
            
            <th colspan="1"><?php common::printOrderLink('status', $orderBy, $vars, '状态');?></th>
            
            <th colspan="1"><?php common::printOrderLink('module', $orderBy, $vars, '模块');?></th>
            
            <th colspan="1"><?php common::printOrderLink('openedBuild', $orderBy, $vars, '版本');?></th>

            <?php if($browseType != 'resolved') { ?>
            <!-- 处理人 -->
            <th colspan="1"><?php common::printOrderLink('assignedTo',       $orderBy, $vars, '处理人');?></th>
            <?php } else {?>
            <th colspan="1"><?php common::printOrderLink('resolvedBy',       $orderBy, $vars, '解决人');?></th>
            <?php }?>
            
            <?php if($browseType != 'resolved') { ?>
            <th colspan="1"><?php common::printOrderLink('openedDate',     $orderBy, $vars,'提交日期');?></th>
            <?php } else {?>
            <th colspan="1"><?php common::printOrderLink('resolvedDate',     $orderBy, $vars, '解决日期');?></th>
            <?php }?>
            
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
            <td class='a-left' colspan="6" title="<?php echo $bug->title;?>"><?php echo html::a($bugLink, common::bugTitleAtID($bug->title,$bug->id));?></td>

            <td colspan="1"><span class='<?php echo 'severity' . $bug->severity;?>'><?php echo common::bug_serverity($bug->severity);?></span></td>
            
            <!--优先级|P <td><span class='<?php echo 'pri' . $lang->bug->priList[$bug->pri];?>'><?php echo $lang->bug->priList[$bug->pri];?></span></td>-->

            <!-- 状态 -->
            <td colspan="1"><?php echo $lang->bug->statusList[$bug->status];?></td>

            <?php if($browseType == 'needconfirm'):?>
            <td class='a-left' colspan="1" title="<?php echo $bug->storyTitle?>"><?php echo html::a($this->createLink('story', 'view', "stoyID=$bug->story"), $bug->storyTitle, '_blank');?></td>
            <td><?php $lang->bug->confirmStoryChange = $lang->confirm; common::printIcon('bug', 'confirmStoryChange', "bugID=$bug->id", '', 'list', '', 'hiddenwin')?></td>
            <?php else:?>
            
            <!--<td><?php echo zget($users, $bug->openedBy, $bug->openedBy);?></td>-->

            <td colspan="1"><?php echo $bug->module->mname;?></td>
            
            <td colspan="1"><?php echo $builds[$bug->openedBuild];?></td>
            
            <?php if($browseType !== 'resolved') { ?>
            <!-- 被指派|处理人 -->
            <td colspan="1" <?php if($bug->assignedTo == $this->app->user->account) echo 'class="red"';?>><?php echo zget($users, $bug->assignedTo, $bug->assignedTo);?></td>
            <?php } else {?>
            <td colspan="1" <?php if($bug->resolvedBy == $this->app->user->account) echo 'class="red"';?>><?php echo zget($users, $bug->resolvedBy, $bug->resolvedBy)?></td>
            <?php }?>
            
            <?php if($bug->browseType == 'resolved') { ?>
            <!-- 解决日期 -->
            <td colspan="1"><?php echo common::tTimeFormat(strtotime($bug->resolvedDate));?></td>
            <?php } else {?>
            <!-- 创建日期 -->
            <td colspan="1"><?php echo common::tTimeFormat(strtotime($bug->openedDate));?></td>
            <?php }?>
            
            <!-- 解决人 -->
            <!--<td><?php #echo zget($users, $bug->resolvedBy, $bug->resolvedBy)?></td>-->
            
            <!-- 方案 -->
            <!--<td><?php #echo $lang->bug->resolutionList[$bug->resolution];?></td>-->

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
          <tfoot>
            <tr>
              <?php
              $columns = $this->cookie->windowWidth >= $this->config->wideSize ? 12 : 9;
              if($browseType == 'needconfirm') $columns = $this->cookie->windowWidth >= $this->config->wideSize ? 7 : 6; 
              ?>
              <td colspan='12'>
                <?php if(!empty($bugs)):?>
                <div class='f-left'>
                  <?php 
                  #echo "<div class='groupButton'>";
                  #echo html::selectAll() . html::selectReverse();
                  #echo "</div>";

                  $actionLink = $this->createLink('bug', 'batchEdit', "productID=$productID");
                  $misc       = common::hasPriv('bug', 'batchEdit') ? "onclick=setFormAction('$actionLink')" : "disabled='disabled'";
                  #echo "<div class='groupButton dropButton'>";
                  #echo html::commonButton($lang->edit, $misc);
                  #echo "<button id='moreAction' type='button' onclick=\"toggleSubMenu(this.id, 'top', 0)\"><span class='caret'></span></button>";
                  #echo "</div>";
                 ?>
                </div>
                <?php endif?>
                <div class='f-right'><?php $pager->show();?></div>
              </td>
            </tr>
          </tfoot>
        </table>
          </div>
      </td>
      <!-- copy 数据列表 ------------------------------------------------------------------------>