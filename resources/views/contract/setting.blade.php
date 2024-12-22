@extends('layouts.app')


@section('page-title', __('Contract Setting'))


@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Contract Setting') }}</li>

@endsection

@section('content')


<form action="{{ route('contract.setting.save') }} " method="post">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-lg-10">
            <div class="card shadow-none rounded-0 border">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-offset-3 ">
                            <button class="btn btn-sm btn-primary mx-1 pull-right" data-count = "{{ $count }}" type="button" id="addAgrement"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                        </div>
                        @if(!empty($points))
                            @foreach($points as $key => $point)
                                <div class="agrement_row">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-1 col-md-offset-2">
                                                <input type="text" class="form-control"  value="<?= $key + 1 ?>" readonly>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control " id="file" name="points[]" placeholder="" value="{{ $point }}"  dir="rtl">
                                                <span id="file_msg" style="display:none" class="text-danger"></span>
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-md btn-danger pull-right removeRow" type='button'><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div id="AgrementArea">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-1"></div>
        <div class="col-lg-10">
            <div class="card shadow-none rounded-0 border ">
                <div class="card-body p-2">
                    <div class="form-group col-12 d-flex justify-content-end col-form-label mb-0">

                        <a href="{{ route('contract.setting') }}" class="btn btn-secondary btn-light ms-3">{{ __('Cancel') }}</a>
                        <input type="submit" value="{{ __('Update') }}" class="btn btn-primary ms-2" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="card shadow-none rounded-0 border">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="box-title text-uppercase text-success " id="">
                {{ __('Short Code') }}
                    
                </h3>
                <table class="table table-border">
                    <tbody>
                        <tr>
                            <th>{{ __('Short Code') }}</th>
                            <th> {{ __('Description') }}</th>
                        </tr>
                        <tr>
                            <td> <?= "{{input}}" ?> </td>
                            <td> Input text </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection