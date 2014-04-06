</tr><tr><td style="height:20px;"></td></tr><tr>
    <!-- copy 数据列表 ------------------------------------------------------------------------>
    <td>          
        <div class="ldBuglist">
            <div class="ldbTitle" style="">
                <i class="icon-bug-s5"></i>
                <span style="text-indent:2px">已解决的Bug</span>
            </div>
            <table class='table-1 fixed colored tablesorter datatable buglist' id='bugList'>
                <?php $vars = "productID=$productID&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"; ?>
                <thead>
                    <!-- 数据项 -->
                    <tr class='colhead'>
                        <th colspan="6" class="th-left-ind1">标题</th>

                        <th colspan="1"><?php common::printOrderLink('severity', $orderBy, $vars, '优先级'); ?></th>

                        <th colspan="1"><?php common::printOrderLink('status', $orderBy, $vars, '状态');?></th>

                        <th colspan="1"><?php common::printOrderLink('resolvedBy', $orderBy, $vars, '解决人');?></th>

                        <th colspan="1"><?php common::printOrderLink('module', $orderBy, $vars, '模块');?></th>

                        <th colspan="1"><?php common::printOrderLink('openedBuild', $orderBy, $vars, '版本');?></th>

                        <th colspan="1"><?php common::printOrderLink('resolvedDate',     $orderBy, $vars, '解决日期');?></th>
                    </tr>
                    <!-- 数据项 -->
                </thead>
                <tbody>
                    <?php foreach ($bugs_fixed as $bug): ?>
                        <?php $bugLink = inlink('view', "bugID=$bug->id"); ?>
                        <tr class='a-center'>
                            <!-- 标题 -->
                            <?php $class = 'confirm' . $bug->confirmed; ?>
                            <td class='a-left' colspan="6" title="<?php echo $bug->title; ?>"><?php echo html::a($bugLink, common::bugTitleAtID($bug->title, $bug->id)); ?></td>

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
                                
                                <!-- 解决人 -->
                                <td><?php echo zget($users, $bug->resolvedBy, $bug->resolvedBy);?></td>
                                
                                <!-- 模块-->
                                <td colspan="1"><?php echo $bug->module->mname; ?></td>

                                <td colspan="1"><?php echo $builds[$bug->openedBuild]; ?></td>

                                <!-- 解决日期-->
                                <td colspan="1"><?php echo common::tTimeFormat(strtotime($bug->resolvedDate)); ?></td>
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
                            <div class='f-right'><?php if (isset($pager_fixed)) $pager_fixed->show(); ?></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </td>
    <!-- copy 数据列表 ------------------------------------------------------------------------>