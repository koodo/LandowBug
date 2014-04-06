<?php
if ($extView = $this->getExtViewFile(__FILE__)) {
    include $extView;
    return helper::cd();
}
include 'header.lite.html.php';
include 'colorbox.html.php';
include 'chosen.html.php';
?>
<?php if (empty($_GET['onlybody']) or $_GET['onlybody'] != 'yes'): ?>
    <div id="header-top">
        <div class="sdWidth">
            <div style="margin-top:4px;">
                <?php commonModel::printTopBar(); ?>
            </div>
        </div>
    </div>
    <div id='header'>
        <div class="cont navbar ld_navtop sdWidth">
            <!--<a class="ld_logo" href="javascript:;" onclick="return false;"></a>-->
            <div class="f-left">
                <img src="/theme/default/images/ld/landow bug.png" width="149" style='float:left;margin:0;margin-top:22px;'/>
                <div style="margin-top:60px;margin-left: 0px;"><?php commonModel::printModuleMenu($this->moduleName); ?></div>
            </div>
            <?php if($this->moduleName != 'project' && $this->moduleName != 'team' && $this->moduleName != 'my'){ ?>
            <div class="ld_navright">
                <!--<div style="margin-top:42px;margin-left: 15px;float:left;"><?php commonModel::printModuleMenu($this->moduleName); ?></div>-->
                <div class="ld_navrightin">
                    <?php echo common::printTopBtns(common::dynProjectID($projectID), $this->moduleName, $this->methodName, $browseType); ?>
                    </span>
                </div>
            </div>
            <?php }?>
        </div>
        <table class='cont navbar sdWidth' id='navbar'>
            <tr>
                <td id='mainmenu'>
                    <?php
                    #commonModel::printMainmenu($this->moduleName);
                    #commonModel::printSearchBox(); 
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div id='wrap' class="sdWidth">
    <?php endif; ?>
    <div class='outer'>
        <div style="position:relative;margin-left:-20px;margin-top:-15px;padding-bottom:15px;"><div class="atr-bac-left"></div></div>
