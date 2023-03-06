<?php

namespace App\Observers;

use App\Models\Book;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

class BookObserver
{
    public function es_connect()
    {
        return $client = ClientBuilder::create()
            ->setElasticCloudId(env('ES_CLOUD_ID'))
            ->setApiKey(env('ES_API_KEY'))
            ->build();

        // $response = $client->info();

        // echo $response['version']['number'];
        // echo $response->getStatusCode(); // 200
        // echo (string) $response->getBody(); // Response body in JSON
        // var_dump($response->asArray());
    }

    public function es_index($client, $book)
    {
        $params = [
            'id' => $book->id,
            'index' => 'books',
            'body' => [
                'title' => $book->title,
                'content' => $book->author
            ]
        ];

        try {
            $response = $client->index($params);
        } catch (ClientResponseException $e) {
            $this->info($e->getMessage());
        } catch (ServerResponseException $e) {
            $this->info($e->getMessage());
        } catch (\Exception $e) {
            $this->info($e->getMessage());
        }

        print_r($response->asArray());
    }
    public function es_search($client, $post) {
        $params = [
            'index' => 'my_index',
            'body'  => [
                'query' => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        printf("Total docs: %d\n", $response['hits']['total']['value']);
        printf("Max score : %.4f\n", $response['hits']['max_score']);
        printf("Took      : %d ms\n", $response['took']);

        print_r($response['hits']['hits']); // documents
    }
    public function es_delete($client, $post) {
        try {
            $response = $client->delete([
                'index' => 'my_index',
                'id' => 'my_id'
            ]);
        } catch (ClientResponseException $e) {
            if ($e->getCode() === 404) {
                // the document does not exist
            }
        }
        if ($response['acknowledge'] === 1) {
            // the document has been delete
        }
    }
    /**
     * Handle the Book "created" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        //
    }

    /**
     * Handle the Book "updated" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function updated(Book $book)
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function deleted(Book $book)
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    // public function restored(Book $book)
    // {
    //     //
    // }

    // /**
    //  * Handle the Book "force deleted" event.
    //  *
    //  * @param  \App\Models\Book  $book
    //  * @return void
    //  */
    // public function forceDeleted(Book $book)
    // {
    //     //
    // }
}
