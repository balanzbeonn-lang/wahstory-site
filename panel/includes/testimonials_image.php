<?php
$data = $postObj->getExtras("testimonial_home_banner");
?>

<div class="row p-5">
    <?php if ($data) : ?>
        <div class="col-md-6">
            <img width="100%" src="../images/extras/<?php echo $data["img"]; ?>">
        </div>
    <?php endif; ?>
    <div class="col-md-6">
        <form method="POST" action="actions/<?php if ($data) echo "update_home_testimonial_banner";
                                            else echo "add_home_testimonial_banner"; ?>" enctype="multipart/form-data">
            <div class="col-sm-12 col-md-7">
                <div id="image-preview-5" class="image-preview">
                    <label for="image-upload-5" id="image-label-5">Choose File</label>
                    <input type="file" accept="image/*" name="image" id="image-upload-4" required />
                    <input name="id" hidden value="<?php if ($data) {
                                                        echo $data["id"];
                                                    } ?>">
                </div>
            </div>
            <input type="submit" class="btn btn-primary mt-5">
        </form>
    </div>
</div>