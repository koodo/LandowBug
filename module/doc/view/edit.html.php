<?php
/**
 * The edit view of doc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     doc
 * @version     $Id: edit.html.php 975 2010-07-29 03:30:25Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<script language='javascript'>
var type = '<?php echo $doc->type;?>';
$(document).ready(function()
{
    setType(type);
});
</script>
<form method='post' enctype='multipart/form-data' target='hiddenwin' id='dataform'>
  <table class='table-1'> 
    <caption><?php echo $lang->doc->edit;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->doc->module;?></th>
      <td><?php echo html::select('module', $moduleOptionMenu, $doc->module, "class='select-3'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->doc->type;?></th>
      <td><?php echo $lang->doc->types[$doc->type];?></td>
    </tr>  
      <th class='rowhead'><?php echo $lang->doc->title;?></th>
      <td><?php echo html::input('title', $doc->title, "class='text-1'");?></td>
    </tr> 
    <tr>
      <th class='rowhead'><?php echo $lang->doc->keywords;?></th>
      <td><?php echo html::input('keywords', $doc->keywords, "class='text-1'");?></td>
    </tr>  
    <tr id='urlBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->doc->url;?></th>
      <td><?php echo html::input('url', urldecode($doc->url), "class='text-1'");?></td>
    </tr>  
    <tr id='contentBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->doc->content;?></th>
      <td><?php echo html::textarea('content', $doc->content, "class='text-1' rows='8' style='width:90%; height:200px'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->doc->digest;?></th>
      <td><?php echo html::textarea('digest', $doc->digest, "class='text-1' rows=3");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->doc->comment;?></th>
      <td><?php echo html::textarea('comment','', "class='text-1' rows=3");?></td>
    </tr> 
    <tr id='fileBox' class='hidden'>
      <th class='rowhead'><?php echo $lang->doc->files;?></th>
      <td><?php echo $this->fetch('file', 'buildform', 'fileCount=2');?></td>
    </tr>  
    <tr>
      <td colspan='2' class='a-center'>
        <?php echo html::submitButton() . html::backButton() . html::hidden('lib', $libID);?>
        <?php echo html::hidden('product', $doc->product) . html::hidden('project', $doc->project);?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
