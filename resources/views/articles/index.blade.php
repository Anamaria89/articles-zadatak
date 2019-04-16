@extends('layouts.main')

@section('seo-title')
<title>All Articles</title>
@endsection

@section('custom-css')
<!-- Custom styles for this page -->

<style>
  .messages-success {
      color: darkred;
      border-left: 2px solid darkred;
      margin-bottom: 10px;
  }  
</style>

@endsection

@section('content')
<div class="container">
    <h1 class="title col-md-4 offset-4">All Articles</h1>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="rows" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>User</th>
                        <th>Image</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody id="">
                    @if(count($rows) > 0)
                        @foreach($rows as $value)
                            <tr>
                                <td class="article">
                                    {{ $value->title }}
                                </td>
                                
                                <td class="article">
                                    {{ $value->user->name }}
                                </td>
                                <td class="article" >
                                   <img src="{{ $value->image }}" style="width:100px;"/> 
                                </td>
                               <td class="article text-center text-white">
                                    <a data-placement="top" title='Edit page' href='{{ route("articles.edit", ["article" => $value->id]) }}' class="btn btn-sm btn-primary tooltip-custom">Edit</a>
                                    <a data-placement="top" title='Preview page' href="{{ route('articles.show', ['article'=> $value->id, 'slug' => Str::slug($value->title, '-') ]) }}" class="btn btn-sm btn-success">Preview</i></a>
                                    <a data-placement="top" title='Delete page {{ $value->title }}' data-name='{{ $value->title }}' data-toggle="modal" data-target="#deleteModal" data-href='{{ route("articles.delete", ["page" => $value->id]) }}' class="btn btn-sm btn-danger tooltip-custom">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
</div>
@endsection
 
@section('custom-js')

<!-- Custom styles for this page -->

<script>
    


</script>
@endsection
