<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DropCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all database tables.';

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
        if ($this->confirm('Are you sure?')) {
            foreach(\DB::select('SHOW TABLES') as $table) {
                $table_array = get_object_vars($table);
                \Schema::drop($table_array[key($table_array)]);
            }

            $this->info('Done');
        } else {
            $this->info('Canceled');
        }
    }
}
