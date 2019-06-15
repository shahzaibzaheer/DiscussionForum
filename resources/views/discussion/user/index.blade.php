@extends('shared.app')
@section('content')
    @if($discussions->first() === null)
        <h3>There is no discussion created by you</h3>
    @else
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Discussion Title</th>
            <th scope="col">Replies</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($discussions as $discussion)
            <tr>
                <td>{{$discussion->title}}</td>
                <td>{{$discussion->replies()->count()}}</td>
                <td><a href="{{route('discussion.show',$discussion->slug)}}" class="btn btn-outline-primary btn-sm ml-2 ">View</a></td>
                <td><a href="{{route('discussion.edit',$discussion->slug)}}" class="btn btn-outline-primary btn-sm ml-2 ">Edit</a></td>
                <td><a href="{{route('discussion.delete',$discussion->slug)}}" class="btn btn-outline-danger btn-sm ml-2 ">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endSection

