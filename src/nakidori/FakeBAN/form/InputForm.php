<?php

namespace nakidori\FakeBAN\form;

use pocketmine\player\Player;
use pocketmine\form\Form;

use nakidori\FakeBAN\FormatTranslator;

class InputForm implements Form{

    protected $contents;

    public function __construct(string $format){
        $this->format = $format;
        $variables = FormatTranslator::getParameters($format);
        foreach ($variables as $variable) {
            $this->contents[] = [
                'type' => 'input',
                'text' => $variable[0],
                'placeholder' => $variable[0]
            ];
        }
    }

    public function handleResponse(Player $player, $data) : void{
        if ($data === null) {
            return;
        }
        $player->kick(FormatTranslator::translate($this->format, $data));
    }

    public function jsonSerialize(){
        return [
            'type' => 'custom_form',
            'title' => 'パラメータ入力',
            'content' => $this->contents
        ];
    }
}
