<?php
/**
 * The browse view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: browse.html.php 5102 2013-07-12 00:59:54Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/treeview.html.php';
include '../../common/view/colorize.html.php';
include '../../common/view/dropmenu.html.php';
js::set('browseType', $browseType);
js::set('moduleID', $moduleID);
js::set('customed', $customed);
?>
<div id='exportActionMenu' class='listMenu hidden'>
  <ul>
  <?php 
  $misc = common::hasPriv('bug', 'export') ? "class='export'" : "class=disabled";
  $link = common::hasPriv('bug', 'export') ?  $this->createLink('bug', 'export', "productID=$productID&orderBy=$orderBy") : '#';
  echo "<li>" . html::a($link, $lang->bug->export, '', $misc) . "</li>";
  ?>
  </ul>
</div>

<div id='querybox' class='<?php if($browseType !='bysearch') echo 'hidden';?>'></div>

<?php 
if($customed)
{
    include './browse.custom.html.php'; 
    include '../../common/view/footer.lite.html.php';
    exit;
}
?>

<div class='treeSlider' id='bugTree'><span>&nbsp;</span></div>
  <table class='cont-lt1'>
    <tr valign='top'>
        
      <!-- 左侧树 --><!--
      <td class='side' id='treebox'>
        <div class='box-title'><?php #echo $productName;?></div>
        <div class='box-content'>
          <?php #echo $moduleTree;?>
          <div class='a-right browse-bug-btnl1'>
            <?php #common::printLink('tree', 'browse', "productID=$productID&view=bug", $lang->tree->manage);?>
            <?php #common::printLink('tree', 'fix',    "root=$productID&type=bug", $lang->tree->fix, 'hiddenwin');?>
          </div>
        </div>
      </td>
      <!-- 左侧树 -->
      <?php #输出列表?>
      <?php if($isAll) {
            include './featurebar_bug.php';
            include './browse.urgent.html.php';
      ?>
      <td class='divider'></td>
      <?php include './browse.newest.html.php';} else { 
            include './searchbox.php';
      ?>
      <?php if($browseType=='assigntome') {?>
      <?php include './browse.assigntome.html.php';} else {?>
      <?php include './browse.single.html.php';}}?>
    </tr>
  </table>  

<div id='moreActionMenu' class='listMenu hidden'>
  <ul>
  <?php 
  $class = "class='disabled'";

  $actionLink = $this->createLink('bug', 'batchConfirm');
  $misc = common::hasPriv('bug', 'batchConfirm') ? "onclick=setFormAction('$actionLink','hiddenwin')" : "class='disabled'";
  echo "<li>" . html::a('#', $lang->bug->confirmBug, '', $misc) . "</li>";

  $misc = common::hasPriv('bug', 'batchResolve') ? "onmouseover='toggleSubMenu(this.id)' onmouseout='toggleSubMenu(this.id)' id='resolveItem'" : $class;
  echo "<li>" . html::a('#', $lang->bug->resolve,  '', $misc) . "</li>";
  ?>
  </ul>
</div>

<div id='resolveItemMenu' class='hidden listMenu'>
  <ul>
  <?php
  unset($lang->bug->resolutionList['']);
  unset($lang->bug->resolutionList['duplicate']);
  foreach($lang->bug->resolutionList as $key => $resolution)
  {
      $actionLink = $this->createLink('bug', 'batchResolve', "resolution=$key");
      echo "<li>";
      if($key == 'fixed')
      {
          echo html::a('#', $resolution, '', "onmouseover=toggleSubMenu(this.id,'right',2) id='fixedItem'");
      }
      else
      {
          echo html::a('#', $resolution, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"");
      }
      echo "</li>";
  }
  ?>
  </ul>
</div>

<div id='fixedItemMenu' class='hidden listMenu'>
  <ul>
  <?php
  unset($builds['']);
  foreach($builds as $key => $build)
  {
      $actionLink = $this->createLink('bug', 'batchResolve', "resolution=fixed&resolvedBuild=$key");
      echo "<li>";
      echo html::a('#', $build, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"");
      echo "</li>";
  }
  ?>
  </ul>
</div>

<?php include '../../common/view/footer.html.php';?>
