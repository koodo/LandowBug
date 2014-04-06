<script language='Javascript'>
setTemplateTitle = '<?php echo $lang->bug->setTemplateTitle;?>';
KindEditor.lang({'savetemplate' : '<?php echo $lang->bug->saveTemplate;?>'});
</script>
<?php 
foreach($templates as $key => $template)
{
    echo "<span id='tplBox$template->id'>";
    echo '<nobr>' . $lang->arrow. " <span id='tplTitleBox$template->id' onclick='setTemplate($template->id)' style='text-decoration:underline; color:blue' class='hand'>$template->title</span>";
    echo "&nbsp; <a href='javascript:void();' onclick='deleteTemplate($template->id)' class='link-icon'><i class='icon-remove icon-sm'></i></a></nobr>";
    echo "<span id='template$template->id' class='hidden'>$template->content</span>";
    echo '<br /></span>';
}
