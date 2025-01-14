<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admins/Staff
                <a href="admins-create.php" class="btn btn-primary float-end">Add Admin</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?>

        <?php 
            $adminsResult = getAll('admins');
            if(!$adminsResult){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            
            if(mysqli_num_rows($adminsResult) > 0)
            {
            ?>    
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php while($adminItem = mysqli_fetch_assoc($adminsResult)) : ?>
                        <tr>
                            <td><?= $adminItem['id'] ?></td>
                            <td><?= $adminItem['name'] ?></td>
                            <td><?= $adminItem['email'] ?></td>
                            <td>
                                <a href="admins-edit.php?id=<?= $adminItem['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="admins-delete.php?id=<?= $adminItem['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
            <?php 
                } else {
                    ?>
                        <h4 class="mb-0">No record found.</h4>
                <?php
                } 
                ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>