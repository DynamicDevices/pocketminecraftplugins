<?php
namespace PubSub;

require("phpMQTT.php");

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class PubSub extends PluginBase{

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        switch($command->getName()) {
            case "pub":
                if (count($args) != 2 ){
		    $this->getLogger()->error("Problem with arguments");
                    return false;
                }

		$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

		if ($mqtt->connect()) {
		        $mqtt->publish("minecraft/".$args[0],$args[1],0);
		        $mqtt->close();
		} else {
		  $this->getLogger()->error("Problem publishing");
		  return false;
		}

		$this->getLogger()->info("Published ".$args[1]." to topic minecraft/".$args[0]);

                return true;
            case "sub":
                error_log("sub");
                if (count($args) != 1 ){
  	            $this->getLogger()->error("Problem with arguments");
                    return false;
                }

		$this->getLogger()->info("todo!");

                return true;
        }
    }
}
?>
