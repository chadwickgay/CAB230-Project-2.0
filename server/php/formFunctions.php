<?php

	// Create a label tag for the name of a form
	function createLabel($for, $labelName) {
		echo "<label for='$for'>$labelName</label>";
	}

	// Create an error tag using the HTML span tag
	function createErrorLabel($for) {
		echo "<span for='$for'</span>";
	}

	// Create and assign the value attribute with the appropriate POST name
	function createPostedValue($name) {
		if (isset($_POST["$name"])) {
			return "".htmlspecialchars($_POST[$name]);
		} else {
			return "";
		}
	}
	
	// Create an input field with appropriate attributes for a HTML5 form
	function createInputField($type, $id, $name, $labelName, $placeholder, $error, $formName) {
		createLabel($placeholder, $labelName);
		$value = createPostedValue($name);
		echo "<input type='$type' id='$id' name='$name' ",
			 "placeholder='$placeholder' value='$value' ",
			 "onKeyPress='$name', '$error', '$formName' />";
		echo "<br>";
		createErrorLabel($name);
	}

	// Create an option list with the select tag and appropriate attributes
	function createSelectField($for, $class, $id, $labelName, $options, $values, $default, $error) {
		createLabel($for, $labelName);
		echo "<select class='$class', id='$id', name='$for'>";
		echo "<option selected value='DEFAULT' disabled style='display: none;'>$default</option>";		
		
		define('MAX_OPTIONS', 4);
		for($optionIndex = 0; $optionIndex <= MAX_OPTIONS; $optionIndex++) {
			echo '<option value="'.$values[$optionIndex].'">'.$options[$optionIndex].'</option>';
		}
		
		echo "</select>";
	}

?>