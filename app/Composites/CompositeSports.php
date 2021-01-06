<?php


namespace App\Composites;


use App\Factories\SportClassFactory;
use App\Factories\SportModelFactory;
use Illuminate\Filesystem\Filesystem;

class CompositeSports
{
    private Filesystem $filesystem;

    /**
     * MVPRepository constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function collect($files)
    {
        $sports = [];
        $MVP = [];
        foreach ($files as $file) {
            $contents = $this->filesystem->lines($file);
            $type = ucfirst(strtolower($contents->first()));
            $sports[$type] = [];
            $totlaTeamScores = [];
            foreach ($contents as $key => $line) {// get content in every file
                if ($key !== 0 && $line !== '') {
                    // proccess to split, set and get data in model
                    $classModel = SportModelFactory::proccess($type);
                    $classModel->splitData($line);
                    if (!isset($totlaTeamScores[$classModel->getTeam()]))// if there's no key with this team just create it to do sum points
                        $totlaTeamScores[$classModel->getTeam()] = 0;
                    // proccess to calculate
                    $classCalculate = SportClassFactory::proccess($type, $classModel);
                    $classCalculate->calculate();
                    $totlaTeamScores[$classModel->getTeam()] += $classCalculate->getTotalPoints();// do this to get the winner team
                    $playerData = $classCalculate->getPlayerInformation();//players info
                    $sports[$type][] = $playerData;// push players in there teams
                }
            }
            $MVP[$type] = $this->getMVP($sports[$type], $totlaTeamScores, $classModel->getADDPOINTSTOWINNERTEAM());
        }
        return $MVP;

    }

    public function getMVP($array, $totlaTeamScores, $pointWinnerTeam)
    {
        $columns = array_column($array, 'TotalPoints');
        $keyMVP = array_keys($columns, max($columns));
        $winnerTeam = array_keys($totlaTeamScores, max($totlaTeamScores));
        if ($array[$keyMVP[0]]['Team'] == $winnerTeam[0])
            $array[$keyMVP[0]]['TotalPoints'] += $pointWinnerTeam;
        return $array[$keyMVP[0]];
    }
}
