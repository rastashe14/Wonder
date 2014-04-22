<h3>Mail list</h3>
<?php

$emails=mysql_query("SELECT * FROM  `mail_list` ")or die (mysql_error());
while ($email = mysql_fetch_assoc($emails)){


	$salida .= $email['name'].'<'.$email['email'].'>,'; 
}


echo htmlentities (rtrim($salida,','));

?>