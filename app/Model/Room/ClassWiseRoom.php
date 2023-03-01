<?php

namespace App\Model\Room;

use Illuminate\Database\Eloquent\Model;

class ClassWiseRoom extends Model
{
     Public function classType(){
     	return $this->hasOne('App\Model\ClassType','id','class_id');
     }
      Public function sectionTypes(){
     	return $this->hasOne('App\Model\SectionType','id','section_id');
     }
     public function roomType()
    {
    	return $this->hasOne('App\Model\Room\RoomType','id','room_id');
    } 
}
