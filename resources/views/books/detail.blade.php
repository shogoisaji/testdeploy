<x-index-layout>
  <div class="flex flex-col sm:flex-row justify-between">
    <div class="col ml-4 mb-6">
      @if(isset($stock_book->image))
        <img src="{{ $stock_book->image }}" class="mt-4 cols-span-1" style="height:300px; object-fit: cover;"><br>
      @else
        <lottie-player src="{{ asset('animations/no_book.json') }}" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
      @endif
      <div class="flex flex-col space-y-2">
        <h1 class="cols-span-1 text-2xl">{{ $stock_book->title }}</h1>
        <div class="">{{ $stock_book->author }}</div>
      </div>
      <div class="mt-4 flex space-x-8 pr-4">
        @if(!$stock_book->is_rental)
        <button data-modal-target="staticModal" data-modal-toggle="staticModal" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1" type="button">
          Rental
        </button>
        @else
        <button class="shadow-lg bg-gray-500 shadow-gray-500/50 text-white rounded px-2 py-1">
          Rental
        </button>
        @endif
        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="items-center fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-sm max-h-full mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Rental Check
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
                        <p class="text-lg leading-relaxed font-semibold text-blue-500">貸出日 : {{ now()->format('Y/m/d') }}
                        </p>
                        <p class="text-lg leading-relaxed font-semibold text-red-500">返却日 : {{ now()->addDays(7)->format('Y/m/d') }}
                        </p>
                      </div>
                      <lottie-player src="{{ asset('animations/dog_walk.json') }}" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay class="-ml-8 -mr-2"></lottie-player>
                    </div>
                    <div class="flex flex-col items-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <form method="POST" action="{{ route('rental', ['id' => $stock_book->stock_book_id]) }}">
                          @csrf
                          <button type="submit" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1">
                            Rental
                          </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @php
        $is_commented = false;
        foreach($stock_book->comments as $comment) {
          if($comment->user_id == Auth::id()) {
              $is_commented = true;
              break;
          }
        }
        @endphp
        @if($is_commented)
        <button class="shadow-lg bg-gray-500 shadow-gray-500/50 text-white rounded px-2 py-1">
          Comment
        </button>
        @else
        <button data-modal-target="comment-modal" data-modal-toggle="comment-modal" class="shadow-lg bg-red-500 shadow-red-500/50 text-white rounded px-2 py-1" type="button">
          Comment
        </button>
        @endif
        <div id="comment-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <div class="relative  bg-slate-400 rounded-xl shadow">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="comment-modal">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
              <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-700">Comment Edit</h3>
                <form method="POST" class="space-y-6" action="{{ route('comment.store') }}">
                  @csrf
                  <div>
                      <textarea name="comment" id="text" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                  </div>
                  <div class="flex items-center justify-between">
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class=" text-white shadow-md bg-orange-500 shadow-orange-500/50 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
                      Recommend
                      <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg>
                    </button>
                    <div class="w-full ml-10 p-2 block bg-gray-100 rounded-lg items-center">
                      <span id="recommendValue" class="text-yellow-400 text-2xl">
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                      </span>
                    </div>
                  </div>
                  <div id="dropdown" class="z-10 hidden bg-orange-100 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <a href="#" class="block text-yellow-400 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setRecommend(0, event)">
                          <i class="fas fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block text-yellow-400 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setRecommend(1, event)">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block text-yellow-400 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setRecommend(2, event)">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block text-yellow-400 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setRecommend(3, event)">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="far fa-star"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block text-yellow-400 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setRecommend(4, event)">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <input type="hidden" id="recommend" name="recommend" value=0">
                  <input type="hidden" name="stock_book_id" value="{{ $stock_book->stock_book_id }}">
                  <button type="submit" class="w-full text-white shadow-md bg-blue-500 shadow-blue-500/50 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Post Coomment</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @if($stock_book->is_rental)
    @php
        $returnDate = new DateTime($stock_book->rentals->last()->return_date);
    @endphp
    <p class="pt-4 text-red-500 font-semibold">返却予定日: {{ $returnDate->format('Y/m/d') }}</p>
    @endif
  </div>
    <div class="col ml-10">
      <div class="pl-2 text-gray-500 font-semibold text-lg">
        Comments
      </div>
      <div class=" block bg-gray-400 shadow p-6 rounded-2xl scrollbar-hide border-2 border-slate-500/30" style="overflow-y: auto; height:400px; min-width:350px; max-width: 450px; ">
        @foreach($stock_book->comments as $comment)
        <article class="max-w-md p-6 mb-2 bg-slate-200 border border-violet-100 rounded-xl shadow">
          <div class="flex items-center mb-2 space-x-4">
              <img class="w-12 h-12 rounded-full" src="{{ asset('avatars/' . $comment->user->avatar . '.png') }}" alt="">
              <div class="space-y-1 font-medium text-white">
                <p class="text-slate-600 text-lg">{{ $comment->user->name }}</p>
                <time datetime="{{ $comment->created_at->format('Y-m-d H:i') }}" class="block text-sm text-gray-600">{{ $comment->created_at->format('Y/m/d') }}</time>
              </div>
          </div>
          <div>
            <span class="commentRecommendValue text-yellow-400 text-2xl" data-recommend="{{ $comment->recommend }}"></span>
          </div>
          <p class="pt-2 text-md text-gray-600 break-all">{{ $comment->comment }}</p>
        </article>
        @endforeach
      </div>
    </div>
    <p class="text-mg">{{ $stock_book->auther }}</p>
  </div>
</x-index-layout>

<script>
function setRecommend(value, event) {
    event.preventDefault();
    document.getElementById('recommend').value = value;
    let stars = '';
    for (let i = 0; i < 5; i++) {
        if (i < value+1) {
            stars += '<i class="fas fa-star"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }
    document.getElementById('recommendValue').innerHTML = stars;
    $('#dropdown').hide();
}
</script>
<script>
  function checkRecommend(value, element) {
    value = parseInt(value);
    let stars = '';
    for (let i = 0; i < 5; i++) {
        if (i < value + 1) {
            stars += '<i class="fas fa-star"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }
    element.innerHTML = stars;
  }
  document.addEventListener('DOMContentLoaded', (event) => {
    const commentRecommendValues = document.getElementsByClassName('commentRecommendValue');

    for (let i = 0; i < commentRecommendValues.length; i++) {
        const recommend = commentRecommendValues[i].getAttribute('data-recommend');
        checkRecommend(recommend, commentRecommendValues[i]);
    }
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-dropdown-toggle="dropdown"]').click(function(){
    $('#dropdown').toggle();
  });
});
</script>
