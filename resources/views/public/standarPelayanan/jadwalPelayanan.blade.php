@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1 text-white">Jadwal Pelayanan PPID</h2>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header custom-bg text-white">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 15%;">Hari</th>
                            <th style="width: 25%;">Jam Pelayanan 1</th>
                            <th style="width: 25%;">Jam Istirahat</th>
                            <th style="width: 25%;">Jam Pelayanan 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Senin</td>
                            <td>08.00 – 12.00 WITA</td>
                            <td>12.00 – 13.00 WITA</td>
                            <td>13.00 – 15.30 WITA</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Selasa</td>
                            <td>08.00 – 12.00 WITA</td>
                            <td>12.00 – 13.00 WITA</td>
                            <td>13.00 – 15.30 WITA</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Rabu</td>
                            <td>08.00 – 12.00 WITA</td>
                            <td>12.00 – 13.00 WITA</td>
                            <td>13.00 – 15.30 WITA</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Kamis</td>
                            <td>08.00 – 12.00 WITA</td>
                            <td>12.00 – 13.00 WITA</td>
                            <td>13.00 – 15.30 WITA</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Jum'at</td>
                            <td>09.00 – 11.30 WITA</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
