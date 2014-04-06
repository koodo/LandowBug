<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
if($config->debug)
{
    css::import($defaultTheme . 'chosen.css');
    js::import($jsRoot . 'jquery/chosen/chosen.min.js');
}
?>
<style>
#colorbox, #cboxOverlay, #cboxWrapper{z-index:9999;}
</style>
<script> 
noResultsMatch    = '<?php echo $lang->noResultsMatch;?>';
chooseUsersToMail = '<?php echo $lang->chooseUsersToMail;?>';
$(document).ready(function()
{
    $("#mailto").attr('data-placeholder', chooseUsersToMail);
    $("#productID").chosen({no_results_text: noResultsMatch});
    $("#projectID").chosen({no_results_text: noResultsMatch});
});
</script>
