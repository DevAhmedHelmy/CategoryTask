@extends('layouts.app')

@push('js')
    <script>
        $(document).ready(function(){
            $('#jstree').jstree({ 'core' : {
                'data' : {!! categories(old('parent_id')) !!}
            },
            "checkbox" : {
                "keep_selected_style" : false
              }
             });
             $('#jstree').on('changed.jstree',function(e, data){
                var i , j, r =[];
                for(i=0,j=data.selected.length; i < j; i++)
                {
                r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));
             });

        });
    </script>
@endpush
@section('content')
 
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">Add New Category</div>

                <div class="card-body">
                    <div id="jstree"></div>
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <input type="hidden" class="parent_id" name="parent_id" value="{{ old('parent_id') }}">
        
                        <div class="d-flex justify-content-between">
        
        
                                <div class="col form-group">
        
                                        <label>Title</label>
                                        <input type="text" name="title" id="title" class="form-control">
        
                                </div>
        
        
                        </div>
        
        
        
        
                        <div class="col-12 text-center">
                            <div class="mt-4 d-flex justify-content-between">
                                <div class="col form-group">
        
                                    <button type="submit" class="btn btn-success mt-3 text-center"><i class="fa fa-check"></i> save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
   
@endsection
 
