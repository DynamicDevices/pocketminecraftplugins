<?php

/*
 * WorldProtector plugin for PocketMine-MP
 * Copyright (C) 2016 Alex J Lennon
 *
 * Some parts:
 * Copyright (C) 2015 Jack Noordhuis
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

namespace PubSub;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\block\Wool;

//require("phpMQTT.php");

class EventListener implements Listener {

        private $plugin;

        public function __construct(PubSub $plugin) {
                $this->plugin = $plugin;
        }

        public function onBreak(BlockBreakEvent $event) {

	 	$this->plugin->getLogger()->info("Block break event!");
                $event->setCancelled(false);

		$block = $event->getBlock();
		if(!($block instanceof Wool))
			return false;

		$x = $block->getX();
		$y = $block->getY();
		$z = $block->getZ();

  		$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

                if ($mqtt->connect()) {
                        $mqtt->publish("minecraft/break","{ 'x' : '".$x."','y' : '".$y."','z' : '".$z."' }", 0);
                        $mqtt->close();
                } else {
                  $this->getLogger()->error("Problem publishing");
                  return false;
                }
        }

        public function onPlace(BlockPlaceEvent $event) {
	 	$this->plugin->getLogger()->info("Block place event!");
                $event->setCancelled(false);

		$block = $event->getBlock();
		if(!($block instanceof Wool))
			return false;

		$x = $block->getX();
		$y = $block->getY();
		$z = $block->getZ();

  		$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

                if ($mqtt->connect()) {
                        $mqtt->publish("minecraft/place","{ 'x' : '".$x."','y' : '".$y."','z' : '".$z."' }", 0);
                        $mqtt->close();
                } else {
                  $this->getLogger()->error("Problem publishing");
                  return false;
                }
        }

        public function onInteract(PlayerInteractEvent $event) {
	 	$this->plugin->getLogger()->info("Interact event!");
                $event->setCancelled(false);

		$block = $event->getBlock();
		if(!($block instanceof Wool))
			return false;

		$x = $block->getX();
		$y = $block->getY();
		$z = $block->getZ();

  		$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

                if ($mqtt->connect()) {
                        $mqtt->publish("minecraft/interact","{ 'x' : '".$x."','y' : '".$y."','z' : '".$z."' }", 0);
                        $mqtt->close();
                } else {
                  $this->getLogger()->error("Problem publishing");
                  return false;
                }
        }

        public function onDamage(EntityDamageEvent $event) {
	 	$this->plugin->getLogger()->info("Damage event!");
                $event->setCancelled(false);

  		$mqtt = new phpMQTT("minecraft.dynamicdevices.co.uk", 1883, "phpMQTT Pub Example"); //Change client name to something unique

                if ($mqtt->connect()) {
                        $mqtt->publish("minecraft/damage","todo",0);
                        $mqtt->close();
                } else {
                  $this->getLogger()->error("Problem publishing");
                  return false;
                }
        }
}
