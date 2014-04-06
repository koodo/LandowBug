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
            <td><?php echo zget($users, $bug->resolvedBy, $bug->resolvedBy); ?></td>

            <!-- 模块-->
            <td colspan="1"><?php echo $bug->module->mname; ?></td>

            <td colspan="1"><?php echo $builds[$bug->openedBuild]; ?></td>

            <!-- 解决日期-->
            <td colspan="1"><?php echo common::tTimeFormat(strtotime($bug->resolvedDate)); ?></td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>