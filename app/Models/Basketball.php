<?php

namespace App\Models;


use App\Contracts\PlayerInfo;

class Basketball implements PlayerInfo
{
    static $POSITIONS = ['G', 'F', 'C'];
    static $POINTS_POSITIONS = [
        'G' => [2, 3, 1],
        'F' => [2, 2, 2],
        'C' => [2, 1, 3]
    ];
    static $ADD_POINTS_TO_WINNER_TEAM = 10;

    /**
     * @return string[]
     */
    public static function getPOSITIONS(): array
    {
        return self::$POSITIONS;
    }

    /**
     * @return \int[][]
     */
    public static function getPOINTSPOSITIONS(): array
    {
        return self::$POINTS_POSITIONS;
    }

    /**
     * @return int
     */
    public static function getADDPOINTSTOWINNERTEAM(): int
    {
        return self::$ADD_POINTS_TO_WINNER_TEAM;
    }
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    public string $nickName;

    /**
     * @var int
     */
    private int $number;

    /**
     * @var string
     */
    public string $team;

    /**
     * @var string
     */
    private string $position;

    /**
     * @var int
     */
    private int $scoredPoints;

    /**
     * @var int
     */
    private int $rebounds;

    /**
     * @var int
     */
    private int $assists;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     */
    public function setNickName(string $nickName): void
    {
        $this->nickName = $nickName;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * @param string $team
     */
    public function setTeam(string $team): void
    {
        $this->team = $team;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }


    /**
     * @return int
     */
    public function getScoredPoints(): int
    {
        return $this->scoredPoints;
    }

    /**
     * @param int $scoredPoints
     */
    public function setScoredPoints(int $scoredPoints): void
    {
        $this->scoredPoints = $scoredPoints;
    }

    /**
     * @return int
     */
    public function getRebounds(): int
    {
        return $this->rebounds;
    }

    /**
     * @param int $rebounds
     */
    public function setRebounds(int $rebounds): void
    {
        $this->rebounds = $rebounds;
    }

    /**
     * @return int
     */
    public function getAssists(): int
    {
        return $this->assists;
    }

    /**
     * @param int $assists
     */
    public function setAssists(int $assists): void
    {
        $this->assists = $assists;
    }



    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        if (!in_array($position, self::$POSITIONS))
            throw new \RuntimeException("Position {$position} is invalid");
        $this->position = $position;
    }

    /**
     * @param $row
     */
    public function splitData($row): void
    {
        $res = explode(';', $row);
        if (count($res) != 8)
            throw new \RuntimeException("Invalid Data" . self::class);
        $this->name = $res[0];
        $this->nickName = $res[1];
        $this->number = $res[2];
        $this->team = $res[3];
        $this->setPosition($res[4]);
        $this->scoredPoints = $res[5];
        $this->rebounds = $res[6];
        $this->assists = $res[7];
    }

}
