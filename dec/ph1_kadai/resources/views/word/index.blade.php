<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      {{ __('単語一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">マイ英単</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($words as $word)
              <tr class="hover:bg-gray-lighter">
                <!-- <div class="relative"> -->
                  <td class="relative py-4 px-6 border-b border-gray-light dark:border-gray-600">
                    <div class="mb-0 p-0">    
                      <div class="relative flex ">
                        <h3 class="relative flex text-left font-bold text-lg text-gray-dark mr-4 dark:text-gray-200">{{$word->word}}</h3>
                        <h3 class="relative flex text-left text-lg text-gray-dark dark:text-gray-200 mr-4">{{$word->meaning}}</h3>
                      </div>
                      <h3 class="relative flex text-left text-sm text-gray-550 dark:text-gray-200">{{$word->phs}}</h3>
                    </div>  
                    <!-- <div class="border padding-0"> -->
                      <details class="text-sm">
                        <summary></summary>
                        <div class="border border-black rounded-lg bg-slate-50 pl-10 pt-4 pb-4">
                          <h5 class=" text-left text-base text-gray-dark dark:text-gray-200">例 : {{$word->ex_en}}</h5>
                          <h5 class=" text-left text-base text-gray-dark dark:text-gray-200 mb-4">訳 : {{$word->ex_ja}}</h5>
                          <h5 class=" text-left text-sm text-gray-dark dark:text-gray-200 mb-4">補足説明 : {{$word->description}}</h5>
                          <div class="flex">
                            <!-- 更新ボタン -->
                            <form action="{{ route('word.edit',$word->id) }}" method="GET" class="text-left mr-4">
                              @csrf
                              <x-primary-button class="ml-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                              </x-primary-button>
                            </form>
                            <!-- 削除ボタン -->
                            <form action="{{ route('word.destroy',$word->id) }}" method="POST" class="text-left">
                              @method('delete')
                              @csrf
                              <x-primary-button>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                              </x-primary-button>
                            </form>
                          </div>
                        </div>  
                      </details>
                    <!-- </div> -->
                    <h5 class="absolute italic right-0 text-sm text-left text-gray-400 dark:text-gray-200">更新:{{$word->updated_at}}</h5>
                  </td>
                <!-- </div> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>