<?php

namespace App\Services;

class SearchService
{

    public function getListWithOrWithoutParamsToFilter(string $type='list', string $searchText='', string $orderBy='', string $stars='' )
    {
        $requestService = app(RequestService::class);
        $baseUrl = '';
        $allParams = request()->except(['param_type']);

        $baseUrl = $this->addingParamUrl($baseUrl,$allParams,request()->get('param_type'));
        return $requestService->getDataFromApi($baseUrl);
    }

    public function addingParamUrl($url,$params,$param_type=null)
    {
        $url = $this->checkAndGetUrl($url,$param_type);
        foreach ($params as $key => $param) {
            $url .= "&$key=$param";
        }
        return $url;
    }

    public function checkAndGetUrl($url,$params,$param_type = null)
    {
        if($param_type){
            switch ($param_type) {
                case 'date':
                    if(isset($params['created'])){
                        $url = 'https://api.github.com/search/repositories?q='. 'created:>' . $params['created'] .'&sort=stars&order=desc';
                    }else{
                        $url = 'https://api.github.com/search/repositories?q=stars:%3E1&sort=stars&order=desc';
                    }
                    break;
                default:
                    $url = 'https://api.github.com/search/repositories?q=stars:%3E1&sort=stars&order=desc';
                    break;
            }
        }else{
            $url = 'https://api.github.com/search/repositories?q=stars:%3E1&sort=stars&order=desc';
        }
        return $url;
    }

    // public function returnAvailableParams()
    // {
    //     return [
    //         'mostPopular'=> 'stars:%3E1',
    //         'sortByStars' => 'sort=stars',
    //         'orderDesc' => 'order=desc',
    //     ];
    // }
}