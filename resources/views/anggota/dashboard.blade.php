@extends('layouts.master')

@section('title', 'Dashboard')
@section('navTitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-exchange"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Peminjaman</span>
            <span class="info-box-number">{{ $totalPeminjaman }}</span>
        </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-undo"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Pengembalian</span>
            <span class="info-box-number">{{ $totalPengembalian }}</span>
        </div>
        </div>
    </div>
</div>
@endsection
