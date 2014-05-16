<?php

if($_GET['type']!=''){
	$content_type = mysql_query("SELECT * FROM content_type WHERE id = '".$_GET['type']."' ") or die (mysql_error());
	$content_type = mysql_fetch_assoc($content_type);

	//borrando carpetas residuales
	$old='new'.date('YmdHis',time()-6*60*60);
	echo $elemento.'<br/>';
	$path='../img/'.$content_type['folder'];
	$dir=opendir($path);
	while($elemento=readdir($dir)){ 
		if(preg_match('/^new\d+$/i',$elemento)&&$elemento<$old){
			deleteDir('../img/'.$content_type['folder'].'/'.$elemento,true);
			deleteDir('../img/.thumbs/'.$content_type['folder'].'/'.$elemento,true);
		}
	}
	//fin borrado carpetas

	if($_GET['id']!=""){
		deleteDir('../img/'.$content_type['folder'].'/'.$_GET['id'], true);
		deleteDir('../img/.thumbs/'.$content_type['folder'].'/'.$_GET['id'], true);
		mysql_query("DELETE FROM contents WHERE id = '".$_GET['id']."' and id_type = '".$_GET['type']."'") or die (mysql_error());
		mensajes('Info!','The '.rtrim($content_type['name'],'s').' was deleted');
	}

	if($_POST['action']=='add'){//insert
		//_imprimir($_POST);
		mysql_query("
			INSERT INTO contents SET
				id_status = '".$_POST['status']."',
				name = '".$_POST['name']."',
				summary = '".$_POST['resumen']."',
				text = '".$_POST['des']."',
				id_type = '".$_GET['type']."'	
		") or die (mysql_error());
		$id=mysql_insert_id();
		mensajes('Info',"Successful insertion process.");
	}
	if ($_POST['action']=='update'){ //update
		mysql_query("
			UPDATE contents SET 
				id_status = '".$_POST['status']."',
				summary = '".$_POST['resumen']."',
				text = '".$_POST['des']."',
				name = '".$_POST['name']."'
			WHERE id = '".$_POST['id']."' and id_type = '".$_GET['type']."'
		") or die (mysql_error());
		@mkdir('../img/'.$content_type['folder'].'/'.$_POST['id'], 0777, true);

		mensajes('Info',"Successful update process.");	
	}

	$_pagi_cuantos         = 12;
    $_pagi_nav_num_enlaces = 4;
    $_pagi_sql             = 'SELECT * FROM contents where id_type = "'.$_GET['type'].'" ORDER BY name';

	include('../includes/paginator.inc.php');
?>

<link media="screen" rel="stylesheet" href="../css/paginator.css" />

<fieldset>
	<legend><?=$content_type['name']?> Update </legend>

<table class=" large-12 columns">
<thead>
	<tr>
		<th>Name</th>
		<th>Summary</th>
		<th width="110">Status</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
	<?php while ($content = mysql_fetch_assoc($_pagi_result)){ ?>
	<tr>
	    <td><?=$content[name]?></td>
	    <td><?=substr($content[summary],0,40)?>...</td>
	    <td><?=campo('status','id',$content['id_status'],'name')?></td>
	    <td>
	    	<?php if($_GET['type']!=1){?>
			<a href="?type=<?=$_GET['type']?>&id=<?=$content['id']?>&url=views/video.php"> <img src="../img/video.png" width="16" title="Video." /></a>
			<?php } ?>
			<a href="?type=<?=$_GET['type']?>&id=<?=$content['id']?>&url=views/galeria.php"> <img src="../img/photo.png" width="16" title="Photos." /></a>
			<a href="?type=<?=$_GET['type']?>&id=<?=$content['id']?>&url=views/contents/add.php"><img src="../img/editar.png" width="16" title="Update."  />
			<a href='#' data-reveal-id="services_<?=$content['id']?>">
				<img src="../img/salir.gif" width="16" title="Delete."/>
	        </a>
			<div id='services_<?=$content['id']?>' class='reveal-modal small' data-reveal>
				<h3><small>Are you sure to delete this <?=rtrim($content_type['name'],'s');?>?</small></h3>
				<p><?=$content[name]?></p>
				<a href='?type=<?=$_GET['type']?>&url=<?=$_GET['url']?>&id=<?=$content['id']?>' class='small radius button'>Yes</a>
				<a class='close-reveal-modal'>&#215;</a>
			</div>	
		</td>
	</tr>
	<?php } ?>
</tbody>
</table>

<?php echo $_pagi_navegacion,$_pagi_info; ?>
</fieldset>
<?php
}else{
	mensajes('Alert!','Sorry this content can\'t be loaded');
}
?>