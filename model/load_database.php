<?php
	function load_database() {
		return mysqli_connect("localhost","root","","cms-demo");
	}