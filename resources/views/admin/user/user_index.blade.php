@extends('layouts.user_index')
@section('content')

<div class="container">
    <div class="row justify-content-center">
    <h2 class="head_test">ユーザー一覧</h2>
    <form action="{{action('Admin\UserController@index')}}" method="get">
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
                  <!-- <span class="isFollow" data-isFollow='false'>フォローする</span> -->
                  <span class="follow">
                    @if (auth()->user()->following($user->id))
                      <div class="px-2">
                        <span class="px-1 bg-secondary text-light">フォロー中</span>
                      </div>
                    @else
                    <div class="px-2">
                        <span class="px-1 bg-secondary text-light">フォローする</span>
                    </div>
                    @endif
                  </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </form>
    </div>
</div>
@endsection