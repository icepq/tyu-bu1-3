<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 全てのスケジュールを取得します。
        $schedules = Schedule::all();


        // 現在の日付または特定の日付を指定します。
        $date = now();

        // CalendarView インスタンスを作成します。
        $calendar = new CalendarView($date);

        // カレンダーをレンダリングし、そのHTMLを取得します。
        $calendarHtml = $calendar->render($schedules);

        // HTMLをレスポンスとして返します。
        return response()->make($calendarHtml);
    }

//

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'schedule' => 'required | max:191',
            'date' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('schedule.create')
            ->withInput()
            ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報

        $result = Schedule::create($request->all());
        
        $datetime = Carbon::parse($request->input('date'));
        $year = $datetime->year;
        $month = $datetime->month;
        
        return redirect()->route('calendar.show', ['year' => $year, 'month' => $month]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $result = Schedule::find($id)([
            'date' => $datetime
        ]);

        $year = $datetime->year;
        $month = $datetime->month;

        $result = Schedule::find($id)->delete();

        return redirect()->route('calendar.show', ['year' => $year, 'month' => $month]);

    }
}
