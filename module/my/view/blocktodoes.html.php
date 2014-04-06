<div class='block linkbox1'>
<table class='table-1 fixed colored'>
  <caption>
    <div class='f-left'><i class='icon icon-list-ul'></i>&nbsp; <?php echo $lang->my->todo;?></div>
    <div class='f-right'><?php echo html::a($this->createLink('my', 'todo'), $lang->more . "&nbsp;<i class='icon-th icon icon-double-angle-right'></i>");?></div>
  </caption>
  <?php 
  foreach($todos as $todo)
  {
      echo "<tr><td class='nobr'>" . "#$todo->id " . html::a($this->createLink('todo', 'view', "id=$todo->id"), $todo->name, '', "title=$todo->name") . "</td><td width='5'</td></tr>";
  }
  ?>
</table>
</div>
