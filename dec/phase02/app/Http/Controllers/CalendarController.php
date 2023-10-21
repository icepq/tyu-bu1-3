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

	public function redirect(Request $request) {
    	$year = $request->input('selected_year');
    	$month = $request->input('selected_month');
    	// リダイレクトを行う
    	return redirect()->route('calendar.show', ['year' => $year, 'month' => $month]);
	}
}
