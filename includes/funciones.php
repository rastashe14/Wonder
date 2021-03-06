<?php 

function convertir($cad){
	     $acentos  = array("�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�", "�"); 
		 $caracter = array("&aacute;", "&Aacute;", "&eacute;", "&Eacute;", "&iacute;", "&Iacute;", "&oacute;", "&Oacute;", "&uacute;", "&Uacute;", "&ntilde;", "&Ntilde;"); 
	     
		 for ($i=0; $i < count($acentos); $i++){
		      $cadena = str_replace($acentos[$i], $caracter[$i], $cad); 
		 }
	   
	     return $cadena;
}

function sendMail($body, $from, $fromName, $subject, $address, $path="", $return=false){
			  $mail = new phpmailer();
			  $mail->PluginDir = $path."class/"; 
			  $mail->Mailer    = "smtp";
			  $mail->Host      = "localhost";
			  $mail->SMTPAuth  = false;
			  $mail->Timeout   = 10;
			  
			  $mail->IsHTML(true);
			  $mail->AddAddress($address);
			  
			  $mail->From      = $from;
			  $mail->FromName  = $fromName;
			  $mail->Subject   = $subject;
		      $mail->Body      = $body;
			  
			  if ($return)
			      return $mail->Send(); 
			  else
			      $mail->Send();
}

function dias_mes($mes, $anio){
         $_mes = mktime( 0, 0, 0, $mes, 1, $anio);
		 return date("t", $_mes);
}


function existe($tabla, $campo, $where){
		 $query = mysql_query("SELECT ".$campo." FROM ".$tabla." ".$where) or die (mysql_error());
         return (mysql_num_rows($query) > 0) ? true : false;
}

function campo($tabla, $campo, $criterio, $pos){ 
	//die("SELECT $pos FROM $tabla WHERE $campo = '$criterio'");
         $query = mysql_query("SELECT $pos FROM $tabla WHERE $campo = '$criterio'") or die (mysql_error());  
		 $array = mysql_fetch_assoc($query);
		 return $array[$pos];
}

function formatoCadena($cadena, $op=1){
         switch($op){
		        case 1: return ucwords($cadena);    break; #Pone en may�sculas el primer car�cter de cada palabra de una cadena
				case 2: return ucfirst($cadena);    break; #Pasar a may�sculas el primer car�cter de una cadena
				case 3: return strtolower($cadena); break; #Pasa a min�sculas una cadena
				case 4: return strtoupper($cadena); break; #Pasa a may�sculas una cadena
				case 5: return str_replace(' ', '', strtolower($cadena)); break; #Pasa a may�sculas una cadena
		 }
}

function redirect($url){
		 echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$url.'">';
}


function quitar_inyect(){
	//$vect=array($_SESSION,$_POST,$_GET,$_FILES,$_COOKIE);
	$filtro = array("\"","\\","'","|","{","}","[","]","*",">", "<", "INSERT " , "insert ", "UPDATE", "update", "DELETE", "delete"," x00 ","\\", "\\\\", " x1a ");
	foreach($_POST as $k=>$v){
	    foreach ($filtro as $index){
	    	$v=str_replace(trim($index), '',$v);
		}
		$_POST["$k"]=addslashes(htmlspecialchars($v,ENT_NOQUOTES));		
	}
	foreach($_GET as $k=>$v){
	    foreach ($filtro as $index){
	    	$v=str_replace(trim($index), '',$v);
		}
		$_GET["$k"]=addslashes(htmlspecialchars($v,ENT_NOQUOTES));		
	}
	/*foreach($_COOKIE as $k=>$v){
	    foreach ($filtro as $index){
	    	$v=str_replace(trim($index), '',$v);
		}
		$_COOKIE["$k"]=addslashes(htmlspecialchars($v,ENT_NOQUOTES));		
	}*/
	return true;
}


function mensajes( $titulo,$content){

		$type= $titulo=="Error!"? "alert":"success";
		
         $action = '<div class="row">
						<div data-alert class="alert-box radius '.$type.'">
							<h6>'.$titulo.'</h6>
								'.$content.'
							<a href="#" class="close">&times;</a>
						</div>
					</div>
		           '; 
		 
		 echo $action;
}



