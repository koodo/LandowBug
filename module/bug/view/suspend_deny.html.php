<?php
/**
 * The confirm file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: resolve.html.php 1914 2011-06-24 10:11:25Z yidong@cnezsoft.com $
 * @link        http://www.zentao.net
 */
?>
<?php
include '../../common/view/header.html.php';
include '../../common/view/kindeditor.html.php';
include '../../common/view/chosen.html.php';
js::set('holders', $lang->bug->placeholder);
js::set('page', 'suspend');
?>
<input type="hidden" value="<?php echo $suspendRateLevel; ?>" id="suspendLevel" />

<div style="text-align:center;margin-top:65px;">
    <div>
        <div style="font-size:55px;">挂起率已经到达</div>
        <span  style="font-size:100px;" class="suspend-rate suspend-rate-hig"><?php echo $suspendRate;?>%</span>
        <div style="font-size:25px;color:#222;">你不能挂起更多bug了</div>
    </div>
</div>
<?php include '../../common/view/footer.html.php';
