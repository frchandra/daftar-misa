@extends('layouts.main')

@section('container')
    <h1>Home</h1>

    <h2>{{ $header }}</h2>

    @if (session()->has('success'))
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
            
            {{-- @error('galat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror --}}
            
        </div>

        <div class="form-floating">
            <input type="text" name="nik" class="form-control @error('galat') is-invalid @enderror" id="nik" placeholder="nik" required>
            <label for="nik">nik</label>

            {{-- @error('galat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror --}}
        </div>
        

        <button class="w-100 btn btn-lg btn-primary" type="submit">register</button>      

    </form>








@endsection