<nav class="w-full fixed h-36 -mt-12 bg-emerald-500 border-gray-200 z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto ">
    <div class="flex items-center flex-shrink-0 pl-2">
        <lottie-player src="{{ asset('animations/bird_walk.json') }}" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></lottie-player>
        <span class="-ml-8 self-center lg:text-3xl text-xl font-semibold whitespace-nowrap text-gray-100">Book Mamagement System</span>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 pr-6 mt-4" id="navbar-user">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lgs md:flex-row md:space-x-6 md:mt-0 md:border-0 ">
            <li>
                <a href="{{ route('book.list') }}" class="block py-2 pl-3 pr-3 text-gray-100 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0">Home</a>
            </li>
            <li>
                <a href="{{ route('rentals') }}" class="block py-2 pl-3 pr-3 text-gray-100 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0">Rental</a>
            </li>
            <li>
                <a href="{{ route('account') }}" class="block py-2 pl-3 pr-3 text-gray-100 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-cyan-700 md:p-0">Account</a>
            </li>
            <li>
                <a href="{{ route('account') }}" class="">
                    <img class="-mt-4" src="{{ asset('avatars/' . Auth::user()->avatar . '.png') }}" alt="logo" width="50" height="50">
                </a>
            </li>
        </ul>
    </div>
    </div>
</nav>