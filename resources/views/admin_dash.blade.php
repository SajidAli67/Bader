@extends('layouts.app')

@section('page-title', __('Dashboard'))

@section('action-button')

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

@endsection

@section('content')
<div class="row g-0">
    <div class="col-12">
        <div class="row overflow-hidden g-0 pt-0 g-0 pt-0 row-cols-1  row-cols-md-2 row-cols-xxl-5 row-cols-lg-4 row-cols-sm-2">
            <a href="{{ route('cases.index') }}">
                <div class="col border-end border-bottom">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-home"></i>
                            </div>
                            <div>
                                <p class="text-muted text-sm mb-0">{{ __('Total') }}</p>
                                <h6 class="mb-0">{{ __('Cases') }}</h6>
                            </div>
                        </div>
                        <h3 class="mb-0">{{ ($cases) }} </h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('advocate.index') }}">
                <div class="col border-end border-bottom">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-click"></i>
                            </div>
                            <div>
                                <p class="text-muted text-sm mb-0">
                                    {{ __('Total') }}
                                </p>
                                <h6 class="mb-0">{{ __('Advocates') }}</h6>
                            </div>
                        </div>
                        <h3 class="mb-0"> {{ count($advocate) }} </h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('documents.index') }}">
                <div class="col border-end border-bottom">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-report-money"></i>
                            </div>
                            <div>
                                <p class="text-muted text-sm mb-0">{{ __('Total') }}</p>
                                <h6 class="mb-0">{{ __('Documents') }}</h6>
                            </div>
                        </div>
                        <h3 class="mb-0"> {{ count($docs) }} </h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('users.index') }}">
                <div class="col border-end border-bottom">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="theme-avtar bg-secondary">
                                <i class="ti ti-users"></i>
                            </div>
                            <div>
                                <p class="text-muted text-sm mb-0">{{ __('Total') }}</p>
                                <h6 class="mb-0">{{ __('Team Members') }}</h6>
                            </div>
                        </div>
                        <h3 class="mb-0">{{ count($members) }}</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('to-do.index') }}">
                <div class="col border-end border-bottom">
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-thumb-up"></i>
                            </div>
                            <div>
                                <p class="text-muted text-sm mb-0">{{ __('Total') }}</p>
                                <h6 class="mb-0">{{ __('To-Dos') }}</h6>
                            </div>
                        </div>
                        <h3 class="mb-0">{{ count($todos) }} </h3>
                    </div>
                </div>
            </a>
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