<?php
/**
 * The common simplified chinese file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: zh-cn.php 5116 2013-07-12 06:37:48Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->arrow        = '&nbsp;<span class="icon-angle-right"></span>';
#$lang->arrow        = '';
$lang->colon        = '::';
$lang->comma        = '，';
$lang->dot          = '。';
$lang->at           = ' 于 ';
$lang->downArrow    = '↓';
$lang->null         = '空';
$lang->spliter      = ' | ';

$lang->zentaoPMS    = '蓝豆管理';
$lang->welcome      = "欢迎使用『%s』{$lang->colon} {$lang->zentaoPMS}";
$lang->myControl    = "我的地盘";
$lang->currentPos   = '当前位置：';
$lang->logout       = '退出';
$lang->login        = '登录';
$lang->aboutZenTao  = '关于';
$lang->todayIs      = '今天是%s，';
$lang->runInfo      = "<div class='row'><div class='u-1 a-center' id='debugbar'>时间: %s 毫秒, 内存: %s KB, 查询: %s.  </div></div>";

$lang->reset        = '重填';
$lang->refresh      = '刷新';
$lang->edit         = '编辑';
$lang->copy         = '复制';
$lang->delete       = '删除';
$lang->close        = '关闭';
$lang->link         = '关联';
$lang->unlink       = '移除';
$lang->import       = '导入';
$lang->export       = '导出';
$lang->setFileName  = '文件名：';
$lang->activate     = '激活';
$lang->submitting   = '稍候...';
$lang->save         = '保存';
$lang->confirm      = '确认';
$lang->preview      = '查看';
$lang->goback       = '返回';
$lang->goPC         = 'PC版';
$lang->go           = 'GO';
$lang->more         = '更多';

$lang->actions      = '操作';
$lang->comment      = '备注';
$lang->history      = '处理过程';
$lang->attatch      = '附件';
$lang->reverse      = '切换顺序';
$lang->switchDisplay= '切换显示';
$lang->switchHelp   = '切换帮助';
$lang->addFiles     = '上传了附件 ';
$lang->files        = '附件 ';
$lang->unfold       = '+';
$lang->fold         = '-';
$lang->admins      = '管理员';

$lang->selectAll     = '全选';
$lang->selectReverse = '反选';
$lang->notFound      = '抱歉，您访问的对象并不存在！';
$lang->showAll       = '[[全部显示]]';
$lang->hideClosed    = '[[显示进行中]]';

$lang->future       = '未来';
$lang->year         = '年';
$lang->workingHour  = '工时';

$lang->idAB         = 'ID';
$lang->priAB        = 'P';
$lang->statusAB     = '状态';
$lang->openedByAB   = '创建';
$lang->assignedToAB = '指派';
$lang->typeAB       = '类型';

$lang->common = new stdclass();
$lang->common->common = '公有模块';

/* 主导航菜单。*/
$lang->menu = new stdclass();
#$lang->menu->my       = '<i class="icon-home"></i> 我的地盘|my|index';
#$lang->menu->product  = '产品|product|index';
$lang->menu->project  = '项目|project|index|locate=no&status=all';
$lang->menu->qa       = '测试|qa|index';
#$lang->menu->doc      = '文档|doc|index';
#$lang->menu->report   = '统计|report|index';
#$lang->menu->webapp   = '应用|webapp|index';
$lang->menu->company  = '组织|company|index';
#$lang->menu->admin    = '后台|admin|index';

/* 查询条中可以选择的对象列表。*/
$lang->searchObjects['bug']         = 'B:Bug';
$lang->searchObjects['story']       = 'S:需求';
$lang->searchObjects['task']        = 'T:任务';
$lang->searchObjects['testcase']    = 'C:用例';
$lang->searchObjects['project']     = 'P:项目';
$lang->searchObjects['product']     = 'P:产品';
$lang->searchObjects['user']        = 'U:用户';
$lang->searchObjects['build']       = 'B:版本';
$lang->searchObjects['release']     = 'R:发布';
$lang->searchObjects['productplan'] = 'P:产品计划';
$lang->searchObjects['testtask']    = 'T:测试任务';
$lang->searchObjects['doc']         = 'D:文档';
$lang->searchTips                   = '编号(ctrl+g)';

