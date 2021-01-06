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
            foreach ($contents as $key => $line) {
                if ($key !== 0 && $line !== '') {
                    // proccess to split, set and get data in model
                    $classModel = SportModelFactory::proccess($type);
                    $classModel->splitData($line);
                    if (!isset($totlaTeamScores[$classModel->getTeam()]))
                        $totlaTeamScores[$classModel->getTeam()] = 0;
                    // proccess to calculate
                    $classCalculate = SportClassFactory::proccess($type, $classModel);
                    $classCalculate->calculate();
                    $totlaTeamScores[$classModel->getTeam()] += $classCalculate->getTotalPoints();
                    $playerData = $classCalculate->getPlayerInformation();

                    $sports[$type][] = $playerData;
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
