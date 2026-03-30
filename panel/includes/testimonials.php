<div class="table-responsive">
    <?php
    $testimonials = $postObj->getAllTestimonials();
    if ($testimonials) {
        $i = 1;
    ?>
        <table class="table table-striped" id="table-6">
            <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Msg</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                foreach ($testimonials as $testimonial) {
                    $user = $postObj->getUserDetailsById($testimonial["userId"]);
                ?>
                    <tr>
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?php echo $testimonial["userId"] ?></td>
                        <td><?php echo $user["firstname"] . " " . $user["lastname"] ?></td>
                        <td><?php echo $testimonial["title"] ?></td>
                        <td><?php echo $testimonial["msg"] ?></td>
                        <td>
                            <img src="../images/testimonials/<?php echo $testimonial['img'] ?>" width="45">
                        </td>
                        <td><?php echo $testimonial["date"] ?></td>
                        <td>
                            <div class="badge badge-<?php if ($testimonial["status"] == "verified") {
                                                        echo "success";
                                                    } elseif ($testimonial["status"] == "un-verified") {
                                                        echo "warning";
                                                    } ?> badge-shadow"><?php if ($testimonial["status"] == "verified") {
                                                                            echo "Verified";
                                                                        } elseif ($testimonial["status"] == "un-verified") {
                                                                            echo "Un-Verified";
                                                                        } ?></div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon text-info" data-toggle="modal" data-target="#testimonialEdit<?php echo $id; ?>"><i class="fas fa-edit"></i>Edit</a>
                                    <?php if ($testimonial["status"] == "verified") { ?>
                                        <a onclick="unVerify(<?php echo $testimonial['id'] ?>)" class="dropdown-item has-icon text-danger" style="cursor: pointer"><i class="fas fa-ban"></i>Un-Verify</a>
                                    <?php } elseif ($testimonial["status"] == "un-verified") { ?>
                                        <a onclick="verify(<?php echo $testimonial['id'] ?>)" class="dropdown-item has-icon text-success" style="cursor: pointer"><i class="fas fa-rocket"></i>Verify</a>
                                    <?php } ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item has-icon" data-toggle="modal" data-target="#testimonialView<?php echo $id; ?>"><i class="fas fa-eye"></i> View</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php $id++;
                } ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<h1>No Posts</h1>";
    }
    ?>
</div>
<script>
    function unVerify(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Un-Verify it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/unverifyTestimonial.php?id=" + id;
            }
        })
    }

    function verify(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Verify it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "actions/verifyTestimonial.php?id=" + id;
            }
        })
    }
</script>

<?php if ($testimonials) {
    $id = 1;
    $tid = 1;
    foreach ($testimonials as $testimonial) {
?>
        <div class="modal fade bd-example-modal-lg" id="testimonialEdit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Edit Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="actions/update_testimonial" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="title" value="<?php echo $testimonial["title"] ?>" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Message</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="msg" class="form-control" required><?php echo $testimonial["msg"] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>

                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview-t-<?php echo $tid; ?>" class="image-preview">
                                            <label for="image-upload-t-<?php echo $tid; ?>" id="image-label-t-<?php echo $tid; ?>">Choose File</label>
                                            <input type="file" accept="image/*" name="image" id="image-upload-t-<?php echo $tid; ?>" />
                                        </div>
                                    </div>

                                </div>
                                <input type="text" value="<?php echo $testimonial['id']; ?>" hidden name="id">
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

        <div class="modal fade bd-example-modal-lg" id="testimonialView<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">View Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                <div class="col-sm-12 col-md-7">
                                    <input value="<?php echo $testimonial["title"] ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Message</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea rows="5" disabled class="form-control"><?php echo $testimonial["msg"] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnial</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                        <div class="col-md-12">
                                            <a href="../images/testimonials/<?php echo $testimonial["img"] ?>" data-sub-html="Demo Description">
                                                <img class="img-responsive thumbnail" src="../images/testimonials/<?php echo $testimonial["img"] ?>" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        $id++;
        $tid++;
    }
}
?>