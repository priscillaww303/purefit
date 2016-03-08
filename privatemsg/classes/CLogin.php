<?php

class CLogin {

    // constructor
    function CLogin() {
        session_start();
    }

    // get login box function
    function getLoginBox() {
        if (isset($_GET['logout'])) { // logout processing
            if (isset($_SESSION['user_name']) && isset($_SESSION['user_pass']))
                $this->performLogout();
        }
        
        
        if ($_POST && $_POST['Login'] == 'Login' && $_POST['username'] && $_POST['password']) { // login processing
            
            if ($this->checkLogin($_POST['username'], $_POST['password'], false)) { // successful login
                
                $this->performLogin($_POST['username'], $_POST['password']);
                header( "Location:{$_SERVER['REQUEST_URI']}" );
                exit;
            } else { // wrong login
                return file_get_contents('privatemsg/templates/login_form.html') . '<h2>Username or Password is incorrect</h2>';
            }
        } else { // in case if we already logged (on refresh page):
            if (isset($_SESSION['user_name']) && $_SESSION['user_name'] && $_SESSION['user_pass']) {
                $aReplaces = array(
                    '{name}' => $_SESSION['user_name'],
                    '{status}' => $_SESSION['user_status'],
                    '{identity}' => $_SESSION['user_identity'],
                    '{state}' => $_SESSION['user_state'],
                    '{interest}' => $_SESSION['user_interest'],
                );
                return strtr(file_get_contents('templates/logout_form.html'), $aReplaces);
            }

            // otherwise - draw login form
            return file_get_contents('templates/login_form.html');
        }
    }

    // perform login
    function performLogin($sName, $sPass) {
        $this->performLogout();

        // make variables safe
        $sName = $GLOBALS['MySQL']->escape($sName);

        $aProfile = $GLOBALS['MySQL']->getRow("SELECT * FROM `cs_profiles` WHERE `name`='{$sName}'");
        // $sPassEn = $aProfile['password'];
        $iPid = $aProfile['id'];
        $sSalt = $aProfile['salt'];
        $sStatus = $aProfile['status'];
        $sIdentity = $aProfile['identity'];
        $sState = $aProfile['state'];
        $sInterest = $aProfile['interest'];

        $sPass = sha1(md5($sPass) . $sSalt);

        $_SESSION['user_id'] = $iPid;
        $_SESSION['user_name'] = $sName;
        $_SESSION['user_pass'] = $sPass;
        $_SESSION['user_status'] = $sStatus;
        $_SESSION['user_identity'] = $sIdentity;
        $_SESSION['user_state'] = $sState;
        $_SESSION['user_interest'] = $sInterest;
        
    }

    // perform logout
    function performLogout() { 
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_pass']);
        unset($_SESSION['user_status']);
        unset($_SESSION['user_identity']);
        unset($_SESSION['user_state']);
        unset($_SESSION['user_interest']);
        
    }

    // check login
    function checkLogin($sName, $sPass, $isHash = false) {
        // make variables safe
        $sName = $GLOBALS['MySQL']->escape($sName);
        $sPass = $GLOBALS['MySQL']->escape($sPass);

        $aProfile = $GLOBALS['MySQL']->getRow("SELECT * FROM `cs_profiles` WHERE `name`='{$sName}'");
        $sPassEn = $aProfile['password'];
        
        if ($sName && $sPass && $sPassEn) {
            if ($isHash) {
                $sSalt = $aProfile['salt'];
                $sPass = sha1(md5($sPass) . $sSalt);
            }
            return ($sPass == $sPassEn);
        }
        return false;
    }
}

$GLOBALS['CLogin'] = new CLogin();