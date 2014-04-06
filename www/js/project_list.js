/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ajaxDeleteProject(projectid) {
    if (confirm("确定要删除项目吗?")) {
        $.post(createLink('project', 'ajaxDeleteProject'), {projectid: projectid}, function(res) {
            console.log(res);
            if(res === "1"){
                window.location.reload();
            } else {
                alert("删除项目失败!");
            }
        });
    }
}