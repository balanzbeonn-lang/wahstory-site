<?php
$teams = $postObj->getTeam();
?>
<form method="POST" action="actions/add_team.php" enctype="multipart/form-data">
    <div class="card-header">
        <h4>Enter Team Member Details</h4>
    </div>
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">First Name</label>
        <div class="col-sm-12 col-md-7">
            <input name="firstname" type="text" class="form-control" required>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last Name</label>
        <div class="col-sm-12 col-md-7">
            <input name="lastname" type="text" class="form-control" required>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
        <div class="col-sm-12 col-md-7">
            <input name="position" type="text" class="form-control" required>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
        <div class="col-sm-12 col-md-7">
            <div id="image-preview-4" class="image-preview">
                <label for="image-upload-4" id="image-label-4">Choose File</label>
                <input type="file" accept="image/*" name="image" id="image-upload-4" required />
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
    <?php if ($teams) {
        $id = 1;
        foreach ($teams as $team) {
    ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">First Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input disabled value="<?php echo $team["firstname"] ?>" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input disabled value="<?php echo $team["lastname"] ?>" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
                            <div class="col-sm-12 col-md-7">
                                <input disabled value="<?php echo $team["position"] ?>" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnial</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    <div class="col-md-8">
                                        <a href="../images/team/<?php echo $team["img"] ?>" data-sub-html="Demo Description">
                                            <img class="img-responsive thumbnail" src="../images/team/<?php echo $team["img"] ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#teamModalEdit<?php echo $id; ?>">Update</button>
                                <a style="cursor: pointer;color:white" onclick="delTeam(<?php echo $team['id'] ?>)" class="btn btn-danger ml-3">Delete</a>
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
    function delTeam(id) {
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
                window.location.href = "actions/delTeam.php?id=" + id;
            }
        })
    }
</script>
<?php if ($teams) {
    $id = 1;
    $ccid = 1;
    foreach ($teams as $team) {
?>
        <div class="modal fade bd-example-modal-lg" id="teamModalEdit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Update Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="actions/update_team" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">First Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="firstname" value="<?php echo $team["firstname"] ?>" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Last Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="lastname" value="<?php echo $team["lastname"] ?>" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="position" value="<?php echo $team["position"] ?>" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>

                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview-team-<?php echo $ccid; ?>" class="image-preview">
                                            <label for="image-upload-team-<?php echo $ccid; ?>" id="image-label-team-<?php echo $ccid; ?>">Choose File</label>
                                            <input type="file" accept="image/*" name="image" id="image-upload-team-<?php echo $ccid; ?>" />
                                        </div>
                                    </div>

                                </div>
                                <input type="text" value="<?php echo $team['id']; ?>" hidden name="id">
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