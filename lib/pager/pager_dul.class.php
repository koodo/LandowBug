<?php

/**
 * The pager class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * Pager class.
 * 
 * @package framework
 */
class pager_dul {

    /**
     * The default counts of per page.
     *
     * @public int
     */
    const DEFAULT_REC_PRE_PAGE = 20;

    /**
     * The total counts.
     * 
     * @var int
     * @access public
     */
    public $recTotal;

    /**
     * Record count per page.
     * 
     * @var int
     * @access public
     */
    public $recPerPage;

    /**
     * The cookie name of recPerPage.
     * 
     * @var string
     * @access public
     */
    public $pageCookie;

    /**
     * Page count.
     * 
     * @var string
     * @access public
     */
    public $pageTotal;

    /**
     * Current page id.
     * 
     * @var string
     * @access public
     */
    public $pageID;

    /**
     * The global $app.
     * 
     * @var object
     * @access private
     */
    private $app;

    /**
     * The global $lang.
     * 
     * @var object
     * @access private
     */
    private $lang;

    /**
     * Current module name.
     * 
     * @var string
     * @access private
     */
    private $moduleName;

    /**
     * Current method.
     * 
     * @var string
     * @access private
     */
    private $methodName;

    /**
     * The params.
     *
     * @private array
     */
    private $params;

    /**
     * The params.
     *
     * @private array
     */
    private $search_params;

    /**
     * The construct function.
     * 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function __construct($recTotal = 0, $recPerPage = 20, $pageID = 1) {
        $this->setApp();
        $this->setLang();
        $this->setModuleName();
        $this->setMethodName();
        $this->search_params = $this->getSearchParam();
        $this->setRecTotal($recTotal);
        $this->setRecPerPage($recPerPage);
        $this->setPageTotal();
        $this->setPageID($pageID);
    }

    /**
     * The factory function.
     * 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return object
     */
    public static function init($recTotal = 0, $recPerPage = 20, $pageID = 1) {
        return new pager_dul($recTotal, $recPerPage, $pageID);
    }

    /**
     * Set the recTotal property.
     * 
     * @param  int    $recTotal 
     * @access public
     * @return void
     */
    public function setRecTotal($recTotal = 0) {
        $this->recTotal = (int) $recTotal;
    }

    /**
     * Set the recTotal property.
     * 
     * @param  int    $recPerPage 
     * @access public
     * @return void
     */
    public function setRecPerPage($recPerPage) {
        $this->recPerPage = ($recPerPage > 0) ? $recPerPage : PAGER::DEFAULT_REC_PRE_PAGE;
    }

    /**
     * Set the pageTotal property.
     * 
     * @access public
     * @return void
     */
    public function setPageTotal() {
        #echo $this->recTotal;
        $this->pageTotal = ceil($this->recTotal / $this->recPerPage);
    }

    /**
     * Set the page id.
     * 
     * @param  int $pageID 
     * @access public
     * @return void
     */
    public function setPageID($pageID) {
        if ($pageID > 0 and $pageID <= $this->pageTotal) {
            $this->pageID = $pageID;
        } else {
            $this->pageID = 1;
        }
    }

    /**
     * Set the $app property;
     * 
     * @access private
     * @return void
     */
    private function setApp() {
        global $app;
        $this->app = $app;
    }

    /**
     * Set the $lang property.
     * 
     * @access private
     * @return void
     */
    private function setLang() {
        global $lang;
        $this->lang = $lang;
    }

    /**
     * Set the $moduleName property.
     * 
     * @access private
     * @return void
     */
    private function setModuleName() {
        $this->moduleName = $this->app->getModuleName();
    }

    /**
     * Set the $methodName property.
     * 
     * @access private
     * @return void
     */
    private function setMethodName() {
        $this->methodName = $this->app->getMethodName();
    }

    /**
     * Get recTotal, recPerpage, pageID from the request params, and add them to params.
     * 
     * @access private
     * @return void
     */
    private function setParams() {
        $this->params = $this->app->getParams();
        foreach ($this->params as $key => $value) {
            if (strtolower($key) == 'rectotal')
                $this->params[$key] = $this->recTotal;
            if (strtolower($key) == 'recperpage')
                $this->params[$key] = $this->recPerPage;
            if (strtolower($key) == 'pageID')
                $this->params[$key] = $this->pageID;
        }
    }