function corta_cadena($cadena,$tamananio){
	$band=true;$i=0;
	$salida='';
	while(true){		
		if(($i>=$tamananio&&$cadena[$i]==' ')||($i==strlen($cadena))){
			return $salida;
			}
		$salida.=$cadena[$i++];
	}
}

function formatoFecha($fecha){
	if(strpos($fecha,'-')){
		$fecha=explode('-',$fecha);
		$fecha[2]=explode(' ',$fecha[2]);
	    $fecha[2]=$fecha[2][0];
		return $fecha[2]."/".$fecha[1]."/".$fecha[0];
	}elseif(strpos($fecha,'/')){
		$fecha=explode('/',$fecha);
		return $fecha[2]."-".$fecha[1]."-".$fecha[0];
	}
	return false;
}


function montosInsert($monto,$dec=2){ 
	$pos1 = strpos($monto,",");
	if ($pos1 === false){ 
		return number_format($monto,$dec,'.','');
	}else{
		return number_format(str_replace(',','.',str_replace('.','',$monto)),2,'.','');
	}
}

function _imprimir($array){
        echo "<pre>"; print_r($array); echo "</pre>";
}


function decimal_romano($numero)
{
	$numero=floor($numero);
	if($numero<0){
		$var="-";
		$numero=abs($numero);
	}
	# Definici&oacute;n de arrays
	$numerosromanos=array(1000,500,100,50,10,5,1);
	$numeroletrasromanas=array("M"=>1000,"D"=>500,"C"=>100,"L"=>
	50,"X"=>10,"V"=>5,"I"=>1);
	$letrasromanas=array_keys($numeroletrasromanas);

	while($numero)
	{
		for($pos=0;$pos<=6;$pos++)
		{
		$dividendo=$numero/$numerosromanos[$pos];
			if($dividendo>=1)
			{
			$var.=str_repeat($letrasromanas[$pos],floor($dividendo));
			$numero-=floor($dividendo)*$numerosromanos[$pos];
			}
		}
	}
	$numcambios=1;
	while($numcambios)
	{
	$numcambios=0;
		for($inicio=0;$inicio<strlen($var);$inicio++)
		{
		$parcial=substr($var,$inicio,1);
		if($parcial==$parcialfinal&&$parcial!="M")
		{
		$apariencia++;
		}else{
		$parcialfinal=$parcial;
		$apariencia=1;
	}
	# Caso en que encuentre cuatro car�cteres seguidos iguales.
	if($apariencia==4)
	{
		$primeraletra=substr($var,$inicio-4,1);
		$letra=$parcial;
		$sum=$primernumero+$letternumero*4;
		$pos=busqueda($letra,$letrasromanas);
	if($letrasromanas[$pos-1]==$primeraletra)
	{
		$cadenaant=$primeraletra.str_repeat($letra,4);
		$cadenanueva=$letra.$letrasromanas[$pos-2];
	}else{
		$cadenaant=str_repeat($letra,4);
		$cadenanueva=$letra.$letrasromanas[$pos-1];
	}
		$numcambios++;
		$var=str_replace($cadenaant,$cadenanueva,$var);
	}
	}
	}
	return $var;
	}





