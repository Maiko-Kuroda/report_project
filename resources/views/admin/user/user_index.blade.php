@extends('layouts.user_index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($all_users as $user)
            <div class="card" style="color: black">
                <div class="card-haeder p-3 w-100 d-flex">
                    <img src="{{ asset('storage/image/' . $user->photo) }}" class="rounded-circle" width="50" height="50">
                    <div class="ml-5 d-flex flex-column">
                        <p class="mb-0">{{ $user->name }}</p>
                        <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->id }}</a>
                    </div>
                    <div class="d-flex flex-column follow-btn">
                        <span class="userId" data-userid={{ $user->id }}></span>
                        <span class="isFollow" data-isFollow='false'>フォローする</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection