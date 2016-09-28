$(function () {
//DELETE required component data
    $('.delete').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function () {
                    updateData("required", id);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

// DELETE stored component data
    $('.delete_stored').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function () {
                    updateData("store", id);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

// DELETE manufacturer data
    $('.delete_manufacturer').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function () {
                    updateData("manufacturer", id);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

// DELETE distributer data
    $('.delete_distributer').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function () {
                    updateData("distributer", id);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

// DELETE data function
    var updateData = function (filename, id) {
        var setting = {
            url: 'http://localhost/EwestStore/db/' + filename + 'Table.php?id=' + id,
            type: 'get',
            data: {delete: "ok"},
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/"+filename+".php";
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
});
