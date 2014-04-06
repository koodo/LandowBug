<div id='featurebar' class='featurebar-bug' style="height:auto;padding:10px 15px;">
    <form action="" method="GET">
        <input type="hidden" value="1" name="search_reset" />
        <input type="hidden" value="true" name="search_on" />
        <label for="search_severity">优先级</label>
        <?php echo html::select('search_severity', common::convSelectDefault($lang->bug->severityList), $searchSeverity, 'class="select-2"'); ?>
        &nbsp;
        <label for="search_openedby">分配人</label>
        <?php echo html::select('search_openedby', common::convSelectDefault($members), $_GET['search_openedby'], 'class=select-2'); ?>
        &nbsp;
        <label for="search_module" style="width:42px;display:inline-block;">模块</label>
        <?php echo html::select('search_module', common::convSelectDefault($modules), $_GET['search_module'], "class=select-2"); ?>
        &nbsp;
        <br />
        <label for="search_status" style="width:42px;display:inline-block;">状态</label>
        <?php echo html::select('search_status', common::convSelectDefault($lang->bug->_statusList), $searchStatus, 'class=select-2'); ?>
        &nbsp;
        <label for="search_assignto">处理人</label>
        <?php echo html::select('search_assignto', common::convSelectDefault($members), $_GET['search_assignto'], 'class=select-2'); ?>
        &nbsp;
        <label for="search_key">关键字</label>
        <input type="text" name="search_key" style="width:115px;" value="<?php echo $searchKey; ?>"/>
        <input type="submit" value="提交" style="height:30px;line-height:30px;padding:0 12px;"/>
    </form>
</div>