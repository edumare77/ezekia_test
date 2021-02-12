<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait ImportCsv {

    /* Trait used to import data from CSV file into DB 
    */


    /* Method receives file path and table name
    // and populates table candidates and jobs.
    // Because of the use of 'LOAD DATA INFILE '
    // it would cater for insertinting into the db 
    // big amount of entries.
    */

    public function importCsvInfile($fileName, $tableName)
    {
        
        $fields = '';

        switch($tableName){

            case 'candidates':
                $fields = 'id, first_name, last_name, email';
            break;

            case 'jobs':
                $fields = 'id, candidate_id, job_title, company_name, start_date, end_date';
            break;

            default:
                $fields ='';
                
        }

        $terminatedBy = $tableName === 'candidates' ? ',' : ';';
        try {

            $query = sprintf("LOAD DATA INFILE '%s'
                IGNORE INTO TABLE $tableName
                CHARACTER SET utf8
                FIELDS TERMINATED BY '%s'  
                ENCLOSED BY '\"'
                ESCAPED BY ''
                LINES TERMINATED BY '\n'
                ($fields, @created_at, @updated_at)
                SET created_at=NOW(), updated_at=NOW()", $fileName, $terminatedBy);

            \DB::connection()->getpdo()->exec($query);

            return true;

        } 
        catch(\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        
        
    }

}

