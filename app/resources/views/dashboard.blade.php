<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->email_verified_at === null)
                        <h4>You're logged in! |
                            <span class="text-red-700">Profile not verified</span>
                        </h4>
                    @else
                        <h4>You're logged in! |
                            <span class="text-green-700">Profile verified</span>
                        </h4>
                    @endif

                    @if (Auth::user()->is_admin)
                        <h1 class="pt-3">Approve user to verify Profile</h1>
                        @if(count($users) === 0)
                            All users are verified
                        @endif
                        <ul>
                            @foreach ($users as $user)
                                <li class="border">{{ $user->email }} <form method="post"
                                        action="{{ route('users.approve', $user->id) }}" class="d-inline">@csrf<button
                                            class="bg-dark">Approve</button></form>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if (!Auth::user()->is_admin)
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            <input type="text" name="name" />
                            <button type="submit" class="bg-dark-200 ">Create Project</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
