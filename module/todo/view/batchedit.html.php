<?php
/**
 * The batch edit view of todo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     todo
 * @version     $Id: create.html.php 2741 2012-04-07 07:24:21Z areyou123456 $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<form method='post' target='hiddenwin' action='<?php echo $this->inlink('batchEdit', "from=todoBatchEdit");?>'>
  <table class='table-1 fixed'> 
    <caption><?php echo $lang->todo->batchEdit . $lang->colon;?></caption>
    <tr>
      <th class='w-20px'>   <?php echo $lang->idAB;?></th> 
      <th class='w-150px'>  <?php echo $lang->todo->date;?></th>
      <th class='w-100px'>  <?php echo $lang->todo->type;?></th>
      <th class='w-70px'>   <?php echo $lang->todo->pri;?></th>
      <th class='w-p65 red'><?php echo $lang->todo->name;?></th>
      <th class='w-140px'>  <?php echo $lang->todo->beginAndEnd;?></th>
      <th class='w-70px'>   <?php echo $lang->todo->status;?></th>
    </tr>

    <?php foreach($editedTodos as $todo):?>
    <tr class='a-center'>
      <td><?php echo $todo->id . html::hidden("todoIDList[$todo->id]", $todo->id);?></td>
      <td><?php echo html::input("dates[$todo->id]", $todo->date, "class='text-2 date'");?></td>
      <td><?php echo html::select("types[$todo->id]", $lang->todo->typeList, $todo->type, "onchange=loadList(this.value,$todo->id) class='select-1'");?></td>
      <td><?php echo html::select("pris[$todo->id]", $lang->todo->priList, $todo->pri, 'class=select-1');?></td>
      <td>
        <div id='<?php echo "nameBox" . $todo->id;?>' class='hidden'><? echo html::input("names[$todo->id]", '', "class='f-left text-1 hiddenwin'"); ?></div>
        <div class='<?php echo "nameBox" . $todo->id;?>'>
        <?php 
        if($todo->type == 'custom')
        {
          echo html::input("names[$todo->id]", $todo->name, "class='f-left text-1'"); ;
        }
        elseif($todo->type == 'task')
        {
          echo  html::select("tasks[$todo->id]", $tasks, $todo->idvalue, 'class="select-1 f-left"');
        }
        elseif($todo->type == 'bug')
        {
          echo  html::select("bugs[$todo->id]", $bugs, $todo->idvalue, 'class="select-1 f-left"');
        }
        ?>
        </div>
      </td>
      <td><?php echo html::select("begins[$todo->id]", $times, $todo->begin) . html::select("ends[$todo->id]", $times, $todo->end);?></td>
      <td><?php echo html::select("status[$todo->id]", $lang->todo->statusList, $todo->status, "class='select-1'");?></td>
    </tr>  
    <?php endforeach;?>
    <?php if(isset($suhosinInfo)):?>
    <tr><td colspan='6'><div class='f-left blue'><?php echo $suhosinInfo;?></div></td></tr>
    <?php endif;?>
    <tr><td colspan='6' class='a-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include './footer.html.php';?>
<script language='Javascript'>selectNext();</script>
