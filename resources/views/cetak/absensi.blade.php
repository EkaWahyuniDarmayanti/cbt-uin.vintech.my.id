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
    <center>
        <h5>Laporan Kehadiran Mentoring</h5>
        <h5>Character Building Training</h5>
    </center>
    <p>
        Nama : {{ $mahasiswa->name }}<br>
        NIM : {{ $mahasiswa->nip_nim }}<br>
        Jurusan : {{ $mahasiswa->jurusan }}<br>
        Angkatan : {{ $angkatan->angkatan }}<br>
    </p>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Jadwal</th>
                <th>Topik</th>
                <th>Kehadiran</th>
                <th>Mentoring Ke</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as  $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('D MMMM Y') }}</td>
                <td>{{ $item->jadwal->topik }}</td>
                <td>
                    @if ($item->hadir == 1)
                        Hadir
                    @else
                        Tidak Hadir
                    @endif
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($item->ket == 1)
                        Acc
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td style="text-align: center;" colspan="4">Tidak ada data!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <table>
        <tr>
            <td width = "700px"></td>
            <td>Samata, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
            <td width = "700px"></td>
            <td>
                @isset($data[0])
                    <u>{{ $data[0]->dosen->name }}</u>
                @endisset
            </td>
        </tr>
        <tr>
            <td width = "700px"></td>
            <td>NIP. 
                @isset($data[0])
                {{ $data[0]->dosen->nip_nim }}
                @endisset
            </td>
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
