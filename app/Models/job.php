<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'candidate_id', 'job_title','company_name', 'start_date', 'end_date'];

    /**
     * Get the candidate that owns the transacon.
     */
    public function getCandidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
