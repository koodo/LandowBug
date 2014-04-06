<?php
/**
 * The html template file of index method of index module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: index.html.php 5094 2013-07-10 08:46:15Z chencongzhi520@gmail.com $
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/sparkline.html.php'; ?>
<?php include '../../common/view/colorize.html.php'; ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>project_list.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">项目信息</span>
    <div  style="float:right;line-height:45px;"><a href="<?php echo helper::createLink('project', 'create'); ?>" target="" id="submenucreate"><i class="icon-green-bug-create" style="width:0;"></i>&nbsp;添加项目</a></div>
</div>
<!--
<h3>
<?php echo html::a(inlink("index", "locate=no&status=all&projectID=$project->id"), $lang->project->all); ?>
<?php echo html::a(inlink("index", "locate=no&status=wait&projectID=$project->id"), $lang->project->statusList['wait']); ?>
<?php echo html::a(inlink("index", "locate=no&status=doing&projectID=$project->id"), $lang->project->statusList['doing']); ?>
<?php echo html::a(inlink("index", "locate=no&status=suspended&projectID=$project->id"), $lang->project->statusList['suspended']); ?>
<?php echo html::a(inlink("index", "locate=no&status=done&projectID=$project->id"), $lang->project->statusList['done']); ?>
</h3>
-->
<form method='post' action='<?php echo inLink('batchEdit', "projectID=$projectID"); ?>'>
    <table class='table-1 fixed colored'>
        <tr class='colhead'>
          <!--<th class='w-id'><?php #echo $lang->idAB;    ?></th>-->
            <th colspan="3">项目名称</th>
            <th colspan="1">项目代号</th>
            <th colspan="1">创建日期</th>
            <th colspan="1">负责团队</th>
            <th colspan="1">相关操作</th>
        </tr>
        <?php #$canBatchEdit = common::hasPriv('project', 'batchEdit'); ?>
        <?php $canBatchEdit = false; ?>
        <?php foreach ($projectStats as $project): ?>
            <tr class='a-center'>
                <td class='a-left' colspan="3"><?php echo html::a($this->createLink('bug', 'browse', 'projectID=' . $project->id), $project->name); ?></td>
                <td colspan="1"><?php echo $project->code; ?></td>
                <td colspan="1"><?php echo $project->begin; ?></td>
                <td colspan="1"><?php echo $project->tname; ?></td>
                <td colspan="1" style="line-height:30px;">
                    <?php $params = "project=" . $project->id; ?>
                    <?php echo html::a($this->createLink('bug', 'browse', $params), '进入'); ?>
                    <?php if ($this->project->isProjectAdmin($app->user->account, $project->id) || $app->user->account == $project->openedBy): ?>
                        |<?php echo common::printIcon('project', 'edit', $params); ?>| <a href="javascript:;" onclick="ajaxDeleteProject(<?php echo $project->id; ?>)">删除</a>
                    <?php else: ?>
                        | <a href="javascript:;" onclick="ajaxQuitProject(<?php echo $project->id; ?>)">退出项目</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($canBatchEdit): ?>
            <tfoot>
                <tr>
                    <td colspan='10' class='a-right'>
                        <div class='f-left'>
                            <?php echo html::selectAll() . html::selectReverse(); ?>
                            <?php echo html::submitButton($lang->project->batchEdit); ?>
                        </div>
                    </td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
</form>
<script type="text/javascript">
    function ajaxQuitProject(id) {
        if (confirm('确定要退出项目吗?')) {
            $.post(createLink('project', 'ajaxQuitProject'), {project: id}, function(res) {
                if (res === "1") {
                    window.location.reload()
                } else
                    alert('退出失败!');
            });
        }
    }
</script>
<?php include '../../common/view/footer.html.php'; ?>
