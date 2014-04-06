<script language='Javascript'>
var fold   = '<?php echo $lang->fold;?>';
var unfold = '<?php echo $lang->unfold;?>';
function switchChange(historyID)
{
    changeClass = $('#switchButton' + historyID).attr('class');
    if(changeClass.indexOf('change-show') > 0)
    {
        $('#switchButton' + historyID).attr('class', changeClass.replace('change-show', 'change-hide'));
        $('#changeBox' + historyID).show();
        $('#changeBox' + historyID).prev('.changeDiff').show();
    }
    else
    {
        $('#switchButton' + historyID).attr('class', changeClass.replace('change-hide', 'change-show'));
        $('#changeBox' + historyID).hide();
        $('#changeBox' + historyID).prev('.changeDiff').hide();
    }
}

function toggleStripTags(obj)
{
    var diffClass = $(obj).attr('class');
    if(diffClass.indexOf('diff-all') > 0)
    {
        $(obj).attr('class', diffClass.replace('diff-all', 'diff-short'));
        $(obj).attr('title', '<?php echo $lang->action->textDiff?>');
    }
    else
    {
        $(obj).attr('class', diffClass.replace('diff-short', 'diff-all'));
        $(obj).attr('title', '<?php echo $lang->action->original?>');
    }
    var boxObj  = $(obj).next();
    var oldDiff = '';
    var newDiff = '';
    $(boxObj).find('blockquote').each(function(){
        oldDiff = $(this).html();
        newDiff = $(this).next().html();
        $(this).html(newDiff);
        $(this).next().html(oldDiff);
    })
}

function toggleShow(obj)
{
    var orderClass = $(obj).find('span').attr('class');
    if(orderClass == 'change-show')
    {
        $(obj).find('span').attr('class', 'change-hide');
    }
    else
    {
        $(obj).find('span').attr('class', 'change-show');
    }
    $('.changes').each(function(){
        var box = $(this).parent();
        while($(box).get(0).tagName.toLowerCase() != 'li') box = $(box).parent();
        var switchButtonID = ($(box).find('span').find("span").attr('id'));
        switchChange(switchButtonID.replace('switchButton', ''));
    })
}

function toggleOrder(obj)
{
    var orderClass = $(obj).find('span').attr('class');
    if(orderClass == 'log-asc')
    {
        $(obj).find('span').attr('class', 'log-desc');
    }
    else
    {
        $(obj).find('span').attr('class', 'log-asc');
    }
    $("#historyItem li").reverseOrder();
}

function toggleComment(actionID)
{
    $('.comment' + actionID).toggle();
    $('#lastCommentBox').toggle();
    $('.ke-container').css('width', '100%');
}

$(function(){
    var diffButton = "<span onclick='toggleStripTags(this)' class='hidden changeDiff diff-all hand' title='<?php echo $lang->action->original?>'></span>";
    var newBoxID = ''
    var oldBoxID = ''
    $('blockquote').each(function(){
        newBoxID = $(this).parent().attr('id');
        if(newBoxID != oldBoxID) 
        {
            oldBoxID = newBoxID;
            if($(this).html() != $(this).next().html()) $(this).parent().before(diffButton);
        }
    })
})
</script>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<script src='<?php echo $jsRoot;?>jquery/reverseorder/raw.js' type='text/javascript'></script>

<?php if(!isset($actionTheme)) $actionTheme = 'fieldset';?>
<?php if($actionTheme == 'fieldset'):?>
<div id='actionbox'>
<fieldset style="border:1px solid #d6e1ea;margin-right:70px;padding-right:16px;">
<?php else:?>
<table class='table-1' id='actionbox'>
  <caption>
    <?php echo $lang->history?>
    <span onclick='$("#historyItem li").reverseOrder();' class='hand'> <?php echo "<span title='$lang->reverse' class='log-asc'></span>";?></span>
    <span onclick='toggleShow();' class='hand'><?php echo "<span title='$lang->switchDisplay' class='change-show'></span>";?></span>
  </caption>
  <tr><td>
<?php endif;?>

  <table id='historyItem' style="table-layout:fixed">
    <?php $i = 1;$listLength = count($actions);  // 循环 ！！！！！！！！！?>
    <?php foreach($actions as $action):?>
    <?php 
    $actionType = strtolower($action->action); //操作类型 
    $canEditComment = (end($actions) == $action and $action->comment and $this->methodName == 'view' and $action->actor == $this->app->user->account); //判断是否可以编辑备注
    ?>    <tr value='<?php echo $i++;?>'>
      <?php
      if(isset($users[$action->actor])) $action->actor = $users[$action->actor];
      if($action->action == 'assigned' and isset($users[$action->extra]) ) $action->extra = $users[$action->extra];
      if(strpos($action->actor, ':') !== false) $action->actor = substr($action->actor, strpos($action->actor, ':') + 1);
      ?>
      <td style="text-align:left;padding-left:8px;">
        <?php #@输出操作?>
        <?php #$this->action->printAction($action);?>
        <?php echo $lang->bug->statusList[$action->status];?>
      </td>
      <td colspan="2">
          <?php
            if($actionType == 'opened'){echo $users[$bug->openedBy]. ' -> ' . $users[$action->assignto];}
            else if ($actionType == 'closed' || $actionType == 'bugconfirmed'){echo $action->actor;}
            else {echo $action->actor . ' -> ' . $users[$action->assignto];}
          ?>
      </td>
      <td style="text-align:left;word-wrap:break-word;" colspan="5">
        <?php echo $action->comment; ?>  
      </td>
      <td colspan="2" style="text-align:right;padding-right:10px;">
        <?php echo common::tTimeFormat(strtotime($action->date)); ?>  
      </td>
    </tr>
    <?php if($listLength != ($i - 1)): //判断最后一个，不显示箭头?>
    <!-- 传说中的箭头 -->
    <tr class="arrow">
        <td colspan="4">
        </td>
    </tr>
    <?php 
    endif;
    endforeach;
    ?>
  </table>

<?php if($actionTheme == 'fieldset'):?>
</fieldset>
<?php else:?>
</td></tr></table>
<?php endif;?>
</div>
