<?php
/**
 * The create view of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php if (isset($tips)): ?>
    <?php include '../../common/view/header.lite.html.php'; ?>
    <?php include '../../common/view/colorbox.html.php'; ?>
    <body style='background:white'>
        <script language='Javascript'>
            var tips = <?php echo json_encode($tips); ?>;
            var projectID = <?php echo $projectID; ?>;
            defaultURL = createLink('project', 'task', 'projectID=' + projectID);
            $(document).ready(function()
            {
                $.fn.colorbox({html: tips, open: true, transition: 'none', width: 450, height: 250, onCleanup: function() {
                        parent.location.href = defaultURL;
                    }});
            });
        </script>
    </body>
    </html>
    <?php exit; ?>
<?php endif; ?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/datepicker.html.php'; ?>
<?php js::import($jsRoot . 'misc/date.js'); ?>
<?php js::set('holders', $lang->project->placeholder); ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>project_create.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">新建项目</span>
</div>
<form method='post' target='hiddenwin' id='dataform' style="margin:0;padding:0;">
    <input name="products[]" value="[0]" type="hidden" />
    <input name="days" value="0" type="hidden" />
    <table align='center' class='table-1 a-left prjTable'>
        <?php if ($projects): ?>
            <tr>
                <th class='rowhead'> </th>
                <td> </td>
            </tr>  
            <tr id='copyProjectBox' <?php if ($copyProjectID == 0) echo "class='hidden'"; ?>>
                <th class='rowhead'><?php echo $lang->project->copy; ?></th>
                <td><?php echo html::select('', $projects, $copyProjectID, "class='select-3' onchange=setCopyProject(this.value)"); ?></td>
            </tr>  
        <?php endif; ?>
        <tr>
            <th class='rowhead' style="padding-left:25px;"><?php echo $lang->project->name; ?></th>
            <td><?php echo html::input('name', $name, "class='text-3'"); ?></td>
        </tr>  
        <tr>
            <th class='rowhead' style="padding-left:25px;"><?php echo $lang->project->code; ?></th>
            <td><?php echo html::input('code', $code, "class='text-3'"); ?></td>
        </tr> 
        <tr>
            <th class='rowhead' style="padding-left:25px;">负责团队</th>
            <td><?php echo html::select('pteam', $pteam, $teamid, "class='select-3' onchange=\"loadTeamMembersData('sl', this.value, loadCallback)\""); ?></td>
        </tr>  
        <!--
        <?php foreach ($users as $value => $name) { ?>
                            <option value="<?php echo $value ?>"><?php echo $value; ?></option>
        <?php } ?>
        -->
        <tr>
            <th class='rowhead' style="vertical-align: top;padding-left:25px">项目成员</th>
            <td>
                <div class="left">
                    <p class="Smallbox Black">团队成员</p>
                    <select id="sl" class="w-160px" style="height: 150px;" multiple="multiple"></select>
                </div>
                <div class="left" style="padding-top:70px;margin:0 20px;">
                    <div>
                        <button type="button" onclick="SelectAdd()" >添加 ></button> 
                    </div>
                    <br />
                    <div>
                        <button type="button" onclick="SelectDel()" >删除 <</button>
                    </div>
                </div>
                <div class="left" id="members">
                    <p class="Smallbox Green"> 已选成员</p>
                    <select id="sr" class="w-160px" style="height: 150px;" multiple="multiple"></select>
                </div>
                <div class="left" style="padding-top:70px;margin:0 20px;">
                    <div>
                        <button type="button" onclick="SelectAdd1()" >添加 ></button> 
                    </div>
                    <br />
                    <div>
                        <button type="button" onclick="SelectDel1()" >删除 <</button>
                    </div>
                </div>
                <div class="left">
                    <p class="Smallbox Green"> 管理员</p>
                    <select id="sr1" class="w-160px" style="height: 150px;" multiple="multiple"></select>
                </div>
            </td>
        </tr>
        <tr id='whitelistBox' class='hidden'>
            <th class='rowhead'><?php echo $lang->product->whitelist; ?></th>
            <td><?php echo html::checkbox('whitelist', $groups); ?></td>
        </tr>  
        <tr>
            <th class='rowhead'> </th>
            <td colspan='1' class='a-center'><?php echo html::submitButton("保存","onclick='javascript:if(!createProjectSubmit()) return false;'") . html::backButton(); ?></td>
        </tr>        
        <tr>
            <th class='rowhead'> </th>
            <td> </td>
        </tr>  
        <input type="hidden" value="<?php echo $teamid; ?>" id="teamid" />
        <input type="hidden" value="open" name="acl" />
        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="begin" />
    </table>
</form>
<?php include '../../common/view/footer.html.php'; ?>
