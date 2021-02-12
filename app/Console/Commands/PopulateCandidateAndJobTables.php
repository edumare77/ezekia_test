<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class PopulateCandidateAndJobTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'candidateAndJobTables:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate tables Candidate and Job using given csv files and print out simple structured data';

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
     * @return int
     */

     /**
      * Function invoke Candidate Contoller and Job Controller 
      * to start populatin the tables. Once tables are populated
      * call method in Candidate controller to get the candidates
      * and their jobs
      */
    public function handle()
    {

        $controllerCandidate = app()->make('App\Http\Controllers\CandidateController');

        $controllerJob = app()->make('App\Http\Controllers\JobController');

        $candidatePopulate = app()->call([$controllerCandidate, 'populateCandidates'], ['fileName' => 'candidates.csv']);

        $jobPopilate = app()->call([$controllerJob, 'populateJobs'], ['fileName' => 'jobs.csv']);

        if($candidatePopulate && $jobPopilate) {

            $candidateResponse = app()->call([$controllerCandidate, 'getCandidateJobs']);
        
            print_r($candidateResponse);

        } else {

            print_r('Tables were not populated');
            
        }
       
    }
}
