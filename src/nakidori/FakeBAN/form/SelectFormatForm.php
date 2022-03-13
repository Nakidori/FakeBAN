<?php

namespace Nakidori\FakeBAN\Form;

use pocketmine\player\Player;
use pocketmine\form\Form;

use nakidori\FakeBAN\Main;
use nakidori\FakeBAN\form\InputForm;


class SelectFormatForm implements Form{
    
    protected $buttons;
    protected $formats;

    public function __construct(){
        $this->formats = Main::getInstance()->getFormats();
        foreach ($this->formats as $name => $format) {
            $this->buttons[] = ['text' => $name];
        }
    }

    public function handleResponse(Player $player, $data) : void{
        if ($data === null) {
            return;
        }
        $player->sendForm(new InputForm(array_values($this->formats)[$data]));
    }

    public function jsonSerialize(){
        return [
            'type' => 'form',
            'title' => '書式を選択',
            'content' => '',
            'buttons' => $this->buttons
        ];
    }
}
