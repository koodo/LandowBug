<?php
/**
 * The view method view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: view.html.php 4594 2013-03-13 06:16:02Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='titlebar'>
  <div id='main' <?php if($project->deleted) echo "class='deleted'";?>>PROJECT #<?php echo $project->id . ' ' . $project->name;?></div>
  <div>
    <?php
    $params = "project=$project->id";
    $browseLink = $this->session->projectList ? $this->session->projectList : inlink('browse', "projectID=$project->id");
    if(!$project->deleted)
    {
        ob_start();
        common::printIcon('project', 'start',    "projectID=$project->id", $project);
        common::printIcon('project', 'activate', "projectID=$project->id", $project);
        common::printIcon('project', 'putoff',   "projectID=$project->id", $project);
        common::printIcon('project', 'suspend',  "projectID=$project->id", $project);
        common::printIcon('project', 'close',    "projectID=$project->id", $project);

        common::printDivider();
        common::printIcon('project', 'edit', $params);
        common::printIcon('project', 'delete', $params, '', 'button', '', 'hiddenwin');
        common::printRPN($browseLink);

        $actionLinks = ob_get_contents();
        ob_end_clean();
        echo $actionLinks;
    }
    else
    {
        common::printRPN($browseLink);
    }
    ?>
  </div>
</div>

<table class='cont-rt5'>
  <tr valign='top'>
    <td>
      <fieldset>
        <legend><?php echo $lang->project->goal;?></legend>
        <div class='content'><?php echo $project->goal;?></div>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->project->desc;?></legend>
        <div class='content'><?php echo $project->desc;?></div>
      </fieldset>
      <?php include '../../common/view/action.html.php';?>
      <div class='a-center actionLink'> <?php if(!$project->deleted) echo $actionLinks;?></div>
    </td>
    <td class="divider"></td>
    <td class="side">
      <fieldset>
        <legend><?php echo $lang->project->basicInfo?></legend>
        <table class='table-1 a-left'>
          <tr>
            <th width='25%' class='a-right'><?php echo $lang->project->name;?></th>
            <td><?php echo $project->name;?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->code;?></th>
            <td><?php echo $project->code;?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->beginAndEnd;?></th>
            <td><?php echo $project->begin . ' ~ ' . $project->end;?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->days;?></th>
            <td><?php echo $project->days;?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->type;?></th>
            <td><?php echo $lang->project->typeList[$project->type];?></td>
          </tr>
          <tr> 
            <th class='rowhead'><?php echo $lang->project->status;?></th>
            <td class='<?php echo $project->status;?>'><?php $lang->show($lang->project->statusList, $project->status);?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->PM;?></th>
            <td><?php echo $users[$project->PM];?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->PO;?></th>
            <td><?php echo $users[$project->PO];?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->QD;?></th>
            <td><?php echo $users[$project->QD];?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->RD;?></th>
            <td><?php echo $users[$project->RD];?></td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->products;?></th>
            <td>
              <?php foreach($products as $productID => $productName) echo html::a($this->createLink('product', 'browse', "productID=$productID"), $productName) . '<br />';?>
            </td>
          </tr>
          <tr>
            <th class='rowhead'><?php echo $lang->project->acl;?></th>
            <td><?php echo $lang->project->aclList[$project->acl];?></td>
          </tr>  
          <tr>
            <th class='rowhead'><?php echo $lang->project->whitelist;?></th>
            <td>
              <?php
              $whitelist = explode(',', $project->whitelist);
              foreach($whitelist as $groupID) if(isset($groups[$groupID])) echo $groups[$groupID] . '&nbsp;';
              ?>
            </td>
          </tr>  
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->project->otherInfo?></legend>
        <table class='table-1 a-left'>
          <tr>
            <th class='rowhead'><?php echo $lang->project->lblStats;?></th>
            <td><?php printf($lang->project->stats, $project->totalHours, $project->totalEstimate, $project->totalConsumed, $project->totalLeft, 10)?></td>
         </tr>
        </table>
      </fieldset>
    </td>
  </tr>
</table>
  <?php include '../../common/view/footer.html.php';?>
