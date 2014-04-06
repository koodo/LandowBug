<?php

class team extends control {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $teamid
     */
    public function view($teamid) {
        $team = $this->team->getByID($teamid);
        if (!empty($_POST)) {
            $this->team->handleEmails($this->post->emails, $team);
        }
        $this->loadModel('project');
        $team = $this->team->getByID($teamid);
        $this->view->TeamMembers = $this->team->getTeamMembers($teamid);
        $this->view->users = $this->loadModel('user')->getPairs('nodeleted|noletter');
        $this->view->team = $team;
        $this->view->members = '';
        $this->view->title = $team->tname;
        $this->display();
    }

    /**
     * 
     * @param type $account
     */
    public function listeam($account = '') {
        global $app;
        $isAdmin = strpos($app->company->admins, $account) !== false;
        
        if($isAdmin){
            $teams = $this->team->getTeamList();
        } else if ($account == '') {
            $teams = $this->team->getTeamList();
        } else {
            $teams = $this->team->getUserTeamList($account);
        }
        
        $this->view->title = "团队列表";
        $this->view->teams = $teams;
        $this->display();
    }

    /**
     * 
     * @global type $app
     * @param type $teamid
     */
    public function ajaxQuitTeam() {
        global $app;
        if ($this->team->unlinkMember($this->post->teamid, $app->user->account))
            echo 1;
        else
            echo 0;
    }

    /**
     * return string
     */
    public function ajaxDelete() {
        try {
            $this->dbh->query(sprintf("DELETE FROM " . TABLE_TEAMLIST . " WHERE `tid` = '%s';", $this->post->tid));
            echo 1;
        } catch (Exception $e) {
            echo 0;
        }
    }

    /**
     * 
     */
    public function create() {
        global $app;
        if (!empty($_POST)) {
            $teamid = $this->team->create();
            $team = $this->team->getByID($teamid);
            if (dao::isError()) {
                $response['result'] = 'fail';
                $response['message'] = dao::getError();
                $this->send($response);
            } else {
                $this->team->handleEmails($this->post->emails, $team);
                $admin_name = $app->user->account;
                $this->dbh->query("REPLACE INTO `zt_team_cm`(`id`,`account`,`join`,`isadmin`) VALUES('$team->tid','$admin_name',CURRENT_DATE(),'1')");
                $this->dbh->query(sprintf("UPDATE `zt_team_cm` SET isadmin = 1 WHERE account = '%s' AND id = '%s';", $app->user->account, $teamid));
            }

            $location = $this->createLink('team', 'view', 'teamid=' . $teamid);
            echo '<meta http-equiv="refresh" content="0; url=' . $location . '" />';
        }
        $this->view->title = "创建团队";
        $this->display();
    }

    public function ajaxGetMembers() {
        if (!empty($_POST)) {
            $list = $this->dao->select('t1.*,t2.realname')
                    ->from(TABLE_TEAMCM)->alias('t1')
                    ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
                    ->where('t1.id')->eq($this->post->teamid)
                    ->orderBy('t2.account ASC')
                    ->fetchAll();
            print_r(json_encode((array) ($list)));
        }
    }

    /**
     * 
     */
    public function ajaxDeleteMember() {
        if (!empty($_POST)) {
            if ($this->team->unlinkMember($this->post->teamid, $this->post->account))
                echo 1;
            else
                echo 0;
        }
    }

    public function ajaxGetProjectMembersPairs() {
        if (!empty($_POST)) {
            $list = $this->dao->select('t1.account,t2.realname')
                    ->from(TABLE_TEAM)->alias('t1')
                    ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
                    ->where('t1.project')->eq($this->post->projectid)
                    ->orderBy('t1.account ASC')
                    ->fetchAll();
            print_r(json_encode((array) $list));
        }
    }

    public function ajaxCreateTeam() {
        global $app;

        $teamid = $this->team->create();
        $team = $this->team->getByID($teamid);
        if ($teamid == -1) {
            $response['result'] = 'fail';
            $response['message'] = 'namef';
        } else if (dao::isError()) {
            $response['result'] = 'fail';
            $response['message'] = dao::getError();
        } else {
            $this->team->handleEmails($this->post->emails, $team);
            $admin_name = $app->user->account;
            $this->dbh->query("REPLACE INTO `zt_team_cm`(`id`,`account`,`join`,`isadmin`) VALUES('$team->tid','$admin_name',CURRENT_DATE(),'1')");
            $this->dbh->query(sprintf("UPDATE `zt_team_cm` SET isadmin = 1 WHERE account = '%s' AND id = '%s';", $app->user->account, $teamid));
            $response['result'] = 'success';
            $response['teamid'] = $teamid;
        }
        print_r(json_encode($response));
    }

}
