@extends('layouts.main')

@section('seo-title')
<title>Edit Article</title>
@endsection

@section('custom-css')
<!-- Custom styles for this page -->
<style>
.ck-editor__editable {
    min-height: 200px;
}
</style>
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
    <h3 class="col-md-6 offset-md-3 text-center pb-4 pt-3">Add Your Quote!</h3>
    <div class="col-md-6 offset-md-3 pl-0">
        <div id="messages-success"></div>
        <form id="createForm" action="{{ route('articles.update', ['article' => $article->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label >Title</label>
                <input type="text" name='title' value='{{ old("title", $article->title) }}' class="form-control">
                @if($errors->has('title'))
                <div class='text text-danger'>
                    This field is required.
                </div>
                @endif
            </div>
            <div class="form-group">
                        <label>Image </label>
                        <input type="file" name='image' class="">
                        @if($errors->has('image'))
                        <div class='text text-danger'>
                            {{ $errors->first('image') }}
                        </div>
                        @endif
            </div>
            <div class="form-group">
                        <label>Content </label>
                        <textarea rows="6" id='content' name='content' class="form-control">{!! old('content', $article->content) !!}</textarea>
                        @if($errors->has('content'))
                        <div class='text text-danger'>
                            {{ $errors->first('content') }}
                        </div>
                        @endif
                    </div>
            <div class="form-group ">
                <button type='submit' id="save" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
 
@section('custom-js')

<!-- Custom styles for this page -->


<script type="text/javascript">
   
    
$(document).ready(function() {
    $('#save').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('articles.store', ['article' => $article->id]) }}",
            type: 'post',
            data: {
                
                'title': $('form [name=title]').val(),
                'image': $('form [name=image]').val(),
                'content': $('form [name=content]').val(),
                '_token' : $('form [name=_token]').val()
                
            },
            dataType: 'text'
        }).done(function(data){
           //alert('Data sent');
            $('#messages-success').text('Article successfully edited!!!');
              $('form [name=title]').val(''),
                 $('form [name=image]').val(''),
                 $('form [name=content]').val('')
        }).fail(function(jqXHR, error, message){
//            alert(message);
           alert('Data not sent');
        }).always(function(){
            
        });
    });
});


//$(document).ready(function() {
//    $("#save").click(function() {
//        $.ajaxSetup({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            }
//        });
//        $.ajax({
//            type: 'PUT',
//            url: '{{ route('articles.update', ['article' => $article->id]) }}',
//            data: {
//              
//                title: $('form [name=title]').val(),
//                image: $('form [name=image]').val(),
//                content: $('form [name=content]').val(),
//               
//            },
//            dataType: 'text',
//            success: function(data) {
//               $('#messages-success').text('Article successfully edited!!!');
//              $('form [name=title]').val(''),
//                 $('form [name=image]').val(''),
//                 $('form [name=content]').val('')
//               // console.log('Data sent');
//            },
//            error: function(data) {
//                 alert('Data not sent');
//               
//        });
//    });
//});
</script>
@endsection

