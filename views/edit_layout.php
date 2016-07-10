<?php
	require_once("../model/panel_functions.php");
	require_once("../model/layout_functions.php");
	if(!isset($_GET["layout_id"])) {
		die("No layout id found");
	}
	$layout_id = $_GET["layout_id"];
	if(!($layout = load_layout($layout_id))) {
		die("Invalid layout Id");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		split_panel($layout_id,$_POST["panel_id"],$_POST["cut_direction"],$_POST["height_width"]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			html,body {
				height: 100%;
				width : 100%;
				position: absolute;
				display: table;
				margin: 0;
				padding: 0;
			}
			body {
				display: flex;
			}
			.panel {
				border: 1px solid red;
				margin: -1px;
				padding: -1px;
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
		</style>
	</head>
	<body>
		<?php load_panel($layout_id,"layout-edit",NULL); ?>
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

		var split_panel_called = [];
		var split_panel = function(panel_id) {
			if(split_panel_called.indexOf(panel_id) != -1) {
				return;
			} else {
				split_panel_called.push(panel_id);
			}
			console.log(panel_id);
			var panel = document.getElementById(panel_id);
			
			var sub_panels_form = newElement('form',{"action": "", "method": "POST"});

			var layout_id = newElement('input',{"type": "hidden","name": "layout_id", "value": <?php echo $layout_id; ?> });
			var panel_id = newElement('input',{"type": "hidden","name": "panel_id", "value": panel_id});

			var horizontal_split = newElement('input',{"type": "radio", "name": "cut_direction", "value": "horizontal"});
			var vertical_split = newElement('input',{"type": "radio", "name": "cut_direction", "value": "vertical"});
			var specify = newElement('input',{"type": "number", "name": "height_width", "min": 0, "max": 100});
			var submitButton = newElement('button',{"type": "submit"});
			submitButton.innerHTML = "Split Panel";

			sub_panels_form.appendChild(layout_id);
			sub_panels_form.appendChild(panel_id);
			sub_panels_form.appendChild(horizontal_split);
			sub_panels_form.innerHTML += "horizontal";
			sub_panels_form.appendChild(vertical_split);
			sub_panels_form.innerHTML += "vertical";
			sub_panels_form.innerHTML += "\n<br>specify height/width: ";
			sub_panels_form.appendChild(specify);
			sub_panels_form.appendChild(submitButton);
			panel.appendChild(sub_panels_form);
		};
	</script>
</html>