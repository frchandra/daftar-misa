@extends('layouts.main')

@section('container')
    <h1>Home</h1>

    <h2>{{ $header }}</h2>

    {{-- @if (session()->has('test'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('test') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> 
    @endif --}}

    
    
    



    {{-- @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> 
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="/" method="POST">

        @csrf

        <div class="form-floating">
            <input type="text" name="nama" class="form-control @error('galat') is-invalid @enderror" id="nama" placeholder="nama" required>
            <label for="nama">nama</label>     
        </div>

        <div class="form-floating">
            <input type="text" name="nik" class="form-control @error('galat') is-invalid @enderror" id="nik" placeholder="nik" required>
            <label for="nik">nik</label>
        </div>

        <select class="form-select" name="lingkungan" required>            
            <option value="1">paroki</option>
            <option value="2">non paroki</option>
            <option value="3">soe</option>
            <option value="4">andr</option>
            <option value="5">mik</option>
            <option value="6">raf</option>
        </select>
        

        


        <button class="w-100 btn btn-lg btn-primary" type="submit">register</button> 
        

    </form>      --}}

    <div class="container">
        <div class="alert alert-success" style="display:none"></div>
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
            

            <button class="w-100 btn btn-lg btn-primary" data-bs-toggle="collapse" href="#collapseExample" id="ajaxSubmit">register</button> 
            

        </form>   

        
        <p>
            <a class="btn btn-primary mt-4" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Link with href
            </a>
            <button class="btn btn-primary mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Button with data-bs-target
            </button>
        </p>
        <div class="collapse panel-collapse" id="collapseExample">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th >nama</th>
                        <th >nik</th>
                        <th >kk</th>
                    </tr>
                </thead>                
            </table>
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
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               jQuery.ajax({
                    url: "{{ url('/ ') }}",
                    method: 'post',
                    data: {
                        nama: jQuery('#nama').val(),
                        nik: jQuery('#nik').val(),
                        lingkungan: jQuery('#lingkungan').val()
                    },
                    success: function(result){
                        // jQuery('.alert').show();
                        // jQuery('.alert').html(result.success);
                        //debugger;
                        console.log(result.success);
                        $(".removable").remove();

                        for (let i=0; i<3; i++) {
                            console.log('aaa');
                            let row = $('<tr><td class="removable">' + result.success[i].nama + '</td><td class="removable">' + result.success[i].nik  + 
                            '</td><td class="removable">' + result.success[i].kk + '</td></tr>');
                            $('#table').append(row);
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
        
    // $(document).ready(function() {
    //     $.getJSON('result.JSON', function(data) {
    //         var output = '';
    //         $.each(data.success, function(key, value) {
    //             output += '<li>' + value.name + '</li>';
    //         });
    //         $('#example').html(output); // <ul id="example"></ul>
    //     });
    // });

    </script>

    












@endsection