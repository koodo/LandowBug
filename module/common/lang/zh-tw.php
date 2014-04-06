<?php
/**
 * The common simplified chinese file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: zh-tw.php 5116 2013-07-12 06:37:48Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->arrow        = '';
#$lang->arrow        = '&nbsp;<span class="icon-angle-right"></span>';
$lang->colon        = '::';
$lang->comma        = '，';
$lang->dot          = '。';
$lang->at           = ' 于 ';
$lang->downArrow    = '↓';
$lang->null         = '空';

$lang->zentaoPMS    = '蓝豆管理';
$lang->welcome      = "歡迎使用『%s』{$lang->colon} {$lang->zentaoPMS}";
$lang->myControl    = "我的地盤";
$lang->currentPos   = '當前位置：';
$lang->logout       = '退出';
$lang->login        = '登錄';
$lang->aboutZenTao  = '關於';
$lang->todayIs      = '今天是%s，';
$lang->runInfo      = "<div class='row'><div class='u-1 a-center' id='debugbar'>時間: %s 毫秒, 內存: %s KB, 查詢: %s.  </div></div>";

$lang->reset        = '重填';
$lang->refresh      = '刷新';
$lang->edit         = '編輯';
$lang->copy         = '複製';
$lang->delete       = '刪除';
$lang->close        = '關閉';
$lang->link         = '關聯';
$lang->unlink       = '移除';
$lang->import       = '導入';
$lang->export       = '導出';
$lang->setFileName  = '檔案名：';
$lang->activate     = '激活';
$lang->submitting   = '稍候...';
$lang->save         = '保存';
$lang->confirm      = '確認';
$lang->preview      = '查看';
$lang->goback       = '返回';
$lang->goPC         = 'PC版';
$lang->go           = 'GO';
$lang->more         = '更多';

$lang->actions      = '操作';
$lang->comment      = '備註';
$lang->history      = '歷史記錄';
$lang->attatch      = '附件';
$lang->reverse      = '切換順序';
$lang->switchDisplay= '切換顯示';
$lang->switchHelp   = '切換幫助';
$lang->addFiles     = '上傳了附件 ';
$lang->files        = '附件 ';
$lang->unfold       = '+';
$lang->fold         = '-';

$lang->selectAll     = '全選';
$lang->selectReverse = '反選';
$lang->notFound      = '抱歉，您訪問的對象並不存在！';
$lang->showAll       = '[[全部顯示]]';
$lang->hideClosed    = '[[顯示進行中]]';

$lang->future       = '未來';
$lang->year         = '年';
$lang->workingHour  = '工時';

$lang->idAB         = 'ID';
$lang->priAB        = 'P';
$lang->statusAB     = '狀態';
$lang->openedByAB   = '創建';
$lang->assignedToAB = '指派';
$lang->typeAB       = '類型';

$lang->common = new stdclass();
$lang->common->common = '公有模組';

/* 主導航菜單。*/
$lang->menu = new stdclass();
$lang->menu->my       = '<i class="icon-home"></i> 我的地盤|my|index';
$lang->menu->product  = '產品|product|index';
$lang->menu->project  = '項目|project|index';
$lang->menu->qa       = '測試|qa|index';
$lang->menu->doc      = '文檔|doc|index';
$lang->menu->report   = '統計|report|index';
$lang->menu->webapp   = '應用|webapp|index';
$lang->menu->company  = '組織|company|index';
$lang->menu->admin    = '後台|admin|index';

/* 查詢條中可以選擇的對象列表。*/
$lang->searchObjects['bug']         = 'B:Bug';
$lang->searchObjects['story']       = 'S:需求';
$lang->searchObjects['task']        = 'T:任務';
$lang->searchObjects['testcase']    = 'C:用例';
$lang->searchObjects['project']     = 'P:項目';
$lang->searchObjects['product']     = 'P:產品';
$lang->searchObjects['user']        = 'U:用戶';
$lang->searchObjects['build']       = 'B:版本';
$lang->searchObjects['release']     = 'R:發佈';
$lang->searchObjects['productplan'] = 'P:產品計劃';
$lang->searchObjects['testtask']    = 'T:測試任務';
$lang->searchObjects['doc']         = 'D:文檔';
$lang->searchTips                   = '編號(ctrl+g)';

/* 導入支持的編碼格式。*/
$lang->importEncodeList['gbk']   = 'GBK';
$lang->importEncodeList['big5']  = 'BIG5';
$lang->importEncodeList['utf-8'] = 'UTF-8';

