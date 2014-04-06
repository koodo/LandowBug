<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class teamModel extends model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserTeamList($account, $noadmin = false) {
        global $app;
        if (strpos($app->company->admins, $account) && !$noadmin)
            return $this->getTeamList();
        $list = $this->dao->select('*')
                ->from(TABLE_TEAMLIST)->alias('t2')
                ->leftJoin(TABLE_TEAMCM)->alias('t1')->on('t1.id = t2.tid')
                ->where('t1.account')->eq($account)
                ->andwhere('t2.tname')->ne('')
                ->andwhere('t2.deleted')->eq(0)
                ->orderBy('date desc')
                ->fetchAll();
        return $list;
    }

    public function getTeamList() {
        $list = $this->dao->select('*')
                ->from(TABLE_TEAMLIST)
                ->Where('deleted')->eq(0)
                ->orderBy('date desc')
                ->fetchAll();
        return $list;
    }

    public function getTeamMembers($teamid) {
        return $this->dao->select('t1.*, t2.realname, t2.id as uid, t2.email')->from(TABLE_TEAMCM)->alias('t1')
                        ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
                        ->where('t1.id')->eq((int) $teamid)
                        ->fetchAll('account');
    }

    public function getPairs($params = '') {

        $fields = 'tid, tname';

        /* Get raw records. */
        $teams = $this->dao->select($fields)->from(TABLE_TEAMLIST)
                ->beginIF(strpos($params, 'nodeleted') !== false)->where('deleted')->eq(0)->fi()
                ->fetchAll('tid');

        $data = array();

        foreach ($teams as $id => $team) {
            if ($team->tname == '')
                continue;
            $data[$id] = $team->tname;
        }

        return $data;
    }

    public function getUserTeamPair($account, $noadmin = false) {
        global $app;
        if (strpos($app->company->admins, $account) && !$noadmin)
            return $this->getPairs('nodeleted');
        $teams = $this->dao->select('tid, tname')
                ->from(TABLE_TEAMLIST)->alias('t2')
                ->leftJoin(TABLE_TEAMCM)->alias('t1')->on('t1.id = t2.tid')
                ->where('t1.account')->eq($account)
                ->andwhere('t2.tname')->ne('')
                ->andwhere('t2.deleted')->eq(0)
                ->orderBy('date desc')
                ->fetchAll();
        $data = array();

        foreach ($teams as $id => $team) {
            if ($team->tname == '')
                continue;
            $data[$team->tid] = $team->tname;
        }
        return $data;
    }

    public function create() {
        global $app;
        $check = $this->dbh->query("SELECT COUNT(*) AS count FROM " . TABLE_TEAMLIST . " WHERE tname = '" . $this->post->tname . "';");
        foreach ($check as $check) {
            if ($check->count != 0)
                return -1;
        }
        $now = helper::now();
        $bug = fixer::input('post')
                ->add('date', $now)
                ->add('creator', $app->user->account)
                ->add('admin', $app->user->account)
                ->setDefault('deleted', 0)
                ->remove('emails')
                ->get();
        $this->dao->insert(TABLE_TEAMLIST)->data($bug)->autoCheck()->exec();
        if (!dao::isError()) {
            $bugID = $this->dao->lastInsertID();
            return $bugID;
        }
        return false;
    }

    public function handleEmails($emails, $team) {
        // 处理Email
        $emails = split('<br />', nl2br($emails));
        foreach ($emails as $email) {
            $email = trim($email);
            if (self::isEmail($email)) {
                
                // 用户名 account 在email存在的时候要重新获取
                $uname = substr($email, 0, strpos($email, '@'));

                $this->loadModel('user');
                $emailcheck = $this->dbh->query("SELECT COUNT(*) count FROM zt_user WHERE email = '$email';");
                #$users = $this->user->getPairs('undeleted');
                foreach ($emailcheck as $check) {
                    if ($check->count == 0) {
                        // 用户不存在 注册，用户名为email前缀
                        $password = $this->user->emailCreate($uname, $email);
                        if ($password !== false) {
                            ob_start();
                            include './view/usercreate_mail.php';
                            $mailContent = ob_get_clean();
                            $this->loadModel('mail')->send($uname, '邀请您加入团队' . $team->tname, $mailContent);
                        }
                    } else {
                        // 用户存在
                        $uname = $this->user->getAccountFromEmail($email);
                    }
                }
                try {
                    $check = $this->dbh->query("SELECT COUNT(*) AS count FROM zt_team_cm WHERE id = '$team->tid' AND account = '$uname';");
                    foreach ($check as $c) {
                        if ($c->count == 0) {
                            $this->dbh->query("INSERT INTO `zt_team_cm` (`id`,`account`,`join`) VALUES('$team->tid','$uname',CURRENT_DATE())");
                        }
                    }
                } catch (Exception $e) {
                    return;
                }
            }
        }
    }

    private function isEmail($value) {
        return preg_match('/^[a-z0-9_\- ]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/i', $value);
    }

    public function getByID($teamid) {
        $bug = $this->dao->select('*')
                        ->from(TABLE_TEAMLIST)->alias('t1')
                        ->where('t1.tid')->eq((int) $teamid)->fetch();
        return $bug;
    }

    public function isTeamAdmin($account, $teamid) {
        $res = $this->dao->select('isadmin')
                ->from(TABLE_TEAMCM)
                ->where('id')->eq((int) $teamid)
                ->andwhere('account')->eq($account)
                ->fetch();
        return $res->isadmin == 1;
    }

    public function unlinkMember($teamid, $account) {
        try {
            $projects = $this->dbh->query(sprintf("SELECT id FROM `zt_project` WHERE `teamid` = '%s';", $teamid));
            $this->dbh->query(sprintf("DELETE FROM `zt_team_cm` WHERE `id` = '%s' AND `account` = '%s';", $teamid, $account));
            foreach ($projects AS $project) {
                $this->dbh->query(sprintf("DELETE FROM `zt_team` WHERE `project` = '%s' AND `account` = '%s';", $project->id, $account));
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProjectMembersPairs($projectID) {

        $list = $this->dao->select('t1.account,t2.realname')
                ->from(TABLE_TEAM)->alias('t1')
                ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
                ->where('t1.project')->eq($projectID)
                ->orderBy('t1.account ASC')
                ->fetchAll();

        $data = array();
        foreach ($list as $id => $meb) {
            if ($meb->account == '')
                continue;
            $data[$meb->account] = $meb->realname;
        }

        return $data;
    }

}
