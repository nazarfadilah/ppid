@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Wisthle Blower System (WBS)</h2>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="text-center mb-4">
                <p>
                    Whistle Blower System adalah mekanisme yang disediakan oleh bagi seseorang (pelapor) yang memiliki informasi dan ingin melaporkan suatu perbuatan berindikasi pelanggaran yang terjadi di lingkungan
                </p>
                <p>
                    ANDA TIDAK PERLU KHAWATIR TERUNGKAPNYA IDENTITAS DIRI ANDA KARENA KAMI AKAN MERAHASIAKAN IDENTITAS DIRI ANDA SEBAGAI PELAPOR. KAMI MENGHARGAI SEGALA INFORMASI YANG ANDA LAPORKAN.
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th>Nama Formulir</th>
                            <th style="width: 120px;">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Formulir Wisthle Blower System (WBS)</td>
                            <td>
                                <a href="{{ route('whistle-bowling') }}" class="btn btn-primary btn-sm">Isi Formulir</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
