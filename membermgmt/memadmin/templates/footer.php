<?Php
 echo "</td></tr></table></div>";// end of full body table

if((isset($_SESSION['userid']) and $_SESSION['userid']=="siteadmin")){
echo "Visit <a href='../siteadmin/index.php'>Site Admin</a> area..";
}
// Get the footer here
echo "<table class='t1'>
<tr><td >

<a href='#' rel='nofollow'>
Privacy Policy</a>  | <a href='#' target='new' rel='nofollow'>Disclaimer</a>
<br> 

&copy;2012  All rights reserved worldwide 
</td></tr>
	</table>";
//////////////////////////// End of footer area /////////
echo "</td></tr></table> "; // end of main table

?>
