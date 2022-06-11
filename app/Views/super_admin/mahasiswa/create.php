<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Create - Bank Sampah
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create CV</h1>
<div class="card mb-4">
    <div class="card-header">
        Create
    </div>
    <div class="card-body">
        <form action="<?= base_url('super_admin/mahasiswa/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Profile content row-->
            <div class="row gx-5">
                <div class="col-xl-4">
                    <!-- CV picture card-->
                    <div class="card card-raised mb-5 border-left-primary">
                        <div class="card-body p-5">
                            <div class="card-title">
                                <center><label for="image"><b>CV Image </b></label></center>
                            </div>
                            <!-- Profile picture image-->
                            <center><img class="img-fluid rounded-circle mb-1" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDGQO5-8CPA9Hzl5_wLkAf6VtlMw52q7IwRw&usqp=CAU" alt="..." style="max-width: 150px; max-height: 150px" /></center>
                            <!-- Profile picture help block-->
                            <center>
                                <div class="caption fst-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            </center>
                            <div class="custom-file">
                                <input type="file" class="form-control" value="" id="image" name="image" required="required">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- CV Form-->
                    <div class="card card-raised mb-5 border-bottom-primary">
                        <div class="card-body p-3">
                            <div class="card-title"><b>Form Details</b></div>
                            <div class="card-subtitle mb-4">Fill in the data correctly.</div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="nama" name="nama" class="form-control" id="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="profesi">Profesi Kerja</label>
                                        <input type="text" name="profesi" class="form-control" id="profesi">
                                    </div>
                                    <div class="col">
                                        <label for="telephone">No. Telephone</label>
                                        <input type="text" name="telephone" class="form-control" id="telephone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aboutme">About Me</label>
                                    <textarea type="text" name="aboutme" class="form-control" id="aboutme" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="namasekolah">Asal Universitas/Sekolah</label>
                                    <input type="text" name="namasekolah" class="form-control" id="namasekolah" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="pendidikan">Pendidikan</label>
                                        <input type="text" name="pendidikan" class="form-control" id="pendidikan">
                                    </div>
                                    <div class="col">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control" id="jurusan">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pengalaman">Pengalaman Kerja</label>
                                    <input type="text" name="pengalaman" class="form-control" id="pengalaman" required>
                                </div>
                                <div class="form-group">
                                    <label for="Jabatan">Jabatan</label>
                                    <input type="text" name="Jabatan" class="form-control" id="Jabatan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>