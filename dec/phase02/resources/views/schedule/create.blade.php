<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      {{ __('Add New Schedule') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="schedule" :value="__('予定名')" />
              <x-text-input id="schedule" class="block mt-1 w-full" type="text" name="schedule" :value="old('schedule')" required autofocus />
              <x-input-error :messages="$errors->get('schedule')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="detail" :value="__('予定詳細')" />
              <x-text-input id="detail" class="block mt-1 w-full" type="text" name="detail" :value="old('detail')" required autofocus />
              <x-input-error :messages="$errors->get('detail')" class="mt-2" />
            </div>
            
            <div class="flex flex-col mb-4">
              <x-input-label for="date" :value="__('日付')" />
              <x-text-input id="date" class="block mt-1 w-full" type="datetime" name="date" :value="old('date')" required autofocus />
              <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('Create') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
