<?php
	session_start();
	include("conexion.php");
	$s=mysql_query("SELECT email, user, idUser FROM membresias, web_users WHERE membresias.idUser = web_users.id AND membresias.idMem = '$_REQUEST[idmem]'");
	
	$_REQUEST[titulo]=utf8_decode($_REQUEST[titulo]);
	$_REQUEST[cuerpo]=utf8_decode($_REQUEST[cuerpo]);
	
	$res= mysql_fetch_array($s);
	$email_to = $res[0];
	$user_to = $res[1];
	$idUser_to = $res[2];
	require("clases/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->Host = "localhost";
	$mail->From = "no-replay@tiempocompartido.com";
	$mail->FromName = "Tiempocompartido.com";
	$mail->Subject = "Tienes un Nuevo Mensaje en tiempocompartido.com - $_REQUEST[titulo]";
	$mail->AddAddress("$email_to","$user_to");
	$body  = "
	<div><a href='http://www.tiempocompartido.com/index.php'><img src='http://www.tiempocompartido.com/images/tiempo-compartido-logo.gif' border='0'></a></div>
	Hola <strong>$user_to,</strong><br><br>";	
	$body .= "Tu <a href='http://www.tiempocompartido.com/contenido.php?id=$_REQUEST[idmem]'>Membresia publicada</a> en <a href='http://www.tiempocompartido.com/index.php'>tiempocompartido.com</a> ha recibido el siguiente NUEVO comentario:<br><br>
	Enviado por el usuario: $_SESSION[k_username]<br>
	Con el Titulo: $_REQUEST[titulo]<br>
	Mensaje: $_REQUEST[cuerpo]<br>------------------------------------------------------------------------------------------<br><br>";
	$body .= "Para RESPONDER y PUBLICAR tu respuesta solo <a href='http://www.tiempocompartido.com/responder-email.php?id_from=$_SESSION[k_id]&idmem=$_REQUEST[idmem]'>clic aquí</a><br><br>";
	$body .= "<br><br>O ingresando a tu cuenta, en la pestaña del Menu de Usuarios da clic en

Mi Bandeja  y podras consultar, responder o eliminar todos tus mensajes recibidos.<br><br>



Gracias por tu confianza y utilizar nuestros servicios.<br><br><a href='http://www.tiempocompartido.com/index.php'>tiempocompartido.com</a>
<br>

------------------------------------------------------------------------------------------
<br>
IMPORTANTE: No responder a este email. Esta direccion NO llegará a ningún destinatario.<br>
-------------------------------------------------------------------------------------------
	";	
	$mail->Body = $body;
	$mail->AltBody = "
	<div><a href='http://www.tiempocompartido.com/index.php'><img src='http://www.tiempocompartido.com/images/tiempo-compartido-logo.gif'></a></div>
	Has recibido el siguiente mensaje por el usuario: $_SESSION[k_username] desde nuestro sitio <a href='http://www.tiempocompartido.com/index.php'>Tiempocompartido.com</a> referente a <a href='http://www.tiempocompartido.com/contenido.php?id=$_REQUEST[idmem]'>tu publicacion.</a>
 Subject: $_REQUEST[titulo], Cuerpo del mensaje: $_REQUEST[cuerpo], Para contestar este mensaje sigue el siguiente enlace: <a href='http://www.tiempocompartido.com/responder-email.php?id_from=$_SESSION[k_id]&idmem=$_REQUEST[idmem]'>Responder email</a> <font color='blue'>Saludos</font>";
	$mail->Send();
	mysql_query("INSERT INTO emails_enviados(`titulo`,`cuerpo`,`id_envia`,`id_recibe`,`categoria`,`email_envia`,`email_recibe`,`idMem`) VALUES ('$_REQUEST[titulo]','$_REQUEST[cuerpo]','$_SESSION[k_id]','$idUser_to','pregunta','$_SESSION[k_email]','$email_to','$_REQUEST[idmem]') ");
	echo"Mensaje enviado!";
?>

