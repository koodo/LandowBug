<?php
/**
 * The model file of build module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     build
 * @version     $Id: model.php 4970 2013-07-02 05:58:11Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class buildModel extends model
{
    /**
     * Get build info.
     * 
     * @param  int    $buildID 
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getByID($buildID, $setImgSize = false)
    {
        $build = $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_BUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.id')->eq((int)$buildID)
            ->fetch();
        if(!$build) return false;
        if($setImgSize) $build->desc = $this->loadModel('file')->setImgSize($build->desc);
        return $build;
    }

    /**
     * Get builds of a project.
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function getProjectBuilds($projectID)
    {
        return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_BUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.project')->eq((int)$projectID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('t1.date DESC, t1.id desc')
            ->fetchAll();
    }

    /**
     * Get builds of a project in pairs. 
     * 
     * @param  int    $projectID 
     * @param  int    $productID 
     * @param  string $params       noempty|notrunk, can be a set of them
     * @access public
     * @return array
     */
    public function getProjectBuildPairs($projectID, $productID, $params = '')
    {
        $sysBuilds = array();
        #if(strpos($params, 'noempty') === false) $sysBuilds = array('' => '');
        if(strpos($params, 'notrunk') === false) $sysBuilds = $sysBuilds + array('trunk' => '默认版本');

        $builds = $this->dao->select('id,name')->from(TABLE_BUILD)
            ->where('project')->eq((int)$projectID)
            ->beginIF($productID)->andWhere('product')->eq((int)$productID)->fi()
            ->andWhere('deleted')->eq(0)
            ->orderBy('date desc, id desc')->fetchPairs();
        if(!$builds) return $sysBuilds;
        $releases = $this->dao->select('build,name')->from(TABLE_RELEASE)
            ->where('build')->in(array_keys($builds))
            ->andWhere('deleted')->eq(0)
            ->fetchPairs();
        foreach($releases as $buildID => $releaseName) $builds[$buildID] = $releaseName;
        return $sysBuilds + $builds;
    }

    /**
     * Get builds of a product in pairs. 
     * 
     * @param  mix    $products     int|array
     * @param  string $params       noempty|notrunk, can be a set of them
     * @access public
     * @return string
     */
    public function getProductBuildPairs($products, $params = '')
    {
        $sysBuilds = array();
        #if(strpos($params, 'noempty') === false) $sysBuilds = array('' => '');
        if(strpos($params, 'notrunk') === false) $sysBuilds = $sysBuilds + array('trunk' => '默认版本');

        $productBuilds = $this->dao->select('id,name,project')->from(TABLE_BUILD)
            ->where('product')->in($products)
            ->andWhere('deleted')->eq(0)
            ->orderBy('date desc, id desc')->fetchAll('id');
        $releases = $this->dao->select('build,name,deleted')->from(TABLE_RELEASE)
           ->where('product')->in($products)
           ->fetchAll('build');

        $builds = array();
        foreach($productBuilds as $key => $build)
        {
            if($build->project) 
            {
                $builds[$key] = isset($releases[$key]) ? $releases[$key]->name : $build->name;
            }
            else if(isset($releases[$key]) and !$releases[$key]->deleted)
            {
                $builds[$key] = $releases[$key]->name; 
            }
        }

        if(!$builds) return $sysBuilds;
        return $sysBuilds + $builds;
    }

    /**
     * Get last build.
     * 
     * @param  int    $projectID 
     * @access public
     * @return bool | object
     */
    public function getLast($projectID)
    {
        return $this->dao->select('id, name')->from(TABLE_BUILD) 
            ->where('project')->eq((int)$projectID)
            ->orderBy('date DESC')
            ->limit(1)
            ->fetch();
    }

    /**
     * Create a build
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function create($projectID)
    {
        global $app;
        
        $SQL = sprintf("INSERT INTO zt_build (name,project,builder,date) VALUES ('%s','%s','%s',CURRENT_DATE());",$this->post->name,$this->post->project,$app->user->account);
        
        try{
            $this->dbh->query($SQL);
            echo 1;exit(0);
        } catch (Exception $ex) {
            echo 0;exit(0);
        }
        /*
        $build = new stdclass();
        $build->stories = '';
        $build->bugs    = '';
        
        $build = fixer::input('post')->stripTags('name')
            ->add('product', 0)
            ->join('stories', ',')
            ->join('bugs', ',')
            ->add('project', (int)$projectID)->remove('resolvedBy,allchecker')->get();
        
        $this->dao->insert(TABLE_BUILD)->data($build)->autoCheck()->batchCheck($this->config->build->create->requiredFields, 'notempty')->check('name', 'unique', "product = {$build->product}")->exec();
        
        if(!dao::isError())
        {
            $buildID = $this->dao->lastInsertID();
            $this->updateLinkedBug($build);
            return $buildID;
        }*/
    }

    /**
     * Update a build.
     * 
     * @param  int    $buildID 
     * @access public
     * @return void
     */
    public function update($buildID)
    {
        $oldBuild = $this->getByID($buildID);
        $build = fixer::input('post')
            ->stripTags('name')
            ->setDefault('stories', '')
            ->setDefault('bugs', '')
            ->join('stories', ',')
            ->join('bugs', ',')
            ->remove('allchecker,resolvedBy')
            ->get();
        $this->dao->update(TABLE_BUILD)->data($build)
            ->autoCheck()
            ->batchCheck($this->config->build->edit->requiredFields, 'notempty')
            ->where('id')->eq((int)$buildID)
            ->check('name','unique', "id != $buildID AND product = {$build->product}")
            ->exec();
        if(!dao::isError())
        {
            $this->updateLinkedBug($build);
            return common::createChanges($oldBuild, $build);
        }
    }

    /**
     * Update linked bug to resolved.
     * 
     * @param  object    $build 
     * @access public
     * @return void
     */
    public function updateLinkedBug($build)
    {
        $bugs = empty($build->bugs) ? '' : $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($build->bugs)->fetchAll();
        $now  = helper::now();

        $resolvedPairs = array();
        if(isset($_POST['bugs']))
        {
            foreach($this->post->bugs as $key => $bugID)
            {
                if(isset($_POST['resolvedBy'][$key]))$resolvedPairs[$bugID] = $this->post->resolvedBy[$key];
            }
        }

        $this->loadModel('action');
        if(!$bugs) return false;
        foreach($bugs as $bug)
        {
            if($bug->status == 'resolved' or $bug->status == 'closed') continue;

            $bug->resolvedBy     = $resolvedPairs[$bug->id];
            $bug->resolvedDate   = $now;
            $bug->status         = 'resolved';
            $bug->confirmed      = 1;
            $bug->assignedDate   = $now;
            $bug->assignedTo     = $bug->openedBy;
            $bug->lastEditedBy   = $this->app->user->account;
            $bug->lastEditedDate = $now;
            $bug->resolution     = 'fixed';
            $bug->resolvedBuild  = $build->name;
            $this->dao->update(TABLE_BUG)->data($bug)->where('id')->eq($bug->id)->exec();
            $this->action->create('bug', $bug->id, 'Resolved', '', 'fixed', $bug->resolvedBy);
        }
    }
}
