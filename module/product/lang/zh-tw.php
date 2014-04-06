<?php
/**
 * The product module zh-tw file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: zh-tw.php 5091 2013-07-10 06:06:46Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->product->common    = '產品視圖';
$lang->product->index     = "產品首頁";
$lang->product->browse    = "瀏覽產品";
$lang->product->dynamic   = "動態";
$lang->product->view      = "產品信息";
$lang->product->edit      = "編輯產品";
$lang->product->batchEdit = "批量編輯";
$lang->product->create    = "新增產品";
$lang->product->read      = "產品詳情";
$lang->product->delete    = "刪除產品";
$lang->product->close     = "關閉";
$lang->product->select    = '--請選擇產品--';
$lang->product->mine      = '我負責：';
$lang->product->other     = '其他：';
$lang->product->closed    = '已關閉&raquo;';

$lang->product->basicInfo = '基本信息';
$lang->product->otherInfo = '其他信息';

$lang->product->plans    = '計劃數';
$lang->product->releases = '發佈數';
$lang->product->docs     = '文檔數';
$lang->product->bugs     = '相關BUG';
$lang->product->projects = '關聯項目數';
$lang->product->cases    = '用例數';
$lang->product->bulids   = 'BULID數';
$lang->product->roadmap  = '路線圖';
$lang->product->doc      = '文檔列表';
$lang->product->project  = '項目列表';

$lang->product->selectProduct   = "請選擇產品";
$lang->product->saveButton      = " 保存 (S) ";
$lang->product->confirmDelete   = " 您確定刪除該產品嗎？";
$lang->product->ajaxGetProjects = "介面:項目列表";
$lang->product->ajaxGetPlans    = "介面:計劃列表";

$lang->product->errorFormat    = '產品數據格式不正確';
$lang->product->errorEmptyName = '產品名稱不能為空';
$lang->product->errorEmptyCode = '產品代號不能為空';
$lang->product->errorNoProduct = '還沒有創建產品！';
$lang->product->accessDenied   = '您無權訪問該產品';

$lang->product->id        = '編號';
$lang->product->company   = '所屬公司';
$lang->product->name      = '產品名稱';
$lang->product->code      = '產品代號';
$lang->product->order     = '排序';
$lang->product->status    = '狀態';
$lang->product->desc      = '產品描述';
$lang->product->PO        = '產品負責人';
$lang->product->QD        = '測試負責人';
$lang->product->RD        = '發佈負責人';
$lang->product->acl       = '訪問控制';
$lang->product->whitelist = '分組白名單';

$lang->product->moduleStory  = '按模組';
$lang->product->searchStory  = '搜索';
$lang->product->assignedToMe = '指派給我';
$lang->product->openedByMe   = '由我創建';
$lang->product->reviewedByMe = '由我評審';
$lang->product->closedByMe   = '由我關閉';
$lang->product->draftStory   = '草稿';
$lang->product->activeStory  = '激活';
$lang->product->changedStory = '已變更';
$lang->product->closedStory  = '已關閉';

$lang->product->allStory    = '全部需求';
$lang->product->allProduct  = '全部產品';
$lang->product->allProductsOfProject = '全部關聯產品';

$lang->product->statusList['']       = '';
$lang->product->statusList['normal'] = '正常';
$lang->product->statusList['closed'] = '結束';

$lang->product->aclList['open']    = '預設設置(有產品視圖權限，即可訪問)';
$lang->product->aclList['private'] = '私有產品(只有項目團隊成員才能訪問)';
$lang->product->aclList['custom']  = '自定義白名單(團隊成員和白名單的成員可以訪問)';

$lang->product->storySummary = "本頁共 <strong>%s</strong> 個需求，預計 <strong>%s</strong> 個工時，用例覆蓋率<strong>%s</strong>。";
$lang->product->noMatched    = '找不到包含"%s"的產品';
