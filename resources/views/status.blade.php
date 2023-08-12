        @extends('layout')

        @section('title', 'Установить статус')

        @section('content')
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус
            </h1>

        </div>
        <form action="{{ route('users.status.update', $userStatus->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            <select name="status" class="form-control" id="example-select">
                                                @foreach($statuses as $status)
                                                    @if($userStatus->status == $status->name_eng)
                                                        <option value="{{ $status->name_eng }}" selected>{{ $status->name_ru}}</option>
                                                    @else
                                                        <option value="{{ $status->name_eng }}">{{ $status->name_ru}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button type="submit" class="btn btn-warning">Set Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
        @endsection
