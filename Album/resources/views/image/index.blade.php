@extends('layout.master')
@section('css')
    @toastr_css

@endsection
@section('content')
    <div class="row">
        <h1><span>اسم الالبوم : </span>{{$GetOneAlbum->album_name}}</h1>
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">

                        <h4 class="card-title mg-b-0"><a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة صورة</a></h4>
                        <button type="button" class="button x-small" id="btn_delete_all">
                            حذف الصور المحددة
                        </button>

                    </div>
                </div>
                <div class="card-body">
                            @foreach($GetOneAlbum->GetImages as $list_img)
                                <div class="col-sm-3">
                                    <img class="img-thumbnail" width="200px" height="200px" src="{{asset($list_img->image_path)}}">

                                        <p>{{$list_img->image_name}}</p>

                                    <input type="checkbox"  value="{{ $list_img->id }}">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit{{$list_img->id}}"
                                            title="تعديل"><i class="fa fa-edit"></i> تعديل</button>

                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#delete{{$list_img->id}}" title="حذف"><i class="fa fa-trash"></i> حذف</button>

                                </div>
                                <div class="modal fade" id="edit{{$list_img->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">تعديل الصورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('image.update', 'test')}}" method="post" enctype="multipart/form-data">
                                                {{method_field('patch')}}
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-lg-12">
                                                        <input class="form-control" type="hidden" name="id" value="{{$list_img->id}}" type="text">
                                                        <div class="form-group">
                                                            <label>{{trans('Grade.name_grade_en')}}</label>

                                                            <input class="form-control" name="image" value="" id="path" require placeholder="مسار الصورة" type="file">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>اسم الصورة</label>
                                                            <input class="form-control" name="name" value="" id="path" require placeholder="مسار الصورة" type="text">
                                                        </div>
                                                        <select name="album">
                                                            @foreach($album as $albums)
                                                            <option value="{{$albums->id}}">{{$albums->album_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary" type="submit">حفظ</button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete -->
                                <div class="modal fade" id="delete{{$list_img->id}}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">حذف الصورة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                                              type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="image/destroy" method="post">
                                                {{method_field('delete')}}
                                                {{csrf_field()}}
                                                <div class="modal-body">
                                                    <p>هل انت مأكد من حذف الصورة</p><br>
                                                    <input type="hidden" name="id" value="{{$list_img->id}}" id="id" value="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                </div>
                <div class="modal fade" id="modaldemo8">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">اضافة صورة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('image.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nf-password">الصورة</label>
                                                    <input type="file" id="image" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nf-email">اسم الصورة</label>
                                                    <input type="text" id="album_name" name="name" class="form-control" placeholder="اسم الصورة">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select id="select" name="album" class="form-control" size="1">
                                                    @foreach($album as $albums)
                                                        <option value="{{$albums->id}}">{{$albums->album_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-primary" type="submit">حفظ</button>
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                    حذف الصور المحددة
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('delete_all') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    هل انت متأكد من حذف الصور المحددة
                                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

