function switchCopyProject(switcher)
{
    if ($(switcher).attr('checked'))
    {
        $('#copyProjectBox').removeClass('hidden');
    }
    else
    {
        $('#copyProjectBox').addClass('hidden');
    }
}

function setCopyProject(projectID)
{
    location.href = createLink('project', 'create', 'projectID=0&copyProjectID=' + projectID);
}

function SelectAll()
{
    var sl = document.getElementById('sr');
    var l = sl.options.length;
    for (var i = 0; i < l; i++)
    {
        sl.options[i].selected = true;
    }
}

function IsAdd1(value)
{
    var sr = document.getElementById("sr1");
    var l = sr.options.length;
    for (var i = 0; i < l; i++)
    {
        if (sr.options[i].value == value)
            return true;
    }
    return false;
}

function IsAdd(value)
{
    var sr = document.getElementById("sr");
    var l = sr.options.length;
    for (var i = 0; i < l; i++)
    {
        if (sr.options[i].value == value)
            return true;
    }
    return false;
}

function SelectAdd1()
{
    var sl = document.getElementById("sr");
    var l = sl.options.length;
    for (var i = 0; i < l; i++)
    {
        if (sl.options[i].selected)
        {
            var temp = sl.options[i];
            if (!IsAdd1(temp.value)) {
                document.getElementById("sr1").options.add(new Option(temp.text, temp.value));
                $('#isadmin_member_' + temp.value).val(1);
            }
        }
    }
}

function SelectAdd()
{
    var sl = document.getElementById("sl");
    var l = sl.options.length;
    for (var i = 0; i < l; i++)
    {
        if (sl.options[i].selected)
        {
            var temp = sl.options[i];
            if (!IsAdd(temp.value)) {
                document.getElementById("sr").options.add(new Option(temp.text, temp.value));
                $('#members').append($(renderData(temp.value)));
            }
        }
    }
}

function renderData(value) {
    var _data = '<div id="_member_' + value + '" style="display:hidden;" class="removeable">';
    _data += '<input type="hidden" name="realnames[]" value="' + value + '" />';
    _data += '<input type="hidden" name="accounts[]" value="' + value + '" />';
    _data += '<input type="hidden" name="modes[]" value="replace" />';
    _data += '<input type="hidden" name="days[]" value="1" />';
    _data += '<input type="hidden" name="hours[]" value="1" />';
    _data += '<input type="hidden" name="roles[]" value="1" />';
    _data += '<input type="hidden" name="isadmin[]" value="0" id="isadmin_member_' + value + '" />';
    _data += '</div>';
    return _data;
}

function SelectDel()
{
    $("#sr option").each(function(i) {
        if ($(this).attr("selected")) {
            var sr = $(this);
            $('#_member_' + $(this).val()).remove();
            $("#sr1 option").each(function(i, node) {
                console.log($(node).val());
                if ($(sr).val() === $(node).val()) {
                    console.log(1);
                    $('#isadmin_member_' + $(node).val()).val(0);
                    $(node).remove();
                    $(sr).remove();
                }
            });
        }
    });
}

function SelectDel1()
{
    $("#sr1 option").each(function(i) {
        if ($(this).attr("selected")) {
            $('#isadmin_member_' + $(this).val()).val(0);
            $(this).remove();
        }
    });
}

function initData() {
    $("#sr option").each(function(i) {
        $('#members').append($(renderData($(this).val())));
    });
    initDataAdmin();
}

function initDataAdmin() {
    $("#sr1 option").each(function(i) {
        $('#isadmin_member_' + $(this).val()).val(1);
        $('#isadmin_member_' + $(this).val()).parent().removeClass('removeable');
    });
}

$(function() {
    initData();
    loadTeamMembersData('sl', $('#pteam').val());
});

//------------------------Version-----------------
var Save = "保存";
var Cancel = "取消";
var SaveFirst = '请先保存';
var pid = 10724;
function AddVersion(_this)
{
    if (document.getElementById("input_v"))
    {
        alert(SaveFirst);
        return;
    }
    if (document.getElementById("add_li1"))
        return;
    $(_this).parent().parent().before("<tr id='add_li1'><td colspan='6'><input id='v_name' type='text' style='width:80%'/></td> <td colspan='2'><a class='Blue' href='javascript:AddV();'> " + Save + "</a></td> <td colspan='2'><a class='Blue' href='javascript:Cancle_AddV();' >" + Cancel + "</a></td></tr>");
}

