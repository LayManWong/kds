<?php

// to display mesages function with bootstrap
function Flash($value='') {

	if (isset($_SESSION['alert']) && isset($_SESSION['messages'])) {
		if ($_SESSION['alert'] == 'success') {
	        echo "<div class='alert alert-success'>";
	    } elseif ($_SESSION['alert'] == 'fail') {
	        echo "<div class='alert alert-danger'>";
	    } else {
	       echo "<div>";
	    }

	    foreach ($_SESSION['messages'] as $message) {
	        echo $message . "<br>";
	    }
	    echo "</div>";

		unset($_SESSION['messages']);
		unset($_SESSION['alert']);
	}
}

// to set messages
// messages must be in array
function setFlash($messages, $alert) {

	$_SESSION['messages'] = $messages;
	$_SESSION['alert'] = $alert;
}

function redirect($url, $permanent = false) {
	if($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: '.$url);
	exit();
}