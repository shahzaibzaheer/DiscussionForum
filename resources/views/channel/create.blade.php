@extends('shared.app')
@section('content')
        <div class="card mb-3">
            <div class="card-header text-center bg-white">
                <h3>Create New Channel</h3>
            </div>
            <div class="card-body">
                <form action="{{route('channel.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        @if($errors->has('title'))
                            <div class=" alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{$errors->first('title')}}
                            </div>
                        @endif
                        <label for="title">Channel Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Channel Title">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 float-right">Create</button>
                </form>
            </div>

        </div>
@endSection
