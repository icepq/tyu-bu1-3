<?php
namespace App\Calendar;


class CalendarWeekBlankDay extends CalendarWeekDay {
	
    function getClassName(){
		return "day-blank";
	}

	/**
	 * @return 
	 */
	function render(){
		return '';
	}

	public function getDate() {
        return null;  // または適切なデフォルト値を返します。
    }

}