@extends('layouts.main')

@section('container') 

    <!-- Masthead-->
    <header class="masthead">
        <div class="container bg-danger pt-5 pb-5">

            @if ($response=='sukses')
            <div class="masthead-subheading">pendaftaran berhasil</div>

            @elseif($response=='gagal')
            <div class="masthead-subheading">pendaftaran gagal</div>
            <p>sdr. {{ $data[0]['nama'] }} telah terfadtar di:</p>            
            <table class="table table-light table-striped">
                <thead>
                  <tr>                    
                    <th scope="col">perayaan</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">jam</th>
                    <th scope="col">lingkungan</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($data as $dat)                        
                        <tr>                    
                            <td>{{ $dat['perayaan'] }}</td>
                            <td>{{ $dat['tanggal'] }}</td>
                            <td>{{ $dat['jam'] }}</td>
                            <td>{{ $dat['namaLingkungan'] }}</td>
                        </tr>
                    @endforeach 

                </tbody>
            </table>      
            @else
            <div class="masthead-subheading">pendaftaran error, nama sudah ada</div>
              
            @endif


            


           

            <a class="btn btn-primary btn-xl text-uppercase" href="./">Kembali</a>
        </div>
    </header>

@endsection