<x-app-layout>
  <x-slot name="header">
  <div class="relative">  
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-0 dark:text-gray-200">
      {{ __('Calendar') }}
    </h2>
    
    <div class="absolute flex top-0 right-0">
      <select name="year">
        <option value="">----年</option>
        <option value="2013">2013年</option>
        <option value="2014">2014年</option>
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017">2017年</option>
        <option value="2018">2018年</option>
        <option value="2019">2019年</option>
        <option value="2020">2020年</option>
        <option value="2021">2021年</option>
        <option value="2022">2022年</option>
        <option value="2023">2023年</option>
        <option value="2024">2024年</option>
        <option value="2025">2025年</option>
        <option value="2026">2026年</option>
        <option value="2027">2027年</option>
        <option value="2028">2028年</option>
        <option value="2029">2029年</option>
        <option value="2030">2030年</option>
        <option value="2031">2031年</option>
        <option value="2032">2032年</option>
        <option value="2033">2033年</option>
      </select>
      <select name="month">
        <option value="">--月</option>
        <option value="1">1月</option>
        <option value="2">2月</option>
        <option value="3">3月</option>
        <option value="4">4月</option>
        <option value="5">5月</option>
        <option value="6">6月</option>
        <option value="7">7月</option>
        <option value="8">8月</option>
        <option value="9">9月</option>
        <option value="10">10月</option>
        <option value="11">11月</option>
        <option value="12">12月</option>
      </select>
    </div>
</div>
  </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $calendar->getTitle() }}</div>
                    <div class="card-body">
                            {!! $calendar->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>