    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Bidang</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="/" wire:navigate>Dashboards</a></li>
                                    <li class="breadcrumb-item active">Bidang</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if ($Mode == 'index')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daftar Bidang</h4>
                                    <div class="pull-right">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <button wire:click="create()"
                                                    class="btn btn-primary waves-effect waves-light mb-2">
                                                    <i class="dripicons-plus"></i>
                                                    Tambah
                                                </button>
                                            </div>
                                            <div class="col-md-5">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group mr-sm-3">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="dripicons-search"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" wire:model.live="search"
                                                        placeholder="Cari Data...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th wire:click="setSortFunctionality('nama')">
                                                        <button class="btn">
                                                            Nama
                                                            @if ($sortByColumn != 'nama')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th wire:click="setSortFunctionality('singkatan')">
                                                        <button class="btn">
                                                            Singkatan
                                                            @if ($sortByColumn != 'singkatan')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th wire:click="setSortFunctionality('color')">
                                                        <button class="btn">
                                                            Warna
                                                            @if ($sortByColumn != 'color')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th wire:click="setSortFunctionality('ket')">
                                                        <button class="btn">
                                                            Keterangan
                                                            @if ($sortByColumn != 'ket')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $key => $row)
                                                    <div wire:key='{{ $row->id }}'>
                                                        <tr>
                                                            <td width='4%'>
                                                                {{ ($data->currentpage() - 1) * $data->perpage() + 1 + $key }}
                                                            </td>
                                                            <td>{{ $row->nama }}</td>
                                                            <td>{{ $row->singkatan }}</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-text rounded"
                                                                        style="background: {{ $row->color }};"><i></i></span>
                                                                </div>
                                                            </td>
                                                            <td>{{ $row->ket }}</td>
                                                            <td>
                                                                <button wire:click="edit('{{ encrypt($row->id) }}')"
                                                                    class="btn btn-primary btn-sm"><i
                                                                        class="dripicons-pencil"></i></button>
                                                                <button wire:click="delete('{{ encrypt($row->id) }}')"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="dripicons-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                @empty
                                                    <tr class="bg-white">
                                                        <td colspan="5"
                                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                            <center>Tidak ada data.</center>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $data->links() }}
                                    <div class="flex space-x-4 items-center mb-3">
                                        <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                        <select wire:model.live="entries"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="10">10</option>
                                            <option value="20">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="all">all</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                @elseif (($Mode == 'create') | ($Mode == 'edit'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @if ($Mode == 'create')
                                        <h4 class="card-title">Tambah Data</h4>
                                    @elseif($Mode == 'edit')
                                        <h4 class="card-title">Ubah Data</h4>
                                    @endif
                                    <form>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="nama">Nama Bidang</label>
                                                    <input type="text" wire:model="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        value="{{ old('nama') }}" placeholder="Nama Bidang">
                                                    <!-- error message -->
                                                    @error('nama')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="singkatan">Singkatan</label>
                                                    <input type="text" wire:model="singkatan"
                                                        class="form-control @error('singkatan') is-invalid @enderror"
                                                        value="{{ old('singkatan') }}" placeholder="Singkatan">
                                                    <!-- error message -->
                                                    @error('singkatan')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Warna Label</label>
                                                    <div class="input-group colorpicker-default"
                                                        title="Using format option">
                                                        <input type="hidden"
                                                            class="form-control input-lg @error('color') is-invalid @enderror"
                                                            wire:model="color" value="{{ old('color') }}"
                                                            placeholder="Warna Label Kalender"
                                                            onchange="this.dispatchEvent(new InputEvent('input'))">
                                                        <span>
                                                            <span
                                                                class="input-group-text colorpicker-input-addon"><i></i></span>
                                                        </span>
                                                    </div>
                                                    <!-- error message -->
                                                    @error('color')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="ket">Keterangan</label>
                                                    <input type="text" wire:model="ket"
                                                        class="form-control @error('ket') is-invalid @enderror"
                                                        value="{{ old('ket') }}" placeholder="Keterangan">
                                                    <!-- error message -->
                                                    @error('ket')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button wire:click.prevent="cancel()"
                                            class="btn btn-danger waves-effect waves-light"><i
                                                class="mdi mdi-keyboard-backspace"></i>
                                            Kembali</button>
                                        @if ($Mode == 'create')
                                            <button wire:click.prevent="store()" wire:loading.attr="disabled"
                                                class="btn btn-primary waves-effect waves-light"><i
                                                    class="bx bx-save"></i>
                                                Simpan</button>
                                        @elseif($Mode == 'edit')
                                            <button wire:click.prevent="update()" wire:loading.attr="disabled"
                                                class="btn btn-primary waves-effect waves-light"><i
                                                    class="bx bx-save"></i>
                                                Update</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @script
                        <script>
                            $(document).ready(function() {
                                $(".colorpicker-default").colorpicker({
                                    format: "hex"
                                });
                            });
                        </script>
                    @endscript
                @endif

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
