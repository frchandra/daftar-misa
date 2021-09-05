<div class="pendaftaran-baru">
    <form class="row g-3 form-pendaftaran" action="/daftar-baru" method="POST">
        @csrf
    
        <div class="form-floating">
            <input type="text" name="nama" class="form-control" id="nama" placeholder="nama lengkap" required>
            <label for="text">nama lengkap</label>
        </div> 
        
        <div class="form-floating">
            <input type="text" name="namaBabtis" class="form-control" id="namaBabtis" placeholder="nama babtis" required>
            <label for="text">nama babtis</label>
        </div> 
    
        <div class="form-floating">
            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" required>
            <label for="text">NIK</label>
        </div> 
        
        <div class="form-floating">
            <input type="text" name="kk" class="form-control" id="kk" placeholder="nomer KK" required>
            <label for="text">nomer KK</label>
        </div> 
    
        <div class="form-floating">
            <input type="text" name="hp" class="form-control" id="hp" placeholder="nomer telepon" required>
            <label for="text">nomer telepon</label>
        </div> 
    
        <label for="tgl">tanggal lahir : <input type="date" id="tgl" name="tgl" required></label>
    
        <label for="jenisKelamin">jenis kelamin : 
            <select name="jenisKelamin" id="jenisKelamin" required>
                <option value="laki-laki">laki-laki</option>
                <option value="perempuan">perempuan</option>
            </select>
        </label>
    
        <label for="vaksin">berapa kali vaksin?   
            <select name="vaksin" id="vaksin" required>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value=">2">>2</option>
            </select>
        </label>
    
        
      
    
        <div class="col-12">
          <div class="form-check">        
            <label class="form-check-label " for="invalidCheck2">
              Agree to terms and conditions
              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            </label>
          </div>
        </div>
    
        <div class="content">
            <div style="overflow-x:auto;">
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
        
        </div>
    
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    
    </form>

</div>
