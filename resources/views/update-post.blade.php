@extends('app')

@section('css')

@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update Post</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form method="POST" id="update-post-form" action="{{ route('updatePost') }}"
                          data-parsley-validate class="form-horizontal form-label-left">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Post Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Content</h4>
                                    <textarea type="text" class="form-control" name="content" id="content">{{$post->content}}</textarea>
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <h4>Tags</h4>
                                    @foreach( $tags as  $tag )
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="tag_id[]" value="{{$tag->id}}" id="{{$tag->id}}">
                                            <span>{{$tag->title}}</span>
                                        </label>
                                    @endforeach
                                    <h4>Categories</h4>
                                    <div class="col-md-12">
                                    <select class="form-control" name="category_id" id="category">
                                        @foreach($categories as $category)
                                            @if($category->type == "parent")
                                                <option value="{{$category->id}}">{{ $category->title }}</option>
                                                @foreach($category->child as $subcategory)
                                                    <option value="{{$subcategory->id}}">{{$category->title}} / {{ $subcategory->title }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('js')

    <script src="/js/jquery.form.min.js"></script>
    <script src="/js/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#update-post-form').ajaxForm({
                beforeSubmit: function () {

                    swal({
                        title: '<i class="fa fa-spinner fa-spin" style="font-size:28px"></i>',
                        text: 'Loading, please wait...',
                        showConfirmButton: false
                    })

                },
                success: function (response) {

                    swal(
                        response.title,
                        response.content,
                        response.status
                    );

                    setTimeout(function()
                    {
                        window.location="{{route('getPosts')}}"
                    }, 1000);

                }
            });

            @foreach( $post->tags as $key => $deneme )

                $('#{{$deneme->id}}').prop('checked', true);

            @endforeach

            @foreach( $post->categories as $key => $deneme )

                $('#category').val({{$deneme->id}});

            @endforeach



        });


    </script>


@endsection
