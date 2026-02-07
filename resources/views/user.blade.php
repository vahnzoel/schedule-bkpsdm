    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Users</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="/" wire:navigate>Dashboards</a></li>
                                    <li class="breadcrumb-item active">Users</li>
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
                                    <h4 class="card-title">Daftar Users</h4>
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
                                                    <th wire:click="setSortFunctionality('username')">
                                                        <button class="btn">
                                                            Username
                                                            @if ($sortByColumn != 'username')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th wire:click="setSortFunctionality('name')">
                                                        <button class="btn">
                                                            Name
                                                            @if ($sortByColumn != 'name')
                                                                <i class="mdi mdi-arrow-up-down-bold"></i>
                                                            @elseif($sortDirection == 'ASC')
                                                                <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                            @else
                                                                <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                            @endif
                                                        </button>
                                                    </th>
                                                    <th>Reset Password</th>
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
                                                            <td>{{ $row->username }}</td>
                                                            <td>{{ $row->name }}</td>
                                                            <td>
                                                                @if ($row->username != 'admin')
                                                                    <button
                                                                        wire:click="passconfirm('{{ encrypt($row->id) }}')"
                                                                        class="btn btn-warning btn-sm"><i
                                                                            class="bx bx-reset"></i>
                                                                        Reset</button>
                                                                @else
                                                                    <span class="badge badge-dark">No Action</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($row->username != 'admin')
                                                                    <button wire:click="edit('{{ encrypt($row->id) }}')"
                                                                        class="btn btn-primary btn-sm"><i
                                                                            class="dripicons-pencil"></i></button>
                                                                    <button
                                                                        wire:click="delete('{{ encrypt($row->id) }}')"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="dripicons-trash"></i></button>
                                                                @else
                                                                    <span class="badge badge-dark">No Action</span>
                                                                @endif
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
                                                    <label class="col-form-label" for="name">Nama</label>
                                                    <input type="text" wire:model="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name') }}" placeholder="Nama">
                                                    <!-- error message -->
                                                    @error('name')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="username">Username</label>
                                                    <input type="text" wire:model="username"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        value="{{ old('username') }}" placeholder="Username">
                                                    <!-- error message -->
                                                    @error('username')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Bidang</label>
                                                    <select class="form-control @error('bidang') is-invalid @enderror"
                                                        wire:model="bidang">
                                                        <option>Pilih Bidang</option>
                                                        @foreach ($bid as $key => $row)
                                                            <option {{ $row->id == $bidang ? 'selected' : '' }}
                                                                value="{{ $row->id }}"
                                                                {{ $row->singkatan == old('bidang') ? 'selected' : '' }}>
                                                                {{ $row->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('bidang')
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
                @endif

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
