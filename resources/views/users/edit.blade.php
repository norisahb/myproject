@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ $user->name}}" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <textarea name="email"
                                    class="form-control"
                                    rows="2"
                                    required
                            >{{ $user->email }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <textarea name="password"
                                    class="form-control"
                                    rows="1"
                                    required
                            >{{ $user->password }}</textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Update my Form</button>
                            <a href="{{ route('users.index') }}" class="btn btn-info">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
