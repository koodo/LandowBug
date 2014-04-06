<?php
/**
 * The browse view file of tree module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id: browse.html.php 4796 2013-06-06 02:21:59Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<table class='cont-lt5'>
  <tr valign='top'>
    <td class='side'>
      <form method='post' target='hiddenwin' action='<?php echo $this->createLink('tree', 'updateOrder', "root={$root->id}&viewType=$viewType");?>'>
        <table class='table-1'>
          <caption><?php echo $title;?></caption>
          <tr>
            <td>
              <div id='main'><?php echo $modules;?></div>
              <div class='a-center'>
                <?php if(common::hasPriv('tree', 'updateorder')) echo html::submitButton($lang->tree->updateOrder);?>
              </div>
            </td>
          </tr>
        </table>
      </form>
    </td>
    <td class='divider'></td>
    <td>
      <form method='post' target='hiddenwin' action='<?php echo $this->createLink('tree', 'manageChild', "root={$root->id}&viewType=$viewType");?>'>
        <table align='center' class='table-1'>
          <?php $manageChild = 'manage' . ucfirst($viewType) . 'Child';?>
          <caption><?php echo strpos($viewType, 'doc') !== false ? $lang->doc->manageType : $lang->tree->$manageChild;?></caption>
          <tr>
            <td width='10%'>
              <nobr>
              <?php
              echo html::a($this->createLink('tree', 'browse', "root={$root->id}&viewType=$viewType"), $root->name);
              echo $lang->arrow;
              foreach($parentModules as $module)
              {
                  echo html::a($this->createLink('tree', 'browse', "root={$root->id}&viewType=$viewType&moduleID=$module->id"), $module->name);
                  echo $lang->arrow;
              }
              ?>
              </nobr>
            </td>
            <td id='moduleBox'> 
              <?php
              if($viewType == 'task')
              {
                  if($allProject)
                  {
                      echo html::select('allProject', $allProject, '', 'onchange=syncProductOrProject(this,"project")');
                      echo html::select('projectModule', $projectModules, '');
                      echo html::commonButton($lang->tree->syncFromProject, "id='copyModule' onclick='syncModule($currentProject, \"task\")'");
                  }
                  echo '<br />';
              }
              else if($viewType == 'story')
              {
                  if($allProduct)
                  {
                      echo html::select('allProduct', $allProduct, '', 'onchange=syncProductOrProject(this,"product")');
                      echo html::select('productModule', $productModules, '');
                      echo html::commonButton($lang->tree->syncFromProduct, "id='copyModule' onclick='syncModule($currentProduct, \"story\")'");
                  }
                  echo '<br />';
              }
              $maxOrder = 0;
              echo '<div id="sonModule">';
              foreach($sons as $sonModule)
              {
                  if($sonModule->order > $maxOrder) $maxOrder = $sonModule->order;
                  $disabled = $sonModule->type == $viewType ? '' : 'disabled="true"';
                  echo '<span>' . html::input("modules[id$sonModule->id]", $sonModule->name, 'class=text-3 style="margin-bottom:5px" ' . $disabled) . '<br /></span>';
              }
              for($i = 0; $i < TREE::NEW_CHILD_COUNT ; $i ++) echo '<span>' . html::input("modules[]", '', 'class=text-3 style="margin-bottom:5px"') . '<br /></span>';
              ?>
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td colspan='2'>
              <?php 
              echo html::submitButton() . html::backButton();
              echo html::hidden('parentModuleID', $currentModuleID);
              echo html::hidden('maxOrder', $maxOrder);
              ?>      
              <input type='hidden' value='<?php echo $currentModuleID;?>' name='parentModuleID' />
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
<?php 
if(strpos($viewType, 'doc') !== false) 
{
    include '../../doc/view/footer.html.php';
}
else
{
    include '../../common/view/footer.html.php';
}
?>
