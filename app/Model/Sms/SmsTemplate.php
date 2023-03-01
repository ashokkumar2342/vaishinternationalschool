<?php

namespace App\Model\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    public function templateType()
    {
    	return $this->hasOne('App\Model\Sms\TemplateType','id','template_type_id');
    }
}
