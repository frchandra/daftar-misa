@extends('layouts.main')

@section('container')


    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To Our Studio!</div>
            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>

            <table class="table table-light table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
            </table>

            <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
        </div>
    </header>

    

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Services</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row text-center">
                <form id="myForm">



                    <div class="form-floating">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" required>
                        <label for="nama">nama</label>     
                    </div>
        
                    <div class="form-floating">
                        <input type="text" name="nik" class="form-control" id="nik" placeholder="nik" required>
                        <label for="nik">nik</label>
                    </div>
        
                    <select class="form-select" name="lingkungan" id="lingkungan" required>            
                        <option value="1">paroki</option>
                        <option value="2">non paroki</option>
                        <option value="3">soe</option>
                        <option value="4">andr</option>
                        <option value="5">mik</option>
                        <option value="6">raf</option>
                    </select>                   
                     
                    <button class="w-100 btn btn-lg btn-primary" id="ajaxSubmit" aria-expanded="false" aria-controls="collapseExample">register</button> 

                    
        
                </form>   
            </div>
        </div>
    </section>


    <!-- Portfolio item 1 modal popup-->
    <div class="portfolio-modal modal fade" id="pendaftaranModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>                                
                                
                                <ul class="list-group">

                                </ul>    
                                <hr>                              

                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-times me-1"></i>
                                    Close Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <!-- Phone number input-->
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Message input-->
                            <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
            </form>
        </div>
    </section>


    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
    </script>

    <script>
        jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
               jQuery.ajax({
                    url: "{{ url('/') }}",
                    method: 'post',
                    data: {
                        nama: jQuery('#nama').val(),
                        nik: jQuery('#nik').val(),
                        lingkungan: jQuery('#lingkungan').val()
                    },
                    success: function(result){
                        // debugger;
                        console.log(result.success);
                        console.log(result.misa);
                        $(".removable").remove();

                        if(result.success==='tidak terdaftar'){                            
                            let p = $('<p class="removable">tidak terdaftar</p>');
                            $(p).insertAfter(".item-intro");
                            $('#pendaftaranModal').modal('show'); 
                        }

                        else if(result.success==='lingkungan error'){                            
                            let p = $('<p class="removable">lingkungan salah</p>');
                            $(p).insertAfter(".item-intro");
                            $('#pendaftaranModal').modal('show'); 
                        }

                        else{


                            for (let i=0; i<result.success.length; i++) {                            
                                let list = $('<li class="list-group-item removable"><input class="form-check-input me-1" type="checkbox" value="" aria-label="...">'+ result.success[i].nama +'</li>');
                                $('.list-group').append(list);
                            }

                            let p = $('<p class="removable">'+ result.success[0].namaLingkungan +'</p>');
                            $(p).insertAfter(".item-intro");


                            

                            $('#pendaftaranModal').modal('show');
                        }                  
                    }, 
                    
                    error: function(xhr, status, error) {
                        const err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }   
                });
            });
        });
    </script>


@endsection