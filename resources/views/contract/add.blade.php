@extends('layouts.app')


@section('page-title', __('Contract Setting'))


@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Contract Setting') }}</li>

@endsection

@section('content')


<form action="{{ route('contract.store') }} " method="post">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-lg-10">
            <div class="card shadow-none rounded-0 border">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-sm-6 ">
                            <div class="form-group">
                                {!! Form::label('client', __('client'), ['class' => 'col-form-label required-sym']) !!}
                                <select class="form-control choices-js" id="choices-js" name="client" required="required">
                                    <option value="">{{ __('Select Client') }}</option>
                                    @foreach($clients as $client)

                                    <option value="{{ $client->id }}">{{ $client->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('password', __('Branch'), ['class' => 'col-form-label required-sym']) !!}
                                <select class="form-control " id="branch" name="branch" required="required">
                                    <option value="">{{ __('Select Branch') }}</option>
                                    @foreach($branches as $branch)
                                    @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                                    <option value="{{ $branch->id }}" {{ ($branch->id==\Auth::user()->branch_id) ? 'selected' : ''  }}>{{ $branch->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                     
                        <ul dir="rtl" class="list-group">
                           
                            @foreach($points as $key=> $point)
                                 <?php
                                    $point = str_replace("{{input}}", '<input type"text" name="input-' . $key . '" required  >', $point);
                                    $point = str_replace("{{input-2}}", '<input type"text" name="input-2-' . $key . '" required  >', $point);
                                    $point = str_replace("{{input-3}}", '<input type"text" name="input-3-' . $key . '" required  >', $point);
                                    
                                ?>
                               
                                
                                <li class="list-group-item" >{!! $point !!}</li>

                            @endforeach
                        </ul>


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
                        <a href="{{ route('contract') }}" class="btn btn-secondary btn-light ms-3">{{ __('Cancel') }}</a>
                        <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



@endsection