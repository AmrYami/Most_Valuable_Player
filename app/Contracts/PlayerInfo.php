<?php


namespace App\Contracts;


interface PlayerInfo
{
    /**
     * @param $row
     */
    public function splitData($row):void;
}
