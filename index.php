<?php

require_once ('vendor/autoload.php');

use GuzzleHttp\Client; 

const base_url = "https://api.thecatapi.com/";

$client = new GuzzleHttp\Client(['verify' => false]);

class Cats{
    private $url;
    private $client;

    public function __construct($url, $client)
    {
        $this->url=$url;
        $this->client=$client;
    }

    function getCategories()
    {
        $response = $this->client->request("GET", $this->url."v1/categories");
        $categoriesApi = json_decode($response->getBody(), true);
        asort($categoriesApi);
        foreach($categoriesApi as $category){
            echo $category["id"]." ".$category["name"]."<br>\n";
        }
    }

    function displayImg()
    {
        $category = $_GET['category_ids'] ?? null;
        if (isset($category)){
            $catApi = "v1/images/search?category_ids=$category";
        } else{
            $catApi = "v1/images/search";
        }

        $result = $this->client->request("GET", $this->url.$catApi);
        $imgApi = json_decode($result->getBody(), true);
        foreach ($imgApi as $img){
            return $img["url"];
        }
    }
}

$objCats = new Cats(base_url,$client);
$objCats->getCategories();
echo '<html><body><img src= "'. $objCats->displayImg() .'" /></body></html>';
