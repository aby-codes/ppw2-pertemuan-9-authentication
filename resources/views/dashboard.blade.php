<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        @if(Session::has('pesan'))
            <div class="alert alert-success fade show" id="success-alert" role="alert">{{ Session::get('pesan') }}</div>
        @endif

        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a style="left: right; margin-bottom: 16px" href="{{ route('buku.create') }}">
                        <button class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;Tambah Buku</button>
                    </a>
                    <form action="{{ route('buku.search') }}" method="get">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="kata" class="form-control" placeholder="Cari..." aria-label="Cari" style="border-radius: 8px 0 0 8px">
                            <button type="submit" class="btn btn-primary" style="border-radius: 0 8px 8px 0; background-color: #0D6FFB">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <table class="table table-striped table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;"id</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tgl. Terbit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_buku as $buku)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ ($buku->tgl_terbit)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group" style="overflow-x: auto;">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                                    &nbsp;
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" onClick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>&nbsp;Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>                
                
                <div>{{ $data_buku->links('vendor.pagination.bootstrap-5') }}</div>
                <div><strong>Jumlah Buku : {{ $jumlah_buku }}</strong></div>
                <div><strong>Jumlah Harga Buku : {{ "Rp ".number_format($jumlah_harga, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>
</x-app-layout>
