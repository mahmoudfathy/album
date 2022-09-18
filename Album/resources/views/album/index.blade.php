@extends('layout.master')
@section('css')
    @toastr_css

@endsection

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"><a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة البوم جديد</a></h4>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($list_album as $album)
                        <div class="col-sm-3">
                            <img class="img-thumbnail" width="200px" height="200px" src="{{asset($album->album_img)}}">
                            <a href="{{route('album.photo', $album->id)}}">
                                <p>{{$album->album_name}}</p>
                            </a>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit{{$album->id}}"
                                    title="تعديل"><i class="fa fa-edit"></i> تعديل</button>

                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#delete{{$album->id}}" title="حذف"><i class="fa fa-trash"></i> حذف</button>

                        </div>
                        <div class="modal fade" id="edit{{$album->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">تعديل الصورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{route('album.update', 'test')}}" method="post" enctype="multipart/form-data">
                                        {{method_field('patch')}}
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <input class="form-control" type="hidden" name="id" value="{{$album->id}}" type="text">
                                                <div class="form-group">
                                                    <label>{{trans('Grade.name_grade_en')}}</label>

                                                    <input class="form-control" name="image" value="" id="path" require type="file">
                                                </div>
                                                <div class="form-group">
                                                    <label>اسم الصورة</label>
                                                    <input class="form-control" name="name" value="" id="path" require placeholder="اسم الصورة" type="text">
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
                        <!-- delete -->
                        <div class="modal fade" id="delete{{$album->id}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">حذف الالبوم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                                      type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="album/destroy" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <p>هل انت متأكد من حذف الالبوم</p><br>
                                            <input type="hidden" name="id" value="{{$album->id}}" id="id" value="">
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
                        </tbody>
                        </table>
                </div>
                <div class="modal fade" id="modaldemo8">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">اضافة صورة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('album.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nf-password">صورة الالبوم</label>
                                                    <input type="file" id="image" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nf-email">اسم الالبوم</label>
                                                    <input type="text" id="album_name" name="name" class="form-control" placeholder="type you facebook link">
                                                </div>
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
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

