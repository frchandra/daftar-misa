@extends('layouts.main')
@section('container') 

    <!-- Masthead-->
    <header class="masthead">
        <div class="container bg-danger pt-5 pb-5">

            @if ($response=='sukses')
            <div class="masthead-subheading">pendaftaran berhasil</div>
            <p>{{ $nama }}</p>
            <div style="overflow-x:auto;">
            <table class="table table-light table-striped ">
                <thead>
                  <tr>                    
                    <th scope="col">perayaan</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">jam</th>
                    <th scope="col">lingkungan</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data as $dat)                        
                        <tr>                    
                            <td>{{ $dat['perayaan'] }}</td>
                            <td>{{ $dat['tanggal'] }}</td>
                            <td>{{ $dat['jam'] }}</td>
                            <td>{{ $dat['namaLingkungan'] }}</td>
                            <td scope="col">
                                <button class="w-100 btn btn-lg btn-primary btn-delete" id="ajaxSubmit" aria-expanded="false" data-id="{{ $dat['umat_lingkungan_misa_id'] }}">delete</button> 
                            </td>
                        </tr>
                    @endforeach 

                </tbody>
            </table>   
            </div>             

            @else
            <div class="masthead-subheading">nama tidak ditemukan</div>
                       
            
            @endif



            


           

            <a class="btn btn-primary btn-xl text-uppercase" href="./">Kembali</a>
        </div>
    </header>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
    </script>



    <script>
        $('.btn-delete').on('click', function(e){
            var r = confirm("Press a button!");
            if (r == true) {
                console.log($(this).data('id'));
                e.preventDefault();
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                jQuery.ajax({
                    url: "{{ url('/misa-saya') }}",
                    method: 'delete',
                    data: {
                        ulmId: $(this).data('id')
                    },
                    success: function(result){                        
                        console.log(result.response);
                    }, 

                    error: function(error) {
                        console.log(error);
                    }   
                });
                
            } else {
                
            }
            



        })


    </script>

@endsection