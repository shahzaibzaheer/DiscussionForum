@extends('shared.app')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Discussion Title</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($discussions as $discussion)
            <tr>
                <td>{{$discussion->title}}</td>
                <td><a href="" class="btn btn-outline-primary btn-sm ml-2 ">View</a></td>
                <td><a href="" class="btn btn-outline-primary btn-sm ml-2 ">Edit</a></td>
                <td><a href="" class="btn btn-outline-danger btn-sm ml-2 ">Delete</a></td>
            </tr>
        @empty
            <tr>
                <td>There is no discussion created by you !</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endSection

