<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Traits\ImportCsv;

class JobController extends Controller
{

    // Using trait to import CSV files into DB
    use ImportCsv;

    /* Method uses trait to populate job table 
    */

    public function populateJobs($fileName) {

        $tableName = app(Job::class)->getTable();

        if(!is_null($tableName) ||  $tableName !== '') {

            return $this->importCsvInfile($fileName, $tableName);

        } else {

            return false;

        }


       

    }
}
