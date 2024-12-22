<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5>{{ __('About Settings') }}</h5>
            <small class="text-muted">{{ __('Edit About details') }}</small>
        </div>
    </div>

    {{ Form::open(['url' => route('landingpagesetting.about'), 'enctype' => 'multipart/form-data']) }}
    {{ Form::hidden("about[1][id]",$about->id, ['class' => 'form-control ', 'placeholder' => _('Enter Welcome Message ')]) }}
       @php($aboutValue = json_decode($about->value))
       
        <div class="card-body pb-0  ">
            <div class="row">
                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Welcome Message'), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][welcome]",$aboutValue->welcome, ['class' => 'form-control ', 'placeholder' => _('Enter Welcome Message ')]) }}
                </div>

                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Abount us '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][about]",$aboutValue->about, ['class' => 'form-control ', 'placeholder' => _('Enter About us ')]) }}
                </div>


                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 1 Heading '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_1_heading]",$aboutValue->text_1_heading, ['class' => 'form-control ', 'placeholder' => _('Enter Text 1 Heading ')]) }}
                </div>

                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 1 Paragraph '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_1]",$aboutValue->text_1, ['class' => 'form-control ', 'placeholder' => _('Enter Text 1 Paragraph ')]) }}
                </div>


                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 2 Heading '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_2_heading]",$aboutValue->text_2_heading, ['class' => 'form-control ', 'placeholder' => _('Enter Text 2 Heading ')]) }}
                </div>

                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 1 Paragraph '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_2]",$aboutValue->text_2, ['class' => 'form-control ', 'placeholder' => _('Enter Text 2 Paragraph ')]) }}
                </div>


                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 3 Heading '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_3_heading]",$aboutValue->text_3_heading, ['class' => 'form-control ', 'placeholder' => _('Enter Text 3 Heading ')]) }}
                </div>

                <div class="col-12 form-group">
                    {{ Form::label('slider-heading', __('Text 3 Paragraph '), ['class' => 'col-form-label']) }}
                    {{ Form::text("about[1][text_3]",$aboutValue->text_3, ['class' => 'form-control ', 'placeholder' => _('Enter Text 3 Paragraph ')]) }}
                </div>


                <div class="col-12 dashboard-card">
                    <div class="card shadow-none border rounded-0">
                        <div class="card-body ">
                            <div class=" setting-card">
                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                    <div class="logo-content mt-4">

                                        <a href=""
                                            target="_blank">
                                            <img id="blahAbout" alt="your image"
                                                src="{{ (isset($aboutValue->img) || !empty($aboutValue->img) ) ? asset('storage/uploads/landing_page_image/'.$aboutValue->img)  : asset('assets/images/no-preview.jpg') }}"
                                                width="100%" height="200px" class="big-logo img_setting">
                                        </a>
                                    </div>
                                    <div class="choose-files mt-5">
                                        <label for="slider-about">
                                            <div class=" bg-primary dark_logo_update m-auto"> <i
                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                            </div>
                                            <input type="file" name="about[1][img]" id="slider-about"
                                                class="form-control file" data-filename="slider-about"
                                                onchange="document.getElementById('blahAbout').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
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