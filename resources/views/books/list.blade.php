<x-index-layout>
  @if (session('error'))
      <div class="alert alert-dangerm text-red-500 text-xl mb-10">
          {{ session('error') }}
      </div>
  @endif

  <div>
  <ul class="w-full divide-y divide-gray-400">
    @foreach($stock_books as $book)
    <li class="pt-4">
      <div class="flex justify-between">
        <a class="flex items-center space-x-4" href="{{ route('detail', ['id' => $book->stock_book_id]) }}">
          <div class="flex-shrink-0">
              @if(isset($book->image))
                <img src="{{ $book->image }}" class="cols-span-1 object-contain" style="width:100px; height:100px;"><br>
              @else
                <lottie-player src="{{ asset('animations/no_book.json') }}" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></lottie-player>
              @endif
          </div>
          <div class="flex flex-col space-y-2">
            <h1 class="cols-span-1 text-xl">{{ $book->title }}</h1>
            <p class="">{{ $book->author }}</p><br>
          </div>
        </a>
        <div class="mb-4 mr-4 flex items-end">
        @if(!$book->is_rental)
          <div class="text-blue-500 font-bold">貸出可能</div>
        </div>
        @else
          <div class="text-red-500 font-bold">貸出中</div>
        @endif
      </div>
    </li>
    @endforeach
  </ul>
  {{ $bookPaginator->links() }}
</x-index-layout>
