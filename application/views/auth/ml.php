<table class="table">
    <thead class="text-center" style="background-color: black; color:white;">
        <tr>
            <th scope="col">Hari</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Waktu Pemasangan</th>
            <th scope="col">Waktu Ganti</th>
            <th scope="col">Suhu Rata-rata</th>
            <th scope="col">Status Infusan</th>
            <th scope="col">Jenis Iinfusan</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php foreach ($date_loadcel as $date) : ?>
            <tr>
                <th scope="row"><?= date("D", $date['day']) ?></th>
                <td><?= date("d-F-Y", $date['date']) ?></td>
                <td><?= $date['jp'] ?></td>
                <td><?= $date['jh'] ?></td>
                <td><?= $date['sr']; ?>°C</td>
                <td><?= $date['m_lodacel']; ?></td>
                <td><?php if ($date['jenis'] == 1) {
                        echo "NHCL";
                    } elseif ($date['jenis']  == 2) {
                        echo "RINGGER'S LACTATE";
                    } elseif ($date['jenis']  == 3) {
                        echo "DEXTROSE 5% (D5W)";
                    } else {
                        echo "Jenis tidak terdaftar";
                    } ?></td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>