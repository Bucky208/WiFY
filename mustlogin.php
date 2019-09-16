<?php

/* checked logged in */
if (empty($_SESSION["token"])) {
	header('Location: /api-wify/');
	exit;
}

?>