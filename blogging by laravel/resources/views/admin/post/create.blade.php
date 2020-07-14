@extends('layouts.app')


@section('content')

@include('admin.includes.error')

    <div class="card">

        <div class="card-header">
             Create new post   
        </div>

        <div class="card-body">
            <form action="{{route ('post.store')}}" method="POST" enctype="multipart/form-data">
            
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category">select a category</label>

                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $item)
                        
                            <option value="{{ $item->id }}"> {{$item->name}} </option>
                       
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
                     <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"> {{$tag->tag}} </label>
                    </div>   
                    @endforeach
                    
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="surmo" class="form-control" cols="5" rows="5"></textarea>
                </div>

                <div class="form-group">
                   <div class="text-center">
                       <button class="btn btn-success" type="submit"> Store post</button>
                   </div>
                </div>

            </form>

        </div>
    </div>
    

@stop

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">


@endsection

@section('scripts')


<script>
    
    $(document).ready(function() {
        $('#surmo').summernote();
    });
</script>
@endsection