<!doctype html>
<html lang="en">

@include('landing_page.layout.head')
<body>
    <!-- ===============================*****Start Header*****=============================== -->
    @include('landing_page.layout.header')
    <!-- ===============================*****End Header*****=============================== -->

    <!-- ===============================*****Start Slider*****=============================== -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head-se-01">
                       <h3>SERVICES</h3>
                       <ol>
                           <li>Home<i class="fas fa-angle-double-right"></i></li>
                           <li>Services</li>
                       </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head-01">
                        <h2>Our Services</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt</p>
                    </div>
                </div>
            </div>
            <div class="row">
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
        <div class="container">
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

    <section class="bg-02">
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
                        <img src="{{ asset('landing/images/team/4.jpg') }}">
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
    @include('landing_page.layout.footer')
   
</body>


@include('landing_page.layout.script')
</html>