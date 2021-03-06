@extends('layouts.report_show')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-20 d-flex">
                    <class="rounded-circle" width="30" height="30">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $report->user->name }}</p>
                        <a href="{{ url('users/' .$report->user->id) }}" class="text-secondary">{{ $report->user->screen_name }}</a>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $report->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {!! nl2br(e($report->report)) !!}
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    <!-- @if ($report->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('reports/' .$report->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('reports/' .$report->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>  
                        </div>
                    @endif -->
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('reports/' .$report->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ count($report->comments) }}</p>
                    </div>
                    
                    <div class="d-flex align-items-center like-btn">
                        <span class="reportId" data-reportId="{{ $report->id }}"></span>
                        <span class="like">
                            @php
                            $isLike = false;
                            foreach ($report->likes as $like) {
                            if($like->user_id === Auth::id()){
                                $isLike = true;
                                break;
                            }
                            }
                            @endphp

                            <div class="px-2">
                                <span class="px-1 bg-secondary text-light isLike" id="like{{$report->id}}" data-isLike="{{ $isLike ?: 0 }}">
                                {{ $isLike === true ? 'イイね中' : 'イイね' }}
                                </span>
                            </div>
                        </span>
                        
                        <button type="" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                        <p class="mb-0 text-secondary" id="like_count">{{ count($report->likes) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ここから下をコメントゾーン -->
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <li class="list-group-item">
                <div class="py-3">
                    <form action="{{action('Admin\CommentsController@store')}}" method="post">
                        @csrf
                        <div class="form-group row mb-10">
                            <div class="col-md-12 p-1 w-100 d-flex">
                                <class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">

                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" rows="4">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">140文字以内</p>
                                <button type="submit" class="btn btn-primary">
                                    投稿する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </div>


        <div class="col-md-8 mb-3">
            <ul class="list-group">

            

                @forelse ($report->comments as $comment)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            <class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $comment->user->name }}</p>
                                <a href="{{ url('users/' .$comment->user->id) }}" class="text-secondary">{{ $comment->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="py-3">
                            {!! nl2br(e($comment->content)) !!}
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">コメントはまだありません。</p>
                    </li>
                @endforelse
                
            </ul>
        </div>
    </div>
</div>
@endsection