/* 導出檔案的類型列表。*/
$lang->exportFileTypeList['csv']  = 'csv';
$lang->exportFileTypeList['xml']  = 'xml';
$lang->exportFileTypeList['html'] = 'html';

$lang->exportTypeList['all']      = '全部記錄';
$lang->exportTypeList['selected'] = '選中記錄';

/* 風格列表。*/
$lang->themes['default']   = '預設';
$lang->themes['green']     = '綠色';
$lang->themes['red']       = '紅色';
$lang->themes['classblue'] = '經典藍';

/* 首頁菜單設置。*/
$lang->index = new stdclass();
$lang->index->menu = new stdclass();

$lang->index->menu->product = '瀏覽產品|product|browse';
$lang->index->menu->project = '瀏覽項目|project|browse';

/* 我的地盤菜單設置。*/
$lang->my = new stdclass();
$lang->my->menu = new stdclass();

$lang->my->menu->account        = '<span id="myname"><i class="icon-user"></i> %s' . $lang->arrow . '</span>';
$lang->my->menu->index          = '首頁|my|index';
$lang->my->menu->todo           = array('link' => '待辦|my|todo|', 'subModule' => 'todo');
$lang->my->menu->task           = array('link' => '任務|my|task|', 'subModule' => 'task');
$lang->my->menu->bug            = array('link' => 'Bug|my|bug|',   'subModule' => 'bug');
$lang->my->menu->testtask       = array('link' => '測試|my|testtask|', 'subModule' => 'testcase,testtask', 'alias' => 'testcase');
$lang->my->menu->story          = array('link' => '需求|my|story|',   'subModule' => 'story');
$lang->my->menu->myProject      = '項目|my|project|';
$lang->my->menu->dynamic        = '動態|my|dynamic|';
$lang->my->menu->profile        = array('link' => '檔案|my|profile|', 'alias' => 'editprofile');
$lang->my->menu->changePassword = '密碼|my|changepassword|';

$lang->todo = new stdclass();
$lang->todo->menu = $lang->my->menu;

/* 產品視圖設置。*/
$lang->product = new stdclass();
$lang->product->menu = new stdclass();

$lang->product->menu->list    = '%s';
$lang->product->menu->story   = array('link' => '需求|product|browse|productID=%s', 'alias' => 'batchedit', 'subModule' => 'story');
$lang->product->menu->dynamic = '動態|product|dynamic|productID=%s';
$lang->product->menu->plan    = array('link' => '計劃|productplan|browse|productID=%s', 'subModule' => 'productplan');
$lang->product->menu->release = array('link' => '發佈|release|browse|productID=%s',     'subModule' => 'release');
$lang->product->menu->roadmap = '路線圖|product|roadmap|productID=%s';
$lang->product->menu->doc     = array('link' => '文檔|product|doc|productID=%s', 'subModule' => 'doc');
$lang->product->menu->view    = array('link' => '維護|product|view|productID=%s', 'alias' => 'edit');
$lang->product->menu->module  = '模組|tree|browse|productID=%s&view=story';
$lang->product->menu->project = '項目|product|project|status=all&productID=%s';
$lang->product->menu->create  = array('link' => '<i class="icon-plus"></i>&nbsp;添加產品|product|create', 'float' => 'right');
$lang->product->menu->all     = array('link' => '<i class="icon-th"></i>&nbsp;所有產品|product|index|locate=no&productID=%s', 'float' => 'right');

$lang->story       = new stdclass();
$lang->productplan = new stdclass();
$lang->release     = new stdclass();

$lang->story->menu       = $lang->product->menu;
$lang->productplan->menu = $lang->product->menu;
$lang->release->menu     = $lang->product->menu;

/* 項目視圖菜單設置。*/
$lang->project = new stdclass();
$lang->project->menu = new stdclass();

