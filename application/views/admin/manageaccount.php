<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ini admin</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Account</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active ?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active ?</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($account->result_array() as $i) :
                            $no = $no;
                            $no++;
                            $id = $i['id'];
                            $name = $i['name'];
                            $email = $i['email'];
                            $role = $i['role_id'];
                            $active = $i['is_active'];
                            ?>
                        <tr>
                            <td><?php echo $no; ?> </td>
                            <td><?php echo $name; ?> </td>
                            <td><?php echo $email; ?> </td>
                            <td><?php
                                if ($role == 2) {
                                    echo "Member";
                                } else {
                                    echo "Administrator";
                                }
                                ?> </td>
                            <td><?php
                                if ($active == 1) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                }
                                ?> </td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#accountmodal<?= "$id"; ?>"> Update </a>
                                <a href="" class=" badge badge-danger" data-toggle="modal" data-target="#deletemodal<?= "$id"; ?>"> Delete </a>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<?php
foreach ($account->result_array() as $i) :
    $no = $no;
    $no++;
    $id = $i['id'];
    $name = $i['name'];
    $email = $i['email'];
    $role = $i['role_id'];
    $active = $i['is_active'];
    ?>
<div class="modal fade" id="accountmodal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('') . "admin/updateaccount/" . $id; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="<?= $name ?>">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="role" <?php
                                                                                    if ($role == 1) {
                                                                                        echo "checked='true'";
                                                                                    } ?>>
                        <label class="form-check-label" for="role">Administrator?</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" <?php
                                                                                        if ($active == 1) {
                                                                                            echo "checked='true'";
                                                                                        } ?>>
                        <label class="form-check-label" for="is_active">Active?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php
foreach ($account->result_array() as $i) :
    $no = $no;
    $no++;
    $id = $i['id'];
    $name = $i['name'];
    $email = $i['email'];
    $role = $i['role_id'];
    $active = $i['is_active'];
    ?>
<div class="modal fade" id="deletemodal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Delete account</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('') . "admin/deleteaccount/" . $id; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?> 