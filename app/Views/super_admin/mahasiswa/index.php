<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Mahasaiswa - Bank Sampah
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

<!-- Message Alert -->
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <a href="<?= base_url('super_admin/mahasiswa/create') ?>" class="btn btn-primary mb-4">
            <i class="fas fa-fw fa-plus"></i>
            Create CV
        </a>
        <a href="<?= base_url('super_admin/mahasiswa/exportpdf') ?>" class="btn btn-danger mb-4">
            <i class="fas fa-fw fa-file-pdf"></i>
            Export PDF
        </a>
        <a href="<?= base_url('super_admin/mahasiswa/exportexcel') ?>" class="btn btn-success mb-4">
            <i class="fas fa-fw fa-file-excel"></i>
            Export Excel
        </a>

        <main class="container">
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $d) : ?>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary"><?= $d['nama']; ?></strong>
                                <h3 class="mb-0"><b>About Me</b></h3>
                                <p class="card-text mb-auto"><?= $d['aboutme']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editModal-<?= $d['id'] ?>">Edit</button>
                                        <div class="modal fade" id="editModal-<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Curriculum Vitae</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('/super_admin/mahasiswa/update/') ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="image" class="col-sm-4 control-label">Change Photo</label>
                                                                <input type="file" class="form-control" value="" id="image" name="image" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Nama Lengkap</label>
                                                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $d['nama'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="profesi">Profesi</label>
                                                                <input type="text" name="profesi" class="form-control" id="profesi" value="<?= $d['profesi'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat">Alamat</label>
                                                                <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $d['alamat'] ?>" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" name="email" class="form-control" id="email" value="<?= $d['email'] ?>" required>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="telephone">Telephone</label>
                                                                    <input type="text" name="telephone" class="form-control" id="telephone" value="<?= $d['telephone'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="aboutme">About Me</label>
                                                                <textarea type="text" name="aboutme" class="form-control" id="aboutme" value="<?= $d['aboutme'] ?>" rows="3"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="namasekolah">Asal Universitas/Sekolah</label>
                                                                <input type="text" name="namasekolah" class="form-control" id="namasekolah" value="<?= $d['namasekolah'] ?>" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="pendidikan">Pendidikan</label>
                                                                    <input type="text" name="pendidikan" class="form-control" id="pendidikan" value="<?= $d['pendidikan'] ?>" required>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="jurusan">Jurusan</label>
                                                                    <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?= $d['jurusan'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pengalaman">Pengalaman Kerja</label>
                                                                <input type="text" name="pengalaman" class="form-control" id="pengalaman" value="<?= $d['pengalaman'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Jabatan">Jabatan</label>
                                                                <input type="text" name="Jabatan" class="form-control" id="Jabatan" value="<?= $d['Jabatan'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('/super_admin/mahasiswa/delete/') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure ?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto d-none d-lg-block">
                                <img class="card-img-top" src="<?= base_url('uploads/images/' . $d['photo']) ?>" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
</div>


<?= $this->endSection(); ?>