    /**
     * Create the limit string.
     * 
     * @access public
     * @return string
     */
    public function limit() {
        $limit = '';
        if ($this->pageTotal > 1)
            $limit = ' limit ' . ($this->pageID - 1) * $this->recPerPage . ", $this->recPerPage";
        return $limit;
    }

    /**
     * Print the pager's html.
     * 
     * @param  string $align 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function show($align = 'right', $type = 'full') {
        echo $this->get($align, $type);
    }

    /**
     * Get the pager html string.
     * 
     * @param  string $align 
     * @param  string $type     the pager type, full|short|shortest
     * @access public
     * @return string
     */
    public function get($align = 'right', $type = 'full') {
        /* If the RecTotal is zero, return with no record. */
        if ($this->recTotal == 0) {
            return $type == 'mobile' ? '' : "<div style='float:$align; clear:none;' class='pager'>{$this->lang->pager->noRecord}</div>";
        }

        /* Set the params. */
        $this->setParams();

        /* Create the prePage and nextpage, all types have them. */
        $pager = $this->createPrePage($type);
        $pager .= $this->createNextPage($type);

        /* The short and full type. */
        if ($type !== 'shortest' and $type !== 'mobile') {
            $pager = $this->createFirstPage() . $pager;
            $pager .= $this->createLastPage();
        }

        if ($type == 'mobile') {
            $position = $this->pageTotal == 1 ? '' : $this->pageID . '/' . $this->pageTotal;
            $pager = $pager . ' ' . $position;
        } else if ($type != 'full') {
            $pager = $this->pageID . '/' . $this->pageTotal . ' ' . $pager;
        }

        /* Only the full type . */
        if ($type == 'full') {
            $pager = $this->createDigest() . $pager;
            $pager .= $this->createGoTo();
            $pager .= $this->createRecPerPageJS();
        }

        return "<div style='float:$align; clear:none;' class='pager'>$pager</div>";
    }

    /**
     * Create the digest code.
     * 
     * @access private
     * @return string
     */
    private function createDigest() {
        #return sprintf($this->lang->pager->digest, $this->recTotal, $this->createRecPerPageList(), $this->pageID, $this->pageTotal);
        return sprintf($this->lang->pager->digest, $this->createRecPerPageList(), $this->recTotal < $this->recPerPage ? 1 : $_GET['search_reset'] ? 1 : $this->pageID, $this->pageTotal);
    }

    /**
     * Create the first page.
     * 
     * @access private
     * @return string
     */
    private function createFirstPage() {
        $_url = parse_url($_SERVER['REQUEST_URI']);
        if ($this->pageID == 1)
            return $this->lang->pager->first . ' ';
        $pageID = 1;
        $sp = $this->search_params != "" ? $this->search_params . "&" : "?";
        return html::a($_url['path'] . $sp . "SrecTotal=$this->recTotal&SrecPerPage=$this->recPerPage&SpageID=$pageID", $this->lang->pager->first);
    }

    /**
     * Create the pre page html.
     * 
     * @access private
     * @return string
     */
    private function createPrePage($type = 'full') {
        if ($type == 'mobile') {
            if ($this->pageID == 1)
                return '';
            $this->params['pageID'] = $this->pageID - 1;
            return html::a(helper::createLink($this->moduleName, $this->methodName, $this->params), $this->lang->pager->pre, '', 'data-role="button" data-icon="arrow-l" data-iconpos="left" data-inline="true"');
        }
        else {
            $_url = parse_url($_SERVER['REQUEST_URI']);
            if ($this->pageID == 1)
                return $this->lang->pager->pre . ' ';
            $pageID = $this->pageID - 1;
            $sp = $this->search_params != "" ? $this->search_params . "&" : "?";
            return html::a($_url['path'] . $sp . "SrecTotal=$this->recTotal&SrecPerPage=$this->recPerPage&SpageID=$pageID", $this->lang->pager->pre);
        }
    }

