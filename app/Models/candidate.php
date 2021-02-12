<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';
    protected $fillable = ['id', 'first_name', 'last_name', 'email'];

     /**
    * Get the jobs linked to 
    * the client
    */

    public function getJobs()
    {
        return $this->hasMany(Job::class)->orderBy('start_date', 'desc');
    }

     /**
    * Get candidates and their jobs
    */
    public static function getCandidatesAndJobs() {

        return (new static)::with('getJobs')->get()->toArray();
         
    }

    

    
}
