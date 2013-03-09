<?php
echo "hello";
require_once "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/configs');
require "header.php";

$smarty->assign('header', $output);
$smarty->testInstall();
$smarty->display('smarty.tpl');
echo "hello";
?>