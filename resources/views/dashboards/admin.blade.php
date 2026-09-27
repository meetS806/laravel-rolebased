<x-app-layout>

    <div class="container py-5">

        <h1>Admin Dashboard</h1>

        <p>
            Welcome {{ auth()->user()->name }}
        </p>

        <a href="{{ route('admin.users.index') }}">
            Manage Users
        </a>

    </div>

</x-app-layout>