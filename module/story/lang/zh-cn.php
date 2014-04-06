<?php
/**
 * The story module zh-cn file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     story
 * @version     $Id: zh-cn.php 5141 2013-07-15 05:57:15Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->story->browse      = "需求列表";
$lang->story->create      = "提需求";
$lang->story->createCase  = "建用例";
$lang->story->batchCreate = "批量添加";
$lang->story->change      = "变更";
$lang->story->changed     = '需求变更';
$lang->story->review      = '评审';
$lang->story->batchReview = '批量评审';
$lang->story->edit        = "编辑";
$lang->story->batchEdit   = "批量编辑";
$lang->story->close       = '关闭';
$lang->story->batchClose  = '批量关闭';
$lang->story->activate    = '激活';
$lang->story->delete      = "删除";
$lang->story->view        = "需求详情";
$lang->story->tasks       = "相关任务";
$lang->story->taskCount   = '任务数';
$lang->story->bugs        = "Bug";
$lang->story->linkStory   = '关联需求';
$lang->story->export      = "导出数据";
$lang->story->reportChart = "统计报表";
$lang->story->batchChangePlan  = "批量修改计划";
$lang->story->batchChangeStage = "批量修改阶段";

$lang->story->common         = '需求';
$lang->story->id             = '编号';
$lang->story->product        = '所属产品';
$lang->story->module         = '所属模块';
$lang->story->source         = '来源';
$lang->story->fromBug        = '来源Bug';
$lang->story->release        = '发布计划';
$lang->story->bug            = '相关bug';
$lang->story->title          = '需求名称';
$lang->story->spec           = '需求描述';
$lang->story->verify         = '验收标准';
$lang->story->type           = '需求类型 ';
$lang->story->pri            = '优先级';
$lang->story->estimate       = '预计工时';
$lang->story->estimateAB     = '预计';
$lang->story->hour           = '小时';
$lang->story->status         = '当前状态';
$lang->story->stage          = '所处阶段';
$lang->story->stageAB        = '阶段';
$lang->story->mailto         = '抄送给';
$lang->story->openedBy       = '由谁创建';
$lang->story->openedDate     = '创建日期';
$lang->story->assignedTo     = '指派给';
$lang->story->assignedDate   = '指派日期';
$lang->story->lastEditedBy   = '最后修改';
$lang->story->lastEditedDate = '最后修改日期';
$lang->story->lastEdited     = '最后修改';
$lang->story->closedBy       = '由谁关闭';
$lang->story->closedDate     = '关闭日期';
$lang->story->closedReason   = '关闭原因';
$lang->story->rejectedReason = '拒绝原因';
$lang->story->reviewedBy     = '由谁评审';
$lang->story->reviewedDate   = '评审时间';
$lang->story->version        = '版本号';
$lang->story->project        = '所属项目';
$lang->story->plan           = '所属计划';
$lang->story->planAB         = '计划';
$lang->story->comment        = '备注';
$lang->story->linkStories    = '相关需求';
$lang->story->childStories   = '细分需求';
$lang->story->duplicateStory = '重复需求';
$lang->story->reviewResult   = '评审结果';
$lang->story->preVersion     = '之前版本';
$lang->story->keywords       = '关键词';
$lang->story->newStory       = '继续添加需求';

$lang->story->same = '同上';

$lang->story->useList[0] = '不使用';
$lang->story->useList[1] = '使用';

$lang->story->statusList['']          = '';
$lang->story->statusList['draft']     = '草稿';
$lang->story->statusList['active']    = '激活';
$lang->story->statusList['closed']    = '已关闭';
$lang->story->statusList['changed']   = '已变更';

$lang->story->stageList['']           = '';
$lang->story->stageList['wait']       = '未开始';
$lang->story->stageList['planned']    = '已计划';
$lang->story->stageList['projected']  = '已立项';
$lang->story->stageList['developing'] = '研发中';
$lang->story->stageList['developed']  = '研发完毕';
$lang->story->stageList['testing']    = '测试中';
$lang->story->stageList['tested']     = '测试完毕';
$lang->story->stageList['verified']   = '已验收';
$lang->story->stageList['released']   = '已发布';

$lang->story->reasonList['']           = '';
$lang->story->reasonList['done']       = '已完成';
$lang->story->reasonList['subdivided'] = '已细分';
$lang->story->reasonList['duplicate']  = '重复';
$lang->story->reasonList['postponed']  = '延期';
$lang->story->reasonList['willnotdo']  = '不做';
$lang->story->reasonList['cancel']     = '已取消';
$lang->story->reasonList['bydesign']   = '设计如此';
//$lang->story->reasonList['isbug']      = '是个Bug';

$lang->story->reviewResultList['']        = '';
$lang->story->reviewResultList['pass']    = '确认通过';
$lang->story->reviewResultList['revert']  = '撤销变更';
$lang->story->reviewResultList['clarify'] = '有待明确';
$lang->story->reviewResultList['reject']  = '拒绝';

$lang->story->reviewList[0] = '否';
$lang->story->reviewList[1] = '是';

$lang->story->sourceList['']           = '';
$lang->story->sourceList['customer']   = '客户';
$lang->story->sourceList['user']       = '用户';
$lang->story->sourceList['po']         = '产品经理';
$lang->story->sourceList['market']     = '市场';
$lang->story->sourceList['service']    = '客服';
$lang->story->sourceList['competitor'] = '竞争对手';
$lang->story->sourceList['partner']    = '合作伙伴';
$lang->story->sourceList['dev']        = '开发人员';
$lang->story->sourceList['tester']     = '测试人员';
$lang->story->sourceList['bug']        = 'Bug';
$lang->story->sourceList['other']      = '其他';

$lang->story->priList[]   = '';
$lang->story->priList[3]  = '3';
$lang->story->priList[1]  = '1';
$lang->story->priList[2]  = '2';
$lang->story->priList[4]  = '4';

$lang->story->legendBasicInfo      = '基本信息';
$lang->story->legendLifeTime       = '需求的一生';
$lang->story->legendRelated        = '相关信息';
$lang->story->legendMailto         = '抄送给';
$lang->story->legendAttatch        = '附件';
$lang->story->legendProjectAndTask = '项目任务';
$lang->story->legendBugs           = '相关Bug';
$lang->story->legendFromBug        = '来源Bug';
$lang->story->legendCases          = '相关用例';
$lang->story->legendLinkStories    = '相关需求';
$lang->story->legendChildStories   = '细分需求';
$lang->story->legendSpec           = '需求描述';
$lang->story->legendVerify         = '验收标准';
$lang->story->legendHistory        = '历史记录';
$lang->story->legendMisc           = '其他相关';

$lang->story->lblChange            = '变更需求';
$lang->story->lblReview            = '评审需求';
$lang->story->lblActivate          = '激活需求';
$lang->story->lblClose             = '关闭需求';

$lang->story->affectedProjects     = '影响的项目';
$lang->story->affectedBugs         = '影响的Bug';
$lang->story->affectedCases        = '影响的用例';

$lang->story->specTemplate          = "建议参考的模板：作为一名<<i class='red'>某种类型的用户</i>>，我希望<<i class='red'>达成某些目的</i>>，这样可以<<i class='red'>开发的价值</i>>。";
$lang->story->needNotReview         = '不需要评审';
$lang->story->afterSubmit           = "添加之后";
$lang->story->successSaved          = "需求成功添加，";
$lang->story->confirmDelete         = "您确认删除该需求吗?";
$lang->story->confirmBatchClose     = "您确认关闭这些需求吗?";
$lang->story->errorFormat           = '需求数据有误';
$lang->story->errorEmptyTitle       = '标题不能为空';
$lang->story->mustChooseResult      = '必须选择评审结果';
$lang->story->mustChoosePreVersion  = '必须选择回溯的版本';
$lang->story->ajaxGetProjectStories = '接口:获取项目需求列表';
$lang->story->ajaxGetProductStories = '接口:获取产品需求列表';

$lang->story->form = new stdclass();
$lang->story->form->titleNote = '一句话简要表达需求内容';
$lang->story->form->area      = '该需求所属范围';
$lang->story->form->desc      = '描述及标准，什么需求？如何验收？';
$lang->story->form->resource  = '资源分配，有谁完成？需要多少时间？';
$lang->story->form->file      = '附件，如果该需求有相关文件，请点此上传。';

$lang->story->action = new stdclass();
$lang->story->action->reviewed            = array('main' => '$date, 由 <strong>$actor</strong> 记录评审结果，结果为 <strong>$extra</strong>。', 'extra' => $lang->story->reviewResultList);
$lang->story->action->closed              = array('main' => '$date, 由 <strong>$actor</strong> 关闭，原因为 <strong>$extra</strong>。', 'extra' => $lang->story->reasonList);
$lang->story->action->linked2plan         = array('main' => '$date, 由 <strong>$actor</strong> 关联到计划 <strong>$extra</strong>。'); 
$lang->story->action->unlinkedfromplan    = array('main' => '$date, 由 <strong>$actor</strong> 从计划 <strong>$extra</strong> 移除。'); 
$lang->story->action->linked2project      = array('main' => '$date, 由 <strong>$actor</strong> 关联到项目 <strong>$extra</strong>。'); 
$lang->story->action->unlinkedfromproject = array('main' => '$date, 由 <strong>$actor</strong> 从项目 <strong>$extra</strong> 移除。'); 

/* 统计报表。*/
$lang->story->report = new stdclass();
$lang->story->report->common = '报表';
$lang->story->report->select = '请选择报表类型';
$lang->story->report->create = '生成报表';
$lang->story->report->value  = '需求数';

