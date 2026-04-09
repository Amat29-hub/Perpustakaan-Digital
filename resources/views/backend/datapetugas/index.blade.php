@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded h-100 p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">👥 Data Petugas</h5>

            <a href="{{ route('admin.datapetugas.create') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-dark table-bordered table-hover align-middle text-center">

                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Foto</th>
                        <th>Kode Petugas</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($petugas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Foto --}}
                            <td>
                                @if($item->foto)
                                    <img 
                                        src="{{ asset('storage/'.$item->foto) }}" 
                                        width="45"
                                        height="45"
                                        class="rounded-circle"
                                        style="object-fit: cover;"
                                    >
                                @else
                                    <img 
                                        src="https://via.placeholder.com/45?text=User"
                                        class="rounded-circle"
                                    >
                                @endif
                            </td>

                            {{-- Data --}}
                            <td>{{ $item->kode_petugas }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->email }}</td>

                            {{-- Status Toggle --}}
                            <td>
                                <form action="{{ route('admin.datapetugas.toggle', $item->id_petugas) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                
                                    <button style="border:none; background:none;">
                                        <div style="
                                            width:45px;
                                            height:22px;
                                            background-color: {{ $item->status == 'aktif' ? '#dc3545' : '#6c757d' }};
                                            border-radius:20px;
                                            position:relative;
                                            transition:0.3s;
                                        ">
                                            <div style="
                                                width:18px;
                                                height:18px;
                                                background:white;
                                                border-radius:50%;
                                                position:absolute;
                                                top:2px;
                                                left: {{ $item->status == 'aktif' ? '24px' : '2px' }};
                                                transition:0.3s;
                                            "></div>
                                        </div>
                                    </button>
                                </form>
                            </td>

                            {{-- Action --}}
                            <td>
                                <a 
                                    href="{{ route('admin.datapetugas.show', $item->id_petugas) }}" 
                                    class="btn btn-info btn-sm"
                                >
                                    Detail
                                </a>

                                <a 
                                    href="{{ route('admin.datapetugas.edit', $item->id_petugas) }}" 
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form 
                                    action="{{ route('admin.datapetugas.destroy', $item->id_petugas) }}" 
                                    method="POST" 
                                    class="d-inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus petugas ini?')"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Data petugas belum ada
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection