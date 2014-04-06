<?php
/**
 * The report view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: report.html.php 1594 2011-03-13 07:27:55Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">团队列表</span>
    <div  style="float:right;line-height:45px;">
        <a href="<?php echo helper::createLink('team','create');?>" target="" id="submenucreate"><i class="icon-green-bug-create" style="width:0;"></i>&nbsp;添加团队</a>
    </div>
</div>
<table align='center' class='table-1' id='memberList'>
    <thead>
        <tr class='colhead'>
            <th>团队名称</th>
            <th>加入日期</th>
            <th>是否创建者</th>
            <th>是否管理员</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teams as $team): ?>
            <?php
            $isAdmin = $app->user->account == $team->admin;
            $isCreator = $app->user->account == $team->creator;
            ?>
            <tr class='a-center'>
                <td><?php echo html::a(helper::createLink('team', 'view', 'teamid=' . $team->tid), $team->tname); ?></td>
                <td><?php echo $team->date; ?></td>
                <td><?php echo $isCreator ? '是' : '否'; ?></td>
                <td><?php echo $isAdmin ? '是' : '否'; ?></td>
                <td>
                    <?php
                    if ($isAdmin) {
                        echo html::a(helper::createLink('project', 'create', 'teamid=' . $team->tid), '[创建项目]');
                        echo html::a(helper::createLink('team', 'view', 'teamid=' . $team->tid), '[编辑]');
                    } else {
                        echo html::a(helper::createLink('team', 'quit'), '[退出团队]');
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!--
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:6px">团队列表</span>
    <div  style="float:right;line-height:45px;">
        <a href="<?php echo helper::createLink('team','create');?>" target="" id="submenucreate"><i class="icon-green-bug-create" style="width:0;"></i>&nbsp;添加团队</a>
    </div>
</div>
<div class="Bugicon Midbox"> Bug统计</div>
<div>
<table class='cont-lt1'>
  <tr valign='top'>
    <td class='side'>
      <div class='box-title'><?php echo $lang->story->report->select;?></div>
      <div class='box-content'>
        <form method='post'>
        <?php echo html::checkBox('charts', $lang->story->report->charts, $checkedCharts);?>
        <?php echo html::selectAll();?>
        <?php echo html::selectReverse();?>
        <br /><br />
        <?php echo html::submitButton($lang->story->report->create);?>
      </div>
    </td>
    <td class='divider'></td>
    <td>
      <table class='table-1'>
        <caption>
          <div class='f-left'><?php echo $lang->story->report->common;?></div>
          <div class='f-right'><?php echo html::a($this->createLink('product', 'browse', "productID=$productID&browseType=$browseType&moduleID=$moduleID"), $lang->goback); ?></div>
        </caption>
        <?php foreach($charts as $chartType => $chartContent):?>
        <tr valign='top'>
          <td><?php echo $chartContent;?></td>
          <td width='300'>
            <div style="height:<?php echo $lang->story->report->options->height . 'px';?>; overflow:auto">
              <table class='table-1 colored'>
                <caption><?php echo $lang->story->report->charts[$chartType];?></caption>
                <tr>
                  <th><?php echo $lang->story->report->$chartType->item;?></th>
                  <th><?php echo $lang->story->report->value;?></th>
                  <th><?php echo $lang->report->percent;?></th>
                </tr>
                <?php foreach($datas[$chartType] as $key => $data):?>
                <tr class='a-center'>
                  <td><?php echo $data->name;?></td>
                  <td><?php echo $data->value;?></td>
                  <td><?php echo ($data->percent * 100) . '%';?></td>
                </tr>
                <?php endforeach;?>
              </table>
            </div>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
    </td>
  </tr>
</table>
</div>-->
<?php echo $renderJS;?>
<?php include '../../common/view/footer.html.php';?>
