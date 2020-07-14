@extends('layouts.app')


@section('content')

@include('admin.includes.error')
    <div class="card">

        <div class="card-header">
             update your setting   
        </div>

        <div class="card-body">
            <form action="{{route ('setting.update')}}" method="POST">
            
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">site name</label>
                <input type="text" name="site_name" value="{{$setting->site_name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tag">adress</label>
                <input type="text" name="adress" value="{{$setting->adress}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tag">contact phone</label>
                <input type="text" name="contact_number" value="{{$setting->contact_number}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tag">contact email</label>
                <input type="text" name="contact_email" value="{{$setting->contact_email}}" class="form-control">
                </div>

                <div class="form-group">
                   <div class="text-center">
                       <button class="btn btn-success" type="submit"> update setting </button>
                   </div>
                </div>

            </form>

        </div>
    </div>
    

@stop