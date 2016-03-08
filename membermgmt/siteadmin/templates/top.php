<table width='998' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td>

            <table class='t1'>
                <tr>
                    <td><img src=../images/logo.jpg border=0 alt='Forum'></td>
                    <td class='topright'>
                        <?Php

if((isset($_SESSION['userid']) and strlen($_SESSION['userid']) > 5)){
 echo "Welcome $_SESSION[userid]  <a href=../post.php>Post</a> <a href=../logout.php>Logout</a>";
}

?> Contact Us
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <table class='t1'>
                <tr>
                    <td class='topnav'>

                        <a href=../index.php> HOME</a> :<a href=users.php>Members</a> : <a href=comments.php>Comments</a> :
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr valign='top'>
        <td>


            <div id='mainbody'>
                <table>
                    <tr>
                        <td width='100%' height='400' align='center' valign='top'>