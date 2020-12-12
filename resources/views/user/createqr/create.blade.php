@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('แจ้งปัญหา') }}</div>

                <div class="card-body">
                    <form action="{{ url('createissues-user/'.$data->roomid) }}" method="PUT">
                        {{ csrf_field() }}
                        @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="NoRoom" class="col-md-4 col-form-label text-md-right">เลขห้อง</label>

                            <div class="col-md-6">

                                <input name="NoRoom" class="form-control" readonly="readonly" value="{{$data->NoRoom}}" placeholder="{{$data->NoRoom}}">

                                @error('NoRoom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>NoRoom ไม่ถูกต้อง</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">อุปกรณ์ที่ชำรุด</label>
                            <div class="col-md-6">
                                <input type="text" name="subject" class="form-control" placeholder="อุปกรณ์ที่ชำรุด" value="{{old('Subject')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">หมายเหตุ</label>
                            <div class="col-md-6">
                            <textarea type="text" name="note" class="form-control" placeholder="หมายเหตุ">{{old('note')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="Createby" class="col-md-4 col-form-label text-md-right">ผู้สร้าง</label>
                            <div class="col-md-6">
                            <input name="Createby" class="form-control" readonly="readonly" value="User" placeholder="User">
                            </div>
                        </div>
                        <div class="form-group row" >
                        <label>Date</label>
                        <div class="form-group col-md-3">
                            
                            <input name="Date_In" class="form-control" readonly="readonly" value="{{now()->toDateString()}}" placeholder="{{now()->toDateString()}}">
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