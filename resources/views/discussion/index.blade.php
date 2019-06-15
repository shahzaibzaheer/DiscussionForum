@extends('shared.app')
@section('content')
{{--    {{ dd($discussions) }}--}}

    @forelse($discussions as $discussion)
        <div class="card mb-3"> <!-- Discussion Item -->
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center ">
                    {{-- https://yoast.com/app/uploads/2015/09/Avatar_Joost_500x500.png--}}
                    @if(isset($discussion->user->avatar_url))
                        <img style="width: 40px; height: 40px;  border-radius: 50%; "  src="{{$discussion->user->avatar_url}}" alt="">
                    @else
                        <img style="width: 40px; height: 40px;  border-radius: 50%; "  src="https://yoast.com/app/uploads/2015/09/Avatar_Joost_500x500.png" alt="">
                    @endif
                    <span class="ml-3 m-0 h5" >{{$discussion->user->name}}</span>
                    <span class="text-dark ml-2" style="font-size: 0.9em">&lt {{$discussion->user->email}} &gt</span>
                </div>
                <a href="{{route('discussion.show',['discussion'=>$discussion->slug])}}" class="btn btn-outline-dark float-right btn-sm text-center" >View</a>
            </div>
            <div class="card-body text-center">
                <h4 class="card-title ">{{$discussion->title}} </h4>
                <p class="card-text text-left">{{Str::limit($discussion->content, 200)}}</p>
            </div>
            <div class="card-footer">
                <span class="ml-3 ">{{$discussion->replies()->count()}} Replies</span>
                <span class="ml-2 float-right font-weight-bold">{{$discussion->created_at->diffForHumans()}}</span>
            </div>
        </div> <!-- End of Discussion Item -->
    @empty
        <h1>No Discussion Found</h1>
    @endforelse

        <div class="d-flex justify-content-center">
            {{$discussions->links()}}
        </div>



@endSection
