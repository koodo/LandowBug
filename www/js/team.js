var str_sure = "确定??";
var str_failure = "失败";

function unlinkMember(account) {
    if (confirm('确定删除成员?')) {
        $.post(createLink('team', 'ajaxDeleteMember'), {
            teamid: $('#teamid').val(),
            account: account
        }, function(res) {
            if (res === '1') window.location.reload();
            else alert('删除失败!');
        });
    }
}

function SetAdmin(mid, isAdmin) {
    var node = $(isAdmin);
    var _isAdmin = $(isAdmin).attr('data-isadmin');
    if (_isAdmin === '1') {
        if (confirm('确定取消?')) {
            // 取消
            $("#check_" + mid).attr("checked", false);
            $.post(createLink('user', 'ajaxSetAdmin'), {
                account: mid,
                teamid: $('#teamid').val(),
                cancel: 1
            }, function(res) {
                if (res !== '1')
                    alert('取消管理员失败');
                else
                    node.attr('data-isadmin', 0);
            });
            return;
        } else {
            $("#check_" + mid).attr("checked", "checked");
            return;
        }
    } else {
        if (confirm('确定设置' + mid + '为管理员?')) {
            {
                $("#check_" + mid).attr("checked", true);
                $.post(createLink('user', 'ajaxSetAdmin'), {
                    account: mid,
                    teamid: $('#teamid').val()
                }, function(res) {
                    if (res !== '1')
                        alert('设置管理员失败');
                    else
                        node.attr('data-isadmin', 1);
                });
                return;
            }
        } else {
            $("#check_" + mid).attr("checked", null);
            return;
        }
    }
} 