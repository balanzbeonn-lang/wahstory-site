<?php
$videos = $postObj->getYoutubeVids();
?>

<form method="POST" action="actions/addVideo" enctype="multipart/form-data">
    <div class="card-header">
        <h4>Add Video</h4>
    </div>
    <div class="card-body">
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
                <input name="title" type="text" class="form-control" required>
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
            <div class="col-sm-12 col-md-7">
                <input name="src" value="https://www.youtube.com/embed/" type="text" class="form-control" required>
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <input type="submit" class="btn btn-primary" value="Submit"></input>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <?php if ($videos) {
        foreach ($videos as $video) {
    ?>
            <div class="col-md-6">
                <div class="card">
                    <form method="POST" action="actions/updateVideo" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                <div class="col-sm-12 col-md-7">
                                    <input name="title" value="<?php echo $video["title"] ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
                                <div class="col-sm-12 col-md-7">
                                    <input name="src" value="<?php echo $video["src"] ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                            <!-- <input type="text" value="<?php echo $video['id']; ?>" hidden name="id"> -->
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="submit" class="btn btn-primary" value="Update"></input>
                                    <a style="cursor: pointer;color:white" onclick="delVid(<?php echo $video['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    <?php
        }
    } ?>
</div>
<script>
    function delVid(id) {
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
                window.location.href = "actions/delVideo.php?delId=" + id;
            }
        })
    }
</script>