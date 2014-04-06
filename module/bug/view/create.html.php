<?php
/**
 * The create view of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: create.html.php 4903 2013-06-26 05:32:59Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/form.html.php';
include '../../common/view/chosen.html.php';
include '../../common/view/alert.html.php';
include '../../common/view/kindeditor.html.php';
js::set('holders', $lang->bug->placeholder);
js::set('page', 'create');
//js::set('createRelease', $lang->release->create);
//js::set('createBuild', $lang->build->create);
js::set('refresh', $lang->refresh);
?>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">提交Bug</span>
</div>
<div style="border:1px solid #d6e1ea">
    <form method='post' enctype='multipart/form-data' id='dataform'>
        <input type="hidden" name="product" value="1" id="product" />
        <?php if($bug):?>
        <input type="hidden" name="copyid" value="<?php echo $bug->id;?>" id="copyid" />
        <input type="hidden" name="copyFiles" value="1" id="product" />
        <?php endif;?>
        <table class='table-1 bd-none' style="width:75%">
            <tr>
                <th class="bugeditRH"><?php echo $lang->bug->title; ?></th>
                <td><?php echo html::input('title', $bugTitle, "class='text-1'"); ?></td>
            </tr>
            <tr>
                <th class="bugeditRH"><?php echo $lang->bug->severity; ?></th>
                <td><?php echo html::radio('severity', $lang->bug->severityList, 1); ?></td>
            </tr>
            <tr>
                <th class="bugeditRH"><?php echo $lang->bug->project; ?></th>
                <td><span id='projectIdBox'><?php echo html::select('project', $crt_projects, $projectID, 'class=select-3 autocomplete="off" onchange="loadProjectRelativeData(this.value)"'); ?></span></td>
            </tr>
            <tr>
                <th class="bugeditRH">所属模块</th>
                <td>
                    <span id='moduleIdBox'><?php echo html::select('module', $moduleOptionMenu, $moduleID, "class=select-3"); ?></span>
                </td>
            </tr>  
            <tr>
                <th class="bugeditRH"><?php echo $lang->bug->openedBuild; ?></th>
                <td>
                    <span id='buildBox'>
                        <?php echo html::select('openedBuild', $builds, $buildID, 'class=select-3'); ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th class="bugeditRH"><nobr><?php echo $lang->bug->lblAssignedTo; ?></nobr></th>
            <td><span id='assignedToBox'><?php echo html::select('assignedTo', $projectMembers, $assignedTo, 'class=select-3'); ?></span></td>
            </tr>
            <tr>
                <th class="bugeditRH" style='vertical-align:top;'><?php echo $lang->bug->steps; ?></th>
                <td>
                    <div style='position:relative'>
                        <div class='bd-none padding-zero f-left' style='width:86%;'><?php echo html::textarea('steps', $bug ? $bug->steps : '', "style='width:89.5%;height:400px;'"); ?></div>
                        <div class='bd-none' id='tplBox' style="width:10%"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="bugeditRH"><?php echo $lang->bug->files; ?></th>
                <td>
                    <?php if($bug) echo $this->fetch('file', 'printFiles', array('files' => $bug->files)); ?>
                    <?php echo $this->fetch('file', 'buildform', 'fileCount=1&percent=0.85'); ?>
                </td>
            </tr>  
            <tr>
                <th></th>
                <td class='a-center'>
                    <input type='submit' id='submit' value='提交' onclick="if($('#title').val() === '') {alert('标题不能为空!'); return false;}" class='button-s' />
                    <?php echo html::backButton() . html::hidden('case', $caseID); ?>
                </td>
            </tr>

            <tr>
                <th class="bugeditRH"> </th>
                <td> </td>
            </tr>   
        </table>
    </form>
</div>
<?php include '../../common/view/footer.html.php'; ?>
