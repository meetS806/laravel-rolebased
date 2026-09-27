<x-app-layout>

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card">

                    <div class="card-header">
                        <h4 class="mb-0">
                            Create {{ $role->name }}
                        </h4>
                    </div>

                    <div class="card-body">

                        @if(session('success'))

                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>

                        @endif


                        @if($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            method="POST"
                            action="{{ route('users.store') }}"
                        >

                            @csrf


                            <!-- Name -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <!-- Email -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <!-- Role -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Role
                                </label>

                                <input
                                    type="text"
                                    value="{{ $role->name }}"
                                    class="form-control"
                                    disabled
                                >

                            </div>


                            <!-- Password -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <!-- Confirm Password -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Create {{ $role->name }}
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>