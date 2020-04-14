<?php
	if(!isset($_SESSION)){ 
        session_start(); 
        session_cache_expire();
    }
	
	include("header.php");
	include("session.php");
	include("menu.php");
?>