@extends('layouts.group_index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h2 class="head_test">グループ一覧</h2>
    <form action="{{action('Admin\GroupController@index')}}" method="get">
        <div class="col-md-8">
          @foreach ($all_groups as $group)
          <div class="card" style="color: black">
            <div class="card-haeder p-3 w-100 d-flex">
              <div class="ml-5 d-flex flex-column">
                <p class="mb-0">{{ $group->name }}</p>
                <a href="{{ url('groups/' .$group->name) }}" class="text-secondary">{{ $group->id }}</a>
              </div>
              <div>
                <a href="{{ action('Admin\GroupController@edit', ['id' => $group->id]) }}" class="card-link">編集</a> 
                <a href="{{ action('Admin\GroupController@delete', ['id' => $group->id]) }}">削除</a>
                 
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </form>
    </div>
</div>
@endsection