
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="Login, log-in, log in, aml, idlc aml, mutual fund, aml login"/>
        <meta name="description" content="Log-in to your account for IDLC Mutual Funds at IDLC Asset Management Limited"/>
        <meta name="robots" content="index,follow"/>

        <title>IDLC AML - Login</title>

        <!-- Bootstrap -->
        <link href="{{ asset('idlc_aml_styles') }}/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/custom.css">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/animate.css">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/jquery-ui.min.css">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/jquery.bxslider.min.css">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/font-awesome.css">
        <link rel="shortcut icon" href="http://digital.aml.idlc.com/images/favicon.png">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/sweetalert.css">
        <link rel="stylesheet" href="{{ asset('idlc_aml_styles') }}/bootstrap-datepicker.css">

        <script type="text/javascript">
            var baseURL = '{{ url("/") }}';
            </script>

        <style>
            /* Prevents slides from flashing */
            #slidesShow {
                display: none;
            }

            #slidesShow .slidesjs-navigation {
                margin-top:5px;
            }

            a.slidesjs-next,
            a.slidesjs-previous,
            a.slidesjs-play,


            a.slidesjs-next {
                margin-right:10px;
                background-position: -12px 0;
            }

            a:hover.slidesjs-next {
                background-position: -12px -18px;
            }

            a.slidesjs-previous {
                background-position: 0 0;
            }

            a:hover.slidesjs-previous {
                background-position: 0 -18px;
            }

            a.slidesjs-play {
                width:15px;
                background-position: -25px 0;
            }

            a:hover.slidesjs-play {
                background-position: -25px -18px;
            }

            a.slidesjs-stop {
                width:18px;
                background-position: -41px 0;
            }

            a:hover.slidesjs-stop {
                background-position: -41px -18px;
            }

            .slidesjs-pagination {
                margin: 7px 0 0;
                float: right;
                list-style: none;
            }

            .slidesjs-pagination li {
                float: left;
                margin: 0 1px;
            }



            .slidesjs-pagination li a.active,
            .slidesjs-pagination li a:hover.active {
                background-position: 0 -13px
            }

            .slidesjs-pagination li a:hover {
                background-position: 0 -26px
            }

            #slidesShow a:link,
            #slidesShow a:visited {
                color: #333
            }

            #slidesShow a:hover,
            #slidesShow a:active {
                color: #9e2020
            }

        </style>



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->    </head>
    <body>
        <div class="modal fade" id="required_documents" tabindex="-1" role="dialog" aria-labelledby="required_documentsLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="required_documentsLabel">What is the list of required documents?</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong>For Individual investor, following documents are required –</strong></p>

                        <ol>
                            <li>Copy of National Identity Card/Passport/Driving license/Identity Card (for students)</li>
                            <li>One Passport size photo - Single applicant, Joint applicant (if any), Nominee</li>
                            <li>Bank statement or Photocopy of a blank cheque leaf</li>
                            <li>E-TIN Certificate</li>
                        </ol>

                        <br>

                        <p><strong>For institutional investor, following documents are required –</strong></p>

                        <ol>
                            <li>Extract of Board resolution for investing in mutual fund</li>
                            <li>Power of Attorney of the Authorized signatories</li>
                            <li>Memorandum and Article of Association</li>
                            <li>Trust Deed (for mutual fund)</li>
                            <li>Certificate of Incorporation</li>
                            <li>One Passport size photo – CEO / MD, 1st Authorized Person, 2nd Authorized Person (if any)</li>
                            <li>Bank statement or Photocopy of a blank cheque leaf</li>
                            <li>E-TIN Certificate</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedbackLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="feedbackLabel">Feedback</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="submitFeedback" method="post">
                            <input type="hidden" name="request_type" value="submitFeedback">
                            <fieldset class="form-group">
                                <p>Your Name</p>
                                <input type="text" name="name" class="form-control" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <p>Phone Number</p>
                                <input type="text" name="phone_number" class="form-control" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <p>Email Address</p>
                                <input type="text" name="email" class="form-control" required>
                            </fieldset>
                            <fieldset class="form-group">
                                <p>Comments</p>
                                <textarea class="form-control" name="comment" width="100%" style="height: 120px"></textarea>
                            </fieldset>

                            <input type="submit" value="Submit" class="red_button">
                        </form>
                    </div>
                </div>
            </div>
        </div>    <header>
            <div class="container" style="padding:15px 0 5px 0">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <a href="http://aml.idlc.com/" id="logo"></a>
                    </div>
                    <div class="col-md-1 col-xs-3" style="text-align: right">
                        <a href="tel:16409" class="call">16409</a>
                    </div>
                    <div class="col-md-2 col-xs-3" style="text-align: center">
                        <a href="javascript:void(0);" class="locate">Locate Us</a>
                    </div>
                    <div class="col-md-2 col-xs-12" style="text-align: center">
                        <form action="#" id="header_search" onsubmit="return false;" class="hide">
                            <button type="submit"></button>
                            <input type="text" placeholder="" onkeyup="showResult(this.value)">
                            <div id="livesearch"></div>

                            <div class="clearfix"></div>
                        </form>
                    </div>

                    @if(session()->get('mobile_no') !== null && session()->get('ifausraccess') !== null)
                        <div class="col-md-4 col-xs-12">
                            <a class="login" href="./exit" >SignOut</a>
                        </div>
                    @endif
                    {{--<div class="col-md-2 col-xs-12">--}}
                        {{--<a target="_blank" href="http://digital.aml.idlc.com/auth/login" class="login">Login</a>--}}
                    {{--</div>--}}

                    <div class="col-xs-12">
                        <div class="mobile_hamburger">
                            <button class="menu-btn">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mobile-nav">
                    <a href="#" class="menu-close-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <ul class="levelone">
                        <li><span><a href="http://aml.idlc.com/"><span class="glyphicon glyphicon-home"></span></a></span>
                        <li><span><a href="http://aml.idlc.com/products.php">Products</a> <i class="fa fa-chevron-down"></i></span>
                            <ul class="leveltwo">
                                <li><a href='http://aml.idlc.com/fund.php%3Ffund_id=6'>IDLC Balanced Fund</a></li>                    </ul>
                        </li>
                        <li><span><a href="http://aml.idlc.com/planning.php">Planning</a> <i class="fa fa-chevron-down"></i></span>
                            <ul class="leveltwo">
                                <li><a href="http://aml.idlc.com/check_your_risks.php">Check Your Risk Profile</a></li>
                                <li><a href="http://aml.idlc.com/plan_your_life_goals.php">Plan Your Life Goals</a></li>
                            </ul>
                        </li>
                        <li><span><a href="http://aml.idlc.com/awareness_and_education.php">Awareness and Education</a> <i class="fa fa-chevron-down"></i></span>
                            <ul class="leveltwo">
                                <li><a href="http://aml.idlc.com/what_is_mutual_fund.php">What is Mutual Fund</a></li>
                                <li><a href="http://aml.idlc.com/faq.php">Faq</a></li><li><a href="videos.php">Videos</a></li>
                                <li><a href="http://aml.idlc.com/mythbuster">Myth or Reality</a></li>

                            </ul>
                        </li>
                        <li><span><a href="http://aml.idlc.com/nav.php">NAV</a></span></li>
                        <li><span><a href="http://aml.idlc.com/our_story.php">Our Story</a> <i class="fa fa-chevron-down"></i></span>
                            <ul class="leveltwo">
                                <li><a href="http://aml.idlc.com/our_philosophy.php">Our Philosophy</a></li>
                                <li><a href="http://aml.idlc.com/our_journey.php">Our Journey</a></li>
                                <li><a href="http://aml.idlc.com/our_management.php">Who We Are</a></li>
                                <li><a href="http://aml.idlc.com/our_sister_concerns.php">Our Sister Concerns</a></li>
                                <li><a href="http://aml.idlc.com/http://idlc.com/news-events.php">News and Events</a></li>
                            </ul>
                        </li>
                        <li><span><a href="http://aml.idlc.com/investor_relations.php">Investor Relations</a> <i class="fa fa-chevron-down"></i></span>
                            <ul class="leveltwo">
                                <li><a href="http://aml.idlc.com/purchase_and_surrender_procedures.php">PURCHASE/SURRENDER/TRANSFER PROCEDURE</a></li>
                                <li><a href="http://aml.idlc.com/risk_factors.php">Risk Factors</a></li>
                                <li><a href="http://aml.idlc.com/statements.php">Statements</a></li>
                                <li><a href="http://aml.idlc.com/rules_and_regulations.php">Rules and Regulations</a></li>
                                <li><a href="http://aml.idlc.com/terms_and_conditions_product.php">Terms and Conditions</a></li>
                                <li><a href="http://aml.idlc.com/prospectus.php">Prospectus</a></li>
                                <li><a href="http://aml.idlc.com/forms.php">Forms</a></li>
                            </ul>
                        </li>
                        <li><span><a href="http://www.idlc.com/careers-why-idlc.php">Career</a></span></li>
                    </ul>
                </nav>
            </div>

            <div id="menu" class="wow fadeInUp">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 choose">
                            <ul>
                                <li><a href="http://aml.idlc.com/"><span class="glyphicon glyphicon-home" style="font-size: 16px"></span></a></li>
                                <li>
                                    <a href="http://aml.idlc.com/products.php">Products</a>
                                    <ul>
                                        <li><a href='http://aml.idlc.com/fund.php%3Ffund_id=6'>IDLC Balanced Fund</a></li>                            </ul>
                                </li>
                                <li>
                                    <a href="http://aml.idlc.com/planning.php">Planning</a>
                                    <ul>
                                        <li><a href="http://aml.idlc.com/check_your_risks.php">Check your risk profile</a></li>
                                        <li><a href="http://aml.idlc.com/plan_your_life_goals.php">Plan your life goals</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="http://aml.idlc.com/awareness_and_education.php">Awareness &amp; Education</a>
                                    <ul>
                                        <li><a href="http://aml.idlc.com/what_is_mutual_fund.php">What is Mutual Fund</a></li>
                                        <li><a href="http://aml.idlc.com/faq.php">Faq</a></li><li><a href="videos.php">Videos</a></li>
                                        <li><a href="http://aml.idlc.com/mythbuster">Myth or Reality</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 main_menu">
                            <ul>
                                <li><a href="http://aml.idlc.com/nav.php">Nav</a></li>
                                <li>
                                    <a href="http://aml.idlc.com/our_story.php">Our Story</a>
                                    <ul>
                                        <li><a href="http://aml.idlc.com/our_philosophy.php">Our Philosophy</a></li>
                                        <li><a href="http://aml.idlc.com/our_journey.php">Our Journey</a></li>
                                        <li><a href="http://aml.idlc.com/our_management.php">Who We Are</a></li>
                                        <li><a href="http://aml.idlc.com/our_sister_concerns.php">Our Sister Concerns</a></li>
                                        <li><a href="http://idlc.com/news-events.php">News and Events</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="http://aml.idlc.com/investor_relations.php">Investor Relations</a>
                                    <ul>
                                        <li><a href="http://aml.idlc.com/purchase_and_surrender_procedures.php">PURCHASE/SURRENDER/TRANSFER PROCEDURE</a></li>
                                        <li><a href="http://aml.idlc.com/risk_factors.php">Risk Factors</a></li>
                                        <li><a href="http://aml.idlc.com/statements.php">Statements</a></li>
                                        <li><a href="http://aml.idlc.com/rules_and_regulations.php">Rules &amp; Regulations</a></li>
                                        <li><a href="http://aml.idlc.com/terms_and_conditions_product.php">Terms and Conditions</a></li>
                                        <li><a href="http://aml.idlc.com/prospectus.php">Prospectus</a></li>
                                        <li><a href="http://aml.idlc.com/forms.php">Forms</a></li>
                                    </ul>
                                </li>
                                <li><a href="http://www.idlc.com/careers-why-idlc.php">Career</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>    <section class='page_heading'>
            <div class='cover' xmlns="http://www.w3.org/1999/html">
                <img src='http://digital.aml.idlc.com/images/cover_1.jpg' alt=''>
            </div>
            <div class='container'>
                <div class='single_heading wow fadeInDown'>
                    <h1>IFA Registration</h1>
                </div>
            </div>
        </section>

        <section class="page_content">
            <div class="container">
                @yield('content')
            </div>
        </section>

        <div class="clearfix"></div>

        <footer>
            <div class="container">
                <div class="row footer-comps">
                    <div class="col-md-2">
                        <ul>
                            <li><a id="idlcAmlHome" href="http://aml.idlc.com/" target="__blank">IDLCAML Home Page</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2">

                    </div>

                    <div class="col-md-3">
                        <h4>Feedback</h4>

                        <p>Send us your feedback. we would love to hear from you.</p>

                        <center><button type="button" class="red_button" data-toggle="modal" data-target="#feedback" style="font-size: 16px;padding: 5px 10px;margin-top: 0px;display: inline-block;text-align: center;margin: 0">Feedback</button></center>
                    </div>
                    <div class="col-md-3">
                        <h4>IDLC AML HEAD OFFICE</h4>
                        <p>IDLC Asset Management Limited</p><p>South Avenue Tower (5th Floor)<br>Unit 502, House 50, Road 3<br>7 Gulshan Avenue, Dhaka 1212, Bangladesh</p>
                        <p>Contact: 16409</p>
                        <p>Fax: +88-02-9896142</p>

                    </div>
                    <div class="col-md-2" style="text-align: center">
                        <h4>Connect with us</h4>

                        <a href="https://www.facebook.com/IDLC.FinancingHappiness/" class="fb"></a> <a href="https://www.linkedin.com/company/idlc-finance-limited"class="in"></a> <a href="https://www.youtube.com/user/idlcfinancelimited" class="yt"></a>
                    </div>
                </div>

                <div class="row footer-meta">
                    <div class="col-md-6"><p>COPYRIGHT 2017 | IDLC ASSET MANAGEMENT LIMITED</p></div>
                    <div class="col-md-6"><p style="text-align:right"><a href="http://aml.idlc.com/disclaimer.php">Disclaimer</a>
                            <a href="http://aml.idlc.com/privacy_policy.php">Privacy Policy</a>
                            <a href="http://aml.idlc.com/terms_and_conditions.php">Terms &amp; Conditions</a></p></div>
                </div>
            </div>
        </footer><a href="#" id="totop">TOP</a>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <script src="{{ asset('idlc_aml_scripts') }}/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('idlc_aml_scripts') }}/bootstrap.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/jquery-ui.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/jquery.bxslider.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/wow.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/jquery-scrolltofixed-min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/idle-timer.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/jquery.slides.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/cleave.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/sweetalert.min.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/custom.js"></script>
        <script src="{{ asset('idlc_aml_scripts') }}/bootstrap-datepicker.js"></script>

        <script src="{{ asset('idlc_aml_scripts') }}/new_custom.js"></script>

        <script>
                        $('[data-toggle=offcanvas]').click(function () {
                            $('.row-offcanvas').toggleClass('active');
                            $('.collapse').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
                        });
        </script>
        @yield('addscript')
    </body>
</html>
