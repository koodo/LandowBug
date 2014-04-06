<?php

/**
 * The control file of common module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     common
 * @version     $Id: control.php 5036 2013-07-06 05:26:44Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
class common extends control {

    /**
     * The construc method, to do some auto things.
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->common->startSession();
        $this->common->sendHeader();
        $this->common->setCompany();
        $this->common->setUser();
        $this->common->loadConfigFromDB();
        $this->common->loadCustomFromDB();
        if ($this->app->getViewType() == 'mhtml')
            $this->common->setMobileMenu();
        $this->app->loadLang('company');
    }

    /**
     * Check the user has permission to access this method, if not, locate to the login page or deny page.
     * 
     * @access public
     * @return void
     */
    public function checkPriv() {
        $module = $this->app->getModuleName();
        $method = $this->app->getMethodName();
        if ($this->common->isOpenMethod($module, $method))
            return true;
        if (!$this->loadModel('user')->isLogon() and $this->server->php_auth_user)
            $this->user->identifyByPhpAuth();
        if (!$this->loadModel('user')->isLogon() and $this->cookie->za and $this->cookie->keepLogin == 'on' and $this->cookie->zp)
            $this->user->identifyByCookie();
        
        if (isset($this->app->user)) {
            #if (!common::hasPriv($module, $method))
            #$this->common->deny($module, $method);
        } else {
            $referer = helper::safe64Encode($this->app->getURI(true));
            $this->locate($this->createLink('user', 'login', "referer=$referer"));
        }
    }

    /**
     * Check upgrade's status file is ok or not.
     * 
     * @access public
     * @return void
     */
    public function checkUpgradeStatus() {
        $statusFile = $this->app->getAppRoot() . 'www' . $this->pathFix . 'ok';
        if (!file_exists($statusFile) or time() - filemtime($statusFile) > 3600) {
            $this->app->loadLang('upgrade');
            echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
            echo "<table align='center' style='margin-top:100px; border:1px solid gray; font-size:14px;'><tr><td>";
            printf($this->lang->upgrade->setStatusFile, $statusFile, $statusFile, $statusFile);
            die('</td></tr></table></body></html>');
        }
    }

    /**
     * Check the user has permisson of one method of one module.
     * 
     * @param  string $module 
     * @param  string $method 
     * @static
     * @access public
     * @return bool
     */
    public static function hasPriv($module, $method) {
        global $app;

        /* Check is the super admin or not. */
        $account = ',' . $app->user->account . ',';
        if (strpos($app->company->admins, $account) !== false)
            return true;

        /* If not super admin, check the rights. */
        $rights = $app->user->rights;
        if (isset($rights[strtolower($module)][strtolower($method)]))
            return true;
        return false;
    }

    /**
     * 检查bug审核按钮显示权限
     * 
     * @global type $app
     * @param type $module
     * @param type $method
     * @param type $assignTo
     * @return boolean
     */
    public static function bugCheckBtnPriv($module, $method, $assignTo) {
        global $app;

        /* Check is the super admin or not. */
        $account = ',' . $app->user->account . ',';
        if (strpos($app->company->admins, $account) !== false)
            return true;

        /* If not super admin, check the rights. */
        if (common::hasPriv($module, $method)) {
            if ($app->user->account == $assignTo) {
                return true;
            }
        }

        return false;
    }

    /**
     * Replace the %s of one key of a menu by $params.
     *
     * All the menus are defined in the common's language file. But there're many dynamic params, so in the defination,
     * we used %s as placeholder. These %s should be setted in one module.
     *
     * The items of one module's menu may be an string or array. For example, please see module/common/lang.
     * 
     * @param  string $object     the menus of one module
     * @param  string $key        the menu item to be replaced
     * @param  string $params     the params passed to the menu item
     * @access public
     * @return void
     */
    public static function setMenuVars($menu, $key, $params) {
        if (is_array($params)) {
            if (is_array($menu->$key)) {
                $menu->$key = (object) $menu->$key;
                $menu->$key->link = vsprintf($menu->$key->link, $params);
                $menu->$key = (array) $menu->$key;
            } else {
                $menu->$key = vsprintf($menu->$key, $params);
            }
        } else {
            if (is_array($menu->$key)) {
                $menu->$key = (object) $menu->$key;
                $menu->$key->link = sprintf($menu->$key->link, $params);
                $menu->$key = (array) $menu->$key;
            } else {
                $menu->$key = sprintf($menu->$key, $params);
            }
        }
    }

    /**
     * Print the link contains orderBy field.
     *
     * This method will auto set the orderby param according the params. Fox example, if the order by is desc, 
     * will be changed to asc.
     * 
     * @param  string $fieldName    the field name to sort by
     * @param  string $orderBy      the order by string
     * @param  string $vars         the vars to be passed
     * @param  string $label        the label of the link
     * @param  string $module       the module name
     * @param  string $method       the method name
     * @static
     * @access public
     * @return void
     */
    public static function printOrderLink($fieldName, $orderBy, $vars, $label, $module = '', $method = '') {
        global $lang, $app;
        if (empty($module))
            $module = $app->getModuleName();
        if (empty($method))
            $method = $app->getMethodName();
        $className = 'header';

        $order = explode('_', $orderBy);
        $order[0] = trim($order[0], '`');

        if ($order[0] == $fieldName) {
            if (isset($order[1]) and $order[1] == 'asc') {
                $orderBy = "{$order[0]}_desc";
                $className = 'headerSortDown';
            } else {
                $orderBy = "{$order[0]}_asc";
                $className = 'headerSortUp';
            }
        } else {
            $orderBy = "" . trim($fieldName, '`') . "" . '_' . 'asc';
            $className = 'header';
        }

        $link = helper::createLink($module, $method, sprintf($vars, $orderBy)) . common::getSearchParam();
        echo "<div class='$className'>" . html::a($link, $label) . '</div>';
    }

    /**
     * Print link to an modules' methd.
     *
     * Before printing, check the privilege first. If no privilege, return fasle. Else, print the link, return true.
     * 
     * @param  string $module   the module name
     * @param  string $method   the method
     * @param  string $vars     vars to be passed
     * @param  string $label    the label of the link
     * @param  string $target   the target of the link
     * @param  string $misc     others
     * @param  bool   $newline 
     * @static
     * @access public
     * @return bool
     */
    public static function printLink($module, $method, $vars = '', $label, $target = '', $misc = '', $newline = true, $onlyBody = false) {
        if (!common::hasPriv($module, $method))
            return false;
        echo html::a(helper::createLink($module, $method, $vars, '', $onlyBody), $label, $target, $misc, $newline);
        return true;
    }

    public static function printTopBtns($productID, $moduleName, $methodName, $browseType) {
        global $app;
        $links = array(
            array($moduleName == 'bug' && $methodName == 'report' && $browseType == 'all', helper::createLink('bug', 'report', "projectID=$productID&browseType=all&moduleID=0"), 'Bug统计'),
            array($moduleName == 'bug' && $methodName == 'browse' && $browseType == 'showall', helper::createLink('bug', 'browse', "projectID=$productID&browseType=showall"), '所有Bug'),
            array($moduleName == 'bug' && $methodName == 'browse' && $browseType == 'openedbyme', helper::createLink('bug', 'browse', "projectID=$productID&browseType=openedByMe&param=0"), '我创建的bug'),
            array($moduleName == 'bug' && $methodName == 'browse' && $browseType == 'assigntome', helper::createLink('bug', 'browse', "projectID=$productID&browseType=assignToMe&param=0"), '分配给我的bug'),
            array($moduleName == 'bug' && $methodName == 'browse' && $browseType == 'all', helper::createLink('bug', 'browse', "projectID=$productID&browseType=all"), '项目概况')
        );
        foreach ($links as $index => &$_data) {
            $index += 1;
            if ($_data[0]) {
                echo html::a($_data[1], $_data[2], '_self', "class=\"ld-nav-btn ld-icon-$index ld-nav-btn-active\"");
            } else
                echo html::a($_data[1], $_data[2], '_self', "class=\"ld-nav-btn ld-icon-$index\"");
        }
    }

    /**
     * 
     * Addon fucntion printLink
     * 
     * @param type $module
     * @param type $method
     * @param type $vars
     * @param type $label
     * @param type $target
     * @param type $misc
     * @param type $newline
     * @param type $onlyBody
     * @return boolean
     */
    public static function returnLink($module, $method, $vars = '', $label, $target = '', $misc = '', $newline = true, $onlyBody = false) {
        if (!common::hasPriv($module, $method))
            return false;
        $link = html::a(helper::createLink($module, $method, $vars, '', $onlyBody), $label, $target, $misc, $newline);
        return $link === "" ? false : $link;
    }

    /**
     * Print icon of split line.
     * 
     * @static
     * @access public
     * @return void
     */
    public static function printDivider() {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    /**
     * Print icon of comment.
     * 
     * @param  string $module 
     * @static
     * @access public
     * @return void
     */
    public static function printCommentIcon($module) {
        if (isonlybody())
            return false;

        global $lang;

        if (!common::hasPriv($module, 'edit'))
            return false;
        echo "<span class='link-button'>";
        echo html::a('#commentBox', '<i class="icon-comment-alt"></i>', '', "title='$lang->comment' onclick='setComment()'");
        echo "</span>";
    }

    /**
     * Print link icon.
     * 
     * @param  string $module 
     * @param  string $method 
     * @param  string $vars 
     * @param  object $object 
     * @param  string $type button|list 
     * @param  string $icon 
     * @param  string $target 
     * @static
     * @access public
     * @return void
     */
    public static function printIcon($module, $method, $vars = '', $object = '', $type = 'button', $icon = '', $target = '', $extraClass = '', $onlyBody = false) {
        if (isonlybody() and strpos($extraClass, 'showinonlybody') === false)
            return false;

        global $app, $lang;

        /* Judge the $method of $module clickable or not, default is clickable. */
        $clickable = true;
        if (is_object($object)) {
            if ($app->getModuleName() != $module)
                $app->control->loadModel($module);
            $modelClass = class_exists("ext{$module}Model") ? "ext{$module}Model" : $module . "Model";
            if (class_exists($modelClass) and is_callable(array($modelClass, 'isClickable'))) {
                // 检查按钮是否可以点击
                $clickable = call_user_func_array(array($modelClass, 'isClickable'), array('object' => $object, 'method' => $method));
            }
        }

        /* Set module and method, then create link to it. */
        if (strtolower($module) == 'testcase' and strtolower($method) == 'createbug')
            ($module = 'bug') and ($method = 'create');
        if (strtolower($module) == 'story' and strtolower($method) == 'createcase')
            ($module = 'testcase') and ($method = 'create');
        if (strtolower($module) == 'bug' and strtolower($method) == 'tostory')
            ($module = 'story') and ($method = 'create');
        if (strtolower($module) == 'bug' and strtolower($method) == 'createcase')
            ($module = 'testcase') and ($method = 'create');
        #echo $method;var_dump(common::hasPriv($module, $method));
        #if (!common::hasPriv($module, $method))
        #return false;

        $link = helper::createLink($module, $method, $vars, '', $onlyBody);

        /* Set the icon title, try search the $method defination in $module's lang or $common's lang. */
        $title = $method;
        if (isset($lang->$method) and is_string($lang->$method))
            $title = $lang->$method;
        if ((isset($lang->$module->$method) or $app->loadLang($module)) and isset($lang->$module->$method)) {
            $title = $method == 'report' ? $lang->$module->$method->common : $lang->$module->$method;
        }
        if ($icon == 'toStory')
            $title = $lang->bug->toStory;
        if ($icon == 'createBug')
            $title = $lang->testtask->createBug;
        if ($icon == 'copy' && $module == 'bug') {
            $title = '复制创建新BUG';
        }

        /* set the class. */
        if (!$icon)
            $icon = $method;
        if (strpos(',edit,copy,report,export,delete,', ",$icon,") !== false)
            $module = 'common';
        $color = $type == 'button' ? 'green' : ($clickable ? 'green' : 'gray');
        $extraClass = strpos(',export,customFields,', ",$method,") !== false ? $method : $extraClass;
        $class = $extraClass ? "icon-$color-$module-$icon $extraClass" : "icon-$color-$module-$icon";

        /* Create the icon link. */
        if ($clickable) {
            if ($app->getViewType() == 'mhtml') {
                echo html::a($link, $title, $target, "class='$extraClass' data-role='button' data-mini='true' data-inline='true' data-theme='b'", true);
                return;
            }
            if ($type == 'button') {
                if (($module == 'bug' && $method == 'create') || ($module == 'doc' && $method == 'create') || ($module == 'build' && $method == 'create')) {
                    echo "<span class='link-button rightBtn-create'>";
                    echo html::a($link, "<i class='$class'></i> " . $title, $target, "class='$extraClass'", true);
                } else {
                    echo "<span class='link-button'>";
                    if ($method != 'edit' and $method != 'copy' and $method != 'delete') {
                        echo html::a($link, $title, $target, "class='$extraClass' title='$title'", true);
                    } else {
                        $class = "icon-$color-$module-$icon";
                        echo html::a($link, $title, $target, "class='link-icon $extraClass' title='$title'", false);
                    }
                    echo "</span>";
                }
            } else {
                $class = "icon-$color-$module-$icon";
                echo html::a($link, "<i class='$class'></i>", $target, "class='link-icon $extraClass' title='$title'", false);
            }
        } else {
            if ($type == 'list') {
                $class = "icon-$color-$module-$icon";
                echo "<i class='disabled $class' title='$title'></i>";
            }
        }
    }

    /**
     * Print backLink and preLink and nextLink.
     * 
     * @param  string $backLink 
     * @param  object $preAndNext 
     * @access public
     * @return void
     */
    static public function printRPN($backLink, $preAndNext = '') {
        global $lang, $app;
        if (isonlybody())
            return false;

        echo "<span class='link-button'>";
        echo html::a($backLink, '<i class="icon-goback icon-level-up icon-large icon-rotate-270"></i>', '', "class='link-icon' title={$lang->goback}");
        echo "</span>";

        if (isset($preAndNext->pre) and $preAndNext->pre) {
            $id = (isset($_SESSION['testcaseOnlyCondition']) and !$_SESSION['testcaseOnlyCondition'] and $app->getModuleName() == 'testcase' and isset($preAndNext->pre->case)) ? 'case' : 'id';
            $title = isset($preAndNext->pre->title) ? $preAndNext->pre->title : $preAndNext->pre->name;
            $title = '#' . $preAndNext->pre->$id . ' ' . $title;
            echo "<span class='link-button'>";
            echo html::a(inLink('view', "ID={$preAndNext->pre->$id}"), '<i class="icon-pre icon-chevron-sign-left"></i>', '', "id='pre' class='link-icon' title='{$title}'");
            echo "</span>";
        }
        if (isset($preAndNext->next) and $preAndNext->next) {
            $id = (isset($_SESSION['testcaseOnlyCondition']) and !$_SESSION['testcaseOnlyCondition'] and $app->getModuleName() == 'testcase' and isset($preAndNext->next->case)) ? 'case' : 'id';
            $title = isset($preAndNext->next->title) ? $preAndNext->next->title : $preAndNext->next->name;
            $title = '#' . $preAndNext->next->$id . ' ' . $title;
            echo "<span class='link-button'>";
            echo html::a(inLink('view', "ID={$preAndNext->next->$id}"), '<i class="icon-pre icon-chevron-sign-right"></i>', '', "id='next' class='link-icon' title='$title'");
            echo "</span>";
        }
    }

    /**
     * Create changes of one object.
     * 
     * @param mixed $old    the old object
     * @param mixed $new    the new object
     * @static
     * @access public
     * @return array
     */
    public static function createChanges($old, $new) {
        global $config;
        $changes = array();
        $magicQuote = get_magic_quotes_gpc();
        foreach ($new as $key => $value) {
            if (strtolower($key) == 'lastediteddate')
                continue;
            if (strtolower($key) == 'lasteditedby')
                continue;
            if (strtolower($key) == 'assigneddate')
                continue;
            if (strtolower($key) == 'editedby')
                continue;
            if (strtolower($key) == 'editeddate')
                continue;

            if ($magicQuote)
                $value = stripslashes($value);
            if ($value != stripslashes($old->$key)) {
                $diff = '';
                if (substr_count($value, "\n") > 1 or
                        substr_count($old->$key, "\n") > 1 or
                        strpos('name,title,desc,spec,steps,content,digest,verify,report', strtolower($key)) !== false) {
                    $diff = commonModel::diff($old->$key, $value);
                }
                $changes[] = array('field' => $key, 'old' => $old->$key, 'new' => $value, 'diff' => $diff);
            }
        }
        return $changes;
    }

    /**
     * Get the full url of the system.
     * 
     * @access public
     * @return string
     */
    public static function getSysURL() {
        $httpType = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on') ? 'https' : 'http';
        $httpHost = $_SERVER['HTTP_HOST'];
        return "$httpType://$httpHost";
    }

    /**
     * Print the run info.
     * 
     * @param mixed $startTime  the start time.
     * @access public
     * @return void
     */
    public function printRunInfo($startTime) {
        vprintf($this->lang->runInfo, $this->common->getRunInfo($startTime));
    }

    /**
     * 
     * @param type $si
     * @access static
     * @return string
     */
    public static function bug_serverity($si) {
        $arr = array('低', '中', '高', '紧急', '严重');
        if (!$si): return $arr[0];
        endif;
        return $arr[$si - 1];
    }

    /**
     * 
     * @param type $modulePath
     */
    public static function printModulePath($modulePath) {
        if (empty($modulePath)) {
            echo "默认模块";
        } else {
            foreach ($modulePath as $key => $module) {
                if (!common::printLink('bug', 'browse', "productID=$bug->product&browseType=byModule&param=$module->id", $module->name))
                    echo $module->name;
                if (isset($modulePath[$key + 1]))
                    echo $lang->arrow;
            }
        }
    }

    /**
     * print Bug title && ID #
     * 
     * @param type $title
     * @param type $id
     */
    public static function bugTitleAtID($title, $id = null) {
        return $id . '# ' . $title;
    }

    /**
     * Format time
     * 
     * @param type $timestamp
     * @return string
     */
    public static function tTimeFormat($timestamp) {
        $curTime = time();
        $space = $curTime - $timestamp;
        //1分钟
        if ($space < 60) {
            $string = "刚刚";
            return $string;
        } elseif ($space < 3600) { //一小时前
            $string = floor($space / 60) . "分钟前";
            return $string;
        }
        $curtimeArray = getdate($curTime);
        $timeArray = getDate($timestamp);
        if ($curtimeArray['year'] == $timeArray['year']) {
            if ($curtimeArray['yday'] == $timeArray['yday']) {
                $format = "%H:%M";
                $string = strftime($format, $timestamp);
                return "今天 {$string}";
            } elseif (($curtimeArray['yday'] - 1) == $timeArray['yday']) {
                $format = "%H:%M";
                $string = strftime($format, $timestamp);
                return "昨天 {$string}";
            } else {
                $string = sprintf("%d月%d日 %02d:%02d", $timeArray['mon'], $timeArray['mday'], $timeArray['hours'], $timeArray['minutes']);
                return $string;
            }
        }
        $string = sprintf("%d年%d月%d日 %02d:%02d", $timeArray['year'], $timeArray['mon'], $timeArray['mday'], $timeArray['hours'], $timeArray['minutes']);
        return $string;
    }

    public static function browseSearchTypeconv($browseType) {
        $tmp = array(
            'closed' => 'closed',
            'unresolved' => 'active',
            'notconfirmed' => 'needcheck',
            'resolved' => 'resolved'
        );
        return $tmp[$browseType];
    }

    public static function convSelectDefault($array) {
        return array('#' => '全部') + $array;
    }

    public static function isAdmin($user = '') {
        global $app;
        if ($user == '')
            $user = $app->user->account;
        $account = ',' . $user . ',';
        $isAdmin = strpos($app->company->admins, $account) !== false;
        return $isAdmin;
    }

    public static function getSearchParam() {
        $_url = parse_url($_SERVER['REQUEST_URI']);
        $search_param = isset($_GET['search_on']) ? '?' . $_url['query'] : null;
        return $search_param;
    }

    public static function getFirstProject($account = '') {
        global $app;
        if ($account == '') {
            $account = $app->user->account;
        }
        $res = $app->dbh->query("SELECT project FROM zt_team WHERE account = '$account' ORDER BY project asc limit 1");
        foreach ($res as $r) {
            return $r->project;
        }
        return false;
    }

    public static function dynProjectID($projectID) {
        global $app;
        if ($projectID == 0 || !$projectID) {
            $projectID = $app->cookie->lastProject;
            $projectID = $app->control->loadModel('project')->getValidProjectId($projectID);
        }
        return $projectID;
    }

}
