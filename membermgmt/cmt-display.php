<?Php
$sql="select * from mem_cmt_post WHERE mem_id=$mem_id";

echo "<table class='t1'>";
foreach ($dbo->query($sql) as $row) {
$dtl=nl2br($row['dtl']);
echo "<tr class='r1'><td>$row[userid]</td><td>$row[dt]</td></tr>";
echo "<tr class='r0'><td colspan=2>$dtl</td></tr>";
}
echo "</table>";
?>