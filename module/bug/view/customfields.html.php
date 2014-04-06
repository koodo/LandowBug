<?php
/**
 * The custom seting fields view of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<form method='post' class='mt-20px'>
  <table class='table-4' align='center'> 
    <caption class='caption-tl'><?php echo $lang->bug->customFields;?></caption>
    <tr class='colhead'>
      <th><?php echo $lang->bug->lblAllFields;?></th>
      <th></th>
      <th><?php echo $lang->bug->lblCustomFields;?></th>
      <th></th>
    </tr>  
    <tr>
      <td>
        <?php 
        echo html::select('allFields[]', $allFields, '', 'class=select-2 size=10 multiple');
        echo html::select('defaultFields[]', $defaultFields, '', 'class=hidden');
        ?>
      </td>
      <td class='v-middle btn-group'>
        <a class='btn' onclick="addItem('allFields', 'customFields')"><i class="icon-chevron-right"></i></a>
        <a class='btn' onclick="delItem('customFields')"><i class="icon-chevron-left"></i></a>
      </td>
      <td><?php echo html::select('customFields[]', $customFields, '', 'class=select-2 size=10 multiple');?></td>
      <td class='v-middle btn-group'>
        <a class='btn' onclick="upItem('customFields')"><i class="icon-plus"></i></a>
        <a class='btn' onclick="downItem('customFields')"><i class="icon-minus"></i></a>
        <a class='btn' onclick='restoreDefault()'><?php echo $lang->bug->restoreDefault;?></a>
      </td>
    </tr>  
    <tr><td colspan='4' class='a-center'><?php echo html::submitButton('', 'onclick=selectItem("customFields")');?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.lite.html.php';?>
