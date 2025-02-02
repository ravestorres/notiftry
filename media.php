<?php
  $page_title = 'All Image';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all('media'); ?>
<?php
  if(isset($_POST['submit'])) {
    $photo = new Media();
    $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','photo has been uploaded.');
        redirect('media.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('media.php');
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
          <?php echo display_msg($msg); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><span class="bi bi-camera"></span> All Photos</h5>
                    <form class="d-flex" action="media.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" name="file_upload" multiple="multiple" class="form-control" />
                            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Photo Name</th>
                                <th class="text-center" style="width: 20%;">Photo Type</th>
                                <th class="text-center" style="width: 50px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($media_files as $media_file): ?>
                                <tr>
                                    <td class="text-center"><?php echo count_id(); ?></td>
                                    <td class="text-center">
                                        <img src="uploads/products/<?php echo $media_file['file_name']; ?>" class="img-thumbnail" />
                                    </td>
                                    <td class="text-center"><?php echo $media_file['file_name']; ?></td>
                                    <td class="text-center"><?php echo $media_file['file_type']; ?></td>
                                    <td class="text-center">
                                        <a href="delete_media.php?id=<?php echo (int) $media_file['id']; ?>" class="btn btn-danger btn-sm" title="Delete">
                                            <span class="bi bi-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
