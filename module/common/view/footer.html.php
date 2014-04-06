  </div>
  <?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <iframe frameborder='0' name='hiddenwin' id='hiddenwin' scrolling='no' class='<?php print($config->debug ? 'debugwin' : 'hidden');?>'></iframe>
  <div id='divider'></div>
<?php $onlybody = zget($_GET, 'onlybody', 'no');?>
<?php if($onlybody != 'yes'):?>
</div>
<!--
<div id='footer'>
  <div id="crumbs">
    <?php commonModel::printBreadMenu($this->moduleName, isset($position) ? $position : ''); ?>
  </div>
  <div id="poweredby">
    <!--<span>Powered by <a href='http://www.zentao.net' target='_blank'>ZenTaoPMS</a> (<?php #echo $config->version;?>)</span>
    <?php #echo $lang->proVersion; // 系统版本?>
    <?php #commonModel::printNotifyLink();?>
    <?php #commonModel::printQRCodeLink(); // 二维码手机登陆?>
  </div>
</div>
-->
<?php endif;?>
<?php 
js::set('onlybody', $onlybody);           // set the onlybody var.

if(isset($pageJS)) js::execute($pageJS);  // load the js for current page.

/* Load hook files for current page. */
$extPath      = dirname(dirname(dirname(realpath($viewFile)))) . '/common/ext/view/';
$extHookRule  = $extPath . 'footer.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
</body>
</html>
