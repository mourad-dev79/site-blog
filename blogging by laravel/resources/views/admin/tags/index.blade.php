@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-head text-center">
        Tags
    </div>
    <div class="card-body">
        <table class="table table-hover">

            <thead>
                <th>
                    tag name
                </th>
        
                <th>
                    Editing
                </th>
        
                <th>
                    Deleting
                </th>
            </thead>
        
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{$tag->tag}}</td>

                        <td><a href="{{ route('tag.edit',['id'=> $tag->id]) }}" class="btn btn-xs btn-info">
                        <i class="fas fa-pencil">Edit</i>
                        </a>
                        </td>

                        <td><a href="{{ route('tag.delete',['id'=> $tag->id]) }}" class="btn btn-xs btn-danger">
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