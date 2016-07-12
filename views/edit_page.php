<?php
	require_once("../model/page_functions.php");
	require_once("../model/layout_functions.php");
	require_once("../model/panel_functions.php");
	//require_once("../model/block_functions.php");
	if(!isset($_GET["page_id"])) {
		die("No page id found");
	}
	$page_id = $_GET["page_id"];
	if(!($page = load_page($page_id))) {
		die("Invalid Page Id");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		store_page_data($page["page_id"],$page["layout_id"],$_POST);
	}
	//$block_list = load_block_list();
	$block_list = array(0 => '1');
?>

<!DOCTYPE html>
<html>
	<head>
		<style>
			html,body {
				height: 100%;
				width : 100%;
				max-height: 100%;
				max-width: 100%;
			}
			body {
				display: flex;
			}
			.wrapper {
				height: 100%;
				width: 100%;
				display: flex;
			}
			.horizontal-wrapper {
				flex-direction: row;
			}
			.vertical-wrapper {
				flex-direction: column;
			}
			.panel {
				box-sizing: border-box;
				border: 1px solid red;
			}
			.panel-content {
				max-height: 100%;
				max-width: 100%;
				height: 100%;
				width: 100%;
				overflow: auto;
			}
			textarea {
				max-width: 100%;
				max-height: 100%;
				min-width: 80%;
				min-height: 80%;
			}
		</style>
	</head>
	<body>
		<?php
			load_panel($page["layout_id"],"page-edit",$page["page_id"]);
			var_dump($panel_tracker);
		?>
	</body>
	<script>
		function setAttributes(el, options) {
			Object.keys(options).forEach(function(attr) {
				el.setAttribute(attr, options[attr]);
			});
		};

		function newElement(element,options) {
			var newElement = document.createElement(element);
			setAttributes(newElement,options);
			return newElement;
		};

		var block_button_visited = [];		
		function show_block_list(panel_id) {
			if(block_button_visited.indexOf(panel_id) != -1) {
				return;
			} else {
				block_button_visited.push(panel_id);
			}
			var block_button = document.getElementById(panel_id);
			var select_block = newElement('select',{"name" : "block["+panel_id+"]"});
			var select_block_options =  <?php echo json_encode($block_list); ?> ;
			select_block_options.forEach( function(block_item) {
				block_option = newElement('option',{"value": block_item});
				block_option.innerHTML += block_item;
				select_block.appendChild(block_option);
			});
			block_button.parentNode.appendChild(select_block);
		}
		function add_block_data(panel_id) {
			panel_textarea = document.getElementsByTag('textarea').getElementsByName(panel_id);
		}
	</script>
</html>