@extends('Template.template')
@section('title')
Data Siswa | Journal
@endsection
@section('content')
<div class="container">
    <!-- Header -->
    <div class="header">
        <h3>Jurnal KOE</h3>
        <form action="" method="get">
            <div class="form-group">
                <input type="date" class="form-control datepicker" id="date" name="date" value="{{$dx}}">
                <button type="submit" class="btn filters">
                    <i class="fas fa-filter"></i>
                </button>
                @if ($jam == "home")
                <button type="button" class="btn danger" data-toggle="modal">
                    <i class="fas fa-minus"></i>
                </button>
                @elseif($jam == "break")
                <button type="button" class="btn danger" data-toggle="modal">
                    <i class="fas fa-minus"></i>
                </button>
                @else
                <button type="button" class="btn tambah" data-toggle="modal" data-target="#modalscrollable">
                    <i class="fas fa-plus"></i>
                </button>
                @endif
            </div>
        </form>
    </div>
    <!-- Content -->
    <div class="konten">
        <a href="#modalx" class="btn btn-print" data-toggle="modal" id="printModal">
            <i class="material-icons print-icon">print</i> <span>Print PDF</span>
        </a>
        <div class="unverify mb-4">
            <div class="top">
                <h5>Jurnal Belum Terverifikasi</h5>
                <span class="mb-3"></span>
            </div>
        </div>
        @forelse ($jurnal as $jurnals)
        <div class="list">
            <div class="item">
                <a class="item-swipe itemDesk" href="#navCtrl" data-toggle="modal">
                    <div class="jamke">
                        {{$jurnals->jam}} - {{$jurnals->kelas->kelas}}
                    </div>
                    <div class="mapel">{{$jurnals->mapel->mapel}}</div>
                </a>
                <div class="modal fade" id="navCtrl" tabindex="-1" role="modal" aria-labelledby="myModal" width="100%">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <div class="modal-body">
                                <div class="form-group text-center" style="display: flex">
                                    <button class="btn btn-detail mr-2" type="button" style="flex: 1;">
                                        <a href="/jurnal/{{$jurnals->id}}/info">
                                            <span class="material-icons">info</span>
                                            <div class="link-action">
                                                <h6>
                                                    Detail
                                                </h6>
                                            </div>
                                        </a>
                                    </button>
                                    <button class="btn btn-acc delete-confirm" type="button" style="flex: 1;">
                                        <a href="/jurnal/{{$jurnals->id}}/edit">
                                            <span class="material-icons">person</span>
                                            <div class="link-action">
                                                <h6>
                                                    Absen
                                                </h6>
                                            </div>
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="item-swipe swipe-two itemMobile" href="/jurnal/{{$jurnals->id}}/info">
                    <div class="jamke">
                        {{$jurnals->jam}} - {{$jurnals->kelas->kelas}}
                    </div>
                    <div class="mapel">{{$jurnals->mapel->mapel}}</div>
                </a>
                <div class="item-back">
                    <button class="action first btn-edit" type="button">
                        <a href="/jurnal/{{$jurnals->id}}/edit">
                            <span class="material-icons">person</span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="list">
            <div class="item">
                <a class="item-swipex" href="#">
                    <center>
                        Jurnal Hari ini Kosong
                    </center>
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="verify mb-4">
        <div class="top">
            <h5>Jurnal Terverifikasi</h5>
            <span class="mb-3"></span>
        </div>
    </div>

    <!-- Modal Section -->
    <div class="modal fade" id="modalscrollable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" width="100%">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tambah Jurnal.
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="/jurnal/create-post" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group col-sm-12">
                                    <select class="form-control m-input" name="mapel" required>
                                        <option value="">Mata Pelajaran</option>
                                        @foreach ($mpl as $mapels)
                                        <option value="{{$mapels->id}}">{{$mapels->mapel}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Mapel Harus Diisi !</div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <select class="form-control m-input" name="guru" required>
                                        <option value="">Guru Mata Pelajaran</option>
                                        @foreach ($gr as $gurus)
                                        <option value="{{$gurus->id}}">{{$gurus->nama}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Guru Mapel Harus Diisi !</div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="text" class="form-control" name="materi"
                                        placeholder="Materi Yang Diberikan" autocomplete="off" required>
                                    <div class="invalid-feedback">Materi Harus Diisi !</div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan"
                                        autocomplete="off">
                                </div>
                                <div class="form-group col-sm-12" style="align-items: flex-end">
                                    <div class="input-group btn-form">
                                        <button type="submit" class="btn btn-success btn-submit mr-3">
                                            <i class="fas fa-plus"></i>Tambah Jurnal
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    <div class="modal fade" id="modalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        width="100%">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Print Jurnal
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="/jurnal/print" method="POST">
                        @csrf
                        <input class=" form-control" name="bulan" type="month" value="2020-07">
                        <br>
                        @if (Auth::user()->role == 2)
                        <select class="form-control datepicker" name="kelas" required>
                            <option value="00">Semua</option>
                            @foreach ($cls as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->kelas}}</option>
                            @endforeach
                        </select>
                        <br>
                        @endif
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
