<?php

require 'inc/init.php';
fixContext();

if (empty ($op) or !isset ($ophandler[$pageno][$tabno][$op]))
{
	showError ("Invalid request in operation broker: page '${pageno}', tab '${tabno}', op '${op}'");
	die();
}

// We have a chance to handle an error before starting HTTP header.
if (!isset ($delayauth[$pageno][$tabno][$op]) and !permitted())
	$location = buildRedirectURL_ERR ('Operation not permitted!');
else
	$location = $ophandler[$pageno][$tabno][$op]();
header ("Location: " . $location);

?>
