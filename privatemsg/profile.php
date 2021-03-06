<?php

// set error reporting level
if (version_compare(phpversion(), '5.3.0', '>=') == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);

require_once('classes/CMySQL.php');
require_once('classes/CLogin.php');
require_once('classes/CProfiles.php');

$iPid = (int)$_GET['id'];

$sPrivChatJs = '';
if ($_SESSION['user_id'] && $_SESSION['user_status'] == 'active' && $_SESSION['user_role']) {
    if ($_GET['action'] == 'change_color') {
        $iRes = $GLOBALS['CProfiles']->changeColor($_GET['color']);
        header('Content-Type: text/html; charset=utf-8');
        echo ($iRes == 1) ? '<h2 style="text-align:center">New color has been accepted, refresh main window to see it</h2>' : '';
        exit;
    }
    $sPrivChatJs = '<script src="js/priv_chat.js"></script>';
}

$aInfo = $GLOBALS['CProfiles']->getProfileInfo($iPid);

$sName = $aInfo['name'];
$sFName = $aInfo['first_name'];
$sLName = $aInfo['last_name'];
$sState = $aInfo['state'];
$sAge = $aInfo['age'];
$sInterest = $aInfo['interest'];
$sAbout = $aInfo['about'];
$sDate = $aInfo['date_reg'];
$sRole = $GLOBALS['CProfiles']->getRoleName($aInfo['role']);
$sAvatar = $GLOBALS['CProfiles']->getProfileAvatar($iPid);
$sCustomBG = ($aInfo['color']) ? 'background-color:#'.$aInfo['color'] : '';

// get profiles lists
$sProfiles = $GLOBALS['CProfiles']->getProfilesBlock();
$sOnlineMembers = $GLOBALS['CProfiles']->getProfilesBlock(10, true);

// draw common page
$aKeys = array(
    '{id}' => $iPid,
    '{identity}' => $sIdentity,
    '{name}' => $sName,
    '{state}' => $sState,
    '{age}' => $sAge,
    '{interest}' => $sInterest,
    '{fname}' => $sFName,
    '{lname}' => $sLName,
    '{about}' => $sAbout,
    '{datereg}' => $sDate,
    '{role}' => $sRole,
    '{avatar}' => $sAvatar,
    '{custom_styles}' => $sCustomBG,
    '{cust_visible}' => ($_SESSION['user_id'] == $iPid) ? '' : 'style="display:none"',
    '{profiles}' => $sProfiles,
    '{online_users}' => $sOnlineMembers,
    '{priv_js}' => $sPrivChatJs
);
echo strtr(file_get_contents('templates/profile_page.html'), $aKeys);