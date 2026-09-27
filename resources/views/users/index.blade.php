<x-app-layout>

    <div class="container py-5">

        <h2>User Management</h2>

        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>

                        <td>{{ $user->id }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            {{ $user->role->name }}
                        </td>

                        <td>
                            {{ $user->status ? 'Active' : 'Inactive' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        {{ $users->links() }}

    </div>

</x-app-layout>