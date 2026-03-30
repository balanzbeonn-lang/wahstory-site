<?php
$campaigns = $postObj->getCompanyCampaigns();
?>
<form method="POST" action="actions/add_company_compaign.php" enctype="multipart/form-data">
    <div class="card-header">
        <h4>Enter Compaign Details</h4>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
        <div class="col-sm-12 col-md-7">
            <input name="title" type="text" class="form-control" required>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 1 :</label>
        <div class="col-sm-12 col-md-7">
            <textarea name="content1" class="summernote" required>
            </textarea>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>
        <div class="col-sm-12 col-md-7">
            <input name="quote" type="text" class="form-control">
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 2 :</label>
        <div class="col-sm-12 col-md-7">
            <textarea name="content2" class="summernote" required>
            </textarea>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Background Image</label>


        <div class="col-sm-12 col-md-7">
            <div id="image-preview-3" class="image-preview">
                <label for="image-upload-3" id="image-label-3">Choose File</label>
                <input type="file" accept="image/*" name="image" id="image-upload-3" required />
            </div>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
        <div class="col-sm-12 col-md-7">
            <input type="submit" class="btn btn-primary"></input>
        </div>
    </div>
</form>

<div class="row">
    <?php if ($campaigns) {
        $id = 1;
        foreach ($campaigns as $campaign) {
    ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <input disabled value="<?php echo $campaign["title"] ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Campaign Image:</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    <div class="col-md-8">
                                        <a href="../images/company_campaigns/<?php echo $campaign["img"] ?>" data-sub-html="Demo Description">
                                            <img class="img-responsive thumbnail" src="../images/company_campaigns/<?php echo $campaign["img"] ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $id; ?>">Update</button>
                                <a style="cursor: pointer;color:white" onclick="delCompanyCampaign(<?php echo $campaign['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
            $id++;
        }
    } ?>
</div>
<script>
    function delCompanyCampaign(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/delCompanyCampaign.php?id=" + id;
            }
        })
    }
</script>
<?php if ($campaigns) {
    $id = 1;
    $ccid = 1;
    foreach ($campaigns as $campaign) {
?>
        <div class="modal fade bd-example-modal-lg" id="modal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Update Company Campaign</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="actions/update_company_campaign" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="title" value="<?php echo $campaign["title"] ?>" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 1 :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content1" class="summernote" required><?php echo $campaign["content1"] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="quote" value="<?php echo $campaign["quote"] ?>" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 2 :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content2" class="summernote" required><?php echo $campaign["content2"] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>

                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview-cc-<?php echo $ccid; ?>" class="image-preview">
                                            <label for="image-upload-cc-<?php echo $ccid; ?>" id="image-label-cc-<?php echo $ccid; ?>">Choose File</label>
                                            <input type="file" accept="image/*" name="image" id="image-upload-cc-<?php echo $ccid; ?>" />
                                        </div>
                                    </div>

                                </div>
                                <input type="text" value="<?php echo $campaign['id']; ?>" hidden name="id">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="submit" class="btn btn-primary"></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
        $id++;
        $ccid++;
    }
}
?>