<x-admin-layout>
    <x-breadcrumb title="Create chapter"></x-breadcrumb>

    <div class="section__content section__content--p30 py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h3 class="title-5 m-b-35">New chapter</h3> -->
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
                        <!-- <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div> -->
                        <script>
                             if (confirm("Chapter is added ! . Do you want to close this tab ?") == true) {
                                    window.close();
                                } else {
                                    // text = "You canceled!";
                                    window.location = "{{route('stories')}}";
                                }
                        </script>
                    @endif

                    <div class="col-md-12">   
                        <div class="card-body">
                             <form action="{{route('story.chapter.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                <div class="card">
                                        <div class="card-header">
                                            <strong>New chapter</strong> {{$story->title}}
                                        </div>
                                        <div class="card-body card-block">
                                           
                                                <div class="row form-group">
                                                    <div class="col col-md-1">
                                                        <label for="title" class=" form-control-label">Title</label>
                                                    </div>
                                                    <div class="col-12 col-md-11">
                                                        <input type="text" id="title" name="title" placeholder="Title chapter" class="form-control">
                                                        <small class="form-text text-muted">This is a title for chapter</small>


                                                        <input type="text" id="story_id" name="story_id" placeholder="" class="form-control d-none" value="{{$story->id}}">
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col col-md-1">
                                                        <label for="textarea-input" class=" form-control-label">Content</label>
                                                    </div>
                                                    <div class="col-12 col-md-11">
                                                       <textarea name="content" id="content" rows="10" placeholder="Content of description ..." class="form-control"></textarea>
                                                    <script>
                                                        ClassicEditor
                                                            .create(document.querySelector('#content'), {

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
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-check-circle"></i> Submit
                                            </button>
                                            <button type="reset" class="btn btn-info btn-sm">
                                                <i class="fa fa-mail-reply"></i> Reset
                                            </button>
                                        </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>
    
        </div>
    
    </div>
    <!-- END DATA -->
    <script>

    </script>
</x-admin-layout>    