function num2letras($num, $fem = false, $dec = true) {
/*!
  @function num2letras ()
  @abstract Dado un n?mero lo devuelve escrito.
  @param $num number - N?mero a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el n?mero escrito en letra.

*/
   $matuni[2]  = "dos";   
   $matuni[3]  = "tres";   
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";   
   $matuni[6]  = "seis";   
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";   
   $matuni[9]  = "nueve";   
   $matuni[10] = "diez";
   $matuni[11] = "once";   
   $matuni[12] = "doce";   
   $matuni[13] = "trece";
   $matuni[14] = "catorce";   
   $matuni[15] = "quince";   
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";   
   $matuni[18] = "dieciocho";   
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte"; 
     
   $matunisub[2] = "dos";   
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";   
   $matunisub[5] = "quin";   
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";   
   $matunisub[8] = "ocho";   
   $matunisub[9] = "nove";

   $matdec[2] = "veint";   
   $matdec[3] = "treinta";   
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";   
   $matdec[6] = "sesenta";   
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";   
   $matdec[9] = "noventa";  
    
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';   
   $matsub[7]  = 'mill';   
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';   
   $matsub[13] = 'bill';   
   $matsub[15] = 'mill';
   
   $matmil[4]  = 'millones';   
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';   
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';   
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';   
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';   
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@number_format($num,2,'.',''));///////////////////
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {//////////
	  $Cero= (int)$fra[0] ? '' : 'Cero ';
      $fin = ' con '.$Cero.num2letras($fra);
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
	  	if($num[0].$num[1].$num[2]=='100'){	
         $t = ' cien' . $t;
		}else{$t = ' ciento' . $t;}
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . '&oacute;n';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }   
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   list($punta,$cola)=split(" con ",$tex);/////
   if(substr($punta,-2,2)=='to')$punta=substr($punta,0,-2);//////////
   $tex= $cola!='' ? $punta.' con '.$cola.' C&eacute;ntimos' : $punta.' con Cero C&eacute;ntimos';///////////
   return ucfirst($tex);
}


function quitarAcentos($text)
	{	
		$text = htmlentities($text);
		$text = strtolower($text);
		$patron = array (
			// Espacios, puntos y comas por guion
			'/[\., ]+/' => '-',
			
			// Vocales
			'/&agrave;/' => 'a',
			'/&egrave;/' => 'e',
			'/&igrave;/' => 'i',
			'/&ograve;/' => 'o',
			'/&ugrave;/' => 'u',
			
			'/&aacute;/' => 'a',
			'/&eacute;/' => 'e',
			'/&iacute;/' => 'i',
			'/&oacute;/' => 'o',
			'/&uacute;/' => 'u',
			
			'/&acirc;/' => 'a',
			'/&ecirc;/' => 'e',
			'/&icirc;/' => 'i',
			'/&ocirc;/' => 'o',
			'/&ucirc;/' => 'u',
			
			'/&atilde;/' => 'a',
			'/&etilde;/' => 'e',
			'/&itilde;/' => 'i',
			'/&otilde;/' => 'o',
			'/&utilde;/' => 'u',
			
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
			
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
			
			// Otras letras y caracteres especiales
			'/&aring;/' => 'a',
			'/&ntilde;/' => 'n',
 
			// Agregar aqui mas caracteres si es necesario
 
		);
		
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		return $text;
	}

function cls_string($cad){
		  	   $filtro = array("\"",",","!","?","�","�", "$", "%", "&","\\","'","|","{","}","[","]","+", "*",">", "<","x00","\n","\r","\\", "\\\\", "x1a");
			   foreach ($filtro as $index){
			            $cad=str_replace($index, '',$cad);
			   }
	           return $cad;
}

function formato($numero){
	return number_format($numero,2,',','.');  	   	   
}
	   
function sinFormato($number){
    return str_replace(',','.',str_replace('.','',$number));
}	

function generaHidden(){ 
	reset($_REQUEST);
	$REQUEST=$_REQUEST;
	for($i=0;$i<count($REQUEST);$i++){
		$value = current($REQUEST);                
		$nombre=key($REQUEST);
		echo "\n<input name='$nombre' type='hidden' id='$nombre' value='$value'>";
		next($REQUEST);
	}
	reset($_REQUEST);
}	
function generaGet(){ 
	reset($_REQUEST);
	$REQUEST=$_REQUEST;
	$get= '?';
	for($i=0;$i<count($REQUEST);$i++){
		$value = current($REQUEST);                
		$nombre=key($REQUEST);
		$get.=$nombre."=".$value."&";
		next($REQUEST);
	}
	reset($_REQUEST);
    return substr($get,0,-1);
}   	     

