@extends('layouts.admin')

@section('content')
    <!-- Container fluid -->
    <div class="bg-primary pt-10 pb-21"></div>
    <div class="container-fluid mt-n22 px-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0  text-white">PRODUK</h3>
                        </div>
                        <div>
                            <a href="{{ route('tambah.produk') }}" class="btn btn-white">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row  -->
        <div class="row mt-6">
            <div class="col-md-12 col-12">
                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header bg-white  py-4">
                        <h4 class="mb-0">Data Barang</h4>
                    </div>
                    <!-- table  -->
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Produk</th>
                                    <th>Foto Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Edit/Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td class="align-middle">{{ $produk->id }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="icon-shape icon-md border p-4 rounded-1">
                                                        <img src="{{ asset('/' . basename($produk->gambar)) }}"
                                                            alt="" style="width: 30px; height: 30px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <h5 class=" mb-1">{{ $produk->nama }}</h5>
                                        </td>
                                        <td class="align-middle">
                                            <h5 class=" mb-1">
                                                {{ \Illuminate\Support\Str::limit($produk->deskripsi, $limit = 20, $end = '...') }}
                                            </h5>
                                        </td>
                                        <td class="align-middle">
                                            <h5 class=" mb-1">{{ $produk->jumlah }}</h5>
                                        </td>
                                        <td class="align-middle">
                                            <h5 class=" mb-1">{{ $produk->harga }}</h5>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ route('edit.produk', $produk->id) }}"><button type="button"
                                                        class="btn btn-primary">Edit</button></a>
                                                <form action="{{ route('destroy.produk', $produk->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                {{-- @component('components.mahasiswa.tambah_mahasiswa')
                                <!-- Anda dapat menambahkan konten khusus untuk modal di sini -->
                                        @endcomponent</td> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- card footer  -->
                    <div class="card-footer bg-white text-center">
                        <a href="#" class="link-primary">Lihat Semua</a>

                    </div>
                </div>

            </div>
        </div>
        <!-- End Card -->
    </div>
    </div>
    </div>

    </div>
    </div>
@endsection
