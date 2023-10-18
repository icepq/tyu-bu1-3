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
				$html[] = '<!-- Bootstrap CSS -->';
        		$html[] = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">';
				$html[] = '<td class="'.$day->getClassName().'">';
				$html[] = '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">';
				$html[] = $day->render();
				$html[] = '</button>';
				$html[] = '</td>';
				$html[] = '<!-- Modal -->';
                $html[] = '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    $html[] = '<div class="modal-dialog">';
                        $html[] = '<div class="modal-content">';
                        $html[] = '<div class="modal-header">';
                            $html[] = '<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>';
                            $html[] = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        $html[] = '</div>';
                        $html[] = '<div class="modal-body">';
                            $html[] = '@foreach ($schedules as $schedule)';
							$html[] = '<tr class="hover:bg-gray-lighter">';
								$html[] = '<td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">';
								$html[] = '<a href="{{ route('tweet.show',$tweet->id) }}">';
									$html[] = '<h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{$tweet->tweet}}</h3>';
								$html[] = '</a>';
								$html[] = '<div class="flex">';
									$html[] = '<!-- 🔽 更新ボタン -->';
									$html[] = '<form action="{{ route('tweet.edit',$tweet->id) }}" method="GET" class="text-left">';
									$html[] = '@csrf';
									$html[] = '<x-primary-button class="ml-3">';
										$html[] = '<svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="gray">';
										$html[] = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />';
										$html[] = '</svg>';
									$html[] = '</x-primary-button>';
									$html[] = '</form>';
									$html[] = '<!-- 削除ボタン -->';
									$html[] = '<form action="{{ route('tweet.destroy',$tweet->id) }}" method="POST" class="text-left">';
									$html[] = '@method('delete')';
									$html[] = '@csrf';
									$html[] = '<x-primary-button class="ml-3">';
										$html[] = '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">';
										$html[] = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />';
										$html[] = '</svg>';
									$html[] = '</x-primary-button>';
									$html[] = '</form>';
								$html[] = '</div>';
								$html[] = '</td>';
							$html[] = '</tr>';
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




