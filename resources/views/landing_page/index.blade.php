@php
    if(Auth::check()){
        $users = \Auth::user();
        $currantLang = $users->currentLanguage();
        $languages = App\Models\Utility::languages();
        $LangName = \App\Models\Languages::where('code',$currantLang)->first();
        if (empty($LangName)){
            $LangName  = new App\Models\Utility();
            $LangName->fullName = 'English';
        }
        $code = $currantLang=='en' ? 'ar' :'en';
    }
    else{
        
        $currantLang = Session::get('locale');
        $code = $currantLang=='en' ? 'ar' :'en'; 
    }
        
@endphp
<!doctype html>
<html lang="{{$currantLang }}">

@include('landing_page.layout.head')
<body>
    <!-- ===============================*****Start Header*****=============================== -->
    @include('landing_page.layout.header')
    <!-- ===============================*****End Header*****=============================== -->

    <!-- ===============================*****Start Slider*****=============================== -->

    <section class="slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($sliders as $key => $slider )
                @php($slider = json_decode($slider->value))
             
                <div class="carousel-item {{ ($key==0) ? 'active'  : ''  }} ">
                    <img src="{{ asset('storage/uploads/landing_page_image/'.$slider->img) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="_nb_mc">
                                    <h2>{{ $slider->heading }}</h2>
                                    <p> {{ $slider->paragraph }}</p>
                                        <a href="#">Contact us</a>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </section>

    <section class="_po_jy_fr">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="_cs_we_er">
                        <div class="img-09" data-aos="fade-up"  data-aos-duration="2000">
                            <img src=" {{ asset('storage/uploads/landing_page_image/'.$about->img) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="_pl_io_de" data-aos="fade-up" data-aos-duration="2000">
                        <div class="_ty_we_xs">
                            <h2>{{ $about->welcome }}</h2>
                            <p>{{ $about->about }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box-001">
                                    <i class="fas fa-registered"></i>
                                    <h3>{{ $about->text_1_heading }}</h3>
                                    <p>{{ $about->text_1 }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="box-001">
                                   <i class="far fa-file-alt"></i>
                                    <h3>{{ $about->text_2_heading }}</h3>
                                    <p>{{ $about->text_2 }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="box-001">
                                    <i class="fas fa-address-card"></i>
                                    <h3>{{ $about->text_3_heading }}</h3>
                                    <p>{{ $about->text_3 }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="#">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head-01" data-aos="fade-up"  data-aos-duration="2000">
                        <h2>Our Services</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-up"  data-aos-duration="2000">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-landmark"></i>
                        <h3>FREE CONSULTING</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-concierge-bell"></i>
                        <h3>SPECIAL SERVICES</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-user-tie"></i>
                        <h3>DISCUSS STRATEGY BUILDS</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-american-sign-language-interpreting"></i>
                        <h3>MEDIATION</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-gavel"></i>
                        <h3>CILVIL LAW</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-users"></i>
                        <h3>FAMILY DISPUTES</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-anchor"></i>
                        <h3>CRIMINAL CHARGES</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ser-box">
                        <i class="fas fa-money-check"></i>
                        <h3>BANKRUPTCY</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-01">
        <div class="container" data-aos="fade-up"  data-aos-duration="2000">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="_lk_bg_cd">
                        <i class="fas fa-mug-hot"></i>
                      <div class="counting" data-count="967">0</div>
                      <h5>Attorneys</h5>
                    </div>
              </div>

              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="_lk_bg_cd">
                        <i class="fas fa-gavel"></i>
                      <div class="counting" data-count="800">0</div>
                      <h5>Case Won</h5>
                    </div>
              </div>

              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="_lk_bg_cd">
                        <i class="fas fa-balance-scale-right"></i>
                      <div class="counting" data-count="200">0</div>
                      <h5>Legal Way</h5>
                    </div>
              </div>

              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="_lk_bg_cd">
                        <i class="fas fa-mug-hot"></i>
                      <div class="counting" data-count="2067">0</div>
                      <h5>Happy Clients</h5>
                    </div>
              </div>
            </div>
        </div>
    </section>


    <section class="bg-02" data-aos="fade-up"  data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head-01">
                        <h2>Meet our team</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="team-main-box">
                        <img src="{{ asset('landing/images/team/3.jpg') }}">
                        <div class="team-content-box">
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                            </ul>
                            <h3>Williams</h3>
                            <b>Attorneys</b>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="team-main-box">
                        <img src="{{ asset('landing/images/team/2.jpg') }}">
                        <div class="team-content-box">
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                            </ul>
                            <h3>Anderson john</h3>
                            <b>Criminal Consultant</b>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="team-main-box">
                        <img src="{{ asset('landing/images/team/4.jpg') }} ">
                        <div class="team-content-box">
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                            </ul>
                            <h3>Sarah Se</h3>
                            <b>Family Consultant</b>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="team-main-box">
                        <img src="{{ asset('landing/images/team/1.jpg') }}">
                        <div class="team-content-box">
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                            </ul>
                            <h3>Williams</h3>
                            <b>Divorce Consultant</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-03" data-aos="fade-up"  data-aos-duration="1000">
        <div class="container" data-aos="fade-up"  data-aos-duration="2000">
            <div class="row">
               <div class="col-12">
                    <div class="head-01">
                        <h2>Case Study</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <article class="_kl_cd">
                        <div class="_i-tr">
                            <img src="{{ asset('landing/images/blog/1.jpg') }}">
                        </div>
                        <div class="_oi_er_we">
                            <h3>By Whom Your Business</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias eius illum libero dolor nobis....</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    @include('landing_page.layout.footer')
   
</body>


@include('landing_page.layout.script')
</html>