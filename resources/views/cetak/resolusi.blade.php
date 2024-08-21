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
        .table-borderless td,
        .table-borderless th {
            border: 0;
        }
    </style>
</head>

<body>
    <br><br><br>
    <div class="text-center">
        <h2><b>LEMBAR RESOLUSI</b></h2>
        <h4><b>Character Building Training (CBT)</b></h4>
        <h5>Universitas Islam Negeri Alauddin Makassar 2022/2023</h5>
    </div>
    <p style="margin: 20px auto; width: 80%;">
        Nama : {{ auth()->user()->role == 'Admin' ? $mahasiswa->name : auth()->user()->name }}<br>
        NIM : {{ auth()->user()->role == 'Admin' ? $mahasiswa->nip_nim : auth()->user()->nip_nim }}<br>
        Jurusan : {{ auth()->user()->role == 'Admin' ? $mahasiswa->jurusan : auth()->user()->jurusan }}<br>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered" style="margin: 20px auto; width: 80%;">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th width="150px">Tanggal</th>
                    <th width="400px">Kegiatan</th>
                    <th width="100px">Ket</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>Disetujui</td>
                </tr>
                @empty
                <tr>
                    <td style="text-align: center;" colspan="4">Tidak ada data!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <table class="table-borderless" style="width: 80%; margin: 20px auto;">
        <tr>
            <td width="70%">&nbsp;</td>
            <td>Samata, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td width="70%">&nbsp;</td>
            <td>Ketua Ma'had Al Jamiah</td>
        </tr>
        <tr>
            <td colspan="2" style="height: 60px;">&nbsp;</td>
        </tr>
        <tr>
            <td width="70%"></td>
            <td>
                @isset($data[0])
                <u>{{ $data[0]->dosen->name }}</u>
                @endisset
            </td>
        </tr>
        <tr>
            <td width="70%"></td>
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
