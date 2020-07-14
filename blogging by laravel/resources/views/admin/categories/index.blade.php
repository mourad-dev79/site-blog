@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-head text-center">
        Categories
    </div>
    <div class="card-body">
        <table class="table table-hover">

            <thead>
                <th>
                    Category name
                </th>
        
                <th>
                    Editing
                </th>
        
                <th>
                    Deleting
                </th>
            </thead>
        
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>

                        <td><a href="{{ route('category.edit',['id'=> $category->id]) }}" class="btn btn-xs btn-info">
                        <i class="fas fa-pencil">Edit</i>
                        </a>
                        </td>

                        <td><a href="{{ route('category.delete',['id'=> $category->id]) }}" class="btn btn-xs btn-danger">
                            <i class="fas fa-trash">Delete</i>
                            </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection