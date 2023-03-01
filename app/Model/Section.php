<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	 protected $fillable = [
        'section_id', 'class_id'
    ];
    Public function classes(){
    	return $this->hasOne('App\Model\ClassType','id','class_id');
    }
    Public function sectionTypes(){
    	return $this->hasOne('App\Model\SectionType','id','section_id');
    }

     
}

 