<?php

class CChat {

    // constructor
    function CChat() {}

    // add a message to database
    function acceptMessage() {
        $sName = $GLOBALS['MySQL']->escape($_SESSION['user_name']);
        $iPid = (int)$_SESSION['user_id'];
        $sMessage = $GLOBALS['MySQL']->escape($_POST['message']);

        if ($iPid && $sName != '' && $sMessage != '') {
            $sSQL = "
                SELECT `id`
                FROM `cs_messages`
                WHERE `sender` = '{$iPid}' AND UNIX_TIMESTAMP( ) - `when` < 5
                LIMIT 1
            ";
            $iLastId = $GLOBALS['MySQL']->getOne($sSQL);
            if ($iLastId) return 2; // as protection from very often messages

            $bRes = $GLOBALS['MySQL']->res("INSERT INTO `cs_messages` SET `sender` = '{$iPid}', `message` = '{$sMessage}', `when` = UNIX_TIMESTAMP()");
            return ($bRes) ? 1 : 3;
        }
    }

    // add a private message to database
    function acceptPrivMessage() {
        $sName = $GLOBALS['MySQL']->escape($_SESSION['user_name']);
        $iPid = (int)$_SESSION['user_id'];
        $iRecipient = (int)$_POST['recipient'];
        $sMessage = $GLOBALS['MySQL']->escape($_POST['priv_message']);

        if ($iPid && $iRecipient && $sName != '' && $sMessage != '') {
            $sSQL = "
                SELECT `id`
                FROM `cs_messages`
                WHERE `sender` = '{$iPid}' AND `recipient` = '{$iRecipient}' AND UNIX_TIMESTAMP( ) - `when` < 5
                LIMIT 1
            ";
            $iLastId = $GLOBALS['MySQL']->getOne($sSQL);
            if ($iLastId) return 2; // as protection from very often messages

            $bRes = $GLOBALS['MySQL']->res("INSERT INTO `cs_messages` SET `sender` = '{$iPid}', `recipient` = '{$iRecipient}', `message` = '{$sMessage}', `when` = UNIX_TIMESTAMP()");
            return ($bRes) ? 1 : 3;
        }
    }

    // return input text form
    function getInputForm() {
        return file_get_contents('templates/chat.html');
    }

    // get last 10 messages
    function getMessages($iRecipient = 0) {
        $sRecipientSQL = 'WHERE `recipient` = 0';
        if ($iRecipient > 0) {
            $iPid = (int)$_SESSION['user_id'];
            $sRecipientSQL = "WHERE (`sender` = '{$iRecipient}' && `recipient` = '{$iPid}') || (`recipient` = '{$iRecipient}' && `sender` = '{$iPid}')";
        }

        $sSQL = "
            SELECT `a` . * , `cs_profiles`.`name`,  `cs_profiles`.`id` as 'pid' , UNIX_TIMESTAMP( ) - `a`.`when` AS 'diff'
            FROM `cs_messages` AS `a`
            INNER JOIN `cs_profiles` ON `cs_profiles`.`id` = `a`.`sender`
            {$sRecipientSQL}
            ORDER BY `a`.`id` DESC
            LIMIT 10 
        ";
        $aMessages = $GLOBALS['MySQL']->getAll($sSQL);
        asort($aMessages);

        // create list of messages
        $sMessages = '';
        foreach ($aMessages as $i => $aMessage) {
            $sExStyles = $sExJS = '';
            $iDiff = (int)$aMessage['diff'];
            if ($iDiff < 7) { // less than 7 seconds
                $sExStyles = 'style="display:none;"';
                $sExJS = "<script> $('#message_{$aMessage['id']}').fadeIn('slow'); </script>";
            }

            $sWhen = date("H:i:s", $aMessage['when']);
            $sAvatar = $GLOBALS['CProfiles']->getProfileAvatar($aMessage['pid']);
            $sMessages .= '<div class="message" id="message_'.$aMessage['id'].'" '.$sExStyles.'><b><a href="profile.php?id='.$aMessage['pid'].'" target="_blank"><img src="'. $sAvatar .'">' . $aMessage['name'] . ':</a></b> ' . $aMessage['message'] . '<span>(' . $sWhen . ')</span></div>' . $sExJS;
        }
        return $sMessages;
    }

    function getRecentMessage($iPid) {
        if ($iPid) {
            $sSQL = "
                SELECT `a` . * , `cs_profiles`.`name`,  `cs_profiles`.`id` as 'pid' , UNIX_TIMESTAMP( ) - `a`.`when` AS 'diff'
                FROM `cs_messages` AS `a`
                INNER JOIN `cs_profiles` ON `cs_profiles`.`id` = `a`.`sender`
                WHERE `recipient` = '{$iPid}'
                ORDER BY `a`.`id` DESC
                LIMIT 1
            ";

            $aMessage = $GLOBALS['MySQL']->getRow($sSQL);
            $iDiff = (int)$aMessage['diff'];
            if ($iDiff < 7) { // less than 7 seconds, = new
                return (int)$aMessage['sender'];
            }
            return;
        }
    }
}

$GLOBALS['MainChat'] = new CChat();