    /**
     * Create the next page html.
     * 
     * @access private
     * @return string
     */
    private function createNextPage($type = 'full') {
        if ($type == 'mobile') {
            if ($this->pageID == $this->pageTotal)
                return '';
            $this->params['pageID'] = $this->pageID + 1;
            return html::a(helper::createLink($this->moduleName, $this->methodName, $this->params), $this->lang->pager->next, '', 'data-role="button" data-icon="arrow-r" data-iconpos="right" data-inline="true"');
        }
        else {
            $_url = parse_url($_SERVER['REQUEST_URI']);
            if ($this->pageID == $this->pageTotal)
                return $this->lang->pager->next . ' ';
            $pageID = $this->pageID + 1;
            $sp = $this->search_params != "" ? $this->search_params . "&" : "?";
            return html::a($_url['path'] . $sp . "SrecTotal=$this->recTotal&SrecPerPage=$this->recPerPage&SpageID=$pageID", $this->lang->pager->next);
        }
    }

    private function getGet($str) {
        return $str . '=' . $_GET[$str];
    }

    public function getSearchParam() {
        $_url = parse_url($_SERVER['REQUEST_URI']);
        $search_param = null;
        $querys = split('&', $_url['query']);
        foreach ($querys as $query) {
            if (!preg_match('/search_reset/i', $query) && preg_match('/search/i', $query)) {
                $search_param[] = $query;
            }
        }
        return is_array($search_param) ? '?' . implode('&', $search_param) : null;
    }

    /**
     * Create the last page 
     * 
     * @access private
     * @return string
     */
    private function createLastPage() {
        $_url = parse_url($_SERVER['REQUEST_URI']);
        if ($this->pageID == $this->pageTotal)
            return $this->lang->pager->last . ' ';
        $this->params['pageID'] = $this->pageTotal;
        $sp = $this->search_params != "" ? $this->search_params . "&" : "?";
        return html::a($_url['path'] . $sp . "SrecTotal=$this->recTotal&SrecPerPage=$this->recPerPage&SpageID=$this->pageTotal", $this->lang->pager->last);
    }

    /**
     * Create the select object of record perpage.
     * 
     * @access private
     * @return string
     */
    private function createRecPerPageJS() {
        $vars1 = 'SrecTotal=_recTotal_&SrecPerPage=_recPerPage_&SpageID=_pageID_';
        $vars1 = $this->search_params != '' ? '&' . $vars1 : '?' . $vars1;
        $js = <<<EOT
        <script language='Javascript'>
        vars1 = '$vars1';
        //pageCookie = '$this->pageCookie';
        function submitPageP2(mode)
        {
            pageTotal  = parseInt($('#pageTotal').val());
            pageID     = $('#pageID').val();
            recPerPage = $('#recPerPage').last().val();
            recTotal   = $('#recTotal').val();
            //$.cookie(pageCookie, recPerPage, {expires:config.cookieLife, path:config.webRoot});
            if(mode == 'changePageID')
            {
                if(pageID > pageTotal) pageID = pageTotal;
                if(pageID < 1) pageID = 1;
            }
            else if(mode == 'changeRecPerPage')
            {
                pageID = 1;
            }
            vars1 = vars1.replace('_recTotal_', recTotal)
            vars1 = vars1.replace('_recPerPage_', recPerPage)
            vars1 = vars1.replace('_pageID_', pageID);
            location.href= window.location.pathname + '$this->search_params' + vars1;
        }
        </script>
EOT;
        return $js;
    }

    /**
      /* Create the select list of RecPerPage.
     * 
     * @access private
     * @return string
     */
    private function createRecPerPageList() {
        // pager 段页分配
        // todo 根据总数区间分配
        for ($i = 10; $i <= 50; $i += 5)
            $range[$i] = $i;
        $range[100] = 100;
        $range[200] = 200;
        $range[500] = 500;
        #$range[1000] = 1000;
        return html::select('recPerPage', $range, $this->recPerPage, "onchange='submitPageP2(\"changeRecPerPage\");' class='recPerPage'");
    }

    /**
     * Create the goto part html.
     * 
     * @access private
     * @return string
     */
    private function createGoTo() {
        $goToHtml = "<input type='hidden' id='recTotal'  value='$this->recTotal' />\n";
        $goToHtml .= "<input type='hidden' id='pageTotal' value='$this->pageTotal' />\n";
        $goToHtml .= "<input type='text'   id='pageID'    value='$this->pageID' style='text-align:center;width:30px;' /> \n";
        $goToHtml .= "<input type='button' id='goto'       value='{$this->lang->pager->locate}' onclick='submitPageP2(\"changePageID\");' />";
        return $goToHtml;
    }

}
