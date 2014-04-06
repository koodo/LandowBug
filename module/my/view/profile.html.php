<?php
/**
 * The profile view file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     my
 * @version     $Id: profile.html.php 4694 2013-05-02 01:40:54Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/tablesorter.html.php'; ?>
<script src='/js/my_profile.js' type='text/javascript'></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">个人资料</span>
</div>
<div style="border:1px solid #d6e1ea;padding:15px;">
    <div class="n-box">
        <label>Email</label>
        <span id="edit_email_field"><?php echo $user->email; ?></span>
        <span id="edit_email_button"><a class="Blue" href="javascript:editEmail();">修改</a></span>
    </div>
    <div class="n-box">
        <label>昵称</label>
        <span id="edit_nickname_field"><?php echo $user->realname; ?></span>
        <span id="edit_nickname_button"><a class="Blue" href="javascript:editNickName();">修改</a></span>
    </div>
    <hr>
    <form method="POST" action="<?php echo helper::createLink('user', 'ajaxChangepass') ?>">
        <input type="hidden" name="usrchange_pass" value="0874c7fafcf4bf44b9d5d09652dfe64b" />
        <div class="n-box">
            <label>新密码</label>
            <span><input type="password" id="pass1" name="pass" style="height:15px;" /></span>
        </div>
        <div class="n-box">
            <label>确认密码</label>
            <span><input type="password" id="pass2" name="passa" style="height:15px;" /></span>
        </div>
        <div class="n-box">
            <label> </label>
            <span><input type="submit" value="提交" id="changePassBtn" onclick="return false;"/></span>
        </div>
    </form>
    <hr>
<!--<table align='center' class='table-4'>
<tr>
<th class='rowhead'><?php echo $lang->user->account; ?></th>
<td><?php echo $user->account; ?></td>
</tr>
<tr>
<th class='rowhead'><?php echo $lang->user->realname; ?></th>
<td><?php echo $user->realname; ?></td>
</tr>
<tr>
<th class='rowhead'><?php echo $lang->user->commiter; ?></th>
<td><?php echo $user->commiter; ?></td>
</tr>
<tr>
<th class='rowhead'><?php echo $lang->user->email; ?></th>
<td><?php echo $user->email; ?></td>
</tr>
<tr>
<th class='rowhead'><?php echo $lang->user->join; ?></th>
<td><?php echo $user->join; ?></td>
</tr>
<tr>
<th class='rowhead'><?php echo $lang->user->qq; ?></th>
<td><?php if ($user->qq) echo html::a("tencent://message/?uin=$user->qq", $user->qq); ?></td>
</tr>  
<tr>
<th class='rowhead'><?php echo $lang->user->phone; ?></th>
<td><?php echo $user->phone; ?></td>
</tr>  
</table>-->
</div>
<?php include '../../common/view/footer.html.php'; ?>
