/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var emailtmp = null;
var emailbutton = null;
var nicknametmp = null;
var nicknamebutton = null;


function editEmail() {
    var node = $('#edit_email_field');
    var button = $('#edit_email_button');
    emailtmp = node.text();
    emailbutton = button.html();
    node.html($("<input type='text' id='edit_email_text' value='" + emailtmp + "' style=\"height:15px;\"/>"));
    button.html($('<a class="Blue" href="javascript:saveEditEmail();">保存</a>&nbsp;<a class="Blue" href="javascript:cancelEditEmail();">取消</a>'));
}

function cancelEditEmail(new_value) {
    $('#edit_email_field').html(typeof new_value === 'undefined' ? emailtmp : new_value);
    $('#edit_email_button').html(emailbutton);
}

function saveEditEmail() {
    var new_value = $('#edit_email_text').val();
    if (new_value === emailtmp) {
        cancelEditEmail();
    } else {
        $.post(createLink('user', 'ajaxChangeEmail'), {new_value: new_value}, function(res) {
            if (res === "1") {
                cancelEditEmail(new_value);
            } else if (res === "-1") {
                alert('该邮箱已被使用!');
            } else {
                alert('修改失败!');
                cancelEditEmail();
            }
        });
    }
}


function editNickName() {
    var node = $('#edit_nickname_field');
    var button = $('#edit_nickname_button');
    nicknametmp = node.text();
    nicknamebutton = button.html();
    node.html($("<input type='text' id='edit_nickname_text' value='" + nicknametmp + "' style=\"height:15px;\"/>"));
    button.html($('<a class="Blue" href="javascript:saveEditNickName();">保存</a>&nbsp;<a class="Blue" href="javascript:cancelEditNickName();">取消</a>'));
}

function saveEditNickName() {
    var new_value = $('#edit_nickname_text').val();
    $.post(createLink('user', 'ajaxChangeNickName'), {new_value: new_value}, function(res) {
        if (res === "1") {
            cancelEditNickName(new_value);
        } else {
            alert('修改失败!');
            cancelEditNickName();
        }
    });
}

function cancelEditNickName(new_value) {
    $('#edit_nickname_field').html(typeof new_value === 'undefined' ? nicknametmp : new_value);
    $('#edit_nickname_button').html(nicknamebutton);
}

$(function() {
    $('#changePassBtn').click(function() {
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        if (pass1 === "" || pass2 === "") {
            alert("密码不能为空!");
        } else if (pass1 !== pass2) {
            alert("两次输入的密码不一致!");
        } else {
            $.post(createLink('user', 'ajaxChangepass'), {pass: pass1}, function(res) {
                if (res === "1") {
                    alert("修改成功");
                    window.location.reload();
                } else {
                    alert("修改失败，服务器错误");
                }
            });
            F
        }
    });
});