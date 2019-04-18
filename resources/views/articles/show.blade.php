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
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $article->title }}</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
            </div>
        </div>
    </div>
        <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                     <img src="{{ $article->image }}" width="600" alt="Image">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $article->content }}
            </div>
        </div>
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
