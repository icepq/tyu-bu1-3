<?php
namespace App\Http\Controllers\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\HolidaySetting;
class HolidaySettingController extends Controller
{
	
	function form(){
		
		//取得
		$setting = HolidaySetting::firstOrNew();
		return view("calendar/holiday_setting_form", [
			"setting" => $setting,
			"FLAG_OPEN" => HolidaySetting::OPEN,
			"FLAG_CLOSE" => HolidaySetting::CLOSE
		]);
	}
	function update(Request $request){
		//取得
		$setting = HolidaySetting::firstOrNew();
		//更新
		$setting->update($request->all());
		return redirect()
			->action("Calendar\HolidaySettingController@form")
			->withStatus("保存しました");
	}
}
