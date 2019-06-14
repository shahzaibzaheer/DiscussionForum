@extends('shared.app')
@section('content')
    <div class="card mb-3">
        <div class="card-header text-center bg-white">
            @if(isset($discussion)) {{-- Channel is for update --}}
                <h3>Update Discussion</h3>
            @else
                <h3>Create New Discussion</h3>
            @endif
        </div>
        <div class="card-body">
            @if(isset($discussion)) {{-- mean Discussion is for update --}}
                    <form action="{{route('discussion.update',$channel->slug)}}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
            @else
                    <form action="{{route('discussion.store')}}" method="POST">
            @endif
                        @csrf
                        @if($errors->has('title'))
                            <span class="text-danger">* {{ $errors->first('title') }}</span>
                        @endif
                        <div class="form-group">
                            <label for="title">Discussion Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Discussion Title"
                                   value="{{ old('title') }}"
                                   @if(isset($discussion)) value="{{$discussion->title}}"@endif
                            >
                        </div>
                        @if($errors->has('channel_id'))
                            <span class="text-danger">* Please select channel for discussion</span>
                        @endif
                        <div class="form-group">
                            <label class="" for="channel">Select Channel</label>
                            <select name="channel_id" class="custom-select " id="channel">
                                <option  value='' >Choose...</option>
                                @forelse($channels as $channel)
                                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                                    @empty
                                    <option value="">No Channel Found</option>
                                @endforelse
                            </select>
                        </div>
                        @if($errors->has('content'))
                            <span class="text-danger">* {{ $errors->first('content') }}</span>
                        @endif
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="content" rows="7" placeholder="Enter Content" >@if(isset($discussion)){{$discussion->content}}@endif {{old('content')}}</textarea>
                        </div>


                        <button type="submit" class="btn btn-primary mt-3 float-right">
                            @if(isset($discussion)) {{-- mean Discussion is for update --}}
                                Update
                            @else
                                Create New Discussion
                            @endif
                        </button>

                    </form>
        </div>

    </div>
@endSection
