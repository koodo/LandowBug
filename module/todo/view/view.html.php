<?php
/**
 * The view file of view method of todo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     todo
 * @version     $Id: view.html.php 4955 2013-07-02 01:47:21Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php if(!$todo->private or ($todo->private and $todo->account == $app->user->account)):?>
<table class='table-1 a-left'> 
  <caption><?php echo $lang->todo->common . ' #' . $todo->id . ' ' . $todo->name;?></caption>
  <tr>
    <th class='rowhead'><?php echo $lang->todo->account;?></th>
    <td><?php echo $todo->account;?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->date;?></th>
    <td><?php echo $todo->date == '20300101' ? $lang->todo->periods['future'] : date(DT_DATE1, strtotime($todo->date));?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->type;?></th>
    <td><?php echo $lang->todo->typeList[$todo->type];?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->pri;?></th>
    <td><?php echo $lang->todo->priList[$todo->pri];?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->name;?></th>
    <td>
      <?php 
      if($todo->type == 'bug')    echo html::a($this->createLink('bug',  'view', "id={$todo->idvalue}"), $todo->name);
      if($todo->type == 'task')   echo html::a($this->createLink('task', 'view', "id={$todo->idvalue}"), $todo->name);
      if($todo->type == 'custom') echo $todo->name;
      ?>
    </td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->desc;?></th>
    <td class='content'><?php echo $todo->desc;?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->status;?></th>
    <td><?php echo $lang->todo->statusList[$todo->status];?></td>
  </tr>  
  <tr>
    <th class='rowhead'><?php echo $lang->todo->beginAndEnd;?></th>
    <td>
      <?php
      if(isset($times[$todo->begin])) echo $times[$todo->begin];
      if(isset($times[$todo->end]))   echo ' ~ ' . $times[$todo->end];
      ?>
    </td>
  </tr>  
</table>
<div class='a-center f-16px strong pb-10px'>
  <?php
  if($this->session->todoList)
  {
      $browseLink = $this->session->todoList;
  }
  elseif($todo->account == $app->user->account)
  {
      $browseLink = $this->createLink('my', 'todo');
  }
  else
  {
      $browseLink = $this->createLink('user', 'todo', "account=$todo->account");
  }

  common::printIcon('todo', 'finish', "id=$todo->id", $todo, 'list', '', 'hiddenwin', 'showinonlybody');
  if($todo->account == $app->user->account)
  {
      common::printIcon('todo', 'edit',   "todoID=$todo->id");
      common::printIcon('todo', 'delete', "todoID=$todo->id", '', 'button', '', 'hiddenwin');
  }
  common::printRPN($browseLink);
  ?>
</div>
<?php $actionTheme = 'table'; include '../../common/view/action.html.php';?>
<?php else:?>
<?php echo $lang->todo->thisIsPrivate;?>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
