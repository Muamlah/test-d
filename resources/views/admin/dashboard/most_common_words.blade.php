@extends('admin.layouts.adminLayout')
@section('content')
<style>
    .word{
        border: 2px solid;
    }
    .word h3{
        background: #1e1e2d;
        width: 50%;
        padding: 30px;
        text-align: center;
        border-radius: 50%;
        color: #fff;
        font-weight: bold;
        margin: 10px auto 20px;
    }
    .word span{
        border-top: 1px solid #f1f1f1;
        padding-top: 12px;
    }
</style>
<div class="">
    <div class="col-lg-12 col-sm-12">
        <div class="row pt-4">
            @foreach($words as $word => $count)
                <div class="card p-4 m-5 col-lg-2 col-sm-12 text-center word">
                    <h3>
                        {{$count}}
                    </h3>
                    <span>
                        {{$word}}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection