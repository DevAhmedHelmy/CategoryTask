@extends('layouts.app')

@push('js')
    
     
    <script>
        $(document).ready(function(){
            $('#jstree').jstree({ 'core' : {
                'data' : {!! categories() !!}
            },
            "checkbox" : {
                "keep_selected_style" : true
              },
              "plugins" : [ "wholerow" ]
             });

        });
        $('#jstree').on('changed.jstree',function(e, data){
            var i , j,r  =[];
            var title = [];
            for(i=0,j=data.selected.length; i < j; i++)
            {
                r.push(data.instance.get_node(data.selected[i]).id);
                title.push(data.instance.get_node(data.selected[i]).text);
            }

            $('#delete_category').attr('action',"{{ url('categories') }}/"+r.join(', '));
            $('.cat_name').text(title,r.join(', '));


            if(r.join(', ') != '')
            {
                $('.showbtn_control').removeClass('d-none');

                $('.edit_category').attr('href',"{{ url('categories') }}/"+r.join(', ')+'/edit');
            }else{
                $('.showbtn_control').addClass('d-none');
            }
         });
    </script>
@endpush
 
@section('content')
<div class="col-12">


    <div class="card">
        <div class="card-header"> <a href="{{ route('categories.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus fa-sm"></i> create New Category</a></div>

        <div class="card-body">
           

            <div class="mb-2">
                <a href="" class="btn btn-primary btn-sm edit_category showbtn_control d-none"> <i class="fa fa-edit fa-sm"></i> edit</a>
                <a href="" class="btn btn-danger btn-sm delete_category showbtn_control d-none" data-toggle="modal" data-target="#delete_bootstrap_modal"> <i class="fa fa-trash fa-sm"></i> delete</a>
            </div>

            <div id="jstree"></div>
        </div>
    </div>
</div> 
<div class="modal fade" id="delete_bootstrap_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_category" action="" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    Are You Sure ?  <span class="cat_name"></span>
                </div>
                <div class="modal-footer">

                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection