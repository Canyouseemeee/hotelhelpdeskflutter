@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('แจ้งปัญหา') }}</div>

                <div class="card-body">
                    <form action="{{ url('createissues-store/') }}" method="POST">
                        {{ csrf_field() }}
                        @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row" hidden="true">
                            <div class="col-md-6">
                                <input name="Roomid" class="form-control" value="{{$data->Roomid}}" placeholder="{{$data->Roomid}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="NoRoom" class="col-md-4 col-form-label text-md-right">เลขห้อง</label>
                            <div class="col-md-6">
                                <input type="text" name="NoRoom" class="form-control" readonly="readonly" value="{{$data->NoRoom}}" placeholder="{{$data->NoRoom}}">
                            </div>
                        </div>

                        <div class="col-md-3" hidden="true">
                            <label>Status</label>
                            <select name="Statusid" class="form-control create" require>
                                <option value="1" @if (old("Statusid")==1) selected @endif>New</option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="Typeissuesid" class="col-md-4 col-form-label text-md-right">ประเภทปัญหา</label>
                            <div class="col-md-6">
                                <p><select id="Typeissuesid" name="Typeissuesid" class="form-control-md create col-md-6" require>
                                        @foreach($typeissues as $row4)
                                        <option value="{{$row4->Typeissuesid}}" @if (old("Typeissuesid")==$row4->Typeissuesid) selected @endif>{{$row4->Typename}}</option>
                                        @endforeach
                                    </select></p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Subject" class="col-md-4 col-form-label text-md-right">อุปกรณ์ที่ชำรุด</label>
                            <div class="col-md-6">
                                <input type="text" name="Subject" class="form-control" placeholder="อุปกรณ์ที่ชำรุด" value="{{old('Subject')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-md-4 col-form-label text-md-right">หมายเหตุ</label>
                            <div class="col-md-6">
                                <textarea type="text" name="Description" class="form-control" placeholder="หมายเหตุ">{{old('Description')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                        <!-- <label>Uuid</label> -->
                        <input name="temp" class="form-control" placeholder="{{$temp}}" value="{{$temp}}" hidden>
                    </div>

                        <div class="form-group row" hidden="true">
                            <label for="Createby" class="col-md-4 col-form-label text-md-right">ผู้สร้าง</label>
                            <div class="col-md-6">
                                <input name="Createby" class="form-control" readonly="readonly" value="User" placeholder="User">
                            </div>
                        </div>
                        <div class="form-group row" hidden="true">
                            <label>Date</label>
                            <div class="form-group col-md-3">
                                <input type="hidden" name="Date_In" class="form-control" readonly="readonly" value="{{now()->toDateString()}}" placeholder="{{now()->toDateString()}}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    ส่งคำขอ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection