<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4>Edit Ingredient</h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['id'])) {
                $ingredientData = getById('ingredients', $_GET['id']);
                if ($ingredientData['status'] == 200) {
                    $ingredient = $ingredientData['data'];
            ?>
            <form action="code.php" method="POST">
                <input type="hidden" name="ingredientId" value="<?= $ingredient['id'] ?>">

                <div class="mb-3">
                    <label for="name">Ingredient Name</label>
                    <input type="text" name="name" value="<?= $ingredient['name'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" value="<?= $ingredient['quantity'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <input type="text" name="unit" value="<?= $ingredient['unit'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category">Category:</label>
                    <select id="category" name="category" class="form-control" required>
                        <option value="Main Ingredients" <?= $ingredient['category'] == 'Main Ingredients' ? 'selected' : '' ?>>Main Ingredients</option>
                        <option value="Commissary" <?= $ingredient['category'] == 'Commissary' ? 'selected' : '' ?>>Commissary</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sub_category">Sub Category:</label>
                    <select id="sub_category" name="sub_category" class="form-control" required>
                        <option value="" disabled>Select Sub Category</option>
                    </select>
                </div>
                <button type="submit" name="updateIngredient" class="btn btn-primary">Update Ingredient</button>
            </form>
            <?php
                } else {
                    echo '<h4>No Ingredient Found.</h4>';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var category = document.getElementById('category').value;
    var subCategorySelect = document.getElementById('sub_category');
    
    var subCategories = [];
    if (category == 'Main Ingredients') {
        subCategories = ['Meat & Poultry', 'Vegetables', 'Others'];
    } else if (category == 'Commissary') {
        subCategories = ['Condiments & Sauces', 'Spices & Herbs', 'Toppings', 'Cutlery', 'Others'];
    }

    subCategories.forEach(function(subCategory) {
        var option = document.createElement('option');
        option.value = subCategory;
        option.text = subCategory;
        if (subCategory === '<?= $ingredient['sub_category'] ?>') {
            option.selected = true;
        }
        subCategorySelect.appendChild(option);
    });
});
</script>

ingredients-view.php
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
