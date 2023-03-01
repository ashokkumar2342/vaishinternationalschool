<?php

namespace App\Model\Transport;

use Illuminate\Database\Eloquent\Model;
use App\Model\Transport\Vehicle;

class DriverHelper extends Model
{
	protected $fillable=['id'];
    public function vehicles(){
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
}
