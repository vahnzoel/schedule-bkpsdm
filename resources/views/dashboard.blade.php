<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    @role('admin')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Jumlah Agenda</p>
                                                <h4 class="mb-0">{{ $agenda }}</h4>
                                            </div>

                                            <div
                                                class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="bx bx-calendar font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Jumlah Bidang</p>
                                                <h4 class="mb-0">{{ $bidang }}</h4>
                                            </div>

                                            <div
                                                class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-grid-large font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">Jumlah User</p>
                                                <h4 class="mb-0">{{ $user }}</h4>
                                            </div>

                                            <div
                                                class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="bx bx-user font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    @endrole
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div
                                                class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="mdi mdi-bullhorn-outline font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <h4 class="mb-0">
                                                <marquee class="py-1" direction="left" onmouseover="this.stop()"
                                                    onmouseout="this.start()">Hai <b>{{ Auth::user()->name }}</b>,
                                                    Selamat
                                                    datang di
                                                    <b>Badan Kepegawaian dan Pengembangan Sumber Daya Manusia</b>
                                                    Kabupaten
                                                    Tangerang.
                                                </marquee>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Agenda Hari ini - {{ $tanggal }}</h4>
                            <div class="table-responsive" wire:poll>
                                <table class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Agenda</th>
                                            <th>Jam</th>
                                            <th>Bidang</th>
                                            <th>Peserta</th>
                                            <th>Tempat</th>
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
                                                    </td>
                                                    <td>{{ date('H:i', strtotime($row->jam_mulai)) . ' - ' . date('H:i', strtotime($row->jam_selesai)) . ' WIB' }}
                                                    </td>
                                                    <td>{{ $row->bidang }}</td>
                                                    <td>{{ $row->peserta }}</td>
                                                    <td>{{ $row->lokasi }}</td>
                                                </tr>
                                            </div>
                                        @empty
                                            <tr class="bg-white">
                                                <td colspan="6"
                                                    class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                    <center>Tidak ada agenda.</center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
