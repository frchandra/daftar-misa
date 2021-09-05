<!-- Project details-->
<div class="pendaftaran-lama">
    <h2 class="text-uppercase">Project Name</h2>
    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
    <div style="visibility:hidden; color:red; " id="chk_option_error">
        tolong lengkapi input.
    </div>   


    <form id="daftar" class="form-utama" action="/daftar"  method="post">      
        @csrf           


        <ul class="list-group"></ul>    
        
        <hr>       

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

        <input type="submit" name="Submit" class="btn btn-primary btn-xl text-uppercase" value="simpan perubahan">

        {{-- <button class="btn btn-primary btn-xl text-uppercase" type="submit">
            simpan perubahan
        </button> --}}

    </form> 
</div>

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