function redimensionar($img_original, $img_nueva,$img_nueva_anchura,$img_nueva_altura='') {
	
	$type=Array(1 => 'gif', 2 => 'jpg', 3 => 'png');
	
	list($imgWidth,$imgHeight,$tipo,$imgAttr)=@getimagesize($img_original);
	$type=$type[$tipo];

	switch($type){
		case "jpg" : 
		case "jpeg": $img = imagecreatefromjpeg($img_original); break;
		case "gif" :  $img = imagecreatefromgif($img_original); break;
		case "png" :  $img = imagecreatefrompng($img_original); break;
	}
	
	//Obtengo el tama�o del original
	$img_original_anchura 	= $imgWidth;
	$img_original_altura 	= $imgHeight;
	// Obtengo la relacion de escala

	if($img_original_anchura > $img_nueva_anchura && $img_nueva_anchura > 0)
				$percent = (double)(($img_nueva_anchura * 100) / $img_original_anchura);
				
	if($img_original_anchura <= $img_nueva_anchura)
				$percent = 100;			
				

	if(floor(($img_original_altura * $percent )/100)>$img_nueva_altura && $img_nueva_altura > 0)
				$percent = (double)(($img_nueva_altura * 100) / $img_original_altura);
				
			
	
	 $img_nueva_anchura=($img_original_anchura*$percent)/100;
	
	 $img_nueva_altura=($img_original_altura*$percent)/100;
				
	// crea imagen nueva redimencionada
	$thumb = imagecreatetruecolor ($img_nueva_anchura,$img_nueva_altura);
	
	if($type=='gif' || $type=='png')
			{
				/** Code to keep transparency of image **/
				/*$colorcount = imagecolorstotal($this->_img);
				if ($colorcount == 0) $colorcount = 256;
				imagetruecolortopalette($newimg,true,$colorcount);*/
				imagepalettecopy($thumb,$img);
				$transparentcolor = imagecolortransparent($img);
				
				imagefill($thumb,0,0,$transparentcolor);
				
				imagecolortransparent($thumb,$transparentcolor); 
			}
	
	// redimensionar imagen original copiandola en la imagen nueva
	imagecopyresampled ($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura, $imgWidth,$imgHeight);
	// guardar la imagen redimensionada donde indica $img_nueva
	switch($type){
		case "jpg": 
		case "jpeg": imagejpeg($thumb,$img_nueva); break;
		case "gif":  imagegif($thumb,$img_nueva); break;
		case "png":  imagepng($thumb,$img_nueva); break;
	}
	
	imagedestroy($img);
	imagedestroy($thumb);


	//return $img_nueva;
}	 

function validateDir($path){
	
	if (!is_dir ($path)){
		$old = umask(0);
		mkdir($path,0777);
		umask($old);
		$fp=fopen($path.'index.html',"w");
		fclose($fp);
	}// is_dir
}

function delDir($path, $folder){
	     
		 $dir = opendir($path.'/'.$folder);
		
		 while ($file = readdir($dir)){
			 
			 unlink($path.'/'.$folder.'/'.$file);
		}
         
		closedir($dir);
		
		rmdir($path.$folder);

}

function deleteDir($dir, $borrarme)
{
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) 
    {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) borrar_directorio($dir.'/'.$obj, true);
    }
    closedir($dh);
    if ($borrarme)
    {
        @rmdir($dir);
    }
}
 
 function get_month_wonder($next){
	if ($next!='') {
		switch ($next) {
			case '01': 
				$mespos = 2;
				$mesact = '01';
				//$mesant = 12;
			break;
			case '02': 
				$mespos = 3;
				$mesact = '02';
				$mesant = 1;
			break;
			case '03': 
				$mespos = 4;
				$mesact = '03';
				$mesant = 2;
			break;
			case '04': 
				$mespos = 5;
				$mesact = '04'; 
				$mesant = 3;
			break;
			case '05': 
				$mespos = 6;
				$mesact = '05';
				$mesant = 4;
			break;
			case '06': 
				$mespos = 7;
				$mesact = '06';
				$mesant = 5;
			break;
			case '07': 
				$mespos = 8;
				$mesact = '07';
				$mesant = 6;
			break;
			case '08': 
				$mespos = 9;
				$mesact = '08';
				$mesant = 7;
			break;
			case '09': 
				$mespos = 10;
				$mesact = '09';
				$mesant = 8;
			break;
			case '10': 
				$mespos = 11;
				$mesact = '10';
				$mesant = 9;
			break;
			case '11': 
				$mespos = 12;
				$mesact = '11';
				$mesant = 10;
			break;
			case '12': 
				//$mespos = 1;
				$mesact = '12';
				$mesant = 11;
			break;
		}
		$mesSi = date('F',mktime(0, 0, 0, $mespos, date("d"), date("Y"))); 
		$mesAn = date('F',mktime(0, 0, 0, $mesant, date("d"), date("Y")));

		return $mesAn.'|'.$mesSi.'|'.$mesant.'|'.$mespos.'|'.$mesact;
	}
}

