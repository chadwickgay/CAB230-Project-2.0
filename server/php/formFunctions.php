<?php

	// Create a label tag for the name of a form
	function createLabel($name, $label) {
		echo "<label for='$name'>$label</label>";
	}

	// Create an error tag using the HTML span tag
	function createErrorLabel($name) {
		echo "<span for='$name'</span>";
	}

	// Create and assign the value attribute with the appropriate POST name
	function createPostedValue($name) {
		if(isset($_POST[$name])) {
			echo "value='htmlspecialchars($_POST[$name])'";
		} else {
			echo "value=''";
		}
	}
	
	function createInputField($type, $name, $placeholder, $error, $formName) {
		createLabel($name, $placeholder);
		$value = createPostedValue($name);
		echo "<input type='$type' id='$name' name='$name' ",
			 "placeholder='$placeholder' value='$value' ",
			 "onKeyPress=\"$name\", \"$error\", \"$formName\" />";
		echo "<br>";
		createErrorLabel($name);
	}

	// Create a form option list with the select tag that includes posted values
	function createSelectField($name, $values) {
		echo "<select id=\"$name\" name=\"$name\">";
		
		foreach ($values as $value => $display) {
			$selected = ($value==posted_value($name))?'selected="selected"':'';
			echo "<option $selected value=\"$value\">$display</option>";
		}
		
		echo '</select>';
	}

?>