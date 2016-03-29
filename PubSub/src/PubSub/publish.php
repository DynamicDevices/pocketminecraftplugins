<?php

require("../phpMQTT.php");


$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

if ($mqtt->connect()) {
	$mqtt->publish("minecraft/test","Hello World! at ".date("r"),0);
	$mqtt->close();
} else {
  error_log("Problem");
}

?>
