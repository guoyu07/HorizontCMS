<?php

	if(php_sapi_name()!="cli"){

	  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	  $root = $protocol.$_SERVER['HTTP_HOST'];

	  $server_root = str_replace(DIRECTORY_SEPARATOR,"/",$_SERVER['DOCUMENT_ROOT']);
	  $get_cwd = str_replace(DIRECTORY_SEPARATOR,"/",getcwd());

	  $path = str_replace($server_root,"",$get_cwd)."/";

	  if($path[0] != "/"){
	  	$root .= "/";
	  }

	  $root .= $path;


	  DEFINE ('BASE_URL',$root);

	}else{
	  DEFINE ('BASE_URL',"");	
	}


  ?>