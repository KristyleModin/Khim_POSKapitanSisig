<?php 

require '../config/function.php';

// Fetch the parameter ID from the request
$paramResultId = checkParam('id');

// Check if the parameter ID is valid and numeric
if (is_numeric($paramResultId)) {
    // Validate the parameter ID
    $unitId = validate($paramResultId);

    // Get the unit by ID
    $unit = getById('units', $unitId); 
    
    // Check if the unit was retrieved successfully
    if ($unit['status'] == 200) {
        // Delete the unit
        $unitDeleteRes = delete('units', $unitId);
        if ($unitDeleteRes) {
            redirect('units.php', 'Unit of measurement deleted successfully!');
        } else {
            redirect('units.php', 'Something went wrong.');
        }
    } else {
        redirect('units.php', $unit['message']);
    }
} else {
    redirect('units.php', 'Invalid ID.');
}

?>
