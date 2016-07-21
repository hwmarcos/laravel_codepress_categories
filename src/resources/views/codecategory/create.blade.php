@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create Categories</h3>
        <hr/>
        <form action="{{route('admin.categories.store')}}" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <select name="parent_id" id="parent_id" class="form-control">
                        @foreach($values as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="active">Active</label>
                    <input type="checkbox" name="active" value="1">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-default" name="enviar" value="Enviar">
                </div>
            </fieldset>
        </form>
    </div>

@endsection