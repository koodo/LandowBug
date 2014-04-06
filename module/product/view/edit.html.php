<?php
/**
 * The edit view of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: edit.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<form method='post' target='hiddenwin' id='dataform'>
  <table align='center' class='table-1'> 
    <caption><?php echo $lang->product->edit;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->product->name;?></th>
      <td><?php echo html::input('name', $product->name, "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->code;?></th>
      <td><?php echo html::input('code', $product->code, "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->PO;?></th>
      <td><?php echo html::select('PO', $poUsers, $product->PO, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->QD;?></th>
      <td><?php echo html::select('QD', $qdUsers, $product->QD, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->RD;?></th>
      <td><?php echo html::select('RD', $rdUsers, $product->RD, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->status;?></th>
      <td><?php echo html::select('status', $lang->product->statusList, $product->status, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->desc;?></th>
      <td><?php echo html::textarea('desc', $product->desc, "rows='8' class='area-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->product->acl;?></th>
      <td><?php echo nl2br(html::radio('acl', $lang->product->aclList, $product->acl, "onclick='setWhite(this.value);'"));?></td>
    </tr>  
    <tr id='whitelistBox' <?php if($product->acl != 'custom') echo "class='hidden'";?>>
      <th class='rowhead'><?php echo $lang->product->whitelist;?></th>
      <td><?php echo html::checkbox('whitelist', $groups, $product->whitelist);?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
