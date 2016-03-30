<?php
namespace PubSub;

require("phpMQTT.php");

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;

class PubSub extends PluginBase{

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getLogger()->info(TF::AQUA . "PubSub v1.1.0" . TF::GREEN . " by " . TF::YELLOW . "Alex J Lennon <ajlennon@dynamicdevices.co.uk>" . TF::GREEN . ", Enabled successfully!");
    }

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
