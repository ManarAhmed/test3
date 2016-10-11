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
        var threshold = $('#threshold').val();
        var branch_id = $('#branch').val();
        mystoreddata = {
            manufacturer: manufacturer,
            distribter: distribter,
            manu_num: manu_num,
            dist_num: dist_num,
            package: package,
            quantity: quantity,
            drawer_num: drawer_num,
            threshold: threshold,
            branch_id: branch_id
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
                history.go(-1);
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
            var idAttr = $(this).attr('id');
            if (idAttr != 'manufacturer' && idAttr != 'manu_website' && idAttr != 'distributor' && idAttr != 'dist_website') {
                if ($(this).val() == '') {
                    $(this).parent('div').parent('div').addClass('has-error has-feedback');
                    $(this).after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>')
                    valid = 0;
                } else {
                    $(this).next('.form-control-feedback').hide();
                    $(this).parent('div').parent('div').removeClass('has-error has-feedback');
                    $(this).parent('div').children('span').remove();
                }
            }
        });
        $("select").each(function () {
            if (!$(this).val()) {
                $(this).parent('div').parent('div').addClass('has-error');
                valid = 0;
            } else {
                $(this).parent('div').parent('div').removeClass('has-error');
                $(this).parent('div').children('span').remove();
            }
        });
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
        $('#threshold').val('');
        $('#branch_id').val('');
    };
    /******************************************************************************/
    $('#add_manu').on('click', function (event) {
        event.preventDefault();
        dialogManufacturer('new');

    });

    $('#add_dist').on('click', function (event) {
        event.preventDefault();
        dialogdistributor('new');

    });

    $('#add_manu_edit').on('click', function (event) {
        event.preventDefault();
        dialogManufacturer('edit');

    });

    $('#add_dist_edit').on('click', function (event) {
        event.preventDefault();
        dialogdistributor('edit');

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
                            location.reload();
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
    var dialogdistributor = function (action) {
        $("#dialog_add_dist").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Add": function () {
                    var name = $('#distributor').val();
                    var website = $("#dist_website").val();
                    var data = {
                        distributor: name,
                        dist_website: website
                    };
                    data['submit_dist'] = 'ok';
                    var setting = {
                        url: 'http://localhost/EwestStore/db/distributorTable.php',
                        type: 'post',
                        data: data,
                        success: function (data) {
                            console.log(data);
                            location.reload();
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

    /******************************************************************************/
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
                    var manu_part_num = $("#td_quantity_" + id).parent('tr').find('#manu_part_num').html();
                    var added_quantity = Number($('#added_quantity').val());
                    var before_quantity = Number($("#td_quantity_" + id).html());
                    var total_quantity = before_quantity + added_quantity;
                    var today_date = $.datepicker.formatDate('yy-mm-dd', new Date());
                    //check if these added component found in required
                    //stop code until the ajax response
                    $.when(chechRequired(manu_part_num)).done(function (data) {
                        if (data) {
                            var data_array = JSON.parse(data)[0];
                            if (added_quantity >= data_array['required_quantity'])
                            {
                                deleteRequired(data_array['id'])
                            } else {
                                var new_required_quantity = Number(data_array['required_quantity']) - added_quantity
                                updateRequired(data_array['id'], new_required_quantity);
                            }
                        }
                    });
                    //update the component quantity in the store
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

// UPDATE component quantity function
    var updateComponent = function (new_quantity, id) {
        var setting = {
            url: 'http://localhost/EwestStore/db/storeTable.php?id=' + id,
            type: 'get',
            data: {new_quantity: new_quantity, update_quantity: 'ok'},
            success: function (data) {
                console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };

// ADD data to log table
    var insertLog = function (log_data) {
        log_data['add_log'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/logComponentTable.php',
            type: 'post',
            data: log_data,
            success: function (data) {
                console.log(data);
                history.go(-1);
            },
            error: function (data) {
                console.log("Error in insertLog: " + data);
            }
        };
        $.ajax(setting);
    };

//check if added component found in required table and return the required quantity
    var chechRequired = function (manu_part_num) {
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php',
            type: 'post',
            data: {manu_num: manu_part_num, find: 'ok'},
        };
        return $.ajax(setting);
    };
//DELETE required component if added quantity >= required quantity
    var deleteRequired = function (id) {
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php?id=' + id,
            type: 'get',
            data: {delete: 'ok'},
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
//UPDATE required component quantity if added quantity < required quantity
    var updateRequired = function (id, new_quantity) {
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php?id=' + id,
            type: 'get',
            data: {new_quantity: new_quantity, update_req_quantity: 'ok'},
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };

    /******************************************************************************/
//Update quantity in store table when pull
    $('.btn_require').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('id');
        $("#dialog-require-component").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Require": function () {
                    var require_quantity = Number($('#require_quantity').val());
                    var manufacturer = $('.manufacturer').find('td').attr('id');
                    var distributor = $('.distributor').find('td').attr('id');
                    var manu_part_num = $('.manu_part_num').find('td').html();
                    var dist_part_num = $('.dist_part_num').find('td').html();
                    var package = $('.package').find('td').html();
                    var username = $('#username').val();
                    var priority = $('#priority').val();
//                    alert("#td_" + id);
                    var require_data = {
                        manufacturer: manufacturer,
                        distributor: distributor,
                        manu_num: manu_part_num,
                        dist_num: dist_part_num,
                        package: package,
                        req_quantity: require_quantity,
                        resp_user: username,
                        project: 'NULL',
                        priority: priority,
                        due_date: '0000-00-00',
                    };
                    addRequire(require_data);

                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });
    
//ADD to required components   
    var addRequire = function (require_data){
        require_data['store'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php',
            type: 'post',
            data: require_data,
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };
});