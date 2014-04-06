<?php
/**
 * The html template file of index method of index module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: index.html.php 1947 2011-06-29 11:58:03Z wwccss $
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/sparkline.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php css::import($defaultTheme . 'index.css',   $config->version);?>
<div class="wrapper">
  <table class='cont' id='row1'>
    <tr valign='top'>
      <td width='66%' style='padding-right:20px'>
        <?php include './blockprojects.html.php';?>
        <?php include './blockbugs.html.php';?>
        <!--?php include './blockproducts.html.php';?-->
      </td>
      <td width='33%'>
          <?php if(common::hasPriv('company', 'dynamic')) include './blockdynamic.html.php';?>
          <?php include './blocktodoes.html.php';?>
      </td>
    </tr>
  </table>
  <?php include '../../common/view/footer.html.php';?>  
</div>