/* draws a calendar */
function draw_calendar($next){
	

	// $month = $next==1?(date('m')==12?1:date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))):date('m');
	//$year  = date('Y');

	$year  = $next==1?(date('m')==12?date('Y')+1:date('Y')):date('Y');
	$month = explode("|",get_month_wonder($next));

	//mes anterior
	$firstm = $next?$month[2]:date('m');//frena el calendario en enero del ano presente
	$beforeD = $month[2]?$month[2]:date('m')-1;
	$beforeM = $month[0]?$month[0]:date('F',mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));

	//mes siguiente
	$lastm = $next?$month[3]:date('m');//frena el calendario en diciembre del ano presente
	$nextD = $month[3]?$month[3]:date('m')+1;
	$nextM = $month[1]?$month[1]:date('F',mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));

	$month = $month[4]?$month[4]:date('m');
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar rounded">';

	/* table headings */
	$headings = array('Sun','Mon','Tues','Wednes','Thurs','Fri','Satur');
	$backMonth= $firstm!=''?"onclick='window.location.replace(\"?current=booking&next=".$beforeD."\");'":"";
	$nextMonth= $lastm!=''?"onclick='window.location.replace(\"?current=booking&next=".$nextD."\");'":"";
	$calendar.= '<tr class="calendar-row" >
				   <th '.$backMonth.' > <h3 style="cursor: pointer">'.($backMonth==''?'':'<').'</h3></th>
				   <th colspan="5">  <h3>'.date('F Y',mktime(0, 0, 0, $month, 1, $year)).'</h3></th>
				   <th '.$nextMonth.' > <h3 style="cursor: pointer">'.($nextMonth==''?'':'>').'</h3></th>';
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;
	/*
	List of the reservations for this month, day by day
	 */
	$reservations = mysql_query("SELECT DAY(date) as 'day', pakage FROM  `reservations` WHERE  `date` LIKE  '$year-$month%' and DAY(date) > ".date("d")." and status=1 ORDER BY date") or die (mysql_error());
	while ($reserved = mysql_fetch_assoc($reservations)){
		
		$daysReserved[$reserved['day']][]=$reserved['pakage'];
		
	}

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$activitiesInDay='';
	    if(is_array($daysReserved[$list_day]))
		foreach ($daysReserved[$list_day] as $dayReserved) {
			
			$activitiesInDay.="<span class='radius label'>".$dayReserved."</span><br>";
			

		}

		//$selectedDay= @in_array($list_day,)?'selected':'';
	    $onclick= "onclick='window.location.replace(\"?current=booking&date=$month-$list_day-$year\");'";
		$valid=(date('m')==$month && $list_day <= date('d'))?"calendar-day-np":"calendar-day";
		$calendar.= "<td class='$valid $selectedDay' $onclick >";
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= $activitiesInDay;//str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

