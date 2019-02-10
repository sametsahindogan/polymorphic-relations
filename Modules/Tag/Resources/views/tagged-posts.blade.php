@extends('app')

@section('css')

@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Tagged Posts</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Tag: {{$tag->title}}</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Posts</h4>
                                    <hr>
                                    @foreach($tag->posts as $post)
                                        <p> <a href="{{ route('getPostById', [ $post->id ]) }}">{{ $post->content }} <span style="color:red;">( Click to update post )</span></a> / {{ $post->created_at }} </p>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <p><i> {{ count($tag->posts) }} post(s) found. </i></p>
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

@endsection
