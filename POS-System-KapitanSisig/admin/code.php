<?php
include('../config/function.php');

// Function to validate and sanitize input
function validateInput($data) {
    return trim(htmlspecialchars($data));
}

// Handle unit operations
if (isset($_POST['updateUnit']) || isset($_POST['saveUnit'])) {
    $unitId = isset($_POST['unitId']) ? validateInput($_POST['unitId']) : null;
    $unitName = isset($_POST['unitName']) ? validateInput($_POST['unitName']) : null;
    
    if (isset($_POST['updateUnit'])) {
        // Update existing unit
        if ($unitId && $unitName) {
            $updateResult = update('units', $unitId, ['name' => $unitName]);
            if ($updateResult) {
                redirect('units.php', 'Unit updated successfully!');
            } else {
                redirect('units.php', 'Failed to update unit.');
            }
        } else {
            redirect('units.php', 'Invalid data provided for update.');
        }
    } elseif (isset($_POST['saveUnit'])) {
        // Create new unit
        if ($unitName) {
            $createResult = create('units', ['name' => $unitName]);
            if ($createResult) {
                redirect('units.php', 'Unit added successfully!');
            } else {
                redirect('units.php', 'Failed to add unit.');
            }
        } else {
            redirect('units.php', 'Invalid data provided for creation.');
        }
    }
} 

// Handle admin creation
if (isset($_POST['saveAdmin'])) {
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);
    $phone = validateInput($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    if ($name != '' && $email != '' && $password != '') {
        // Check if email already exists
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if ($emailCheck && mysqli_num_rows($emailCheck) > 0) {
            redirect('admins-create.php', 'Email already used by another user.');
        }

        // Hash the password
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];

        // Insert data
        $result = create('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin created successfully.');
        } else {
            redirect('admins-create.php', 'Something went wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please fill all required fields.');
    }
}

// Handle admin update
if (isset($_POST['updateAdmin'])) {
    $adminId = validateInput($_POST['adminId']);

    $adminData = getById('admins', $adminId);
    if ($adminData['status'] != 200) {
        redirect('admins-edit.php?id=' . $adminId, 'Please fill required fields.');
    }

    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);
    $phone = validateInput($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    $emailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $emailCheckQuery);
    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        redirect('admins-edit.php?id=' . $adminId, 'Email already used by another user.');
    }

    $hashedPassword = $password ? password_hash($password, PASSWORD_BCRYPT) : $adminData['data']['password'];

    if ($name != '' && $email != '') {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];
        $result = update('admins', $adminId, $data);

        if ($result) {
            redirect('admins.php', 'Admin updated successfully!');
        } else {
            redirect('admins-edit.php?id=' . $adminId, 'Something went wrong!');
        }
    } else {
        redirect('admins-edit.php?id=' . $adminId, 'Please fill all required fields.');
    }
}

// Handle ingredient creation
if (isset($_POST['saveIngredient'])) {
    $name = validateInput($_POST['name']);
    $quantity = validateInput($_POST['quantity']);
    $unit = validateInput($_POST['unit']);
    $category = validateInput($_POST['category']);
    $sub_category = validateInput($_POST['sub_category']);

    if ($name != '' && $quantity != '' && $unit != '' && $category != '' && $sub_category != '') {
        $data = [
            'name' => $name,
            'quantity' => $quantity,
            'unit' => $unit,
            'category' => $category,
            'sub_category' => $sub_category
        ];
        $result = create('ingredients', $data);

        if ($result) {
            redirect('ingredients-view.php', 'Ingredient added successfully.');
        } else {
            redirect('ingredients-add.php', 'Error adding ingredient.');
        }
    }
}

// Handle ingredient update
if (isset($_POST['updateIngredient'])) {
    $id = validateInput($_POST['ingredientId']);
    $name = validateInput($_POST['name']);
    $quantity = validateInput($_POST['quantity']);
    $unit = validateInput($_POST['unit']);
    $category = validateInput($_POST['category']);
    $sub_category = validateInput($_POST['sub_category']);

    if ($name != '' && $quantity != '' && $unit != '' && $category != '' && $sub_category != '') {
        $data = [
            'name' => $name,
            'quantity' => $quantity,
            'unit' => $unit,
            'category' => $category,
            'sub_category' => $sub_category
        ];
        $result = update('ingredients', $id, $data);

        if ($result) {
            redirect('ingredients-view.php', 'Ingredient updated successfully.');
        } else {
            redirect('ingredients-edit.php?id=' . $id, 'Error updating ingredient.');
        }
    }
}

// Handle ingredient deletion
if (isset($_GET['deleteIngredient'])) {
    $id = validateInput($_GET['id']);
    $result = delete('ingredients', $id);

    if ($result) {
        redirect('ingredients-view.php', 'Ingredient deleted successfully.');
    } else {
        redirect('ingredients-view.php', 'Error deleting ingredient.');
    }
}
?>
