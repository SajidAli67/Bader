@extends('layouts.app')

@section('page-title', __('Invoce Template'))

@section('action-button')
<div class="row align-items-end mb-3">
    <div class="col-md-12 d-flex justify-content-sm-end">
      

        @canany(['create member','create user'])
        <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
            <a href="{{ route('invoice.create') }}" class="btn btn-sm btn-primary mx-1"  data-size="md"
                title="{{ __('Create Invoice Template') }}">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>
</div>
@endcan

@endsection

@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Invoice') }}</li>

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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Branch ') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

