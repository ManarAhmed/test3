$(function () {
    var date = new Date($('#due-date').val());
    $("#due-date").datepicker();

    if ($('#due-date').val() && $('#due-date').val() != "0000-00-00") {
        $("#due-date").datepicker("setDate", date);
    }

    $("#due-date").datepicker("option", "dateFormat", "yy-mm-dd");


//function to get form data
    var mydata;
    var getData = function () {
        var manufacturer = $('#manu').val();
        var distributor = $('#dist').val();
        var manu_num = $('#manu-num').val();
        var dist_num = $('#dist-num').val();
        var package = $('#package').val();
        var req_quantity = $('#req-quantity').val();
        var resp_user = $('#resp-user').val();
        var project = $('#project').val();
        var priority = $('#priority').val();
        var due_date = $('#due-date').val();
        mydata = {
            manufacturer: manufacturer,
            distributor: distributor,
            manu_num: manu_num,
            dist_num: dist_num,
            package: package,
            req_quantity: req_quantity,
            resp_user: resp_user,
            project: project,
            priority: priority,
            due_date: due_date
        };
    }

//check validation then INSERT new required component data
    $('#submit').on('click', function () {
        if (checkValid()) {
            storeData();
        }
    });

// check validation then EDIT required component data
    $('#update').on('click', function () {
        var id = $('#required_id').val();
        if (checkValid()) {
            updateData(id);
        }
    });
//INSERT new required component data function
    var storeData = function () {
        getData();
        mydata['store'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php',
            type: 'post',
            data: mydata,
            success: function (data) {
                console.log(data);
                emptyFields();
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };

//EDIT OR DELETE required component data function
    var updateData = function (id) {
        getData();
        mydata['update'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/requiredTable.php?id=' + id,
            type: 'get',
            data: mydata,
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
    var checkValid = function () {
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
    var emptyFields = function () {
        $('#manu').val('');
        $('#dist').val('');
        $('#manu-num').val('');
        $('#dist-num').val('');
        $('#package').val('');
        $('#req-quantity').val('');
        $('#project').val('');
        $('#priority').val('');
        $('#due-date').val('');
    };

    $('#add_manu_required').on('click', function (event) {
        event.preventDefault();
        dialogdistributor('new');

    });

    $('#add_dist_required').on('click', function (event) {
        event.preventDefault();
        dialogdistributor('new');

    });

    $('#add_manu_edit_required').on('click', function (event) {
        event.preventDefault();
        dialogManufacturer('edit');

    });

    $('#add_dist_edit_required').on('click', function (event) {
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
                            if (action === 'new') {
                                window.location.href = "http://localhost/EwestStore/required/new.php";
                            }
                            else if (action === 'edit') {
                                var id = $('#required_id').val();
                                window.location.href = "http://localhost/EwestStore/required/edit.php?id=" + id;
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
                            if (action === 'new') {
                                window.location.href = "http://localhost/EwestStore/required/new.php";
                            }
                            else if (action === 'edit') {
                                var id = $('#required_id').val();
                                window.location.href = "http://localhost/EwestStore/required/edit.php?id=" + id;
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


});
                