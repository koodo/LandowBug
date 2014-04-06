
<!-- copy 数据列表 ------------------------------------------------------------------------>
<td>          
    <div class="ldBuglist">
        <div class="ldbTitle" style="">
            <i class="icon-bug-s4"></i>
            <span style="text-indent:2px">未解决的Bug</span>              
            <div class='f-right'>
                <?php common::printIcon('bug', 'create', "productID=$productID&extra=moduleID=$moduleID"); ?>
            </div>
        </div>
        <table class='table-1 fixed colored tablesorter datatable buglist' id='bugList'>
            <?php $vars = "productID=$productID&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
            <thead>
                <!-- 数据项 -->
                <tr class='colhead'>
                    <th colspan="6" class="th-left-ind1">标题</th>

                    <th colspan="1"><?php common::printOrderLink('severity', $orderBy, $vars, '优先级'); ?></th>

                    <th colspan="1"><?php common::printOrderLink('status', $orderBy, $vars, '状态');?></th>

                    <th colspan="1"><?php common::printOrderLink('openedBy', $orderBy, $vars, '分配人');?></th>

                    <th colspan="1"><?php common::printOrderLink('module', $orderBy, $vars, '模块');?></th>

                    <th colspan="1"><?php common::printOrderLink('openedBuild', $orderBy, $vars, '版本');?></th>

                    <th colspan="1"><?php common::printOrderLink('openedDate',$orderBy, $vars,'提交日期');?></th>
                </tr>
                <!-- 数据项 -->
            </thead>
            <tbody>
                <?php foreach ($bugs_unfix as $bug): ?>
                    <?php $bugLink = inlink('view', "bugID=$bug->id"); ?>
                    <tr class='a-center'>

                        <!-- bug ID -->
                        <!--<td class='<?php echo $bug->status; ?>' style="font-weight:bold">
                          <input type='checkbox' name='bugIDList[]'  value='<?php echo $bug->id; ?>'/> 
                        <?php #echo html::a($bugLink, sprintf('%03d', $bug->id));?>
                        </td>-->

                        <!-- 标题 -->
                        <?php $class = 'confirm' . $bug->confirmed; ?>
                        <td colspan="6" title="<?php echo $bug->title; ?>"><?php echo html::a($bugLink, common::bugTitleAtID($bug->title, $bug->id)); ?></td>

                        <!-- 严重 -->
                        <td colspan="1"><span class='<?php echo 'severity' . $bug->severity; ?>'><?php echo common::bug_serverity($bug->severity); ?></span></td>

                        <!-- 状态 -->
                        <td colspan="1"><?php echo $lang->bug->statusList[$bug->status]; ?></td>

                        <?php if ($browseType == 'needconfirm'): ?>
                            <td class='a-left' colspan="1" title="<?php echo $bug->storyTitle ?>"><?php echo html::a($this->createLink('story', 'view', "stoyID=$bug->story"), $bug->storyTitle, '_blank'); ?></td>
                            <td>
                                <?php
                                $lang->bug->confirmStoryChange = $lang->confirm;
                                common::printIcon('bug', 'confirmStoryChange', "bugID=$bug->id", '', 'list', '', 'hiddenwin')
                                ?></td><?php else: ?>

                            <!-- 分配人 -->
                            <td colspan="1"><?php echo zget($users, $bug->openedBy, $bug->openedBy); ?></td>
                            <!--<td colspan="1"<?php #if($bug->assignedTo == $this->app->user->account) echo 'class="red"';     ?>><?php echo zget($users, $bug->assignedTo, $bug->assignedTo); ?></td>-->

                            <!-- 解决人 -->
                            <!--<td><?php #echo zget($users, $bug->resolvedBy, $bug->resolvedBy)     ?></td>-->

                            <!-- 方案 -->
                            <!--<td><?php #echo $lang->bug->resolutionList[$bug->resolution];     ?></td>-->

                            <!-- 模块-->
                            <td colspan="1"><?php echo $bug->module->mname; ?></td>

                            <td colspan="1"><?php echo $builds[$bug->openedBuild]; ?></td>

                            <!-- 创建日期-->
                            <td colspan="1"><?php echo common::tTimeFormat(strtotime($bug->openedDate)); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <?php
                    $columns = $this->cookie->windowWidth >= $this->config->wideSize ? 12 : 9;
                    if ($browseType == 'needconfirm')
                        $columns = $this->cookie->windowWidth >= $this->config->wideSize ? 7 : 6;
                    ?>
                    <td colspan='12'>
                        <div class='f-right'><?php if (isset($pager_unfix)) $pager_unfix->show(); ?></div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</td>
<!-- copy 数据列表 ------------------------------------------------------------------------>