<?php
/**
 * The create view of case module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     case
 * @version     $Id: create.html.php 4904 2013-06-26 05:37:45Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/form.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php js::set('lblDelete', $lang->testcase->deleteStep);?>
<?php js::set('lblBefore', $lang->testcase->insertBefore);?>
<?php js::set('lblAfter', $lang->testcase->insertAfter);?>
<form method='post' enctype='multipart/form-data' id='dataform' class='ajaxForm'>
  <table class='table-1'> 
    <caption><?php echo $lang->testcase->create;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->lblProductAndModule;?></th>
      <td>
        <?php echo html::select('product', $products, $productID, "onchange=loadAll(this.value); class='select-3'");?>
        <span id='moduleIdBox'>
        <?php 
        echo html::select('module', $moduleOptionMenu, $currentModuleID, "onchange=loadModuleRelated();");
        if(count($moduleOptionMenu) == 1)
        {
            echo html::a($this->createLink('tree', 'browse', "rootID=$productID&view=case"), $lang->tree->manage, '_blank');
            echo html::a("javascript:loadProductModules($productID)", $lang->refresh);
        }
        ?>
        </span>
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->type;?></th>
      <td><?php echo html::select('type', $lang->testcase->typeList, $type, 'class=select-3');?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->stage;?></th>
      <td><?php echo html::select('stage[]', $lang->testcase->stageList, $stage, "class='select-3' multiple='multiple'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->pri;?></th>
      <td><?php echo html::select('pri', $lang->testcase->priList, $pri, 'class=select-3');?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->lblStory;?></th>
      <td>
        <div id='storyIdBox'><?php echo html::select('story', $stories, $storyID, 'class="text-1" onchange=setPreview();');?>
        <?php if($storyID == 0): ?>
          <a href='' id='preview' class='iframe hidden'><?php echo $lang->preview;?></a>
        <?php else:?>
          <?php echo html::a($this->createLink('story', 'view', "storyID=$storyID"), $lang->preview, '', "class='iframe' id='preview'");?>
        <?php endif;?>
        </div>
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->title;?></th>
      <td><?php echo html::input('title', $caseTitle, "class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->precondition;?></th>
      <td><?php echo html::textarea('precondition', $precondition, " rows='4' class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->steps;?></th>
      <td>
        <table class='w-p90'>
          <tr class='colhead'>
            <th class='w-30px'><?php echo $lang->testcase->stepID;?></th>
            <th><?php echo $lang->testcase->stepDesc;?></th>
            <th class='w-200px'><?php echo $lang->testcase->stepExpect;?></th>
            <th class='w-100px'><?php echo $lang->actions;?></th>
          </tr>
          <?php
          foreach($steps as $stepID => $step)
          {
              $stepID += 1;
              echo "<tr id='row$stepID' class='a-center'>";
              echo "<th class='stepID'>$stepID</th>";
              echo '<td class="w-p50">' . html::textarea('steps[]', $step->desc, "rows='3' class='w-p100'") . '</td>';
              echo '<td>' . html::textarea('expects[]', $step->expect, "rows='3' class='w-p100'") . '</td>';
              echo "<td class='a-left w-100px'><nobr>";
              echo "<input type='button' tabindex='-1' class='addbutton' onclick='preInsert($stepID)'  value='{$lang->testcase->insertBefore}' /><br />";
              echo "<input type='button' tabindex='-1' class='addbutton' onclick='postInsert($stepID)' value='{$lang->testcase->insertAfter}'  /><br />";
              echo "<input type='button' tabindex='-1' class='delbutton' onclick='deleteRow($stepID)'  value='{$lang->testcase->deleteStep}'   /><br />";
              echo "</nobr></td>";
              echo '</tr>';
          }
          ?>
        </table>
      </td> 
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->testcase->keywords;?></th>
      <td><?php echo html::input('keywords', $keywords, "class='text-1'");?></td>
    </tr>  
     <tr>
      <th class='rowhead'><?php echo $lang->testcase->files;?></th>
      <td><?php echo $this->fetch('file', 'buildform');?></td>
    </tr>  
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton() . html::backButton();?> </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
