@extends('backend.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded h-100 p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between mb-3">
            <h5>📚 Data Buku</h5>

            <a href="{{ route('admin.databuku.create') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-dark table-bordered table-hover text-center align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($buku as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Cover --}}
                            <td>
                                @if($item->cover)
                                    <img 
                                        src="{{ asset('storage/'.$item->cover) }}" 
                                        width="45"
                                    >
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            {{-- Data --}}
                            <td>{{ $item->kode_buku }}</td>
                            <td class="text-center">{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>

                            {{-- Status --}}
                            <td>
                                @if($item->status == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>

                                @elseif($item->status == 'habis')
                                    <span class="badge bg-danger">Habis</span>

                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td>
                                <a 
                                    href="{{ route('admin.databuku.show', $item->id_buku) }}" 
                                    class="btn btn-info btn-sm"
                                >
                                    Detail
                                </a>

                                <a 
                                    href="{{ route('admin.databuku.edit', $item->id_buku) }}" 
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form 
                                    action="{{ route('admin.databuku.destroy', $item->id_buku) }}" 
                                    method="POST" 
                                    class="d-inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">Data buku belum ada</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection