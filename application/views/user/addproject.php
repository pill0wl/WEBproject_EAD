<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow">
        <div class="modal-body">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('user/addproject/'); ?>
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Projec title">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="desc">Picture</label>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 col-lg-8">
                                <img src="" class="img-thumbnail">
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
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Add</button>
            </div>
            </form>
        </div>
    </div>

</div>