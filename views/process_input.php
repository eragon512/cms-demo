<?php
	
	var_dump($_POST);
	$layout_id = (int)$_POST["layout_id"];
	$panel1["panel_id"] = $panel2["panel_id"] = (int)$_POST["panel_id"];
	$panel1["panel_child_id"] = $panel1["panel_id"]*2;
	$panel2["panel_child_id"] = $panel2["panel_id"]*2 + 1;

	if($_POST["cut_direction"] === "horizontal") {
		$panel1["panel_width"] = $panel2["panel_width"] = 100;
		$panel1["panel_height"] = (int) $_POST["height_width"];
		$panel2["panel_height"] = 100 - $panel1["panel_height"];
		$panel1["panel_class"] = "top";
		$panel2["panel_class"] = "bottom";
	} else if($_POST["cut_direction"] === "vertical") {
		$panel1["panel_height"] = $panel2["panel_height"] = 100;
		$panel1["panel_width"] = (int) $_POST["height_width"];
		$panel2["panel_width"] = 100 - $panel1["panel_width"];
		$panel1["panel_class"] = "left";
		$panel2["panel_class"] = "right";
	} else {
		die("Invalid cut_direction");
	}
	var_dump($panel1);
	var_dump($panel2);

	require("../model/panel_functions.php");
	create_panel($layout_id,$panel1);
	create_panel($layout_id,$panel2);

	header("Location: ../views/edit_layout.php?layout_id=".$layout_id);
