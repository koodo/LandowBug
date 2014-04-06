<?php

/**
 * The model file of common module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     common
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class commonModel extends model {

    /**
     * Start the session.
     * 
     * @access public
     * @return void
     */
    public function startSession() {
        session_name($this->config->sessionVar);
        if (isset($_GET[$this->config->sessionVar]))
            session_id($_GET[$this->config->sessionVar]);
        session_start();
    }

    /**
     * Set the header info.
     * 
     * @access public
     * @return void
     */
    public function sendHeader() {
        header("Content-Type: text/html; Language={$this->config->charset}");
        header("Cache-control: private");
    }

    /**
     * Set the commpany.
     *
     * First, search company by the http host. If not found, search by the default domain. Last, use the first as the default. 
     * After get the company, save it to session.
     * @access public
     * @return void
     */
    public function setCompany() {
        $httpHost = $this->server->http_host;

        if ($this->session->company) {
            $this->app->company = $this->session->company;
        } else {
            $company = $this->loadModel('company')->getFirst();
            if (!$company)
                $this->app->triggerError(sprintf($this->lang->error->companyNotFound, $httpHost), __FILE__, __LINE__, $exit = true);
            $this->session->set('company', $company);
            $this->app->company = $company;
        }
    }

    /**
     * Set the user info.
     * 
     * @access public
     * @return void
     */
    public function setUser() {
        if ($this->session->user) {
            $this->app->user = $this->session->user;
        } elseif ($this->app->company->guest or defined('IN_SHELL')) {
            $user = new stdClass();
            $user->id = 0;
            $user->account = 'guest';
            $user->realname = 'guest';
            $user->role = 'guest';
            $user->rights = $this->loadModel('user')->authorize('guest');
            $this->session->set('user', $user);
            $this->app->user = $this->session->user;
        }
    }

    /**
     * Load configs from database and save it to config->system and config->personal.
     * 
     * @access public
     * @return void
     */
    public function loadConfigFromDB() {
        /* Get configs of system and current user. */
        $account = isset($this->app->user->account) ? $this->app->user->account : '';
        if ($this->config->db->name)
            $config = $this->loadModel('setting')->getSysAndPersonalConfig($account);
        $this->config->system = isset($config['system']) ? $config['system'] : array();
        $this->config->personal = isset($config[$account]) ? $config[$account] : array();

        /* Overide the items defined in config/config.php and config/my.php. */
        if (isset($this->config->system->common)) {
            foreach ($this->config->system->common as $record) {
                if ($record->section) {
                    if (!isset($this->config->{$record->section}))
                        $this->config->{$record->section} = new stdclass();
                    $this->config->{$record->section}->{$record->key} = $record->value;
                }
                else {
                    if (!$record->section)
                        $this->config->{$record->key} = $record->value;
                }
            }
        }
    }

    /**
     * Load custom lang from db.
     * 
     * @access public
     * @return void
     */
    public function loadCustomFromDB() {
        if (defined('IN_UPGRADE'))
            return;
        if (!$this->config->db->name)
            return;
        $records = $this->loadModel('custom')->getAll();
        if (!$records)
            return;
        $this->lang->db = new stdclass();
        $this->lang->db->custom = $records;
    }

    /**
     * Juage a method of one module is open or not?
     * 
     * @param  string $module 
     * @param  string $method 
     * @access public
     * @return bool
     */
    public function isOpenMethod($module, $method) {
        if ($module == 'user' and strpos('login|logout|deny', $method) !== false)
            return true;
        if ($module == 'api' and $method == 'getsessionid')
            return true;
        if ($module == 'misc' and $method == 'ping')
            return true;
        if ($module == 'sso' and strpos('auth|depts|users', $method) !== false)
            return true;
        if ($module == 'bug' and strpos('suspend|recheck', $method) !== false)
            return true;

        if ($this->loadModel('user')->isLogon()) {
            if (stripos($method, 'ajax') !== false)
                return true;
            if (stripos($method, 'downnotify') !== false)
                return true;
        }

        if (stripos($method, 'ajaxgetdropmenu') !== false and $this->app->user->account == 'guest')
            return true;
        if (stripos($method, 'ajaxgetmatcheditems') !== false and $this->app->user->account == 'guest')
            return true;
        if ($method == 'ajaxgetdetail' and $this->app->viewType == 'mhtml')
            return true;
        if ($module == 'misc' and $method == 'qrcode')
            return true;
        if ($module == 'misc' and $method == 'about')
            return true;
        if ($module == 'misc' and $method == 'checkupdate')
            return true;
        return false;
    }

    /**
     * Deny access.
     * 
     * @access public
     * @return void
     */
    public function deny($module, $method) {
        $vars = "module=$module&method=$method";
        if (isset($this->server->http_referer)) {
            $referer = helper::safe64Encode($this->server->http_referer);
            $vars .= "&referer=$referer";
        }
        $denyLink = helper::createLink('user', 'deny', $vars);

        /* Fix the bug of IE: use js locate, can't get the referer. */
        if (strpos($this->server->http_user_agent, 'MSIE') !== false) {
            echo "<a href='$denyLink' id='denylink' style='display:none'>deny</a>";
            echo "<script language='javascript'>document.getElementById('denylink').click();</script>";
        } else {
            echo js::locate($denyLink);
        }
        exit;
    }

    /**
     * Get the run info.
     * 
     * @param mixed $startTime  the start time of this execution
     * @access public
     * @return array    the run info array.
     */
    public function getRunInfo($startTime) {
        $info['timeUsed'] = round(getTime() - $startTime, 4) * 1000;
        $info['memory'] = round(memory_get_peak_usage() / 1024, 1);
        $info['querys'] = count(dao::$querys);
        return $info;
    }

    /**
     * Print top bar.
     * 
     * @static
     * @access public
     * @return void
     */
    public static function printTopBar() {
        global $lang, $app;

        $account = ',' . $users[$app->user->account] . ',';
        #$isAdmin = strpos($app->company->admins, $account) !== false;
        $dao = $app->loadClass('dao');

        // 获取所加入的项目ID
        $project_count1 = $dao->select('t1.id')
                ->from(TABLE_PROJECT)->alias('t1')
                ->leftJoin(TABLE_TEAM)->alias('t2')
                ->on('t1.id = t2.project')
                ->where('t1.openedBy')->eq($app->user->account)
                ->orwhere('t2.account')->eq($app->user->account)
                ->groupBy('t1.id')
                ->fetchAll();

        printf($lang->todayIs, date(DT_DATE4));

        if (isset($app->user)) {
            $realname = $dao->select('realname')
                    ->from(TABLE_USER)
                    ->where('id')->eq($app->user->id)
                    ->fetchAll();
            $realname = $realname[0];
            echo '欢迎 ' . $realname->realname;
        }

        echo "&nbsp;";

        echo html::a(helper::createLink('project', 'index', "locate=no&status=all"), sprintf('%s 个项目', count($project_count1)), '');

        echo $lang->spliter;

        #echo html::a(helper::createLink('project', 'team', "projectID=" . $_COOKIE['lastProject']), '我的团队', '');
        echo html::a(helper::createLink('team', 'listeam', "uid=" . $app->user->account), '我的团队', '');

        echo $lang->spliter;

        echo html::a(helper::createLink('my', 'profile'), '个人资料', '');

        echo $lang->spliter;

        if (isset($app->user) and $app->user->account != 'guest') {
            echo html::a(helper::createLink('user', 'logout'), $lang->logout);
        } else {
            echo html::a(helper::createLink('user', 'login'), $lang->login);
        }

        // @modify Edited by chenyongcai
        #echo '&nbsp;|&nbsp; ';
        #echo html::a(helper::createLink('misc', 'about'), $lang->aboutZenTao, '', "class='about'");
        #echo $lang->agileTraining;
        #echo $lang->donate;
        #echo '&nbsp;|&nbsp;';
        #echo html::select('', $app->config->langs, $app->cookie->lang,  'onchange="selectLang(this.value)"');
        #echo html::select('', $app->lang->themes,  $app->cookie->theme, 'onchange="selectTheme(this.value)"');
    }

    /**
     * Set mobile menu.
     * 
     * @access public
     * @return void
     */
    public function setMobileMenu() {
        $menu = new stdclass();

        $role = isset($this->app->user->role) ? $this->app->user->role : '';

        $this->config->locate = new stdclass();
        $this->config->locate->module = 'my';
        $this->config->locate->method = 'todo';
        $this->config->locate->params = '';

        $todo = $this->lang->my->menu->todo['link'];
        $task = $this->lang->my->menu->task['link'];
        $story = $this->lang->my->menu->story['link'];
        $bug = $this->lang->my->menu->bug['link'];
        $project = $this->lang->menu->project . '|locate=no&&status=isdoing';
        $product = $this->lang->menu->product . '|locate=no';

        if ($role == 'dev' or $role == 'td' or $role == 'pm') {
            $menu = array('todo' => $todo, 'task' => $task, 'bug' => $bug, 'product' => $product, 'project' => $project);
        } elseif ($role == 'pd' or $role == 'po') {
            $menu = array('todo' => $todo, 'story' => $story, 'bug' => $bug, 'product' => $product, 'project' => $project);
        } elseif ($role == 'qa' or $role == 'qd') {
            $menu = array('todo' => $todo, 'bug' => $bug, 'project' => $project, 'product' => $product);
        } elseif ($role == 'top') {
            $menu = array('project' => $project, 'product' => $product, 'todo' => $todo);

            $this->config->locate->module = 'project';
            $this->config->locate->method = 'index';
            $this->config->locate->params = 'locate=no&status=doing';
        } else {
            $menu = array('todo' => $todo, 'task' => $task, 'bug' => $bug, 'project' => $project, 'product' => $product);
        }

        unset($this->lang->menuOrder);
        unset($this->lang->menugroup);
        $this->lang->menu = new stdclass();
        $this->lang->menu = $menu;
    }

    /**
     * Print the main menu.
     * 
     * @param  string $moduleName 
     * @static
     * @access public
     * @return void
     */
    public static function printMainmenu($moduleName, $methodName = '') {
        global $app, $lang;
        echo "<ul>\n";

        /* Set the main main menu. */
        $mainMenu = $moduleName;
        if (isset($lang->menugroup->$moduleName))
            $mainMenu = $lang->menugroup->$moduleName;
        if ($app->getViewType() == 'mhtml') {
            if ($moduleName == 'my')
                $mainMenu = $methodName;
            if ($moduleName == 'todo')
                $mainMenu = $moduleName;
            if ($moduleName == 'story' and !isset($lang->menu->story))
                $mainMenu = 'product';
            if ($moduleName == 'bug' and !isset($lang->menu->bug))
                $mainMenu = 'product';
            if ($moduleName == 'task' and !isset($lang->menu->task))
                $mainMenu = 'project';
        }

        /* Sort menu according to menuOrder. */
        if (isset($lang->menuOrder)) {
            $menus = $lang->menu;
            $lang->menu = new stdclass();

            ksort($lang->menuOrder, SORT_ASC);
            foreach ($lang->menuOrder as $key) {
                $menu = $menus->$key;
                unset($menus->$key);
                $lang->menu->$key = $menu;
            }
            foreach ($menus as $key => $menu) {
                $lang->menu->$key = $menu;
            }
        }

        $activeName = $app->getViewType() == 'mhtml' ? 'ui-btn-active' : 'active';

        /* Print all main menus. */
        foreach ($lang->menu as $menuKey => $menu) {
            $active = $menuKey == $mainMenu ? "class='$activeName'" : '';
            $link = explode('|', $menu);
            list($menuLabel, $module, $method) = $link;
            if ($module != '') {
                // $link[3]可以传参
                $vars = isset($link[3]) ? $link[3] : '';
                if (common::hasPriv($module, $method)) {
                    $link = helper::createLink($module, $method, $vars);
                    echo "<li $active><a href='$link' $active id='menu$menuKey'>$menuLabel</a></li>\n";
                }
            }
        }
    }

    /**
     * Print the search box.
     * 
     * @static
     * @access public
     * @return void
     */
    public static function printSearchBox() {
        global $app, $lang;
        $moduleName = $app->getModuleName();
        $methodName = $app->getMethodName();
        $searchObject = $moduleName;

        if ($moduleName == 'product') {
            if ($methodName == 'browse')
                $searchObject = 'story';
        }
        elseif ($moduleName == 'project') {
            if (strpos('task|story|bug|build', $methodName) !== false)
                $searchObject = $methodName;
        }
        elseif ($moduleName == 'my' or $moduleName == 'user') {
            $searchObject = $methodName;
        }

        echo "<li id='searchbox'>";
        echo html::select('searchType', $lang->searchObjects, $searchObject);
        echo html::input('searchQuery', $lang->searchTips, "onclick=this.value='' onkeydown='if(event.keyCode==13) shortcut()' class='w-80px'");
        echo "<a href='javascript:shortcut();return false;' id='objectSwitcher' class='icon-circle-arrow-right'></a>";
        echo "</li>";
        echo "</ul>\n";
    }

    /**
     * Print the module menu.
     * 
     * @param  string $moduleName 
     * @static
     * @access public
     * @return void
     */
    public static function printModuleMenu($moduleName) {
        global $lang, $app;

        if (!isset($lang->$moduleName->menu)) {
            echo "<ul></ul>";
            return;
        }

        /* Get the sub menus of the module, and get current module and method. */
        $submenus = $lang->$moduleName->menu;
        $currentModule = $app->getModuleName();
        $currentMethod = $app->getMethodName();

        /* Sort the subMenu according to menuOrder. */
        if (isset($lang->$moduleName->menuOrder)) {
            $menus = $submenus;
            $submenus = new stdclass();

            ksort($lang->$moduleName->menuOrder, SORT_ASC);
            if (isset($menus->list)) {
                $submenus->list = $menus->list;
                unset($menus->list);
            }
            foreach ($lang->$moduleName->menuOrder as $order) {
                if (($order != 'list') && isset($menus->$order)) {
                    $subOrder = $menus->$order;
                    unset($menus->$order);
                    $submenus->$order = $subOrder;
                }
            }
            foreach ($menus as $key => $menu) {
                $submenus->$key = $menu;
            }
        }

        /* The beginning of the menu. */
        echo "<ul>\n";

        /* Cycling to print every sub menus. */
        foreach ($submenus as $subMenuKey => $submenu) {
            /* Init the these vars. */
            $link = $submenu;
            $subModule = '';
            $alias = '';
            $float = '';
            $active = '';
            $target = '';

            if (is_array($submenu))
                extract($submenu);   // If the sub menu is an array, extract it.

                /* Print the menu. */
            if (strpos($link, '|') === false) {
                if ($currentMethod == 'browse' || $currentMethod == 'report')
                    echo "<li>$link</li>\n";
            }/* else {
              #$ingore_list = array('bug','testcase', 'testtask','roadmap','release','doc','browse','view');
              #if(in_array($subMenuKey,$ingore_list)) continue;
              #echo $subMenuKey;
              $link = explode('|', $link);
              list($label, $module, $method) = $link;
              $vars = isset($link[3]) ? $link[3] : '';
              if(common::hasPriv($module, $method))
              {
              // Is the currentModule active?
              $subModules = explode(',', $subModule);
              if(in_array($currentModule,$subModules) and $float != 'right') $active = 'active';
              if($module == $currentModule and ($method == $currentMethod or strpos(",$alias,", ",$currentMethod,") !== false) and $float != 'right') $active = 'active';
              echo "<li class='$float $active'>" . html::a(helper::createLink($module, $method, $vars), $label, $target, "id=submenu$subMenuKey") . "</li>\n";
              }
              } */
        }
        echo "</ul>\n";
    }

    /**
     * Print the bread menu.
     * 
     * @param  string $moduleName 
     * @param  string $position 
     * @static
     * @access public
     * @return void
     */
    public static function printBreadMenu($moduleName, $position) {
        global $lang;
        $mainMenu = $moduleName;
        if (isset($lang->menugroup->$moduleName))
            $mainMenu = $lang->menugroup->$moduleName;
        echo html::a(helper::createLink('my', 'index'), $lang->zentaoPMS) . $lang->arrow;
        if ($moduleName != 'index') {
            if (!isset($lang->menu->$mainMenu))
                return;
            list($menuLabel, $module, $method) = explode('|', $lang->menu->$mainMenu);
            echo html::a(helper::createLink($module, $method), $menuLabel);
        }
        else {
            echo $lang->index->common;
        }
        if (empty($position))
            return;
        echo $lang->arrow;
        foreach ($position as $key => $link) {
            echo $link;
            if (isset($position[$key + 1]))
                echo $lang->arrow;
        }
    }

    /**
     * Print the link for notify file.
     * 
     * @static
     * @access public
     * @return void
     */
    public static function printNotifyLink() {
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) {
            global $app, $lang;
            $notifyFile = $app->getBasePath() . 'www/data/notify/notify.zip';

            if (!file_exists($notifyFile))
                return false;
            echo html::a(helper::createLink('misc', 'downNotify'), $lang->downNotify);
        }
    }

    /**
     * Print QR code Link. 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function printQRCodeLink($color = '') {
        global $lang;
        echo html::a(helper::createLink('misc', 'qrCode'), "<i class='icon-mobile-phone icon-large'></i>" . $lang->user->mobileLogin, '', "class='qrCode $color'");
    }

    /**
     * Diff two string. (see phpt)
     * 
     * @param string $text1 
     * @param string $text2 
     * @static
     * @access public
     * @return string
     */
    public static function diff($text1, $text2) {
        $text1 = str_replace('&nbsp;', '', trim($text1));
        $text2 = str_replace('&nbsp;', '', trim($text2));
        $w = explode("\n", $text1);
        $o = explode("\n", $text2);
        $w1 = array_diff_assoc($w, $o);
        $o1 = array_diff_assoc($o, $w);
        $w2 = array();
        $o2 = array();
        foreach ($w1 as $idx => $val)
            $w2[sprintf("%03d<", $idx)] = sprintf("%03d- ", $idx + 1) . "<del>" . trim($val) . "</del>";
        foreach ($o1 as $idx => $val)
            $o2[sprintf("%03d>", $idx)] = sprintf("%03d+ ", $idx + 1) . "<ins>" . trim($val) . "</ins>";
        $diff = array_merge($w2, $o2);
        ksort($diff);
        return implode("\n", $diff);
    }

    /**
     * Judge Suhosin Setting whether the actual size of post data is large than the setting size.
     * 
     * @param  int    $numberOfItems 
     * @param  int    $columns 
     * @access public
     * @return void
     */
    public function judgeSuhosinSetting($numberOfItems, $columns) {
        if (extension_loaded('suhosin')) {
            $maxPostVars = ini_get('suhosin.post.max_vars');
            $maxRequestVars = ini_get('suhosin.request.max_vars');
            if ($numberOfItems * $columns > $maxPostVars or $numberOfItems * $columns > $maxRequestVars)
                return true;
        }

        return false;
    }

    /**
     * Get the previous and next object.
     * 
     * @param  string $type story|task|bug|case
     * @param  string $objectIDs 
     * @param  string $objectID 
     * @access public
     * @return void
     */
    public function getPreAndNextObject($type, $objectID) {
        $preAndNextObject = new stdClass();

        if (strpos('story, task, bug, testcase, doc', $type) === false)
            return $preAndNextObject;
        $table = $this->config->objectTables[$type];

        /* Get objectIDs. */
        $queryCondition = $type . 'QueryCondition';
        $typeOnlyCondition = $type . 'OnlyCondition';
        $queryCondition = $this->session->$queryCondition;
        $orderBy = $type . 'OrderBy';
        $orderBy = $this->session->$orderBy;
        $orderBy = str_replace('`left`', 'left', $orderBy); // process the `left` to left.

        if (empty($queryCondition) or $this->session->$typeOnlyCondition) {
            $objects = $this->dao->select('*')->from($table)
                    ->where('id')->eq($objectID)
                    ->beginIF($queryCondition != false)->orWhere($queryCondition)->fi()
                    ->beginIF($orderBy != false)->orderBy($orderBy)->fi()
                    ->fetchAll();
        } else {
            $objects = $this->dbh->query($queryCondition . " ORDER BY $orderBy")->fetchAll();
        }

        $tmpObjectIDs = array();
        foreach ($objects as $key => $object)
            $tmpObjectIDs[$key] = (!$this->session->$typeOnlyCondition and $type == 'testcase' and isset($object->case)) ? $object->case : $object->id;
        $objectIDs = array_flip($tmpObjectIDs);

        /* Current object. */
        $currentKey = array_search($objectID, $tmpObjectIDs);

        $preKey = $currentKey - 1;
        $preAndNextObject->pre = '';
        if ($preKey >= 0) {
            $preID = $tmpObjectIDs[$preKey];
            $preAndNextObject->pre = $objects[$objectIDs[$preID]];
        }

        /* Get the next object. */
        $nextKey = $currentKey + 1;
        $preAndNextObject->next = '';
        if ($nextKey < count($tmpObjectIDs)) {
            $nextID = $tmpObjectIDs[$nextKey];
            $preAndNextObject->next = $objects[$objectIDs[$nextID]];
        }
        return $preAndNextObject;
    }

    /**
     * Save one executed query.
     * 
     * @param  string    $sql 
     * @param  string    $objectType story|task|bug|testcase 
     * @access public
     * @return void
     */
    public function saveQueryCondition($sql, $objectType, $onlyCondition = true) {
        /* Set the query condition session. */
        if ($onlyCondition) {
            $queryCondition = explode('WHERE', $sql);
            $queryCondition = explode('ORDER', $queryCondition[1]);
            $queryCondition = str_replace('t1.', '', $queryCondition[0]);
        } else {
            $queryCondition = explode('ORDER', $sql);
            $queryCondition = $queryCondition[0];
        }
        $queryCondition = trim($queryCondition);
        if (empty($queryCondition))
            $queryCondition = "1=1";

        $this->session->set($objectType . 'QueryCondition', $queryCondition);
        $this->session->set($objectType . 'OnlyCondition', $onlyCondition);

        /* Set the query condition session. */
        $orderBy = explode('ORDER BY', $sql);
        if (isset($orderBy[1])) {
            $orderBy = explode('limit', $orderBy[1]);
            $orderBy = str_replace('t1.', '', $orderBy[0]);

            $this->session->set($objectType . 'OrderBy', $orderBy);
        } else {
            $this->session->set($objectType . 'OrderBy', '');
        }
    }

}
