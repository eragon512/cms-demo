<?php
	function load_database() {
		//Please enter the following credentials - (servername,username,password,database-name)
		return mysqli_connect("localhost","root","","cms-demo");
	}