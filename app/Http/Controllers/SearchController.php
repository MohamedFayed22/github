<?php

namespace App\Http\Controllers;

use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    //search method
    public function index()
    {
        return response()->json(['data'=>$this->searchService->getListWithOrWithoutParamsToFilter()]);
    }
}
