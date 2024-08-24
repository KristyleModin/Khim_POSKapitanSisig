<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Units
                <a href="units-create.php" class="btn btn-primary float-end">Add Unit</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <?php 
                $unitsResult = getAll('units');
                if(!$unitsResult){
                    echo '<h4>Something Went Wrong!</h4>';
                    return false;
                }

                if(mysqli_num_rows($unitsResult) > 0)
                {
                ?>    
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($unitItem = mysqli_fetch_assoc($unitsResult)) : ?>
                            <tr>
                                <td><?= $unitItem['id'] ?></td>
                                <td><?= $unitItem['name'] ?></td>
                                <td>
                                    <a href="units-edit.php?id=<?= $unitItem['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="units-delete.php?id=<?= $unitItem['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
