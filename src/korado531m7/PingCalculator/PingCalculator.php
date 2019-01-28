<?php
namespace korado531m7\PingCalculator;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class PingCalculator extends PluginBase{
    public function onEnable(){
        $this->saveResource('config.yml', false);
        $this->config = new Config($this->getDataFolder().'config.yml', Config::YAML);
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($label === 'ping'){
            if($sender instanceof Player){
                $sender->sendMessage(str_replace(['%player','%ping'], [$sender->getName(), $sender->getPing()], $this->config->get('ping-message')));
            }else{
                $this->getLogger()->info('You can use this command in-game');
            }
        }
        return true;
    }
}