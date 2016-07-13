<?php
	require_once("../model/page_functions.php");
	require_once("../model/layout_functions.php");
	require_once("../model/panel_functions.php");
	require_once("../model/block_functions.php");
	require_once("../model/client_database_functions.php");
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
	$block_list = load_block_list();
	$client_database_query_list = load_client_database_query_list();
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
				min-height: 50%;
			}
		</style>
	</head>
	<body>
		<?php
			load_panel($page["layout_id"],"page-edit",$page["page_id"]);
			//var_dump($panel_tracker);
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
		var block_list = <?php echo json_encode($block_list); ?> ;

		function show_block_list(panel_id) {
			if(block_button_visited.indexOf(panel_id) != -1) {
				return;
			} else {
				block_button_visited.push(panel_id);
			}
			var block_button = document.getElementById(panel_id);
			panel_id = panel_id.replace("add_block_","");
			var select_block = newElement('select',{"name" : "block["+panel_id+"]"});
			var select_block_options = block_list;
			select_block_options.forEach( function(block_item) {
				block_option = newElement('option',{"value": block_item["block_id"]});
				block_option.innerHTML += block_item["block_name"];
				select_block.appendChild(block_option);
			});

			var block_data_button = newElement('button', {"type" : "button", "id": block_button.id.replace("add_block_",""),"onclick": "javascript: add_block_data(this.id)"});
			block_data_button.innerHTML = "Add Block Data";
			block_button.parentNode.appendChild(select_block);
			block_button.parentNode.appendChild(block_data_button);
		}

		function add_block_data(panel_id) {
			panel_textarea = document.getElementById('textarea'+panel_id);
			block_id = document.getElementsByName("block["+panel_id+"]")[0].value;
			//console.log(block_id);
			
			var block = block_list.filter(function(item) { return item.block_id === block_id; })[0];
			if(panel_textarea) {
				if(!panel_textarea.innerHTML || panel_textarea.innerHTML === "") {
					panel_textarea.value = "<block>"+block.block_name+"</block>";
				} else {
					panel_textarea.value += "<block>"+block.block_name+"</block>";
				}
				console.log(panel_textarea.id);
			}
		}

		var query_button_visited = [];
		var query_list = <?php echo json_encode($client_database_query_list); ?> ;

		function show_query_list(panel_id) {
			if(query_button_visited.indexOf(panel_id) != -1) {
				return;
			} else {
				query_button_visited.push(panel_id);
			}
			var query_button = document.getElementById(panel_id);
			panel_id = panel_id.replace("add_query_","");
			var select_query = newElement('select',{"name" : "query["+panel_id+"]"});
			var select_query_options = query_list;
			select_query_options.forEach( function(query_item) {
				query_option = newElement('option',{"value": query_item["client_db_query_id"]});
				query_option.innerHTML += query_item["client_db_query_name"];
				select_query.appendChild(query_option);
			});

			var query_data_button = newElement('button', {"type" : "button", "id": query_button.id.replace("add_query_",""),"onclick": "javascript: add_query_data(this.id)"});
			query_data_button.innerHTML = "Add Query Data";
			query_button.parentNode.appendChild(select_query);
			query_button.parentNode.appendChild(query_data_button);
		}

		function add_query_data(panel_id) {
			panel_textarea = document.getElementById('textarea'+panel_id);
			query_id = document.getElementsByName("query["+panel_id+"]")[0].value;
			//console.log(block_id);
			
			var query = query_list.filter(function(item) { return item.client_db_query_id === query_id; })[0];
			if(panel_textarea) {
				if(!panel_textarea.innerHTML || panel_textarea.innerHTML === "") {
					panel_textarea.value = "<db_query>"+query.client_db_query_name+"</db_query>";
				} else {
					panel_textarea.value += "<db_query>"+query.client_db_query_name+"</db_query>";
				}
				console.log(panel_textarea.id);
			}
		}
	</script>
</html>