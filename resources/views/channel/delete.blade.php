@extends('shared.app')
@section('content')
    <div class="card mb-3">
        <div class="card-header text-center bg-white">
            <h3>Delete Channel ?</h3>
            <h6>All posts in this channel will be deleted</h6>
        </div>
        <div class="card-body">
            <form action="{{route('channel.destroy',$slug)}}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <div class="d-flex justify-content-center">
                 <a href="{{route('channel.index')}}" class="btn btn-outline-danger m-2 ">Cancel</a>
                    <button type="submit" class="btn btn-danger m-2 ">Delete</button>
                </div>
            </form>
        </div>

    </div>
@endSection
