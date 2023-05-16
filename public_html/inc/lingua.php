<?php

	$lang="ITA";

	if (isset($_SESSION["lang_1"])) {

		if (strtoupper($_SESSION["lang_1"]) == "ITA" | strtoupper($_SESSION["lang_1"]) == "ENG" ) {

			$lang = $_SESSION["lang_1"];
		}

		$_SESSION["lang_1"] = $lang;
	}



	if (isset($_GET['lang_2'])) {

		if (strtoupper($_GET['lang_2']) == "ITA" | strtoupper($_GET['lang_2']) == "ENG" ) {

			$lang = $_GET['lang_2'];
		}

		$_SESSION["lang_1"] = $lang;
	}

	//echo "lingua: " . $lang . "<br/>";
?>