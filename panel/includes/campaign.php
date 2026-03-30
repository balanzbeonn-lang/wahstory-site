<?php
$compaign = $postObj->getCompaign();
?>

<form method="POST" action="actions/compaign.php" enctype="multipart/form-data">
    <div class="card-header">
        <h4><?php if ($compaign) {
                echo "Update";
            } else {
                echo "Enter";
            } ?> Compaign Details</h4>
    </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
                <input name="title" value="<?php echo $compaign["title"] ?>" type="text" class="form-control" required>
            </div>
        </div>
       
       

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 1</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="content1" class="summernote"><?php if ($compaign) { echo $compaign['content1']; } ?></textarea>
            </div>
    </div>

    <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content 2</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="content2" class="summernote"><?php if ($compaign) { echo $compaign['content2']; } ?></textarea>
            </div>
    </div>
        

        <?php if ($compaign) { ?>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Compaign Image:</label>
                <div class="col-sm-12 col-md-7">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        <div class="col-md-8">
                            <a href="../images/posts/<?php echo $compaign["img"] ?>" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="../images/posts/<?php echo $compaign["img"] ?>" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($compaign) {
                                                                                        echo "Change Image:";
                                                                                    } else {
                                                                                        echo "Thumbnail";
                                                                                    } ?></label>
                                                                                    

            <div class="col-sm-12 col-md-7">
                <div id="image-preview-2" class="image-preview">
                    <label for="image-upload-2" id="image-label-2">Choose File</label>
                    <input type="file" accept="image/*" name="image" id="image-upload-2" <?php if ($compaign) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "required";
                                                                                        } ?> />
                </div>
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <input type="submit" class="btn btn-primary" value="<?php if ($compaign) {
                                                                        echo "Update";
                                                                    } else {
                                                                        echo "Publish";
                                                                    } ?>"></input>

            </div>
        </div>
</form>