<?php
/**
 * The model file of release module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     release
 * @version     $Id: model.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php
class releaseModel extends model
{
    /**
     * Get release by id.
     * 
     * @param  int    $releaseID 
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getByID($releaseID, $setImgSize = false)
    {
        $release = $this->dao->select('t1.*, t2.name as buildName, t3.name as productName')
            ->from(TABLE_RELEASE)->alias('t1')
            ->leftJoin(TABLE_BUILD)->alias('t2')->on('t1.build = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.id')->eq((int)$releaseID)
            ->orderBy('t1.id DESC')
            ->fetch();
        if($setImgSize) $release->desc = $this->loadModel('file')->setImgSize($release->desc);
        return $release;
    }

    /**
     * Get list of releases.
     * 
     * @param  int    $productID 
     * @access public
     * @return array
     */
    public function getList($productID)
    {
        return $this->dao->select('t1.*, t2.name as productName, t3.name as buildName')
            ->from(TABLE_RELEASE)->alias('t1')
            ->leftJoin(TABLE_PRODUCT)->alias('t2')->on('t1.product = t2.id')
            ->leftJoin(TABLE_BUILD)->alias('t3')->on('t1.build = t3.id')
            ->where('t1.product')->eq((int)$productID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('t1.date DESC')
            ->fetchAll();
    }

    /**
     * Get last release.
     * 
     * @param  int    $productID 
     * @access public
     * @return bool | object 
     */
    public function getLast($productID)
    {
        return $this->dao->select('id, name')->from(TABLE_RELEASE)
            ->where('product')->eq((int)$productID)
            ->orderBy('date DESC')
            ->limit(1)
            ->fetch();
    }

    /**
     * Get release builds from product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function getReleaseBuilds($productID)
    {
        $releases = $this->dao->select('build')->from(TABLE_RELEASE)->where('deleted')->eq(0)->andWhere('product')->eq($productID)->fetchAll('build');
        return array_keys($releases);
    }

    /**
     * Create a release.
     * 
     * @param  int    $productID 
     * @access public
     * @return int
     */
    public function create($productID)
    {
       if($this->post->build == false)
        {
            $build = fixer::input('post')
                ->stripTags('name')
                ->add('product', (int)$productID)
                ->add('builder', $this->app->user->account)
                ->remove('build')
                ->get();
            $this->dao->insert(TABLE_BUILD)->data($build)->autoCheck()->check('name','unique')->exec();
            $buildID = $this->dao->lastInsertID();
        }

       $release = fixer::input('post')
           ->stripTags('name')
           ->add('product', (int)$productID)
           ->join('stories', ',')
           ->join('bugs', ',')
           ->setIF($this->post->build == false, 'build', $buildID)
           ->remove('allchecker')
           ->get();

        $this->dao->insert(TABLE_RELEASE)->data($release)->autoCheck()->batchCheck($this->config->release->create->requiredFields, 'notempty')->check('name','unique')->exec();
        $releaseID = $this->dao->lastInsertID();
        if($release->stories) $this->dao->update(TABLE_STORY)->set('stage')->eq('released')->where('id')->in($release->stories)->exec();
        if(!dao::isError()) return $releaseID;
    }

    /**
     * Update a release.
     * 
     * @param  int    $releaseID 
     * @access public
     * @return void
     */
    public function update($releaseID)
    {
        $oldRelease = $this->getByID($releaseID);
        $release = fixer::input('post')
            ->stripTags('name')
            ->setDefault('stories', '')
            ->setDefault('bugs', '')
            ->join('stories', ',')
            ->join('bugs', ',')
            ->get();
        $this->dao->update(TABLE_RELEASE)->data($release)
            ->autoCheck()
            ->batchCheck($this->config->release->edit->requiredFields, 'notempty')
            ->check('name','unique', "id != $releaseID")
            ->where('id')->eq((int)$releaseID)
            ->exec();
        $this->dao->update(TABLE_STORY)->set('stage')->eq('released')->where('id')->in($release->stories)->exec();
        if(!dao::isError()) return common::createChanges($oldRelease, $release);
    }
}
