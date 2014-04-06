<?php
$sessionString = $config->requestType == 'PATH_INFO' ? '?' : '&';
$sessionString .= session_name() . '=' . session_id();
?>
<style>.button-c {padding:1px}</style>
<script language='Javascript'>
    $(function() {
        $(".edit").colorbox({width: 400, height: 200, iframe: true, transition: 'none', scrolling: true});
    })

    /* Delete a file. */
    function deleteFile(fileID)
    {
        if (!fileID)
            return;
        $('#hiddenwin').attr('src', createLink('file', 'delete', 'fileID=' + fileID));
    }
    /* Download a file, append the mouse to the link. Thus we call decide to open the file in browser no download it. */
    function downloadFile(fileID)
    {
        if (!fileID)
            return;
        var sessionString = '<?php echo $sessionString; ?>';
        var url = createLink('file', 'download', 'fileID=' + fileID + '&mouse=left') + sessionString;
        window.open(url, '_blank');
        return false;
    }
</script>
    <?php if ($fieldset == 'true'): ?>
    <fieldset>
        <legend><?php echo $lang->file->common; ?></legend>
        <?php endif; ?>
    <div>
        <?php
        $this->loadModel("project");
        foreach ($files as $file) {
            echo html::a($this->createLink('file', 'download', "fileID=$file->id") . $sessionString, $file->title, '_blank', "onclick='return downloadFile($file->id)'");
            if ($this->project->isProjectAdmin($app->user->account,$this->cookie->lastProject))
                echo "<a class='link-icon' href='###' onclick='deleteFile($file->id)'><i class='icon-remove' style='font-size:14px !important;'></i></a>";
            echo '<br />';
        }
        ?>
    </div>
<?php if ($fieldset == 'true') echo '</fieldset>'; ?>
