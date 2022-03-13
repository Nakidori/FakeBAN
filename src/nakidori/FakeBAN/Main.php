<?php

namespace nakidori\FakeBAN;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\utils\SingletonTrait;
use pocketmine\player\Player;

use Nakidori\FakeBAN\Form\SelectFormatForm;

class Main extends PluginBase implements Listener{

    use SingletonTrait {
        getInstance as getMainInstance;
    }

    protected $formats;

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("formats.yml");
        $this->loadFormats();
        self::setInstance($this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        $result = false;
        if ($command->getName() == "fakeban") {
            if(count($args) === 0){
                throw new InvalidCommandSyntaxException();
                return false;
            }
            $player = $this->getServer()->getPlayerByPrefix($args[0]);
            if($player instanceof Player){
			    $player->sendForm(new SelectFormatForm());
            }
            $result = true;
        }
        return $result;
    }

    public function loadFormats(){
        $config = new Config($this->getDataFolder() . "formats.yml", Config::YAML);
        $this->formats = $config->getAll();
    }

    public function getFormats(){
        return $this->formats;
    }

    public static function getInstance() : Main{
        return self::getMainInstance();
    }

}
