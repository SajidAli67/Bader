<!doctype html>
<html lang="en">

@include('landing_page.layout.head')
<body>
    <!-- ===============================*****Start Header*****=============================== -->
    @include('landing_page.layout.header')
    <!-- ===============================*****End Header*****=============================== -->
    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head-se-01">
                       <h3>ABOUT US</h3>
                       <ol>
                           <li>Home<i class="fas fa-angle-double-right"></i></li>
                           <li>About us</li>
                       </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="_po_jy_fr">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="_cs_we_er">
                        <div class="img-09">
                            <img src="{{ asset('landing/images/welcome-img.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="_pl_io_de">
                        <div class="_ty_we_xs">
                            <h2>Welcome to Lawyers</h2>
                            <p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box-001">
                                    <i class="fas fa-registered"></i>
                                    <h3>Request A Lawyer</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget maximus volutpat</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="box-001">
                                    <i class="fal fa-file-search"></i>
                                    <h3>Case Investigation</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget maximus volutpat</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="box-001">
                                    <i class="fas fa-address-card"></i>
                                    <h3>Search Directory</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis leo eget maximus volutpat</p>
                                </div>
                            </div>
                        </div>
                        <a href="#">Contact us</a>
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