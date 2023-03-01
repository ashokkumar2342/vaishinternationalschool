<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CertificateIssueDetail extends Model
{
	 protected $fillable = [
	   'student_id', 
	   'certificate_type', 
	   'attachment', 
	   'date', 
	   'resion', 
	];
    public function students(){
    	return $this->hasOne('App\Student','id','student_id');
    }
    public function academicYear(){
    	return $this->hasOne('App\Model\AcademicYear','id','academic_year_id');
    }
}
