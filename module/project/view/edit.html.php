<?php
/**
 * The edit view of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: edit.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/datepicker.html.php'; ?>
<?php js::import($jsRoot . 'misc/date.js'); ?>
<?php $isRoot = common::isAdmin(); ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>project_edit.js"></script>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">编辑项目 <?php echo $project->name; ?></span>
</div>
<div>
    <form method='post' target='hiddenwin' id='dataform' style="margin:0;padding:0;">
        <input name="products[]" value="[0]" type="hidden" />
        <input value="<?php echo $project->id; ?>" type="hidden" id="projectid" />
        <table align='center' class='table-1 a-left prjTable'> 
            <tr>
                <th class='rowhead'> </th>
                <td> </td>
            </tr>  
            <tr>
                <th class='rowhead'><?php echo $lang->project->name; ?></th>
                <td><?php echo html::input('name', $project->name, "class='text-3'"); ?></td>
            </tr>  
            <tr>
                <th class='rowhead'><?php echo $lang->project->code; ?></th>
                <td><?php echo html::input('code', $project->code, "class='text-3'"); ?></td>
            </tr>
            <tr>
                <th class='rowhead'>负责团队</th>
                <td><?php echo html::select('pteam', $pteam, $project->teamid, "class='select-3' onchange=\"loadTeamMembersData('sl', this.value, loadCallback);\""); ?></td>
            </tr>  
            <tr>
                <th class='rowhead' style="vertical-align:top">项目成员</th>
                <td >
                    <table align='center' class='table-1 a-left' style="border:none;">
                        <tr>
                            <td>
                                <div class="left">
                                    <p class="Smallbox Black">团队成员</p>
                                    <select id="sl" class="w-140px" style="height: 150px;" multiple="multiple"></select>                                
                                </div>
                                <div class="left" style="padding-top:70px;margin:0 20px;">
                                    <div>
                                        <button type="button" onclick="SelectAdd()">添加 ></button> 
                                    </div>
                                    <br/>
                                    <div>
                                        <button type="button" onclick="SelectDel()">删除 <</button>
                                    </div>
                                </div>
                                <div class="left" id="members">
                                    <p class="Smallbox Green"> 已选成员</p>
                                    <select id="sr" class="w-140px" style="height: 150px;" multiple="multiple">
                                        <?php foreach ($members as $value => $name) { ?>
                                        <?php if($name->account == $project->openedBy && $name->isadmin == 1){?>
                                        <option value="<?php echo $name->account ?>" disabled="disabled"><?php echo $name->realname; ?></option>
                                        <?php } else {?>
                                        <option value="<?php echo $name->account ?>" class="removeable"><?php echo $name->realname; ?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                                <div class="left" style="padding-top:70px;margin:0 20px;">
                                    <div>
                                        <button type="button" onclick="SelectAdd1()" >添加 ></button> 
                                    </div>
                                    <br/>
                                    <div>
                                        <button type="button" onclick="SelectDel1()" >删除 <</button>
                                    </div>
                                </div>
                                <div class="left">
                                    <p class="Smallbox Green"> 管理员</p>
                                    <select id="sr1" class="w-140px" style="height: 150px;" multiple="multiple">
                                        <?php foreach ($members as $index => $name) :?>
                                        <?php if ($name->isadmin == 1 && $name->account == $project->openedBy) { ?>
                                        <option value="<?php echo $name->account ?>" disabled="disabled"><?php echo $name->realname; ?></option>
                                        <?php } else if ($name->isadmin == 1) { ?>
                                        <option value="<?php echo $name->account ?>" class="removeable"><?php echo $name->realname; ?></option>
                                        <?php } endforeach;?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='a-center'><?php echo html::submitButton("保存","onclick='javascript:if(!editProjectSubmit()) return false;'") . html::backButton(); ?></td>
            </tr>        
            <tr>
                <th class='rowhead'> </th>
                <td> </td>
            </tr>
        </table>
    </form>
</div>
<table class='table-1 a-left bd-none'>
    <td style="padding:0;vertical-align:top;">
        <table id="ul_version" class="Bug box fixed" width="98%" border="1" cellspacing="0" cellpadding="10">
            <input type="hidden" id="projectid" value="<?php echo $projectid; ?>"/>
            <tbody>
                <tr class="colhead">
                    <th colspan="6">版本</th>
                    <th colspan="2" align="center">修改</th>
                    <th colspan="2" align="center">删除</th>
                </tr>
                <?php foreach ($builds as $opt2) : ?>
                    <tr id="build_<?php echo $opt2->id ?>">
                        <td colspan="6" id="build_name_<?php echo $opt2->id ?>"><?php echo $opt2->name; ?></td>
                        <td colspan="2"><a href="javascript:EditV(<?php echo $opt2->id ?>)"><img src="theme/default/images/alert/pencil.gif"></a></td>
                        <td colspan="2"><a href="javascript:DelV(<?php echo $opt2->id ?>)"><img src="theme/default/images/alert/delete_icon.gif"></a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="10"><button type="button" onclick="AddVersion(this)" >添加</button></td>
                </tr>
            </tbody>
        </table>
    </td>
    <td style="padding:0;vertical-align:top;">
        <table id="ul_moudle" class="Bug box fixed" width="98%" border="1" cellspacing="0" cellpadding="10">
            <tbody>
                <tr class="colhead">
                    <th colspan="3"><b>模块</b></th>
                    <th colspan="3"><b>处理人</b></th>
                    <th colspan="2"><b>修改</b></th>
                    <th colspan="2"><b>删除</b></th>
                </tr>
                <?php foreach ($modules as $opt1) : ?>
                    <tr id="module_<?php echo $opt1->mid ?>">
                        <td colspan="3" id="module_name_<?php echo $opt1->mid ?>"><?php echo $opt1->mname; ?></td>
                        <td colspan="3" id="module_user_<?php echo $opt1->mid ?>"><?php echo $users[$opt1->assignto]; ?></td>
                        <td colspan="2" id="module_edit_<?php echo $opt1->mid ?>"><a href="javascript:EditMD(<?php echo $opt1->mid ?>)"><img src="theme/default/images/alert/pencil.gif"></a></td>
                        <td colspan="2" id="module_delete_<?php echo $opt1->mid ?>"><a href="javascript:DelMD(<?php echo $opt1->mid ?>)"><img src="theme/default/images/alert/delete_icon.gif"></a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="10"><button type="button" onclick="AddModule(this)" >添加</button></td>
                </tr>
            </tbody>
        </table>
    </td>
</table>
<?php include '../../common/view/footer.html.php'; ?>
