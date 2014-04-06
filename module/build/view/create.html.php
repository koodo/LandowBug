<?php
/**
 * The create view of build module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     build
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<form method='post' target='hiddenwin' id='dataform'>
  <table class='table-1 fixed'> 
    <caption><?php echo $lang->build->create;?></caption>
    <input type="hidden" value="1" name="product" />
    <!--
    <tr>
      <th class='rowhead'><?php echo $lang->build->product;?></th>
      <td><?php echo html::select('product', $products, '', "class='select-3'");?></td>
    </tr>
    -->
    <tr>
      <th class='rowhead'><?php echo $lang->build->name;?></th>
      <td>
        <?php echo html::input('name', '', "class='text-3'");?>
        <?php if($lastBuild) echo '<span class="gray">(' . $lang->build->last . ': ' . $lastBuild->name . ')</span>';?>
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->build->builder;?></th>
      <td><?php echo html::select('builder', $users, $app->user->account, 'class="select-3"');?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->build->date;?></th>
      <td><?php echo html::input('date', helper::today(), "class='text-3 date'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->build->scmPath;?></th>
      <td><?php echo html::input('scmPath', '', "class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->build->filePath;?></th>
      <td><?php echo html::input('filePath', '', "class='text-1'");?></td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo $lang->build->linkStoriesAndBugs;?></th>
      <td>

        <table class='bd-none' style='margin-bottom:0px;width:91%'>
          <tr>
            <td class='w-p50' style='padding-left:0px;padding-right:8px;'>
              <table class='mainTable'>
                <caption style='padding-left:3px'><?php echo html::selectAll('story', 'checkbox') . ' ' . $lang->build->linkStories;?></caption>
                <tr style='border-bottom:none'>
                  <td style='border-bottom:none; padding:0px'>
                    <div class='contentDiv'>
                      <table class='table-1 fixed bd-none' id='story'>
                        <?php foreach($stories as $key => $story):?>
                        <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id", '', true); ?>
                        <tr class='a-center'>
                          <td class='w-id a-left'>
                            <input type='checkbox' name='stories[]' value="<?php echo $story->id;?>" <?php if($story->stage == 'developed' or $story->status == 'closed') echo 'checked';?>> <?php echo sprintf('%03d', $story->id);?>
                          </td>
                          <td class='a-left nobr'><?php echo html::a($storyLink,$story->title, '', "class='preview'");?></td>
                          <td class='<?php echo $story->status;?> w-50px'><?php echo $lang->story->statusList[$story->status];?></td>
                          <td class='w-80px'><?php echo $lang->story->stageList[$story->stage];?></td>
                        </tr>
                      <?php endforeach;?>
                      </table>
                    </div>
                  </td>
                </tr>
              </table>
            </td>

            <td class='w-p50' style='padding-left:0px;padding-right:5px;'>
              <table class='mainTable'>
                <caption style='padding-left:3px'><?php echo html::selectAll('bug', 'checkbox') . ' ' . $lang->build->linkBugs;?></caption>
                <tr style='border-bottom:none'>
                  <td style='border-bottom:none; padding:0px'>
                    <div class='contentDiv'>
                      <table class='table-1 fixed bd-none' id='bug'>
                        <?php foreach($bugs as $bug):?>
                        <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug->id", '', true);?>
                        <tr class='a-center'>
                          <td class='w-id a-left'>
                            <input type='checkbox' name='bugs[]' value="<?php echo $bug->id;?>" <?php if($bug->status == 'resolved' or $bug->status == 'closed') echo "checked";?>> <?php echo sprintf('%03d', $bug->id);?>
                          </td>
                          <td class='a-left nobr'><?php echo html::a($bugLink, $bug->title, '', "class='preview'");?></td>
                          <td class='w-80px'><?php echo $lang->bug->statusList[$bug->status];?></td>
                          <td class='w-80px' style='padding:0px'><?php echo $bug->status == 'resolved' ? substr($users[$bug->resolvedBy], 2) : html::select('resolvedBy[]', $users, $this->app->user->account, "class='w-70px'");?></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

      </td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->build->desc;?></th>
      <td><?php echo html::textarea('desc', '', "rows='10' class='area-1'");?></td>
    </tr>  
    <tr><td colspan='2' class='a-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
