<?php


namespace App\Composites;


class CompositeSports
{

    public function collectTeams($filesystem ,$files){
        $sports = [];
        foreach ($files as $file) {
            $contents     = $filesystem->lines($file);
            $game         = ucfirst(strtolower($contents->first()));
            $games[$game] = [];

            foreach ($contents as $key => $line) {
                dd($key , $line);
                }
            }
        }
}
