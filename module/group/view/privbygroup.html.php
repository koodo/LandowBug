<?php
/**
 * The manage privilege by group view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: managepriv.html.php 1517 2011-03-07 10:02:57Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<form method='post' target='hiddenwin'>
  <div id='featurebar'>
    <?php $params = "type=byGroup&param=$groupID&menu=%s&version=$version";?>
    <span <?php echo empty($menu) ? "class='active'" : ""?>>
      <?php echo html::a(inlink('managePriv', sprintf($params, '')), $lang->group->all)?>
    </span>
    <!--
    <?php foreach($lang->menu as $module => $title):?>
    <span <?php echo $menu == $module ? "class='active'" : ""?>>
      <?php echo html::a(inlink('managePriv', sprintf($params, $module)), substr($title, 0, strpos($title, '|')))?>
    </span>
    <?php endforeach;?>
    -->

    <span <?php echo $menu == 'other' ? "class='active'" : "";?>>
      <?php echo html::a(inlink('managePriv', sprintf($params, 'other')), $lang->group->other);?>
    </span>
    <!--
    <span><?php echo html::select('version', $this->lang->group->versions, $version, "onchange=showPriv(this.value)");?></span>
    -->
  </div>

  <table class='table-8 a-left bd-none''> 
    <tr class='colhead'>
      <th><?php echo $lang->group->module;?></th>
      <th><?php echo $lang->group->method;?></th>
    </tr>  
    <?php foreach($lang->resource as $moduleName => $moduleActions):?>
    <?php if(!$this->group->checkMenuModule($menu, $moduleName)) continue;?>
    <?php
    /* Check method in select version. */
    if($version)
    {
        $hasMethod = false;
        foreach($moduleActions as $action => $actionLabel)
        {
            if(strpos($changelogs, ",$moduleName-$actionLabel,") !== false)
            {
                $hasMethod = true;
                break;
            }
        }
        if(!$hasMethod) continue;
    }
    ?>
    <tr<?php echo cycle('even, bg-gray');?>'>
      <th class='a-right'><?php echo $this->lang->$moduleName->common;?><?php echo html::selectAll($moduleName, 'checkbox')?></td>
      <td id='<?php echo $moduleName;?>' class='pv-10px'>
        <?php $i = 1;?>
        <?php foreach($moduleActions as $action => $actionLabel):?>
        <?php if(!empty($version) and strpos($changelogs, ",$moduleName-$actionLabel,") === false) continue;?>
        <div class='w-p20 f-left'>
          <input type='checkbox' name='actions[<?php echo $moduleName;?>][]' value='<?php echo $action;?>' <?php if(isset($groupPrivs[$moduleName][$action])) echo "checked";?> />
          <span class='priv' id="<?php echo $moduleName . '-' . $actionLabel;?>"><?php echo $lang->$moduleName->$actionLabel;?></span>
        </div>
        <?php if(($i %  4) == 0) echo "<div class='c-both'></div>"; $i ++;?>
        <?php endforeach;?>
      </td>
    </tr>
    <?php endforeach;?>
    <tr>
      <th class='rowhead'><?php echo $lang->selectAll . html::selectAll('', 'checkbox')?></th>
      <td>
        <?php 
        echo html::submitButton($lang->save, "onclick='setNoChecked()'");
        echo html::linkButton($lang->goback, $this->createLink('group', 'browse'));
        echo html::hidden('foo'); // Just a hidden var, to make sure $_POST is not empty.
        echo html::hidden('noChecked'); // Save the value of no checked.
        ?>
      </td>
    </tr>
  </table>
</form>
<script type='text/javascript'>
var groupID = <?php echo $groupID?>;
var menu    = "<?php echo $menu?>";
</script>
