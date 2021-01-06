<?php


namespace App\Factories;


use App\Contracts\CalculateData;
use App\Contracts\PlayerInfo;

class SportClassFactory
{

    public static function proccess($game,PlayerInfo $class): CalculateData
    {
        $className = 'App\\Composites\\SportClasses\\' . $game;
        if (class_exists($className)) {
            return new $className($class);
        } else {
            throw new \RuntimeException("Invalid {$className} type given.");
        }
    }
}
