@extends('layouts.main')

@section('seo-title')
<title>Create Article</title>
@endsection

@section('custom-css')
<!-- Custom styles for this page -->
<style>
.ck-editor__editable {
    min-height: 200px;
}
</style>
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
    <h3 class="col-md-6 offset-md-3 text-center pb-4 pt-3">Add Your Quote!</h3>
    <div class="col-md-6 offset-md-3 pl-0">
        <div id="ajaxResponse" class="">
            
        </div>
        <form id="createForm" action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label >Title</label>
                <input type="text" name='title' value='{{ old("title") }}' class="form-control">
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
                        <textarea rows="6" id='content' name='content' class="form-control">{!! old('content') !!}</textarea>
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

<script>
   
$(document).ready(function() {
    $("#save").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{ route('articles.store') }}',
            data: {
              
                title: $('form [name=title]').val(),
                image: $('form [name=image]').val(),
                content: $('form [name=content]').val(),
               
            },
            dataType: 'JSON',
            success: function(data) {
                 $("#ajaxResponse").append("<div>"+data.msg+"</div>");
                
            },
            error: function(data) {
                 alert('Data not sent');
               
        });
    });
});
</script>
@endsection

