<?php
/**
 * The doc view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php js::set('confirmDelete', $lang->doc->confirmDelete)?>
<table class='table-1 fixed colored tablesorter' align='center' id='docList'>
  <caption class='caption-tl pb-10px'>
    <div class='f-left'> <?php echo $lang->project->doc;?></div>
    <div class='f-right'><?php common::printIcon('doc', 'create', "libID=project&moduleID=0&productID=0&projectID=$project->id&from=project");?></div>
  </caption>
  <thead>
    <tr class='colhead'>
      <th class='w-id'><?php echo $lang->idAB;?></th>
      <th><?php echo $lang->doc->module;?></th>
      <th><?php echo $lang->doc->title;?></th>
      <th><?php echo $lang->doc->addedBy;?></th>
      <th><?php echo $lang->doc->addedDate;?></th>
      <th class='w-100px {sorter:false}'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($docs as $key => $doc):?>
    <?php
    $viewLink = $this->createLink('doc', 'view', "docID=$doc->id");
    $canView  = common::hasPriv('doc', 'view');
    ?>
    <tr class='a-center'>
      <td><?php if($canView) echo html::a($viewLink, sprintf('%03d', $doc->id)); else printf('%03d', $doc->id);?></td>
      <td><?php if(isset($modules[$doc->module]))print($modules[$doc->module]);?></td>
      <td class='a-left nobr'><nobr><?php echo html::a($viewLink, $doc->title);?></nobr></td>
      <td><?php echo $users[$doc->addedBy];?></td>
      <td><?php echo $doc->addedDate;?></td>
      <td>
        <?php 
        common::printIcon('doc', 'edit',   "doc=$doc->id");
        if(common::hasPriv('doc', 'delete'))
        {
            $deleteURL = $this->createLink('doc', 'delete', "docID=$doc->id&confirm=yes");
            echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"docList\",confirmDelete)", '<i class="icon-green-common-delete"></i>', '', "class='link-icon' title='{$lang->doc->delete}'");
        }
        ?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php include '../../common/view/footer.html.php';?>
