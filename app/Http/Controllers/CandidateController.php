<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Traits\ImportCsv;

class CandidateController extends Controller
{

    // Using trait to import CSV files into DB
    use ImportCsv;

    /* Method uses trait to populate candidate table 
    and return the candidates and their jobs
    */

    public function populateCandidates($fileName) {

        $tableName = app(Candidate::class)->getTable();

        if (!is_null($tableName) ||  $tableName !== '') {

            return $this->importCsvInfile($fileName, $tableName);
            

        } else {

            return false;

        }

        
    }

    /* Method return the candidates and their jobs
    */

    public function getCandidateJobs() {

        $candidatesJobs = Candidate::with('getJobs')->get()->toArray();

        return $candidatesJobs;

    }

}
