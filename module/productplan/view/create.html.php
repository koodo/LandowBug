<?php
/**
 * The create view of productplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     productplan
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php js::import($jsRoot . 'misc/date.js');?>
<form method='post' target='hiddenwin' id='dataform'>
  <table class='table-1'> 
    <caption><?php echo $lang->productplan->create;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->productplan->product;?></th>
      <td><?php echo $product->name;?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->productplan->title;?></th>
      <td><?php echo html::input('title', '', "class='text-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->productplan->begin;?></th>
      <td><?php echo html::input('begin', $begin, "class='text-3 date'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->productplan->end;?></th>
      <td>
        <?php echo html::input('end', '', "class='text-3 date'");?>
        <span><?php echo html::radio('delta', $lang->productplan->endList , '', "onclick='computeEndDate(this.value)'");?></span>
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->productplan->desc;?></th>
      <td><?php echo html::textarea('desc', '', "rows='10' class='area-1'");?></td>
    </tr>  
    <tr>
      <td colspan='2' class='a-center'>
        <?php 
        echo html::submitButton();
        echo html::backButton();
        echo html::hidden('product', $product->id);
        ?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
