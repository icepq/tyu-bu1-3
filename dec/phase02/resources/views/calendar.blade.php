<x-app-layout>
  <x-slot name="header">
  <div class="relative">  
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-0 dark:text-gray-200">
      {{ __('Calendar') }}
    </h2>
    @php
      $year = $calendar -> returnYear();
      $month = $calendar -> returnMonth();
    @endphp
    <div class="absolute flex top-0 right-0">
      <select name="year">
        <option value="2013" {{ $year == '2013' ? 'selected' : '' }}>2013年</option>
        <option value="2014" {{ $year == '2014' ? 'selected' : '' }}>2014年</option>
        <option value="2015" {{ $year == '2015' ? 'selected' : '' }}>2015年</option>
        <option value="2016" {{ $year == '2016' ? 'selected' : '' }}>2016年</option>
        <option value="2017" {{ $year == '2017' ? 'selected' : '' }}>2017年</option>
        <option value="2018" {{ $year == '2018' ? 'selected' : '' }}>2018年</option>
        <option value="2019" {{ $year == '2019' ? 'selected' : '' }}>2019年</option>
        <option value="2020" {{ $year == '2020' ? 'selected' : '' }}>2020年</option>
        <option value="2021" {{ $year == '2021' ? 'selected' : '' }}>2021年</option>
        <option value="2022" {{ $year == '2022' ? 'selected' : '' }}>2022年</option>
        <option value="2023" {{ $year == '2023' ? 'selected' : '' }}>2023年</option>
        <option value="2024" {{ $year == '2024' ? 'selected' : '' }}>2024年</option>
        <option value="2025" {{ $year == '2025' ? 'selected' : '' }}>2025年</option>
        <option value="2026" {{ $year == '2026' ? 'selected' : '' }}>2026年</option>
        <option value="2027" {{ $year == '2027' ? 'selected' : '' }}>2027年</option>
        <option value="2028" {{ $year == '2028' ? 'selected' : '' }}>2028年</option>
        <option value="2029" {{ $year == '2029' ? 'selected' : '' }}>2029年</option>
        <option value="2030" {{ $year == '2030' ? 'selected' : '' }}>2030年</option>
        <option value="2031" {{ $year == '2031' ? 'selected' : '' }}>2031年</option>
        <option value="2032" {{ $year == '2032' ? 'selected' : '' }}>2032年</option>
        <option value="2033" {{ $year == '2033' ? 'selected' : '' }}>2033年</option>
      </select>
      <select name="month">
        <option value="1" {{ $month == '1' ? 'selected' : '' }}>1月</option>
        <option value="2" {{ $month == '2' ? 'selected' : '' }}>2月</option>
        <option value="3" {{ $month == '3' ? 'selected' : '' }}>3月</option>
        <option value="4" {{ $month == '4' ? 'selected' : '' }}>4月</option>
        <option value="5" {{ $month == '5' ? 'selected' : '' }}>5月</option>
        <option value="6" {{ $month == '6' ? 'selected' : '' }}>6月</option>
        <option value="7" {{ $month == '7' ? 'selected' : '' }}>7月</option>
        <option value="8" {{ $month == '8' ? 'selected' : '' }}>8月</option>
        <option value="9" {{ $month == '9' ? 'selected' : '' }}>9月</option>
        <option value="10" {{ $month == '10' ? 'selected' : '' }}>10月</option>
        <option value="11" {{ $month == '11' ? 'selected' : '' }}>11月</option>
        <option value="12" {{ $month == '12' ? 'selected' : '' }}>12月</option>
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