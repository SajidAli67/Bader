<script>
    $('#add-slider').click(function() {
        var sliderCount = $(this).attr('data-count');
        sliderCount++;
        var slider =
            `<div class="slider_row"
                <div class="card-body pb-0  ">
                <div class="row">
                <div class="col-12">
                <input type="hidden" name="slider[` + (sliderCount + 1) + `][id]" value="">
                <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeRow" data-id=""  type="button"> <i class="fa fa-trash"></i></button>
                </div>
                <div class="col-12 form-group">
                {{ Form::label('slider-heading', __('Heading'), ['class' => 'col-form-label']) }}
                {{ Form::text('slider[` + (sliderCount + 1) + `][heading]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Heading')]) }}
                </div>
                <div class="col-12 form-group">
                {{ Form::label('slider-paragraph', __('Paragraph'), ['class' => 'col-form-label']) }}
                {{ Form::text('slider[` + (sliderCount + 1) + `][paragraph]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Paragraph')]) }}
                </div>
                <div class="col-12 dashboard-card">
                <div class="card shadow-none border rounded-0">
                    <div class="card-body ">
                        <div class=" setting-card">
                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                            <div class="logo-content mt-4">
                                <a href=""
                                    target="_blank">
                                <img id="blah` + (sliderCount + 1) + `" alt="your image"
                                    src="{{ asset('assets/images/no-preview.jpg') }}"
                                    width="100%" height="200px" class="big-logo img_setting_` + (sliderCount + 1) + `">
                                </a>
                            </div>
                            <div class="choose-files mt-5">
                                <label for="slider-` + (sliderCount + 1) + `">
                                    <div class=" bg-primary dark_logo_update m-auto"> <i
                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                    </div>
                                    <input type="file" name="slider[` + (sliderCount + 1) + `][img]" id="slider-` + (sliderCount + 1) + `"
                                    class="form-control file" data-filename="slider-` + (sliderCount + 1) + `"
                                    onchange="document.getElementById('blah` + (sliderCount + 1) + `').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            <div> `
            ++sliderCount
        $('#slider-area').append(slider)
    })

    $(document).on('click', '.removeRow', function() {
       var id =  $(this).attr('data-id')
       if(id !=''){
        delete_row(id)
       }
        
        $(this).closest('.slider_row').remove();
    });



    //services
    $('#add-services').click(function() {

        var servicesCount = $(this).attr('data-count');
        servicesCount++;
        var services =
            `<div class="service_row"
                <div class="card-body pb-0  ">
                <div class="row">
                <div class="col-12">
                <input type="hidden" name="service[` + (servicesCount + 1) + `][id]" value="">
                <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeServicesRow" data-id="" type="button"> <i class="fa fa-trash"></i></button>
                </div>
                <div class="col-12 form-group">
                {{ Form::label('service-heading', __('Heading'), ['class' => 'col-form-label']) }}
                {{ Form::text('service[` + (servicesCount + 1) + `][heading]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Heading')]) }}
                </div>
                <div class="col-12 form-group">
                {{ Form::label('service-paragraph', __('Paragraph'), ['class' => 'col-form-label']) }}
                {{ Form::text('service[` + (servicesCount + 1) + `][paragraph]', '', ['class' => 'form-control ', 'placeholder' => _('Enter Paragraph')]) }}
                </div>
                <div class="col-12 dashboard-card">
                <div class="card shadow-none border rounded-0">
                    <div class="card-body ">
                        <div class=" setting-card">
                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                            <div class="logo-content mt-4">
                                <a href=""
                                    target="_blank">
                                <img id="servicesBlah` + (servicesCount + 1) + `" alt="your image"
                                    src="{{ asset('assets/images/no-preview.jpg') }}"
                                    width="100%" height="200px" class="big-logo img_setting_` + (servicesCount + 1) + `">
                                </a>
                            </div>
                            <div class="choose-files mt-5">
                                <label for="service-` + (servicesCount + 1) + `">
                                    <div class=" bg-primary dark_logo_update m-auto"> <i
                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                    </div>
                                    <input type="file" name="service[` + (servicesCount + 1) + `][img]" id="service-` + (servicesCount + 1) + `"
                                    class="form-control file" data-filename="service-` + (servicesCount + 1) + `"
                                    onchange="document.getElementById('servicesBlah` + (servicesCount + 1) + `').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            <div> `
            ++servicesCount
        $('#services-area').append(services)
    })

    $(document).on('click', '.removeServicesRow', function() {
        var id =  $(this).attr('data-id')
       if(id !=''){
            delete_row(id)
        }
        $(this).closest('.service_row').remove();
    });


    $('#add-team').click(function() {

        var teamCount = $(this).attr('data-count');
        teamCount++;
        var team =
            `<div class="team_row"
                <div class="card-body pb-0  ">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeteamRow" data-id="" type="button"> <i class="fa fa-trash"></i></button>
                        </div>
                        <input type="hidden" name="team[` + (teamCount + 1) + `][id]" value="">
                        <div class="col-12 form-group">
                            {{ Form::label('team-name', __('Name'), ['class' => 'col-form-label']) }}
                            {{ Form::text("team[` + (teamCount + 1) + `][name]", '', ['class' => 'form-control ', 'placeholder' => _('Enter Name')]) }}
                        </div>
                        <div class="col-12 form-group">
                            {{ Form::label('team-designation', __('Designation'), ['class' => 'col-form-label']) }}
                            {{ Form::text("team[` + (teamCount + 1) + `][designation]", '', ['class' => 'form-control ', 'placeholder' => _('Enter Designation')]) }}
                        </div>
                        <div class="col-12 form-group">
                            {{ Form::label('team-facebook', __('Facebook Link'), ['class' => 'col-form-label']) }}
                            {{ Form::text("team[` + (teamCount + 1) + `][facebook]", '', ['class' => 'form-control ', 'placeholder' => _('Enter Facebook Link')]) }}
                        </div>

                        <div class="col-12 form-group">
                            {{ Form::label('team-twitter', __('Twitter Link'), ['class' => 'col-form-label']) }}
                            {{ Form::text("team[` + (teamCount + 1) + `][twitter]", '', ['class' => 'form-control ', 'placeholder' => _('Enter Twitter Link')]) }}
                        </div>


                        <div class="col-12 form-group">
                            {{ Form::label('team-instagram', __('Instagram Link'), ['class' => 'col-form-label']) }}
                            {{ Form::text("team[` + (teamCount + 1) + `][instagram]", '', ['class' => 'form-control ', 'placeholder' => _('Enter instagram Link')]) }}
                        </div>

                        <div class="col-12 dashboard-card">
                            <div class="card shadow-none border rounded-0">
                                <div class="card-body ">
                                    <div class="setting-card">
                                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                            <div class="logo-content mt-4">

                                                <a href=""
                                                    target="_blank">
                                                    <img id="blahTeam` + (teamCount + 1) + `" alt="your image"
                                                        src="{{ asset('assets/images/no-preview.jpg') }}"
                                                        width="100%" height="200px" class="big-logo img_setting">
                                                </a>
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="team-` + (teamCount + 1) + `">
                                                    <div class=" bg-primary dark_logo_update m-auto"> <i
                                                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                    </div>
                                                    <input type="file" name="team[` + (teamCount + 1) + `][img]" id="team-` + (teamCount + 1) + `"
                                                        class="form-control file" data-filename="team-` + (teamCount + 1) + `"
                                                        onchange="document.getElementById('blahTeam` + (teamCount + 1) + `').src = window.URL.createObjectURL(this.files[0])">
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <div> `
            ++teamCount
        $('#team-area').append(team)
    })

    $(document).on('click', '.removeteamRow', function() {
        var id =  $(this).attr('data-id')
       if(id !=''){
            delete_row(id)
        }
        $(this).closest('.team_row').remove();
    });

    //Team 


    function delete_row(id) {
        $.ajax({
            url: "{{ route('landingpagesetting.destroy') }}", //the page containing php script
            type: "post", //request type,
            data: { id:id},
            success: function(result) {
                console.log(result);
                var data = JSON.parse(result)
                if(data.status='success'){
                    show_toastr('{{ __('Success') }}',data.message, 'success')
                }
                else{
                    show_toastr('{{ __('Error') }}', data.message, 'error')
                }
                
            }
        });
    }
</script>