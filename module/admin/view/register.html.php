<?php
/**
 * The view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     admin
 * @version     $Id: view.html.php 2568 2012-02-09 06:56:35Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<form method="post" target="hiddenwin">
<table align='center' class='table-6'>
<caption><?php echo $lang->admin->register->caption;?></caption>
  <tr>
    <th class='rowhead'><?php echo $lang->user->account;?></th>
	<td><?php echo html::input('account', '', "class='text-3'") . '<span class="star">*</span>' . $lang->admin->register->lblAccount;?></td>
  </tr>
  <tr>
    <th class="rowhead"><?php echo $lang->user->realname;?></th>
    <td><?php echo html::input('realname', '', "class='text-3'") . '<span class="star">*</span>';?></td>
  </tr>
  <tr>
    <th class="rowhead"><?php echo $lang->user->company;?></th>
    <td><?php echo html::input('company', $register->company, "class='text-3'");?></td>
  </tr>
  <tr>
    <th class="rowhead"><?php echo $lang->user->phone;?></th>
    <td><?php echo html::input('phone', '', "class='text-3'");?></td>
  </tr>  
  <tr>
    <th class="rowhead"><?php echo $lang->user->email;?></td>
    <td><?php echo html::input('email', $register->email, "class='text-3'") . '<span class="star">*</span>';?></td>
  </tr>  
  <tr>
    <th class="rowhead"><?php echo $lang->user->password;?></th>
    <td><?php echo html::password('password1', '', "class='text-3'") . '<span class="star">*</span>' . $lang->admin->register->lblPasswd;?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->user->password2;?></td>
    <td><?php echo html::password('password2', '', "class='text-3'") . '<span class="star">*</span>';?></td>
  </tr> 
  <tr>
    <th>
	  <td colspan="2">
        <?php 
        echo html::submitButton($lang->admin->register->submit) . html::hidden('sn', $sn);
        echo "<span>" . sprintf($lang->admin->register->bind, html::a(inlink('bind'), $lang->admin->register->click)) . "</span>";
        ?>
	  </td>
    </th>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>
