@extends('layouts.app')

@section('page-title', __('Contract'))

@section('action-button')
<div class="row align-items-end mb-3">
    <div class="col-md-12 d-flex justify-content-sm-end">

        @canany(['create member','create user'])
        <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
            <a href="{{ route('contract.add') }}" class="btn btn-sm btn-primary mx-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>
</div>
@endcan

@endsection

@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Contract') }}</li>

@endsection

@section('content')
<div class="row p-0">
    <div class="col-xl-12">
        <div class="">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table dataTable data-table ">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Contract No') }}</th>
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Mobile Number') }}</th>
                                <th>{{ __('Branch') }}</th>
                                <th width="100px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contracts as $key=> $contract)

                            <tr>
                                <td>{{ ++$key  }}</td>
                                <td>{{ $contract->contract_no }}</td>
                                <td>{{ $contract->client->name }}</td>
                                <td>{{ App\Models\UserDetail::getUserDetail(App\Models\User::getUser($contract->client->id)->mobile_number) }} </td>
                                <td>{{ $contract->branch->name }}</td>
                                <td>
                                    <div class="action-btn bg-light-secondary ms-2">
                                            <a href="{{route('cases.create',['id' => $contract->id])}}"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center "
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Add Case') }}">

                                                <i class="ti ti-plus"></i>

                                            </a>
                                        </div>
                                    <div class="action-btn bg-light-secondary ms-2">
                                        <a href="{{route('contract.edit', $contract->id)}}"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center "
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Edit') }}">

                                            <i class="ti ti-edit "></i>

                                        </a>
                                    </div>
                                    <div class="action-btn bg-light-secondary ms-2">
                                        <a href="{{route('contract.print',$contract->id)}}" target="_blank"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center "
                                            data-tooltip="Print" data-title="{{__('Print')}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{__('Print')}}">

                                            <i class="fa fa-print"></i>

                                        </a>
                                    </div>
                                </td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection