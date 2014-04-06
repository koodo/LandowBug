<?php
/**
 * The edit file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: edit.html.php 4259 2013-01-24 05:49:40Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/chosen.html.php';
include '../../common/view/alert.html.php';
include '../../common/view/kindeditor.html.php';
js::set('page', 'edit');
js::set('changeProductConfirmed', false);
js::set('changeProjectConfirmed', false);
js::set('confirmChangeProduct', $lang->bug->confirmChangeProduct);
js::set('planID', $bug->plan);
js::set('oldProjectID', $bug->project);
js::set('oldStoryID', $bug->story);
js::set('oldTaskID', $bug->task);
js::set('oldOpenedBuild', $bug->openedBuild);
js::set('oldResolvedBuild', $bug->resolvedBuild);
?>
<script type="text/javascript">
    function Rehandle()
    {
        if (document.getElementById("c_rehandle").checked)
        {
            document.getElementById("assignedTo").disabled = false;
            $('#reassign-comment').show();
        }
        else
        {
            document.getElementById("assignedTo").disabled = true;
            $('#reassign-comment').hide();
        }
    }
</script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0"><?php echo $bug->id . '# &nbsp' . $bug->title; ?></span>
</div>
<div style="border:1px solid #d6e1ea">
    <form method='post' target='hiddenwin' enctype='multipart/form-data' id='dataform'>
        <input type="hidden" value="<?php echo $bug->status; ?>" name="status" />
        <input type="hidden" name="product" value="1" id="product" />
        <table class='table-1 bd-none' style="width:75%">
            <tr>
                <td class="bugeditRH">标题</td>
                <td><?php echo html::input('title', str_replace("'", "&#039;", $bug->title), 'style="width:60%;margin-top:-2px;"'); ?></td>
            </tr>    
            <tr>
                <td class="bugeditRH">项目</td>
                <td><span id='projectIdBox'><?php echo html::select('project', $crt_projects, $bug->project, 'class="select-3" onchange="loadProjectRelativeData(this.value,1);"'); ?></span></td>
            </tr>   
            <tr>
                <td class="bugeditRH">所属模块</td>
                <td>
                    <?php echo html::select('product', $products, $productID, "onchange=loadAll(this.value) class='select-3'"); ?>
                    <span id='moduleIdBox'><?php echo html::select('module', $moduleOptionMenu, $bug->module, "onchange='loadModuleRelated()' class=select-3"); ?></span>
                </td>
            </tr>  
            <tr>
                <td class="bugeditRH">版本</td>
                <td><span id='openedBuildBox'><?php echo html::select('openedBuild[]', $builds, $bug->openedBuild, 'class=select-3'); ?></span></td>
            </tr> 
            <tr>
                <td class="bugeditRH">优先级</td>
                <td><?php echo html::radio('severity', $lang->bug->severityList, $bug->severity); ?></td>
            </tr>
            <tr>
                <td class="bugeditRH" style="vertical-align: top;">描述与截图</td>
                <td>
                    <?php echo html::textarea('steps', $bug->steps, "style='width:89.5%;height:400px;'"); ?><input type="hidden" value="" name="comment" />
                </td>
            </tr>
            <tr>
                <td class="bugeditRH" style="vertical-align: top;">附件</td>
                <td>
                    <?php echo $this->fetch('file', 'printFiles', array('files' => $bug->files)); ?>
                    <br />
                    <?php echo $this->fetch('file', 'buildform', 'filecount=1'); ?>
                </td>
            </tr>          
            <tr>
                <td class="bugeditRH">重新分配</td>
                <td><input type="checkbox" value="false" id="c_rehandle" onclick="Rehandle()" style="vertical-align:middle;"/>&nbsp;<?php echo html::select('assignedTo', $members, $bug->assignedTo, 'style="height:auto" disabled="disabled"'); ?></td>
            </tr>
            <tr id="reassign-comment" style="display:none;">
                <td class="bugeditRH">备注</td>
                <td><textarea class="area-5" style="height:80px;" name="reassign_comment"></textarea></td>
            </tr>
        </table>
        <div class='a-center'>
            <?php
            echo html::submitButton('提交');
            $browseLink = $app->session->bugList != false ? $app->session->bugList : inlink('browse', "productID=$bug->product");
            echo html::linkButton($lang->goback, $browseLink);
            ?>
        </div>
        <br/>
</div>
<?php include '../../common/view/footer.html.php'; ?>
