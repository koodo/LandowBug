<?php
/**
 * The edit file of case module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     case
 * @version     $Id: edit.html.php 5000 2013-07-03 08:20:57Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php js::set('lblDelete', $lang->testcase->deleteStep);?>
<?php js::set('lblBefore', $lang->testcase->insertBefore);?>
<?php js::set('lblAfter',  $lang->testcase->insertAfter);?>
<form method='post' enctype='multipart/form-data' target='hiddenwin' id='dataform'>
<div id='titlebar'>
  <div id='main'>
  CASE #<?php echo $case->id . $lang->colon;?>
  <?php echo html::input('title', $case->title, 'class=text-1');?>
  </div>
  <div><?php echo html::submitButton();?></div>
</div>

<table class='cont-rt5'>
  <tr valign='top'>
    <td>
      <fieldset>
        <legend><?php echo $lang->testcase->precondition;?></legend>
        <?php echo html::textarea('precondition', $case->precondition, "rows='4' class='w-p100'");?>
      </fieldset>
      <table class='table-1'>
       <tr class='colhead'>
          <th class='w-30px'><?php echo $lang->testcase->stepID;?></th>
          <th><?php echo $lang->testcase->stepDesc;?></th>
          <th><?php echo $lang->testcase->stepExpect;?></th>
          <th class='w-100px'><?php echo $lang->actions;?></th>
        </tr>
        <?php
        foreach($case->steps as $stepID => $step)
        {
            $stepID += 1;
            echo "<tr id='row$stepID' class='a-center'>";
            echo "<th class='stepID'>$stepID</th>";
            echo '<td class="w-p50">' . html::textarea('steps[]', $step->desc, "rows='3' class='w-p100'") . '</td>';
            echo '<td>' . html::textarea('expects[]', $step->expect, "rows='3' class='w-p100'") . '</td>';
            echo "<td class='a-left w-100px'><nobr>";
            echo "<input type='button' tabindex='-1' class='addbutton' onclick='preInsert($stepID)'  value='{$lang->testcase->insertBefore}' /><br />";
            echo "<input type='button' tabindex='-1' class='addbutton' onclick='postInsert($stepID)' value='{$lang->testcase->insertAfter}'  /><br /> ";
            echo "<input type='button' tabindex='-1' class='delbutton' onclick='deleteRow($stepID)'  value='{$lang->testcase->deleteStep}'   /><br /> ";
            echo "</nobr></td>";
            echo '</tr>';
        }
        ?>
      </table>

      <fieldset>
        <legend><?php echo $lang->testcase->legendComment;?></legend>
        <?php echo html::textarea('comment', '',  "rows='5' class='area-1'");?>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->testcase->legendAttatch;?></legend>
        <?php echo $this->fetch('file', 'buildform', 'filecount=2');?>
      </fieldset>

      <div class='a-center'>
       <?php echo html::submitButton();?>
       <input type='button' value='<?php echo $lang->testcase->buttonToList;?>' class='button-s' 
            onclick='location.href="<?php echo $this->createLink('testcase', 'browse', "productID=$productID");?>"' />
      </div>
      <?php include '../../common/view/action.html.php';?>

    </td>
    <td class='divider'></td>
    <td class='side'>
      <fieldset>
        <legend><?php echo $lang->testcase->legendBasicInfo;?></legend>
        <table class='table-1 a-left' cellpadding='0' cellspacing='0'>
          <tr>
            <td class='rowhead w-p20'><?php echo $lang->testcase->product;?></td>
            <td><?php echo html::select('product', $products, $productID, "onchange=loadAll(this.value); class='select-1'");?></td>
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->module;?></td>
            <td><span id='moduleIdBox'><?php echo html::select('module', $moduleOptionMenu, $currentModuleID, "onchange='loadModuleRelated()' class='select-1'");?></span></td>
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->story;?></td>
            <td class='a-left'><div id='storyIdBox'><?php echo html::select('story', $stories, $case->story, 'class=select-1');?></div>
            </td>       
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->type;?></td>
            <td><?php echo html::select('type', (array)$lang->testcase->typeList, $case->type, 'class=select-1');?>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->testcase->stage;?></th>
            <td><?php echo html::select('stage[]', $lang->testcase->stageList, $case->stage, "class='select-1' multiple='multiple'");?></td>
          </tr>  
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->pri;?></td>
            <td><?php echo html::select('pri', (array)$lang->testcase->priList, $case->pri, 'class=select-1');?>
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->status;?></td>
            <td><?php echo html::select('status', (array)$lang->testcase->statusList, $case->status, 'class=select-1');?></td>
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->keywords;?></td>
            <td><?php echo html::input('keywords', $case->keywords, 'class=text-1');?></td>
          </tr>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->linkCase;?></td>
            <td><?php echo html::input('linkCase', $case->linkCase, 'class=text-1');?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->testcase->legendOpenAndEdit;?></legend>
        <table class='table-1 a-left'>
          <tr>
            <td class='rowhead w-p20'><?php echo $lang->testcase->openedBy;?></td>
            <td><?php echo $users[$case->openedBy] . $lang->at . $case->openedDate;?></td>
          <tr>
            <td class='rowhead'><?php echo $lang->testcase->lblLastEdited;?></td>
            <td><?php if($case->lastEditedBy) echo $users[$case->lastEditedBy] . $lang->at . $case->lastEditedDate;?></td>
          </tr>
        </table>
      </fieldset>
    </td>
  </tr>
</table>
<?php include '../../common/view/footer.html.php';?>
