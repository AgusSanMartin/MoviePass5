<?php
		/* echo '
		<!DOCTYPE html>
		<html>
		  <head>
			<link rel="stylesheet" type="text/css" href="'.HOST_URL.'views/style.css"/>
		    <title>Cerveceria</title>

		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		    </head>
		    <body>'
		    ; */
		if(isset($_SESSION['cuenta']))
		{
			if ($_SESSION['cuenta']->getPrivilegios()==0)
			{
				require_once 'navAdm.php';
				
			}else if ($_SESSION['cuenta']->getPrivilegios()==2)
			{
				require_once "navCliente.php";
			}
			else if ($_SESSION['cuenta']->getPrivilegios()==1)
			{
				require_once "cine.php";
			}
		}

/* echo "</body>"; */
?>
