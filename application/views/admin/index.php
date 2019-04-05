<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ini admin</h1>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <h6 class="m-0 font-weight-bold text-primary">List Project</h6>
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
                            <th>View</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ttitle</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th>View</th>
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

                            $id = $i['id'];
                            $author = $i['author'];
                            $date = $i['date_created'];

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
                                <td><a class="badge badge-primary" href="<?= base_url('project?id=') . "$id"; ?>"> View </a></td>

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