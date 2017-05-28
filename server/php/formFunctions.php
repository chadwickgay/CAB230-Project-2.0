<?php

	// Create a label tag for the name of a form
	function createLabel($id, $labelName) {
		echo "<label for='$id'>$labelName</label>";
	}

	// Create an error tag using the HTML span tag
	function createErrorLabel($errorMessageBox) {
		echo "<span id=\"$errorMessageBox\"></span>";
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
	function createInputField($type, $placeholder, $name, $id, $labelName, $errorMessageBox, $formName) {
		createLabel($placeholder, $labelName);
		$value = createPostedValue($name);
		echo "<input type=\"$type\" placeholder=\"$placeholder\" name=\"$name\" id=\"$id\" value=\"$value\" ",
			 "onkeypress=\"resetErrorState('$name', '$errorMessageBox', '$formName')\" />";
		echo "<br>";
		createErrorLabel($errorMessageBox);
	}

	// Create an option list with the select tag and appropriate attributes
/*
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
*/

/*
            <label for="gender">Gender</label>
            <select class="gender-select" name="gender" id="gender">
                <option selected value="DEFAULT" disabled style="display: none;">select</option>
                <option <?php echo posted_value('gender') == 1 ? 'selected' : '' ?> value="1">Male</option>
                <option <?php echo posted_value('gender') == 2 ? 'selected' : '' ?> value="2">Female</option>
                <option <?php echo posted_value('gender') == 3 ? 'selected' : '' ?> value="3">Other</option>
                <option <?php echo posted_value('gender') === 0 ? 'selected' : '' ?> value="0">Undisclosed</option>
            </select>
            <br>
            <span id="genderErr"></span>
*/

function createSelectField($id, $labelName, $name, $errorSpanID, $options, $formName) {
    createLabel($id, $labelName);

    echo "<select id='$id'name='$name' onkeypress='resetErrorState('$name', '$errorSpanID', '$formName')'>";
        echo "<option selected value='DEFAULT' disabled class=\"hidden\">select</option>";

        for ($i = 0; $i < count($options); $i++){
            echo "<option value='$i'>$options[$i]</option>";
        }

    echo "</select>";
    echo "<br>";
    echo "<span id=\"$errorSpanID\"></span>";
}
?>