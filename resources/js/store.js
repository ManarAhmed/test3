$(function () {
//function to get form data
    var mystoreddata;
    var getStoredData = function () {
        var manufacturer = $('#manu').val();
        var distribter = $('#dist').val();
        var manu_num = $('#manu-num').val();
        var dist_num = $('#dist-num').val();
        var package = $('#package').val();
        var quantity = $('#quantity').val();
        var drawer_num = $('#drawer_num').val();
        mystoreddata = {
            manufacturer: manufacturer,
            distribter: distribter,
            manu_num: manu_num,
            dist_num: dist_num,
            package: package,
            quantity: quantity,
            drawer_num: drawer_num,
        };
    }

//check validation then INSERT new stored component data
    $('#submit_stored').on('click', function () {
        if (checkStoredValid()) {
            addStoredData();
        }
    });
// check validation then EDIT stored component data
    $('#update_stored').on('click', function () {
        var id = $('#stored_id').val();
        if (checkStoredValid()) {
            updateStoredData(id);
        }
    });
//INSERT new stored component data function
    var addStoredData = function () {
        getStoredData();
        mystoreddata['submit_stored'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/storeTable.php',
            type: 'post',
            data: mystoreddata,
            success: function (data) {
                console.log(data);
                emptyStoredFields();
            },
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(setting);
    };
//EDIT OR DELETE stored component data function
    var updateStoredData = function (id) {
        getStoredData();
        mystoreddata['update_stored'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/storeTable.php?id=' + id,
            type: 'get',
            data: mystoreddata,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/index.php";
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
//check form validation function
    var checkStoredValid = function () {
        var valid = 1;
        $("input").each(function () {
            if ($(this).val() == '') {
                $(this).parent('div').parent('div').addClass('has-error has-feedback');
                $(this).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>')
                valid = 0;
            } else {
                $(this).next('.form-control-feedback').hide();
                $(this).parent('div').parent('div').removeClass('has-error has-feedback');
                $(this).parent('div').children('span').remove();
            }
        })
        return valid;
    };
//function to clear form data
    var emptyStoredFields = function () {
        $('#manu').val('');
        $('#dist').val('');
        $('#manu-num').val('');
        $('#dist-num').val('');
        $('#package').val('');
        $('#quantity').val('');
        $('#drawer_num').val('');
    };

    $('#add_manu').on('click', function (event) {
        event.preventDefault();
        dialogManufacturer('new');

    });

    $('#add_dist').on('click', function (event) {
        event.preventDefault();
        dialogDistributer('new');

    });

    $('#add_manu_edit').on('click', function (event) {
        event.preventDefault();
        dialogManufacturer('edit');

    });

    $('#add_dist_edit').on('click', function (event) {
        event.preventDefault();
        dialogDistributer('edit');

    });
    var dialogManufacturer = function (action) {
        $("#dialog_add_manu").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Add": function () {
                    var name = $('#manufacturer').val();
                    var website = $("#manu_website").val();
                    var data = {
                        manufacturer: name,
                        manu_website: website
                    };
                    data['submit_manu'] = 'ok';
                    var setting = {
                        url: 'http://localhost/EwestStore/db/manufacturerTable.php',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            console.log(data);
                            if (action === 'new') {
                                window.location.href = "http://localhost/EwestStore/store/new.php";
                            }
                            else if (action === 'edit') {
                                var id = $('#stored_id').val();
                                window.location.href = "http://localhost/EwestStore/store/edit.php?id=" + id;
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    };
                    $.ajax(setting);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    };
    var dialogDistributer = function (action) {
        $("#dialog_add_dist").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Add": function () {
                    var name = $('#distributer').val();
                    var website = $("#dist_website").val();
                    var data = {
                        distributer: name,
                        dist_website: website
                    };
                    data['submit_dist'] = 'ok';
                    var setting = {
                        url: 'http://localhost/EwestStore/db/distributerTable.php',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            console.log(data);
                            if (action === 'new') {
                                window.location.href = "http://localhost/EwestStore/store/new.php";
                            }
                            else if (action === 'edit') {
                                var id = $('#stored_id').val();
                                window.location.href = "http://localhost/EwestStore/store/edit.php?id=" + id;
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    };
                    $.ajax(setting);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    }

    //Update quantity in store table when pull
    $('.btn_pull_component').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-pull-component").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Pull": function () {
                    var pulled_quantity = Number($('#pulled_quantity').val());
                    var before_quantity = Number($("#td_quantity_" + id).html());
                    var total_quantity = before_quantity - pulled_quantity;
                    var today_date = $.datepicker.formatDate('yy-mm-dd', new Date());
                    if (total_quantity >= 0) {
                        var log_data = {
                            component_id: id,
                            added_quantity: 'NULL',
                            pulled_quantity: pulled_quantity,
                            add_date: 'NULL',
                            pull_date: "'" + today_date + "'",
                        };
                        updateComponent(total_quantity, id);
                        insertLog(log_data);
                    } else {
                        alert('The quantity you entered exceed the quantity in the store.\nPlease enter valid quantity');
                    }
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

    //Update quantity in store table when added
    $('.btn_add_component').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-add-component").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Add": function () {

                    var added_quantity = Number($('#added_quantity').val());
                    var before_quantity = Number($("#td_quantity_" + id).html());
                    var total_quantity = before_quantity + added_quantity;
                    var today_date = $.datepicker.formatDate('yy-mm-dd', new Date());
                    var log_data = {
                        component_id: id,
                        added_quantity: added_quantity,
                        pulled_quantity: 'NULL',
                        add_date: "'" + today_date + "'",
                        pull_date: 'NULL',
                    };
                    updateComponent(total_quantity, id);
                    insertLog(log_data);
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });
// DELETE data function
    var updateComponent = function (new_quantity, id) {
        var setting = {
            url: 'http://localhost/EwestStore/db/storeTable.php?id=' + id,
            type: 'get',
            data: {new_quantity: new_quantity, update_quantity: 'ok'},
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/store.php";
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
    // DELETE data function
    var insertLog = function (log_data) {
        log_data['add_log'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/logComponentTable.php',
            type: 'post',
            data: log_data,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/store.php";
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
});