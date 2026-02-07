<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Agenda</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/" wire:navigate>Dashboards</a></li>
                                <li class="breadcrumb-item active">Agenda</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if ($Mode == 'index')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar" style="height: 800px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            @elseif ($Mode == 'table')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Agenda - {{ $helper->tanggal($tgl) }}</h4>
                                <div class="pull-right">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            @if ($helper->past(date('Y-m-d'), $tgl) == 'future')
                                                <button wire:click="create()"
                                                    class="btn btn-primary waves-effect waves-light mb-2">
                                                    <i class="dripicons-plus"></i>
                                                    Tambah
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group mr-sm-3 mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="dripicons-search"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control"
                                                    wire:model.live.debounce.300ms="search" placeholder="Cari Data...">
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
                                                <th wire:click="setSortFunctionality('judul')">
                                                    <button class="btn">
                                                        Agenda
                                                        @if ($sortByColumn != 'judul')
                                                            <i class="mdi mdi-arrow-up-down-bold"></i>
                                                        @elseif($sortDirection == 'ASC')
                                                            <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                        @else
                                                            <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                        @endif
                                                    </button>
                                                </th>
                                                <th wire:click="setSortFunctionality('tgl')">
                                                    <button class="btn">
                                                        Tanggal
                                                        @if ($sortByColumn != 'tgl')
                                                            <i class="mdi mdi-arrow-up-down-bold"></i>
                                                        @elseif($sortDirection == 'ASC')
                                                            <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                        @else
                                                            <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                        @endif
                                                    </button>
                                                </th>
                                                <th wire:click="setSortFunctionality('jam_mulai')">
                                                    <button class="btn">
                                                        Jam
                                                        @if ($sortByColumn != 'jam_mulai')
                                                            <i class="mdi mdi-arrow-up-down-bold"></i>
                                                        @elseif($sortDirection == 'ASC')
                                                            <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                        @else
                                                            <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                        @endif
                                                    </button>
                                                </th>
                                                <th wire:click="setSortFunctionality('bidang')">
                                                    <button class="btn">
                                                        Bidang
                                                        @if ($sortByColumn != 'bidang')
                                                            <i class="mdi mdi-arrow-up-down-bold"></i>
                                                        @elseif($sortDirection == 'ASC')
                                                            <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                        @else
                                                            <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                        @endif
                                                    </button>
                                                </th>
                                                <th wire:click="setSortFunctionality('peserta')">
                                                    <button class="btn">
                                                        Peserta
                                                        @if ($sortByColumn != 'peserta')
                                                            <i class="mdi mdi-arrow-up-down-bold"></i>
                                                        @elseif($sortDirection == 'ASC')
                                                            <i class="mdi mdi-arrow-up-drop-circle"></i>
                                                        @else
                                                            <i class="mdi mdi-arrow-down-drop-circle"></i>
                                                        @endif
                                                    </button>
                                                </th>
                                                <th wire:click="setSortFunctionality('lokasi')">
                                                    <button class="btn">
                                                        Tempat
                                                        @if ($sortByColumn != 'lokasi')
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
                                                        <td>{{ $row->judul }}</td>
                                                        <td>{{ $helper->tanggal($row->tgl) }}
                                                        </td>
                                                        <td>{{ date('H:i', strtotime($row->jam_mulai)) . ' - ' . date('H:i', strtotime($row->jam_selesai)) . ' WIB' }}
                                                        </td>
                                                        <td>{{ $row->bidang }}</td>
                                                        <td>{{ $row->peserta }}</td>
                                                        <td>{{ $row->lokasi }}</td>
                                                        <td>
                                                            @role('admin')
                                                                <button wire:click="edit('{{ encrypt($row->id) }}')"
                                                                    class="btn btn-primary btn-sm"><i
                                                                        class="dripicons-pencil"></i></button>
                                                                <button wire:click="delete('{{ encrypt($row->id) }}')"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="dripicons-trash"></i></button>
                                                            @endrole
                                                            @role('user')
                                                                @if ($row->user_id == Auth::user()->id)
                                                                    <button wire:click="delete('{{ encrypt($row->id) }}')"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="dripicons-trash"></i></button>
                                                                @else
                                                                    <span class="badge badge-dark">No Action</span>
                                                                @endif
                                                            @endrole
                                                        </td>
                                                    </tr>
                                                </div>
                                            @empty
                                                <tr class="bg-white">
                                                    <td colspan="8"
                                                        class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                        <center>Tidak ada agenda.</center>
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
                                                <label class="col-form-label" for="judul">Agenda</label>
                                                <input type="text" wire:model="judul"
                                                    class="form-control @error('judul') is-invalid @enderror"
                                                    value="{{ old('judul') }}" placeholder="Agenda">
                                                <!-- error message -->
                                                @error('judul')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Jam Mulai</label>

                                                <div class="input-group">
                                                    <input id="time" type="text" wire:model.live="jam_mulai"
                                                        class="form-control @error('jam_mulai') is-invalid @enderror"
                                                        data-provide="timepicker"
                                                        onchange="this.dispatchEvent(new InputEvent('input'))">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-clock-outline"></i></span>
                                                    </div>
                                                </div>
                                                @error('jam_mulai')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label>Jam Selesai</label>

                                                <div class="input-group">
                                                    <input id="time1" type="text"
                                                        wire:model.live="jam_selesai"
                                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                                        data-provide="timepicker"
                                                        onchange="this.dispatchEvent(new InputEvent('input'))">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-clock-outline"></i></span>
                                                    </div>
                                                </div>
                                                @error('jam_selesai')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="lokasi">Tempat</label>
                                                <input type="text" wire:model="lokasi"
                                                    class="form-control @error('lokasi') is-invalid @enderror"
                                                    value="{{ old('lokasi') }}" placeholder="Tempat">
                                                <!-- error message -->
                                                @error('lokasi')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="peserta">Peserta</label>
                                                <input type="text" wire:model="peserta"
                                                    class="form-control @error('peserta') is-invalid @enderror"
                                                    value="{{ old('peserta') }}" placeholder="Peserta">
                                                <!-- error message -->
                                                @error('peserta')
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
                                        <div class="col-lg-6">

                                        </div>
                                    </div>
                                    <a href="{{ route('agenda') }}" wire:navigate
                                        class="btn btn-danger waves-effect waves-light">
                                        <i class="mdi mdi-keyboard-backspace"></i>
                                        Kembali
                                    </a>
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
                            $(".select2").select2();
                            $("#time").timepicker({
                                showMeridian: !1,
                                icons: {
                                    up: "mdi mdi-chevron-up",
                                    down: "mdi mdi-chevron-down"
                                },
                            });
                            $("#time1").timepicker({
                                showMeridian: !1,
                                icons: {
                                    up: "mdi mdi-chevron-up",
                                    down: "mdi mdi-chevron-down"
                                },
                            });
                        });
                    </script>
                @endscript
            @endif
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @assets
        <style>
            @media screen and (max-width:767px) {
                .fc-toolbar.fc-header-toolbar {
                    font-size: 60%
                }
            }
        </style>
    @endassets
    @script
        <script>
            $(document).ready(function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {

                    headerToolbar: {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    buttonText: {
                        prev: '<<',
                        next: '>>',
                        today: 'Hari ini',
                        year: 'Tahun',
                        month: 'Bulan',
                        week: 'Minggu',
                        day: 'Hari',
                        list: 'Agenda',
                    },
                    weekText: 'Mg',
                    allDayText: 'Sehari penuh',
                    moreLinkText: 'lebih',
                    noEventsText: 'Tidak ada acara untuk ditampilkan',
                    initialView: 'dayGridMonth',
                    initialDate: `{{ date('Y-m-d') }}`,
                    locale: 'id',
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    selectable: true,
                    dayMaxEvents: true, // allow "more" link when too many events
                    dateClick: function(info) {
                        $wire.$set('tgl', info.dateStr);
                        $wire.$set('Mode', 'table');
                    },
                    eventClick: function(info) {
                        alert('Agenda: ' + info.event.title);
                    },
                    events: @json($events),
                });

                calendar.render();
            });
        </script>
    @endscript
