<div id='fileform'>
    <?php
    /* Define the html code of a file row. */
    $fileRow = <<<EOT
  <div class='fileBox' id='fileBox\$i'>
    <input type='file' name='files[]' class='fileControl'  tabindex='-1' />
    <!--<label tabindex='-1' class='fileLabel'>{$lang->file->label}</label>-->
    <input type='hidden' name='labels[]' class='text-3' tabindex='-1' /> 
    <a href='javascript:void();' onclick='addFile(this)' class='link-icon'><i class='icon-add'></i></a>
    <a href='javascript:void();' onclick='delFile(this)' class='link-icon'><i class='icon-delete'></i></a>
  </div>
EOT;
    for ($i = 1; $i <= $fileCount; $i ++)
        echo str_replace('$i', $i, $fileRow);
    ?>
</div>
<script language='javascript'>
    $(function()
    {
        var maxUploadInfo = maxFilesize();
        parentTag = $('#fileform').parent();
        if (parentTag.attr('tagName') == 'TD')
            parentTag.parent().find('th').append(maxUploadInfo);
        if (parentTag.attr('tagName') == 'FIELDSET')
            parentTag.find('legend').append(maxUploadInfo);
    });

    /**
     * Show the upload max filesize of config.  
     */
    function maxFilesize() {
        return "(<?php printf($lang->file->maxUploadSize, ini_get('upload_max_filesize')); ?>)";
    }

    /**
     * Set the width of the file form.
     * 
     * @param  float  $percent 
     * @access public
     * @return void
     */
    function setFileFormWidth(percent)
    {
        totalWidth = Math.round($('#fileform').parent().width() * percent);
        titleWidth = totalWidth - $('.fileControl').width() - $('.fileLabel').width() - $('.icon').width();
        if ($.browser.mozilla)
            titleWidth -= 8;
        if (!$.browser.mozilla)
            titleWidth -= 12;
        $('#fileform .text-3').css('width', titleWidth + 'px');
    }
    ;

    /**
     * Add a file input control.
     * 
     * @param  object $clickedButton 
     * @access public
     * @return void
     */
    function addFile(clickedButton)
    {
        fileRow = <?php echo json_encode($fileRow); ?>;
        fileRow = fileRow.replace('$i', $('.fileID').size() + 1);
        $(clickedButton).parent().after(fileRow);

        setFileFormWidth(<?php echo $percent; ?>);
        updateID();
    }

    /**
     * Delete a file input control.
     * 
     * @param  object $clickedButton 
     * @access public
     * @return void
     */
    function delFile(clickedButton)
    {
        if ($('.fileBox').size() === 1) {
            var control = $('.fileControl').eq(0);
            control.replaceWith(control = control.clone(true));
        } else {
            $(clickedButton).parent().remove();
            updateID();
        }
    }

    /**
     * Update the file id labels.
     * 
     * @access public
     * @return void
     */
    function updateID()
    {
        i = 1;
        $('.fileID').each(function() {
            $(this).html(i++)
        });
    }

    $(function() {
        setFileFormWidth(<?php echo $percent; ?>)
    });
</script>
