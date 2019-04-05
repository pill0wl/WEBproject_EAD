<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ini admin</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
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
                            <th>Accepted?</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ttitle</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th>Accepted?</th>
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
                                <div class="form-check text-center">
                                    <input class="form-check-input changeacc" type="checkbox" <?php $this->db->where('id', '$id');
                                                                                                $result = $this->db->get('project');
                                                                                                if ($result->num_rows > 0) {
                                                                                                    echo "checked='checked'";
                                                                                                } ?> data-id="<?= $id; ?>">
                                </div>
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
<!-- End of Main Content -- >                        