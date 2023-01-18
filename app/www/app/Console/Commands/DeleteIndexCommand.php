<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class DeleteIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:delete';

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
        $this->elasticsearch->indices()->delete(['index' => 'books']);
        $this->info("\nDone!");
    }
}
