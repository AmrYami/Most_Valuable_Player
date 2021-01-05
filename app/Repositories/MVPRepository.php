<?php


namespace App\Repositories;


use Illuminate\Filesystem\Filesystem;

class MVPRepository
{
    //to work with database
    private Filesystem $filesystem;

    /**
     * MVPRepository constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

//        get files
    public function MVPProccess(array $request)
    {
        $files = $this->filesystem->files(public_path('sports/'));
        if ($files)
            return $files;
        return false;

    }
}
