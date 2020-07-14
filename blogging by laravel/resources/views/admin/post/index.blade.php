@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-hover">

            <thead>
                <th>
                    Image
                </th>
        
                <th>
                    Title
                </th>
        
                <th>
                    Edit
                </th>

                <th>
                    Delete
                </th>
            </thead>
        
            <tbody>
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <tr>
                        <td><img src="{{ $post->featured }}" alt="{{ $post->title }}" height="50px" width="90px"></td>

                        <td>
                            {{ $post->title }}
                        </td>

                    <td><a href="{{ route ('post.edit' , ['id'=> $post->id])}}" class="btn btn-xs btn-info">Edit</a></td>

                        <td><a class="btn btn-danger" href="{{ route('post.delete' , ['id' => $post->id]) }}"> Trash </a></td>
                    </tr>
                @endforeach
            @else 
            <tr>
                <th colspan="5" class="text-center">No post</th>
             </tr> 
            @endif
            </tbody>
        </table>
    </div>
</div>
    
@endsection