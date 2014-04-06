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
<script type="text/javascript" src="<?php echo $jsRoot;?>team.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">团队信息</span>
</div>
<table align='center' class='table-1' id='memberList'>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">团队名称</td>
        <td>koodo的团队</td>
    </tr>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">创建时间</td>
        <td>2012-12-12</td>
    </tr>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">创建人</td>
        <td>koodo</td>
    </tr>
    <tr>
        <td class="rowhead" style="text-align:left;padding-left:10px;">管理员</td>
        <td>admin</td>
    </tr>
</table>
<table align='center' class='table-1' id='memberList'>
    <thead>
        <tr class='colhead'>
            <th style="text-align:left">成员</th>
            <th style="text-align:left">加入日期</th>
            <th>删除</th>
            <th>管理员</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalHours = 0; ?>
        <?php foreach ($teamMembers as $member): ?>
            <tr class='a-center'>
                <td style="text-align:left">
                    <?php
                    print $member->realname;
                    $memberHours = $member->days * $member->hours;
                    $totalHours += $memberHours;
                    ?>
                </td>
                <td style="text-align:left"><?php echo $member->join; ?></td>
                <td>
                    <?php
                    if (common::hasPriv('project', 'unlinkMember')) {
                        $unlinkURL = $this->createLink('project', 'unlinkMember', "projectID=$project->id&account=$member->account&confirm=yes");
                        echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"memberList\",confirmUnlinkMember)", '<i class="icon-green-project-unlinkMember icon-remove"></i>', '', "class='link-icon' title='{$lang->project->unlinkMember}'");
                    }
                    ?>
                </td>
                <td>
                    <input id="check_" type="checkbox" onclick="SetAdmin(<?php echo $member->uid;?>);" <?php if(common::isAdmin($member->account)) echo "checked=checked"?> />
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th style="text-align:left">添加新成员</th>
            <th style="text-align:left"></th>
            <th> </th>
        </tr>
        <!--
        <tr class="a-center odd">
            <td style="text-align:left"><textarea id="emails" name="emails" rows="6" cols="25"></textarea></td>
            <td>添加新成员(输入Email,换行隔开)</td>
        </tr>-->
        <tr>
            <td style="text-align:left;vertical-align:top;">添加新成员(输入Email,换行隔开)</td>
            <td style="text-align:left">
                <textarea id="emails" name="emails" rows="6" cols="55"></textarea><br />
                <input type='submit' name='submit' value='添加' id="memberSubmit" style="margin-top:10px;" onclick="memberSubmit()"/>            </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>
<!--
<div class="OverviewBox margintop10">
    <label>
        <img src="/Content/images/person_icon.gif">
        添加新成员
    </label>
    <div class="left">
        <div class="left">
            <textarea id="emails" name="emails" rows="6" cols="25"></textarea>
        </div>
        ass="nametip DLine ">
        <div class="mid"> 添加新成员(输入Email,换行隔开) </div>
        <div class="btm"> </div>
    </div>
    <br class=" clear">
    <br>
    <a class="Buttom icon_bigest " href="javascript:AddTeamMembers();">
        <span> 添加</span>
    </a>
    <font color="red"> </font>
</div>-->
<script type="text/javascript">
    /*var _projectID = <?php #echo $project->id  ?>;
     function memberSubmit() {
     var _value = $('#memberselect').val();
     $.post(createLink('project', 'ajaxAddMember'), {
     value: _value,
     projectID: _projectID
     }, function(res) {
     if (res === "0") {
     // faild
     alert('添加成员失败，成员已存在！');
     } else {
     // success
     var data = eval('(' + res + ')');
     var str = '<tr class="a-center"><td style="text-align:left">' + _value + '</td>';
     str += '<td style="text-align:left">' + data.join + '</td>';
     str += '<td> </td></tr>';
     $('#memberList').append($(str));
     }
     });
     }*/
</script>    
<?php include '../../common/view/footer.html.php'; ?>