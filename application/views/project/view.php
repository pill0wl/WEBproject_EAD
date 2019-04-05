<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow">

        <?= $this->session->flashdata('message'); ?>
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary text-center"><?= $project['judul']; ?></h6>
        </div>
        <div class="card-body">
            <h4 class="">Project description :</h4>
            <h5 class=""><?= $project['deskripsi']; ?></h5>
            <div class="form-group text-center">
                <label for="desc">Picture</label>
                <div class="row">
                    <div class="col-sm-12">
                        <img src="<?= base_url('assets/img/project/') . $project['img']; ?>" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <?php
                                                                        if (!$joined) {
                                                                            echo '<a href="#" data-toggle="modal" data-target="#joinmodal" class="btn btn-primary">JOIN</a>';
                                                                        } else {
                                                                            echo '<a href="#" data-toggle="modal" data-target="#unjoinmodal" class="btn btn-danger">Leave</a>';
                                                                        }

                                                                        ?>

            </div>
            <footer class="blockquote-footer">Author : <?= $project['author']; ?></footer>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<div class="modal fade" id="joinmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Join Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('project/joinproject/' . $project['id']); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Leader</label>
                    <input type="text" class="form-control" id="leader" name="leader" readonly value="<?= $user['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="desc">Team</label>
                    <textarea class="form-control" id="team" name="team" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Join</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="unjoinmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('project/leaveproject/' . $project['id']); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Leave the project ?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Leave</button>
            </div>
            </form>
        </div>
    </div>
</div>