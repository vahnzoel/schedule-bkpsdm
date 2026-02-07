<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-soft-primary">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h4 class="text-primary">Selamat datang!</h4>
                            <p>Silahkan Login untuk melanjutkan.</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('assets/images/asn.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div>
                    <a href="{{ url('/') }}" wire:navigate>
                        <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{ URL::asset('assets/images/tangkab.png') }}" alt="" height="50">
                            </span>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <form class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                wire:model="username" placeholder="Masukan Username">
                            @error('username')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password-field"
                                    class="form-control @error('password') is-invalid @enderror" wire:model="password"
                                    placeholder="Masukan Password">
                                <div class="input-group-append">
                                    <span toggle="#password-field" class="input-group-text"><i
                                            class="fa fa-fw fa-eye toggle-password"></i></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button wire:click.prevent="auth()"
                                class="btn btn-primary btn-block waves-effect waves-light">
                                Log In</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="mt-5 text-center">

            <div>
                <p>© {{ date('Y') }} <b>BKPSDM Kab. Tangerang</b>.
                </p>
            </div>
        </div>

    </div>
</div>
@assets
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password-field");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endassets
