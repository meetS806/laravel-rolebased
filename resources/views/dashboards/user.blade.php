<x-app-layout>

    <div class="container py-5">

        <h1>User Dashboard</h1>

        <p>
            Welcome {{ auth()->user()->name }}
        </p>

        <a href="{{ route('user.sub-users.index') }}">
            Manage Sub Users
        </a>

    </div>

</x-app-layout>