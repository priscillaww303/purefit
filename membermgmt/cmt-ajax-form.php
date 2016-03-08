<?Php
echo "<div id=\"txtHint\"><b></b></div>";

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>
<form method=post onsubmit=\"ajaxFunction(this.form); return false\" id='myForm' ><input type=hidden id='cmt_todo' value='post_comment'>
<input type=hidden name=mem_id  value='$mem_id' id=mem_id>
<tr bgcolor='#ffffcc'><td colspan=2 class='data'><b>Post Comment</b> This is for short comments only. </td></tr>


<tr bgcolor='#f1f1f1'><td colspan=2><textarea name=dtl rows=3 cols=80 id=dtl></textarea></td></tr>
<tr ><td colspan=2 align=center><input type=submit value='Post Comment'></td></tr>
</table></form>";
?>