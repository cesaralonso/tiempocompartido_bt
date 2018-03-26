<?php
	session_start();
	include("conexion.php");

$s=mysql_query("SELECT user,email FROM web_users WHERE id= '$_GET[idUser_from]'");
$r=mysql_fetch_row($s);
	$email_to = $_POST['email'];
	$user_to = $r[0];
	$idUser_to = $_GET['idUser_from'];
	
	$idUser_envia=$_POST['id_envia'];
	
$s2=mysql_query("SELECT user,email FROM web_users WHERE id= '$_POST[id_envia]'");
$r2=mysql_fetch_row($s2);
 $email_from = $r2[1];
	
	
	$_POST[comentarios_email]=utf8_decode($_POST[comentarios_email]);
	$_POST[nombre_email]=utf8_decode($_POST[nombre_email]);
	
	
	require("clases/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->Host = "localhost";
	$mail->From = "no-replay@tiempocompartido.com";
	$mail->FromName = "Tiempocompartido.com";
	$mail->Subject = "Tienes un Nuevo Mensaje en tiempocompartido.com - $_POST[nombre_email]";
	
	$mail->AddAddress("$email_to","$user_to");
	
	$body  = "
	<div><a href='http://www.tiempocompartido.com/index.php'><img src='http://www.tiempocompartido.com/images/tiempo-compartido-logo.gif' border='0'></a></div>
	Hola <strong>$user_to,</strong><br>";	
	$body .= "Tu <a href='http://www.tiempocompartido.com/contenido.php?id=$_REQUEST[idmem]'>Membresia publicada</a> en <a href='http://www.tiempocompartido.com/index.php'>tiempocompartido.com</a> ha recibido el siguiente NUEVO mensaje:<br><br>
	Enviado por el usuario: $_SESSION[k_username]<br>
	Con el Titulo: $_POST[nombre_email]<br>
	Mensaje: $_POST[comentarios_email]<br>------------------------------------------------------------------------------------------<br><br>";
	$body .= "<br>Para RESPONDER y PUBLICAR tu respuesta solo <a href='http://www.tiempocompartido.com/responder-email.php?id_from=$_SESSION[k_id]&idmem=$_REQUEST[idmem]'>clic aquí</a>";
	$body .= "<br><br>O ingresando a tu cuenta, en la pestaña del Menu de Usuarios da clic en
Mis Mensajes y podras consultar, responder o eliminar tus mensajes recibidos.<br><br>
Gracias por tu confianza y utilizar nuestros servicios.<br><br><a href='http://www.tiempocompartido.com/index.php'>tiempocompartido.com</a>
<br><br>
------------------------------------------------------------------------------------------
<br>
IMPORTANTE: No responder a este email. Esta direccion NO llegará a ningún destinatario.<br>
-------------------------------------------------------------------------------------------
	";
	$mail->Body = $body;
	$mail->AltBody = "Has recibido el siguiente mensaje por el usuario: $_SESSION[k_username] desde nuestro sitio <a href='http://www.tiempocompartido.com/index.php'>Tiempocompartido.com</a> referente a <a href='http://www.tiempocompartido.com/contenido.php?id=$_GET[idmem]'>la publicacion.</a>
 Subject: $_GET[nombre_email], Cuerpo del mensaje: $_GET[comentarios_email], Para contestar este mensaje sigue el siguiente enlace: <a href='http://www.tiempocompartido.com/responder-email.php?id_from=$_SESSION[k_id]&idmem=$_GET[idmem]'>Responder email</a> <font color='blue'>Saludos</font>";
	$mail->Send();
	mysql_query("INSERT INTO emails_enviados(`titulo`,`cuerpo`,`id_envia`,`id_recibe`,`categoria`,`email_envia`,`email_recibe`,`idMem`) VALUES ('$_REQUEST[nombre_email]','$_REQUEST[comentarios_email]','$idUser_envia','$idUser_to','respuesta','$email_from','$email_to','$_REQUEST[idmem]') ");

?>
<script lang="javascript">
alert('Mensaje Contestado!');
window.location.href='http://www.tiempocompartido.com/mi-bandeja.php';
</script>