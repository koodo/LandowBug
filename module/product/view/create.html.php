<?php
/**
 * The create view of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: create.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<form method='post' target='hiddenwin' id='dataform'>
  <table class='table-1'> 
    <caption><?php echo $lang->product->create;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->product->name;?></th>
      <td><?php echo html::input('name', '', "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->code;?></th>
      <td><?php echo html::input('code', '', "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->PO;?></th>
      <td><?php echo html::select('PO', $poUsers, $this->app->user->account, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->QD;?></th>
      <td><?php echo html::select('QD', $qdUsers, '', "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->RD;?></th>
      <td><?php echo html::select('RD', $rdUsers, '', "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->desc;?></th>
      <td><?php echo html::textarea('desc', '', "rows='8' class='area-1'");?></textarea></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->acl;?></th>
      <td><?php echo nl2br(html::radio('acl', $lang->product->aclList, 'open', "onclick='setWhite(this.value);'"));?></td>
    </tr>  
    <tr id='whitelistBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->product->whitelist;?></th>
      <td><?php echo html::checkbox('whitelist', $groups);?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
