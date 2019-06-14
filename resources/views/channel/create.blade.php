@extends('shared.app')
@section('content')
        <div class="card mb-3">
            <div class="card-header text-center bg-white">
                @if(isset($channel)) {{-- Channel is for update --}}
                    <h3>Update Channel</h3>
                @else
                    <h3>Create New Channel</h3>
                @endif
            </div>
            <div class="card-body">
                @if(isset($channel)) {{-- Channel is for update --}}
                    <form action="{{route('channel.update',$channel->slug)}}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{route('channel.store')}}" method="POST">
                @endif
                    @csrf
                    <div class="form-group">
                        @if($errors->has('slug'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $errors->first('slug') }}
                            </div>
                        @endif
                        @if($errors->has('title'))
                            <div class=" alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{$errors->first('title')}}
                            </div>
                        @endif

                        <label for="title">Channel Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Channel Title"
                               @if(isset($channel)) value="{{$channel->title}}"@endif
                               @if($errors->has('title'))
                                   value="{{ old('title') }}"
                               @endif
                            >
                    </div>

                        <button type="submit" class="btn btn-primary mt-3 float-right">
                            @if(isset($channel)) {{-- Channel is for update --}}
                                Update
                            @else
                                Create
                            @endif
                        </button>

                </form>
            </div>

        </div>
@endSection
