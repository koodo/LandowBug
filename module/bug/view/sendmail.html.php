<?php
/**
 * The mail file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: sendmail.html.php 4626 2013-04-10 05:34:36Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
$onlybody = isonlybody() ? true : false;
if($onlybody) $_GET['onlybody'] = 'no';
?>
<table width='98%' align='center'>
    <tr>
        <td style="font-size:14px;font-family:微软雅黑">
            <?php echo $bug->openedBy .'在 ['. "{$project} ]".'创建了新的Bug';?>
        </td>
    </tr>
    <tr>
        <td style="font-size:14px;font-family:微软雅黑">
            标题：<?php echo html::a(common::getSysURL() . $this->createLink('bug', 'view', "bugID=$bug->id"), 'BUG #' . $bug->id . ' ' . $bug->title);?>
        </td> 
    </tr>
    <tr>
        <td style="font-size:14px;font-family:微软雅黑">
            模块：<?php echo $bug->module->mname; ?>
        </td>
    </tr>
    <tr>
        <td style="font-size:14px;font-family:微软雅黑">
            优先级：<?php echo $lang->bug->severityList[$bug->severity];?>
        </td>
    </tr>
    <tr></tr>
    <tr>
        <td style="font-size:14px;font-family:微软雅黑">
            指定处理人：<?php echo $users[$bug->assignedTo];?>
        </td>
    </tr>
    <!--
  <tr class='header'>
    <td>
      <?php echo $project . '这个是项目';?>
      BUG #<?php echo $bug->id . "=>{$users[$bug->assignedTo]} " . html::a(common::getSysURL() . $this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?>
    </td>
  </tr>
    -->
  <!--
  <tr>
    <td>
    <fieldset>
      <legend><?php echo $lang->bug->legendSteps;?></legend>
      <div class='content'>
      <?php 
      if(strpos($bug->steps, 'src="data/upload'))
      {
        $bug->steps = preg_replace('/<img (.*) src="/', '<img $1 src="http://' . $this->server->http_host . $this->config->webRoot, $bug->steps);
      }
      echo $bug->steps;
      ?>
      </div>
    </fieldset>
    </td>
  </tr>
  -->
  <!--
  <tr>
    <td><?php include '../../common/view/mail.html.php';?></td>
  </tr>
  -->
</table>
<?php if($onlybody) $_GET['onlybody'] = 'yes';?>
