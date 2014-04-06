<?php
if(!$enable) : include './suspend_deny.html.php'; exit(0); endif;
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/kindeditor.html.php';
include '../../common/view/chosen.html.php';
js::set('holders', $lang->bug->placeholder);
js::set('page', 'suspend');
?>
<br />
<div class="ldbTitle" style="">
    <i class="icon-bug-s3"></i>
    <span style="text-indent:0">挂起bug</span>
</div>
<input type="hidden" value="<?php echo $suspendRateLevel;?>" id="suspendLevel" />
<form method='post'>
  <table class='table-1'>
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr> 
    <tr>
        <td class="rowhead" style="vertical-align:top;">标题</td>
        <td style="word-wrap:break-word"><?php echo '#' . $bug->id . '&nbsp;' . $bug->title;?></td>
    </tr>
    <tr>
        <td class='rowhead' style="">挂起率 : </td>
        <td><span class="suspend-rate suspend-rate-<?php echo $suspendRateLevel;?>"><?php echo $suspendRate;?>%</span></td>
    </tr>
    <tr>
      <td class='rowhead'>挂起原因</td>
      <td><?php echo html::textarea('comment', '', "rows='8' style='width:85%'");?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton('提交') . html::linkButton($lang->goback, $this->server->http_referer);?></td>
    </tr>    
    <tr>
        <th class='rowhead'> </th>
        <td> </td>
    </tr> 
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
