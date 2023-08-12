        @extends('layout')

        @section('title', 'Загрузить аватар')

        @section('content')
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>

        </div>
        <form action="{{ route('users.media.update', $userMedia->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    @if($userMedia->img)
                                    <img src="{{ $userMedia->img }}" alt="" class="img-responsive" width="200">
                                    @else
                                    <img src="img/demo/avatars/avatar-m.png" alt="" class="img-responsive" width="200">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" name="img" id="example-fileinput" class="form-control-file">
                                    @error('img')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endsection