<?php
/**
 * The create view of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     story
 * @version     $Id: create.html.php 4902 2013-06-26 05:25:58Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<?php include '../../common/view/form.html.php';?>
<?php js::set('holders', $lang->story->placeholder); ?>
<form method='post' enctype='multipart/form-data' id='dataform' class='ajaxForm'>
  <table align='center' class='table-1'> 
    <caption><?php echo $lang->story->create;?></caption>
    <tr>
      <th class='rowhead'><?php echo $lang->story->product;?></th>
      <td>
        <?php echo html::select('product', $products, $productID, "onchange=loadProduct(this.value); class='select-3'");?>
        <span id='moduleIdBox'>
        <?php 
        echo html::select('module', $moduleOptionMenu, $moduleID);
        if(count($moduleOptionMenu) == 1)
        {
            echo html::a($this->createLink('tree', 'browse', "rootID=$productID&view=story"), $lang->tree->manage, '_blank');
            echo html::a("javascript:loadProductModules($productID)", $lang->refresh);
        }
        ?>
        </span>
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->story->plan;?></th>
      <td>
        <span id='planIdBox'>
        <?php 
        echo html::select('plan', $plans, $planID, 'class=select-3');
        if(count($plans) == 1) 
        {
            echo html::a($this->createLink('productplan', 'create', "productID=$productID"), $lang->productplan->create, '_blank');
            echo html::a("javascript:loadProductPlans($productID)", $lang->refresh);
        }
        ?>
        </span>
      </td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->source;?></th>
      <td><?php echo html::select('source', $lang->story->sourceList, $source, 'class=select-3');?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->title;?></th>
      <td><?php echo html::input('title', $storyTitle, "class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->story->spec;?></th>
      <td><?php echo html::textarea('spec', $spec, "rows='9' class='text-1'");?><br /><?php echo $lang->story->specTemplate;?></td>
    </tr>  
       <tr>
      <th class='rowhead'><?php echo $lang->story->verify;?></th>
      <td><?php echo html::textarea('verify', $verify, "rows='6' class='text-1'");?></td>
    </tr> 
     <tr>
      <th class='rowhead'><?php echo $lang->story->pri;?></th>
      <td><?php echo html::select('pri', (array)$lang->story->priList, $pri, 'class=select-3');?></td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->story->estimate;?></th>
      <td><?php echo html::input('estimate', $estimate, "class='text-3'") . $lang->story->hour;?></td>
    </tr> 
    <tr>
      <th class='rowhead'><?php echo $lang->story->reviewedBy;?></th>
      <td><?php echo html::select('assignedTo', $users, '', 'class=select-3') . html::checkbox('needNotReview', $lang->story->needNotReview, '', "id='needNotReview'");?></td>
    </tr>  
     <tr>
      <th class='rowhead'><nobr><?php echo $lang->story->mailto;?></nobr></th>
      <td>
        <?php 
        echo html::select('mailto[]', $users, str_replace(' ' , '', $mailto), "multiple"); 
        if($contactLists) echo html::select('', $contactLists, '', "class='f-right' onchange=\"setMailto('mailto', this.value)\"");
        ?>
      </td>
    </tr>

    <tr>
      <th class='rowhead'><nobr><?php echo $lang->story->keywords;?></nobr></th>
      <td><?php echo html::input('keywords', $keywords, 'class="text-1"');?></td>
    </tr>
   <tr>
      <th class='rowhead'><?php echo $lang->story->legendAttatch;?></th>
      <td><?php echo $this->fetch('file', 'buildform');?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
  </table>
  <span id='responser'></span>
</form>
<?php include '../../common/view/footer.html.php';?>
