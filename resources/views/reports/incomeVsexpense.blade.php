@extends('layouts.app')
@php
    $settings = App\Models\Utility::settings();
   
@endphp

@section('page-title', __('Income Vs Expense'))

@section('breadcrumb')
<li class="breadcrumb-item">{{ __('Income Vs Expense') }}</li>
@endsection

@section('content')

<div class="row p-4">
    <div class="col-xxl-12">
        <div class="card card-body">
            <div class="text-sm-end d-flex all-button-box justify-content-sm-end">

                <select class="form-control" style="margin-right: 10px;" id="branch_id" name="branch_id">
                    <option value="">Select Branch </option>
                    @foreach($branchs as $branch)

                    <option value="{{ $branch->id }}" {{ request('branch_id')==$branch->id ? 'selected' : '' }}>{{ $branch->name }} </option>

                    @endforeach
                </select>

                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 5px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>


            </div>
        </div>
    </div>

    <div class="col-xxl-12 mt-3">
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-6">
                                <h5>{{ __('Total Income') }} </h5>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <h5 class="text-right">{{  $totalIncome->total  .'(' .$settings['site_currency'].')' }}</h5>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dataTable data-table user-datatable ">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>

                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    

                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-6">
                                <h5>{{ __('Total Expense') }} </h5>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <h5 class="text-right"> {{  $totalExpense->total  .'(' .$settings['site_currency'].')' }} </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


@endsection


@push('custom-script')
<script>
    $(document).on('change', '#branch_id', function() {
        changeUrl()
    })

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        changeUrl()
    });

    function changeUrl() {
        const branch_id = $('#branch_id').val();
        const start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD')
        const end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD')

        const newURL = `${window.location.origin}${window.location.pathname}?branch_id=${branch_id}&start=${start}&end=${end}`;
        window.location.href = newURL;
    }
</script>

@endpush