<?php
/**
 * The html template file of execute method of convert module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     convert
 * @version     $Id: execute.html.php 4129 2013-01-18 01:58:14Z wwccss $
 */
?>
<?php include '../../common/view/header.html.php';?>
<table align='center' class='f-14px'>
  <caption><?php echo $lang->convert->execute . $lang->colon . strtoupper($source);?></caption>
  <?php echo $executeResult;?>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>
