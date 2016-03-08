<?php

// set error reporting level
if (version_compare(phpversion(), '5.3.0', '>=') == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);

require_once('classes/Services_JSON.php');
require_once('classes/CMySQL.php'); // including service class to work with database
require_once('classes/CLogin.php'); // including service class to work with login processing
require_once('classes/CProfiles.php'); // including service class to work with profiles

$sErrors = '';
// join processing
if (! isset($_SESSION['user_id']) && $_POST['Join'] == 'Join') {
    $GLOBALS['CProfiles']->registerProfile();
}

// login system init and generation code
$sLoginForm = $GLOBALS['CLogin']->getLoginBox();

$sChat = '<h2>You do not have rights to use chat</h2>';
$sInput = $sPrivChatJs = '';
if ($_SESSION['user_id'] && $_SESSION['user_status'] == 'active' && $_SESSION['user_role']) {
    if ($_GET['action'] == 'update_last_nav') { // update last navigate time
        $iPid = (int)$_SESSION['user_id'];
        if ($iPid) {
            $GLOBALS['MySQL']->res("UPDATE `cs_profiles` SET `date_nav` = NOW() WHERE `id` = '{$iPid}'");
        }
        exit;
    }

    require_once('classes/CChat.php'); // including service class to work with chat

    if ($_GET['action'] == 'check_new_messages') { // check for new messages
        $iPid = (int)$_SESSION['user_id'];
        $iSender = $GLOBALS['MainChat']->getRecentMessage($iPid);

        if ($iSender) {
            $aSender = $GLOBALS['CProfiles']->getProfileInfo($iSender);
            $sName = ($aSender['first_name'] && $aSender['last_name']) ? $aSender['first_name'] . ' ' . $aSender['last_name'] : $aSender['name'];

            $oJson = new Services_JSON();
            header('Content-type: application/json');
            echo $oJson->encode(array('id' => $iSender, 'name' => $sName));
        }
        exit;
    }

    if ($_GET['action'] == 'get_private_messages') { // regular updating of messages in chat
        $sChat = $GLOBALS['MainChat']->getMessages((int)$_GET['recipient']);
        $oJson = new Services_JSON();
        header('Content-type: application/json');
        echo $oJson->encode(array('messages' => $sChat));
        exit;
    }

    // get last messages
    $sChat = $GLOBALS['MainChat']->getMessages();
    if ($_GET['action'] == 'get_last_messages') { // regular updating of messages in chat
        $oJson = new Services_JSON();
        header('Content-type: application/json');
        echo $oJson->encode(array('messages' => $sChat));
        exit;
    }

    // add avatar
    if ($_POST['action'] == 'add_avatar') {
        $iAvRes = $GLOBALS['CProfiles']->addAvatar();
        header('Content-Type: text/html; charset=utf-8');
        echo ($iAvRes == 1) ? '<h2 style="text-align:center">New avatar has been accepted, refresh main window to see it</h2>' : '';
        exit;
    }

    // get input form
    $sInput = $GLOBALS['MainChat']->getInputForm();

    if ($_POST['message']) { // POST-ing of message
        $iRes = $GLOBALS['MainChat']->acceptMessage();

        $oJson = new Services_JSON();
        header('Content-type: application/json');
        echo $oJson->encode(array('result' => $iRes));
        exit;
    }

    if ($_POST['priv_message']) { // POST-ing of private messages
        $iRes = $GLOBALS['MainChat']->acceptPrivMessage();

        $oJson = new Services_JSON();
        header('Content-type: application/json');
        echo $oJson->encode(array('result' => $iRes));
        exit;
    }
    $sPrivChatJs = '<script src="js/priv_chat.js"></script>';
}

// get profiles lists
$sProfiles = $GLOBALS['CProfiles']->getProfilesBlock();
$sOnlineMembers = $GLOBALS['CProfiles']->getProfilesBlock(10, true);

// get profile avatar
$sAvatar = $GLOBALS['CProfiles']->getProfileAvatarBlock();

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
echo strtr(file_get_contents('templates/main_page.html'), $aKeys);