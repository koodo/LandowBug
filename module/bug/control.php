<?php

/**
 * The control file of bug currentModule of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     bug
 * @version     $Id: control.php 5107 2013-07-12 01:46:12Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
class bug extends control {

    public $products = array();

    /**
     * Construct function, load some modules auto.
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->loadModel('product');
        $this->loadModel('project');
        $this->loadModel('tree');
        $this->loadModel('user');
        $this->loadModel('action');
        $this->loadModel('story');
        $this->loadModel('task');
        $this->products = $this->product->getPairs();
        $this->projects = $this->project->getPairs();
        $this->view->products = $this->products;
        $this->view->projects = $this->projects;
        $this->view->projectID = $this->cookie->lastProject;
        $this->view->moduleOptionMenu = $this->tree->getOptionMenu(1, $viewType = 'bug', 0);
    }

    /**
     * The index page, locate to browse.
     * 
     * @access public
     * @return void
     */
    public function index() {
        $this->locate($this->createLink('bug', 'browse'));
    }

    /**
     * Browse bugs.
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
    public function browse($projectID = 0, $browseType = 'all', $param = 0, $orderBy = '', $recTotal = 0, $recPerPage = 20, $pageID = 1) {
        /* Set browseType, productID, moduleID and queryID. */
        if ($projectID == 0)
            $projectID = $this->cookie->lastProject;
        $productID = $projectID;
        
        if (!$projectID || $projectID == '') {
            $projectID = common::getFirstProject();
        }
        
        if (!$this->project->memberInProject($this->app->user->account, $projectID) && !$this->project->isProjectCreator($projectID) && !common::isAdmin()) {
            setcookie('lastProject', common::getFirstProject(), $this->config->cookieLife, $this->config->webRoot);
            die(js::locate('/'));
        }

        $browseType = strtolower($browseType);

        setcookie('lastProject', $projectID, $this->config->cookieLife, $this->config->webRoot);
        $moduleID = ($browseType == 'bymodule') ? (int) $param : 0;
        if ($_GET['search_reset'] == 1)
            $pageID = 1;
        // 判断是否为搜索模式
        $isSearch = $_GET['search_on'] == 'true' ? true : false;

        $this->bug->setMenu($this->projects, $projectID, '_' . $browseType);
        $this->session->set('bugList', $this->app->getURI(true));

        /* Process the order by field. */
        if (!$orderBy)
            $orderBy = $this->cookie->qaBugOrder ? $this->cookie->qaBugOrder : 'id_desc';
        setcookie('qaBugOrder', $orderBy, $this->config->cookieLife, $this->config->webRoot);

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $this->app->loadClass('pager/pager_dul', $static = true);

        $pager = pager::init($recTotal, $recPerPage, $pageID);

        # Urgent Bug Pager
        if ($browseType == 'all')
            $pager_urgent = pager::init($recTotal, $recPerPage, $pageID);

        $projects = $this->loadModel('project')->getPairs();
        $projects[0] = '';

        #$countAllBug = $this->bug->getAllBugsCount($productID, $projects);
        $countUnresolvedBug = $this->bug->getUnresolvedBugsCount($productID, $projects);
        $countNotConFirmedBug = $this->bug->getNotConFirmedBugsCount($productID, $projects);
        $countClosedBug = $this->bug->getByClosedCount($productID, $projects);
        $countResolvedBug = $this->bug->getResolvedBugsCount($productID, $projects);

        /* Get bugs. */
        $bugs = array();
        if ($browseType == 'all') {
            $bugs = $this->bug->getAllBugs($productID, $projects, 'id_desc', $pager);                           // 最新的BUG
            $bugs_urgent = $this->bug->getUrgentBugs($productID, $projects, 'severity_desc', $pager_urgent);    // 紧急待处理的BUG
        } else if ($browseType == "showall") {
            $bugs = $this->bug->getAllBugs($productID, $projects, $orderBy, $pager, $isSearch);
        } else if ($browseType == "bymodule") {
            $childModuleIds = $this->tree->getAllChildId($moduleID);
            $bugs = $this->bug->getModuleBugs($productID, $childModuleIds, $projects, $orderBy, $pager);
        } else if ($browseType == 'assigntome') {
            $fixed_count = $this->bug->getByAssigntomeFixedCount($productID, $projects, $orderBy, $isSearch);
            $unfix_count = $this->bug->getByAssigntomeUnfixCount($productID, $projects, $orderBy, $isSearch);
            $pager_fixed = pager_dul::init($fixed_count->count, $this->get->SrecPerPage ? $this->get->SrecPerPage : $recPerPage, $this->get->SpageID ? $this->get->SpageID : $pageID);
            $pager_unfix = pager::init($unfix_count->count, $recPerPage, $pageID);
            $bugs_unfix = $this->bug->getByAssigntomeUnfix($productID, $projects, $orderBy, $pager_unfix, $isSearch);
            $bugs_fixed = $this->bug->getByAssigntomeFixed($productID, $projects, $orderBy, $pager_fixed, $isSearch);
        } elseif ($browseType == 'closed')
            $bugs = $this->bug->getByClosed($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'resolved')
            $bugs = $this->bug->getByResolved($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'openedbyme')
            $bugs = $this->bug->getByOpenedbyme($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'urgent')
            $bugs = $this->bug->getUrgentBugs($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'newest')
            $bugs = $this->bug->getNewsetBugs($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'assigntonull')
            $bugs = $this->bug->getByAssigntonull($productID, $projects, $orderBy, $pager);
        elseif ($browseType == 'unresolved')
            $bugs = $this->bug->getUnresolvedBugs($productID, $projects, $orderBy, $pager, $isSearch);
        elseif ($browseType == 'notconfirmed')
            $bugs = $this->bug->getNotConfirmed($productID, $projects, $orderBy, $pager, $isSearch);

        /* Process the sql, get the conditon partion, save it to session. */
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'bug', $browseType == 'needconfirm' ? false : true);

        $users = $this->user->getPairs('noletter');

        $builds = $this->loadModel('build')->getProductBuildPairs(0);

        $this->renderBugData($bugs);
        $bugs_urgent && $this->renderBugData($bugs_urgent);
        $bugs_unfix && $this->renderBugData($bugs_unfix);
        $bugs_fixed && $this->renderBugData($bugs_fixed);

        $title = '测试';
        $position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $position[] = $this->lang->bug->common;

        // $browseType 所有bug
        $this->view->isAll = $browseType === 'all';
        $this->view->title = $title;
        $this->view->position = $position;
        $this->view->productID = $productID;
        $this->view->productName = $this->products[$productID];
        $this->view->builds = $builds;
        $this->view->moduleTree = $this->tree->getTreeMenu($productID, $viewType = 'bug', $startModuleID = 0, array('treeModel', 'createBugLink'));
        $this->view->browseType = $browseType;
        $this->view->members = $this->project->getTeamMemberPairs($projectID);
        $this->view->projectID = $projectID;

        if ($bugs)
            $this->view->bugs = $bugs;
        else {
            $this->view->bugs_unfix = $bugs_unfix;
            $this->view->bugs_fixed = $bugs_fixed;
        }
        if ($bugs_urgent)
            $this->view->bugs_urgent = $bugs_urgent;
        if ($bugs_fixed)
            $this->view->pager_fixed = $pager_fixed;
        if ($bugs_unfix)
            $this->view->pager_unfix = $pager_unfix;
        $this->view->users = $users;
        // 双列表
        $this->view->pager = $pager;
        if ($pager_urgent)
            $this->view->pager_urgent = $pager_urgent;
        $this->view->param = $param;
        $this->view->orderBy = $orderBy;
        $this->view->moduleID = $moduleID;
        $this->view->customed = $customed;
        $this->view->customFields = explode(',', str_replace(' ', '', trim($customFields)));
        $this->view->count = array();
        $this->view->modules = $this->loadModel('module')->getPairs($projectID);
        #$this->view->modulePath = $this->tree->getParents($bug->module);
        #$this->view->count['allbug']   = $countAllBug->count;
        $this->view->count['unfixbug'] = $countUnresolvedBug->count;
        $this->view->count['nocofbug'] = $countNotConFirmedBug->count;
        $this->view->count['resolbug'] = $countResolvedBug->count;
        $this->view->count['closebug'] = $countClosedBug->count;
        $this->display();
    }

    private function renderBugData($buglist, $builds) {
        foreach ($buglist as $key => $bug) {
            $bug->module = $this->loadModel('module')->getByID($bug->module);
            $openBuildIdList = explode(',', $bug->openedBuild);
            $openedBuild = '';
            foreach ($openBuildIdList as $buildID) {
                $openedBuild .= isset($builds[$buildID]) ? $builds[$buildID] : $buildID;
                $openedBuild .= ',';
            }
            $bug->openedBuild = rtrim($openedBuild, ',');
            #$bug->resolvedBuild = isset($builds[$bug->resolvedBuild]) ? $builds[$bug->resolvedBuild] : $bug->resolvedBuild;
        }
    }

    /**
     * The report page.
     * 
     * @param  int    $productID 
     * @param  string $browseType 
     * @param  int    $moduleID 
     * @access public
     * @return void
     */
    public function report($projectID = 0, $browseType = 'all', $moduleID = 0) {
        #$productID = (int) $_COOKIE['lastProduct'];
        $this->loadModel('report');
        $this->view->charts = array();
        $this->view->renderJS = '';
        if ($projectID == 0)
            $projectID = $this->cookie->lastProject;
        $productID = $projectID;
        if (!empty($_POST)) {
            foreach ($this->post->charts as $chart) {
                $chartFunc = 'getDataOf' . $chart;
                $chartData = $this->bug->$chartFunc();
                $chartOption = $this->lang->bug->report->$chart;
                $this->bug->mergeChartOption($chart);

                $chartXML = $this->report->createSingleXML($chartData, $chartOption->graph);
                $this->view->charts[$chart] = $this->report->createJSChart($chartOption->swf, $chartXML, $chartOption->width, $chartOption->height);
                $this->view->datas[$chart] = $this->report->computePercent($chartData);
            }
            $this->view->renderJS = $this->report->renderJsCharts(count($this->view->charts));
        }

        $this->view->time_from = $this->post->time_from;
        $this->view->time_to = $this->post->time_to;

        $this->bug->setMenu($this->products, $productID);
        $this->view->title = 'Bug统计';
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->reportChart;
        $this->view->productID = $productID;
        $this->view->browseType = $browseType;
        $this->view->moduleID = $moduleID;
        $this->view->projectID = $projectID;
        $this->view->checkedCharts = $this->post->charts ? join(',', $this->post->charts) : '';
        $this->display();
    }

    /**
     * Create a bug.
     * 
     * @param  int    $productID 
     * @param  string $extras       others params, forexample, projectID=10,moduleID=10
     * @access public
     * @return void
     */
    public function create($projectID = 0, $extras = '') {
        $this->view->users = $this->user->getPairs('nodeleted,devfirst');
        /* if (empty($this->products))
          $this->locate($this->createLink('product', 'create')); */
        $this->app->loadLang('release');

        if ($projectID == 0)
            $projectID = $this->cookie->lastProject;
        $productID = $projectID;
        $this->bug->setMenu($this->projects, $projectID);

        if (!empty($_POST)) {
            $response['result'] = 'success';
            $response['message'] = '';

            $bugID = $this->bug->create();
            $_bug = $this->bug->getById($bugID);
            if (dao::isError()) {
                $response['result'] = 'fail';
                echo js::error(dao::getError());
                echo js::locate($this->createLink('bug', 'create', "projectID=$projectID"));
                die(0);
            } else {
                $actionID = $this->action->create('bug', $bugID, 'Opened', $this->post->comment, 'opened', '', $_bug->assignedTo);
                $this->sendmail($bugID, $actionID);
                $location = $this->createLink('bug', 'browse', "productID={$this->post->product}&type=byModule&param={$this->post->module}");
                $response['locate'] = isset($_SESSION['bugList']) ? $this->session->bugList : $location;
                header("location:" . $response['locate']);
            }
        }

        /* Remove the unused types. */
        unset($this->lang->bug->typeList['designchange']);
        unset($this->lang->bug->typeList['newfeature']);
        unset($this->lang->bug->typeList['trackthings']);

        /* Init vars. */
        $moduleID = 0;
        $projectID = 0;
        $taskID = 0;
        $storyID = 0;
        $buildID = 0;
        $caseID = 0;
        $runID = 0;
        $title = '';
        $steps = $this->lang->bug->tplStep . $this->lang->bug->tplResult . $this->lang->bug->tplExpect;
        $os = '';
        $browser = '';
        $assignedTo = '';
        $mailto = '';
        $keywords = '';
        $severity = 3;
        $type = 'codeerror';

        /* Parse the extras. */
        $extras = str_replace(array(',', ' '), array('&', ''), $extras);
        parse_str($extras);

        /* If set runID, get the last result info as the template. */
        if ($runID > 0)
            $resultID = $this->dao->select('id')->from(TABLE_TESTRESULT)->where('run')->eq($runID)->orderBy('id desc')->limit(1)->fetch('id');
        if (isset($resultID) and $resultID > 0)
            extract($this->bug->getBugInfoFromResult($resultID));

        /* If set caseID and runID='', get the last result info as the template. */
        if ($caseID > 0 && $runID == '') {
            $resultID = $this->dao->select('id')->from(TABLE_TESTRESULT)->where('`case`')->eq($caseID)->orderBy('date desc')->limit(1)->fetch('id');
            if (isset($resultID) and $resultID > 0)
                extract($this->bug->getBugInfoFromResult($resultID, $caseID, $version));
        }

        /* If bugID setted, use this bug as template. */
        if (isset($bugID)) {
            $bug = $this->bug->getById($bugID);
            extract((array) $bug);
            $projectID = $bug->project;
            $moduleID = $bug->module;
            $taskID = $bug->task;
            $storyID = $bug->story;
            $buildID = $bug->openedBuild;
            $severity = $bug->severity;
            $type = $bug->type;
            $assignedTo = $bug->assignedTo;
            $this->view->bug = $bug;
        } else {
            $projectID = $this->cookie->lastProject;
        }

        /* If projectID is setted, get builds and stories of this project. */
        if ($projectID) {
            $builds = $this->loadModel('build')->getProjectBuildPairs($projectID, 0, 'noempty');
            $stories = $this->story->getProjectStoryPairs($projectID);
        } else {
            $builds = $this->loadModel('build')->getProductBuildPairs($productID, 'noempty,release');
            $stories = $this->story->getProductStoryPairs($productID);
        }

        $this->view->title = $this->lang->bug->create;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->create;

        $this->view->productID = $productID;
        $this->view->productName = $this->products[$productID];
        $this->view->moduleOptionMenu = $this->loadModel('module')->getPairs($projectID);
        $this->view->stories = $stories;
        $this->view->crt_projects = $this->project->getProjectStatsPair();
        $this->view->builds = $builds;
        $this->view->tasks = $this->loadModel('task')->getProjectTaskPairs($projectID);
        $this->view->moduleID = $moduleID;
        $this->view->projectID = $projectID;
        $this->view->taskID = $taskID;
        $this->view->storyID = $storyID;
        $this->view->buildID = $buildID;
        $this->view->caseID = $caseID;
        $this->view->bugTitle = $title;
        $this->view->steps = htmlspecialchars($steps);
        $this->view->os = $os;
        $this->view->browser = $browser;
        $this->view->assignedTo = $assignedTo;
        $this->view->mailto = $mailto;
        $this->view->contactLists = $this->user->getContactLists($this->app->user->account, 'withnote');
        $this->view->keywords = $keywords;
        $this->view->severity = $severity;
        $this->view->type = $type;
        $this->view->projectMembers = (array) $this->loadModel('team')->getProjectMembersPairs($projectID);
        $this->display();
    }

    /**
     * Batch create. 
     * 
     * @param  int    $productID 
     * @param  int    $projectID 
     * @param  int    $moduleID 
     * @access public
     * @return void
     */
    public function batchCreate($productID, $projectID = 0, $moduleID = 0) {
        if (!empty($_POST)) {
            $actions = $this->bug->batchCreate($productID);
            foreach ($actions as $bugID => $actionID)
                $this->sendmail($bugID, $actionID);
            die(js::locate($this->session->bugList, 'parent'));
        }

        /* Get product, then set menu. */
        $productID = $this->product->saveState($productID, $this->products);
        $this->bug->setMenu($this->products, $productID);

        /* If projectID is setted, get builds and stories of this project. */
        if ($projectID) {
            $builds = $this->loadModel('build')->getProjectBuildPairs($projectID, $productID, 'noempty');
            $stories = $this->story->getProjectStoryPairs($projectID);
        } else {
            $builds = $this->loadModel('build')->getProductBuildPairs($productID, 'noempty');
            $stories = $this->story->getProductStoryPairs($productID);
        }

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->batchCreate;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->batchCreate;

        $this->view->productID = $productID;
        $this->view->stories = $stories;
        $this->view->builds = $builds;
        $this->view->users = $this->user->getPairs('nodeleted,devfirst');
        #$this->view->projects = $this->product->getProjectPairs($productID, $params = 'nodeleted');
        $this->view->projectID = $projectID;
        $this->view->moduleOptionMenu = $this->tree->getOptionMenu($productID, $viewType = 'bug', $startModuleID = 0);
        $this->view->moduleID = $moduleID;
        $this->display();
    }

    /**
     * View a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function view($bugID) {
        /* Judge bug exits or not. */
        $this->loadModel("project");
        $bug = $this->bug->getById($bugID, true);
        if (!$bug)
            die(js::error($this->lang->notFound) . js::locate('back'));

        /* Update action. */
        if ($bug->assignedTo == $this->app->user->account)
            $this->loadModel('action')->read('bug', $bugID);

        /* Get product info. */
        $productID = $bug->project;
        $productName = $this->products[$productID];

        setcookie('lastProject', $bug->project, $this->config->cookieLife, $this->config->webRoot);

        /* Header and positon. */
        $this->view->title = "BUG #$bug->id $bug->title - " . $this->products[$productID];
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $productName);
        $this->view->position[] = $this->lang->bug->view;

        /* Assign. */
        $this->view->productID = $productID;
        $this->view->projectID = $bug->project;
        $this->view->productName = $productName;
        $this->view->module = $this->loadModel('module')->getByID($bug->module);
        $this->view->modulePath = $this->tree->getParents($bug->module);
        $this->view->bug = $bug;
        $this->view->users = $this->user->getPairs('noletter');
        $this->view->actions = $this->action->getList('bug', $bugID);
        $this->view->builds = $this->loadModel('build')->getProjectBuildPairs($productID);
        $this->view->preAndNext = $this->loadModel('common')->getPreAndNextObject('bug', $bugID);

        $this->display();
    }

    /**
     * Edit a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function edit($bugID, $comment = false) {
        if (!empty($_POST)) {
            $bug = $this->bug->getById($bugID);
            $changes = array();
            $files = array();

            if ($comment == false) {
                $changes = $this->bug->update($bugID);
                if (dao::isError())
                    die(js::error(dao::getError()));
                $_bug = $this->bug->getById($bugID);
                $files = $this->loadModel('file')->saveUpload('bug', $bugID);
            }

            echo $this->post->assignedTo . 'x';
            echo $bug->assignedTo;

            if ($this->post->assignedTo != '' && ($this->post->assignedTo != $bug->assignedTo)) {
                // 重新指派 Action记录
                $actionID = $this->action->create('bug', $bugID, 'Assigned', $this->post->reassign_comment, $_bug->status, '', $this->post->assignedTo);
                #$this->sendmail($bugID, $actionID);
            }

            if ($this->post->comment != '' or !empty($changes) or !empty($files)) {
                $action = !empty($changes) ? 'Edited' : 'Commented';
                $fileAction = '';
                if (!empty($files))
                    $fileAction = $this->lang->addFiles . join(',', $files) . "\n";
                #$actionID = $this->action->create('bug', $bugID, $action, $fileAction . $this->post->comment, $bug->status, '' , $bug->assignedTo);
                $this->action->logHistory($actionID, $changes);
                #$this->sendmail($bugID, $actionID);
            }

            setcookie('lastProject', $bug->project, $this->config->cookieLife, $this->config->webRoot);

            if ($bug->toTask != 0) {
                foreach ($changes as $change) {
                    if ($change['field'] == 'status') {
                        $confirmURL = $this->createLink('task', 'view', "taskID=$bug->toTask");
                        $cancelURL = $this->server->HTTP_REFERER;
                        die(js::confirm(sprintf($this->lang->bug->remindTask, $bug->Task), $confirmURL, $cancelURL, 'parent', 'parent'));
                    }
                }
            }
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }

        /* Get the info of bug, current product and modue. */
        $bug = $this->bug->getById($bugID);
        $productID = $bug->product;
        $projectID = $bug->project;
        $currentModuleID = $bug->module;

        /**
         * Remove designchange, newfeature, trackings from the typeList, because should be tracked in story or task. 
         * These thress types if upgrade from bugfree2.x.
         */
        if ($bug->type != 'designchange')
            unset($this->lang->bug->typeList['designchange']);
        if ($bug->type != 'newfeature')
            unset($this->lang->bug->typeList['newfeature']);
        if ($bug->type != 'trackthings')
            unset($this->lang->bug->typeList['trackthings']);

        /* Set the menu. */
        $this->bug->setMenu($this->products, $productID);

        /* Set header and position. */
        $this->view->title = $this->lang->bug->edit . "BUG #$bug->id $bug->title - " . $this->products[$productID];
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->edit;

        /* Assign. */
        if ($projectID) {
            $this->view->openedBuilds = $this->loadModel('build')->getProjectBuildPairs($projectID, $productID, 'noempty');
        } else {
            $this->view->openedBuilds = $this->loadModel('build')->getProductBuildPairs($productID, 'noempty');
        }

        $this->view->bug = $bug;
        $this->view->productID = $productID;
        $this->view->projectID = $projectID;
        $this->view->productName = $this->products[$productID];
        $this->view->crt_projects = $this->project->getProjectStatsPair();
        $this->view->moduleOptionMenu = $this->loadModel('module')->getPairs($projectID);
        $this->view->currentModuleID = $currentModuleID;
        $this->view->builds = $this->loadModel('build')->getProjectBuildPairs($bug->project);
        $this->view->members = $this->project->getTeamMemberPairs($bug->project);
        $this->view->stories = $bug->project ? $this->story->getProjectStoryPairs($bug->project) : $this->story->getProductStoryPairs($bug->product);
        $this->view->tasks = $this->task->getProjectTaskPairs($bug->project);
        $this->view->users = $this->user->getPairs('nodeleted', "$bug->assignedTo,$bug->resolvedBy,$bug->closedBy,$bug->openedBy");
        $this->view->resolvedBuilds = array('' => '') + $this->view->openedBuilds;
        $this->view->actions = $this->action->getList('bug', $bugID);
        $this->view->templates = $this->bug->getUserBugTemplates($this->app->user->account);

        $this->display();
    }

    /**
     * Batch edit bug.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function batchEdit($productID = 0) {
        if ($this->post->titles) {
            $allChanges = $this->bug->batchUpdate();

            foreach ($allChanges as $bugID => $changes) {
                $actionID = $this->action->create('bug', $bugID, 'Edited');
                $this->action->logHistory($actionID, $changes);
                $this->sendmail($bugID, $actionID);

                $bug = $this->bug->getById($bugID);
                if ($bug->toTask != 0) {
                    foreach ($changes as $change) {
                        if ($change['field'] == 'status') {
                            $confirmURL = $this->createLink('task', 'view', "taskID=$bug->toTask");
                            $cancelURL = $this->server->HTTP_REFERER;
                            die(js::confirm(sprintf($this->lang->bug->remindTask, $bug->task), $confirmURL, $cancelURL, 'parent', 'parent'));
                        }
                    }
                }
            }
            die(js::locate($this->session->bugList, 'parent'));
        }

        $bugIDList = $this->post->bugIDList ? $this->post->bugIDList : die(js::locate($this->session->bugList, 'parent'));

        /* The bugs of a product. */
        if ($productID) {
            $product = $this->product->getByID($productID);

            /* Set product menu. */
            $this->bug->setMenu($this->products, $productID);
            $this->view->title = $product->name . $this->lang->colon . "BUG" . $this->lang->bug->batchEdit;
            $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        }
        /* The bugs of my. */ else {
            $this->lang->bug->menu = $this->lang->my->menu;
            $this->lang->set('menugroup.bug', 'my');
            $this->lang->bug->menuOrder = $this->lang->my->menuOrder;
            $this->loadModel('my')->setMenu();
            $this->view->title = "BUG" . $this->lang->bug->batchEdit;
        }
        /* Initialize vars. */
        $bugs = $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($bugIDList)->fetchAll('id');

        /* Judge whether the editedTasks is too large and set session. */
        $showSuhosinInfo = false;
        $showSuhosinInfo = $this->loadModel('common')->judgeSuhosinSetting(count($bugs), $this->config->bug->batchEdit->columns);
        $this->app->session->set('showSuhosinInfo', $showSuhosinInfo);
        if ($showSuhosinInfo)
            $this->view->suhosinInfo = $this->lang->suhosinInfo;

        /* Assign. */
        $this->view->position[] = $this->lang->bug->common;
        $this->view->position[] = $this->lang->bug->batchEdit;
        $this->view->bugIDList = $bugIDList;
        $this->view->productID = $productID;
        $this->view->bugs = $bugs;
        $this->view->users = $this->user->getPairs('nodeleted,devfirst');

        $this->display();
    }

    /**
     * Update assign of bug. 
     *
     * @param  int    $bugID
     * @access public
     * @return void
     */
    public function assignTo($bugID) {
        $bug = $this->bug->getById($bugID);

        /* Set menu. */
        $this->bug->setMenu($this->products, $bug->product);

        if (!empty($_POST)) {
            $this->loadModel('action');
            $changes = $this->bug->assign($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $_bug = $this->bug->getById($bugID);
            $actionID = $this->action->create('bug', $bugID, 'Assigned', $this->post->comment, $_bug->status, '', $_bug->assignedTo);
            $this->action->logHistory($actionID, $changes);
            #$this->sendmail($bugID, $actionID);

            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }

        $this->view->title = $this->products[$bug->product] . $this->lang->colon . $this->lang->bug->assignedTo;
        $this->view->position[] = $this->lang->bug->assignedTo;
        $this->view->users = $this->project->getTeamMemberPairs($bug->project);
        $this->view->bug = $bug;
        $this->view->bugID = $bugID;
        $this->view->actions = $this->action->getList('bug', $bugID);
        $this->display();
    }

    /**
     * confirm a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function confirmBug($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->confirm($bugID);
            $_bug = $this->bug->getById($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $actionID = $this->action->create('bug', $bugID, 'bugConfirmed', $this->post->comment, $_bug->status, '', $_bug->assignedTo);
            $this->sendmail($bugID, $actionID);
            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }

        $productID = $bug->product;
        $this->bug->setMenu($this->products, $productID);

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->confirmBug;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->confirmBug;

        $this->view->bug = $bug;
        $this->view->users = $this->project->getTeamMemberPairs($bug->project);
        #$this->view->actions = $this->action->getList('bug', $bugID);
        $this->display();
    }

    /**
     * recheck a bug
     * 
     * @param type $bugID
     */
    public function recheck($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->recheck_bug($bugID);
            $_bug = $this->bug->getById($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $actionID = $this->action->create('bug', $bugID, 'bugrecheck', $this->post->comment, $_bug->status, '', $_bug->assignedTo);
            $this->sendmail($bugID, $actionID);
            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }

        $bug = $this->bug->getById($bugID);
        $productID = $bug->product;
        $this->bug->setMenu($this->products, $productID);

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->confirmBug;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->confirmBug;

        $this->view->bug = $bug;
        $this->view->users = $this->project->getTeamMemberPairs($bug->project);
        $this->view->actions = $this->action->getList('bug', $bugID);
        $this->display();
    }

    /**
     * suspend a bug
     * 
     * @param type $bugID
     */
    public function suspend($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->suspend_bug($bugID);
            $_bug = $this->bug->getById($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $actionID = $this->action->create('bug', $bugID, 'bugSuspend', $this->post->comment, $_bug->status, '', $_bug->assignedTo);
            $this->sendmail($bugID, $actionID);
            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        } else {
            $productID = $bug->product;
            $projects = $this->loadModel('project')->getPairs();
            $projects[0] = '';

            // 挂起率
            $count_assigntomesuspend = $this->bug->getSuspendCount($bug->openedBuild, $bug->project);
            $count_assigntomecount = $this->bug->getBuildBugCount($bug->openedBuild, $bug->project);

            $suspendRate = round(($count_assigntomesuspend->count / $count_assigntomecount->count), 2) * 100;

            $this->view->title = '挂起bug';

            $this->view->suspendRate = $suspendRate;
            $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
            $this->view->position[] = $this->lang->bug->confirmBug;

            // 挂起率级别
            $this->view->suspendRateLevel = $this->view->suspendRate < ($this->config->maxBugSuspendRate / 2) ? 'low' : (($this->view->suspendRate > ($this->config->maxBugSuspendRate / 2) && $this->view->suspendRate < $this->config->maxBugSuspendRate) ? 'mid' : 'hig');
            $this->view->bug = $bug;
            #$this->view->users = $this->user->getPairs('nodeleted', $bug->assignedTo);
            $this->view->actions = $this->action->getList('bug', $bugID);
            $this->bug->setMenu($this->products, $productID);

            if ($suspendRate > $this->config->maxBugSuspendRate):
                $this->view->enable = false;
            else:
                $this->view->enable = true;
            endif;
            $this->display();
        }
    }

    /**
     * Batch confirm bugs. 
     * 
     * @access public
     * @return void
     */
    public function batchConfirm() {
        $bugIDList = $this->post->bugIDList ? $this->post->bugIDList : die(js::locate($this->session->bugList, 'parent'));
        $this->bug->batchConfirm($bugIDList);
        if (dao::isError())
            die(js::error(dao::getError()));
        foreach ($bugIDList as $bugID) {
            $actionID = $this->action->create('bug', $bugID, 'bugConfirmed');
            $this->sendmail($bugID, $actionID);
        }
        die(js::locate($this->session->bugList, 'parent'));
    }

    /**
     * Resolve a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function resolve($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->resolve($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $_bug = $this->bug->getById($bugID);
            $actionID = $this->action->create('bug', $bugID, 'Resolved', $this->post->comment, $_bug->status, '', $bug->openedBy);
            $this->sendmail($bugID, $actionID);
            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }
        $productID = $bug->product;
        $this->bug->setMenu($this->products, $productID);

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->resolve;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->resolve;

        $this->view->bug = $bug;
        $this->view->users = $this->project->getTeamMemberPairs($bug->project);
        $this->view->builds = $this->loadModel('build')->getProjectBuildPairs($bug->project);
        #$this->view->actions = $this->action->getList('bug', $bugID);
        $this->display();
    }

    /**
     * Batch resolve bugs.
     * 
     * @param  string    $resolution 
     * @param  string    $resolvedBuild 
     * @access public
     * @return void
     */
    public function batchResolve($resolution, $resolvedBuild = '') {
        $bugIDList = $this->post->bugIDList ? $this->post->bugIDList : die(js::locate($this->session->bugList, 'parent'));
        $this->bug->batchResolve($bugIDList, $resolution, $resolvedBuild);
        if (dao::isError())
            die(js::error(dao::getError()));
        foreach ($bugIDList as $bugID) {
            $actionID = $this->action->create('bug', $bugID, 'Resolved', '', $resolution);
            $this->sendmail($bugID, $actionID);
        }
        die(js::locate($this->session->bugList, 'parent'));
    }

    /**
     * Activate a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function activate($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->activate($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $_bug = $this->bug->getById($bugID);
            #$files = $this->loadModel('file')->saveUpload('bug', $bugID);
            $actionID = $this->action->create('bug', $bugID, 'Activated', $this->post->comment, $_bug->status, '', $_bug->assignedTo);

            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }
        $productID = $bug->product;
        $this->bug->setMenu($this->products, $productID);

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->activate;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->activate;

        $this->view->bug = $bug;
        $this->view->members = $this->project->getTeamMemberPairs($bug->project);
        $this->view->builds = $this->loadModel('build')->getProjectBuildPairs($bug->project, 'noempty');
        $this->view->actions = $this->action->getList('bug', $bugID);

        $this->display();
    }

    /**
     * Close a bug.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function close($bugID) {
        $bug = $this->bug->getById($bugID);
        if (!empty($_POST)) {
            $this->bug->close($bugID);
            if (dao::isError())
                die(js::error(dao::getError()));
            $_bug = $this->bug->getById($bugID);
            $actionID = $this->action->create('bug', $bugID, 'Closed', $this->post->comment, $_bug->status);
            #$this->sendmail($bugID, $actionID);
            if (isonlybody())
                die(js::closeColorbox('parent.parent'));
            die(js::locate($this->createLink('bug', 'view', "bugID=$bugID"), 'parent'));
        }

        $productID = $bug->product;
        $this->bug->setMenu($this->products, $productID);

        $this->view->title = $this->products[$productID] . $this->lang->colon . $this->lang->bug->close;
        $this->view->position[] = html::a($this->createLink('bug', 'browse', "productID=$productID"), $this->products[$productID]);
        $this->view->position[] = $this->lang->bug->close;

        $this->view->bug = $bug;
        $this->view->users = $this->user->getPairs('noletter');
        $this->view->actions = $this->action->getList('bug', $bugID);
        $this->display();
    }

    /**
     * Confirm story change.
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function confirmStoryChange($bugID) {
        $bug = $this->bug->getById($bugID);
        $this->dao->update(TABLE_BUG)->set('storyVersion')->eq($bug->latestStoryVersion)->where('id')->eq($bugID)->exec();
        $this->loadModel('action')->create('bug', $bugID, 'confirmed', '', $bug->latestStoryVersion);
        die(js::reload('parent'));
    }

    /**
     * Delete a bug.
     * 
     * @param  int    $bugID 
     * @param  string $confirm  yes|no
     * @access public
     * @return void
     */
    public function delete($bugID, $confirm = 'no') {
        $bug = $this->bug->getById($bugID);
        if ($confirm == 'no') {
            die(js::confirm($this->lang->bug->confirmDelete, inlink('delete', "bugID=$bugID&confirm=yes")));
        } else {
            $this->bug->delete(TABLE_BUG, $bugID);
            if ($bug->toTask != 0)
                echo js::alert($this->lang->bug->remindTask . $bug->toTask);
            die(js::locate($this->session->bugList, 'parent'));
        }
    }

    /**
     * Save current template.
     * 
     * @access public
     * @return string
     */
    public function saveTemplate() {
        $this->bug->saveUserBugTemplate();
        if (dao::isError())
            die(js::error(dao::getError()));
        die($this->fetch('bug', 'buildTemplates'));
    }

    /**
     * Build the user templates selection code.
     * 
     * @access public
     * @return void
     */
    public function buildTemplates() {
        $this->view->templates = $this->bug->getUserBugTemplates($this->app->user->account);
        $this->display('bug', 'buildTemplates');
    }

    /**
     * Delete a user template.
     * 
     * @param  int    $templateID 
     * @access public
     * @return void
     */
    public function deleteTemplate($templateID) {
        $this->dao->delete()->from(TABLE_USERTPL)->where('id')->eq($templateID)->andWhere('account')->eq($this->app->user->account)->exec();
        die();
    }

    /**
     * Custom fields.
     * 
     * @access public
     * @return void
     */
    public function customFields() {
        if ($_POST) {
            $customFields = $this->post->customFields;
            $customFields = join(',', $customFields);
            setcookie('bugFields', $customFields, $this->config->cookieLife, $this->config->webRoot);
            die(js::reload('parent'));
        }

        $customFields = $this->cookie->bugFields ? $this->cookie->bugFields : $this->config->bug->list->defaultFields;

        $this->view->allFields = $this->bug->getFieldPairs($this->config->bug->list->allFields);
        $this->view->customFields = $this->bug->getFieldPairs($customFields);
        $this->view->defaultFields = $this->bug->getFieldPairs($this->config->bug->list->defaultFields);
        die($this->display());
    }

    /**
     * AJAX: get bugs of a user in html select.
     * 
     * @param  string $account 
     * @param  string $id       the id of the select control.
     * @access public
     * @return string
     */
    public function ajaxGetUserBugs($account = '', $id = '') {
        if ($account == '')
            $account = $this->app->user->account;
        $bugs = $this->bug->getUserBugPairs($account);

        if ($id)
            die(html::select("bugs[$id]", $bugs, '', 'class="select-1 f-left"'));
        die(html::select('bug', $bugs, '', 'class=select-1'));
    }

    /**
     * AJAX: Get bug owner of a module.
     * 
     * @param  int    $moduleID 
     * @param  int    $productID 
     * @access public
     * @return string
     */
    public function ajaxGetModuleOwner($moduleID, $productID = 0) {
        $owner = '';
        if ($moduleID)
            $owner = $this->dao->findByID($moduleID)->from(TABLE_MODULE)->fetch('owner');
        if (!$owner)
            $owner = $this->dao->findByID($productID)->from(TABLE_PRODUCT)->fetch('QD');
        die($owner);
    }

    /**
     * AJAX: get assignedTo list, make sure the members of the project at the first.
     * 
     * @param  int    $projectID 
     * @param  string $selectedUser 
     * @access public
     * @return string
     */
    public function ajaxLoadAssignedTo($projectID, $selectedUser = '') {
        $allUsers = $this->loadModel('user')->getPairs('nodeleted, devfirst');
        $projectMembers = $this->loadModel('project')->getTeamMemberPairs($projectID);
        $assignedToList = array_merge($projectMembers, $allUsers);

        die(html::select('assignedTo', $assignedToList, $selectedUser, 'class="select-3"'));
    }

    /**
     * AJAX: get actions of a bug. for web app. 
     * 
     * @param  int    $bugID 
     * @access public
     * @return void
     */
    public function ajaxGetDetail($bugID) {
        $this->view->actions = $this->loadModel('action')->getList('bug', $bugID);
        $this->display();
    }

    /**
     * Send email.
     * 
     * @param  int    $bugID 
     * @param  int    $actionID 
     * @access public
     * @return void
     */
    public function sendmail($bugID, $actionID) {
        /* Set toList and ccList. */
        $bug = $this->bug->getByID($bugID);
        $bug->module = $this->loadModel('module')->getByID($bug->module);
        $productName = $this->products[$bug->product];
        $toList = $bug->assignedTo;
        $ccList = trim($bug->mailto, ',');
        if ($toList == '') {
            if ($ccList == '')
                return;
            if (strpos($ccList, ',') === false) {
                $toList = $ccList;
                $ccList = '';
            } else {
                $commaPos = strpos($ccList, ',');
                $toList = substr($ccList, 0, $commaPos);
                $ccList = substr($ccList, $commaPos + 1);
            }
        } elseif (strtolower($toList) == 'closed') {
            $toList = $bug->resolvedBy;
        }

        /* Get action info. */
        $action = $this->action->getById($actionID);
        $history = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();
        if (strtolower($action->action) == 'opened')
            $action->comment = $bug->steps;
        $users = $this->user->getPairs('noletter');
        /* Create the mail content. */
        if ($action->action == 'opened')
            $action->comment = '';
        $this->view->bug = $bug;
        $this->view->project = $bug->projectName;
        $this->view->action = $action;
        $this->view->users = $users;
        $mailContent = $this->parse($this->moduleName, 'sendmail');

        /* Send it. */
        $this->loadModel('mail')->send($toList, $users[$bug->openedBy] . '在 [' . $bug->projectName . ']创建了新的Bug', $mailContent, $ccList);

        if ($this->mail->isError()) {
            trigger_error(join("\n", $this->mail->getError()));
        }
    }

    /**
     * Get data to export 
     * 
     * @param  string $productID 
     * @param  string $orderBy 
     * @access public
     * @return void
     */
    public function export($productID, $orderBy) {
        if ($_POST) {
            $bugLang = $this->lang->bug;
            $bugConfig = $this->config->bug;

            /* Create field lists. */
            $fields = explode(',', $bugConfig->list->exportFields);
            foreach ($fields as $key => $fieldName) {
                $fieldName = trim($fieldName);
                $fields[$fieldName] = isset($bugLang->$fieldName) ? $bugLang->$fieldName : $fieldName;
                unset($fields[$key]);
            }

            /* Get bugs. */
            $bugs = $this->dao->select('*')->from(TABLE_BUG)->where($this->session->bugQueryCondition)
                            ->beginIF($this->post->exportType == 'selected')->andWhere('id')->in($this->cookie->checkedItem)->fi()
                            ->orderBy($orderBy)->fetchAll('id');

            /* Get users, products and projects. */
            $users = $this->loadModel('user')->getPairs('noletter');
            $products = $this->loadModel('product')->getPairs('nocode');
            $projects = $this->loadModel('project')->getPairs('all|nocode');

            /* Get related objects id lists. */
            $relatedModuleIdList = array();
            $relatedStoryIdList = array();
            $relatedTaskIdList = array();
            $relatedBugIdList = array();
            $relatedCaseIdList = array();
            $relatedBuildIdList = array();

            foreach ($bugs as $bug) {
                $relatedModuleIdList[$bug->module] = $bug->module;
                $relatedStoryIdList[$bug->story] = $bug->story;
                $relatedTaskIdList[$bug->task] = $bug->task;
                $relatedCaseIdList[$bug->case] = $bug->case;
                $relatedBugIdList[$bug->duplicateBug] = $bug->duplicateBug;

                /* Process link bugs. */
                $linkBugs = explode(',', $bug->linkBug);
                foreach ($linkBugs as $linkBugID) {
                    if ($linkBugID)
                        $relatedBugIdList[$linkBugID] = trim($linkBugID);
                }

                /* Process builds. */
                $builds = $bug->openedBuild . ',' . $bug->resolvedBuild;
                $builds = explode(',', $builds);
                foreach ($builds as $buildID) {
                    if ($buildID)
                        $relatedBuildIdList[$buildID] = trim($buildID);
                }
            }

            /* Get related objects title or names. */
            $relatedModules = $this->dao->select('id, name')->from(TABLE_MODULE)->where('id')->in($relatedModuleIdList)->fetchPairs();
            $relatedStories = $this->dao->select('id,title')->from(TABLE_STORY)->where('id')->in($relatedStoryIdList)->fetchPairs();
            $relatedTasks = $this->dao->select('id, name')->from(TABLE_TASK)->where('id')->in($relatedTaskIdList)->fetchPairs();
            $relatedBugs = $this->dao->select('id, title')->from(TABLE_BUG)->where('id')->in($relatedBugIdList)->fetchPairs();
            $relatedCases = $this->dao->select('id, title')->from(TABLE_CASE)->where('id')->in($relatedCaseIdList)->fetchPairs();
            $relatedBuilds = $this->dao->select('id, name')->from(TABLE_BUILD)->where('id')->in($relatedBuildIdList)->fetchPairs();
            $relatedFiles = $this->dao->select('id, objectID, pathname, title')->from(TABLE_FILE)->where('objectType')->eq('bug')->andWhere('objectID')->in(@array_keys($bugs))->fetchGroup('objectID');

            foreach ($bugs as $bug) {
                if ($this->post->fileType == 'csv') {
                    $bug->steps = htmlspecialchars_decode($bug->steps);
                    $bug->steps = str_replace("<br />", "\n", $bug->steps);
                    $bug->steps = str_replace('"', '""', $bug->steps);
                    $bug->steps = str_replace('&nbsp;', ' ', $bug->steps);
                    $bug->steps = strip_tags($bug->steps);
                }

                /* fill some field with useful value. */
                if (isset($products[$bug->product]))
                    $bug->product = $products[$bug->product];
                if (isset($projects[$bug->project]))
                    $bug->project = $projects[$bug->project];
                if (isset($relatedModules[$bug->module]))
                    $bug->module = $relatedModules[$bug->module];
                if (isset($relatedStories[$bug->story]))
                    $bug->story = $relatedStories[$bug->story];
                if (isset($relatedTasks[$bug->task]))
                    $bug->task = $relatedTasks[$bug->task];
                if (isset($relatedBugs[$bug->duplicateBug]))
                    $bug->duplicateBug = $relatedBugs[$bug->duplicateBug];
                if (isset($relatedCases[$bug->case]))
                    $bug->case = $relatedCases[$bug->case];

                if (isset($bugLang->priList[$bug->pri]))
                    $bug->pri = $bugLang->priList[$bug->pri];
                if (isset($bugLang->typeList[$bug->type]))
                    $bug->type = $bugLang->typeList[$bug->type];
                if (isset($bugLang->statusList[$bug->status]))
                    $bug->status = $bugLang->statusList[$bug->status];
                if (isset($bugLang->confirmedList[$bug->confirmed]))
                    $bug->confirmed = $bugLang->confirmedList[$bug->confirmed];
                if (isset($bugLang->resolutionList[$bug->resolution]))
                    $bug->resolution = $bugLang->resolutionList[$bug->resolution];

                if (isset($users[$bug->openedBy]))
                    $bug->openedBy = $users[$bug->openedBy];
                if (isset($users[$bug->assignedTo]))
                    $bug->assignedTo = $users[$bug->assignedTo];
                if (isset($users[$bug->resolvedBy]))
                    $bug->resolvedBy = $users[$bug->resolvedBy];
                if (isset($users[$bug->lastEditedBy]))
                    $bug->lastEditedBy = $users[$bug->lastEditedBy];
                if (isset($users[$bug->closedBy]))
                    $bug->closedBy = $users[$bug->closedBy];

                $bug->openedDate = substr($bug->openedDate, 0, 10);
                $bug->assignedDate = substr($bug->assignedDate, 0, 10);
                $bug->closedDate = substr($bug->closedDate, 0, 10);
                $bug->resolvedDate = substr($bug->resolvedDate, 0, 10);
                $bug->lastEditedDate = substr($bug->lastEditedDate, 0, 10);

                if ($bug->linkBug) {
                    $tmpLinkBugs = array();
                    $linkBugIdList = explode(',', $bug->linkBug);
                    foreach ($linkBugIdList as $linkBugID) {
                        $linkBugID = trim($linkBugID);
                        $tmpLinkBugs[] = isset($relatedBugs[$linkBugID]) ? $relatedBugs[$linkBugID] : $linkBugID;
                    }
                    $bug->linkBug = join("; \n", $tmpLinkBugs);
                }

                if ($bug->openedBuild) {
                    $tmpOpenedBuilds = array();
                    $tmpResolvedBuilds = array();
                    $buildIdList = explode(',', $bug->openedBuild);
                    foreach ($buildIdList as $buildID) {
                        $buildID = trim($buildID);
                        $tmpOpenedBuilds[] = isset($relatedBuilds[$buildID]) ? $relatedBuilds[$buildID] : $buildID;
                    }
                    $bug->openedBuild = join("; \n", $tmpOpenedBuilds);
                }

                if ($bug->resolvedBuild) {
                    $buildIdList = explode(',', $bug->resolvedBuild);
                    foreach ($buildIdList as $buildID) {
                        $buildID = trim($buildID);
                        $tmpResolvedBuilds[] = isset($relatedBuilds[$buildID]) ? $relatedBuilds[$buildID] : $buildID;
                    }
                    $bug->resolvedBuild = join("; \n", $tmpResolvedBuilds);
                }

                /* Set related files. */
                if (isset($relatedFiles[$bug->id])) {
                    foreach ($relatedFiles[$bug->id] as $file) {
                        $fileURL = 'http://' . $this->server->http_host . $this->config->webRoot . "data/upload/{$this->app->company->id}/" . $file->pathname;
                        $bug->files .= html::a($fileURL, $file->title, '_blank') . '<br />';
                    }
                }

                $bug->mailto = trim(trim($bug->mailto), ',');
                $mailtos = explode(',', $bug->mailto);
                $bug->mailto = '';
                foreach ($mailtos as $mailto) {
                    $mailto = trim($mailto);
                    if (isset($users[$mailto]))
                        $bug->mailto .= $users[$mailto] . ',';
                }

                unset($bug->caseVersion);
                unset($bug->result);
                unset($bug->deleted);
            }

            $this->post->set('fields', $fields);
            $this->post->set('rows', $bugs);
            $this->post->set('kind', 'bug');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->display();
    }

}