/* 导入支持的编码格式。*/
$lang->importEncodeList['gbk']   = 'GBK';
$lang->importEncodeList['big5']  = 'BIG5';
$lang->importEncodeList['utf-8'] = 'UTF-8';

/* 导出文件的类型列表。*/
$lang->exportFileTypeList['csv']  = 'csv';
$lang->exportFileTypeList['xml']  = 'xml';
$lang->exportFileTypeList['html'] = 'html';

$lang->exportTypeList['all']      = '全部记录';
$lang->exportTypeList['selected'] = '选中记录';

/* 风格列表。*/
$lang->themes['default']   = '默认';
$lang->themes['green']     = '绿色';
$lang->themes['red']       = '红色';
$lang->themes['classblue'] = '经典蓝';

/* 首页菜单设置。*/
$lang->index = new stdclass();
$lang->index->menu = new stdclass();

$lang->index->menu->product = '浏览产品|product|browse';
$lang->index->menu->project = '浏览项目|project|browse';

/* 我的地盘菜单设置。*/
$lang->my = new stdclass();
$lang->my->menu = new stdclass();

#$lang->my->menu->account        = '<span id="myname"><i class="icon-user"></i> %s' . $lang->arrow . '</span>';
#$lang->my->menu->index          = '首页|my|index';
#$lang->my->menu->todo           = array('link' => '待办|my|todo|', 'subModule' => 'todo');
#$lang->my->menu->task           = array('link' => '任务|my|task|', 'subModule' => 'task');
#$lang->my->menu->bug            = array('link' => 'Bug|my|bug|',   'subModule' => 'bug');
#$lang->my->menu->testtask       = array('link' => '测试|my|testtask|', 'subModule' => 'testcase,testtask', 'alias' => 'testcase');
#$lang->my->menu->story          = array('link' => '需求|my|story|',   'subModule' => 'story');
#$lang->my->menu->myProject      = '项目|my|project|';
#$lang->my->menu->dynamic        = '动态|my|dynamic|';
#$lang->my->menu->profile        = array('link' => '档案|my|profile|', 'alias' => 'editprofile');
$lang->my->menu->changePassword = '修改密码|my|changepassword|';

$lang->todo = new stdclass();
$lang->todo->menu = $lang->my->menu;

/* 产品视图设置。*/
$lang->product = new stdclass();
$lang->product->menu = new stdclass();

$lang->product->menu->list    = '%s';
$lang->product->menu->story   = array('link' => '需求|product|browse|productID=%s', 'alias' => 'batchedit', 'subModule' => 'story');
$lang->product->menu->dynamic = '动态|product|dynamic|productID=%s';
$lang->product->menu->plan    = array('link' => '计划|productplan|browse|productID=%s', 'subModule' => 'productplan');
$lang->product->menu->release = array('link' => '发布|release|browse|productID=%s',     'subModule' => 'release');
$lang->product->menu->roadmap = '路线图|product|roadmap|productID=%s';
$lang->product->menu->doc     = array('link' => '文档|product|doc|productID=%s', 'subModule' => 'doc');
$lang->product->menu->view    = array('link' => '维护|product|view|productID=%s', 'alias' => 'edit');
$lang->product->menu->module  = '模块|tree|browse|productID=%s&view=story';
$lang->product->menu->project = '项目|product|project|status=all&productID=%s';
$lang->product->menu->create  = array('link' => '<i class="icon-plus"></i>&nbsp;添加产品|product|create', 'float' => 'right');
$lang->product->menu->all     = array('link' => '<i class="icon-th"></i>&nbsp;所有产品|product|index|locate=no&productID=%s', 'float' => 'right');

$lang->story       = new stdclass();
$lang->productplan = new stdclass();
$lang->release     = new stdclass();

$lang->story->menu       = $lang->product->menu;
$lang->productplan->menu = $lang->product->menu;
$lang->release->menu     = $lang->product->menu;

