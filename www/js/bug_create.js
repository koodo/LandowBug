/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function() {
    $('#submit').click(function() {
        var title = $('#title').val();
        if(title === ""){
            alert('标题不能为空!');
        }
    });
});