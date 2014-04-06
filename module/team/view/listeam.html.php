<?php include '../../common/view/header.html.php'; ?>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">团队列表</span>
    <div  style="float:right;line-height:45px;">
        <a href="<?php echo helper::createLink('team', 'create'); ?>" target="" id="submenucreate"><i class="icon-green-bug-create" style="width:0;"></i>&nbsp;添加团队</a>
    </div>
</div>
<table align='center' class='table-1' id='memberList'>
    <thead>
        <tr class='colhead'>
            <th>团队名称</th>
            <th>加入日期</th>
            <th>是否创建者</th>
            <th>是否管理员</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teams as $team): ?>
            <?php
            $isAdmin = $this->team->isTeamAdmin($app->user->account, $team->tid) || common::isAdmin();
            $isCreator = $app->user->account == $team->creator;
            ?>
            <tr class='a-center'>
                <td><?php echo html::a(helper::createLink('team', 'view', 'teamid=' . $team->tid), $team->tname); ?></td>
                <td><?php echo $team->date; ?></td>
                <td><?php echo $isCreator ? '是' : '否'; ?></td>
                <td><?php echo $isAdmin ? '是' : '否'; ?></td>
                <td>
                    <?php
                    if ($isAdmin || $isCreator) {
                        echo html::a(helper::createLink('project', 'create', 'teamid=' . $team->tid), '[创建项目]');
                        echo html::a(helper::createLink('team', 'view', 'teamid=' . $team->tid), '[编辑]');
                        echo html::a('javascript:;', '[删除]', '_self', 'onclick="ajaxDeleteTeam(' . $team->tid . ',this)"');
                    } else {
                        echo html::a('javascript:;', '[退出团队]', '_self', 'onclick="ajaxQuitTeam(' . $team->tid . ',this)"');
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
    function ajaxDeleteTeam(tid, node) {
        var tid = parseInt(tid);
        if (confirm('确定删除团队吗?')) {
            $.post(createLink('team', 'ajaxDelete'), {
                tid: tid
            }, function(res) {
                if (res === '1') {
                    $(node).parent().parent().remove();
                    window.location.reload();
                } else
                    alert('删除失败!');
            });
        }
    }
    function ajaxQuitTeam(tid, node) {
        var tid = parseInt(tid);
        if (confirm('确定退出团队吗?')) {
            $.post(createLink('team', 'ajaxQuitTeam'), {
                teamid: tid
            }, function(res) {
                if (res === '1') {
                    $(node).parent().parent().remove();
                    window.location.reload();
                } else
                    alert('退出团队失败!');
            });
        }
    }
</script>
<?php include '../../common/view/footer.html.php'; ?>

