<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\MediaLibrary\Models\Media;

class DatabaseReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sweet:dbreset {count?}';

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

        $confirmStr = 'Drop the database and seed '.$count. ' spots';
        $confirmStr.='?';

        if ($this->confirm($confirmStr)) {
            $media = Media::all();
            $media->each->delete();

            $this->call('migrate:fresh');
            $this->call('db:seed', ['--class'=>'UsersTableSeeder']);
            $this->call('sweet:fakespots', [
                'count' => $count,
            ]);
        }
    }
}
