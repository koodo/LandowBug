<?php
/**
 * The view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: view.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='titlebar'>
  <div id='main' <?php if($bug->deleted) echo "class='deleted'";?>>BUG #<?php echo $bug->id . ' ' . $bug->title;?></div>
  <div>
    <?php
    $browseLink    = $app->session->bugList != false ? $app->session->bugList : inlink('browse', "productID=$bug->product");
    $params        = "bugID=$bug->id";
    $copyParams    = "productID=$productID&extras=bugID=$bug->id";
    $convertParams = "productID=$productID&moduleID=0&from=bug&bugID=$bug->id";
    if(!$bug->deleted)
    {
        ob_start();
        common::printIcon('bug', 'confirmBug', $params, $bug, 'button', '', '', 'iframe', true);
        common::printIcon('bug', 'assignTo',   $params, '',   'button', '', '', 'iframe', true);
        common::printIcon('bug', 'resolve',    $params, $bug, 'button', '', '', 'iframe showinonlybody', true);
        common::printIcon('bug', 'close',      $params, $bug, 'button', '', '', 'iframe', true);
        common::printIcon('bug', 'activate',   $params, $bug, 'button', '', '', 'iframe', true);

        common::printIcon('bug', 'toStory', "product=$bug->product&module=0&story=0&project=0&bugID=$bug->id", $bug, 'button', 'toStory');
        common::printIcon('bug', 'createCase', $convertParams, '', 'button', 'createCase');

        common::printDivider();
        common::printIcon('bug', 'edit', $params);
        common::printCommentIcon('bug');
        common::printIcon('bug', 'create', $copyParams, '', 'button', 'copy');
        common::printIcon('bug', 'delete', $params, '', 'button', '', 'hiddenwin');

        common::printDivider();
        common::printRPN($browseLink, $preAndNext);

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

<table>
    <tr>
        <th class='rowhead'><?php echo $lang->bug->product;?></th>
        <td><?php if(!common::printLink('bug', 'browse', "productID=$bug->product", $productName)) echo $productName;?>
    </tr>
    
    <tr>
        <td class='rowhead w-p20'><?php echo $lang->bug->project;?></td>
        <td><?php if($bug->project) echo html::a($this->createLink('project', 'browse', "projectid=$bug->project"), $bug->projectName);?></td>
    </tr>
    
    <tr>
        <th class='rowhead'><?php echo $lang->bug->module;?></th>
        <td> 
           <?php
                if(empty($modulePath))
                {
                     echo "/";
                 }
                 else
                 {
                     foreach($modulePath as $key => $module)
                     {
                        if(!common::printLink('bug', 'browse', "productID=$bug->product&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
                        if(isset($modulePath[$key + 1])) echo $lang->arrow;
                      }
                 }
            ?>
        </td>
    </tr>
    
    <tr>
        <th class='rowhead'><?php echo $lang->bug->productplan;?></th>
        <td><?php if(!$bug->plan or !common::printLink('productplan', 'linkBug', "planID=$bug->plan", $bug->planName)) echo $bug->planName;?>
    </tr>
    
    <tr>
        <td class='rowhead'><?php echo $lang->bug->type;?></td>
        <td><?php if(isset($lang->bug->typeList[$bug->type])) echo $lang->bug->typeList[$bug->type]; else echo $bug->type;?></td>
    </tr>
    
    <tr>
        <td class='rowhead'><?php echo $lang->bug->severity;?></td>
        <td><strong><?php echo $lang->bug->severityList[$bug->severity];?></strong></td>
    </tr>
    
    <tr>
        <td class='rowhead'><?php echo $lang->bug->pri;?></td>
        <td><strong><?php echo $lang->bug->priList[$bug->pri];?></strong></td>
    </tr>
    
    <tr>
        <td class='rowhead'><?php echo $lang->bug->status;?></td>
        <td><strong><?php echo $lang->bug->statusList[$bug->status];?></strong></td>
    </tr>
    
    <tr>
        <td class='rowhead'><?php echo $lang->bug->lblAssignedTo;?></td>
        <td><?php if($bug->assignedTo) echo $users[$bug->assignedTo] . $lang->at . $bug->assignedDate;?></td>
    </tr>
    
    <tr>
        <th class='rowhead'><?php echo $lang->bug->lblResolved;?></th>
        <td><?php if($bug->resolvedBy) echo $users[$bug->resolvedBy] . $lang->at . $bug->resolvedDate;?>
    </tr>
    
    <tr>
        <th class='rowhead'><?php echo $lang->bug->closedBy;?></th>
        <td><?php if($bug->closedBy) echo $users[$bug->closedBy] . $lang->at . $bug->closedDate;?></td>
    </tr>
    
    <tr>
        <th class='rowhead'><?php echo $lang->bug->lblLastEdited;?></th>
        <td><?php if($bug->lastEditedBy) echo $users[$bug->lastEditedBy] . $lang->at . $bug->lastEditedDate?></td>
    </tr>
      
    <tr>
        <th class='rowhead w-p20'><?php echo $lang->bug->openedBy;?></th>
        <td> <?php echo $users[$bug->openedBy] . $lang->at . $bug->openedDate;?></td>
    </tr>
    
    <tr>
        <td>
            <div class='content'><?php echo str_replace('<p>[', '<p class="stepTitle">[', $bug->steps);?></div>
            <!--?php echo $this->fetch('file', 'printFiles', array('files' => $bug->files, 'fieldset' => 'true'));?-->
            <?php include '../../common/view/action.html.php';?>
            <div class='a-center actionlink'><?php if(!$bug->deleted) echo $actionLinks;?></div>
            <div id='commentBox' class='hidden'>
            <fieldset>
            <legend><?php echo $lang->comment;?></legend>
            <form method='post' action='<?php echo inlink('edit', "bugID=$bug->id&comment=true")?>'>
                <table align='center' class='table-1'>
                    <tr><td><?php echo html::textarea('comment', '',"rows='5' class='w-p100'");?></td></tr>
                    <tr><td><?php echo html::submitButton() . html::backButton();?></td></tr>
                </table>
            </form>
            </fieldset>
            </div>
        </td>
    </tr>
</table>
    <?php include '../../common/view/syntaxhighlighter.html.php';?>
<!--?php include '../../common/view/footer.html.php';?-->
