<?php
/**
 * The team view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: team.html.php 4143 2013-01-18 07:01:06Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/tablesorter.html.php'; ?>
<?php js::set('confirmUnlinkMember', $lang->project->confirmUnlinkMember) ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>team.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">团队信息</span>
</div>
<table align='center' class='table-1' id='memberList'>
    <input type="hidden" value="<?php echo $team->tid; ?>" id="teamid" />
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">团队名称</td>
        <td><?php echo $team->tname ?></td>
    </tr>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">创建时间</td>
        <td><?php echo $team->date ?></td>
    </tr>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">创建人</td>
        <td><?php echo $users[$team->creator] ?></td>
    </tr>
    <!--
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">管理员</td>
        <td><?php echo $users[$team->admin] ?></td>
        $users[$bug->openedBy]
    </tr>
    -->
</table>
<table align='center' class='table-1' id='memberList'>
    <thead>
        <tr class='colhead'>
            <th style="text-align:left">成员</th>
            <th style="text-align:left">邮箱</th>
            <th style="text-align:left">加入日期</th>
            <th>删除</th>
            <th>管理员</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalHours = 0;
        $isRoot = common::isAdmin();
        $isTeamAdmin = $this->team->isTeamAdmin($app->user->account, $team->tid);
        $isAdmin = $this->team->isTeamAdmin($app->user->account, $team->tid);
        $isCreator = $app->user->account == $team->creator;
        ?>
        <?php foreach ($TeamMembers as $member): ?>
            <?php
            $isMemAdmin   = $this->team->isTeamAdmin($member->account, $team->tid);
            $isMemCreator = $member->account == $team->creator;
            $isMemRoot    = common::isAdmin($member->account);
            ?>
            <tr class='a-center'>
                <td style="text-align:left">
                    <?php
                    print $member->realname;
                    $memberHours = $member->days * $member->hours;
                    $totalHours += $memberHours;
                    ?>
                </td>
                <td style="text-align:left"><?php echo $member->email; ?></td>
                <td style="text-align:left"><?php echo $member->join; ?></td>
                <td>
                    <!--<?php echo $app->user->account; ?><?php echo $team->admin; ?>-->
                    <!--<?php if ($team->admin == $app->user->account) echo html::a("javascript:unlinkMember(\"$member->account\")", '<i class="icon-green-project-unlinkMember icon-remove"></i>', '', "class='link-icon' title='{$lang->project->unlinkMember}'"); ?>-->
                    <?php
                    if (($isCreator || $isRoot || ($isAdmin && !$isMemAdmin)) && !$isMemCreator) {
                        echo html::a("javascript:unlinkMember(\"$member->account\")", '<i class="icon-green-project-unlinkMember icon-remove"></i>', '', "class='link-icon' title='{$lang->project->unlinkMember}'");
                    } else {
                        echo '--';
                    }
                    ?>
                </td>
                <td>
                    <input id="check_<?php echo $member->account; ?>" <?php
                    if (!$isRoot && $isAdmin && !$isCreator) {
                        echo 'disabled="disabled"';
                    } else if($isMemCreator && !$isRoot){
                        echo 'disabled="disabled"';
                    } else if(!$isAdmin && !$isRoot){
                        echo 'disabled="disabled"';
                    }
                    ?> type="checkbox" data-isadmin="<?php echo $member->isadmin; ?>" onclick="SetAdmin('<?php echo $member->account; ?>', this);" <?php if ($member->isadmin == 1) echo "checked=checked" ?> />
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($isRoot || $isAdmin || $isCreator): ?>
            <tr>
                <th style="text-align:left">添加新成员</th>
                <th style="text-align:left"></th>
                <th> </th>
            </tr>
            <tr>
        <form action="#" method="POST">
            <td style="text-align:left;vertical-align:top;">添加新成员(输入Email,换行隔开)</td>
            <td style="text-align:left">
                <textarea id="emails" name="emails" rows="6" cols="55"></textarea><br />
                <input type='submit' name='submit' value='添加' id="memberSubmit" style="margin-top:10px;" onclick="memberSubmit()"/>            
            </td>
            <td> </td>
            <td> </td>
            <form>
                </tr>
            <?php endif; ?>
            </tbody>
            </table>
            <?php include '../../common/view/footer.html.php'; ?>