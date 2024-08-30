<x-admin-layout>
    <x-breadcrumb title="Categories"></x-breadcrumb>
    <section class="statistic">
        <div class="section__content section__content--p30 py-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        {{-- <h3 class="title-5 m-b-35">data table</h3> --}}
                        <div class="table-data__tool">
                            {{-- <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property">
                                    <option selected="selected">All Properties</option>
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--sm">
                                <select class="js-select2" name="time">
                                    <option selected="selected">Today</option>
                                    <option value="">3 Days</option>
                                    <option value="">1 Week</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                <i class="zmdi zmdi-filter-list"></i>filters</button>
                        </div> --}}
                            <div class="table-data__tool-right">
                                {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>add item</button> --}}
                                <button type="button"
                                    class="au-btn au-btn-icon au-btn--green au-btn--small  btn btn-success mb-1"
                                    data-toggle="modal" data-target="#addModal">
                                    <i class="zmdi zmdi-plus"></i> add item
                                </button>
                                <button type="button" onclick="MultiDel()"
                                    class="au-btn au-btn-icon au-btn--red au-btn--small  btn btn-danger mb-1">
                                    <i class="zmdi zmdi-trash"></i> Delete selected
                                </button>
                                <input type="checkbox" class="checkAll" style="width: 30px" name="select_all" id="check_uncheck" onchange="selectAll()"> <span class="text-danger"> Select All </span>
                                {{-- <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                <select class="js-select2" name="type">
                                    <option selected="selected">Export</option>
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div> --}}
                            </div>

                        </div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if (session('status'))
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <span class="badge badge-pill badge-success">Success</span>
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive table-responsive-data2" id="">
                            <table class="table table-borderless table-striped table-earning display"
                                style="width: 100%" id="categoryTb">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th class="text-right">Image</th>
                                        <th class="text-right">status</th>
                                        <th>created_at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoriesList as $item)
                                        <tr>
                                            <td> <span> <input type="checkbox" name="id"
                                                        value="{{ $item->id }}" class="form-check-input"> </span>
                                                {{-- <span>{{ $item->id }}</span> --}}
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset($item->img) }}" style="height: 50px;">
                                            </td>
                                            <td class="text-right">{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="text-right">
                                                <button href="#edit" class="au-btn au-btn-icon au-btn--green au-btn--small  btn btn-success mb-1"
                                                data-toggle="modal" data-target="#updateModal{{$item->id}}"><i
                                                        class="fa fa-edit"></i> Edit</button>
                                                {{-- <a href="javascript:ajaxDel('{{ $item->id }}')"
                                                    class="btn btn-outline-danger "><i class="fa fa-trash"></i>
                                                    Remove</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <!-- END DATA TABLE -->

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- modal medium -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form action="{{ route('create.category') }}" id="addCategoryForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Title   (*)</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="title" name="title" placeholder="Title"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="class" class=" form-control-label">Class  (*)</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="class" name="class" placeholder="class for filter data" value=""
                                    class="form-control">
                            </div>

                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Image title (*)</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="file" id="img" name="img" class="form-control">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Status</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <select name="status" id="status" class="form-control-sm form-control">
                                    <option value="" selected>Select</option>
                                    <option value="none">None</option>
                                    <option value="display">Display</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitAdd()">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal medium -->

    @foreach ($categoriesList as $item)
        

    <!-- modal medium -->
    <div class="modal fade" id="updateModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form action="{{ url('update-category/'.$item->id) }}" id="updateCategoryForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Title</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="title" name="title" placeholder="Title" value="{{$item->title}}"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="class" class=" form-control-label">Class</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="text" id="class" name="class" placeholder="Title" value="{{$item->class}}"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Image title</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <input type="file" id="img" name="img" class="form-control" value="{{$item->img}}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3 col-12">
                                <label for="title" class=" form-control-label">Status</label>
                            </div>
                            <div class="col-md-9 col-12">
                                <select name="status" id="status" class="form-control-sm form-control">
                                    <option value="" >Select</option>
                                    <option value="none" @if ($item->status=="none")
                                            selected
                                    @endif>None</option>
                                    <option value="display" @if ($item->status=="display")
                                        selected
                                @endif>Display</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-12 col-12 border text-center">
                                <img src="{{asset($item->img)}}" class="p-2" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
    @endforeach


    <script>
        $(document).ready(function() {
            $('#categoryTb').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json'
                },
            });
        });

        function submitAdd() {


            var title = $('#title').val();
            var img = $('#img').val();
            var status = $('#status').val();

            if (title == '') {
                alert('The title is not null .');
                return;
            }
            if (img == '') {
                alert('The image must be upload .');
                return;
            }
            if (status == '') {
                alert('The status must be set .');
                return;
            }

            $('#addCategoryForm').submit();

        }

        function selectAll(){
            
                if ($("#check_uncheck:checked").length) {
                    $("input:checkbox[name=id]").prop("checked", true);
                } else {
                    $("input:checkbox[name=id]").prop("checked", false);
                }     
        }

        function MultiDel() {
            var arrId = new Array();
            $("input:checkbox[name=id]:checked").each(function() {
                arrId.push($(this).val());
            });



            if (arrId.length == 0) {
                alert("No item is selected");
                return;
            }

            // alert(arrId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ url('multi-del-categories') }}",
                data: {
                    arrId
                },
                dataType: 'text',
                success: function(result) {

                    console.log("a", result);
                    $('input:checkbox[name=id]:checked').parents('tr').remove();
                    //alert('Remove is success !!');

                }
            });
        }

        function ajaxDel(id) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST", 
                url: "{{ url('del-category') }}",
                data: {
                    id
                },
                dataType: 'json',
                success: function(result) {

                    console.log("a", result);
                    $('input:checkbox[name=id]:checked').parents('tr').remove();
                    //alert('Remove is success !!');

                }
            });

        }
    </script>
</x-admin-layout>
