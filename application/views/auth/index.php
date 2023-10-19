<div class="container mt-3">
    <div class="row">
        <div class="card " style="width: 13%;height:13%">
            <img src="<?= base_url('assets'); ?>/img/depositphotos_528930538-stock-illustration-avatar-doctor-medical-icon.jpg" alt="">
        </div>
        <div class="data col-md-3">
            <h2>Pasien Fulan</h2>
            <h4>Ruang Melati </h4>
            <p>Riwayat Penyakit : Patah Hati</p>
            <h3>
                <div id="DisplayClock" class="clock" onload="showTime()"></div>
            </h3>
        </div>
        <div class="col-md-3">
            <h2>Suhu Ruangan</h2>
            <h2 class="text-center" id="cek_suhu">
                <svg style="color: rgb(255,0,0);" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-thermometer" viewBox="0 0 16 16">
                    <path d="M8 14a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                    <path d="M8 0a2.5 2.5 0 0 0-2.5 2.5v7.55a3.5 3.5 0 1 0 5 0V2.5A2.5 2.5 0 0 0 8 0zM6.5 2.5a1.5 1.5 0 1 1 3 0v7.987l.167.15a2.5 2.5 0 1 1-3.333 0l.166-.15V2.5z" />
                </svg>0°C
            </h2>
        </div>
        <div class="col-md-3">
            <h2>Detail Infusan</h2>
            <div class="progress" id="berat">
                0 </div>
            <div class="jenis mt-3" id="jenis">Jenis : HCL</div>
        </div>
    </div>

</div>

</div>
<div class="container" id="ml">
</div>
<div class="container" id="pasang"></div>