$lang->project->menu->list      = '%s';
$lang->project->menu->task      = array('link' => '任務|project|task|projectID=%s', 'subModule' => 'task,tree', 'alias' => 'grouptask,importtask,burn,importbug');
$lang->project->menu->story     = array('link' => '需求|project|story|projectID=%s', 'subModule' => 'story', 'alias' => 'linkstory');
$lang->project->menu->bug       = 'Bug|project|bug|projectID=%s';
$lang->project->menu->dynamic   = '動態|project|dynamic|projectID=%s';
$lang->project->menu->build     = array('link' => '版本|project|build|projectID=%s', 'subModule' => 'build');
$lang->project->menu->testtask  = '測試|project|testtask|projectID=%s';
$lang->project->menu->team      = array('link' => '團隊|project|team|projectID=%s', 'alias' => 'managemembers');
$lang->project->menu->doc       = array('link' => '文檔|project|doc|porjectID=%s', 'subModule' => 'doc');
$lang->project->menu->product   = '產品|project|manageproducts|projectID=%s';
$lang->project->menu->view      = array('link' => '維護|project|view|projectID=%s', 'alias' => 'edit,start,suspend,putoff,close');
$lang->project->menu->create    = array('link' => '<i class="icon-plus"></i>&nbsp;添加項目|project|create', 'float' => 'right');
$lang->project->menu->all       = array('link' => '<i class="icon-th-large"></i>&nbsp;所有項目|project|index|locate=no&status=all&projectID=%s', 'float' => 'right');

$lang->task  = new stdclass();
$lang->build = new stdclass();
$lang->task->menu  = $lang->project->menu;
$lang->build->menu = $lang->project->menu;

/* QA視圖菜單設置。*/
$lang->bug = new stdclass();
$lang->bug->menu = new stdclass();

$lang->bug->menu->product  = '%s';
$lang->bug->menu->bug      = array('link' => 'Bug|bug|browse|productID=%s', 'alias' => 'view,create,batchcreate,edit,resolve,close,activate,report,batchedit,confirmbug,assignto', 'subModule' => 'tree');
$lang->bug->menu->testcase = array('link' => '用例|testcase|browse|productID=%s', 'alias' => 'view,create,edit');
$lang->bug->menu->testtask = array('link' => '測試任務|testtask|browse|productID=%s');

$lang->testcase = new stdclass();
$lang->testcase->menu = new stdclass();

$lang->testcase->menu->product  = '%s';
$lang->testcase->menu->bug      = array('link' => 'Bug|bug|browse|productID=%s');
$lang->testcase->menu->testcase = array('link' => '用例|testcase|browse|productID=%s', 'alias' => 'view,create,batchcreate,edit,batchedit,showimport', 'subModule' => 'tree');
$lang->testcase->menu->testtask = array('link' => '測試任務|testtask|browse|productID=%s', 'alias' => 'view,create,edit,linkcase,cases,start,close,batchrun');

$lang->testtask = new stdclass();
$lang->testtask->menu = $lang->testcase->menu;

/* 文檔視圖菜單設置。*/
$lang->doc = new stdclass();
$lang->doc->menu = new stdclass();

$lang->doc->menu->list    = '%s';
$lang->doc->menu->browse  = array('link' => '文檔|doc|browse|libID=%s', 'alias' => 'view,create,edit');
$lang->doc->menu->edit    = '編輯|doc|editLib|libID=%s';
$lang->doc->menu->module  = '分類|tree|browse|libID=%s&viewType=doc';
$lang->doc->menu->delete  = array('link' => '刪除|doc|deleteLib|libID=%s', 'target' => 'hiddenwin');
$lang->doc->menu->create  = array('link' => '<i class="icon-plus"></i>&nbsp;添加文檔庫|doc|createLib', 'float' => 'right');

/* 統計視圖菜單設置。*/
$lang->report = new stdclass();
$lang->report->menu = new stdclass();

$lang->report->menu->product = array('link' => '產品|report|productinfo');
$lang->report->menu->prj     = array('link' => '項目|report|projectdeviation');
$lang->report->menu->test    = array('link' => '測試|report|bugsummary', 'alias' => 'bugassign');
$lang->report->menu->staff   = array('link' => '組織|report|workload');

/* 資源視圖菜單設置。*/
$lang->webapp = new stdclass();
$lang->webapp->menu = new stdclass();
$lang->webapp->menu->obtain     = array('link' => '<span class="icon-webapp-obtain">&nbsp;</span>應用商店|webapp|obtain', 'float' => 'right');
$lang->webapp->menu->manageTree = array('link' => "<span class='icon-webapp-manage'>&nbsp;</span>維護分類|tree|browse|rootID=0&view=webapp", 'float' => 'right');
$lang->webapp->menu->create     = array('link' => "<span class='icon-webapp-create'>&nbsp;</span>創建應用|webapp|create", 'float' => 'right');

