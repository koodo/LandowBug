<?php
/**
 * The edit view file of webapp module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     webapp
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<form method='post' target='hiddenwin' enctype='multipart/form-data'>
<table class='table-1'>
  <caption><?php echo $lang->webapp->edit?></caption>
  <tr>
    <th align='left'><?php echo $lang->webapp->module?></th>
    <td><?php echo html::select('module', $modules, $webapp->module, "class='select-3'")?></td>
  </tr>
  <?php if($webapp->addType != 'system'):?>
  <tr>
    <th align='left'><?php echo $lang->webapp->name?></th>
    <td><?php echo html::input('name', $webapp->name, "class='text-3'")?></td>
  </tr>
  <tr>
    <th align='left'><?php echo $lang->webapp->url?></th>
    <td><?php echo html::input('url', $webapp->url, "class='text-3'")?></td>
  </tr>
  <?php endif;?>
  <tr>
    <th align='left'><?php echo $lang->webapp->target?></th>
    <td><?php echo html::select('target', $lang->webapp->targetList, $webapp->target, "class='select-3'")?></td>
  </tr>
  <?php 
  $customWidth  = '';
  $customHeight = '';
  if(!array_key_exists($webapp->size, $lang->webapp->sizeList))
  {
      $size = $webapp->size;
      $webapp->size = 'custom';
      if(strpos($size, 'x') !== false) list($customWidth, $customHeight) = explode('x', $size);
  }
  ?>
  <tr class="size">
    <th align='left'><?php echo $lang->webapp->size?></th>
    <td><?php echo html::select('size', $lang->webapp->sizeList, $webapp->size, "class='select-3'")?></td>
  </tr>
  <tr class="customSize <?php if($webapp->size != 'custom') echo 'hidden'?>">
    <th align='left'><?php echo $lang->webapp->custom?></th>
    <td><?php echo html::input('customWidth', $customWidth, "class='w-40px'") . 'px X ' . html::input('customHeight', $customHeight, "class='w-40px'") . 'px';?></td>
  </tr>
  <tr>
    <th align='left'><?php echo $lang->webapp->abstract?></th>
    <td><?php echo html::input('abstract', $webapp->abstract, "class='text-3' maxlength='30'")?> <span><?php echo $lang->webapp->noticeAbstract?></span></td>
  </tr>
  <tr>
    <th align='left'><?php echo $lang->webapp->desc?></th>
    <td><?php echo html::textarea('desc', $webapp->desc, "class='area-1' rows='5'")?></td>
  </tr>
  <?php if($webapp->addType == 'custom'):?>
  <tr>
    <th align='left'><?php echo $lang->webapp->icon?></th>
    <td>
      <?php
      if($webapp->icon) echo "<p><img src='{$webapp->icon->webPath}' /></p>";
      echo html::file('files', "class='text-1' size='57'");
      ?>
      <br /><span><?php echo $lang->webapp->noticeIcon?></span>
    </td>
  </tr>
  <?php endif;?>
  <tr><td colspan='2' align='center'><?php echo html::submitButton()?></td></tr>
</table>
</form>
<div class='hidden'>
<table class='table-1'>
  <tr class="hideSize">
    <th><?php echo $lang->webapp->size?></th>
    <td><?php echo html::select('size', $lang->webapp->sizeList, $webapp->size, "class='select-3'")?></td>
  </tr>
  <tr class="hideHeight">
    <th><?php echo $lang->webapp->height?></th>
    <td><?php echo html::input('size', $webapp->size, "class='text-3'")?></td>
  </tr>
</table>
</div>
<?php include '../../common/view/footer.lite.html.php';?>

