<x-admin-layout>
    <x-breadcrumb title="Truyen"></x-breadcrumb>
    {{-- <div class="main-content"> --}}
    <div class="section__content section__content--p30 py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Danh sach truyen</h3>
                    <div class="row table-data__tool border p-3">
                        <div class="table-data__tool-left col-md-9">
                            {{-- <form action="{{route('filter.story')}}" method="GET" enctype="multipart/form-data">
                                @csrf --}}
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="category_id" id="category"
                                    onchange="filterDataByCategory()">
                                    <option value="" selected="selected">All Categories</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="date" id="timeFilter"
                                    onchange="filterDataByNumberDateAgo()">
                                    {{-- <option value="0" selected="selected">Today</option>
                                    <option value="-1">Yesterday</option>
                                    <option value="1">Today</option>
                                    <option value="3">3 Days</option>
                                    <option value="7">1 Week</option> --}}

                                </select>
                                <div class="dropDownSelect2"></div>


                            </div>

                            <label></label>
                            <div class="rs-select2--light rs-select2--md">
                                <input type="date" class="form-control" name="startDate" id="startDate">


                            </div>
                            <label> - To -</label>
                            <div class="rs-select2--light rs-select2--md">
                                <input type="date" class="form-control" name="endDate" id="endDate">


                            </div>
                            <button class="au-btn-filter au-btn-icon au-btn--green au-btn--small"
                                onclick="filterDataByRangeTime()">
                                <i class="zmdi zmdi-filter-list"></i>filters</button>
                            <button class="au-btn-reset au-btn-icon au-btn--green" type="reset" onclick="reset()">
                                <i class="fa fa-refresh"></i>reset</button>
                            {{-- </form> --}}
                        </div>
                        <div class="table-data__tool-right col-md-3">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                                data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>add item</button>
                            <button class="au-btn au-btn-icon au-btn--red au-btn--small" data-toggle="modal"
                                data-target="#delModal">
                                <i class="fa fa-trash"></i>Remove item</button>
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
                    
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 display" id="storysTb">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="au-checkbox">
                                            <input type="checkbox" id="check_uncheck" name="select_all"
                                                onchange="selectAll()">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </th>
                                    <th>Title</th>
                                    <th>Thumb</th>
                                    <th>Category</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-storys">
                                @foreach ($stories as $story)
                                    <tr class="tr-shadow py-3">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="idp" value="{{ $story->id }}">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{ $story->title }}</td>
                                        <td>
                                            <img src="{{ asset($story->thumImg ?? '/a.jpg') }}"
                                                style="height: 45px;width:60px;">
                                        </td>
                                        <td>
                                            {{ $story->category->title }}
                                        </td>
                                        <td>{{ $story->created_at }}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="modal"
                                                    data-target="#edit{{ $story->id }}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-placement="top"
                                                    id="btn-del-item{{ $story->id }}"
                                                    onclick="deleteItem({{ $story->id }})" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>
                                    {{-- <tr class="spacer"></tr> --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>

        </div>

    </div>
    {{-- </div> --}}


    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        data-backdrop="static" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Do you want to remove all items selected !
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="MultiDel()">Confirm</button>
                </div>
            </div>
        </div>
    </div>




    <!-- modal medium -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Thêm truyện</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="card">

                    <div class="card-body">
                        <form action="{{route('create.story')}}" id="addstoryForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#attr"
                                        role="tab" aria-controls="home" aria-selected="true">Thuộc tính</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#seo"
                                        role="tab" aria-controls="profile" aria-selected="false">SEO</a>
                                </li>

                            </ul>
                            <div class="tab-content " id="myTabContent">
                                <div class="tab-pane fade show active" id="attr" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="modal-body">

                                        <div class="row my-2">
                                            <div class="col-md-3 col-12">
                                                <label for="title" class=" form-control-label">Tiêu đề</label>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <input type="text" id="title" name="title"
                                                    placeholder="Nhập tiêu đề" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-md-3 col-12">
                                                <label for="thumImg" class=" form-control-label">title</label>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <input type="file" id="thumImg" name="thumImg"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <!-- <div class="row my-2">
                                            <div class="col-md-3 col-12">
                                                <label for="price" class=" form-control-label">Price</label>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <input type="number" id="price" name="price"
                                                    placeholder="000.000 VND" class="form-control">
                                                <span>VND</span>
                                            </div>
                                        </div> -->


                                        <div class="row my-2">
                                            <div class="col-md-3 col-12">
                                                <label for="category" class=" form-control-label">Danh mục</label>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <select name="category_id" id="category"
                                                    class="form-control-sm form-control">

                                                    {{-- <option value="1">None</option> --}}
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="seo" role="tabpanel"
                                    aria-labelledby="profile-tab">


                                    <div class="row my-2">
                                        <div class="col-md-2 col-12">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                        </div>
                                        <div class="col-md-10 col-12">
                                            <input type="text" id="slug" name="slug"
                                                placeholder="Slug text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-md-2 col-12">
                                            <label for="tag" class=" form-control-label">Tag</label>
                                        </div>
                                        <div class="col-md-10 col-12">
                                            <input type="text" id="tag" name="tag"
                                                placeholder="Tag text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-md-2 col-12">
                                            <label for="des" class=" form-control-label">Description</label>
                                        </div>
                                        <div class="col-md-12 col-12">

                                            <textarea name="des" id="des" rows="10" placeholder="Content of description ..."
                                                class="form-control"></textarea>
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#des'), {

                                                        ckfinder: {
                                                            uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitAdd()">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end modal medium -->

    @foreach ($stories as $story)
        <div class="modal fade" id="edit{{ $story->id }}" tabindex="-1" role="dialog"
            aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                {{-- /update-product/{{ $story->id }} --}}
                <form action="{{ route('update.story', $story->id) }}" id="updateProductForm{{ $story->id }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Update story : {{ $story->title }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="card">
                            {{-- <div class="card-header">
                            <h4>Default Tab</h4>
                        </div> --}}
                            <div class="card-body">
                                <div class="default-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active show" id="nav-home-tab"
                                                data-toggle="tab" href="#nav-attr{{ $story->id }}" role="tab"
                                                aria-controls="nav-home" aria-selected="false">Attribute</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                href="#nav-seo{{ $story->id }}" role="tab"
                                                aria-controls="nav-profile" aria-selected="true">SEO</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-chapter{{ $story->id }}" role="tab" aria-controls="nav-contact" aria-selected="false">Chapter</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade active show" id="nav-attr{{ $story->id }}"
                                            role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="modal-body">

                                                <div class="row my-2">
                                                    <div class="col-md-3 col-12">
                                                        <label for="title" class=" form-control-label">Title</label>
                                                    </div>
                                                    <div class="col-md-9 col-12">
                                                        <input type="text" id="name_update" name="title"
                                                            value="{{ $story->title }}" placeholder="Title"
                                                            class="form-control">
                                                    </div>

                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-md-3 col-12">
                                                        <label for="thumb_update" class=" form-control-label">Thumb Image</label>
                                                    </div>
                                                    <div class="col-md-9 col-12">
                                                        <input type="file" id="thumb_update" name="thumImg"
                                                            class="form-control" value="{{ $story->thumImg }}">
                                                    </div>
                                                </div>


                                                <div class="row my-2">
                                                    <div
                                                        class="col-md-12 col-12 text-center border p-2 d-flex flex-wrap align-content-around ">

                                                        <div class="">
                                                            <div class="" alt=""
                                                                >
                                                                <img id="img_preview_update" src="{{ $story->thumImg }}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-md-3 col-12">
                                                        <label for="title"
                                                            class=" form-control-label">Category</label>
                                                    </div>
                                                    <div class="col-md-9 col-12">
                                                        <select name="category_id" id="category_update"
                                                            class="form-control-sm form-control">
                                                            {{-- <option value="1">None</option> --}}
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if ($story->category_id == $category->id) selected @endif>
                                                                    {{ $category->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="nav-seo{{ $story->id }}" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <div class="modal-body">
                                                <div class="row my-2">
                                                    <div class="col-md-2 col-12">
                                                        <label for="title" class=" form-control-label">Slug</label>
                                                    </div>
                                                    <div class="col-md-10 col-12">
                                                        <input type="text" id="slug_update" name="slug"
                                                            value="{{ $story->slug }}" placeholder="Slug text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-md-2 col-12">
                                                        <label for="title" class=" form-control-label">Tag</label>
                                                    </div>
                                                    <div class="col-md-10 col-12">
                                                        <input type="text" id="tag_update" name="tag"
                                                            value="{{ $story->tag }}" placeholder="Tag text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-md-2 col-12">
                                                        <label for="des"
                                                            class=" form-control-label">Description</label>
                                                    </div>
                                                    <div class="col-md-12 col-12">

                                                        <textarea name="des" id="des_edit{{ $story->id }}" rows="10" placeholder="Content of description ..."
                                                            class="form-control">{{ $story->des }}</textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#des_edit{{ $story->id }}'), {

                                                                    ckfinder: {
                                                                        uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                                                                    }
                                                                })
                                                                .catch(error => {
                                                                    console.error(error);
                                                                });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-md-12 col-12">
                                                        <label for="des" class=" form-control-label">Review
                                                            content</label>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        {!! $story->des !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-chapter{{ $story->id }}" role="tabpanel" aria-labelledby="nav-contact-tab">

                                            <a class="au-btn au-btn-icon au-btn--green au-btn--small my-4" target="_blank" href="{{ route('story.chapter.create', $story->id) }}">New chapter</a>

                                            <div class="d-flex justify-content-between">
                                                <div class="table-responsive table-responsive-data2">
                                                    <table class="table table-data2 display" id="chaptersTb">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>created_at</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="list-storys">
                                                            @foreach ($story->chapters as $chapter)
                                                                <tr class="tr-shadow py-3">

                                                                    <td>{{ $chapter->title }}</td>

                                                                    <td>{{ $chapter->created_at }}</td>

                                                                    <td>
                                                                        <div class="table-data-feature">
                                                                            <a target="_blank" class="item" href="/chapter/edit/{{ $chapter->id }}">
                                                                                <i class="zmdi zmdi-edit"></i>
                                                                            </a>

                                                                            <button class="item"

                                                                            data-placement="top" id="btn-del-item-chapter{{ $chapter->id }}"
                                                                                onclick="deleteItemChapter({{ $chapter->id }})" title="Delete">
                                                                                <i class="zmdi zmdi-delete"></i>
                                                                            </button>

                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                {{-- <tr class="spacer"></tr> --}}
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary"
                                            onclick="submitUpdate({{ $story->id }})">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


        </div>
    @endforeach

    {{-- inputAddFile --}}
    <script>
        $(document).ready(function() {

            var today = new Date();
            var yesterday = new Date(Date.now() - 86400000);
            var threeDayAgo = new Date(Date.now() - 86400000 * 3);
            var weekAgo = new Date(Date.now() - 86400000 * 7);

            var todayDate = today.getDate()
            var todayMonth = ((today.getMonth() + 1) > 9) ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1)
            var todayYear = today.getFullYear()
            // var todayTime = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds()

            var dateStr = todayYear + '-' + todayMonth + '-' + todayDate;


            //yesterday

            var yesterdayDay = yesterday.getDate()
            var yesterdayMonth = ((yesterday.getMonth() + 1) > 9) ? (yesterday.getMonth() + 1) : "0" + (yesterday
                .getMonth() + 1)
            var yesterdayYear = yesterday.getFullYear()
            //var yesterdayTime = yesterday.getHours() + ':' + yesterday.getMinutes() + ':' + yesterday.getSeconds()

            var yesterdayStr = yesterdayYear + '-' + yesterdayMonth + '-' + yesterdayDay;

            //3day

            var thrDay = threeDayAgo.getDate()
            var thrdayMonth = ((threeDayAgo.getMonth() + 1) > 9) ? (threeDayAgo.getMonth() + 1) : "0" + (threeDayAgo
                .getMonth() + 1)
            var thrYear = threeDayAgo.getFullYear()
            var thrTime = threeDayAgo.getHours() + ':' + threeDayAgo.getMinutes() + ':' + threeDayAgo.getSeconds()

            var thrStr = thrYear + '-' + thrdayMonth + '-' + thrDay;


            var wDay = weekAgo.getDate()
            var wMonth = ((weekAgo.getMonth() + 1) > 9) ? (weekAgo.getMonth() + 1) : "0" + (weekAgo.getMonth() + 1)
            var wYear = weekAgo.getFullYear()
            //var wTime = weekAgo.getHours() + ':' + weekAgo.getMinutes() + ':' + weekAgo.getSeconds()

            var wStr = wYear + '-' + wMonth + '-' + wDay;


            console.log(thrStr)

            $('#timeFilter').append(
                `<option value="" selected="selected">Select day</option>`
            );
            $('#timeFilter').append(
                `<option value="${dateStr}">Today</option>`
            );
            $('#timeFilter').append(
                `<option value="${yesterdayStr}" >Yesterday</option>`
            );
            $('#timeFilter').append(
                `<option value="${thrStr}" >3 day ago</option>`
            );

            $('#timeFilter').append(
                `<option value="${wStr}" >1 week</option>`
            );

            ///

            $('#startDate').val(dateStr)
            $('#endDate').val(dateStr)

            // <option value="0" selected="selected">Today</option>
            //                         <option value="-1">Yesterday</option>
            //                         <option value="1">Today</option>
            //                         <option value="3">3 Days</option>
            //                         <option value="7">1 Week</option>

        });
        $(document).ready(function() {
            $('#storysTb').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json'
                },
            });
        });
        $(document).ready(function () {
                $('#chaptersTb').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json'
                    },
                });
            })

        // $(document).ready(function() {
        //     // Setup - add a text input to each footer cell
        //     $('#storysTb thead tr')
        //         .clone(true)
        //         .addClass('filters')
        //         .appendTo('#storysTb thead');

        //     var table = $('#storysTb').DataTable({
        //         orderCellsTop: true,
        //         fixedHeader: true,
        //         initComplete: function() {
        //             var api = this.api();

        //             // For each column
        //             api
        //                 .columns()
        //                 .eq(0)
        //                 .each(function(colIdx) {
        //                     // Set the header cell to contain the input element
        //                     var cell = $('.filters th').eq(
        //                         $(api.column(colIdx).header()).index()
        //                     );
        //                     var title = $(cell).text();
        //                     $(cell).html('<input type="text" placeholder="' + title + '" />');

        //                     // On every keypress in this input
        //                     $(
        //                             'input',
        //                             $('.filters th').eq($(api.column(colIdx).header()).index())
        //                         )
        //                         .off('keyup change')
        //                         .on('change', function(e) {
        //                             // Get the search value
        //                             $(this).attr('title', $(this).val());
        //                             var regexr =
        //                             '({search})'; //$(this).parents('th').find('select').val();

        //                             var cursorPosition = this.selectionStart;
        //                             // Search the column for that value
        //                             api
        //                                 .column(colIdx)
        //                                 .search(
        //                                     this.value != '' ?
        //                                     regexr.replace('{search}', '(((' + this.value +
        //                                         ')))') :
        //                                     '',
        //                                     this.value != '',
        //                                     this.value == ''
        //                                 )
        //                                 .draw();
        //                         })
        //                         .on('keyup', function(e) {
        //                             e.stopPropagation();

        //                             $(this).trigger('change');
        //                             $(this)
        //                                 .focus()[0]
        //                                 .setSelectionRange(cursorPosition, cursorPosition);
        //                         });
        //                 });
        //         },
        //     });
        // });

        function changeImg(id) {

            $('#frmChangeImg' + id).submit();

        }

        function addImg(id) {

            $('#frmAddImg' + id).submit();

        }

        function delImg(id_img) {


            $('#lbDel' + id_img).parents('#img_containter' + id_img).remove();
            // ajax delete
            if (confirm('Do you want to remve this image ?') == true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/del-image/" + id_img,

                    dataType: 'text',
                    success: function(result) {

                        console.log("a", result);
                        //$('#btn-del-item' + id).parents('tr').remove();
                        $('#lbDel' + id_img).parents('#img_containter' + id_img).remove();
                        //alert('Remove is success !!');

                    }
                });
            } else {
                return;
            }


        }

        function selectAll() {

            if ($("#check_uncheck:checked").length) {
                $("input:checkbox[name=idp]").prop("checked", true);
            } else {
                $("input:checkbox[name=idp]").prop("checked", false);
            }
        }

        function submitAdd() {
            var name = $('#title').val();
            var img = $('#img').val();
            var price = $('#price').val();
            var qty = $('#qty').val();
            if (name == '') {
                alert('The name is not null .');
                return;
            }
            if (img == '') {
                alert('The image must be upload .');
                return;
            }
            if (price == '') {
                alert('The price must be set .');
                return;
            }
            if (qty == '') {
                alert('The qty must be set .');
                return;
            }
            $('#addstoryForm').submit();

        }

        function MultiDel() {
            var arrId = new Array();
            $("input:checkbox[name=idp]:checked").each(function() {
                arrId.push($(this).val());
            });



            if (arrId.length == 0) {
                alert("No item is selected");
                return;
            }

            //alert(arrId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ url('multi-del-story') }}",
                data: {
                    arrId
                },
                dataType: 'text',
                success: function(result) {

                    console.log("a", result);
                    arrId.map(function(id) {
                        $('#btn-del-item' + id).parents('tr').remove();
                    })

                    //alert('Remove is success !!');

                }
            });
        }

        function deleteItem(id) {

            if (confirm('Do you want to remove this item ?') == true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "DELETE",
                    url: "del-story/" + id,
                    // data: {
                    //     id
                    // },
                    dataType: 'text',
                    success: function(result) {
                        console.log("a", result);
                        $('#btn-del-item' + id).parents('tr').remove();
                        //alert('Remove is success !!');
                    }
                });
            } else {
                return;
            }


        }

        // 
        function deleteItemChapter(id) {

                if (confirm('Do you want to remove this item ?') == true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: "DELETE",
                        url: "del-chapter/" + id,
                        // data: {
                        //     id
                        // },
                        dataType: 'text',
                        success: function (result) {
                            console.log("a", result);
                            $('#btn-del-item-chapter' + id).parents('tr').remove();
                            //alert('Remove is success !!');
                        }
                    });
                } else {
                    return;
                }


            }
        // 
        function submitUpdate(id) {

            var name = $('#name_update').val();

            var price = $('#price_update').val();
            var qty = $('#qty_update').val();
            if (name == '') {
                alert('The name is not null .');
                return;
            }

            if (price == '') {
                alert('The price must be set .');
                return;
            }
            if (qty == '') {
                alert('The qty must be set .');
                return;
            }
            $('#updatestoryForm' + id).submit();

        }

        // 

        function filterDataByCategory() {
            //alert('iahdihd');
            //
            let category = $('#category').val();

            //remove old data\
            $('#list-storys').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('filter.story.category') }}",
                data: {
                    category
                },
                dataType: 'text',
                success: function(res) {

                    //console.log(JSON.parse(res));
                    //render data

                    let data = JSON.parse(res)
                    // console.log(data.result)
                    let list = data.result;
                    console.log(data.result)
                    list.map(function(item) {
                        var time = convertToTimeStamp(item.created_at);
                        $('#list-storys').append(
                            `
                            <tr class="tr-shadow py-3">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="idp" value="${item.id}">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>${item.title}</td>
                                        <td>
                                            <img src="${item.thumImg ?? '/a.jpg' }"
                                                style="height: 45px;width:60px;">
                                        </td>
                                        <td>
                                           ${item.category.title}
                                        </td>
                                        <td>${item.created_at}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="modal"
                                                    data-target="#edit${item.id}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-placement="top"
                                                    id="btn-del-item${item.id}"
                                                    onclick="deleteItem(${item.id})" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                            `
                        );
                    })


                }
            });

        }

        function filterDataByNumberDateAgo() {
            //
            let day = $('#timeFilter').val();
            //alert(day)
            //remove old data\
            $('#list-storys').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('filter.story.numDay') }}",
                data: {
                    day
                },
                dataType: 'text',
                success: function(res) {

                    //console.log(JSON.parse(res));
                    //render data
                    let data = JSON.parse(res)
                    // console.log(data.result)
                    let list = data.result;
                    console.log(data.result)
                    list.map(function(item) {
                        var time = convertToTimeStamp(item.created_at);
                        $('#list-storys').append(
                        `
                        <tr class="tr-shadow py-3">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="idp" value="${item.id}">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>${item.title}</td>
                                        <td>
                                            <img src="${item.thumImg ?? '/a.jpg'}"
                                                style="height: 45px;width:60px;">
                                        </td>
                                        <td>
                                           ${item.category.title}
                                        </td>
                                        <td>${item.created_at}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="modal"
                                                    data-target="#edit${item.id}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-placement="top"
                                                    id="btn-del-item${item.id}"
                                                    onclick="deleteItem(${item.id})" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                            `
                        );
                    })


                }
            });

        }


        function filterDataByRangeTime() {
            //alert('iahdihd');

            //
            let startDate = $('#startDate').val(); 
            let endDate = $('#endDate').val();

            if (startDate == null || endDate == null) {

                $('#startDate').val('');

            }

            //alert(day)
            //remove old data\
            $('#list-storys').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('filter.story.rangeTime') }}",
                data: {
                    startDate,
                    endDate
                },
                dataType: 'text',
                success: function(res) {

                    //console.log(JSON.parse(res));
                    //render data
                    let data = JSON.parse(res)
                    // console.log(data.result)
                    let list = data.result;

                    console.log(data.result)

                    list.map(function(item) {
                        var time = convertToTimeStamp(item.created_at);
                        $('#list-storys').append(
                            `
                     <tr class="tr-shadow py-3">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="idp" value="${item.id}">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>${item.title}</td>
                                        <td>
                                            <img src="${item.thumImg ?? '/a.jpg'}"
                                                style="height: 45px;width:60px;">
                                        </td>
                                        <td>
                                           ${item.category.title}
                                        </td>
                                        <td>${item.created_at}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="modal"
                                                    data-target="#edit${item.id}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-placement="top"
                                                    id="btn-del-item${item.id}"
                                                    onclick="deleteItem(${item.id})" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                            `
                        );
                    });


                }
            });

        }

        function reset() {
            $('#list-storys').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "GET",
                url: "{{ route('filter.story') }}",

                dataType: 'text',
                success: function(res) {

                    //console.log(JSON.parse(res));
                    //render data
                    let data = JSON.parse(res)
                    // console.log(data.result)
                    let list = data.result;
                    console.log(data.result)
                    list.map(function(item) {
                        var time = convertToTimeStamp(item.created_at);
                        $('#list-storys').append(
                            `
                         <tr class="tr-shadow py-3">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="idp" value="${item.id}">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>${item.title}</td>
                                        <td>
                                            <img src="${item.thumImg ?? '/a.jpg'}"
                                                style="height: 45px;width:60px;">
                                        </td>
                                        <td>
                                           ${item.category.title}
                                        </td>
                                        <td>${item.created_at}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="modal"
                                                    data-target="#edit${item.id}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-placement="top"
                                                    id="btn-del-item${item.id}"
                                                    onclick="deleteItem(${item.id})" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                            `
                        );
                    })

                }
            });
        }

        function convertToTimeStamp(timestr) {

            var a = timestr.split('T')
            var date = a[0]
            var hr = new Date(timestr).getHours()
            var minute = new Date(timestr).getMinutes()
            var second = new Date(timestr).getSeconds()

            /*  */
            var result = date + " " + hr + ":" + minute + ":" + second;
            //document.write(result)
            return result;

        }
    </script>

</x-admin-layout>
