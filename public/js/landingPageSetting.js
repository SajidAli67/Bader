$('#add-slider').click(function(){
    var slider =
     `<div class="slider_row"
<div class="card-body pb-0  ">
<div class="row">
<div class="col-12">
  <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeRow" type="button"> <i class="fa fa-trash"></i></button>
</div>
<div class="col-12 form-group">
  {{ Form::label('slider-heading', __('Heading'), ['class' => 'col-form-label']) }}
  {{ Form::text('slider[heading][]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Heading')]) }}
</div>
<div class="col-12 form-group">
  {{ Form::label('slider-paragraph', __('Paragraph'), ['class' => 'col-form-label']) }}
  {{ Form::text('slider[paragraph][]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Paragraph')]) }}
</div>
<div class="col-12 dashboard-card">
  <div class="card shadow-none border rounded-0">
     <div class="card-body ">
        <div class=" setting-card">
           <div class="d-flex flex-column justify-content-between align-items-center h-100">
              <div class="logo-content mt-4">
                 <a href=""
                    target="_blank">
                 <img id="blah1" alt="your image"
                    src="{{ asset('assets/images/no-preview.jpg') }}"
                    width="100%" height="200px" class="big-logo img_setting">
                 </a>
              </div>
              <div class="choose-files mt-5">
                 <label for="slider-1">
                    <div class=" bg-primary dark_logo_update m-auto"> <i
                       class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                    </div>
                    <input type="file" name="slider[img][]" id="slider-1"
                       class="form-control file" data-filename="slider-1"
                       onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                 </label>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
</div>
<div> `
    $('#slider-area').append(slider)
})

$(document).on('click', '.removeRow', function() {
        $(this).closest('.slider_row').remove();
    });