/* 项目视图菜单设置。*/
$lang->project = new stdclass();
$lang->project->menu = new stdclass();

$lang->project->menu->list      = '%s';
#$lang->project->menu->task      = array('link' => '任务|project|task|projectID=%s', 'subModule' => 'task,tree', 'alias' => 'grouptask,importtask,burn,importbug');
#$lang->project->menu->story     = array('link' => '需求|project|story|projectID=%s', 'subModule' => 'story', 'alias' => 'linkstory');
#$lang->project->menu->bug       = 'Bug|project|bug|projectID=%s';
#$lang->project->menu->dynamic   = '动态|project|dynamic|projectID=%s';
$lang->project->menu->index   = '项目列表|project|index|locate=no&status=all';
$lang->project->menu->build     = array('link' => '版本|project|build|projectID=%s', 'subModule' => 'build');
#$lang->project->menu->testtask  = '测试|project|testtask|projectID=%s';
#$lang->project->menu->team      = array('link' => '团队|project|team|projectID=%s', 'alias' => 'managemembers');
#$lang->project->menu->doc       = array('link' => '文档|project|doc|porjectID=%s', 'subModule' => 'doc');
#$lang->project->menu->product   = '产品|project|manageproducts|projectID=%s';
#$lang->project->menu->view      = array('link' => '维护|project|view|projectID=%s', 'alias' => 'edit,start,suspend,putoff,close');
$lang->project->menu->create    = array('link' => '<i class="icon-plus"></i>&nbsp;添加项目|project|create', 'float' => 'right');
#$lang->project->menu->all       = array('link' => '<i class="icon-th-large"></i>&nbsp;所有项目|project|index|locate=no&status=all&projectID=%s', 'float' => 'right');

$lang->task  = new stdclass();
$lang->build = new stdclass();
$lang->task->menu  = $lang->project->menu;
$lang->build->menu = $lang->project->menu;

/* QA视图菜单设置。*/
$lang->bug = new stdclass();
$lang->bug->menu = new stdclass();

$lang->bug->menu->list    = '%s';
#$lang->bug->menu->bug      = array('link' => 'Bug|bug|browse|productID=%s', 'alias' => 'view,create,batchcreate,edit,resolve,close,activate,report,batchedit,confirmbug,assignto', 'subModule' => 'tree');
#$lang->bug->menu->testcase = array('link' => '用例|testcase|browse|productID=%s', 'alias' => 'view,create,edit');
#$lang->bug->menu->testtask = array('link' => '测试任务|testtask|browse|productID=%s');

$lang->testcase = new stdclass();
$lang->testcase->menu = new stdclass();

$lang->testcase->menu->product  = '%s';
$lang->testcase->menu->bug      = array('link' => 'Bug|bug|browse|productID=%s');
$lang->testcase->menu->testcase = array('link' => '用例|testcase|browse|productID=%s', 'alias' => 'view,create,batchcreate,edit,batchedit,showimport', 'subModule' => 'tree');
$lang->testcase->menu->testtask = array('link' => '测试任务|testtask|browse|productID=%s', 'alias' => 'view,create,edit,linkcase,cases,start,close,batchrun');

$lang->testtask = new stdclass();
$lang->testtask->menu = $lang->testcase->menu;

/* 文档视图菜单设置。*/
$lang->doc = new stdclass();
$lang->doc->menu = new stdclass();

$lang->doc->menu->list    = '%s';
$lang->doc->menu->browse  = array('link' => '文档|doc|browse|libID=%s', 'alias' => 'view,create,edit');
$lang->doc->menu->edit    = '编辑|doc|editLib|libID=%s';
$lang->doc->menu->module  = '分类|tree|browse|libID=%s&viewType=doc';
$lang->doc->menu->delete  = array('link' => '删除|doc|deleteLib|libID=%s', 'target' => 'hiddenwin');
$lang->doc->menu->create  = array('link' => '<i class="icon-plus"></i>&nbsp;添加文档库|doc|createLib', 'float' => 'right');

/* 统计视图菜单设置。*/
$lang->report = new stdclass();
$lang->report->menu = new stdclass();