/* draws a calendar */
function draw_calendar_e($next){
	

	// $month = $next==1?(date('m')==12?1:date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))):date('m');
	// $year  = $next==1?(date('m')==12?date('Y')+1:date('Y')):date('Y');
	
	$year  = $next==1?(date('m')==12?date('Y')+1:date('Y')):date('Y');
	$month = explode("|",get_month_wonder($next));

	//mes anterior
	$firstm = $next?$month[2]:date('m');//frena el calendario en enero del ano presente
	$beforeD = $month[2]?$month[2]:date('m')-1;
	$beforeM = $month[0]?$month[0]:date('F',mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));

	//mes siguiente
	$lastm = $next?$month[3]:date('m');//frena el calendario en diciembre del ano presente
	$nextD = $month[3]?$month[3]:date('m')+1;
	$nextM = $month[1]?$month[1]:date('F',mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));

	$month = $month[4]?$month[4]:date('m');

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar rounded">';

	/* table headings */
	$headings = array('Sun','Mon','Tues','Wednes','Thurs','Fri','Satur');

	$backMonth= $firstm!=''?"onclick='window.location.replace(\"?current=events&next=".$beforeD."\");'":"";
	$nextMonth= $lastm!=''?"onclick='window.location.replace(\"?current=events&next=".$nextD."\");'":"";

	$calendar.= '<tr class="calendar-row" >
				   <th '.$backMonth.' > <h3 style="cursor: pointer">'.($backMonth==''?'':'<').'</h3></th>
				   <th colspan="5"> <h3>'.date('F Y',mktime(0, 0, 0, $month, 1, $year)).'</h3></th>
				   <th '.$nextMonth.' > <h3 style="cursor: pointer">'.($nextMonth==''?'':'>').'</h3></th>';
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;
	/*
	List of the reservations for this month, day by day
	 */
	$events = mysql_query("SELECT id,DAY(date_ini) as 'day',MONTH(date_ini) as 'month',YEAR(date_ini) as 'year', date_ini, name FROM calendar WHERE date_ini LIKE '$year-$month%' ORDER BY date_ini ASC");
	// $reservations = mysql_query("SELECT DAY(date) as 'day', pakage FROM  `reservations` WHERE  `date` LIKE  '$year-$month%' and DAY(date) > ".date("d")." and status=1 ORDER BY date") or die (mysql_error());
	while ($reserved = mysql_fetch_assoc($events)){
		$daysReserved[$reserved['day']][]=$reserved['name'].'|'.$reserved['id'].'|'.$reserved['date_ini'].'|'.$reserved['day'];
	}

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$activitiesInDay='';$a=0;
	    if(is_array($daysReserved[$list_day]))
		foreach ($daysReserved[$list_day] as $dayReserved) { $a++;

			$name = explode('|', $dayReserved);
			if(strlen($name[0])>12){
				$nameCount = substr($name[0],0,10).'...';
			}else{
				$nameCount = $name[0];
			}
                        
            if($name['3']==$list_day){
                $scrolli='div id="scbar"';
                $class='class="scrollbar"';
                $scrolle='</div>';
            }
                             
            $events = mysql_query("SELECT * FROM calendar WHERE id = '".$name[1]."'") or die (mysql_error());
			$events  = mysql_fetch_assoc($events);

			$evenModal = "
			<div id='eventModal".$name[1]."' class='reveal-modal' data-reveal>
					<div class='row panel'>
						<h3 >Details Events :: ".$events['name']."</h3>
						<div class='large-12 columns  radius' >	
							<div class='row'>&nbsp;</div>
							<div class='name-field' style='font-size: 16px !Important'>
								<label style='font-size: 16px !Important'><strong>Description:<strong></label>
								<p class='text-justify' style='font-size: 16px !Important'>".$events['description']."</p>
							</div>
							<div class='row'>&nbsp;</div>
							<div class='email-field'>
								<label style='font-size: 16px !Important'><strong>Date and Time:<strong></label>
								<p class='text-left' style='font-size: 16px !Important'>".$events['date_ini']."</p>
							</div>
							<div class='row'>&nbsp;</div>
							<div class='email-field'>
								<label style='font-size: 16px !Important'><strong>Location:</strong></label>
								<p class='text-left' style='font-size: 16px !Important'>".$events['location']."</p>
							</div>
						</div>
					</div>
					<a class='close-reveal-modal'>&#215;</a>
				</div>
				";


			if (($name['2']) >= (date("Y-m-d H:i:s"))) {
				//$onclick= "onclick='window.location.href=\"?current=eventsDetails&id=".$name[1]."\"'";
				$activitiesInDay.="<span title='New events' class='radius label' data-reveal-id='eventModal".$name[1]."' style='cursor:pointer;margin: 3px 0;' $onclick>".$nameCount."</span><br>";
				$activitiesInDay.= $evenModal;
			}else{
				//$onclick= "onclick='window.location.href=\"?current=eventsDetails&id=".$name[1]."\"'";
				$activitiesInDay.="<span title='Past events' class='radius label' data-reveal-id='eventModal".$name[1]."' style='cursor:pointer;margin: 3px 0; background-color: #BA6100' $onclick>".$nameCount."</span><br>";
				$activitiesInDay.= $evenModal;
			} 
		}

		//$selectedDay= @in_array($list_day,)?'selected':'';
	    //$onclick= "onclick='window.location.href=\"?current=events&id\"'";
		$valid=(date('m')==$month && $list_day <= date('d'))?"calendar-day-np":"calendar-day";
		$back=(date('m')==$month && $list_day <= date('d'))?"":"style='background:#FFF; cursor:default'";
		$calendar.= "<td class='$valid $selectedDay' $back >";
			/* add in the day number */
			$calendar.= '<div class="day-number" >'.$list_day.'</div>';
                        $calendar.= ($a>1)?"<".$scrolli." ".$class.">":''; 
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= $activitiesInDay;//str_repeat('<p> </p>',2);
			$calendar.= $scrolle?$scrolle:'';
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

