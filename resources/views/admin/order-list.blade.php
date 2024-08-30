<x-admin-layout>
    <x-breadcrumb title="Orders"></x-breadcrumb>
    <div class="col-md-12">
        <!-- DATA TABLE -->

        {{-- <h3 class="title-5 m-b-35">All products</h3> --}}
        <div class="row table-data__tool border p-3">

            <div class="table-data__tool-left col-md-9">
                {{-- <form action="{{route('filter.product')}}" method="GET" enctype="multipart/form-data">
                    @csrf --}}
                {{-- <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="category_id" id="category" onchange="filterDataByCategory()">
                        <option value="" selected="selected">All Categories</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                    <div class="dropDownSelect2"></div>
                </div> --}}
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="status" id="statusFilter" onchange="filterDataByStatus()">
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
                {{-- <label> - To -</label> --}}
                <div class="rs-select2--light rs-select2--md">
                    <input type="date" class="form-control" name="endDate" id="endDate">


                </div>
                <button class="au-btn-filter au-btn-icon au-btn--green au-btn--small" onclick="filterDataByRangeTime()">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
                <button class="au-btn-reset au-btn-icon au-btn--green" type="reset" onclick="reset()">
                    <i class="fa fa-refresh"></i>reset</button>
                {{-- </form> --}}
            </div>
            <div class="table-data__tool-right col-md-3">
                {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                    data-target="#addModal">
                    <i class="zmdi zmdi-plus"></i>add item</button> --}}
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
            <table class="table table-data2 display" id="orderTb">
                <thead>
                    <tr>
                        <th>
                            <label class="au-checkbox">
                                <input type="checkbox" id="check_uncheck" name="select_all" onchange="selectAll()">
                                <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>User order</th>
                        <th>discount</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="list-orders">

                    @foreach ($orders as $order)
                        <tr class="tr-shadow me-3">
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox" name="ido" value="{{ $order->id }}">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td> {{ $order->user->name }} </td>
                            <td>
                                {{ $order->discount }}
                            </td>

                            <td>
                                <span class="status--cancel">{{ $order->status }}</span>
                            </td>
                            <td>
                                <span>{{ $order->created_at }}</span>
                            </td>
                            <td> $ {{ number_format($order->price_order) }}</td>
                            <td>
                                <div class="table-data-feature">

                                    <button class="item" data-toggle="modal" data-target="#edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>


                                    <button class="item" data-placement="top" id="btn-del-item" onclick="deleteItem()"
                                        title="Delete">
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
    <script>
        $(document).ready(function() {

            $('#statusFilter').append(
                `<option value="" selected="selected">-Status order-</option>`
            );
            $('#statusFilter').append(
                `<option value="cancel">Cancel</option>`
            );
            $('#statusFilter').append(
                `<option value="payment">Payment</option>`
            );


            ///

            // $('#startDate').val(dateStr)
            // $('#endDate').val(dateStr)

            // <option value="0" selected="selected">Today</option>
            //                         <option value="-1">Yesterday</option>
            //                         <option value="1">Today</option>
            //                         <option value="3">3 Days</option>
            //                         <option value="7">1 Week</option>

        });
        $(document).ready(function() {
            $('#orderTb').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json'
                },
            });
        });


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
                $("input:checkbox[name=ido]").prop("checked", true);
            } else {
                $("input:checkbox[name=ido]").prop("checked", false);
            }
        }

        function submitAdd() {


            var name = $('#name').val();
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
            $('#addProductForm').submit();

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
                url: "{{ url('multi-del-products') }}",
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

            if (confirm('Do you want to remvo this item ?') == true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "del-product/" + id,
                    data: {
                        id
                    },
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
            $('#updateProductForm' + id).submit();

        }

        // 

        function filterDataByStatus() {
            //alert('iahdihd');
            //
            let status = $('#statusFilter').val();

            //remove old data\
            $('#list-orders').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('filter.order.status') }}",
                data: {
                    status
                },
                dataType: 'text',
                success: function(res) {

                    // console.log(JSON.parse(res));
                    //render data

                    let data = JSON.parse(res)
                    console.log(data.result)

                    let list = data.result;

                    list.map(function(item) {
                        var time = convertToTimeStamp(item.order.created_at);
                        $('#list-orders').append(
                            `
                            <tr class="tr-shadow me-3">
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox" name="ido" value="${item.id}">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td> ${item.user.name} </td>
                            <td>
                                ${item.order.fee}
                            </td>

                            <td>
                                <span class="status--cancel">${item.order.status}</span>
                            </td>
                            <td>
                                <span>${time}</span>
                            </td>
                            <td> $ ${item.order.price_order}</td>
                            <td>
                                <div class="table-data-feature">

                                    <button class="item" data-placement="top" id="btn-del-item" onclick="deleteItem()"
                                        title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>
                            `
                        );
                    })


                },
                error:(err)=>{
                    console.log(err)
                }
            });

        }

        // function filterDataByNumberDateAgo() {
        //     //alert('iahdihd');
        //     //
        //     let day = $('#timeFilter').val();
        //     //alert(day)
        //     //remove old data\
        //     $('#list-products').empty();
        //     //
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         method: "POST",
        //         url: "{{ route('filter.product.numDay') }}",
        //         data: {
        //             day
        //         },
        //         dataType: 'text',
        //         success: function(res) {

        //             //console.log(JSON.parse(res));
        //             //render data
        //             let data = JSON.parse(res)
        //             // console.log(data.result)
        //             let list = data.result;
        //             console.log(data.result)
        //             list.map(function(item) {
        //                 var time = convertToTimeStamp(item.product.created_at);
        //                 $('#list-products').append(
        //                     `
    //                     <tr class="tr-shadow py-3">
    //                                 <td>
    //                                     <label class="au-checkbox">
    //                                         <input type="checkbox" name="idp" value="${item.product.id}">
    //                                         <span class="au-checkmark"></span>
    //                                     </label>
    //                                 </td>
    //                                 <td>${item.product.name}</td>
    //                                 <td>


    //                                     <img src="${item.imgs[0].img}"
    //                                         style="height: 40px">

    //                                 </td>

    //                                 <td>${time}</td>
    //                                 <td>
    //                                     <span class="status--process">${item.product.quanlity}</span>
    //                                 </td>
    //                                 <td>$${item.product.price}</td>
    //                                 <td>
    //                                     <div class="table-data-feature">

    //                                         <button class="item" data-toggle="modal"
    //                                             data-target="#edit${item.product.id}">
    //                                             <i class="zmdi zmdi-edit"></i>
    //                                         </button>


    //                                         <button class="item" data-placement="top"
    //                                             id="btn-del-item${item.product.id}"
    //                                             onclick="deleteItem(${item.product.id})" title="Delete">
    //                                             <i class="zmdi zmdi-delete"></i>
    //                                         </button>

    //                                     </div>
    //                                 </td>

    //                             </tr>
    //                     `
        //                 );
        //             })


        //         }
        //     });

        // }


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
            $('list-orders').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('filter.product.rangeTime') }}",
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
                        var time = convertToTimeStamp(item.product.created_at);
                        $('#list-products').append(
                            `
                            <tr class="tr-shadow py-3">
                                        

                            </tr>
                            `
                        );
                    });


                }
            });

        }

        function reset() {
            $('#list-orders').empty();
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "GET",
                url: "{{ route('filter.products') }}",

                dataType: 'text',
                success: function(res) {

                    //console.log(JSON.parse(res));
                    //render data
                    let data = JSON.parse(res)
                    // console.log(data.result)
                    let list = data.result;
                    console.log(data.result)
                    list.map(function(item) {
                        var time = convertToTimeStamp(item.product.created_at);
                        $('#list-products').append(
                            `
                            <tr class="tr-shadow py-3">
                                        
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
