<x-rental-index-layout>
<x-navigation-bar></x-navigation-bar>
<div class="min-h-screen flex flex-col items-center pt-24 bg-emerald-200 justify-center" >
  <h1 class="w-full p-4 lg:max-w-4xl text-3xl font-semibold text-gray-700">レンタル履歴</h1>
  <div class="w-full p-10 lg:max-w-4xl mb-10 bg-gray-200 shadow-md overflow-hidden rounded-3xl">
  @if (session('error'))
      <div class="alert alert-dangerm text-red-500 text-xl mb-10">
          {{ session('error') }}
      </div>
  @endif
  <div>
  <ul class="w-full divide-y divide-gray-400" style="min-height:200px;">
    @foreach($rentals as $rental)
    <li class="pt-4">
      <div class="flex justify-between">
        <a class="flex items-center space-x-4" href="{{ route('detail', ['id' => $rental->stockBook->stock_book_id]) }}">
          <div class="flex-shrink-0">
              @if(isset($rental->stockBook->image))
                <img src="{{ $rental->stockBook->image }}" class="cols-span-1 object-contain" style="width:100px; height:100px;"><br>
              @else
                <lottie-player src="{{ asset('animations/no_book.json') }}" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></lottie-player>
              @endif
          </div>
          <div class="flex flex-col space-y-2">
            <h1 class="cols-span-1 text-xl">{{ $rental->stockBook->title }}</h1>
            <p class="">{{ $rental->stockBook->author }}</p><br>
          </div>
        </a>
        <div class="mb-4 mr-4 flex items-end">
          @if($rental->returned_date==null)
          <button data-modal-target="staticModal" data-modal-toggle="staticModal" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1" type="button">
            返却
          </button>
          <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="items-center fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-sm max-h-full mx-auto">
              <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                  <h3 class="text-xl font-semibold text-gray-900">
                    返却確認
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="staticModal">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                </div>
                <div class="flex">
                  <div class="p-6 space-y-6">
                    <p class="text-lg leading-relaxed font-semibold text-blue-500">本を返却しますか？
                    </p>
                  </div>
                  <lottie-player src="{{ asset('animations/dog_walk.json') }}" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay class="-ml-8 -mr-2"></lottie-player>
                </div>
                <div class="flex flex-col items-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                  <form method="POST" action="{{ route('return', ['id' => $rental->stockBook->stock_book_id]) }}">
                    @csrf
                    <button type="submit" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1">
                      Rental
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @else
          @php
            $returnedDate = new DateTime($rental->returned_date);
          @endphp
          <p class="pt-4 text-blue-500 font-semibold">返却日: {{ $returnedDate->format('Y/m/d') }}</p>
          @endif
      </div>
    </li>
    @endforeach
  </ul>
  </div>
  </div>
</div>
</x-rental-index-layout>