function regex($name){
	switch($name){
		case 'youtubelong'	:return '/\bhttps?:\\/\\/((m\\.|www\\.)?(youtube\\.com\\/)(embed\\/|watch\\?(.*&)*(v=))(.{11}).*)\b/i';

		case 'youtube'		:return '/\bhttps?:\\/\\/((m\\.|www\\.)?(youtube\\.com\\/)(embed\\/|watch\\?(.*&)*(v=))(.{11})|(youtu\\.be\\/(.{11}))).*\b/i';//code=7&9

		case 'vimeo'		:return '/\bhttps?:\\/\\/(((vimeo\\.com\\/)))((.{8,}))\b/i';//code=5

		case 'video'		:return '/\bhttps?:\\/\\/(vimeo\\.com\\/.{8,}|youtu\\.be\\/.{11}.*|(m\\.|www\\.)?youtube\\.com\\/(.+)(v=.{11}).*)?\b/i';//video=1

		default				:return '/.*/i';
	}
}

function isVideo($type,&$value){
	if($type=='youtube')
		return preg_match(regex('youtube'),$value);
	elseif($type=='vimeo')
		return preg_match(regex('vimeo'),$value);
}

function listar_directorios_ruta($ruta){ 
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) {
   	 
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios
             //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta .'/'. $file); 
             //  echo "<br>Ruta: $ruta / $file";
            if (is_dir($ruta.'/'.$file) && $file!="." && $file!=".."){ 

               //solo si el archivo es un directorio, distinto que "." y ".." 
               //echo "<br>Directorio: $ruta/$file"; 
               $var[] = $file;
               //listar_directorios_ruta($ruta.'/'.$file); 
            } 
         } 
      closedir($dh); 
      } 
   }else 
      $var = "<br>Isn't a valid path.";

   return $var;
}

function eliminarDir($carpeta){
	foreach(glob($carpeta."/*") as $archivos_carpeta){ 
	//echo $archivos_carpeta."<br>";
		if (@is_dir($archivos_carpeta))	{
			eliminarDir($archivos_carpeta);
			// echo 'dir '.$archivos_carpeta."<br>";
		}else	{
			if(($file = @readdir($carpeta)) !== false) {
				//echo 'arc '.$archivos_carpeta."<br>";	
			
				@unlink($archivos_carpeta);
			}
		}
	}@rmdir($carpeta);
}

// function SureRemoveDir($dir, $DeleteMe) {
//     if(!$dh = @opendir($dir)) return;
//     while (false !== ($obj = readdir($dh))) {
//         if($obj=='.' || $obj=='..') continue;
//         if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
//     }

//     closedir($dh);
//     if ($DeleteMe){
//         @rmdir($dir);
//     }
// }

?>