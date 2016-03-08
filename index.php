<?php

// set error reporting level
if (version_compare(phpversion(), '5.3.0', '>=') == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);

require_once('privatemsg/classes/Services_JSON.php');
require_once('privatemsg/classes/CMySQL.php'); // including service class to work with database
require_once('privatemsg/classes/CLogin.php'); // including service class to work with login processing
require_once('privatemsg/classes/CProfiles.php'); // including service class to work with profiles

$sErrors = '';
// join processing
if (! isset($_SESSION['user_id']) && $_POST['Join'] == 'Join') {
    $GLOBALS['CProfiles']->registerProfile();
}

// login system init and generation code
$sLoginForm = $GLOBALS['CLogin']->getLoginBox();

// draw common page
$aKeys = array(
    '{form}' => $sLoginForm . $sErrors,
    '{chat}' => $sChat,
    '{input}' => $sInput,
    '{profiles}' => $sProfiles,
    '{online_users}' => $sOnlineMembers,
    '{avatar}' => $sAvatar,
    '{priv_js}' => $sPrivChatJs
);
echo strtr(file_get_contents('index.html'), $aKeys);