<?php include('includes/header.php'); ?>
<?php


$query = "SELECT * FROM ingredients";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4>Ingredients</h4>
            <a href="ingredients-add.php" class="btn btn-primary float-end">Add Ingredient</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['unit']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['sub_category']; ?></td>
                            <td>
                                <a href="ingredients-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="code.php?deleteIngredient&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
