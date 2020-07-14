@extends('layouts.app')


@section('content')

@include('admin.includes.error')

    <div class="card">

        <div class="card-header">
             Edit post   
        </div>

        <div class="card-body">
            <form action="{{route ('post.update' , ['id'=>$posts->id])}}" method="POST" enctype="multipart/form-data">
            
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">title</label>
                <input type="text" name="title" class="form-control" value="{{$posts->title}}">
                </div>

                <div class="form-group">
                    <label for="category">select a category</label>

                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $item)
                        
                            <option value="{{ $item->id }}"
                            @if ($posts->category->id  == $item->id)
                                selected
                            @endif
                                
                                > {{$item->name}} </option>
                       
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="featured">Featured Image</label>
                    <input type="file" name="featured" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach ($tags as $tag)
                     <div class="checkbox">
                     <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"
                        @foreach ($posts->tags as $t)
                            @if ($tag->id == $t->id)
                                checked
                            @endif
                            
                        @endforeach
                        
                        > {{$tag->tag}} </label>
                    </div>   
                    @endforeach
                    
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" cols="5" rows="5"> {{$posts->content}} </textarea>
                </div>

                <div class="form-group">
                   <div class="text-center">
                       <button class="btn btn-success" type="submit"> Update post</button>
                   </div>
                </div>

            </form>

        </div>
    </div>
    

@stop