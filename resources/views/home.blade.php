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
                <form action="/misa-saya" method="GET" id="myForm" >
                    @csrf


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

                    <input type="submit" name="submit" class="w-100 btn btn-lg btn-primary mt-1" value="cek misa">

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
                                <div style="visibility:hidden; color:red; " id="chk_option_error">
                                    tolong lengkapi input.
                                </div>   
 
                                
                                <form id="daftar" action="/daftar"  method="post">      
                                    @csrf           
           
                                
                                    <ul class="list-group"></ul>    
                                    
                                    <hr>       

                                    <div class="content">

                                        <div class="container">      
                                    
                                            <div class="table-responsive">
                                    
                                                <table class="table custom-table removable-table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">perayaan</th>
                                                    <th scope="col">tanggal</th>
                                                    <th scope="col">waktu</th>
                                                    <th scope="col">kuota</th>
                                                    <th scope="col">terdaftar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="append-misa"></tbody>
                                                </table>
                                            </div>
                                    
                                    
                                        </div>
                                    
                                    </div>

                                    <input type="submit" name="Submit" class="btn btn-primary btn-xl text-uppercase" value="simpan perubahan">

                                    {{-- <button class="btn btn-primary btn-xl text-uppercase" type="submit">
                                        simpan perubahan
                                    </button> --}}

                                </form> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    url: "{{ url('/validate') }}",
                    method: 'post',
                    data: {
                        nama: jQuery('#nama').val(),
                        nik: jQuery('#nik').val(),
                        lingkungan: jQuery('#lingkungan').val()
                    },
                    success: function(result){
                        // debugger;
                        // console.log(result.success);
                        // console.log(result.misa);
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
                                let list = $('<li class="list-group-item removable"><input class="form-check-input me-1" type="checkbox" value='+ result.success[i].umat_id +' aria-label="..." name="umats[]">'+ result.success[i].nama +'</li>');
                                $('.list-group').append(list);
                            }

                            let p = $('<p class="removable">'+ result.success[0].namaLingkungan +'</p>');
                            $(p).insertAfter(".item-intro");


                                for (let i=0; i<result.misa.length; i++){
                                    let list = $('<tr class="removable"><th scope="row"><input class="form-check-input" type="radio" value='+ result.misa[i].lingkungan_misa_id +' name="lingkungan_misa_id"></th><td>'+ result.misa[i].perayaan +'</td><td>'+ result.misa[i].tanggal +'</td><td>'+ result.misa[i].jam +'</td><td>'+ result.misa[i].kuota +'</td><td>'+ result.misa[i].terdaftar +'</td></tr>');
                                    $('.append-misa').append(list);
                                }

                            

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

    <script>
        $(document).ready(function(){
            $("form#daftar").submit(function(){
                if ($('input:checkbox').filter(':checked').length < 1 || $('input:radio').filter(':checked').length < 1){
                        // alert("Please Check at least one Check Box");
                        document.getElementById("chk_option_error").style.visibility = "visible"
                return false;
                }
            });
        });
    </script>


@endsection