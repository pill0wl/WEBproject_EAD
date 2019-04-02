<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ini admin</h1>
    <table class="table table-bordered table-striped" id="mydata">

        <thead>

            <tr>

                <td>No</td>

                <td>Title</td>

                <td>Description</td>

                <td>Author</td>
                <td>Date</td>

            </tr>

        </thead>

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

            </tr>

            <?php endforeach; ?>

        </tbody>

    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 