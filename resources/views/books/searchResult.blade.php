<x-index-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('error'))
    <div class="alert alert-dangerm text-red-500 text-xl mb-10">
        {{ session('error') }}
    </div>
    @endif
    <ul class="w-full divide-y divide-gray-400">
        @foreach($books as $book)
        <li class="pt-4">
            <div class="flex justify-between">
                <div class="flex items-center space-x-4"">
                    <div class="flex-shrink-0">
                        @if(isset($book->volumeInfo->imageLinks->thumbnail))
                            <img src="{{ $book->volumeInfo->imageLinks->thumbnail }}" class="cols-span-1 object-contain" style="width: 100px; height:100px;"><br>
                        @else
                            <lottie-player src="{{ asset('animations/no_book.json') }}" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></lottie-player>
                        @endif
                    </div>
                    <div class="flex flex-col space-y-2">
                        <h1 class="cols-span-1 text-xl">{{ $book->volumeInfo->title }}</h1>
                        @if(isset($book->volumeInfo->authors[0]))
                            <p class="">{{ $book->volumeInfo->authors[0] }}</p><br>
                        @endif
                    </div>
                </div>
                <div class="mb-6 flex items-end">
                    <form method="POST" action="{{ route('registrationBook') }}">
                        @csrf
                        @if(isset($book->volumeInfo->industryIdentifiers[0]->identifier))
                        <input type="hidden" name="isbn" value="{{ $book->volumeInfo->industryIdentifiers[0]->identifier }}">
                        <button type="submit" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1" class="" style="height: 40px; width: 70px;">
                            登録
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</x-index-layout>