/* 組織結構視圖菜單設置。*/
$lang->company = new stdclass();
$lang->company->menu = new stdclass();
$lang->company->menu->name         = '%s' . $lang->arrow;
$lang->company->menu->browseUser   = array('link' => '用戶|company|browse', 'subModule' => 'user');
$lang->company->menu->dept         = array('link' => '部門|dept|browse', 'subModule' => 'dept');
$lang->company->menu->browseGroup  = array('link' => '權限|group|browse', 'subModule' => 'group');
$lang->company->menu->view         = array('link' => '公司|company|view', 'alias' => 'edit');
$lang->company->menu->dynamic      = '動態|company|dynamic|';
$lang->company->menu->addGroup     = array('link' => '<i class="icon-plus"></i>&nbsp;添加分組|group|create', 'float' => 'right');
$lang->company->menu->batchAddUser = array('link' => '<i class="icon-green-user-batchCreate"></i>&nbsp;批量添加|user|batchCreate|dept=%s', 'subModule' => 'user', 'float' => 'right');
$lang->company->menu->addUser      = array('link' => '<i class="icon-plus"></i>&nbsp;添加用戶|user|create|dept=%s', 'subModule' => 'user', 'float' => 'right');

$lang->dept  = new stdclass();
$lang->group = new stdclass();
$lang->user  = new stdclass();

$lang->dept->menu  = $lang->company->menu;
$lang->group->menu = $lang->company->menu;
$lang->user->menu  = $lang->company->menu;

/* 後台管理菜單設置。*/
$lang->admin = new stdclass();
$lang->admin->menu = new stdclass();
$lang->admin->menu->index     = array('link' => '首頁|admin|index');
$lang->admin->menu->extension = array('link' => '擴展|extension|browse', 'subModule' => 'extension,editor');
$lang->admin->menu->custom    = array('link' => '自定義|custom|index', 'subModule' => 'custom');
$lang->admin->menu->mail      = array('link' => '發信|mail|index', 'subModule' => 'mail');
$lang->admin->menu->clearData = array('link' => '清除數據|admin|cleardata');
$lang->admin->menu->convert   = array('link' => '導入|convert|index', 'subModule' => 'convert');
$lang->admin->menu->trashes   = array('link' => '資源回收筒|action|trash', 'subModule' => 'action');
$lang->admin->menu->sso       = array('link' => '單點登錄|sso|browse', 'subModule' => 'sso');

$lang->convert    = new stdclass();
$lang->upgrade    = new stdclass();
$lang->action     = new stdclass();
$lang->extension  = new stdclass();
$lang->custom     = new stdclass();
$lang->editor     = new stdclass();
$lang->mail       = new stdclass();
$lang->sso        = new stdclass();

$lang->convert->menu   = $lang->admin->menu;
$lang->upgrade->menu   = $lang->admin->menu;
$lang->action->menu    = $lang->admin->menu;
$lang->extension->menu = $lang->admin->menu;
$lang->custom->menu    = $lang->admin->menu;
$lang->editor->menu    = $lang->admin->menu;
$lang->mail->menu      = $lang->admin->menu;
$lang->sso->menu       = $lang->admin->menu;

/* 菜單分組。*/
$lang->menugroup = new stdclass();
$lang->menugroup->release     = 'product';
$lang->menugroup->story       = 'product';
$lang->menugroup->productplan = 'product';
$lang->menugroup->task        = 'project';
$lang->menugroup->build       = 'project';
$lang->menugroup->convert     = 'admin';
$lang->menugroup->upgrade     = 'admin';
$lang->menugroup->user        = 'company';
$lang->menugroup->group       = 'company';
$lang->menugroup->bug         = 'qa';
$lang->menugroup->testcase    = 'qa';
$lang->menugroup->testtask    = 'qa';
$lang->menugroup->people      = 'company';
$lang->menugroup->dept        = 'company';
$lang->menugroup->todo        = 'my';
$lang->menugroup->action      = 'admin';
$lang->menugroup->extension   = 'admin';
$lang->menugroup->custom      = 'admin';
$lang->menugroup->editor      = 'admin';
$lang->menugroup->mail        = 'admin';
$lang->menugroup->sso         = 'admin';

