<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Ubah Password</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/" wire:navigate>Dashboards</a></li>
                                <li class="breadcrumb-item active">Ubah Password</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Password</h4>
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="password_lama">Password Lama</label>
                                            <div class="input-group">
                                                <input type="password" wire:model="password_lama" id="password-lama"
                                                    class="form-control @error('password_lama') is-invalid @enderror"
                                                    placeholder="Password Lama">
                                                <div class="input-group-append">
                                                    <span toggle="#password-lama" class="input-group-text"><i
                                                            class="fa fa-fw fa-eye toggle-password-lama"></i></span>
                                                </div>
                                            </div>
                                            <!-- error message -->
                                            @error('password_lama')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="password_baru">Password
                                                Baru</label>
                                            <div class="input-group">
                                                <input type="password" wire:model="password_baru" id="password-baru"
                                                    class="form-control @error('password_baru') is-invalid @enderror"
                                                    placeholder="Password Baru">
                                                <div class="input-group-append">
                                                    <span toggle="#password-baru" class="input-group-text"><i
                                                            class="fa fa-fw fa-eye toggle-password-baru"></i></span>
                                                </div>
                                            </div>
                                            <!-- error message -->
                                            @error('password_baru')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button wire:click.prevent="password()"
                                    class="btn btn-success waves-effect waves-light"><i class="bx bx-save"></i>
                                    Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @script
        <script>
            $(".toggle-password-lama").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#password-lama");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
            $(".toggle-password-baru").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#password-baru");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
    @endscript
