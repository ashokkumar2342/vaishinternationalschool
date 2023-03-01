<?php

namespace App\Helper;
use App\Admin;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Facades\DB;

class SelectBox {

	public static function getProfessions()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from  `professions` order by `name` ;"));
  	return $result_rs;
  }

	public static function getBloodgroups()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from  `blood_groups` order by `name` ;"));
  	return $result_rs;
	}

  public static function getComplextions()
  { 
    $result_rs = DB::select(DB::raw("select  `id` , `name`  from  `complextions` order by `name` ;"));
    return $result_rs;
  }

	public static function getIsoptionals()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from  `isoptionals` order by `name` ;"));
  	return $result_rs;
	}

	public static function getAwardLevelType()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from  `award_levels` order by `name` ;"));
  	return $result_rs;
	}

	public static function getSubjectType()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from  `subject_types` where `status` = 1 order by `sorting_order_id`;"));
  	return $result_rs;
	}

  public static function getSubjectTypeByClass($classid)
  { 
    $result_rs = DB::select(DB::raw("select `sbt`.`id`, concat(`sbt`.`name`, ' - ', case `sub`.`isoptional_id` when 1 then 'Compulsory' else 'Optional' end) as `sub_name` from `subjects` `sub` inner join `subject_types` `sbt` on `sbt`.`id` = `sub`.`subjectType_id` where `sub`.`classType_id` = $classid order by `sbt`.`sorting_order_id`;"));
    return $result_rs;
  }

	public static function getDocumentType()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from `document_types` where `status` = 1 order by `name`;"));
  	return $result_rs;
	}

	public static function getIncomeSlabType()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `range`  from `income_ranges` order by `code`;"));
  	return $result_rs;
	}

	public static function getGurdianRelationType()
  { 
  	$result_rs = DB::select(DB::raw("select  `id` , `name`  from `guardian_relation_types` order by `name`;"));
  	return $result_rs;
	}

	public static function getAllAcademicYear()
  { 
  	$result_rs = DB::select(DB::raw("select `id`, `name` from `academic_years` order by `start_date` desc;"));
  	return $result_rs;
	}

	public static function getAllHouses()
  { 
  	$result_rs = DB::select(DB::raw("select `id`, `name`, `code` from `houses` order by `name`;"));
  	return $result_rs;
	}

	public static function getSectionByClass($classid)
  { 
  	$result_rs = DB::select(DB::raw("select `st`.`id`, `st`.`name`, `st`.`code` from `sections` `sec` inner join `section_types` `st` on `st`.`id` = `sec`.`section_id` where `sec`.`class_id` = $classid order by `st`.`sorting_order_id`;"));
  	return $result_rs;
	}

	public static function getAllClass()
  { 
  	$result_rs = DB::select(DB::raw("select `id`, `name`, `alias` from `class_types` order by `shorting_id`;"));
  	return $result_rs;
	}

	public static function getClassAdmissionOpenYearWise($yearId)
  { 
  	$result_rs = DB::select(DB::raw("select DISTINCT `ct`.`id`, `ct`.`name`, `ct`.`shorting_id` from `admission_schedule` `as` Inner join `class_types` `ct` on `ct`.`id` = `as`.`class_id` WHERE curdate() >= `as`.`from_date` And curdate() <= `as`.`last_date` and `as`.`academic_year_id` = $yearId order by `ct`.`shorting_id`;"));
  	
  	return $result_rs;
	}

  public static function getYearAdmissionOpen()
  { 
  	$result_rs = DB::select(DB::raw("select DISTINCT `as`.`academic_year_Id`, `ay`.`name`, `ay`.`start_date` from `admission_schedule` `as` Inner join `academic_years` `ay` on `as`.`academic_year_id` = `ay`.`id` WHERE curdate() >= `as`.`from_date` And curdate() <= `as`.`last_date` order by `ay`.`start_date`"));
  	
  	return $result_rs;
	}

	public static function getGenders()
  { 
  	$result_rs = DB::select(DB::raw("select `id`, `genders` from `genders` order by `id`;"));
  	return $result_rs;
	}

  public static function getCertificateTypes()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `certificate_types` order by `name`;"));
    return $result_rs;
  }

  public static function getIssuingAuthorityType()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `issue_authorty_types` order by `name`;"));
    return $result_rs;
  }

  public static function getUserRoles()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `roles` order by `name`;"));
    return $result_rs;
  }

  public static function getReligions()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `religions` order by `name`;"));
    return $result_rs;
  }

  public static function getCategories()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `categories` order by `name`;"));
    return $result_rs;
  }

  public static function getAllSections()
  { 
    $result_rs = DB::select(DB::raw("select `id`, `name` from `section_types` order by `sorting_order_id`;"));
    return $result_rs;
  }

  public static function getCourseMedium()
  { 
    $result_rs = DB::select(DB::raw("select * from `course_medium` order by `medium_name`;"));
    
    return $result_rs;
  }

}