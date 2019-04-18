@extends('layouts.main')

@section('seo-title')
<title>All Articles</title>
@endsection

@section('custom-css')
<!-- Custom styles for this page -->

<style>
    #messages-success {
        color: darkred;
        margin-bottom: 10px;
        font-size: 20px;
    }  
</style>

@endsection

@section('content')
<div class="container">
    <h1 class="title col-md-4 offset-4">All Articles</h1>
    <div class="card-body">
        <div id="messages-success"></div>
        <div class="table-responsive">
            <div class="col-md-4">
                  <form action="{{ route('articles.index')}}" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search"
                            placeholder="Search User Articles"> <span class="input-group-btn">
                            <button type="submit" class="btn btn-info">
                                Search
                            </button>
                        </span>
                    </div>
                </form> 
            </div>
         
            <br>
            <table class="table table-bordered" id="rows" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>User</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody id="">
                    @if(count($rows) > 0)
                    @foreach($rows as $value)
                    <tr class="article" data-id="{{ $value->id }}">
                        <td class="">
                            {{ $value->title }}
                        </td>

                        <td class="">
                            {{ $value->user->name }}
                        </td>
                        <td class="article text-center text-white">
                            <a data-placement="top" title='Edit page' href='{{ route("articles.edit", ["article" => $value->id]) }}' class="btn btn-sm btn-primary tooltip-custom">Edit</a>
                            <a data-placement="top" title='Preview page' href="{{ route('articles.show', ['article'=> $value->id, 'slug' => Str::slug($value->title, '-') ]) }}" class="btn btn-sm btn-success">Preview</i></a>
                            
                           <a	href="{{ route("articles.delete", ["article" => $value->id]) }}" 
								data-token="{{ csrf_token() }}"
								data-id="{{ $article->id }}" 
								class="delete-post-link btn btn-sm btn-danger"
								>Delete </a>
                        
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

$('.delete-post-link').on('click', function(e) {
  		e.preventDefault();
      var parentArticle = $(this).closest('tr');
  		$.ajax({
  			method	: 'delete',
        url   : $(this).attr('href'),
  			data	: {
  				_token	: $(this).data('token')
  			},
  			success	: function(data) {
  				if(data === 'delete success') {
            // location.reload();
            parentArticle.slideUp();
            $('#messages-success').html('<div>Article created!</div>');
          } else {
            alert("Could not delete data");
          }
  			},
        error: function (error) {
          console.log(error);
        }
  		});
  	});
    </script>
    @endsection
