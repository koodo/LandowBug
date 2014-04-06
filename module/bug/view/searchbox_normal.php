<div id='featurebar' class='featurebar-bug' style="height:auto;padding:10px 15px;">
    <form action="" method="GET">
        <input type="hidden" value="1" name="search_reset" />
        <input type="hidden" value="true" name="search_on" />
        <label for="search_severity">优先级</label>
        <?php echo html::select('search_severity', common::convSelectDefault($lang->bug->severityList), $searchSeverity, 'class="select-2"'); ?>
        &nbsp;
        <label for="search_severity">状态</label>
        <?php echo html::select('search_status', common::convSelectDefault($lang->bug->_statusList), $searchStatus, 'class=select-2'); ?>
        &nbsp;
        <label for="search_key">关键字</label>
        <input type="text" name="search_key" value="<?php echo $searchKey; ?>"/>
        <input type="submit" value="提交" style="height:30px;line-height:30px;padding:0 12px;"/>
    </form>
</div>