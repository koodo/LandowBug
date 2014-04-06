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
<?php include '../../common/view/header.html.php'; ?>
<div id='titlebar'>
    <div style="float:left;text-align:left;font-size:16px;word-wrap:break-word;width:100%;" <?php if ($bug->deleted) echo "class='deleted'"; ?>>
        <?php echo $bug->id . '#&nbsp;' . $bug->title; ?>
    </div>
    <div style="width:auto;line-height:20px;">
        <?php
        $browseLink = $app->session->bugList != false ? $app->session->bugList : inlink('browse', "productID=$bug->product");
        $params = "bugID=$bug->id";
        $copyParams = "productID=$productID&extras=bugID=$bug->id";
        $convertParams = "productID=$productID&moduleID=0&from=bug&bugID=$bug->id";
        $_status = $bug->status;
        $_confirmed = $bug->confirmed;
        if ($config->debug) {
            #var_dump('status ' . $_status);
            #var_dump('confirmed ' . $_confirmed);
        }
        if (!$bug->deleted) {
            ob_start();
            // css CLass
            $class = 'iframe bug-view-btn';
            $isRoot = common::isAdmin();
            $isAdmin = $this->project->isProjectAdmin($app->user->account, $bug->project) || $isRoot;
            $isSelf = $app->user->account === $bug->openedBy;

            if ($app->user->account == $bug->assignedTo) {
                // 解决
                common::printIcon('bug', 'resolve', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-fix', true);
                // 指派
                common::printIcon('bug', 'assignTo', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-assignto', true);
            }

            // 关闭
            if ($isAdmin || $isSelf)
                common::printIcon('bug', 'close', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-close', true);

            // 审核处理按钮
            if ($isSelf) {
                common::printIcon('bug', 'confirmBug', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-fix', true);
                common::printIcon('bug', 'recheck', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-recheck', true);
            }

            // 激活
            if ($isAdmin) {
                common::printIcon('bug', 'suspend', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-suspend', true);
                common::printIcon('bug', 'activate', $params, $bug, 'button', '', '', $class . 'ld-btn ldbtn-activate', true);
                common::printIcon('bug', 'delete', $params, $bug, 'button', '', 'hiddenwin', 'ld-btn ldbtn-delete');
            }

            if ($isAdmin || $app->user->account == $bug->openedBy) {
                common::printIcon('bug', 'edit', $params, $bug, 'button', '', '', 'ld-btn ldbtn-edit', false);
            }
            // 返回按钮
            if ($bug->status != 'resolved') {
                echo "<span class=\"link-button\"><a href=\"javascript:;\" onclick=\"javascript:history.go(-1);\" title=\"返回\" class=\"ldbtn-goback\">返回</a></span>";
            } else if ($bug->status == 'resolved') {
                common::printIcon('bug', 'create', $copyParams, '', 'button', 'copy' ,'', 'ld-btn ldbtn-edit', false);
            }
            $actionLinks = ob_get_contents();
            ob_end_clean();
            echo $actionLinks;
        } else {
            // 页面导航按钮
            common::printRPN($browseLink);
        }
        ?>
    </div>
</div>
<form>
    <table class='table-1 bug-view-table colored' style="table-layout:fixed">   
        <tr>
            <th class='rowhead'> </th>
            <td> </td>
        </tr>
        <tr>
            <th class='rowhead'>所属项目</th>
            <td><?php echo $bug->projectName; ?></td>
        </tr>
        <!--
        <tr>
            <th class='rowhead'><?php echo $lang->bug->title; ?></th>
            <td><?php if ($bug->deleted) echo "class='deleted'"; ?><?php echo $bug->id . '# &nbsp;&nbsp' . $bug->title; ?></td>
        <tr>
        -->
        <th class='rowhead'>提交时间</th>
        <td><?php if ($bug->assignedTo) echo common::tTimeFormat(strtotime($bug->assignedDate)); ?></td>
        </tr>
        <tr>
            <th class='rowhead'><?php echo $lang->bug->module; ?></th>
            <td colspan="1"><?php echo $module->mname; ?></td>
        </tr>
        <tr>
            <th class='rowhead'><?php echo $lang->bug->openedBuild; ?></th>
            <td>
                <?php
                if ($bug->openedBuild) {
                    $openedBuilds = explode(',', $bug->openedBuild);
                    foreach ($openedBuilds as $openedBuild)
                        isset($builds[$openedBuild]) ? print($builds[$openedBuild] . '<br />')  : print($openedBuild . '<br />');
                } else {
                    echo $bug->openedBuild;
                }
                ?>
            </td>
        </tr>
        <tr>
            <th class='rowhead'><?php echo $lang->bug->severity; ?></th>
            <td><b class='<?php echo 'severity' . $bug->severity; ?>'><?php echo common::bug_serverity($bug->severity); ?></b></td>
        </tr>    
        <tr>
            <th class='rowhead'><?php echo $lang->bug->status; ?></th>
            <td><strong><?php echo $lang->bug->statusList[$bug->status]; ?></strong></td>
        </tr>
        <tr>
            <th class='rowhead'><?php echo $lang->bug->openedBy; ?></th>
            <td> <?php echo $users[$bug->openedBy] ?></td>
        </tr>
        <tr>
            <th class='rowhead'>处理人</th>
            <td><?php if ($bug->assignedTo) echo $users[$bug->assignedTo] ?>
        </tr>        
        <tr>
            <th class='rowhead' style="vertical-align:top;"><?php echo $lang->bug->steps; ?></th>
            <td class="bug-view-content" ><?php echo $bug->steps; ?></td>
        </tr>
        <?php if (($bug->files !== NULL) && !empty($bug->files)) { ?>
            <tr>
                <th class='rowhead'><?php echo $lang->bug->files; ?></th>
                <td style="word-wrap:break-word">
                    <?php echo $this->fetch('file', 'printFiles', array('files' => $bug->files)); ?>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th class='rowhead' style="vertical-align:top;">历史记录</th>
            <td colspan="1">
                <?php include '../../common/view/action.html.php'; ?>
                <!--<div class='a-center actionlink'><?php #if(!$bug->deleted) echo $actionLinks;         ?></div>-->
                <div id='commentBox' class='hidden'>
                    <fieldset>
                        <legend><?php echo $lang->comment; ?></legend>
                        <form method='post' action='<?php echo inlink('edit', "bugID=$bug->id&comment=true") ?>'>
                            <table align='center' class='table-1'>
                                <tr><td><?php echo html::textarea('comment', '', "rows='5' class='w-p100'"); ?></td></tr>
                                <tr><td><?php echo html::submitButton() . html::backButton(); ?></td></tr>
                            </table>
                        </form>
                    </fieldset>
                </div>        
            </td>
        </tr>
    </table>
</form>
<?php include '../../common/view/syntaxhighlighter.html.php'; ?>
<?php include '../../common/view/footer.html.php'; ?>
