<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FakeSpots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sweet:fakespots {count?} {--T|type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with fake spots';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->argument('count') ? $this->argument('count') : 50;
        $type = $this->option('type') ? $this->option('type') : 'all';

        if ($type == 'all') {
            $a = floor($count/2);
            $b = floor($count/3);
            $c = $count -$a -$b;
        } else {
            $a = $b = $c = intval($count);
        }

        if ($type == 'approved' || $type == 'a') {
            $this->info("Seeding {$a} approved spots");
            factory('App\Spot', $a)->create();
        }

        if ($type == 'pending' || $type == 'p') {
            $this->info("Seeding {$b} pending spots");
            factory('App\Spot', $b)->states('pending')->create();
        }

        if ($type == 'rejected' || $type == 'r') {
            $this->info("Seeding {$c} rejected spots");
            factory('App\Spot', $c)->states('rejected')->create();
        }
    }
}
