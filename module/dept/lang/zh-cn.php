<?php
/**
 * The dept module zh-cn file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dept
 * @version     $Id: zh-cn.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
$lang->dept->common      = '部门结构';
$lang->dept->add         = "添加";
$lang->dept->addChild    = "添加下级部门";
$lang->dept->manageChild = "下级部门";
$lang->dept->delete      = "删除部门";
$lang->dept->browse      = "部门维护";
$lang->dept->manage      = "维护部门结构";
$lang->dept->updateOrder = "更新排序";
$lang->dept->users       = "成员列表";

$lang->dept->saveButton    = " 保存 (S) ";
$lang->dept->confirmDelete = " 您确定删除该部门吗？";

$lang->dept->error = new stdclass();
$lang->dept->error->hasSons  = '该部门有子部门，不能删除！';
$lang->dept->error->hasUsers = '该部门有职员，不能删除！';
