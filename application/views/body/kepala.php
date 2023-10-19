<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Imfusan</title>
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/asset/css/bootstrap.min.css">
    <script src="<?= base_url('assets'); ?>/asset/js/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/asset/js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //interval waktu realtime
            setInterval(function() {
                $("#cek_suhu").load("<?= site_url('auth/suhu'); ?>")
                $("#berat").load("<?= site_url('auth/loadcell'); ?>")
                $("#pasang").load("<?= site_url('auth/tombol'); ?>")
                $("#ml").load("<?= site_url('auth/ml'); ?>")
                $("#jenis").load("<?= site_url('auth/jenis'); ?>")
            }, 1000); //delay
        });
    </script>

</head>

<body style="background-color: #FDF5E6;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #CFEFCF;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('auth'); ?>">The Elektro Empire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('auth/tambah_pasien'); ?>">Tambah Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/data_pasien'); ?>">Data pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>