function Cancle_AddV() {
    $('#add_li1').remove();
}

function AddV()
{
    var name = $("#v_name").val().trim();
    if (name === "") {
        alert("不能为空!");
        return false;
    }

    $.ajax({
        url: createLink('build', 'create', 'projectID=' + $('#projectid').val()),
        type: "POST",
        data: "name=" + name + "&project=" + $('#projectid').val(),
        success: function(data) {
            if (data === '1') {
                $('#add_li1').find('input').val('');
                $('#add_li1').hide();
                window.location.reload();
            } else if (data === '-1') {
                alert('版本已经存在!');
            } else {
                alert("修改版本失败!");
                Cancle_UpdateV(id);
            }
        }, error: function() {
            alert('添加版本失败!');
        }
    });
}
function DelV(id)
{
    if (!confirm('确定??'))
        return;
    $.ajax({
        url: createLink('build', 'delete', 'buildID=' + id),
        type: "POST",
        data: "noconf=no",
        success: function(data) {
            var res = eval("(" + data + ")");
            if (res.result === 'success')
                $('#build_' + id).remove();
            else
                alert('删除版本失败!');
        }
    });
}
var tempv;
function EditV(id)
{
    if (document.getElementById("input_v") || document.getElementById("v_name"))
    {
        alert(SaveFirst);
        return;
    }
    var namenode = $("#build_name_" + id);
    var name = $("#build_name_" + id).html().trim();
    tempv = name;
    namenode.html("<input id='input_v' value=\"" + name + "\" type='text' /> <a class='Blue' href='javascript:UpdateV(" + id + ");'> " + Save + "</a> <a class='Blue' href='javascript:Cancle_UpdateV(" + id + ");' >" + Cancel + "</a>");
}
function Cancle_UpdateV(id)
{
    $("#build_name_" + id).html(tempv);
}
function UpdateV(id)
{
    var newName = $("#input_v").val().trim();
    if (newName === "") {
        alert("不能为空!");
        return false;
    }
    $.ajax({
        url: createLink('build', 'ajaxUpdateBuild'),
        type: "POST",
        data: "name=" + newName + "&id=" + id + "&project=" + $('#projectid').val(),
        success: function(data) {
            if (data === '1')
                $("#build_name_" + id).html(newName);
            else if (data === '-1') {
                alert('版本已经存在!');
            } else {
                alert("修改版本失败!");
                Cancle_UpdateV(id);
            }
        }, error: function() {
            alert("修改版本失败!");
        }
    });
}

