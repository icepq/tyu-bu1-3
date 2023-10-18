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
				$html[] = $dayDate = $day->getDate(); // 日付を取得します (例: "2023-10-18")
				// 一意のモーダルIDを作成します
    			$html[] = $modalId = 'modal-' . $dayDate;
				$html[] = '<!-- Bootstrap CSS -->';
        		$html[] = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">';
				$html[] = '<td class="'.$day->getClassName().'">';
				$html[] = '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#'.$modalId.'">';
				$html[] = $day->render();
				$html[] = '</button>';
				$html[] = '</td>';
				$html[] = '<!-- Modal -->';
                $html[] = '<div class="modal fade" id="'.$modalId.'" tabindex="-1" aria-labelledby="'.$modalId.'Label" aria-hidden="true">';
                    $html[] = '<div class="modal-dialog">';
                        $html[] = '<div class="modal-content">';
                        $html[] = '<div class="modal-header">';
                            $html[] = '<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>';
                            $html[] = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        $html[] = '</div>';
                        $html[] = '<div class="modal-body">';
                            $html[] = '@foreach ($schedules as $schedule)';
							$html[] = 'if ($schedule->date == $dayDate) { ';
								// スケジュールの詳細を表示するコードを追加します
								$html[] = '<tr class="hover:bg-gray-lighter">';
									$html[] = '<td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">';
									$html[] = '<h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{$schedule->schedule}}</h3>';
									$html[] = '</td>';
								$html[] = '</tr>';
							$html[] = '}';
							$html[] = '@endforeach';
                        $html[] = '</div>';
                        $html[] = '<div class="modal-footer">';
                            $html[] = '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>';
                            $html[] = '<button type="button" class="btn btn-outline-primary">Save changes</button>';
                        $html[] = '</div>';
                        $html[] = '</div>';
                    $html[] = '</div>';
                $html[] = '</div>';

                $html[] = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>';
					
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




