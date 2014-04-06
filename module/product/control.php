<?php
/**
 * The control file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: control.php 5144 2013-07-15 06:37:03Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
class product extends control
{
    public $products = array();

    /**
     * Construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /* Load need modules. */
        $this->loadModel('story');
        $this->loadModel('release');
        $this->loadModel('tree');
        $this->loadModel('user');

        /* Get all products, if no, goto the create page. */
        $this->products = $this->product->getPairs();
        if(empty($this->products) and strpos('create', $this->methodName) === false and $this->app->getViewType() != 'mhtml') $this->locate($this->createLink('product', 'create'));
        $this->view->products = $this->products;
    }

    /**
     * Index page, to browse.
     *
     * @param  string $locate     locate to browse page or not. If not, display all products.
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function index($locate = 'yes', $productID = 0)
    {
        if($locate == 'yes') $this->locate($this->createLink($this->moduleName, 'browse'));
        
        $this->session->set('productList', $this->app->getURI(true));
        if($this->app->getViewType() != 'mhtml') $this->product->setMenu($this->products, $productID);

        $this->app->loadLang('my');
        $this->view->title        = $this->lang->product->allProduct;
        $this->view->position[]   = $this->lang->product->allProduct;
        $this->view->productStats = $this->product->getStats();
        $this->view->productID    = $productID;
        $this->display();
    }

    /**
     * project 
     * 
     * @param  string $status 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function project($status = 'all', $productID = 0)
    {
        $this->product->setMenu($this->products, $productID);

        $this->app->loadLang('my');
        $this->view->projectStats  = $this->loadModel('project')->getProjectStats($status, $productID);

        $this->view->title      = $this->products[$productID] . $this->lang->colon . $this->lang->product->project;
        $this->view->position[] = $this->products[$productID];
        $this->view->position[] = $this->lang->product->project;
        $this->view->productID  = $productID;
        $this->display();
    }

    /**
     * Browse a product.
     * 
     * @param  int    $productID 
     * @param  string $browseType 
     * @param  int    $param 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function browse($productID = 0, $browseType = 'allStory', $param = 0, $orderBy = '', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        /* Lower browse type. */
        $browseType = strtolower($browseType);

        /* Save session. */
        $this->session->set('storyList',   $this->app->getURI(true));
        $this->session->set('productList', $this->app->getURI(true));

        /* Set product, module and query. */
        $productID = $this->product->saveState($productID, $this->products);
        $moduleID  = ($browseType == 'bymodule') ? (int)$param : 0;
        $queryID   = ($browseType == 'bysearch') ? (int)$param : 0;

        /* Set menu. */
        $this->product->setMenu($this->products, $productID);

        /* Process the order by field. */
        if(!$orderBy) $orderBy = $this->cookie->productStoryOrder ? $this->cookie->productStoryOrder : 'id_desc';
        setcookie('productStoryOrder', $orderBy, $this->config->cookieLife, $this->config->webRoot);

        /* Set header and position. */
        $this->view->title      = $this->products[$productID]. $this->lang->colon . $this->lang->product->browse;
        $this->view->position[] = $this->products[$productID];
        $this->view->position[] = $this->lang->product->browse;

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        if($this->app->getViewType() == 'mhtml') $recPerPage = 10;
        $pager = new pager($recTotal, $recPerPage, $pageID);

        /* Get stories. */
        $stories = array();
        if($browseType == 'allstory')    $stories = $this->story->getProductStories($productID, 0, 'all', $orderBy, $pager);
        if($browseType == 'bymodule')    $stories = $this->story->getProductStories($productID, $this->tree->getAllChildID($moduleID), 'all', $orderBy, $pager);
        if($browseType == 'bysearch')    $stories = $this->story->getBySearch($productID, $queryID, $orderBy, $pager);
        if($browseType == 'assignedtome')$stories = $this->story->getByAssignedTo($productID, $this->app->user->account, $orderBy, $pager);
        if($browseType == 'openedbyme')  $stories = $this->story->getByOpenedBy($productID, $this->app->user->account, $orderBy, $pager);
        if($browseType == 'reviewedbyme')$stories = $this->story->getByReviewedBy($productID, $this->app->user->account, $orderBy, $pager);
        if($browseType == 'closedbyme')  $stories = $this->story->getByClosedBy($productID, $this->app->user->account, $orderBy, $pager);
        if($browseType == 'draftstory')  $stories = $this->story->getByStatus($productID, 'draft', $orderBy, $pager);
        if($browseType == 'activestory') $stories = $this->story->getByStatus($productID, 'active', $orderBy, $pager);
        if($browseType == 'changedstory')$stories = $this->story->getByStatus($productID, 'changed', $orderBy, $pager);
        if($browseType == 'closedstory') $stories = $this->story->getByStatus($productID, 'closed', $orderBy, $pager);

        /* Process the sql, get the conditon partion, save it to session. */
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'story');

        /* Build search form. */
        $this->config->product->search['actionURL'] = $this->createLink('product', 'browse', "productID=$productID&browseType=bySearch&queryID=myQueryID");
        $this->config->product->search['queryID']   = $queryID;
        $this->config->product->search['params']['plan']['values'] = $this->loadModel('productplan')->getPairs($productID);
        $this->config->product->search['params']['product']['values'] = array($productID => $this->products[$productID], 'all' => $this->lang->product->allProduct);
        $this->config->product->search['params']['module']['values']  = $this->tree->getOptionMenu($productID, $viewType = 'story', $startModuleID = 0);
        $this->loadModel('search')->setSearchParams($this->config->product->search);

        $this->view->productID     = $productID;
        $this->view->productName   = $this->products[$productID];
        $this->view->moduleID      = $moduleID;
        $this->view->stories       = $stories;
        $this->view->plans         = $this->loadModel('productplan')->getPairs($productID);
        $this->view->summary       = $this->product->summary($stories);
        $this->view->moduleTree    = $this->tree->getTreeMenu($productID, $viewType = 'story', $startModuleID = 0, array('treeModel', 'createStoryLink'));
        $this->view->parentModules = $this->tree->getParents($moduleID);
        $this->view->pager         = $pager;
        $this->view->users         = $this->user->getPairs('noletter');
        $this->view->orderBy       = $orderBy;
        $this->view->browseType    = $browseType;
        $this->view->moduleID      = $moduleID;
        $this->display();
    }

    /**
     * Create a product. 
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if(!empty($_POST))
        {
            $productID = $this->product->create();
            if(dao::isError()) die(js::error(dao::getError()));
            $this->loadModel('action')->create('product', $productID, 'opened');
            die(js::locate($this->createLink($this->moduleName, 'browse', "productID=$productID"), 'parent'));
        }

        $this->product->setMenu($this->products, key($this->products));

        $this->view->title      = $this->lang->product->create;
        $this->view->position[] = $this->view->title;
        $this->view->groups     = $this->loadModel('group')->getPairs();
        $this->view->poUsers    = $this->loadModel('user')->getPairs('nodeleted|pofirst|noclosed');
        $this->view->qdUsers    = $this->loadModel('user')->getPairs('nodeleted|qdfirst|noclosed');
        $this->view->rdUsers    = $this->loadModel('user')->getPairs('nodeleted|devfirst|noclosed');
        $this->display();
    }

    /**
     * Edit a product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function edit($productID)
    {
        if(!empty($_POST))
        {
            $changes = $this->product->update($productID); 
            if(dao::isError()) die(js::error(dao::getError()));
            if($changes)
            {
                $actionID = $this->loadModel('action')->create('product', $productID, 'edited');
                $this->action->logHistory($actionID, $changes);
            }
            die(js::locate(inlink('view', "product=$productID"), 'parent'));
        }

        $this->product->setMenu($this->products, $productID);

        $product = $this->dao->findById($productID)->from(TABLE_PRODUCT)->fetch();
        $this->view->title      = $this->lang->product->edit . $this->lang->colon . $product->name;
        $this->view->position[] = html::a($this->createLink($this->moduleName, 'browse'), $product->name);
        $this->view->position[] = $this->lang->product->edit;
        $this->view->product    = $product;
        $this->view->groups     = $this->loadModel('group')->getPairs();
        $this->view->poUsers    = $this->loadModel('user')->getPairs('nodeleted|pofirst',  $product->PO);
        $this->view->qdUsers    = $this->loadModel('user')->getPairs('nodeleted|qdfirst',  $product->QD);
        $this->view->rdUsers    = $this->loadModel('user')->getPairs('nodeleted|devfirst', $product->RD);

        $this->display();
    }

    /**
     * Batch edit products.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function batchEdit($productID = 0)
    {
        if($this->post->names)
        {
            $allChanges = $this->product->batchUpdate();
            if(!empty($allChanges))
            {
                foreach($allChanges as $productID => $changes)
                {
                    if(!empty($changes))
                    {
                        $actionID = $this->loadModel('action')->create('product', $productID, 'Edited');
                        $this->action->logHistory($actionID, $changes);
                    }
                }
            }
            die(js::locate($this->session->productList, 'parent'));
        }

        $this->product->setMenu($this->products, $productID);

        $productIDList = $this->post->productIDList ? $this->post->productIDList : die(js::locate($this->session->productList, 'parent'));

        $this->view->title         = $this->lang->product->batchEdit;
        $this->view->position[]    = $this->lang->product->batchEdit;
        $this->view->productIDList = $productIDList;
        $this->view->products      = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->in($productIDList)->fetchAll('id');
        $this->view->poUsers       = $this->loadModel('user')->getPairs('nodeleted|pofirst');
        $this->view->qdUsers       = $this->loadModel('user')->getPairs('nodeleted|qdfirst');
        $this->view->rdUsers       = $this->loadModel('user')->getPairs('nodeleted|devfirst');
        $this->display();
    }

    /**
     * Close product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function close($productID)
    {
        $product = $this->product->getById($productID);
        $actions = $this->loadModel('action')->getList('product', $productID);

        if(!empty($_POST))
        {
            $changes = $this->product->close($productID);
            if(dao::isError()) die(js::error(dao::getError()));

            if($this->post->comment != '' or !empty($changes))
            {
                $actionID = $this->action->create('product', $productID, 'Closed', $this->post->comment);
                $this->action->logHistory($actionID, $changes);
            }
            die(js::locate($this->createLink('product', 'view', "productID=$productID"), 'parent'));
        }

        $this->product->setMenu($this->products, $productID);

        $this->view->product    = $product;
        $this->view->title      = $this->view->product->name . $this->lang->colon .$this->lang->close;
        $this->view->position[] = $this->lang->close;
        $this->view->actions    = $actions;
        $this->display();
    }

    /**
     * View a product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function view($productID)
    {
        $this->product->setMenu($this->products, $productID);

        $product  = $this->product->getStatByID($productID);
        $product->desc = $this->loadModel('file')->setImgSize($product->desc);
        if(!$product) die(js::error($this->lang->notFound) . js::locate('back'));

        $this->view->title      = $product->name . $this->lang->colon . $this->lang->product->view;
        $this->view->position[] = html::a($this->createLink($this->moduleName, 'browse'), $product->name);
        $this->view->position[] = $this->lang->product->view;
        $this->view->product    = $product;
        $this->view->actions    = $this->loadModel('action')->getList('product', $productID);
        $this->view->users      = $this->user->getPairs('noletter');
        $this->view->groups     = $this->loadModel('group')->getPairs();

        $this->display();
    }

    /**
     * Delete a product.
     * 
     * @param  int    $productID 
     * @param  string $confirm    yes|no
     * @access public
     * @return void
     */
    public function delete($productID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->product->confirmDelete, $this->createLink('product', 'delete', "productID=$productID&confirm=yes")));
        }
        else
        {
            $this->product->delete(TABLE_PRODUCT, $productID);
            $this->session->set('product', '');     // 清除session。
            die(js::locate($this->createLink('product', 'browse'), 'parent'));
        }
    }

    /**
     * Docs of a product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function doc($productID)
    {
        $this->product->setMenu($this->products, $productID);
        $this->session->set('docList', $this->app->getURI(true));

        $product = $this->dao->findById($productID)->from(TABLE_PRODUCT)->fetch();
        $this->view->title      = $product->name . $this->lang->colon . $this->lang->product->doc;
        $this->view->position[] = html::a($this->createLink($this->moduleName, 'browse'), $product->name);
        $this->view->position[] = $this->lang->product->doc;
        $this->view->product    = $product;
        $this->view->docs       = $this->loadModel('doc')->getProductDocs($productID);
        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        $this->display();
    }

    /**
     * Road map of a product. 
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function roadmap($productID)
    {
        $this->product->setMenu($this->products, $productID);

        $this->session->set('releaseList',     $this->app->getURI(true));
        $this->session->set('productPlanList', $this->app->getURI(true));

        $product = $this->dao->findById($productID)->from(TABLE_PRODUCT)->fetch();
        $this->view->title      = $product->name . $this->lang->colon . $this->lang->product->roadmap;
        $this->view->position[] = html::a($this->createLink($this->moduleName, 'browse'), $product->name);
        $this->view->position[] = $this->lang->product->roadmap;
        $this->view->product    = $product;
        $this->view->roadmaps   = $this->product->getRoadmap($productID);

        $this->display();
    }

    /**
     * Product dynamic.
     * 
     * @param  string $type 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function dynamic($productID = 0, $type = 'today', $param = '', $orderBy = 'date_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        /* Save session. */
        $uri   = $this->app->getURI(true);
        $this->session->set('productList',     $uri);
        $this->session->set('productPlanList', $uri);
        $this->session->set('releaseList',     $uri);
        $this->session->set('storyList',       $uri);
        $this->session->set('projectList',     $uri);
        $this->session->set('taskList',        $uri);
        $this->session->set('buildList',       $uri);
        $this->session->set('bugList',         $uri);
        $this->session->set('caseList',        $uri);
        $this->session->set('testtaskList',    $uri);

        $this->product->setMenu($this->products, $productID);

        /* Set the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);
        $this->view->orderBy = $orderBy;
        $this->view->pager   = $pager;

        /* Set the user and type. */
        $account = $type == 'account' ? $param : 'all';
        $period  = $type == 'account' ? 'all'  : $type;

        /* The header and position. */
        $this->view->title      = $this->products[$productID] . $this->lang->colon . $this->lang->product->dynamic;
        $this->view->position[] = html::a($this->createLink($this->moduleName, 'browse'), $this->products[$productID]);
        $this->view->position[] = $this->lang->product->dynamic;

        /* Assign. */
        $this->view->productID = $productID;
        $this->view->type      = $type;
        $this->view->users     = $this->loadModel('user')->getPairs('nodeleted|noletter');
        $this->view->account   = $account;
        $this->view->actions   = $this->loadModel('action')->getDynamic($account, $period, $orderBy, $pager, $productID);
        $this->display();
    }

    /**
     * AJAX: get projects of a product in html select.
     * 
     * @param  int    $productID 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function ajaxGetProjects($productID, $projectID = 0)
    {
        $projects = $this->product->getProjectPairs($productID, $params = 'nodeleted');
        die(html::select('project', $projects, $projectID, 'class=select-3 onchange=loadProjectRelated(this.value)'));
    }

    /**
     * AJAX: get plans of a product in html select. 
     * 
     * @param  int    $productID 
     * @param  int    $planID 
     * @param  bool   $needCreate
     * @access public
     * @return void
     */
    public function ajaxGetPlans($productID, $planID = 0, $needCreate = false)
    {
        $plans = $this->loadModel('productplan')->getPairs($productID);
        $output = html::select('plan', $plans, $planID, "class='select-3'");
        if(count($plans) == 1 and $needCreate) 
        {
            $output .= html::a($this->createLink('productplan', 'create', "productID=$productID"), $this->lang->productplan->create, '_blank');
            $output .= html::a("javascript:loadProductPlans($productID)", $this->lang->refresh);
        }
        die($output);
    }

    /**
     * Drop menu page.
     * 
     * @param  int    $productID 
     * @param  string $module 
     * @param  string $method 
     * @param  string $extra 
     * @access public
     * @return void
     */
    public function ajaxGetDropMenu($productID, $module, $method, $extra)
    {
        $this->view->link      = $this->product->getProductLink($module, $method, $extra);
        $this->view->productID = $productID;
        $this->view->module    = $module;
        $this->view->method    = $method;
        $this->view->extra     = $extra;
        $this->view->products  = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->in(array_keys($this->products))->orderBy('code')->fetchAll();
        $this->display();
    }
    
        /**
     * Drop menu page.
     * 
     * @param  int    $productID 
     * @param  string $module 
     * @param  string $method 
     * @param  string $extra 
     * @access public
     * @return void
     */
    public function ajaxGetFlink($productID, $module, $method, $extra)
    {
        $this->view->link      = $this->product->getProductLink($module, $method, $extra);
        $this->view->productID = $productID;
        $this->view->module    = $module;
        $this->view->method    = $method;
        $this->view->extra     = $extra;
        $this->view->products  = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->in(array_keys($this->products))->orderBy('code')->fetchAll();
        $this->display();
    }

    /**
     * The results page of search.
     * 
     * @param  string  $keywords 
     * @param  string  $module 
     * @param  string  $method 
     * @param  mix     $extra 
     * @access public
     * @return void
     */
    public function ajaxGetMatchedItems($keywords, $module, $method, $extra)
    {
        $products = $this->dao->select('*')->from(TABLE_PRODUCT)->where('deleted')->eq(0)->andWhere('name')->like("%$keywords%")->orderBy('code')->fetchAll();
        foreach($products as $key => $product)
        {
            if(!$this->product->checkPriv($product)) unset($products[$key]);
        }

        $this->view->link     = $this->product->getProductLink($module, $method, $extra);
        $this->view->products = $products;
        $this->view->keywords = $keywords;
        $this->display();
    }
}
