@extends('layouts.app')

@section('page-title', __('Invoce Template'))
<style>

.badge-light {
    color: #212529 !important;
    background-color: #979da3;
}
</style>

@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Invoice') }}</li>

@endsection

@section('content')
<div class="row p-0">
    <div class="col-xl-12">
        <div class="card shadow-none rounded-0 border">
            {{ Form::open(['url' => route('invoice.store'), 'enctype' => 'multipart/form-data']) }}
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group offset-3">
                        {{ Form::label('name', __('Template Name'), ['class' => 'col-form-label']) }}
                        {{ Form::text('name', '', ['class' => 'form-control ', 'placeholder' => 'Template Name']) }}
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 form-group offset-3">
                        {!! Form::label('branch', __('Branch'), ['class' => 'form-label']) !!}
                        <select class="form-control" id="branch" name="branch">
                            <option value="">{{ __('Select Branch') }}</option>
                            @foreach($branches as $branch)
                            @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 form-group offset-2">
                        <div class="form-group">
                            {{ Form::label('content', __('Invoice Layout'), ['class' => 'col-form-label']) }}
                            {{ Form::textarea('content', null, ['class' => 'form-control summernote',]) }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn-submit btn btn-primary" type="submit">
                    {{ __('Save Changes') }}
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>

    
</div>


<div class="row p-0">
    <div class="col-xl-12">
        <div class="card shadow-none rounded-0 border">
            <div class="card-body">
                <div class="row">
                    <h1> Company Detail </h1>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <span class="badge badge-light">{%logo%}</span>
                        <span class="badge badge-light">{%Company_name%}</span>
                        <span class="badge badge-light">{%Company_mobile%}</span>
                        <span class="badge badge-light">{%Company_email%}</span>
                        <span class="badge badge-light">{%Company_vat%}</span>
                        <span class="badge badge-light">{%Company_cr%}</span>
                        <span class="badge badge-light">{%Company_country%}</span>
                        <span class="badge badge-light">{%Company_distric%}</span>
                        <span class="badge badge-light">{%Company_secondary_code%}</span>
                        <span class="badge badge-light">{%Company_building_number%}</span>
                        <span class="badge badge-light">{%Company_postcode%}</span>
                        <span class="badge badge-light">{%Company_street%}</span>
                        <span class="badge badge-light">{%Branch_name%}</span>
                    </div>
                </div>    
                <div class="row">
                    <h1> Branch Detail </h1>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <span class="badge badge-light">{%Branch_name%}</span>
                        <span class="badge badge-light">{%branch_mobile%}</span>
                        <span class="badge badge-light">{%branch_email%}</span>
                        <span class="badge badge-light">{%branch_vat%}</span>
                        <span class="badge badge-light">{%branch_cr%}</span>
                        <span class="badge badge-light">{%branch_country%}</span>
                        <span class="badge badge-light">{%branch_distric%}</span>
                        <span class="badge badge-light">{%branch_secondary_code%}</span>
                        <span class="badge badge-light">{%branch_building_number%}</span>
                        <span class="badge badge-light">{%branch_postcode%}</span>
                        <span class="badge badge-light">{%branch_street%}</span>
                        
                    </div>
                </div>    

                <div class="row">
                    <h1> Client Detail </h1>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <span class="badge badge-light">{%Client_name%}</span>
                        <span class="badge badge-light">{%Client_mobile%}</span>
                        <span class="badge badge-light">{%Client_email%}</span>
                        <span class="badge badge-light">{%Client_country%}</span>
                        <span class="badge badge-light">{%Client_distric%}</span>
                        <span class="badge badge-light">{%Client_secondary_code%}</span>
                        <span class="badge badge-light">{%Client_building_number%}</span>
                        <span class="badge badge-light">{%Client_postcode%}</span>
                        <span class="badge badge-light">{%Client_street%}</span>
                </div>
            </div>
           
        </div>
    </div>

    
</div>

@endsection


@push('custom-script')
<script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>

<script>
    // $('.summernote').summernote({
    //     dialogsInBody: !0,
    //     minHeight: 250,
    //     toolbar: [
    //         ['style', ['style']],
    //         ['font', ['bold', 'italic', 'underline', 'strikethrough']],
    //         ['list', ['ul', 'ol', 'paragraph']],
    //         ['insert', ['link', 'unlink']],
    //     ]
    // });
    $('.summernote').summernote({
        minHeight: 500, 
    });
</script>
@endpush