<?php

	$empresas = mysql_query("SELECT * FROM company WHERE id = '1'") or die (mysql_error());
	$empresa  = mysql_fetch_assoc($empresas);

	if ($_POST['email']!=''){	
		//include ("class/class.phpmailer.php");	
		//
		//	 
		
		$_date=explode('-',$_POST['date']);

		$_date=$_date[2].'-'.$_date[0].'-'.$_date[1];


		mysql_query("INSERT INTO  `reservations` (`id` ,`pakage` ,`date` ,`name` ,`email` ,`note`,`phone`)
				VALUES (
				NULL ,  '".$_POST['pakage']."', 
				        '$_date',  
				        '".cls_string($_POST['name'])."',  
				        '".cls_string($_POST['email'])."',  
				        '".cls_string($_POST['note'])."',
				        '".cls_string($_POST['phone'])."' );") or die (mysql_error());
	 
		$body  = '
			<html>
			<body><table width="500" border="0" align="center" cellpadding="2" cellspacing="2" style="font-size:11px; border:1px solid #CCC; font-family:Tahoma, Geneva, sans-serif; background-color:#FFF">
			<tr>
			<td style="font-size:16px; font-weight:bold; color:#000; background-color:#CCC">
			<img src="'.DOMINIO.'img/top_mail.jpg" width="500" height="72" border="0"  />
			</td>
			</tr>
			<tr>
			<td style="font-size:12px">Services Contact.</td>
			</tr>
			<tr>
			<td style="font-size:12px; font-weight:bold; background-color:#f4f4f4">Contact Info</td>
			</tr>
			<tr>
			<td><strong>Name and Last Name:</strong> '.cls_string($_POST['name']).'</td>
			</tr>
			<tr>
			<td><strong>Email and Phone:</strong> '.$_POST['email'].' ('.$_POST['phone'].')'.'</td>
			</tr>
			<tr>
			<td><strong>Message:</strong> '.cls_string($_POST['note']).' <br> * Pakage: '.cls_string($_POST['pakage']).' <br> * Date: '.cls_string($_POST['date']).'</td>
			</tr>
			<tr>
			<td style="background-color:#f4f4f4; text-align:center">Generated by: <a href="http://maoghost.com/">maoghost.com</a></td>
			</tr>
			</table></body>
			</html>
		';
		
		$list = array($empresa[email],$_POST[email]);
		for ($i=0;$i<count($list);$i++){				 
			$owner_email = $list[$i];//$_POST[email];
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: '.cls_string($_POST['name']).' <'.$owner_email.'>' . "\r\n";
			$headers .= 'From: '.$empresa['name'].' <'.$empresa['email'].'>' . "\r\n";
			$subject = 'A message from '.$empresa['name'].' Corporate Web ' . $_POST['name'];
			$messageBody = $body;
			//if($_POST["stripHTML"] == 'true'){
				//$messageBody = strip_tags($messageBody);
			//}
			try{
				if(!mail($owner_email, $subject, $messageBody, $headers)){
					mensajes("Error!", "We can not send your email, please try again!");
					break;
				}else{
					$paso = true;
				}
			}catch(Exception $e){
				echo $e->getMessage() ."\n";
				break;
			}
		}//for
		
		mensajes("Process Successfully.", "Message sent Successfully, our team will call you soon");
	}//if sumito
	 
?>

<div class="row panel" > 
	<div class="large-12 columns ">	
	<?php
	if($_GET['date']==''&&$_GET['pakage']==''){
		echo "<h3>Select a date <small>(Step 1 of 3)</small></h3>";
		
		
		
		echo draw_calendar_e($_GET['next']);
	}	
	
	if($_GET['date']!=''&&$_GET['pakage']==''){
		echo "<h3>Select a Pakage <small>(Step 2 of 3)</small></h3>";
		
		?>
		<div class="row">
			<ul class="inline-list">
				
				<li class="label secondary radius" >Date: <em><?=  str_replace("-","/",$_GET['date'])?></em> <a class=" button radius tiny" href="?current=booking">Change</a></li>
				
			</ul>
			 
			
		</div>
		<div class="row">
			<ul class="small-block-grid-3">
			<?php
			$date=explode("-",$_GET['date']);
			
			$price=date("N", mktime(0, 0, 0, $date[0],$date[1], $date[2]))>4?2:'';
			
			
			$packages = mysql_query("SELECT id, name, price$price, des, city, maxchi FROM package where id_status = '1' ORDER BY price") or die (mysql_error());

				

				while ($package = mysql_fetch_assoc($packages)){

					
					$facility_type=mysql_query("SELECT id, name FROM type_facilities WHERE id_status='1'")or die(mysql_error());
					$_facilities='';
					while ($_type = mysql_fetch_assoc($facility_type)){

						$facilities=mysql_query("SELECT fp.id_faci FROM package_facilities fp inner join facilities f on f.id= fp.id_faci WHERE fp.id_pack='".$package["id"]."' and f.id_type='".$_type["id"]."'")or die(mysql_error());
						
						$_cont=0;	
						while ($_facility = mysql_fetch_assoc($facilities)){
							$_facilities.=$_cont==0?"<br>*".$_type["name"].' (':'';
							$_facilities.=campo("facilities","id", $_facility["id_faci"], "name").", ";
							$_cont++;
						}
						$_facilities=$_cont!=0?rtrim($_facilities,", ").")":'';
					}	

			?>

			<li >
				<ul class="pricing-table">
					<li class="title"><?=  ucfirst($package['name']) ?></li>
					<li class="price">$<?= $package["price$price"]?></li>
					<li class="description"><?=$package['des']?></li>
					<li class="bullet-item">City: <em><?=ucfirst($package['city'])?></em> , Children allowed: <em><?=$package['maxchi']?></em></li>
		 			<?php if ($_facilities!='') {?>
		 			<li class="bullet-item">Facilities: <?=$_facilities?></li>
		 			<?php }?>
	<!--				<li class="bullet-item">20 Users</li>-->
					<li class="cta-button"><a class="button radius" href="?current=booking&date=<?=$_GET['date']?>&pakage=<?=$package['id']?>">Book Now</a></li>
				</ul>
			</li>
			<?php		
				}//type_facilities	
			?>
			</ul>
		</div>
		<?php	
	}	
	
	if($_GET['date']!=''&&$_GET['pakage']!=''){
		echo "<h3>Your Info <small>(Step 3 of 3)</small></h3>";
		 $package = mysql_query("SELECT name FROM package where id= '".$_GET['pakage']."'") or die (mysql_error());

		 $package = mysql_fetch_assoc($package);
		?>


		<div class="row" >
			<ul class="inline-list">
				
				<li class="label secondary radius" >Date: <em><?=  str_replace("-","/",$_GET['date'])?></em> <a class=" button radius tiny" href="?current=booking">Change</a></li>
				<li class="label secondary radius" >Pakage: <em><?= $package['name']?></em> <a class=" button radius tiny" href="?current=booking&date=<?=$_GET['date']?>">Change</a></li>
				
			</ul>
			<form action="?current=booking" method="post" data-abide>
				<div class="nombre-field large-8 columns">
					<label>Full Name: <small>required</small></label>
					<input type="text"  name="name" id="name"  required/>
					<small class="error">Name is required.</small>
				</div> 
				<div class="mail-field large-6 columns">
					<label>Email: <small>required</small></label>
					<input type="email"  name="email" id="email"  required/>
					<small class="error">Email is required.</small>
				</div> 
				<div class="phone-field large-6 columns">
					<label>Phone Number: <small>required</small></label>
					<input type="text"  name="phone" id="phone"  required/>
					<small class="error">Phone Number is required.</small>
				</div> 
				<div class="note-field large-12 columns">
					<label>Note: </label>
					<textarea name="note" id="note" ></textarea>
				</div>
				<div class=" large-12 columns">
					<button type="submit">Submit</button>
				</div>
				<input type="hidden" name="pakage" value="<?=$package['name']?>">
				<input type="hidden" name="date" value="<?=$_GET['date']?>">			
			</form>
		</div>
		<?php
		
	}
	?>
	</div>
</div>	