@extends('shared.app')
@section('content')
    {{--    {{ dd($discussions) }}--}}
        <div class="card mb-3"> <!-- Discussion Detail -->
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
            </div>
            <div class="card-body text-center">
                <h4 class="card-title ">{{$discussion->title}} </h4>
                <p class="card-text text-left">
                    {{$discussion->content}}
                </p>
            </div>
            <div class="card-footer">
                <span class="ml-3 ">{{$discussion->replies()->count()}} Replies</span>
                <span class="ml-2 float-right font-weight-bold">{{$discussion->created_at->diffForHumans()}}</span>
            </div>
        </div><!-- End of Discussion Detail -->

        <!-- Reply Box-->
        <div class="card mb-3">
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <div class="d-flex ">
                    <span class="m-0 ">Add a Replay</span>
                </div>
            </div>
            <form action="{{route('discussion.reply.create',['discussion_id'=>$discussion->id])}}" method="POST">
                @csrf
                <div class="card-body text-left">
                        @if($errors->has('content'))
                        <span class="text-danger">*Reply Field is Required</span>
                    @endif
                        <textarea class="p-2" name="content" id="" rows="5" style="width: 100%;"
                                  placeholder="Enter Your Replay" required></textarea>
                    <input type="submit" value="Post Reply" class="btn btn-sm btn-primary">
                </div>
            </form>

        </div><!-- End of Reply Box-->

        <!-- Replies-->
        <div>
            <h2 class="display-5 text-center mt-5">Replies</h2>

            @if(isset($bestReply))
                <div class="card mb-3 border-success"> <!-- BEST Replay -->
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex ">
{{--                            {{ dd($discussion->replies()->where('isBestReply',true)->get())  }}--}}
                                <span class="m-0 ">
                                    Reply by: <strong>{{$bestReply->user->name}} </strong>
                                </span>
                        </div>
                        <span class=" badge badge-success p-2" style="font-size: 1.1em">Best Replay!</span>
                        <a href="" class="btn btn-danger float-right btn-sm text-center">UnMark as Best
                            Replay</a>
                    </div>
                    <div class="card-body text-left">
                        <p class="card-text ">
                            {{$bestReply->content}}
{{--                            {{ dd($bestReply) }}--}}
                        </p>
                    </div>
                    <div class="card-footer">
                            <span class=" ">
                                <a href="" class="mr-2 btn btn-sm btn-primary">Like</a> {{$bestReply->likes()->count()}} Likes
                             </span>
                        <span class="ml-2 float-right font-weight-bold">{{$bestReply->created_at->diffForHumans()}}</span></div>
                </div> <!-- End of BEST Replay -->
            @endif


            @forelse($replies as $reply)
                <div class="card mb-3"> <!-- Single Replay -->
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center ">
                            <span class=" m-0 h6"> Reply by: <strong>{{$reply->user->name}}</strong>  </span>
                        </div>
                        <a href="" class="btn btn-outline-success float-right btn-sm text-center">Mark as Best
                            Replay</a>

                    </div>
                    <div class="card-body text-left">
                        <p class="card-text ">
                            {{$reply->content}}
                        </p>
                    </div>
                    <div class="card-footer">
                            <span class=" ">
                                <a href="" class="mr-2 btn btn-sm btn-primary">Like</a> {{$reply->likes()->count()}} Likes
                            </span>
                        <span class="ml-2 float-right font-weight-bold">{{$reply->created_at->diffForHumans()}}</span>
                    </div>
                </div><!-- End of Single Replay -->
            @empty
                <div class="card mb-3"> <!-- Single Replay -->
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        There is no Reply for this Discussion
                    </div>
                </div><!-- End of Single Replay -->
            @endforelse
            <div class="d-flex justify-content-center">
                {{$replies->links()}}
            </div>

        </div>
@endSection