/* 錯誤提示信息。*/
$lang->error = new stdclass();
$lang->error->companyNotFound = "您訪問的域名 %s 沒有對應的公司。";
$lang->error->length          = array("『%s』長度錯誤，應當為『%s』", "『%s』長度應當不超過『%s』，且不小於『%s』。");
$lang->error->reg             = "『%s』不符合格式，應當為:『%s』。";
$lang->error->unique          = "『%s』已經有『%s』這條記錄了。如果您確定該記錄已刪除，請到後台管理-資源回收筒還原。。";
$lang->error->gt              = "『%s』應當大於『%s』。";
$lang->error->ge              = "『%s』應當不小於『%s』。";
$lang->error->notempty        = "『%s』不能為空。";
$lang->error->empty           = "『%s』必須為空。";
$lang->error->equal           = "『%s』必須為『%s』。";
$lang->error->int             = array("『%s』應當是數字。", "『%s』應當介於『%s-%s』之間。");
$lang->error->float           = "『%s』應當是數字，可以是小數。";
$lang->error->email           = "『%s』應當為合法的EMAIL。";
$lang->error->date            = "『%s』應當為合法的日期。";
$lang->error->account         = "『%s』應當為合法的用戶名。";
$lang->error->passwordsame    = "兩次密碼應當相等。";
$lang->error->passwordrule    = "密碼應該符合規則，長度至少為六位。";
$lang->error->accessDenied    = '您沒有訪問權限';
$lang->error->noData          = '沒有數據';

/* 分頁信息。*/
$lang->pager = new stdclass();
$lang->pager->noRecord  = "暫時沒有記錄";
$lang->pager->digest    = "共<strong>%s</strong>條記錄，每頁 <strong>%s</strong>條，<strong>%s/%s</strong> ";
$lang->pager->first     = "首頁";
$lang->pager->pre       = "上頁";
$lang->pager->next      = "下頁";
$lang->pager->last      = "末頁";
$lang->pager->locate    = "GO!";

$lang->zentaoSite     = "官方網站";
$lang->chinaScrum     = "<a href='http://api.zentao.net/goto.php?item=chinascrum' target='_blank'>Scrum社區</a>&nbsp; ";
$lang->agileTraining  = "<a href='http://api.zentao.net/goto.php?item=agiletrain' target='_blank'>培訓</a>&nbsp; ";
$lang->donate         = "<a href='http://api.zentao.net/goto.php?item=donate' target='_blank'><i class='icon-heart'></i> 捐贈</a>&nbsp; ";
$lang->proVersion     = "<a href='http://api.zentao.net/goto.php?item=proversion&from=footer' target='_blank' class='red'>購買專業版(特惠)！</a>&nbsp; ";
$lang->downNotify     = "下載桌面提醒";

$lang->suhosinInfo = "警告：數據太多，請在php.ini中修改<font color=red>sohusin.post.max_vars</font>和<font color=red>sohusin.request.max_vars</font>（設置更大的數）。 保存並重新啟動apache，否則會造成部分數據無法保存。";

$lang->noResultsMatch    = "沒有匹配結果";
$lang->chooseUsersToMail = "選擇要發信通知的用戶...";

/* 時間格式設置。*/
define('DT_DATETIME1',  'Y-m-d H:i:s');
define('DT_DATETIME2',  'y-m-d H:i');
define('DT_MONTHTIME1', 'n/d H:i');
define('DT_MONTHTIME2', 'n月d日 H:i');
define('DT_DATE1',     'Y-m-d');
define('DT_DATE2',     'Ymd');
define('DT_DATE3',     'Y年m月d日');
define('DT_DATE4',     'n月j日');
define('DT_TIME1',     'H:i:s');
define('DT_TIME2',     'H:i');

/* datepicker 時間*/
$lang->datepicker = new stdclass();

$lang->datepicker->dpText = new stdclass();
$lang->datepicker->dpText->TEXT_OR          = '或 ';
$lang->datepicker->dpText->TEXT_PREV_YEAR   = '去年';
$lang->datepicker->dpText->TEXT_PREV_MONTH  = '上月';
$lang->datepicker->dpText->TEXT_PREV_WEEK   = '上周';
$lang->datepicker->dpText->TEXT_YESTERDAY   = '昨天';
$lang->datepicker->dpText->TEXT_THIS_MONTH  = '本月';
$lang->datepicker->dpText->TEXT_THIS_WEEK   = '本週';
$lang->datepicker->dpText->TEXT_TODAY       = '今天';
$lang->datepicker->dpText->TEXT_NEXT_YEAR   = '明年';
$lang->datepicker->dpText->TEXT_NEXT_MONTH  = '下月';
$lang->datepicker->dpText->TEXT_CLOSE       = '關閉';
$lang->datepicker->dpText->TEXT_DATE        = '選擇時間段';
$lang->datepicker->dpText->TEXT_CHOOSE_DATE = '選擇日期';

$lang->datepicker->dayNames     = array('日', '一', '二', '三', '四', '五', '六');
$lang->datepicker->abbrDayNames = array('日', '一', '二', '三', '四', '五', '六');
$lang->datepicker->monthNames   = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');

include (dirname(__FILE__) . '/menuOrder.php');
