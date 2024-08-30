<x-admin-layout>
    <x-breadcrumb title="Setting"></x-breadcrumb>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row p-3">
                <div class="col-xl-6">

                    {{-- <div class="card mh-100">
                        <form class="p-2">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Text header</h4>
                                <textarea id="headertxt" cols="20" rows="10" onchange="changeTextHeader()">{{ $setting->banner_text }}</textarea>
                               
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#headertxt'), {

                                        ckfinder: {
                                            uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                                        }
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                            </div>
                        </form>
                    </div> --}}

                    <div class="card mh-100">
                        <img class="card-img-top" style="height: 335px" src="{{ asset($setting->banner) }}"
                            id="banner_main" alt="Card image cap">
                        {{-- <form method="POST" id="frnSetBanner_main" enctype="multipart/form-data"> --}}
                        <div class="card-body">
                            <h4 class="card-title mb-3">Banner header</h4>
                            <p>It's was display the first.</p>
                            <h6>(450 x 780)</h6>
                            <p>(Max: 10MB)</p>
                            <input type="file" id="banner_img" name="banner_img" class="form-control-file">
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mh-100">
                        <img class="card-img-top" style="height: 250px" src="{{ asset($setting->contentBanner_left) }}"
                            id="banner_main_left" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Left content banner</h4>
                            <h6>(270 x 570)</h6>
                            <p>(Max: 10MB)</p>
                            <input type="file" id="banner_left" name="banner_img" class="form-control-file">
                        </div>
                    </div>
                    <div class="card mh-100">
                        <img class="card-img-top" style="height: 250px" src="{{ asset($setting->contentBanner_right) }}"
                            id="banner_main_right" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Right content banner</h4>
                            <h6>(270 x 570)</h6>
                            <p>(Max: 10MB)</p>
                            <input type="file" id="banner_right" name="banner_img" class="form-control-file">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-xl-12">
                    <div class="card mh-100">
                        <img class="card-img-top" style="height: 195px"
                            src="{{ asset($setting->contentBanner_heading) }}" id="banner_main_heading"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Right content banner</h4>

                            <input type="file" id="banner_heading" name="banner_img" class="form-control-file">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeTextHeader(){
            alert('called')
        }
        $(document).ready(function(e) {

            //alert('nkjsdahklahkj');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            ////
            $('#banner_img').change(function(e) {

                // alert('jklasjklasdkn')
                // e.preventDefault();
                var file = e.target.files[0]
                var formData = new FormData();
                formData.append('file', file);
                //console.log(formData.get('file'))
                var urlImage = URL.createObjectURL(event.target
                    .files[0])

                $.ajax({
                    type: 'POST',
                    url: "{{ url('set-banner/main') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        // alert('File has been uploaded successfully');
                        console.log(data);
                        $("#banner_main").fadeIn("fast").attr('src', urlImage);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#banner_left').change(function(e) {

                // e.preventDefault();
                var file = e.target.files[0]
                var formData = new FormData();
                formData.append('file', file);
                //console.log(formData.get('file'))
                var urlImage = URL.createObjectURL(event.target
                    .files[0])

                $.ajax({
                    type: 'POST',
                    url: "{{ url('set-banner/left') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        // alert('File has been uploaded successfully');
                        console.log(data);
                        $("#banner_main_left").fadeIn("fast").attr('src', urlImage);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#banner_right').change(function(e) {

                // e.preventDefault();
                var file = e.target.files[0]
                var formData = new FormData();
                formData.append('file', file);
                //console.log(formData.get('file'))
                var urlImage = URL.createObjectURL(event.target
                    .files[0])

                $.ajax({
                    type: 'POST',
                    url: "{{ url('set-banner/right') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        // alert('File has been uploaded successfully');
                        console.log(data);
                        $("#banner_main_right").fadeIn("fast").attr('src', urlImage);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            $('#banner_heading').change(function(e) {

                // e.preventDefault();
                var file = e.target.files[0]
                var formData = new FormData();
                formData.append('file', file);
                //console.log(formData.get('file'))
                var urlImage = URL.createObjectURL(event.target
                    .files[0])

                $.ajax({
                    type: 'POST',
                    url: "{{ url('set-banner/heading') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // this.reset();
                        // alert('File has been uploaded successfully');
                        console.log(data);
                        $("#banner_main_heading").fadeIn("fast").attr('src', urlImage);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $('#headertxt').change(function(e) {
                // e.preventDefault();
                var headerText = e.target.value()
                var formData = new FormData();
                formData.append('headerText', headerText);
                //console.log(formData.get('file'))
                alert('alkdiodod');
                // $.ajax({
                //     type: 'POST',
                //     url: "{{ url('change-text_banner') }}",
                //     data: formData,
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     success: (data) => {
                //         // this.reset();
                //         console.log(data);
                //         // $("#banner_main_left").fadeIn("fast").attr('src', urlImage);

                //     },
                //     error: function(err) {
                //         console.log(err);
                //     }
                // });
            })
        });

    </script>
</x-admin-layout>
