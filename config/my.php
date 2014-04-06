<?php
$config->installed       = true;
$config->debug           = true;
$config->requestType     = 'PATH_INFO';
$config->db->host        = '127.0.0.1';
$config->db->port        = '3306';
$config->db->name        = 'zentao';
$config->db->user        = 'root';
$config->db->password    = '613158';
$config->db->prefix      = 'zt_';
$config->webRoot         = getWebRoot();
$config->default->lang   = 'zh-cn';
$config->mysqldump       = 'C:\Program Files (x86)\MySQL\MySQL Server 5.5\bin\mysqldump.exe';