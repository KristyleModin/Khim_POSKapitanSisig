<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4>Add Ingredient</h4>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
                <div class="mb-3">
                    <label for="name">Ingredient Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="unit">Unit:</label>
                    <input type="text" id="unit" name="unit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="category">Category:</label>
                    <select id="category" name="category" class="form-select" required>
                        <option value="Main Ingredients">Main Ingredients</option>
                        <option value="Commissary">Commissary</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sub_category">Sub Category:</label>
                    <select id="sub_category" name="sub_category" class="form-select" required>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>
                <button type="submit" name="saveIngredient" class="btn btn-primary">Save Ingredient</button>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    const subCategorySelect = document.getElementById('sub_category');

    const subCategoryOptions = {
        'Main Ingredients': ['Meat & Poultry', 'Vegetables', 'Others'],
        'Commissary': ['Condiments & Sauces', 'Spices & Herbs', 'Toppings', 'Cutlery', 'Others']
    };

    function updateSubCategoryOptions() {
        const selectedCategory = categorySelect.value;
        subCategorySelect.innerHTML = ''; // Clear existing options

        if (subCategoryOptions[selectedCategory]) {
            subCategoryOptions[selectedCategory].forEach(function(subCategory) {
                const option = document.createElement('option');
                option.value = subCategory;
                option.text = subCategory;
                subCategorySelect.appendChild(option);
            });
        }
    }

    categorySelect.addEventListener('change', updateSubCategoryOptions);

    // Initialize sub-category options on page load
    updateSubCategoryOptions();
});
</script>