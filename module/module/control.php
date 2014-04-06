<?php

class module extends control {

    public function __construct() {
        parent::__construct();
    }

    public function ajaxAddModule() {
        $this->module->ReplaceModule();
    }

    public function ajaxGetModulesPairs() {
        $list = $this->dao->select('mid,mname')
                ->from(TABLE_MODULE1)
                ->where('project')->eq($this->post->project)
                ->orderBy('mid desc')
                ->fetchAll();
        print_r(json_encode((array) $list));
    }

    public function ajaxDelModule() {
        $this->module->DelModule();
    }

    public function ajaxEditModule() {
        $this->module->UpdateModule();
    }

}
