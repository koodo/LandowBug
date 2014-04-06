<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot      = $this->app->getWebRoot();
$jsRoot       = $webRoot . "js/";
$themeRoot    = $webRoot . "theme/";
$defaultTheme = $webRoot . 'theme/default/';
$langTheme    = $themeRoot . 'lang/' . $app->getClientLang() . '.css';
$clientTheme  = $this->app->getClientTheme();
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <?php
  echo html::title($title . ' - ' . $lang->zentaoPMS);

  js::exportConfigVars();
  css::import($themeRoot . 'fontawesome/min.css',   $config->version);
  
  /* 忽略IE7 patch
  if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0"))
  {
      css::import($themeRoot . 'fontawesome/ie7.min.css',   $config->version);
      css::import($defaultTheme . 'style.ie7.css', $config->version);
  }*/
      js::import($jsRoot . 'jquery/lib.js', $config->version);
      js::import($jsRoot . 'my.min.js',     $config->version);

      css::import($defaultTheme . 'yui.css',   $config->version);
      css::import($defaultTheme . 'style.css', $config->version);

      css::import($langTheme, $config->version);
      if(strpos($clientTheme, 'default') === false) css::import($clientTheme . 'style.css', $config->version);
      
  /*
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/lib.js', $config->version);
      js::import($jsRoot . 'my.min.js',     $config->version);

      css::import($defaultTheme . 'yui.css',   $config->version);
      css::import($defaultTheme . 'style.css', $config->version);

      css::import($langTheme, $config->version);
      if(strpos($clientTheme, 'default') === false) css::import($clientTheme . 'style.css', $config->version);
  }
  else
  {
      js::import($jsRoot . 'all.js', $config->version);
      css::import($defaultTheme . $this->cookie->lang . '.' . $this->cookie->theme . '.css', $config->version);
  }*/

  if(isset($pageCss)) css::internal($pageCss);

  echo html::icon($webRoot . 'favicon.ico');
  ?>
</head>
<body>
