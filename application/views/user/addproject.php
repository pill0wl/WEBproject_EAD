<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow">

        <?= $this->session->flashdata('message'); ?>

        <?= form_open_multipart('user/addproject/'); ?>

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

        </form>
    </div>

</div>