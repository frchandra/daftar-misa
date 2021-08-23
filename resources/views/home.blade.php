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

        <select class="form-select" name="lingkungan" required>            
            <option value="1">paroki</option>
            <option value="2">non paroki</option>
            <option value="3">soe</option>
            <option value="4">andr</option>
            <option value="5">mik</option>
            <option value="6">raf</option>
        </select>
        

        <button class="w-100 btn btn-lg btn-primary" type="submit">register</button>      

    </form>

    <p>
        <a class="btn btn-primary mt-4" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Link with href
        </a>
        <button class="btn btn-primary mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Button with data-bs-target
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
          Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div>











@endsection