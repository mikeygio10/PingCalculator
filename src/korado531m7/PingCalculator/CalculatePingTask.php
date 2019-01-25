<?php
namespace korado531m7\PingCalculator;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\scheduler\Task;

class CalculatePingTask extends Task{
    public function __construct(Player $player, PingCalculator $main){
        $this->player = $player;
        $this->main = $main;
        $this->ping = 0;
        $this->count = 1;
    }
    
    public function onRun(int $tick) : void{
        if(Server::getInstance()->findEntity($this->player->getId()) === null || $this->count === 5){
            $this->getHandler()->cancel();
        }
        
        $this->ping += $this->player->getPing();
        $this->count++;
        
        if($this->count === 5){
            $this->main->sendResult($this->player, $this->ping / 5);
        }
    }
}