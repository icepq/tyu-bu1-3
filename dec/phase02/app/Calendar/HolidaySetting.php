<?php
namespace App\Calendar;

use Yasumi\Yasumi;

class HolidaySetting extends Model
{
    （略）
	private $holidays = null;

	function loadHoliday($year){
		$this->holidays = Yasumi::create("Japan", $year,"ja_JP");		
	}

	function isHoliday($date){
		if(!$this->holidays)return false;
		return $this->holidays->isHoliday($date);
	}

}