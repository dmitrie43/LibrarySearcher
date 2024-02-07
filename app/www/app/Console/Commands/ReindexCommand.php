<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private Client $elasticsearch;

    /**
     * ReindexCommand constructor.
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function handle()
    {
        $this->info('Indexing all...');
        $cursors = [
            Book::cursor(),
            Author::cursor(),
        ];
        foreach ($cursors as $cursor)
        {
            foreach ($cursor as $item) {
                $this->elasticsearch->index([
                    'index' => $item->getSearchIndex(),
                    'type' => $item->getSearchType(),
                    'id' => $item->getKey(),
                    'body' => $item->toSearchArray(),
                ]);
                $this->output->write('.');
            }
        }
        $this->info("\nDone!");
    }
}
