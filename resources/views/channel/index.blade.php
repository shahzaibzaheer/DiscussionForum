@extends('shared.app')
@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @forelse($channels as $channel)
            <tr>
                <td>{{ $channel->title }}</td>
                <td class="text-right ">
                    <a href="{{route('channel.edit',[$channel->slug])}}" class="btn btn-outline-primary btn-sm ml-2">Edit</a>
                    <a href="{{route('channel.delete',[$channel->slug])}}" class="btn btn-outline-danger btn-sm ml-2">Delete</a>
                </td>
            </tr>

        @empty
            <tr>
                <td>No Channel Found</td>
            </tr>
        @endforelse

{{--        <tr>--}}
{{--            <td>Channel Title</td>--}}
{{--            <td class="text-right ">--}}
{{--                <a href="" class="btn btn-outline-dark btn-sm ml-2">Edit</a>--}}
{{--                <a href="" class="btn btn-outline-dark btn-sm ml-2">Delete</a>--}}
{{--            </td>--}}
{{--        </tr>--}}

        </tbody>
    </table>
@endSection