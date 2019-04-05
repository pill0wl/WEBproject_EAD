<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ini admin</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Project</h6>
            <br>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ttitle</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ttitle</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($project->result_array() as $i) :

                            $no = $no;
                            $no++;
                            $judul = $i['judul'];
                            $desc = $i['deskripsi'];
                            $author = $i['author'];
                            $date = $i['date_created'];
                            $id = $i['id'];
                            ?>

                        <tr>

                            <td><?php echo $no; ?> </td>

                            <td><?php
                                if (strlen($judul) >= 20) {
                                    echo substr($judul, 0, 20) . "...";
                                } else {
                                    echo $judul;
                                }


                                ?> </td>

                            <td><?php
                                if (strlen($desc) >= 20) {
                                    echo substr($desc, 0, 20) . " ...";
                                } else {
                                    echo $desc;
                                } ?> </td>

                            <td><?php echo $author; ?> </td>
                            <td><?php echo $date; ?> </td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#projectmodal<?= "$id"; ?>"> Update </a>
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
foreach ($project->result_array() as $i) :
    $no = $no;
    $no++;
    $id = $i['id'];
    $title = $i['judul'];
    $desc = $i['deskripsi'];
    $author = $i['author'];
    $img = $i['img'];
    ?>
<div class="modal fade" id="projectmodal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/updateproject/' . $id); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Project Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Projec title" value="<?= $title ?>">
                </div>
                <div class="form-group">
                    <label for="name">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Author" value="<?= $author ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="5"><?= $desc ?></textarea>
                </div>
                <div class="form-group">
                    <label for="desc">Picture</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 col-lg-8">
                                    <img src="<?= base_url('assets/img/project/') . $img ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" id="img" name="img" class="custom-file-input">
                                        <label class="custom-file-label" for="img"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_acc" name="is_acc" <?php $result = $this->db->get_where('project', ['id' => $id])->row_array();
                                                                                                if ($result) {
                                                                                                    echo "checked='checked'";
                                                                                                } ?>>
                    <label class="form-check-label" for="role">Active?</label>
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
foreach ($project->result_array() as $i) :
    $no = $no;
    $no++;
    $id = $i['id'];
    $title = $i['judul'];
    $desc = $i['deskripsi'];
    $author = $i['author'];
    $img = $i['img'];
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
            <div class="modal-body">Delete project?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('') . "admin/deleteproject/" . $id; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php endforeach;   ?> 