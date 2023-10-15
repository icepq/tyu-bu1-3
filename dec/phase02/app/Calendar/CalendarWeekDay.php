<?php
namespace App\Calendar;
use Carbon\Carbon;

class CalendarWeekDay {
	protected $carbon;
	protected $isHoliday = false;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}

	function getClassName(){
		$classNames = [ "day-" . strtolower($this->carbon->format("D")) ];

		//祝日フラグを出す
		if($this->isHoliday){
			$classNames[] = "day-close";
		}

		return implode(" ", $classNames);
	}

	function getClassName(){
		return "day-" . strtolower($this->carbon->format("D"));
	}

	/**
	 * @return 
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j"). '</p>';
	}
}