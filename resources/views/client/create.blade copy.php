{{ Form::open(['route' => 'client.store', 'class' => 'frm-submit-data', 'method' => 'post', 'autocomplete' => 'off']) }}
<div class="modal-body">

    <div class="row">
        <div class="form-group col-md-12">
            {!! Form::label('name', __('Name'), ['class' => 'form-label required-sym']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group col-md-12">
            {!! Form::label('mobile', __('Mobile'), ['class' => 'form-label required-sym']) !!}
            {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-12">
            {!! Form::checkbox('isWhatsapp', 'sources', false, ['id' => 'isWhatsapp']) !!}
            {!! Form::label('isWhatsapp', __('Same as Mobile Number'), ['class' => 'form-label']) !!}
        </div>

        <div class="form-group col-md-12">
            {!! Form::label('whatsapp_number', __('WhatsApp Number'), ['class' => 'form-label','id' => 'whatsapp_number' ]) !!}
            {!! Form::text('whatsapp_number', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group col-md-12">
            {{ Form::label('Email', __('Email'), ['class' => 'form-label']) }}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-12">
            {!! Form::label('password', __('Password'), ['class' => 'form-label']) !!}
            {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'minlength'=>"8", 'autocomplete' => 'new-password'))}}
            <span class="small">{{__('Minimum 8 characters')}}</span>
        </div>

        <div class="form-group col-md-12">
            {!! Form::label('password', __('Branch'), ['class' => 'form-label']) !!}
            <select class="form-control" id="branch" name="branch">
                <option value="">{{ __('Select Branch') }}</option>
                @foreach($branches as $branch)
                @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endif
                @endforeach
            </select>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <button type="submit" class="btn btn-primary ms-2"> {{__('Create')}}</button>
</div>
{{Form::close()}}