$lang->story->report->charts['storysPerProduct']        = '产品需求数量';
$lang->story->report->charts['storysPerModule']         = '模块需求数量';
$lang->story->report->charts['storysPerSource']         = '需求来源统计';
$lang->story->report->charts['storysPerPlan']           = '计划进行统计';
$lang->story->report->charts['storysPerStatus']         = '状态进行统计';
$lang->story->report->charts['storysPerStage']          = '所处阶段进行统计';
$lang->story->report->charts['storysPerPri']            = '优先级进行统计';
$lang->story->report->charts['storysPerEstimate']       = '预计工时进行统计';
$lang->story->report->charts['storysPerOpenedBy']       = '由谁创建来进行统计';
$lang->story->report->charts['storysPerAssignedTo']     = '当前指派来进行统计';
$lang->story->report->charts['storysPerClosedReason']   = '关闭原因来进行统计';
$lang->story->report->charts['storysPerChange']         = '变更次数来进行统计';

$lang->story->report->options = new stdclass();
$lang->story->report->options->graph = new stdclass();
$lang->story->report->options->swf                     = 'pie2d';
$lang->story->report->options->width                   = 'auto';
$lang->story->report->options->height                  = 300;
$lang->story->report->options->graph->baseFontSize     = 12;
$lang->story->report->options->graph->showNames        = 1;
$lang->story->report->options->graph->formatNumber     = 1;
$lang->story->report->options->graph->decimalPrecision = 0;
$lang->story->report->options->graph->animation        = 0;
$lang->story->report->options->graph->rotateNames      = 0;
$lang->story->report->options->graph->yAxisName        = 'COUNT';
$lang->story->report->options->graph->pieRadius        = 100; // 饼图直径。
$lang->story->report->options->graph->showColumnShadow = 0;   // 是否显示柱状图阴影。

