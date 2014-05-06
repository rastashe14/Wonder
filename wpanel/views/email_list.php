<h3>Mail list</h3>
<div class="row scrollbar" style="height: 400px">
<?php

$salida = '';
$emails=mysql_query("SELECT * FROM  `mail_list` ")or die (mysql_error());
while ($email = mysql_fetch_assoc($emails)){

	$salida .= '<div style="margin: 5px 0px 5px 15px">'.$email['name'].' ('.$email['email'].')</div>'; 
}

echo  $salida;


// $emails=mysql_query("SELECT * FROM  `mail_list` ")or die (mysql_error());
// while ($email = mysql_fetch_assoc($emails)){


// 	$salida .= $email['name'].'<'.$email['email'].'>,'; 
// }


// echo htmlentities (rtrim($salida,','));

?>
</div>