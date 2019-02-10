@extends('app')

@section('css')

@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Posts</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" onclick="location.reload()">
                                            Posts List
                                        </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#create" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                            Create Post
                                        </a>
                                    </li>
                                </ul>

                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="list"
                                         aria-labelledby="home-tab">
                                        <table id="datatable-buttons" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Created Date</th>
                                                <th>Content</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Delete</th>
                                                <th>Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($posts as $post)
                                                <tr>
                                                    <td>{{ $post->created_at->toDateTimeString() }}</td>
                                                    <td>{{ $post->content }}</td>
                                                    <td>
                                                        @foreach($post->categories as $category)
                                                            <a href="{{ route('getCategorizedPosts', [ $category->id ]) }}">- {{$category->title}} <span style="color:red;">( Click to see posts )</span></a>
                                                        @endforeach
                                                        @if(count($post->categories) < 1) *not yet added* @endif
                                                    </td>
                                                    <td>
                                                        @foreach($post->tags as $tag)
                                                            <a href="{{ route('getTaggedPosts', [ $tag->id ]) }}">- {{$tag->title}}<span style="color:red;"> ( Click to see posts )</span></a>
                                                        @endforeach
                                                        @if(count($post->tags) < 1) *not yet added* @endif
                                                    </td>
                                                    <td> <input type="button" class="btn btn-danger" value="Delete" onclick="del(this,'{{ $post->id }}')"> </td>
                                                    <td>
                                                        <a href="{{ route('getPostById', [ $post->id ]) }}" class="btn btn-primary">Update</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="create" aria-labelledby="home-tab">

                                        <form method="POST" id="posts-form" action="{{ route('createPost') }}"
                                              data-parsley-validate class="form-horizontal form-label-left">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Content
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea name="content"
                                                              class="form-control col-md-7 col-xs-12"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success">Create</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
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

            $('#posts-form').ajaxForm({
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
                    )

                }
            });

        });

        function del(element, id)
        {
            var row = element.parentNode.parentNode.rowIndex;

            swal({
                title: 'Are you sure?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, delete!'
            }).then(function (result) {
                if(result.value)
                {
                    $.ajax({
                        url: "/posts/delete/"+id,
                        beforeSubmit:function () {
                            swal({
                                title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                                text: 'Loading, please wait...',
                                showConfirmButton: false
                            })

                        },
                        success:function (response) {
                            if(response.status = 'success') document.getElementById('datatable-buttons').deleteRow(row);

                            swal(
                                response.title,
                                response.content,
                                response.status
                            )
                        }
                    })

                }
            })

        }

    </script>


@endsection
