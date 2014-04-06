<div id='featurebar' class='featurebar-bug'>
  <div class='f-left' style="margin-left:15px;">
    <?php
    // 所有bug
    $COUNT_ALLBUG =  $count['unfixbug'] + $count['resolbug'] + $count['closebug'] + $count['nocofbug'];
    echo "<span id='allTab' class='ld-bug-icon bug-icon1'>" 
    . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=showall"), $lang->bug->allBugs .' : '. $COUNT_ALLBUG) . "</span>";
    
    ## 华丽的分割线
    echo $lang->bug->spliter;
    
    // 指派给我
    #echo "<span id='assigntomeTab'>"    . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=assignToMe&param=0"),    $lang->bug->assignToMe)    . "</span>";
    
    // 我提交的bug
    #echo "<span id='openedbymeTab'>"    . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=openedByMe&param=0"),    $lang->bug->openedByMe)    . "</span>";
    
    // 没有指派
    #echo "<span id='assigntonullTab'>"  . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=assignToNull&param=0"),  $lang->bug->assignToNull)  . "</span>";
    
    // 未修复的bugs
    echo "<span id='unresolvedTab' class='ld-bug-icon bug-icon2'>"    . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=unResolved&param=0"),    $lang->bug->unResolved .' : '. $count['unfixbug'])    . "</span>";
    
    ## 华丽的分割线
    echo $lang->bug->spliter;
    
    // 没有指派
    echo "<span id='notconfirmedTab' class='ld-bug-icon bug-icon3'>"  . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=notconfirmed&param=0"),  $lang->bug->notConfirm .' : '. $count['nocofbug'])  . "</span>";
        
    ## 华丽的分割线
    echo $lang->bug->spliter;
    
    //　我解决的
    #echo "<span id='resolvedbymeTab'>"  . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=resolvedByMe&param=0"),  $lang->bug->resolvedByMe)  . "</span>";
    
    //　已经解决的bugs
    echo "<span id='resolvedTab' class='ld-bug-icon bug-icon4'>"  . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=resolved&param=0"),  $lang->bug->Resolved .' : '. $count['resolbug'])  . "</span>";

    ## 华丽的分割线
    echo $lang->bug->spliter;
    
    // 未关闭
    echo "<span id='closedTab' class='ld-bug-icon bug-icon5'>" . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=closed&param=0"),'已关闭的Bug数' .' : '. $count['closebug'])      . "</span>";
    
    // 久未处理
    #echo "<span id='longlifebugsTab'>"  . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=longLifeBugs&param=0"),  $lang->bug->longLifeBugs)  . "</span>";
    
    // 被延期
    #echo "<span id='postponedbugsTab'>" . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=postponedBugs&param=0"), $lang->bug->postponedBugs) . "</span>";
    
    // 需求变动
    #echo "<span id='needconfirmTab'>"   . html::a($this->createLink('bug', 'browse', "productid=$productID&browseType=needconfirm&param=0"), $lang->bug->needConfirm) . "</span>";
    
    // 搜索按钮
    #echo "<span id='bysearchTab'><a href='#' class='link-icon'><i class='icon-search icon'></i>&nbsp;{$lang->bug->byQuery}</a></span> ";
    ?>
  </div>
  <div class='f-right'>
    <?php
    #echo '<span class="link-button dropButton">';
    // 导出按钮
    #echo html::a("#", "<i class='icon-upload-alt'></i> " . $lang->export, '', "id='exportAction' onclick=toggleSubMenu(this.id,'bottom',0) title='{$lang->export}'");
    #echo '</span>';

    // 报表按钮
    #common::printIcon('bug', 'report', "productID=$productID&browseType=$browseType&moduleID=$moduleID");
    
    // 自定义字段按钮
    #common::printIcon('bug', 'customFields', '', '', 'button', 'icon-wrench');
    
    // 批量添加按钮
    #common::printIcon('bug', 'batchCreate', "productID=$productID&projectID=0&moduleID=$moduleID");
    
    // 提bug按钮
    common::printIcon('bug', 'create', "productID=$productID&extra=moduleID=$moduleID");
    ?>
  </div>
    <div class='clear'></div>
</div>