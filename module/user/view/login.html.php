<?php
/**
 * The html template file of login method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: login.html.php 5084 2013-07-10 01:31:38Z wyd621@gmail.com $
 */
include '../../common/view/header.lite.html.php';
?>

<div id="container">
  <div id="login-panel">
    <div class="panel-head">
      <h3><?php printf($lang->welcome, $app->company->name);?></h3>
      <!--
      <div class="nav">
        <a href="###" id="lang" class="btn" title="Change Language/更换语言/更換語言"><?php echo $config->langs[$this->app->getClientLang()]; ?> <i class="icon-caret-down"></i></a>
        <a href="###" id="mobile" class="btn" title="<?php echo $lang->user->mobileLogin; ?>"><i class="icon-mobile-phone icon-2x"></i></a>
        <ul class="droppanel" id="langs">
          <?php foreach($config->langs as $key => $value):?>
          <li><a href="###" data-value="<?php echo $key; ?>" class="<?php echo $key==$this->app->getClientLang()?'active':''; ?>"><?php echo $value; ?></a></li>
          <?php endforeach;?>
        </ul> 
        <div class="droppanel" id="qrcode">
          <h4><i class="icon-mobile-phone icon-large"></i> <?php echo $lang->user->mobileLogin ?></h4>
          <?php if(extension_loaded('gd')):?>
          <img src='<?php echo $this->createLink('misc', 'qrcode');?>' />
          <?php else:?>
          <table width='300' class='mt-10px bd-none'>
            <tr><td><?php echo $noGDLib;?></td></tr>
          </table>
          <?php endif;?>
        </div>
      </div>
      -->
    </div>
    <br />
    <div class="panel-content" id="login-form">
      <form method='post' target='hiddenwin'>
        <table>
          <tr>
            <td class="attr">邮箱</td>
            <td><input class='text-2' type='text' name='account' id='account' /></td>
          </tr>
          <tr>
            <td class="attr"><?php echo $lang->user->password;?></td>
            <td><input class='text-2' type='password' name='password' /></td>
          </tr>
          <tr>
            <td class="attr"></td>
            <td id="keeplogin"><?php echo html::checkBox('keepLogin', $lang->user->keepLogin, $keepLogin);?></td>
          </tr>
          <tr>
            <td></td>
            <td>
            <?php 
            echo html::submitButton($lang->login);
            ?>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <?php if(isset($demoUsers)):?>  
    <div id='demoUsers' class="panel-foot">
      <span><?php echo $lang->user->loginWithDemoUser; ?></span>
      <?php
      $sign = $config->requestType == 'GET' ? '&' : '?';
      if(isset($demoUsers['productManager'])) echo html::a(inlink('login') . $sign . "account=productManager&password=123456", $demoUsers['productManager'], 'hiddenwin');
      if(isset($demoUsers['projectManager'])) echo html::a(inlink('login') . $sign . "account=projectManager&password=123456", $demoUsers['projectManager'], 'hiddenwin');
      if(isset($demoUsers['testManager']))    echo html::a(inlink('login') . $sign . "account=testManager&password=123456",    $demoUsers['testManager'],    'hiddenwin');
      if(isset($demoUsers['dev1']))           echo html::a(inlink('login') . $sign . "account=dev1&password=123456",           $demoUsers['dev1'],           'hiddenwin');
      if(isset($demoUsers['tester1']))        echo html::a(inlink('login') . $sign . "account=tester1&password=123456",        $demoUsers['tester1'],        'hiddenwin');
      ?>  
    </div>  
    <?php endif;?>  
  </div>
</div>

<?php include '../../common/view/footer.lite.html.php';?>
