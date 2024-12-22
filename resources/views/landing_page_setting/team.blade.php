<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5>{{ __('Team Settings') }}</h5>
            <small class="text-muted">{{ __('Edit Team details') }}</small>
        </div>
        <div class="col-6">
            <div class="row align-items-end mb-3">
                <div class="col-md-12 d-flex justify-content-sm-end">
                    <div class="text-end d-flex all-button-box justify-content-md-end justify-content-center">
                        <button id="add-team" class="btn btn-sm btn-primary mx-1" data-count="{{ $teamCount }}" title="Add More">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(['url' => route('landingpagesetting.team'), 'enctype' => 'multipart/form-data']) }}
    @if(!empty($teams))
    @foreach($teams as $key => $team1)
    @php($team = json_decode($team1->value))


    <div class="team_row">
        <div class="card-body pb-0  ">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-sm btn-danger  pull-right mx-1 mt-3 removeteamRow" data-id="{{ $team1->id }}" type="button"> <i class="fa fa-trash"></i></button>
                </div>
                <input type="hidden" name="team[{{$key + 1}}][id]" value="{{ $team1->id }}">
                <div class="col-12 form-group">
                    {{ Form::label('team-name', __('Name'), ['class' => 'col-form-label']) }}
                    {{ Form::text("team[". $key+1 . "][name]", $team->name, ['class' => 'form-control ', 'placeholder' => _('Enter Name')]) }}
                </div>
                <div class="col-12 form-group">
                    {{ Form::label('team-designation', __('Designation'), ['class' => 'col-form-label']) }}
                    {{ Form::text("team[". $key+1 . "][designation]", $team->designation, ['class' => 'form-control ', 'placeholder' => _('Enter Designation')]) }}
                </div>
                <div class="col-12 form-group">
                    {{ Form::label('team-facebook', __('Facebook Link'), ['class' => 'col-form-label']) }}
                    {{ Form::text("team[". $key+1 . "][facebook]", $team->facebook, ['class' => 'form-control ', 'placeholder' => _('Enter Facebook Link')]) }}
                </div>

                <div class="col-12 form-group">
                    {{ Form::label('team-twitter', __('Twitter Link'), ['class' => 'col-form-label']) }}
                    {{ Form::text("team[". $key+1 . "][twitter]", $team->twitter, ['class' => 'form-control ', 'placeholder' => _('Enter Twitter Link')]) }}
                </div>


                <div class="col-12 form-group">
                    {{ Form::label('team-instagram', __('Instagram Link'), ['class' => 'col-form-label']) }}
                    {{ Form::text("team[". $key+1 . "][instagram]", $team->instagram, ['class' => 'form-control ', 'placeholder' => _('Enter instagram Link')]) }}
                </div>

                <div class="col-12 dashboard-card">
                    <div class="card shadow-none border rounded-0">
                        <div class="card-body ">
                            <div class="setting-card">
                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                    <div class="logo-content mt-4">

                                        <a href=""
                                            target="_blank">
                                            <img id="blahTeam{{   $key+1 }}" alt="your image"
                                                src="{{ (isset($team->img)) ? asset('storage/uploads/landing_page_image/'.$team->img)  : asset('assets/images/no-preview.jpg') }}"
                                                width="100%" height="200px" class="big-logo img_setting">
                                        </a>
                                    </div>
                                    <div class="choose-files mt-5">
                                        <label for="team-{{   $key+1 }}">
                                            <div class=" bg-primary dark_logo_update m-auto"> <i
                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                            </div>
                                            <input type="file" name="team[{{ $key+1 }}][img]" id="team-{{  $key+1 }}"
                                                class="form-control file" data-filename="team-{{   $key+1 }}"
                                                onchange="document.getElementById('blahTeam{{   $key+1 }}').src = window.URL.createObjectURL(this.files[0])">
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

    <div id="team-area">

    </div>


    <div class="card-footer text-end">
        <button class="btn-submit btn btn-primary" type="submit">
            {{ __('Save Changes') }}
        </button>
    </div>
    {{ Form::close() }}
</div>