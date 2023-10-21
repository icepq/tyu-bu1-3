<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    public function show($year, $month){
		
		// $calendar = new CalendarView(time());

		// return view('calendar', ["calendar" => $calendar]);
		$date;
		if($year === null || $month === null){
			$date = time();
		}else{
			$date = $year. '-' .$month;
		}

		//カレンダーに渡す
		$calendar = new CalendarView($date);
		return view('calendar', [
			"calendar" => $calendar
		]);
	}

	public function thismonth(){
		
		$calendar = new CalendarView(time());

		return view('calendar', ["calendar" => $calendar]);
	}

	public function getNextMonth(){
		return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
	}

	public function getPreviousMonth(){
		return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
	}
}
