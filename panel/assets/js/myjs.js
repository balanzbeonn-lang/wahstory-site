$(document).ready(function() {

    $("#parentCat").change(function() {
        var val = $("#parentCat").val();
        $.get("../api/category.php", {
            cat: val
        }, data => {
            data = JSON.parse(data);
            $("#subCat").empty();
            $("#subCat").append("<option value=''>Choose...</option>");
            for (x in data) {
                $("#subCat").append("<option value='" + data[x].cat + "'>" + data[x].cat + "</option>");
            }
        });
    });

    $("#subCat").change(function() {
        var subCat = $("#subCat").val();
        var parentCat = $("#parentCat").val();
        $.get("../api/brand.php", {
            cat: subCat,
            pCat: parentCat
        }, data => {
            data = JSON.parse(data);
            console.log(data);
            $("#brand").empty();
            $("#brand").append("<option value=''>Choose...</option>");
            for (x in data) {
                $("#brand").append("<option value='" + data[x].name + "'>" + data[x].name + "</option>");
            }
        });
    });
});

function deleteProd(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = "delete-product.php?id=" + id;
        }
    })
}