//------------------------Moudle-----------------
function AddModule(_this)
{
    if (document.getElementById("input_m"))
    {
        alert('请先保存之前的');
        return;
    }
    if (document.getElementById("add_li2"))
        return;
    getProjectMembers(function(res) {
        $(_this).parent().parent().before("<tr id='add_li2'><td colspan='3'><input id='m_name' type='text' style='width:80%'/></td>"
                + "<td colspan='3'>" + res + "</td>"
                + " <td colspan='2'><a class='Blue' href='javascript:AddP();'> " + Save
                + "</a></td> <td colspan='2'><a class='Blue' href='javascript:Cancle_AddP();'>" + Cancel + "</a></td></td></tr>");
    });
}
function Cancle_AddP()
{
    $("#add_li2").remove();
}
function DelMD(id)
{
    if (!confirm("确定??"))
        return;
    $.ajax({
        url: createLink('module', 'ajaxDelModule'),
        type: "POST",
        data: "project=" + $('#projectid').val() + '&mid=' + id,
        success: function(data) {
            if (data === '1')
                $("#module_" + id).remove();
            else
                alert('删除模块失败!');
        }
    });
}
var tempmd;
var tempur;
function EditMD(id)
{
    if (document.getElementById("input_m") || document.getElementById("m_name"))
    {
        alert('请先保存之前的');
        return;
    }
    var namenode = $("#module_name_" + id);
    var name = $("#module_name_" + id).html().trim();
    tempur = $("#module_user_" + id).html();
    // select 

    loadProjectMembers(id)

    tempmd = name;
    tempmdd = $("#module_delete_" + id).html();
    tempmde = $("#module_edit_" + id).html();
    namenode.html("<input style='width:80%' id='input_m' value=\"" + name + "\" type='text' />");
    $("#module_edit_" + id).html("<a class='Blue' href='javascript:UpdateMD(" + id + ");'> " + Save + "</a>");
    $("#module_delete_" + id).html("<a class='Blue' href='javascript:Cancle_UpdateMD(" + id + ");' >" + Cancel + "</a>");
    /*
     var namenode = $('#module_name_' + id)
     tempmd = $("#module_name_" + id).html();
     var name = namenode.html().trim();
     $.ajax({
     url: createLink('module', 'ajaxEditModule'),
     type: "POST",
     data: "mname=" + name + '&mid=' + id,
     success: function(data) {
     $("#li_m_" + id + " td:first").html("<input size='8' id='input_m' value='" + name + "' type='text' />");
     $("#li_m_" + id + " td:eq(1)").html(data + "<a class='Blue' href='javascript:UpdateMD(" + id + ");'> " + Save + "</a> <a class='Blue' href='javascript:Cancle_UpdateMD(" + id + ");' > " + Cancel + "</a> ");
     $("#li_m_" + id + " option").each(function(i) {
     ($(this).html().trim() == mid) ? $(this).attr("selected", "selected") : "";
     })
     }
     });*/
}
function Cancle_UpdateMD(id)
{
    $("#module_name_" + id).html(tempmd);
    $("#module_user_" + id).html(tempur);
    $("#module_delete_" + id).html(tempmdd);
    $("#module_edit_" + id).html(tempmde);
}
function UpdateMD(id)
{
    var newName = $("#input_m").val().trim();
    var newUser = $("#module_assigntoselect").find("option:selected").text();
    if (newName === "") {
        alert("不能为空!");
        return false;
    }
    $.ajax({
        url: createLink('module', 'ajaxEditModule'),
        type: "POST",
        data: "mname=" + newName + '&mid=' + id + "&assignto=" + $('#module_assigntoselect').val() + "&project=" + $('#projectid').val(),
        success: function(data) {
            if (data === '1') {
                // TODO
                $("#module_name_" + id).html(newName);
                $("#module_user_" + id).html(newUser);
                $("#module_delete_" + id).html(tempmdd);
                $("#module_edit_" + id).html(tempmde);
            } else if (data === '-1') {
                alert('模块已经存在!');
            } else {
                alert('添加模块失败!');
            }
        }, error: function() {
            alert("修改模块失败!");
        }
    });
}
function AddP()
{
    var name = $("#m_name").val().trim();
    var mid = $('#projectid').val();
    if (name === "") {
        alert("不能为空!");
        return false;
    }

    $.ajax({
        url: createLink('module', 'ajaxAddModule'),
        type: "POST",
        data: "mname=" + name + "&project=" + mid + "&assignto=" + $('#module_assigntoselect').val(),
        success: function(data) {
            if (data === '1') {
                window.location.reload();
            } else if (data === '-1') {
                alert('模块已经存在!');
            } else {
                alert('添加模块失败!');
            }
        }, error: function() {
            alert('添加模块失败!');
        }
    });
}

function loadCallback() {
    $("div.removeable[id^='_member_']").remove();
    $('#sr option.removeable').remove();
    $('#sr1 option.removeable').remove();
}

function loadProjectMembers(id) {
    $.post(createLink('team', 'ajaxGetProjectMembersPairs'), {projectid: $('#projectid').val()}, function(res) {
        var data = eval("(" + res + ")");
        var leng = data.length;
        console.log(data);
        var str = "<select id='module_assigntoselect'>";
        for (var i = 0; i < leng; i++) {
            str += "<option value='" + data[i].account + "'>" + data[i].realname + "</option>";
        }
        $("#module_user_" + id).html(str + "</select>");
    });
}

function getProjectMembers(callback) {
    $.post(createLink('team', 'ajaxGetProjectMembersPairs'), {projectid: $('#projectid').val()}, function(res) {
        var data = eval("(" + res + ")");
        var leng = data.length;
        var str = "<select id='module_assigntoselect'>";
        for (var i = 0; i < leng; i++) {
            str += "<option value='" + data[i].account + "'>" + data[i].realname + "</option>";
        }
        callback(str + "</select>");
    });
}

function editProjectSubmit() {
    var name = $('#name').val();
    var code = $('#code').val();
    var _alert = "";
    if (name === "")
        _alert += "项目名称不能为空!";
    if (code === "")
        _alert += "\n项目代号不能为空!";
    if (_alert !== "") {
        alert(_alert);
        return false;
    } else {
        $('#dataform').submit();
        return true;
    }
}