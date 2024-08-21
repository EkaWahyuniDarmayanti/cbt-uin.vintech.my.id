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
    <br><br><br>
    <div class="text-center">
        <h2><b>LAPORAN</b></h2>
        <h5>Character Building Training (CBT)</h5>
        <h5>Universitas Islam Negeri Alauddin Makassar</h5>
        <br>
        <h5>Hasil Mentoring Mahasiswa</h5>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered" style="margin: 20px auto; width: 80%;">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th width="150px">NIM</th>
                    <th width="250px">Nama</th>
                    <th width="150px">Jurusan</th>
                    <th width="100px">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nip_nim }}</td>
                    <td>{{ $item->mahasiswa->name }}</td>
                    <td>{{ $item->mahasiswa->jurusan }}</td>
                    <td>
                        @if ($totalMentoring[$item->mahasiswa_id] >= 5)
                            Lulus
                        @endif
                            
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <table style="width: 80%; margin: 20px auto;">
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
            <td>Prof. Syahrudin Usman, M. Pd</td>
        </tr>
        <tr>
            <td width="70%"></td>
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
        // const link = document.createElement('a');
        //     link.href = 'path/to/your/file.pdf'; // Replace with the file path
        //     link.download = 'your-file.pdf'; // Name of the file to be downloaded
        //     document.body.appendChild(link);
        //     link.click();
        //     document.body.removeChild(link);
    });
</script>
</html>
