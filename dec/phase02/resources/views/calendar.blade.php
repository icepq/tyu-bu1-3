<x-app-layout>
  <x-slot name="header">
  <div class="relative">  
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-0 dark:text-gray-200">
      {{ __('Calendar') }}
    </h2>
    @php
      $Y = $calendar -> returnYear();
      $M = $calendar -> returnMonth();
    @endphp
    <form id="redirectForm" method="POST" action="{{route('calendar.redirect')}}">
    @csrf
      <div class="absolute flex top-0 right-0">
        <select id="selected_year" name="selected_year">
          @for ($y = 2013; $y <= 2033; $y++)
              <option value="{{ $y }}" {{ $y == $Y ? 'selected' : '' }}>{{ $y }}</option>
          @endfor
        </select>
        <select id="selected_month" name="selected_month">
          @for ($m = 1; $m <= 12; $m++)
              <option value="{{ $m }}" {{ $m == $M ? 'selected' : '' }}>{{ $m }}</option>
          @endfor
        </select>
        <input type="submit" value="Jump">
      </div>
    </form> 
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