<?php include '../../common/view/header.html.php'; ?>
<?php js::set('confirmUnlinkMember', $lang->project->confirmUnlinkMember) ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>team.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">添加团队</span>
</div>
<form method="POST"  action="#" id="team-create-form">
    <table align='center' class='table-1' id='memberList'>
        <tr>
            <td width="200px"> </td>
            <td> </td>
        </tr>
        <tr>
            <td class="rowhead" style="text-align:left;padding-left:10px">团队名称</td>
            <td><input type="text" name="tname" id="tname" class="text-3"/></td>
        </tr>
        <tr>
            <td style="padding-left:10px;text-align:left;vertical-align:top">添加新成员(输入Email,换行隔开)</td>
            <td style="text-align:left">
                <textarea id="emails" name="emails" rows="6" cols="55"></textarea><br />
                <input type='submit' name='submit' value='添加' id="memberSubmit" style="margin-top:10px;" onclick="return false;"/>            
            </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(function() {
        $('#memberSubmit').click(function() {
            if ($('#tname').val() === '') {
                alert('团队名不能为空!');
                return false;
            } else {
                var tname = $('#tname').val();
                var emails = $('#emails').val();
                $.post(createLink('team', 'ajaxCreateTeam'), {tname: tname, emails: emails}, function(res) {
                    var R = eval("(" + res + ")");
                    console.log(R);
                    if (R.result === 'fail') {
                        if (R.message === 'namef') {
                            alert('团队已经存在!');
                        } else {
                            alert('添加失败!');
                        }
                    } else {
                        // su
                        console.log(createLink('team', 'view', 'teamid=' + R.teamid));
                        window.location.href = createLink('team', 'view', 'teamid=' + R.teamid);
                    }
                });
            }
        });
    });
</script>
<?php include '../../common/view/footer.html.php'; ?>