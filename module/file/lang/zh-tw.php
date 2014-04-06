<?php
/**
 * The file module zh-tw file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id: zh-tw.php 4630 2013-04-10 05:54:08Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
$lang->file = new stdclass();
$lang->file->common        = '附件';
$lang->file->download      = '下載附件';
$lang->file->edit          = '重命名';
$lang->file->inputFileName = '請輸入附件名稱';
$lang->file->delete        = '刪除附件';
$lang->file->export2CSV    = '導出CSV';
$lang->file->ajaxUpload    = '介面：編輯器上傳附件';
$lang->file->label         = '標題：';
$lang->file->maxUploadSize = "<span class='red'>%s</span>";

$lang->file->errorNotExists   = "<span class='red'>檔案夾 '%s' 不存在</span>";
$lang->file->errorCanNotWrite = "<span class='red'>檔案夾 '%s' 不可寫,請改變檔案夾的權限。在linux中輸入指令:sudo chmod -R 777 '%s'</span>";
$lang->file->confirmDelete    = " 您確定刪除該附件嗎？";
