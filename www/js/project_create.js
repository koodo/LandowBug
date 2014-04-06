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
    var _data = '<div id="_member_' + value + '" style="display:hidden;">';
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
            $('#_member_' + $(this).val()).remove();
            $(this).remove();
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

function loadCallback() {
    $("[id^='_member_']").remove();
    $('#sr').html('');
    $('#sr1').html('');
}

function createProjectSubmit() {
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

$(function() {
    loadTeamMembersData('sl', $('#pteam').val());
});