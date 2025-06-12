<?php
require_once(__DIR__ . '/../../vendor/autoload.php');

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();



class SearchEngine
{

    private $accessKey;
    private $secretKey;
    private $url;
    private $index_name;
    private  $client;

    function __construct()
    {
        $this->accessKey = $_ENV['ACCESS_KEY'];
        $this->secretKey = $_ENV['SECRET_KEY'];
        $this->url = $_ENV['SEARCH_URL'];
        $this->index_name = $_ENV['SEARCH_INDEX_NAME'];


        $this->client = new Client([
            'base_uri' => $this->url,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($_ENV['ACCESS_KEY'] . ':' . $_ENV['SECRET_KEY']),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    function getDocumentIdOrUndefined(string $webId): ?string
    {
        $query = [
            'query' => [
                'term' => [
                    'webid' => $webId
                ]
            ]
        ];


        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            return $data['hits']['hits'][0]['_id'];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }

    // Integration med tredjepartssystem: REST/JSON, Filer (XML mot Prisjakt) - språk/regelverk att förhålla sig till

    function search(string $query, string $sortCol, string $sortOrder, int $pageNo, int $pageSize)
    {

        $searchTerm = $query . '*';
        $query = [
            'query' => [
                'query_string' => [
                    'query' => $searchTerm,
                ]
            ],
            'from' => ($pageNo - 1) * $pageSize,
            'size' => $pageSize,
            'sort' =>  [
                $sortCol => [
                    'order' => $sortOrder
                ]
            ],
            'aggs' => [
                'facets' => [
                    'nested' => [
                        'path' => 'string_facet',

                    ],
                    'aggs' => [
                        'names' => [
                            'terms' => [
                                'field' => 'string_facet.facet_name',
                                'size' => 6
                            ],
                            'aggs' => [
                                'values' => [
                                    'terms' => [
                                        'field' => 'string_facet.facet_value',
                                        'size' => 6
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            // echo json_encode($query, JSON_PRETTY_PRINT);
            // die();
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            $pages = ceil($data["hits"]["total"]["value"] / $pageSize);

            return  [
                "data" => $data["hits"]["hits"],
                "num_pages" => $pages,
                "aggregations" => $data["aggregations"]["facets"]['names']['buckets']
            ];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }


}
