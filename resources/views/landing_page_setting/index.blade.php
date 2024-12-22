@extends('layouts.app')

@section('page-title', __('Landing Page'))



@section('breadcrumb')
<li class="breadcrumb-item">{{ __('Label') }}</li>
@endsection

@section('content')
@php
    $slidersCount = (!empty($sliders)) ?  count($sliders) : 0;
    $servicessCount = (!empty($services)) ?  count($services) : 0;
    $teamCount = (!empty($teams)) ?  count($teams) : 0;
@endphp 

<div class="row p-0 g-0">
    <div class="col-sm-12">
        <div class="row g-0">
            <div class="col-xl-3 border-end border-bottom ">
                <div class="card shadow-none bg-transparent sticky-top" style="top:70px">
                    <div class="list-group list-group-flush rounded-0" id="useradd-sidenav">
                        <a href="#useradd-1"
                            class="list-group-item list-group-item-action ">{{ __('Slider') }}
                            <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#useradd-2"
                            class="list-group-item list-group-item-action ">{{ __('About us') }}
                            <div class="float-end "><i class="ti ti-chevron-right"></i></div>
                        </a>

                        <a href="#useradd-3" class="list-group-item list-group-item-action">{{ __('Services') }}
                            <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                        </a>

                        <a href="#useradd-4" class="list-group-item list-group-item-action">{{ __('Team') }}
                            <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                        </a>

                        <a href="#useradd-5" class="list-group-item list-group-item-action">{{ __('Case Study') }}
                            <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-9" data-bs-spy="scroll" data-bs-target="#useradd-sidenav" data-bs-offset="0" tabindex="0">
                <div class="card shadow-none rounded-0 border" id="useradd-1">
                    @include('landing_page_setting/slider')
                    
                </div>

                <div class="card shadow-none rounded-0 border" id="useradd-2">
                    @include('landing_page_setting/about')
                </div>

                <div class="card shadow-none rounded-0 border" id="useradd-3">
                    @include('landing_page_setting/services')
                </div>

                <div class="card shadow-none rounded-0 border" id="useradd-4">
                    @include('landing_page_setting/team')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-script')
@include('landing_page_setting/js')

@endpush