$lang->report->menu->product = array('link' => '产品|report|productinfo');
$lang->report->menu->prj     = array('link' => '项目|report|projectdeviation');
$lang->report->menu->test    = array('link' => '测试|report|bugsummary', 'alias' => 'bugassign');
$lang->report->menu->staff   = array('link' => '组织|report|workload');

/* 资源视图菜单设置。*/
$lang->webapp = new stdclass();
$lang->webapp->menu = new stdclass();
$lang->webapp->menu->obtain     = array('link' => '<span class="icon-webapp-obtain">&nbsp;</span>应用商店|webapp|obtain', 'float' => 'right');
$lang->webapp->menu->manageTree = array('link' => "<span class='icon-webapp-manage'>&nbsp;</span>维护分类|tree|browse|rootID=0&view=webapp", 'float' => 'right');
$lang->webapp->menu->create     = array('link' => "<span class='icon-webapp-create'>&nbsp;</span>创建应用|webapp|create", 'float' => 'right');

/* 组织结构视图菜单设置。*/
$lang->company = new stdclass();
$lang->company->menu = new stdclass();
$lang->company->menu->name         = '%s' . $lang->arrow;
$lang->company->menu->browseUser   = array('link' => '用户|company|browse', 'subModule' => 'user');
$lang->company->menu->dept         = array('link' => '部门|dept|browse', 'subModule' => 'dept');
$lang->company->menu->browseGroup  = array('link' => '权限|group|browse', 'subModule' => 'group');
#$lang->company->menu->view         = array('link' => '公司|company|view', 'alias' => 'edit');
#$lang->company->menu->dynamic      = '动态|company|dynamic|';
$lang->company->menu->addGroup     = array('link' => '<i class="icon-plus"></i>&nbsp;添加分组|group|create', 'float' => 'right');
#$lang->company->menu->batchAddUser = array('link' => '<i class="icon-green-user-batchCreate"></i>&nbsp;批量添加|user|batchCreate|dept=%s', 'subModule' => 'user', 'float' => 'right');
$lang->company->menu->addUser      = array('link' => '<i class="icon-plus"></i>&nbsp;添加用户|user|create|dept=%s', 'subModule' => 'user', 'float' => 'right');

$lang->dept  = new stdclass();
$lang->group = new stdclass();
$lang->user  = new stdclass();

$lang->dept->menu  = $lang->company->menu;
$lang->group->menu = $lang->company->menu;
$lang->user->menu  = $lang->company->menu;

/* 后台管理菜单设置。*/
$lang->admin = new stdclass();
$lang->admin->menu = new stdclass();
$lang->admin->menu->index     = array('link' => '首页|admin|index');
$lang->admin->menu->extension = array('link' => '扩展|extension|browse', 'subModule' => 'extension,editor');
$lang->admin->menu->custom    = array('link' => '自定义|custom|index', 'subModule' => 'custom');
$lang->admin->menu->mail      = array('link' => '发信|mail|index', 'subModule' => 'mail');
$lang->admin->menu->clearData = array('link' => '清除数据|admin|cleardata');
$lang->admin->menu->convert   = array('link' => '导入|convert|index', 'subModule' => 'convert');
$lang->admin->menu->trashes   = array('link' => '回收站|action|trash', 'subModule' => 'action');
$lang->admin->menu->sso       = array('link' => '单点登录|sso|browse', 'subModule' => 'sso');

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

/* 菜单分组。*/
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

