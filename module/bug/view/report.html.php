<?php
/**
 * The report view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: report.html.php 4657 2013-04-17 02:01:26Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/colorize.html.php'; ?>
<?php css::import($defaultTheme . 'calendar_style.css', ''); ?>
<script type="text/javascript" src="<?php echo $jsRoot; ?>ShowCalendar.js"></script>
<div id='featurebar' class='featurebar-bug' style="height:auto;padding:10px 15px;">
    <form method="POST">
        <span class="left icon_biger">
            <label style="margin-right: 15px;"> 日期</label>
            <input type="text" onclick="new TSCalendar(0).show(this);" value="<?php echo $time_from; ?>" name="time_from">
            至
            <input type="text" onclick="new TSCalendar(0).show(this);" value="<?php echo $time_to; ?>" name="time_to">
        </span>
        <input type="hidden" name="charts[]" value="bugsPerSeverity" />
        <input type="hidden" name="charts[]" value="bugsPerBuild" />
        <input type="hidden" name="charts[]" value="bugsPerModule" />
        <input type="hidden" name="charts[]" value="bugsPerStatus" />
        <input type="hidden" name="charts[]" value="bugsPerAssignedTo" />
        <input type="submit" value="提交"/>
    </form>
</div>
<table class='table-8'>
    <?php foreach ($charts as $chartType => $chartContent): ?>
        <tr valign='top'>
            <td width="68%"><?php echo $chartContent; ?></td>
            <td width='30%'>
                <?php $height = zget($lang->bug->report->$chartType, 'height', $lang->bug->report->options->height) . 'px'; ?>
                <div style="height:<?php echo $height; ?>; overflow:auto">
                    <table class='table-8 colored'>
                        <caption><?php echo $lang->bug->report->charts[$chartType]; ?></caption>
                        <tr>
                            <th><?php echo $lang->report->item; ?></th>
                            <th><?php echo $lang->report->value; ?></th>
                            <th><?php echo $lang->report->percent; ?></th>
                        </tr>
                        <?php foreach ($datas[$chartType] as $key => $data): ?>
                            <tr class='a-center'>
                                <td><?php echo $data->name; ?></td>
                                <td><?php echo $data->value; ?></td>
                                <td><?php echo ($data->percent * 100) . '%'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php echo $renderJS; ?>
<?php include '../../common/view/footer.html.php'; ?>
