<!DOCTYPE html>
<html>

<head>
    <title>Cetak</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="text-center" style="margin-top: 30px">
        <h5><b>LAPORAN KEHADIRAN MENTORING</b></h5>
        <h5>Character Building Training (CBT)</h5>
    </div>
    <div class="table-responsive">
        <table class='table table-bordered' style="margin: 20px auto; width: 80%;">
            <thead> 
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Rekapitulasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as  $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nip_nim }}</td>
                    <td>{{ $item->mahasiswa->name }}</td>
                    <td>{{ $item->mahasiswa->jurusan }}</td>
                    <td>
                        @php
                            $totalKehadiran = $totalAbsensi[$item->mahasiswa_id]; // Total kehadiran
                            $minimalKehadiran = 5; // Syarat minimal kehadiran untuk mencapai 100%
                            $persentaseKehadiran = ($totalKehadiran / $minimalKehadiran) * 100;

                            // Kita batasi persentase kehadiran maksimal menjadi 100%
                            $persentaseKehadiran = $persentaseKehadiran > 100 ? 100 : $persentaseKehadiran;
                        @endphp
                        {{ $persentaseKehadiran }} %
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <table style="margin: 20px auto; width: 80%;">
        <tr>
            <td width = "700px"></td>
            <td>Samata, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td width = "700px"></td>
            <td>Ketua Ma'had Al Jamiah</td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td width = "700px"></td>
            <td>Prof. Syahrudin Usman, M. Pd</td>
        </tr>
        <tr>
            <td width = "700px"></td>
            <td>NIP. </td>
        </tr>

        <tr>
            <td>
                <a href="{{ URL::Previous() }}" class="btn btn-secondary">Kembali</a>
                <button id="printButton" class="btn btn-info">Cetak</button>
            </td>
            <td></td>
        </tr>
    </table>
</body>
<script>
    document.getElementById("printButton").addEventListener("click", function() {
        window.print(); // Membuka jendela cetak (Print Window)
    });
</script>
</html>
