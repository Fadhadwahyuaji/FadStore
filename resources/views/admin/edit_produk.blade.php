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
                            <h3 class="mb-0  text-white">EDIT DATA PRODUK</h3>
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
                        <h4 class="mb-0">EDIT PRODUK</h4>
                    </div>
                    <!-- table  -->
                    <form class="container-fluid" action="{{ route('update.produk', $produk->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Foto Produk</label>
                          <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="exampleFormControlInput1" value="{{ $produk->gambar }}" placeholder="Masukkan Nama Barang">
                      </div>
                  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                          <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="exampleFormControlInput1" value="{{ $produk->nama }}" placeholder="Masukkan Nama Barang">
                      </div>
                  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                          <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="exampleFormControlInput1" placeholder="Masukkan Deskripsi Produk">{{ $produk->deskripsi }}</textarea>
                      </div>
                  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                          <input class="form-control @error('jumlah') is-invalid @enderror" type="text" name="jumlah" id="exampleFormControlInput1" value="{{ $produk->jumlah }}" placeholder="Masukkan Barang Tersedia">
                      </div>
                  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Harga</label>
                          <input class="form-control @error('harga') is-invalid @enderror" type="text" name="harga" id="exampleFormControlInput1" value="{{ $produk->harga }}" placeholder="Masukkan Jumlah Barang Dipinjam">
                      </div>
                  
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary">Batal</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                  </form>
                  
                </div>

            </div>
        </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection