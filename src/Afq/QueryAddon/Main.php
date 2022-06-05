<?php

namespace Afq\QueryAddon;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\server\QueryRegenerateEvent;

class Main extends PluginBase implements Listener{

   public function onEnable() : void{
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
   if(!file_exists($this->getDataFolder() . "Config.yml")) {
            $this->config = (new Config($this->getDataFolder() . "Config.yml", Config::YAML, [
            ## BY AFQ ❤️ 
"infinite slots"=> true,
## If this option is set to true, the max players slots will be 1 above the player count that is currently online. So it'd look like this: 0/1. If one person joined, it'll be 1/2, etc.

"fake players"=> true,

"minimum"=> 10,
"maximum"=> 100
# minimum number of fake players
# maximum number of fake players

            ]));
        } else {
            $this->config = (new Config($this->getDataFolder() . "Config.yml", Config::YAML, []));
        }
    }
        
   public function onQueryRegenerate(QueryRegenerateEvent $event) : void{   
   $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
		$config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        if($config->get("fake players") === true and $config->get("infinite slots") === false)
{
        $minimum = $config->get("minimum");
        $maximum = $config->get("maximum");
        $info = $event->getQueryInfo();
        $info->setPlayerCount(mt_rand($minimum, $maximum));
}
        if($config->get("infinite slots") === true and $config->get("fake players") === true)
{
        $minimum = $config->get("minimum");
        $maximum = $config->get("maximum");
        $info = $event->getQueryInfo();
        $fake = mt_rand($minimum, $maximum);
        $currentPlayerCount = count(Server::getInstance()->getOnlinePlayers());
        $info->setPlayerCount($fake + $currentPlayerCount);
        $info->setMaxPlayerCount($fake + $currentPlayerCount + 1);
}
        if($config->get("infinite slots") === true and $config->get("fake players") === false)
{
        $currentPlayerCount = count(Server::getInstance()->getOnlinePlayers());
        $info->setMaxPlayerCount($currentPlayerCount + 1);
}
        }
}
