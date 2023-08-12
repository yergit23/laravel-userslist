            @extends('layout')

            @section('title', 'Профиль пользователя')

            @section('content')

            @if (session('flash.message'))
            <div class="alert alert-{{ session('flash.type') }}">
                {{ session('flash.message') }}
            </div>
            @endif
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-user'></i> {{ $userProfile->name }}
                </h1>
            </div>
            <div class="row">
              <div class="col-lg-6 col-xl-6 m-auto">
                    <!-- profile summary -->
                    <div class="card mb-g rounded-top">
                        <div class="row no-gutters row-grid">
                            <div class="col-12">
                                <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                    @if($userProfile->img)
                                    <img src="{{ $userProfile->img }}" class="rounded-circle shadow-2 img-thumbnail" width="300" alt="">
                                    @else
                                    <img src="img/demo/avatars/avatar-m.png" class="rounded-circle shadow-2 img-thumbnail" width="300" alt="">
                                    @endif
                                    <h5 class="mb-0 fw-700 text-center mt-3">
                                        {{ $userProfile->name }}
                                        <small class="text-muted mb-0">{{ $userProfile->job }}</small>
                                    </h5>
                                    <div class="mt-4 text-center demo">
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
                                            <i class="fab fa-instagram"> {{ $userProfile->inst }}</i>
                                        </a>
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                            <i class="fab fa-vk"> {{ $userProfile->vk }}</i>
                                        </a>
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                            <i class="fab fa-telegram"> {{ $userProfile->tgm }}</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 text-center">
                                    <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i> {{ $userProfile->phone }}</a>
                                    <a href="mailto:oliver.kopyov@marlin.ru" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mouse-pointer text-muted mr-2"></i> {{ $userProfile->email }}</a>
                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                        <i class="fas fa-map-pin mr-2"></i> {{ $userProfile->address }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
            @endsection