<?php
/**
 * The create view of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('holders', $lang->user->placeholder);?>
<?php js::set('roleGroup', $roleGroup);?>
<form method='post' target='hiddenwin' id='dataform'>
  <table align='center' class='table-5'> 
    <caption><?php echo $lang->user->create;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->user->dept;?></th>
      <td><?php echo html::select('dept', $depts, $deptID, "class='select-3'");?>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->account;?></th>
      <td><?php echo html::input('account', '', "class='text-3' autocomplete='off'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->realname;?></th>
      <td><?php echo html::input('realname', '', "class='text-3'");?></td>
    </tr>
    <!--
    <tr>
      <th class='rowhead'><?php echo $lang->user->password;?></th>
      <td><?php echo html::password('password1', '', "class='text-3' autocomplete='off'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->password2;?></th>
      <td><?php echo html::password('password2', '', "class='text-3' autocomplete='off'");?></td>
    </tr>
    -->
    <tr>
      <th class='rowhead'><?php echo $lang->user->role;?></th>
      <td><?php echo html::select('role', $lang->user->roleList, '', "class='select-3' onchange='changeGroup(this.value)'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->group;?></th>
      <td><?php echo html::select('group', $groupList, '', "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->email;?></th>
      <td><?php echo html::input('email', '', "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->commiter;?></th>
      <td><?php echo html::input('commiter', '', "class='text-3'");?></td>
    </tr> 
    <!--
    <tr>
      <th class='rowhead'><?php echo $lang->user->join;?></th>
      <td><?php echo html::input('join', '', "class='text-3 date'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->user->gender;?></th>
      <td><?php echo html::radio('gender', (array)$lang->user->genderList, 'm');?></td>
    </tr>
    -->
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
