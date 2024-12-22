<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5>{{ __('Slider Settings') }}</h5>
            <small class="text-muted">{{ __('Edit Slider details') }}</small>
        </div>
        <div class="col-6">
            <div class="row align-items-end mb-3">
                <div class="col-md-12 d-flex justify-content-sm-end">
                    <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
                        <button id="add-slider" class="btn btn-sm btn-primary mx-1" data-count="{{ $slidersCount }}" title="Add More">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(['url' => route('landingpagesetting.slider'), 'enctype' => 'multipart/form-data']) }}
    @if(!empty($sliders))
    @foreach($sliders as $key => $slider1)
    @php($slider = json_decode($slider1->value))


    <div class="slider_row">
        <div class="card-body pb-0  ">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeRow" data-id="{{ $slider1->id }}" type="button"> <i class="fa fa-trash"></i></button>
                </div>
                <input type="hidden" name="slider[{{$key + 1}}][id]" value="{{ $slider1->id }}">
                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Heading'), ['class' => 'col-form-label']) }}
                    {{ Form::text("slider[". $key+1 . "][heading]", $slider->heading, ['class' => 'form-control ', 'placeholder' => _('Enter Heading')]) }}
                </div>
                <div class="col-12 form-group">
                    {{ Form::label('slider-paragraph', __('Paragraph'), ['class' => 'col-form-label']) }}
                    {{ Form::text("slider[". $key+1 . "][paragraph]", $slider->paragraph, ['class' => 'form-control ', 'placeholder' => _('Enter Paragraph')]) }}
                </div>
                <div class="col-12 dashboard-card">
                    <div class="card shadow-none border rounded-0">
                        <div class="card-body ">
                            <div class=" setting-card">
                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                    <div class="logo-content mt-4">

                                        <a href=""
                                            target="_blank">
                                            <img id="blah{{   $key+1 }}" alt="your image"
                                                src="{{ (isset($slider->img)) ? asset('storage/uploads/landing_page_image/'.$slider->img)  : asset('assets/images/no-preview.jpg') }}"
                                                width="100%" height="200px" class="big-logo img_setting">
                                        </a>
                                    </div>
                                    <div class="choose-files mt-5">
                                        <label for="slider-{{   $key+1 }}">
                                            <div class=" bg-primary dark_logo_update m-auto"> <i
                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                            </div>
                                            <input type="file" name="slider[{{ $key+1 }}][img]" id="slider-{{  $key+1 }}"
                                                class="form-control file" data-filename="slider-{{   $key+1 }}"
                                                onchange="document.getElementById('blah{{   $key+1 }}').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    @endif

    <div id="slider-area">

    </div>


    <div class="card-footer text-end">
        <button class="btn-submit btn btn-primary" type="submit">
            {{ __('Save Changes') }}
        </button>
    </div>
    {{ Form::close() }}
</div>