<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Upload Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Pengguna</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <?php if (isset($msg) || validation_errors() !== '') : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
                        <?= validation_errors(); ?>
                        <?= isset($msg) ? $msg : ''; ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="col-md-12">
                <div class="card">

                    <?php

                    if (isset($_POST['submit'])) {

                        // Buat sebuah tag form untuk proses import data ke database
                        echo form_open_multipart(base_url('admin/users/import/' . $file_excel), 'class="form-horizontal"');
                    ?>

                        <div class="card-header py-3">
                            <i style="color:red" class="fa fa-exclamation-triangle"></i><strong> Periksa kembali dengan
                                seksama</strong>
                        </div>

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Prodi</th>
                                    </tr>
                                    <thead>
                                    <tbody>
                                        <?php
                                        $numrow = 1;
                                        foreach ($sheet as $row) {
                                            // Ambil data pada excel sesuai Kolom
                                            if ($numrow > 1) {

                                                echo "<tr>";
                                                echo "<td>" . $row['A'] . "</td>";
                                                echo "<td>" . $row['B'] . "</td>";
                                                echo "<td>" . $row['C'] . "</td>";
                                                echo "<td>" . $row['D'] . "</td>";                                               
                                                echo "</tr>";
                                            }
                                            $numrow++; // Tambah 1 setiap kali looping
                                        }

                                        ?>
                                <tbody>
                            </table>

                            <hr>

                            <button class='btn btn-success' type='submit' name='import'>Import</button>
                            <a class="btn btn-warning" href="<?= base_url("admin/users/upload"); ?>">Cancel</a>

                            <?php echo form_close(); ?>
                        </div>

                    <?php } else {

                        echo form_open_multipart(base_url('admin/users/upload'), 'class="form-horizontal"') ?>

                        <div class="card-header py-3">
                            <i class="fa fa-exclamation-triangle"></i><strong> Panduan Upload
                                Pengguna</strong>
                        </div>

                        <div class="card-body">
                            <ol class="panduan-pengisian">
                                <li>Ekstensi File yang didukung hanya .xlsx</li>
                                <li>Data yang diupload harus mengikuti template yang sudah disediakan. <a href="<?= base_url('public/template/import_users.xlsx'); ?>" class="btn btn-perak btn-sm"><i class="fas fa-file-excel"></i> Unduh Template
                                        Excel</a></li>
                            </ol>
                            <div class="form-group">
                                <input type="file" name="file" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-warning pull-right">
                            </div>
                        </div>

                    <?php echo form_close();
                    }
                    ?>

                </div>

            </div>
        </div>

    </div>
    </div>
</section>

<script>
    $("#pengguna").addClass('menu-open');
    $("#pengguna .upload_pengguna a.nav-link").addClass('active');
</script>