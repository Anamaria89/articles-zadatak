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
                    <tr class="article">
                        <td class="">
                            {{ $value->title }}
                        </td>

                        <td class="">
                            {{ $value->user->name }}
                        </td>
                        <td class="article text-center text-white">
                            <a data-placement="top" title='Edit page' href='{{ route("articles.edit", ["article" => $value->id]) }}' class="btn btn-sm btn-primary tooltip-custom">Edit</a>
                            <a data-placement="top" title='Preview page' href="{{ route('articles.show', ['article'=> $value->id, 'slug' => Str::slug($value->title, '-') ]) }}" class="btn btn-sm btn-success">Preview</i></a>


                            <button data-toggle="modal" data-target="#Mymodal" type="button" data-url="{{ route('api.article.delete', ['article' => $value->id]) }}" data-id="{{$value->id}}" data-title="{{$value->title}}" class="btn btn-sm btn-danger">Delete</button>
                          
                            
                            
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

        </div>
        <div>{{ $rows->links() }}</div>
    </div>

</div>
<!-- .modal -->
<div class="modal fade" id="Mymodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                                                            
            </div> 
            <div class="modal-body">
                Are you sure you want to continue?
            </div>   
            <div class="modal-footer">
                 <button type="button" class="delete-modal btn btn-danger" data-href="">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                               
            </div>
        </div>                                                                       
    </div>                                          
</div>

@endsection

@section('custom-js')

<!-- Custom styles for this page -->

<script>


$('#Mymodal').on('show.bs.modal', function (event) {
    button = $(event.relatedTarget);
    var deleteUrl = button.data('url');
    
    $("button.delete-modal").attr('data-href', deleteUrl);
});

 $("button.delete-modal").click(function(){
    var deleteUrl = $(this).data("href");

    $.ajax(
    {
        url: deleteUrl,
        type: 'get',
        success: function (data){
            $('#messages-success').text(data.message);     
            $('#Mymodal').modal('toggle');
            button.closest('tr').remove();
        }
    });
   
});



</script>
@endsection
