<?php


namespace App\Service;


use App\Entity\SearchGlobal;
use Symfony\Component\HttpClient\HttpClient;

class GlobalSearchProvider
{
    public function createSearch(SearchGlobal $searchGlobal): void
    {
        $type = $searchGlobal->getType();
        $query = $searchGlobal->getQuery();
        $httpClient = HttpClient::create();
        switch ($type) {
            case 'general':
                $requestApi = "http://openlibrary.org/search.json?q=" . $query . ',availability&limit=20';
                break;
            case 'author' :
                $requestApi = "http://openlibrary.org/search/authors.json?q=" . $query ;
                break;
            case 'subject':
                $requestApi = "http://openlibrary.org/subjects/" . $query . ".json";
                break;
        }
        $response = $httpClient->request('GET', $requestApi);
        $searchGlobal->setResult($response->toArray());
    }
}