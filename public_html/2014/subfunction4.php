<?php

	@$nombre1 = addslashes($_POST["nombre"]);
	@$apellido1 = addslashes($_POST["apellido"]);
	@$email1 = addslashes($_POST["email"]);
  
  	

	$_name=$_FILES["filead"]["name"];
	$_type=$_FILES["filead"]["type"];
	$_size=$_FILES["filead"]["size"];
	$_temp=$_FILES["filead"]["tmp_name"]; 

	$num = md5(time());

  	$email = "webadmin@geomundus.org";
  	$emailP = "submissions@geomundus.org";
  	$titulo = 'Geomundus 2014 Submision';
  	$mensaje = "A submision has been received \r \n"

  	. "\r \n"
  	. "Name: $nombre1 \r \n"
  	. "Surname: $apellido1 \r\n"
	. "Email: $email1 \r \n"
	. "\r \n";

  	if( strcmp($_name, "") ) //FILES EXISTS
	{ 
		$fp = fopen($_temp, "rb");
		$file = fread($fp, $_size);
		$file = chunk_split(base64_encode($file)); 
	}


	$headers = "From: Geomundus 2014 Web Team \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: multipart/mixed; "; 
	$headers .= "boundary=".$num."\r\n";
	$headers .= "--".$num."\n"; 


	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
	$headers .= "".$mensaje."\n";
	$headers .= "--".$num."\n"; 
  	
	$headers .= "Content-Type:application/octet-stream "; 
	$headers .= "name=".$_name." \r\n";
	$headers .= "Content-Transfer-Encoding: base64\r\n";
	$headers .= "Content-Disposition: attachment; ";
	$headers .= "filename=\"".$_name."\"\r\n\n";
	$headers .= "".$file."\r\n";
	$headers .= "--".$num."--"; 
   	

	@mail($emailP, $titulo, $mensaje, $headers);
  if (@mail($email, $titulo, $mensaje, $headers))
  {

  	header("Location: submit_exito.php"); 
  	//die("$nombre1 $apellido1 $email1 Gracias, su mensaje se envio correctamente.");
  }else
	{
		//Si el mensaje no se envía muestra el mensaje de error
		die("$nombre1 $apellido1 $email1 Error: Su información no pudo ser enviada, intente más tarde");
  	}

	






?>