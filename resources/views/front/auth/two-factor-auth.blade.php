@php use Illuminate\Support\Facades\Auth; @endphp
<x-front-layout>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                         class="img-fluid"
                         alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{route('two-factor.enable')}}" method="post">
                        @csrf
                        <div class="title">
                            <h3>Two Factor Authentication</h3>
                            <p>You Can Enable Or Disable Two Factor Auth </p>
                        </div>
                        @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="mb-4 font-medium text-sm">
                                Please finish configuring two factor authentication below.
                            </div>
                        @endif
                        <div class="text-center text-lg-start mt-4 pt-2">
                            @if(!$user->two_factor_secret)
                                <button type="submit" class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Enable
                                </button>
                            @else
                                <div class="p-4">
                                    {!! $user->twoFactorQrCodeSvg()!!}
                                </div>
                            <h3>Recovery Code</h3>
                            <ul class="mb-3">
                                @foreach($user->recoveryCodes() as $code)
                                    <li>{{$code}}</li>

                                @endforeach
                            </ul>

                                @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Disable
                                </button>

                            @endif

                        </div>

                    </form>
                </div>
            </div>
        </div>
        {{--        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">--}}
        <!-- Copyright -->
        {{--            <div class="text-white mb-3 mb-md-0">--}}
        {{--                Copyright © 2020. All rights reserved.--}}
        {{--            </div>--}}
        <!-- Copyright -->

        <!-- Right -->
        <div>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <!-- Right -->
        </div>
    </section>
</x-front-layout>

