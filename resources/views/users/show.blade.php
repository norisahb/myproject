@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Show') }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input value="{{ $user->name}}" type="text" name="name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <textarea name="email"
                                class="form-control"
                                rows="5"
                                readonly
                        >{{ $user->email }}</textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Index Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
