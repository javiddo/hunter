<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Post add</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-5">

            <h2>Edit Post</h2>

            <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-warning">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;?>
            <form action="<?php echo base_url(); ?>/PostController/update" method="post">
                <div class="form-group mb-3">
                    <input type="hidden" name="id" placeholder="Title" value="<?=$id ?>" class="form-control" >
                    <input type="text" name="title" placeholder="Title" value="<?=$title ?>" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="description" placeholder="Description" value="<?=$description ?>" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="content" placeholder="Content" value="<?=$content ?>" class="form-control" >
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>