<?php
mysql_connect("localhost", "readonly","readpassword") or die(mysql_error());
mysql_select_db("finance");

# TOTAL NUMBER OF QUOTES
$totalQuote=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM quote;"));
$output[]=$totalQuote;

# NUMBER OF QUOTES TODAY
$todayQuote=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM quote WHERE timestamp >= DATE(CONVERT_TZ(NOW(), '+5:00','+0:00'));"));
$output[]=$todayQuote;

# TOTAL NUMBER OF NEWS RECORDS
$totalNews=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM basicnews;"));
$output[]=$totalNews;

# NUMBER OF NEWS RECORDS TODAY
$todayNews=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM basicnews WHERE timestamp >= DATE(CONVERT_TZ(NOW(), '+5:00','+0:00'));"));
$output[]=$todayNews;

# NOTIFICATIONS
#$sql=mysql_query("SELECT * FROM notification WHERE timestamp > CONVERT_TZ(NOW(),'+4:30','+0:00');");
$sql=mysql_query("SELECT timestamp, notice FROM notification ORDER BY noticeID DESC LIMIT 10;");
if(!$sql){
echo "Could not succesfully run query ($sql) from DB: " . mysql_error();
}
while($row=mysql_fetch_assoc($sql))
$output[]=$row;

# SHOW OUTPUT
print(json_encode($output));
mysql_close();
?>
