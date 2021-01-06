<?php


namespace App\Models;


use App\Contracts\PlayerInfo;

class Handball implements PlayerInfo
{
    static $POSITIONS = ['G', 'F'];
    static $POINTS_POSITIONS = [
        'G' => [50, 5, -2],
        'F' => [20, 1, -1]
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
    private int $goalsMade;

    /**
     * @var int
     */
    private int $goalsReceived;

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
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        if (!in_array($position, self::$POSITIONS))
            throw new \RuntimeException("Position {$position} is invalid");
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getGoalsMade(): int
    {
        return $this->goalsMade;
    }

    /**
     * @param int $goalsMade
     */
    public function setGoalsMade(int $goalsMade): void
    {
        $this->goalsMade = $goalsMade;
    }

    /**
     * @return int
     */
    public function getGoalsReceived(): int
    {
        return $this->goalsReceived;
    }

    /**
     * @param int $goalsReceived
     */
    public function setGoalsReceived(int $goalsReceived): void
    {
        $this->goalsReceived = $goalsReceived;
    }

    /**
     * @param $row
     */
    public function splitData($row): void
    {
        $res = explode(';', $row);
        if (count($res) != 7)
            throw new \RuntimeException("Invalid Data" . self::class);
        $this->name     = $res[0];
        $this->nickName = $res[1];
        $this->number   = $res[2];
        $this->team     = $res[3];
        $this->setPosition($res[4]);
        $this->goalsMade     = $res[5];
        $this->goalsReceived = $res[6];
    }

}
