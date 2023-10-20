<?php
namespace App\Calendar;

use Carbon\Carbon;

class CalendarView {

	private $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}
	/**
	 * タイトル
	 */
	public function getTitle(){
		return $this->carbon->format('Y年n月');
	}

	public function renderSchedules($schedules, $dayDate){
		$html = [];
		foreach ($schedules as $schedule){
			// $html[] = '<tr class="hover:bg-gray-lighter">';
			// $html[] = '<td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">';
			$html[] = '<h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">' . htmlspecialchars($schedule->schedule, ENT_QUOTES, 'UTF-8') . '</h3>';
			$html[] = '<h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">' . htmlspecialchars($schedule->detail, ENT_QUOTES, 'UTF-8') . '</h3>';	
			// $html[] = '</td>';
			// $html[] = '</tr>';
		}
		return implode("", $html);
	}

	/**
	 * カレンダーを出力する
	 */
	function render(){
		//HolidaySetting
		$setting = HolidaySetting::firstOrNew();
		$setting->loadHoliday($this->carbon->format("Y"));
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th>土</th>';
        $html[] = '<th>日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';

		$html[] = '<tbody>';
		
		$weeks = $this->getWeeks();
		foreach($weeks as $week){
			$html[] = '<tr class="'.$week->getClassName().'">';
			$days = $week->getDays($setting);
			foreach($days as $day){
				$html[] = '<td class="'.$day->getClassName().'">';
				$html[] = '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">';
				$html[] = $day->render();
				// ここに予定をとってくる関数を作る
				$html[] = '</button>';
				$html[] = '</td>';
			}
			$html[] = '</tr>';
		}
		
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
    }
	
	protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		$week = new CalendarWeek($firstDay->copy());
		$weeks[] = $week;

		//tmpの日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			$week = new CalendarWeek($tmpDay, count($weeks));
			$weeks[] = $week;
			
            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}
	
}




