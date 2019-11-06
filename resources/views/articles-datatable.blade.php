@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    Articles
                    <select name="filter-user" id="filter-user" class="form-control col-md-3">
                        <option value="">Select User</option>
                    </select>
                </div>
                <div class="col-md-4 text-right"><a href="{{url('articles/create')}}" class="btn btn-sm btn-primary">Add</a>
                </div>
            </div>
            <hr/>
        
            <table id="article-datatable" class="table table-striped table-bordered small" style="width:100%">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Created By</td>
                        <td>Created Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    var defaultPage=50;

    var filterUser=[];

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var oTable = $('#article-datatable').DataTable({
            dom: '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
            processing: true,
            serverSide: true,
            responsive: true,
            pagingType: "full_numbers",
            stateSave: false,
            "lengthMenu": [10,20,30,40,50,100],
            ajax: {
                url: "{!! route('articles.getdatatable') !!}",
                data: function (d) {
                    d.filterUser = $('#filter-user').val();
                },
                beforeSubmit:function(){
                    $('#filter-user').empty();
                }
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'title', name: 'title'},
                { data: 'name', name: 'u.name'},
                { data: 'created_at',  name: 'created_at'},
                { 
                    data:  null,
                    orderable: false,
                    searchable: false,
                    render:function(o){
                        var str="";
                        
                        str += "<div class='btn-group'><a href='javascript:void(0);' data-toggle='tooltip' title='Delete' class='delete-article btn btn-sm btn-danger' data-id='" + o.id + "'>Delete<i class='glyphicon glyphicon-trash text-danger'></i></a> ";
                        
                        str +="<a href='{{ url('articles') }}/" + o.id + "/edit' data-toggle='tooltip' class='btn btn-sm btn-primary' title='Edit'>Edit<i class='glyphicon glyphicon-edit text-info'></i></a></div>";

                        if(!filterUser.includes(o.user_id))
                        {
                            filterUser.push(o.user_id);
                            $('#filter-user').append($('<option/>').val(o.user_id).text(o.name));
                        }
                        
                        return str;
                    },responsivePriority: 1, targets: -1, width: '5%'
                }
            ],
            "preDrawCallback": function(settings) {
                var api = this.api();
                // $(window).on('load', function(){
                //     var len = api.page.len(defaultPage).draw();
                // });
            },
            "order": [[ 0, "desc" ]]
        }).on('draw.dt',function(settings){
            console.log("console log  ",filterUser);
        });

        $('#filter-user').change(function(){
            oTable.draw();
        });

        $(document).on("click",".delete-article",function(){
            if(confirm('Are you sure do you want to delete this article?'))
            {
                $.ajax({
                    url: '{!! url('articles')!!}/'+$(this).data('id'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: {id: $(this).data('id')},
                })
                .done(function(response) {
                    console.log("console log  ",response);
                    console.log("success");
                    oTable.draw();
                })
                .fail(function() {
                    console.log("error");
                });
            }
        });
    });
</script>
@endpush
