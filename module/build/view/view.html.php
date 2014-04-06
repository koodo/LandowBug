<?php
/**
 * The view file of build module's view method of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     build
 * @version     $Id: view.html.php 4386 2013-02-19 07:37:45Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<table class='cont-rt5'> 
  <caption class='<?php if($build->deleted) echo 'deleted';?>'>BUILD #<?php echo $build->id . ' ' . $build->name;?></caption>
  <tr valign='top'>
    <td>
      <fieldset>
        <legend><?php echo $lang->build->desc;?></legend>
        <div class='content'><?php echo $build->desc;?></div>
      </fieldset>
      <?php include '../../common/view/action.html.php';?>
      <div class='a-center f-16px strong mb-10px'>
      <?php
      $browseLink = $this->session->buildList ? $this->session->buildList : $this->createLink('project', 'build', "projectID=$build->project");
      if(!$build->deleted)
      { 
        common::printIcon('build', 'edit',   "buildID=$build->id");
        common::printIcon('build', 'delete', "buildID=$build->id", '', 'button', '', 'hiddenwin');
      }
      echo common::printRPN($browseLink);
      ?>
      </div>
      <table class='table-1 fixed'>
        <caption class='caption-t1'><?php echo $lang->build->stories;?></caption>
        <tr>
          <th class='w-id'><?php echo $lang->idAB;?></th>
          <th class='w-pri'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->story->title;?></th>
          <th class='w-user'><?php echo $lang->openedByAB;?></th>
          <th class='w-hour'><?php echo $lang->story->estimateAB;?></th>
          <th class='w-hour'><?php echo $lang->statusAB;?></th>
          <th class='w-100px'><?php echo $lang->story->stageAB;?></th>
        </tr>
        <?php foreach($stories as $storyID => $story):?>
        <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id", '', true);?>
        <tr class='a-center'>
          <td><?php echo sprintf('%03d', $story->id);?></td>
          <td><span class='<?php echo 'pri' . $lang->story->priList[$story->pri]?>'><?php echo $lang->story->priList[$story->pri];?></span></td>
          <td class='a-left nobr'><?php echo html::a($storyLink,$story->title, '', "class='preview'");?></td>
          <td><?php echo $users[$story->openedBy];?></td>
          <td><?php echo $story->estimate;?></td>
          <td class='<?php echo $story->status;?>'><?php echo $lang->story->statusList[$story->status];?></td>
          <td><?php echo $lang->story->stageList[$story->stage];?></td>
        </tr>
        <?php endforeach;?>
        <tr><td colspan=7 class='a-left strong'><?php echo sprintf($lang->build->finishStories, count($stories));?></td></tr>
      </table>
      <table class='table-1 fixed'>
        <caption class='caption-t1'><?php echo $lang->build->bugs;?></caption>
        <tr>
          <th class='w-id'><?php echo $lang->idAB;?></th>
          <th><?php echo $lang->bug->title;?></th>
          <th class='w-100px'><?php echo $lang->bug->status;?></th>
          <th class='w-user'><?php echo $lang->openedByAB;?></th>
          <th class='w-date'><?php echo $lang->bug->openedDateAB;?></th>
          <th class='w-user'><?php echo $lang->bug->resolvedByAB;?></th>
          <th class='w-date'><?php echo $lang->bug->resolvedDateAB;?></th>
        </tr>
        <?php foreach($bugs as $bug):?>
        <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug->id", '', true);?>
        <tr class='a-center'>
          <td><?php echo sprintf('%03d', $bug->id);?></td>
          <td class='a-left nobr'><?php echo html::a($bugLink, $bug->title, '', "class='preview'");?></td>
          <td><?php echo $lang->bug->statusList[$bug->status];?></td>
          <td><?php echo $users[$bug->openedBy];?></td>
          <td><?php echo substr($bug->openedDate, 5, 11)?></td>
          <td><?php echo $users[$bug->resolvedBy];?></td>
          <td><?php echo substr($bug->resolvedDate, 5, 11)?></td>
        </tr>
        <?php endforeach;?>
        <tr><td colspan=7 class='a-left strong'><?php echo sprintf($lang->build->resolvedBugs, count($bugs));?></td></tr>
      </table>
    </td>
    <td class="divider"></td>
    <td class="side">
      <fieldset>
        <legend><?php echo $lang->build->basicInfo?></legend>
        <table class='table-1 a-left fixed'>
          <tr>
            <th width='25%' class='a-right'><?php echo $lang->build->product;?></th>
            <td><?php echo $build->productName;?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->build->name;?></th>
            <td><?php echo $build->name;?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->build->builder;?></th>
            <td><?php echo $users[$build->builder];?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->build->date;?></th>
            <td><?php echo $build->date;?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->build->scmPath;?></th>
            <td><?php strpos($build->scmPath,  'http') === 0 ? printf(html::a($build->scmPath))  : printf($build->scmPath);?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->build->filePath;?></th>
            <td><?php strpos($build->filePath, 'http') === 0 ? printf(html::a($build->filePath)) : printf($build->filePath);?></td>
          </tr>
        </table>
      </fieldset>
    </td>
  </tr>
</table>   
<?php include '../../common/view/footer.html.php';?>
