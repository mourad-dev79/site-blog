@extends('layouts.app')


@section('content')

@include('admin.includes.error')
    <div class="card">

        <div class="card-header">
             Create new user   
        </div>

        <div class="card-body">
            <form action="{{route ('user.store')}}" method="POST">
            
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tag">email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                   <div class="text-center">
                       <button class="btn btn-success" type="submit"> add user</button>
                   </div>
                </div>

            </form>

        </div>
    </div>
    

@stop