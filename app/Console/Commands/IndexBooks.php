<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

class IndexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = ClientBuilder::create()
            ->setElasticCloudId(env('ES_CLOUD_ID'))
            ->setApiKey(env('ES_API_KEY'))
            ->build();
        $posts = Book::all();

        foreach ($posts as $post) {
            $params = [
                'id' => $post->id,
                'index' => 'index',
                'body' => [
                    'title' => $post->title,
                    'author' => $post->author,
                    'isbn'  => $post->isbn,
                    'genre' => $post->genre,
                    'publishedAt' => $post->publishedAt,
                    'publisher'   => $post->publisher,
                    // 'description' => $post->description,
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
        }
        $this->info('All books indexed successfully');
    }
}
