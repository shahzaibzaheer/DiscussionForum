@extends('shared.app')
@section('content')
    <div class="card mb-3">
        <div class="card-header text-center bg-white">

                <h3>Create New Discussion</h3>
        </div>
        <div class="card-body">
                    <form action="{{route('discussion.store')}}" method="POST">
                        @csrf

                        @if($errors->has('slug'))
                            <span class="text-danger">* {{ $errors->first('slug') }}</span>
                        @endif
                        @if($errors->has('title'))
                            <span class="text-danger">* {{ $errors->first('title') }}</span>
                        @endif
                        <div class="form-group">
                            <label for="title">Discussion Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Discussion Title"
                                        value="{{ old('title') }}"
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
                                    <option value="{{$channel->id}}"
                                    @if(isset($discussion) && $discussion->channel_id == $channel->id)
                                        {{ "selected" }}
                                    @endif
                                    >{{$channel->title}}</option>
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
                            @php
                              $content = old('content');
                            @endphp
                            <textarea name="content" class="form-control" id="content" rows="7" placeholder="Enter Content" >@if(isset($content)){{$content}}@endif</textarea>
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
