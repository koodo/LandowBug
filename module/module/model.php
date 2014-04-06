<?php

class moduleModel extends model {

    public function __construct() {
        parent::__construct();
    }

    public function getByID($mid) {
        if ($mid == 0) {
            $default = new stdclass();
            $default->mname = '默认模块';
            return $default;
        }
        $list = $this->dao->select('*')
                ->from(TABLE_MODULE1)
                ->where('mid')->eq($mid)
                ->fetchAll();
        return $list[0];
    }

    public function getModules($project) {
        $list = $this->dao->select('*')
                ->from(TABLE_MODULE1)
                ->where('project')->eq($project)
                ->orderBy('mid desc')
                ->fetchAll();
        return $list;
    }

    public function UpdateModule() {
        global $app;
        $checks = $this->dbh->query(sprintf("SELECT COUNT(*) AS count FROM zt_module1 WHERE `mname` = '%s' AND `project` = '%s' AND `mid` <> '%s';", $this->post->mname, $this->post->project, $this->post->mid));
        foreach ($checks as $check) {
            if ($check->count > 0) {
                die("-1");
            }
        }
        if (!empty($_POST)) {
            $SQL = sprintf("UPDATE zt_module1 SET `mname` = '%s',`assignto` = '%s' WHERE `mid` = '%s';", $this->post->mname, $this->post->assignto, $this->post->mid);
            try {
                $this->dbh->query($SQL);
                echo 1;
            } catch (Exception $ex) {
                echo 0;
            }
        }
    }

    public function ReplaceModule() {
        global $app;
        $checks = $this->dbh->query(sprintf("SELECT COUNT(*) AS count FROM zt_module1 WHERE `mname` = '%s' AND `project` = '%s';", $this->post->mname, $this->post->project));
        foreach ($checks as $check) {
            if ($check->count) {
                die("-1");
            }
        }
        if (!empty($_POST)) {
            $SQL = sprintf("REPLACE INTO zt_module1 (`project`,`mname`,`assignto`) VALUES ('%s','%s','%s');", $this->post->project, $this->post->mname, $this->post->assignto);
            try {
                $this->dbh->query($SQL);
                echo 1;
            } catch (Exception $ex) {
                echo 0;
            }
        }
    }

    public function DelModule() {
        if (!empty($_POST)) {
            $SQL = sprintf("DELETE FROM `zt_module1` WHERE `project` = '%s' AND `mid` = '%s';", $this->post->project, $this->post->mid);
            try {
                $this->dbh->query($SQL);
                echo 1;
            } catch (Exception $ex) {
                echo 0;
            }
        }
    }

    public function getPairs($project = 0) {
        $fields = 'mid, mname';

        $sysBuilds = array('0' => '默认模块');

        /* Get raw records. */
        $teams = $this->dao->select($fields)->from(TABLE_MODULE1)
                ->where('project')->eq($project)
                ->fetchAll('mid');
        $data = array();
        foreach ($teams as $id => $team) {
            $data[$id] = $team->mname;
        }
        return $sysBuilds + $data;
    }

}
