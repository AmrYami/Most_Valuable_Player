<?php

namespace App\Services;
use App\Composites\CompositeSports;
use \App\Repositories\MVPRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class MVPService
{
    /**
     * @var MVPRepository
     */
    private MVPRepository $MVPRepository;
    /**
     * @var CompositeSports
     */
    private CompositeSports $compositeSports;
    /**
     * MVPService constructor.
     * @param MVPRepository $MVPRepository
     */
    public function __construct(MVPRepository $MVPRepository, CompositeSports $compositeSports)
    {
        $this->MVPRepository = $MVPRepository;
        $this->compositeSports = $compositeSports;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function MVPProccess(Request $request){
       $files = $this->MVPRepository->MVPProccess($request->toArray());
//        $compositeData = $this->compositeSports->collectTeams($files);

       dd($files);
    }

}
