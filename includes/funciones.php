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

		$type= $titulo=="Error!"? "warning":"success";
		
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
	
	list($imgWidth,$imgHeight,$tipo,$imgAttr)=getimagesize($img_original);
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
 
/* draws a calendar */
function draw_calendar($next){
	

	$month = $next==1?(date('m')==12?1:date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")))):date('m');
	$year  = $next==1?(date('m')==12?date('Y')+1:date('Y')):date('Y');
	
	

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar rounded">';

	/* table headings */
	$headings = array('Sun','Mon','Tues','Wednes','Thurs','Fri','Satur');
	$backMonth= $month==date('m')?'':"onclick='window.location.replace(\"?current=booking\");'";
	$nextMonth= $month==date('m')?"onclick='window.location.replace(\"?current=booking&next=1\");'":'';
	$calendar.= '<tr class="calendar-row" >
					<th '.$backMonth.' > <h3>'.($backMonth==''?'':'<').'</h3></th>
					<th colspan="5"> <h3>'.date('F Y',mktime(0, 0, 0, $month, 1, $year)).'</h3></th>
					<th '.$nextMonth.' > <h3>'.($nextMonth==''?'':'>').'</h3></th>';
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

	 
?>