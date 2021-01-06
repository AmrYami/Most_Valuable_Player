<?php


namespace App\Contracts;


interface CalculateData
{
    /**
     * CalculateData constructor.
     * @param PlayerInfo $playerInfo
     */
    public function __construct(PlayerInfo $playerInfo);

    /**
     *calculate points for every player
     */
    public function calculate():void;
    /**
     * @return array
     */
    public function getPlayerInformation():array;
}
