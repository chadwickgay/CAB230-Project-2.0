<?php

// Helper function for creating a label tag for the name of a form
function createLabel($id, $labelName) {
    echo "<label for='$id'>$labelName</label>";
}

// Helper function to create an error tag using the HTML span tag
function createErrorLabel($errorMessageBox) {
    echo "<span id=\"$errorMessageBox\"></span>";
}

// Helper function to assign the value attribute with the appropriate POST name
function createPostedValue($name) {
    if (isset($_POST["$name"])) return htmlspecialchars($_POST[$name]);
    return '';
}

// Helper function to create the opening tag for a HTML form element
function createFormOpeningTag($method, $action, $name, $onSubmit) {
	if ($onSubmit == "") {
		echo "<form method=\"$method\" action=\"$action\" name=\"$name\">";
	} else {
		echo "<form method=\"$method\" action=\"$action\" name=\"$name\" onsubmit=\"$onSubmit\">";
	}	
}

// Helper function to create a text area for a HTML form element
function createTextArea($cols, $rows, $name, $id, $placeholder) {
	echo "<textarea cols=\"$cols\" rows=\"$rows\" name=\"$name\" id=\"$id\" placeholder=\"$placeholder\"";
	echo isset($_SESSION['logged']) ? "></textarea>" : " disabled></textarea>";
}
	
// Create an input field with appropriate attributes for a HTML5 form
function createInputField($type, $placeholder, $name, $id, $labelName, $errorMessageBox, $formName, $usePost = true) {
    createLabel($id, $labelName);
    $value = $usePost ? createPostedValue($name) : '';
    echo "<input type=\"$type\" placeholder=\"$placeholder\" name=\"$name\" id=\"$id\" value=\"$value\" ", "onkeypress=\"resetErrorState('$name', '$errorMessageBox', '$formName')\" />";
    echo "<br>";
    createErrorLabel($errorMessageBox);
}

// Create a option list with the select tag and appropriate attributes
function createSelectField($id, $labelName, $name, $errorSpanID, $options, $formName) {
    createLabel($id, $labelName);
    echo "<select required id=\"$id\" name=\"$name\" onChange=\"resetErrorState('$name', '$errorSpanID', '$formName')\">";
    echo "<option selected label = 'select' value='' disabled class=\"hidden\"></option>";

    for ($i = 0; $i < count($options); $i++) {
        $selected = $i == (ctype_digit(createPostedValue($name)) ? intval(createPostedValue($name)) : -1) ? 'selected' : '';
        echo "<option $selected value='$i'>$options[$i]</option>";
    }

    echo "</select>";
    echo "<br>";
	
	if ($errorSpanID != "") {
		echo "<span id=\"$errorSpanID\"></span>";
	}
}

// Create a option list with the select tag and appropriate attributes
function createDistanceDropDown($id, $labelName, $name, $options, $values) {

    createLabel($id, $labelName);

    echo "<select required id=\"$id\" name=\"$name\">";
    echo "<option selected label = 'select' value='' disabled class=\"hidden\">Select distance</option>";

    for ($i = 0; $i < count($options); $i++) {
        echo "<option value='$values[$i]'>$options[$i]</option>";
    }

    echo "</select>";
    echo "<br>";

}

// Create the star ratings field on the addReview.inc and park.php pages
function createRatingsField() {
    $minRating = 1;
	
    for ($i = 5; $i >= $minRating; $i--) {
        echo "<input type=\"checkbox\" id=\"rating" . $i . "\" name=\"rating\" value=\"$i\" onclick='checkboxDeselectOthers(this);'";
        echo isset($_SESSION['logged']) ? '' : ' disabled';
        echo '>';
        createLabel("rating" . $i, "&#9733;");
    }
}

// Create the addReview form for the addReview include on the park.php page
function createAddReviewFormOptionOne($parkCode) {
	echo "<form method='POST' action='park.php?ParkCode=$parkCode' name='park-review' ";	
	echo isset($_SESSION['logged']) ? "onsubmit='return validateReview();'>" : "onsubmit='return redirectToLogin();'>";
	
	echo "<fieldset>";
	echo "<legend>Select a star rating</legend>";
	echo "<div class=\"park-review\">";
	
    echo "<div class=\"rating\">";	
	createRatingsField();	
	echo "</div>";
	
	echo "<br>";
	
	createLabel("txtcomment", "Enter review comments");
	createTextArea("50", "4", "txtcomment", "txtcomment", "Enter your review here.");
	
	createErrorLabel("txtcommentErr");
	echo "</div>";
	
	echo "<input type=\"submit\" value=\"";
	echo isset($_SESSION['logged']) ? "Submit\"" : "Login to leave a review\"";
	echo "></fieldset>";
	echo "</form>";	
}

?>