$lang->story->report->storysPerProduct      = new stdclass();     
$lang->story->report->storysPerModule       = new stdclass();
$lang->story->report->storysPerSource       = new stdclass();
$lang->story->report->storysPerPlan         = new stdclass();
$lang->story->report->storysPerStatus       = new stdclass();
$lang->story->report->storysPerStage        = new stdclass();
$lang->story->report->storysPerPri          = new stdclass();
$lang->story->report->storysPerOpenedBy     = new stdclass();
$lang->story->report->storysPerAssignedTo   = new stdclass();
$lang->story->report->storysPerClosedReason = new stdclass();
$lang->story->report->storysPerEstimate     = new stdclass();
$lang->story->report->storysPerChange       = new stdclass();

$lang->story->report->storysPerProduct->item      = '产品';     
$lang->story->report->storysPerModule->item       = '模块';
$lang->story->report->storysPerSource->item       = '来源';
$lang->story->report->storysPerPlan->item         = '计划';
$lang->story->report->storysPerStatus->item       = '状态';
$lang->story->report->storysPerStage->item        = '阶段';
$lang->story->report->storysPerPri->item          = '优先级';
$lang->story->report->storysPerOpenedBy->item     = '用户';
$lang->story->report->storysPerAssignedTo->item   = '用户';
$lang->story->report->storysPerClosedReason->item = '原因';
$lang->story->report->storysPerEstimate->item     = '预计工时';
$lang->story->report->storysPerChange->item       = '变更次数';

$lang->story->report->storysPerProduct->graph      = new stdclass();     
$lang->story->report->storysPerModule->graph       = new stdclass();
$lang->story->report->storysPerSource->graph       = new stdclass();
$lang->story->report->storysPerPlan->graph         = new stdclass();
$lang->story->report->storysPerStatus->graph       = new stdclass();
$lang->story->report->storysPerStage->graph        = new stdclass();
$lang->story->report->storysPerPri->graph          = new stdclass();
$lang->story->report->storysPerOpenedBy->graph     = new stdclass();
$lang->story->report->storysPerAssignedTo->graph   = new stdclass();
$lang->story->report->storysPerClosedReason->graph = new stdclass();
$lang->story->report->storysPerEstimate->graph     = new stdclass();
$lang->story->report->storysPerChange->graph       = new stdclass();

$lang->story->report->storysPerProduct->graph->xAxisName      = '产品';
$lang->story->report->storysPerModule->graph->xAxisName       = '模块';
$lang->story->report->storysPerSource->graph->xAxisName       = '来源';
$lang->story->report->storysPerPlan->graph->xAxisName         = '产品计划';
$lang->story->report->storysPerStatus->graph->xAxisName       = '状态';
$lang->story->report->storysPerStage->graph->xAxisName        = '所处阶段';
$lang->story->report->storysPerPri->graph->xAxisName          = '优先级';
$lang->story->report->storysPerOpenedBy->graph->xAxisName     = '由谁创建';
$lang->story->report->storysPerAssignedTo->graph->xAxisName   = '当前指派';
$lang->story->report->storysPerClosedReason->graph->xAxisName = '关闭原因';
$lang->story->report->storysPerEstimate->graph->xAxisName     = '预计时间';
$lang->story->report->storysPerChange->graph->xAxisName       = '变更次数';

$lang->story->placeholder = new stdclass();
$lang->story->placeholder->estimate = "完成该需求的工作量";

$lang->story->chosen = new stdClass();
$lang->story->chosen->reviewedBy = '选择评审人...';
