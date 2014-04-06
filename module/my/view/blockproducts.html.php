<div class='block linkbox1' id='productbox'>
<?php if(empty($productStats)):?>
<table class='table-1 a-center' height='138px'>
  <caption><i class="icon icon-th"></i>&nbsp; <?php echo $lang->my->home->products;?></caption>
  <tr>
    <td valign='middle'>
      <table class='a-left bd-none' align='center'>
        <tr>
          <td><?php echo html::a($this->createLink('product', 'create'), $lang->my->home->createProduct);?></td>
          <td><?php echo $lang->my->home->help;?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php else:?>
  <table class='table-1 colored fixed'>
    <tr class='colhead'>
      <th class='w-150px'><div class='f-left'><i class="icon icon-th"></i>&nbsp; <?php echo $lang->product->name;?></div></th>
      <th title='<?php echo $lang->story->common;?>'><?php echo $lang->story->statusList['active'];?></th>
      <th title='<?php echo $lang->story->common;?>'><?php echo $lang->story->statusList['changed'];?></th>
      <th title='<?php echo $lang->story->common;?>'><?php echo $lang->story->statusList['draft'];?></th>
      <th title='<?php echo $lang->story->common;?>'><?php echo $lang->story->statusList['closed'];?></th>
      <th><?php echo $lang->product->plans;?></th>
      <th><?php echo $lang->product->releases;?></th>
      <th><?php echo $lang->product->bugs;?></th>
      <th title='<?php echo $lang->bug->common;?>'><?php echo $lang->bug->unResolved;?></th>
    </tr>
    <?php foreach($productStats as $product):?>
    <tr class='a-center' style='height:30px'>
      <td class='a-left'><?php echo html::a($this->createLink('product', 'view', 'product=' . $product->id), $product->name, '', "title=$product->name");?></td>
      <td><?php echo $product->stories['active']?></td>
      <td><?php echo $product->stories['changed']?></td>
      <td><?php echo $product->stories['draft']?></td>
      <td><?php echo $product->stories['closed']?></td>
      <td><?php echo $product->plans?></td>
      <td><?php echo $product->releases?></td>
      <td><?php echo $product->bugs?></td>
      <td><?php echo $product->unResolved?></td>
    </tr>
    <?php endforeach;?>
  </table>
<?php endif;?>
</div>
