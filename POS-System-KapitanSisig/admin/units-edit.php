<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Unit
                <a href="units.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <?php
                    if (isset($_GET['id'])) {
                        $unitId = $_GET['id'];
                        $unitData = getById('units', $unitId); // Fetch unit data by ID
                        if ($unitData['status'] == 200) {
                            ?>
                            <input type="hidden" name="unitId" value="<?= $unitData['data']['id']; ?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="">Unit Name</label>
                                    <input type="text" name="unitName" required value="<?= $unitData['data']['name']; ?>" class="form-control" />
                                </div>
                                <div class="col-md-12 mb-3 text-end">
                                    <button type="submit" name="updateUnit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo '<h5>' . $unitData['message'] . '</h5>';
                        }
                    } else {
                        echo '<h5>No ID provided</h5>';
                    }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
