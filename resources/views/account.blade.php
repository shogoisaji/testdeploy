@extends('layouts.account')

@section('content')
<div class="container">
    <div class="flex justify-between space-x-12 mb-10">
        <h1 class="text-3xl mb-10">Account</h1>
        <img src="{{ asset('avatars/' . Auth::user()->avatar . '.png') }}" alt="logo" width="100" height="100">
    </div>
    <div class="pl-4">
        <table class="min-w-full divide-y divide-gray-800 mb-10">
            <thead>
                <tr>
                <th class="w-2/6 text-left text-mg font-medium text-gray-800 uppercase">名前</th>
                <th class="w-3/6 text-left text-mg font-medium text-gray-800 uppercase">Email</th>
                <th class="w-1/6 text-left text-mg font-medium text-gray-800 uppercase">管理者権限</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ Auth::user()->email }}</td>
                <td>{{ Auth::user()->is_admin ? 'あり' : 'なし' }}</td>
                </tr>
            </tbody>
        </table>
        <h1 class="text-2xl mb-2">Rental</h1>
        <table class="min-w-full divide-y divide-gray-800 mb-10">
            <thead>
                <tr>
                <th class="w-2/6 text-left text-mg font-medium text-gray-800 uppercase">タイトル</th>
                <th class="w-3/6 text-left text-mg font-medium text-gray-800 uppercase">返却期日</th>
                <th class="w-1/6 text-left text-mg font-medium text-gray-800 uppercase"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ Auth::user()->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="flex justify-end space-x-12">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="shadow-lg bg-orange-500 shadow-orange-500/50 text-white rounded px-2 py-1">
                Logout
            </button>
        </form>
        @if(Auth::user()->is_admin)
        <form method="GET" action="{{ route('searchForm') }}">
            @csrf
            <button type="submit" class="shadow-lg bg-red-500 shadow-red-500/50 text-white rounded px-2 py-1">
                管理者ページ
            </button>
        </form>
        @endif
    </div>
</div>
@endsection