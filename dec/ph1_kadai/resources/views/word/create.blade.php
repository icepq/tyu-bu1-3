<!-- resources/views/word/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900 leading-tight dark:text-gray-200">
      {{ __('新しい英単語を登録しよう！') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('word.store') }}" method="POST">
            @csrf
            <div class="flex mb-4">
                <div class="flex flex-col mr-4">
                    <x-input-label for="word" :value="__('英単語')" />
                    <x-text-input id="word" class=" block mt-1 w-full " type="text" name="word" :value="old('word')" required autofocus />
                    <x-input-error :messages="$errors->get('word')" class="mt-2" />
                </div>

                <div class="flex flex-col mb-4">
                    <x-input-label for="meaning" :value="__('意味')" />
                    <x-text-input id="meaning" class=" block mt-1 w-full" type="text" name="meaning" :value="old('meaning')" required autofocus />
                    <x-input-error :messages="$errors->get('meaning')" class="mt-2" />
                </div>
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="ex_en" :value="__('例文')" />
              <x-text-input id="ex_en" class="block mt-1 w-full" type="text" name="ex_en" :value="old('ex_en')" required autofocus />
              <x-input-error :messages="$errors->get('ex_en')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="ex_ja" :value="__('例文訳')" />
              <x-text-input id="ex_ja" class="block mt-1 w-full" type="text" name="ex_ja" :value="old('ex_ja')" required autofocus />
              <x-input-error :messages="$errors->get('ex_ja')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="description" :value="__('補足説明')" />
              <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('登録') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>