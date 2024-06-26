<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            {{-- erros --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- sukses --}}
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action='' method='post'>
                @csrf

                @if (Route::current()->uri == 'buku/{id}')
                    @method('put')
                @endif

                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='judul' id="judul"
                            value="{{ isset($data['judul']) ? $data['judul'] : old('judul') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='pengarang' id="pengarang"
                            value="{{ isset($data['pengarang']) ? $data['pengarang'] : old('pengarang') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control w-50" name='publikasi' id="publikasi"
                            value="{{ isset($data['publikasi']) ? $data['publikasi'] : old('publikasi') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        @if (Route::current()->uri == 'buku')


            <!-- START DATA -->
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-4">Judul</th>
                            <th class="col-md-3">Pengarang</th>
                            <th class="col-md-2">Tanggal Publikasi</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['data'] as $item)
                            <tr>
                                <td>{{ $loop->iteration + $data['from'] - 1}}</td>
                                <td>{{ $item['judul'] }}</td>
                                <td>{{ $item['pengarang'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($item['publikasi'])) }}</td>
                                <td>
                                    <a href="{{ url('buku/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- <a href="" class="btn btn-danger btn-sm">Delete</a> --}}
                                    <form action="{{ url('buku/' . $item['id']) }}" method="post"
                                        onsubmit="return confirm('apakah yakin ingin melakukan penghapusan data')"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="submit"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($data['links'])
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @foreach ($data['links'] as $item)
                                <li class="page-item {{ $item['active'] ? 'active' : '' }}"><a class="page-link"
                                        href="{{ $item['url2'] }}">{!! $item['label'] !!}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                @endif
            </div>
            <!-- AKHIR DATA -->
        @endif
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>
