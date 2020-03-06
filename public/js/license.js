$(document).ready(function(){
    $('#id_manufacture').select2({
        allowClear: true,
        /* Add this */
        placeholder: {
            id: "id_manufacture",
            placeholder: "Select Manufacture"
        },
    });
    $('#id_category').select2({
        allowClear: true,
        /* Add this */
        placeholder: {
            id: "id_category",
            placeholder: "Select Category"
        },
    });
    $('#id_supplier').select2({
        allowClear: true,
        /* Add this */
        placeholder: {
            id: "id_supplier",
            placeholder: "Select Supplier"
        },
    });
    
});