/* 错误提示信息。*/
$lang->error = new stdclass();
$lang->error->companyNotFound = "您访问的域名 %s 没有对应的公司。";
$lang->error->length          = array("『%s』长度错误，应当为『%s』", "『%s』长度应当不超过『%s』，且不小于『%s』。");
$lang->error->reg             = "『%s』不符合格式，应当为:『%s』。";
$lang->error->unique          = "『%s』已经有『%s』这条记录了。";
$lang->error->gt              = "『%s』应当大于『%s』。";
$lang->error->ge              = "『%s』应当不小于『%s』。";
$lang->error->notempty        = "『%s』不能为空。";
$lang->error->empty           = "『%s』必须为空。";
$lang->error->equal           = "『%s』必须为『%s』。";
$lang->error->int             = array("『%s』应当是数字。", "『%s』应当介于『%s-%s』之间。");
$lang->error->float           = "『%s』应当是数字，可以是小数。";
$lang->error->email           = "『%s』应当为合法的EMAIL。";
$lang->error->date            = "『%s』应当为合法的日期。";
$lang->error->account         = "『%s』应当为合法的用户名。";
$lang->error->passwordsame    = "两次密码应当相等。";
$lang->error->passwordrule    = "密码应该符合规则，长度至少为六位。";
$lang->error->accessDenied    = '您没有访问权限';
$lang->error->noData          = '没有数据';

/* 分页信息。*/
$lang->pager = new stdclass();
$lang->pager->noRecord  = "暂时没有记录";
#$lang->pager->digest    = "共<strong>%s</strong>条记录，每页 <strong>%s</strong>条，<strong>%s/%s</strong> ";
$lang->pager->digest    = "每页 <strong>%s</strong>条，<strong>%s/%s</strong> ";
$lang->pager->first     = "首页";
$lang->pager->pre       = "上页";
$lang->pager->next      = "下页";
$lang->pager->last      = "末页";
$lang->pager->locate    = "Go";

$lang->zentaoSite     = "官方网站";
$lang->chinaScrum     = "<a href='http://api.zentao.net/goto.php?item=chinascrum' target='_blank'>Scrum社区</a>&nbsp; ";
$lang->agileTraining  = "<a href='http://api.zentao.net/goto.php?item=agiletrain' target='_blank'>培训</a>&nbsp; ";
$lang->donate         = "<a href='http://api.zentao.net/goto.php?item=donate' target='_blank'><i class='icon-heart'></i> 捐赠</a>&nbsp; ";
$lang->proVersion     = "<a href='http://api.zentao.net/goto.php?item=proversion&from=footer' target='_blank' class='red'>购买专业版(特惠)！</a>&nbsp; ";
$lang->downNotify     = "下载桌面提醒";

$lang->suhosinInfo = "警告：数据太多，请在php.ini中修改<font color=red>sohusin.post.max_vars</font>和<font color=red>sohusin.request.max_vars</font>（设置更大的数）。 保存并重新启动apache，否则会造成部分数据无法保存。";

$lang->noResultsMatch    = "没有匹配结果";
$lang->chooseUsersToMail = "选择要发信通知的用户...";

/* 时间格式设置。*/
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

/* datepicker 时间*/
$lang->datepicker = new stdclass();

$lang->datepicker->dpText = new stdclass();
$lang->datepicker->dpText->TEXT_OR          = '或 ';
$lang->datepicker->dpText->TEXT_PREV_YEAR   = '去年';
$lang->datepicker->dpText->TEXT_PREV_MONTH  = '上月';
$lang->datepicker->dpText->TEXT_PREV_WEEK   = '上周';
$lang->datepicker->dpText->TEXT_YESTERDAY   = '昨天';
$lang->datepicker->dpText->TEXT_THIS_MONTH  = '本月';
$lang->datepicker->dpText->TEXT_THIS_WEEK   = '本周';
$lang->datepicker->dpText->TEXT_TODAY       = '今天';
$lang->datepicker->dpText->TEXT_NEXT_YEAR   = '明年';
$lang->datepicker->dpText->TEXT_NEXT_MONTH  = '下月';
$lang->datepicker->dpText->TEXT_CLOSE       = '关闭';
$lang->datepicker->dpText->TEXT_DATE        = '选择时间段';
$lang->datepicker->dpText->TEXT_CHOOSE_DATE = '选择日期';

$lang->datepicker->dayNames     = array('日', '一', '二', '三', '四', '五', '六');
$lang->datepicker->abbrDayNames = array('日', '一', '二', '三', '四', '五', '六');
$lang->datepicker->monthNames   = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');

include (dirname(__FILE__) . '/menuOrder.php');
$lang->bug->spliter = "<img src=\"/theme/default/images/ld/line.gif\" class=\"SLine\" />";