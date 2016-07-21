@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Categories</h3>

        <br>
        <a href="{{route('admin.categories.create')}}" class="btn btn-default">Create</a>
    
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
            <tr>
                <td>Name</td>
                <td>Parent</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($values as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{isset($value->parent->name)?$value->parent->name:'-'}}</td>
                <td>{{$value->active}}</td>
                <td>
                    <a href="">Edit</a> |
                    <a href="">Delete</a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection