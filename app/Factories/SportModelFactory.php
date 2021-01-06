<?php


namespace App\Factories;


use App\Contracts\PlayerInfo;

class SportModelFactory
{
    public static function proccess($game): PlayerInfo
    {
        $className = 'App\\Models\\' . $game;
        if (class_exists($className)) {
            return app()->make($className);
        } else {
            throw new \RuntimeException("Invalid {$className} type given.");

        }
    }
}
