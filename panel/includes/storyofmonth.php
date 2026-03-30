<?php
$post = $postObj->getStoryofMonth();
?>
<form method="POST" action="actions/storyofmonth.php" enctype="multipart/form-data">
    <div class="card-header">
        <h4><?php if ($post) {
                echo "Update";
            } else {
                echo "Enter";
            } ?> Story Of The Month</h4>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
        <div class="col-sm-12 col-md-7">
            <input name="title" type="text" class="form-control" value="<?php if ($post) {echo $post['title'];} ?>" required>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Author</label>
        <div class="col-sm-12 col-md-7">
            <input name="author" type="text" class="form-control" value="<?php if ($post) {echo $post['author'];}?>" required>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Short Description</label>
        <div class="col-sm-12 col-md-7">
            <input name="description" type="text" class="form-control" value="<?php if ($post) {echo $post['description'];} ?>" required>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quote</label>
        <div class="col-sm-12 col-md-7">
            <input name="quote" type="text" class="form-control" value='<?php if($post){ echo $post['quote'];}?>' required>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
        <div class="col-sm-12 col-md-7">
            <textarea name="content" class="summernote" required><?php if ($post) { echo $post['content'];} ?></textarea>
        </div>
    </div>
    <?php if ($post["img"]) { ?>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Image:</label>
            <div class="col-sm-12 col-md-7">
                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                    <div class="col-md-8">
                        <a href="../images/posts/<?php echo $post["img"] ?>" data-sub-html="Demo Description">
                            <img class="img-responsive thumbnail" src="../images/posts/<?php echo $post["img"] ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post) {
                                                                                    echo "Change Image:";
                                                                                } else {
                                                                                    echo "Thumbnail";
                                                                                } ?></label>

        <div class="col-sm-12 col-md-7">
            <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" accept="image/*" name="image" id="image-upload" <?php if (!$post) {
                                                                                        echo "required";
                                                                                    } ?> />

            </div>
        </div>
    </div>
    <?php if ($post["video"]) { ?>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Video :</label>
            <div class="col-sm-12 col-md-7">
                <video width="400" controls>
                    <source src="videos/<?php echo $post["video"] ?>" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
        </div>
    <?php } ?>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post["video"]) {
                                                                                    echo "Change";
                                                                                } else {
                                                                                    echo "Post";
                                                                                } ?> Video</label>

        <div class="custom-file col-sm-12 col-md-7">
            <input name="video" accept="video/*" type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
    <?php if ($post["audio"]) { ?>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Post Audio :</label>
            <div class="col-sm-12 col-md-7">
                <audio controls>
                    <source src="audios/<?php echo $post["audio"] ?>">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    <?php } ?>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><?php if ($post["audio"]) {
                                                                                    echo "Change";
                                                                                } else {
                                                                                    echo "Post";
                                                                                } ?> Audio</label>

        <div class="custom-file col-sm-12 col-md-7">
            <input name="audio" accept="audio/*" type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
        <div class="col-sm-12 col-md-7">
            <input type="submit" class="btn btn-primary" value="<?php if ($post) {
                                                                    echo "Update";
                                                                } else {
                                                                    echo "Publish";
                                                                } ?>"></input>

        </div>
    </div>
</form>