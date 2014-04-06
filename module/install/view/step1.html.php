<?php
/**
 * The html template file of step1 method of install module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: step1.html.php 4129 2013-01-18 01:58:14Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<table align='center' class='table-6 a-center'>
  <caption><?php echo $lang->install->checking;?></caption>
  <tr>
    <th class='w-p20 a-center'><?php echo $lang->install->checkItem;?></th>
    <th class='w-p25 a-center'><?php echo $lang->install->current?></th>
    <th class='w-p15 a-center'><?php echo $lang->install->result?></th>
    <th class="a-center"><?php echo $lang->install->action?></th>
  </tr>
  <tr>
    <th><?php echo $lang->install->phpVersion;?></th>
    <td><?php echo $phpVersion;?></td>
    <td class='<?php echo $phpResult;?>'><?php echo $lang->install->$phpResult;?></td>
    <td class='a-left f-12px'><?php if($phpResult == 'fail') echo $lang->install->phpFail;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->install->pdo;?></th>
    <td><?php $pdoResult == 'ok' ? printf($lang->install->loaded) : printf($lang->install->unloaded);?></td>
    <td class='<?php echo $pdoResult;?>'><?php echo $lang->install->$pdoResult;?></td>
    <td class='a-left f-12px'><?php if($pdoResult == 'fail') echo $lang->install->pdoFail;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->install->pdoMySQL;?></th>
    <td><?php $pdoMySQLResult == 'ok' ? printf($lang->install->loaded) : printf($lang->install->unloaded);?></td>
    <td class='<?php echo $pdoMySQLResult;?>'><?php echo $lang->install->$pdoMySQLResult;?></td>
    <td class='a-left f-12px'><?php if($pdoMySQLResult == 'fail') echo $lang->install->pdoMySQLFail;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->install->json;?></th>
    <td><?php $jsonResult == 'ok' ? printf($lang->install->loaded) : printf($lang->install->unloaded);?></td>
    <td class='<?php echo $jsonResult;?>'><?php echo $lang->install->$jsonResult;?></td>
    <td class='a-left f-12px'><?php if($jsonResult == 'fail') echo $lang->install->jsonFail;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->install->tmpRoot;?></th>
    <td>
      <?php
      $tmpRootInfo['exists']   ? print($lang->install->exists)   : print($lang->install->notExists);
      $tmpRootInfo['writable'] ? print($lang->install->writable) : print($lang->install->notWritable);
      ?>
    </td>
    <td class='<?php echo $tmpRootResult;?>'><?php echo $lang->install->$tmpRootResult;?></td>
    <td class='a-left f-12px'>
      <?php 
      if(!$tmpRootInfo['exists'])   printf($lang->install->mkdir, $tmpRootInfo['path'], $tmpRootInfo['path']);
      if(!$tmpRootInfo['writable']) printf($lang->install->chmod, $tmpRootInfo['path'], $tmpRootInfo['path']);
      ?>
    </td>
  </tr>
  <tr>
    <th><?php echo $lang->install->dataRoot;?></th>
    <td>
      <?php
      $dataRootInfo['exists']   ? print($lang->install->exists)   : print($lang->install->notExists);
      $dataRootInfo['writable'] ? print($lang->install->writable) : print($lang->install->notWritable);
      ?>
    </td>
    <td class='<?php echo $dataRootResult;?>'><?php echo $lang->install->$dataRootResult;?></td>
    <td class='a-left f-12px'>
      <?php 
      if(!$dataRootInfo['exists'])   printf($lang->install->mkdir, $dataRootInfo['path'], $dataRootInfo['path']);
      if(!$dataRootInfo['writable']) printf($lang->install->chmod, $dataRootInfo['path'], $dataRootInfo['path']);
      ?>
    </td>
  </tr>
  <?php if(preg_match('/WIN/i', PHP_OS)):?>
  <tr>
    <th><?php echo $lang->install->session;?></th>
    <td>
      <?php
      $sessionInfo['exists']   ? print($lang->install->exists)   : print($lang->install->notExists);
      $sessionInfo['writable'] ? print($lang->install->writable) : print($lang->install->notWritable);
      ?>
    </td>
    <td class='<?php echo $sessionResult;?>'><?php echo $lang->install->$sessionResult;?></td>
    <td class='a-left f-12px'>
      <?php 
      if($sessionInfo['path'])
      {
          if(!$sessionInfo['exists'])   printf($lang->install->mkdir, $sessionInfo['path'], $sessionInfo['path']);
          if(!$sessionInfo['writable']) printf($lang->install->chmod, $sessionInfo['path'], $sessionInfo['path']);
      }
      else
      {
          echo $lang->install->sessionFail; 
      }
      ?>
    </td>
  </tr>
  <?php endif;?>
  <tr>
    <td colspan='4'>
    <?php
    if($phpResult == 'ok' and $pdoResult == 'ok' and $pdoMySQLResult == 'ok' and $tmpRootResult == 'ok' and $dataRootResult == 'ok' and $sessionResult == 'ok')
    {
        echo html::a($this->createLink('install', 'step2'), $lang->install->next);
    }
    else
    {
        echo html::a($this->createLink('install', 'step1'), $lang->install->reload);
        if($pdoResult == 'fail' or $pdoMySQLResult == 'fail')
        {
            echo '<p class="f-12px a-left">' . '<strong>' . $lang->install->phpINI . '</strong><br />' . nl2br($this->install->getIniInfo()) . '</p>';
        }
    }
    ?>
    </td>
  </tr>
</table>
<?php include '../../common/view/footer.lite.html.php';?>
