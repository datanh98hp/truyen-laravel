<x-admin-layout>
    <x-breadcrumb title="Setting"></x-breadcrumb>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 my-3">
                    <form id="frmBasicInf" action="/set-inf" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <strong>Information</strong>
                                <small>Basic</small>
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="store_name" class=" form-control-label">Shop name</label>
                                    <input type="text" id="store_name" name="store_name"
                                        value="{{ $setting->store_name }}" placeholder="Enter your shop name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Time open</label>
                                    <div class="d-flex">

                                        <input type="text" id="timeStart" name="timeStart"
                                            value="{{ $setting->timeStart }}" placeholder="Enter your time start"
                                            class="form-control">

                                        <input type="text" id="timeClose" name="timeClose"
                                            value="{{ $setting->timeClose }}" placeholder="Enter time close"
                                            class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="email" class=" form-control-label">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $setting->email }}"
                                        placeholder="email@examplemail.com" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address" class=" form-control-label">Address</label>
                                    <input type="text" id="address" name="address" value="{{ $setting->address }}"
                                        placeholder="Enter street name" class="form-control">
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="city" class=" form-control-label">City</label>
                                            <input type="text" id="city" name="city"
                                                value="{{ $setting->city }}" placeholder="Enter your city"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="pos_code" class=" form-control-label">Postal Code</label>
                                            <input type="number" id="pos_code" name="pos_code"
                                                value="{{ $setting->pos_code }}" placeholder="Postal Code"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="country" class=" form-control-label">Country</label>
                                    <input type="text" id="country" placeholder="Country name" class="form-control">
                                </div> --}}

                                <button id="save-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa fa-save"></i>&nbsp;
                                    <span id="payment-button-amount">Save</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 my-3">
                    <form id="maketinginffrm" method="POST" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <strong>Information</strong>
                                <small>Maketing</small>
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="facebook_url" class=" form-control-label">facebook_url</label>
                                    <input type="text" id="facebook_url" name="facebook_url" placeholder="URL"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="tiktok_url" class=" form-control-label">tiktok_url</label>
                                    <input type="url" id="tiktok_url" name="tiktok_url" placeholder="URL"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address" class=" form-control-label">map_key</label>
                                    <input type="text" id="map_key" name="map_key"
                                        placeholder="Enter street name" class="form-control">
                                </div>

                                {{-- <div class="form-group">
                                    <label for="country" class=" form-control-label">Country</label>
                                    <input type="text" id="country" placeholder="Country name" class="form-control">
                                </div> --}}

                                <button id="save-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa fa-save"></i>&nbsp;
                                    <span id="payment-button-amount">Save</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <script>
            $('#frmBasicInf').submit(function(e) {

                e.preventDefault();

                let store_name = $('#store_name').val();
                let timeStart = $('#timeStart').val();
                let timeClose = $('#timeClose').val();
                let email = $('#email').val();
                let address = $('#address').val();
                let city = $('#city').val();
                let pos_code = $('#pos_code').val();
                if (store_name == "") {
                    alert('Store name has been required');
                    return;
                }

                if (timeStart == "") {
                    alert('Store name has been required');
                    return;
                }

                if (email == "") {
                    alert('Email has been required');
                    return;
                }

                if (address == "") {
                    alert('Address has been required');
                    return;
                }

                if (city == "") {
                    alert('Address has been required');
                    return;
                }

                if (pos_code == "") {
                    alert('Postal Code has been required');
                    return;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData();
                formData.append('store_name', store_name);
                formData.append('timeStart', timeStart);
                formData.append('timeClose', timeClose);
                formData.append('address', address);
                formData.append('email', email);
                formData.append('city', city);
                formData.append('pos_code', pos_code);
                $.ajax({
                    method: "POST",
                    url: "{{ url('set-inf') }}",
                    data: formData,
                    contentType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result.result == 1) {
                            alert('The information was changed')
                        } else {
                            alert('Something went wrong ! ')
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }

                })

            });

            $('#maketinginffrm').submit(function(e) {

                e.preventDefault();

                let facebook_url = $('#facebook_url').val();
                let tiktok_url = $('#tiktok_url').val();
                
                let map_key = $('#map_key').val();

                
                if (facebook_url == "") {
                    alert('facebook_url has been required');
                    return;
                }

                if (tiktok_url == "") {
                    alert('tiktok_url has been required');
                    return;
                }

                if (map_key == "") {
                    alert('map_key has been required');
                    return;
                }

        
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData();
                formData.append('facebook_url', facebook_url);
                formData.append('tiktok_url', tiktok_url);
                formData.append('map_key', map_key);
                
                $.ajax({
                    method: "POST",
                    url: "{{ url('set-maketinginf') }}",
                    data: formData,
                    contentType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result.result == 1) {
                            alert('The information was changed')
                        } else {
                           // alert('Something went wrong ! ')
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }

                })

            });
        </script>
    </div>


</x-admin-layout>
