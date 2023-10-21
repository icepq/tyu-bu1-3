<?php
namespace App\Calendar;

use Carbon\Carbon;
use App\Models\Schedule;



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

	public function returnYear(){
		return $this->carbon->year;
	}

	public function returnMonth(){
		return $this->carbon->month;
	}

	public function renderSchedules($schedules, $dayDate){
		$html = [];
		foreach ($schedules as $schedule){
			// $html[] = '<tr class="hover:bg-gray-lighter">';
			// $html[] = '<td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">';
			$html[] = '<div class="d-flex justify-content-between align-items-center mb-2">'; // 追加
			$html[] = '<h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">' . htmlspecialchars($schedule->schedule, ENT_QUOTES, 'UTF-8') . '</h3>';
			$html[] = '<h3 class="text-left text-gray-dark dark:text-gray-200">' . htmlspecialchars($schedule->detail, ENT_QUOTES, 'UTF-8') . '</h3>';	
			$html[] = '</div>'; // 追加	
			// $html[] = '</td>';
			// $html[] = '</tr>';
		}
		return implode("", $html);
	}

	/**
	 * カレンダーを出力する
	 */
	function render($schedules=[]){
		//HolidaySetting
		$setting = HolidaySetting::firstOrNew();
        $setting->loadHoliday($this->carbon->format("Y"));

		$html[] = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">';
		$html[] = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>';

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
				$dayDate = $day->getDate();
				$modalId = 'modal-' . $dayDate;
				$schedules = Schedule::where('date', $dayDate)->orderBy('updated_at')->get();
				$html[] = '<td class="'.$day->getClassName().'">';
				$html[] = '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#'.$modalId.'">';
				$html[] = $day->render();
				
				// ここに予定をとってくる関数を作る
				$html[] = '</button>';
				if(count($schedules) > 0) {
					foreach ($schedules as $schedule){
						$html[] = '<h3 class="text-left text-gray-dark dark:text-gray-200">' . htmlspecialchars($schedule->schedule, ENT_QUOTES, 'UTF-8') . '</h3>';
					}
				}
				$html[] = '</td>';
                $html[] = '<div class="modal fade" id="'.$modalId.'" tabindex="-1" aria-labelledby="'.$modalId.'Label" aria-hidden="true">';
                $html[] = '<div class="modal-dialog">';
                $html[] = '<div class="modal-content">';
                $html[] = '<div class="modal-header">';
                $html[] = '<h5 class="modal-title" id="exampleModalLabel">'.$dayDate.'</h5>';
                $html[] = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                $html[] = '</div>';
                $html[] = '<div class="modal-body">';
				$html[] = $this->renderSchedules($schedules, $dayDate);
				
                $html[] = '</div>';
                $html[] = '<div class="modal-footer">';
                $html[] = '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>';
                $html[] = '<a href="' . route('schedule.create', ['date' => $dayDate]) . '" class="btn btn-outline-primary">Create</a>';

                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';
                $html[] = '</div>';

                
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

		//一週目
		$week = new CalendarWeek($firstDay->copy());
		$weeks[] = $week;

		//tmpの日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			$week = new CalendarWeek($tmpDay, count($weeks));
			$weeks[] = $week;
			
			//次の週=＋7日する
            $tmpDay->addDay(7);
		}

		return $weeks;
	}
}





