<!-- resources/views/word/edit.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900 leading-tight dark:text-gray-200">
      {{ __('英単語を編集する') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('word.update',$word->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="flex mb-4">
                <div class="flex flex-col mr-4">
                    <x-input-label for="word" :value="__('英単語')" />
                    <x-text-input id="word" class=" block mt-1 w-full " type="text" name="word" value="{{$word->word}}" required autofocus />
                    <x-input-error :messages="$errors->get('word')" class="mt-2" />
                </div>

                <div class="flex flex-col mb-4">
                    <x-input-label for="meaning" :value="__('意味')" />
                    <x-text-input id="meaning" class=" block mt-1 w-full" type="text" name="meaning" value="{{$word->meaning}}" required autofocus />
                    <x-input-error :messages="$errors->get('meaning')" class="mt-2" />
                </div>
            </div>

            <!-- 品詞の登録部分 -->
            <div class="mb-6">
              <div class="form-group">
                <x-input-label for="phs" :value="__('品詞')" />
                <div class="col-md-6 flex mt-1">
                  <div class="mr-16">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="1" name="phs" value="名詞">
                      <label class="form-check-label" for="1">名詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="2"  name="phs" value="代名詞">
                      <label class="form-check-label" for="2">代名詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="3"  name="phs" value="形容詞">
                      <label class="form-check-label" for="3">形容詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="4"  name="phs" value="副詞">
                      <label class="form-check-label" for="4">副詞</label>
                    </div>
                  </div>
                  <div class="mr-16">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="5" name="phs" value="動詞">
                      <label class="form-check-label" for="5">動詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="6"  name="phs" value="助動詞">
                      <label class="form-check-label" for="6">助動詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="7"  name="phs" value="接続詞">
                      <label class="form-check-label" for="7">接続詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="8"  name="phs" value="前置詞">
                      <label class="form-check-label" for="8">前置詞</label>
                    </div>
                  </div>
                  <div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="9"  name="phs" value="冠詞">
                      <label class="form-check-label" for="9">冠詞</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="10"  name="phs" value="間投詞">
                      <label class="form-check-label" for="10">間投詞</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex flex-col mb-4">
              <x-input-label for="ex_en" :value="__('例文')" />
              <x-text-input id="ex_en" class="block mt-1 w-full" type="text" name="ex_en" value="{{$word->ex_en}}" required autofocus />
              <x-input-error :messages="$errors->get('ex_en')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="ex_ja" :value="__('例文訳')" />
              <x-text-input id="ex_ja" class="block mt-1 w-full" type="text" name="ex_ja" value="{{$word->ex_ja}}" required autofocus />
              <x-input-error :messages="$errors->get('ex_ja')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="description" :value="__('補足説明')" />
              <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$word->description}}" required autofocus />
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                </x-primary-button>
              </a>
              <x-primary-button class="ml-3">
                {{ __('Update') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>