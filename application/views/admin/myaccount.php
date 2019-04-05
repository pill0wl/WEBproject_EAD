<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
    <!-- DataTales Example -->
    <?php
    $id = $user['id'];
    $email = $user['email'];
    $img = $user['image'];
    $name = $user['name'];
    ?>
    <div class="card shadow mb-4">
        <div class="card-body">

            <?= $this->session->flashdata('message'); ?>
<<<<<<< HEAD
            <?= form_open_multipart('admin/updateprofile/'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly value="<?= $email ?>">
                </div>
                <div class="form-group">
                    <label for="title">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>">
                </div>
                <div class="form-group">
                    <label for="name">Old Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="name">New Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="name">Confirm New Password</label>
                    <input type="password" class="form-control" id="password3" name="password3" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="desc">Picture</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/profile/') . $img ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" id="img" name="img" class="custom-file-input">
                                        <label class="custom-file-label" for="img"></label>
=======
            <form action="<?= base_url('') . "admin/updateprofile/" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly value="<?= $email ?>">
                    </div>
                    <div class="form-group">
                        <label for="title">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Old Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="name">New Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm New Password</label>
                        <input type="password" class="form-control" id="password3" name="password3" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="desc">Picture</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= base_url('assets/img/profile/') . $img ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" id="img" name="img" class="custom-file-input">
                                            <label class="custom-file-label" for="img"></label>
                                        </div>
>>>>>>> d647304d7f5e1e0e7caea869f3de2195c8e727bc
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Update</button>
            </div>
=======

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
>>>>>>> d647304d7f5e1e0e7caea869f3de2195c8e727bc
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<<<<<<< HEAD
<!-- End of Main Content -->
=======
<!-- End of Main Content --> 
>>>>>>> d647304d7f5e1e0e7caea869f3de2195c8e727bc
