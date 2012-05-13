function showGrid(page, securityToken, offset, limit) {

    $.ajax({
        type: 'POST',
        url: page,
        data: {
            offset: offset,
            limit: limit,
            method: 'read',
            type: 'list',
            detail: 'body',
            params: {

            },
            securityToken: securityToken
        },
        beforeSend: function () {
            // this is where we append a loading image
            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
        },
        success: function (data) {
            // successful request; do something with the data
            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
            $("#centerViewport").html("");
            $("#centerViewport").empty();
            $("#centerViewport").removeClass();
            $("#centerViewport").addClass("container-fluid");
            $('#centerViewport').append(data);
        },
        error: function () {
            // failed request; give feedback to user
            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
        }
    });
}

function ajaxQuerySearchAll(url, securityToken) {
    // unhide button search
    $("#clearSearch").removeClass();
    $("#clearSearch").addClass('btn');
    // unlimited for searching because  lazy paging.
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            offset: 0,
            limit: 99999,
            method: 'read',
            type: 'list',
            detail: 'body',
            query: $("#query").val(),
            params: {

            },
            securityToken: securityToken
        },
        beforeSend: function () {
            // this is where we append a loading image
            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
        },
        success: function (data) {
            // successful request; do something with the data
            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
            $("#centerViewport").html("");
            $("#centerViewport").empty();
            $("#centerViewport").removeClass();
            $("#centerViewport").addClass("container-fluid");

            $('#centerViewport').append(data);

        },
        error: function () {
            // failed request; give feedback to user
            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
        }
    });
}

function showForm(url, securityToken) {

    // unlimited for searching because  lazy paging.
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            method: 'new',
            type: 'form',
            params: {
                securityToken: securityToken
            }

        },
        beforeSend: function () {
            // this is where we append a loading image
            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
        },
        success: function (data) {
            // successful request; do something with the data
            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
            $("#centerViewport").html("");
            $("#centerViewport").empty();
            $("#centerViewport").removeClass();
            $("#centerViewport").addClass("container-fluid");

            $('#centerViewport').append(data);

        },
        error: function () {
            // failed request; give feedback to user
            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
        }
    });
}

function showFormUpdate(url, securityToken, midnightMarketId) {

    // unlimited for searching because  lazy paging.
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            method: 'read',
            type: 'form',
            midnightMarketId: midnightMarketId,
            securityToken: securityToken
        },
        beforeSend: function () {
            // this is where we append a loading image
            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
        },
        success: function (data) {
            // successful request; do something with the data
            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
            $("#centerViewport").html("");
            $("#centerViewport").empty();
            $("#centerViewport").removeClass();
            $("#centerViewport").addClass("container-fluid");

            $('#centerViewport').append(data);

        },
        error: function () {
            // failed request; give feedback to user
            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
        }
    });
}

function showModalDelete(midnightMarketId, stateId, midnightMarketLocation, dayId) {
    // clear first old record if exist
    $("#midnightMarketIdPreview").val('');
    $("#stateIdPreview").html('');
    $("midnightMarketLocationPreview").html('');
    $("#dayIdPreview").html('');
    // asign variable        
    $("#midnightMarketIdPreview").val(midnightMarketId);
    $("#stateIdPreview").html(stateId);
    $("#midnightMarketLocationPreview").html(midnightMarketLocation);
    $("#dayIdPreview").html(dayId);
    // open modal box
    showMeModal('deletePreview', 1);
}

function deleteGridRecord(url, securityToken) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            method: 'delete',
            midnightMarketId: $("#midnightMarketIdPreview").val(),
            securityToken: securityToken
        },
        beforeSend: function () {
            // this is where we append a loading image
            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
        },
        success: function (data) {
            // successful request; do something with the data
            if (data.success == true) {
                $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');

            } else if (data.success == false) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
            }

        },
        error: function (data) {
            // failed request; give feedback to user
            if (data.success == false) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
            }
        }
    });


}

function auditRecord() {
    var css = $("#auditRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {}
}

function newRecord(url, securityToken, type) {
    var css = $("#newRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        if (type == 1) {
            // new record and continue
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        method: 'create',
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#stateId").val('');
                            $("#midnightMarketLocation").val('');
                            $("#dayId").val('');
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }


        } else if (type == 2) {
            // new record and update
            // new record and continue
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'create',
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }


        } else if (type == 3) {
            // new record and continue and print/preview(Open modal box)
            // new record and continue
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'create',
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val('');
                            $("#religionDesc").val('');

                        }
                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }


        } else if (type == 4) {
            // new record and update and  print/preview(open modal box)
            // new record and continue
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'create',
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        } else if (type == 5) {
            // new record and listing
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'create',
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }

            showMeDiv('tableDate', 0);
            showMeDiv('formEntry', 1);
        }
    }
}

function updateRecord(url, securityToken, type) {
    var css = $("#updateRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        if (type == 1) {
            // update record and continue
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'save',
                        midnightMarketId: $("#midnightMarketId").val(),
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#stateId").val("");
                            $("#midnightMarketLocation").val("");
                            $("#dayId").val("");
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        } else if ($type == 2) {
            // update record  preview(modal box)
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'save',
                        midnightMarketId: $("#midnightMarketId").val(),
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#stateId").val("");
                            $("#midnightMarketLocation").val("");
                            $("#dayId").val("");
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        } else if (type == 3) {
            // update record and listing
            if ($("#stateId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                $('#stateId').addClass("control-group error");
                $('#stateId').focus();
            } else if ($("#midnightMarketLocation").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#midnightMarketLocation').addClass("control-group error");
                $('#midnightMarketLocation').focus();
            } else if ($("#dayId").val().length == 0) {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
                $('#dayId').addClass("control-group error");
                $('#dayId').focus();
            } else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: url,

                    data: {
                        method: 'save',
                        midnightMarketId: $("#midnightMarketId").val(),
                        stateId: $("#stateId").val(),
                        midnightMarketLocation: $("#midnightMarketLocation").val(),
                        dayId: $("#dayId").val(),
                        securityToken: securityToken

                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#stateId").val("");
                            $("#midnightMarketLocation").val("");
                            $("#dayId").val("");
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
                        }

                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        }
    }
}

function deleteRecord(url, securityToken) {

    var css = $("#deleteRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                method: 'delete',
                midnightMarketId: $("#midnightMarketId").val(),
                securityToken: securityToken

            },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success: function (data) {
                // successful request; do something with the data
                if (data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#midnightMarketId").val("");
                    $("#stateId").val("");
                    $("#midnightMarketLocation").val("");
                    $("#dayId").val("");
                    $("#midnightMarketGps").val("");
                } else if (data.success == false) {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
                }

            },
            error: function (data) {
                // failed request; give feedback to user
                if (data.success == false) {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });

    }
}

function resetRecord() {
    $("#midnightMarketId").val('');
    $("#stateId").val('');
    $("#midnightMarketLocation").val('');
    $("#dayId").val('');
    $("#midnightMarketGps").val('');

}

function postRecord() {
    var css = $("#postRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        // access granted  
    }
}

function firstRecord(url, securityToken) {
    var css = $("#firstRecordButton").attr('class');


    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                method: 'dataNavigationRequest',
                dataNavigation: 'firstRecord',
                output: 'json',
                securityToken: securityToken

            },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success: function (data) {
                // successful request; do something with the data
                if (data.success == true) {

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            method: 'read',
                            midnightMarketId: data.firstRecord,
                            output: 'json',
                            securityToken: securityToken
                        },
                        beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                                // reseting field value
                                $("#midnightMarketId").val(data.data.midnightMarketId);
                                $("#stateId").val(data.data.stateId);
                                $("#midnightMarketLocation").val(data.data.midnightMarketLocation);
                                $("#dayId").val(data.data.dayId);
                                $("#midnightMarketGps").val(data.data.midnightMarketGps);
                                if (data.nextRecord > 0) {

                                    $("#previousRecordButton").removeClass();
                                    $("#previousRecordButton").addClass("btn btn-info  disabled");

                                    $("#nextRecordButton").removeClass();
                                    $("#nextRecordButton").addClass("btn btn-info");

                                    $("#firstRecord").val(data.firstRecord);
                                    $("#previousRecord").val(data.previousRecord);
                                    $("#nextRecord").val(data.nextRecord);
                                    $("#lastRecord").val(data.lastRecord);
                                }

                            }

                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                            }
                        }
                    });

                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + 'l</div>');

                }

            },
            error: function (data) {
                // failed request; give feedback to user
                if (data.success == false) {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
    }
}

function lastRecord(url, securityToken) {
    var css = $("#lastRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                method: 'dataNavigationRequest',
                dataNavigation: 'lastRecord',
                output: 'json',
                securityToken: securityToken

            },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success: function (data) {
                // successful request; do something with the data
                if (data.success == true) {

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            method: 'read',
                            midnightMarketId: data.lastRecord,
                            output: 'json',
                            securityToken: securityToken
                        },
                        beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                                // reseting field value
                                $("#midnightMarketId").val(data.data.midnightMarketId);
                                $("#stateId").val(data.data.stateId);
                                $("#midnightMarketLocation").val(data.data.midnightMarketLocation);
                                $("#dayId").val(data.data.dayId);
                                $("#midnightMarketGps").val(data.data.midnightMarketGps);
                                if (data.lastRecord != 0) {
                                    $("#previousRecordButton").removeClass();
                                    $("#previousRecordButton").addClass("btn btn-info");

                                    $("#nextRecordButton").removeClass();
                                    $("#nextRecordButton").addClass("btn btn-info disabled");

                                    $("#firstRecord").val(data.firstRecord);

                                    $("#previousRecord").val(data.previousRecord);
                                    $("#nextRecord").val(data.nextRecord);
                                    $("#lastRecord").val(data.lastRecord);
                                }

                            }

                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                            }
                        }
                    });

                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + 'l</div>');

                }

            },
            error: function (data) {
                // failed request; give feedback to user
                if (data.success == false) {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });

    }
}

function previousRecord(url, securityToken) {

    var css = $("#previousRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        $('#newButton').removeClass();
        if ($('#previousRecord').val() == '' || $('#previousRecord').val() == undefined) {
            $('#infoPanel').html('<div class=\'alert alert-error\'>testingo</div>');
        }
        if (parseFloat($('#previousRecord').val()) > 0 && parseFloat($("#previousRecord").val()) < parseFloat($("#lastRecord").val())) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    method: 'read',
                    midnightMarketId: $("#previousRecord").val(),
                    output: 'json',
                    securityToken: securityToken

                },
                beforeSend: function () {
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success: function (data) {
                    // successful request; do something with the data
                    if (data.success == true) {
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        $("#midnightMarketId").val(data.data.midnightMarketId);
                        $("#stateId").val(data.data.stateId);
                        $("#midnightMarketLocation").val(data.data.midnightMarketLocation);
                        $("#dayId").val(data.data.dayId);
                        $("#midnightMarketGps").val(data.data.midnightMarketGps);

                        $("#firstRecord").val(data.firstRecord);
                        $("#previousRecord").val(data.previousRecord);
                        $("#nextRecord").val(data.nextRecord);
                        $("#lastRecord").val(data.lastRecord);

                        if (parseFloat(data.nextRecord) != parseFloat(data.lastRecord)) {
                            $("#nextRecordButton").removeClass();
                            $("#nextRecordButton").addClass("btn btn-info");
                        } else {
                            $("#nextRecordButton").removeClass();
                            $("#nextRecordButton").addClass("btn btn-info disabled");
                        }
                        if (parseFloat(data.previousRecord) == 0) {
                            $("#previousRecordButton").removeClass();
                            $("#previousRecordButton").addClass("btn btn-info disabled");
                        }
                    }

                },
                error: function (data) {
                    // failed request; give feedback to user
                    if (data.success == false) {
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        } else {
            // debugging purpose only
        }
    }
}

function nextRecord(url, securityToken) {
    var css = $("#nextRecordButton").attr('class');

    if (css.search("disabled") > 0) {
        // access denied  
    } else {
        $('#newButton').removeClass();
        if ($('#nextRecord').val() == '' || $('#nextRecord').val() == undefined) {
            $('#infoPanel').html('<div class=\'alert alert-error\'>sdfd</div>');
        }
        if (parseFloat($("#nextRecord").val()) < parseFloat($("#lastRecord").val())) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    method: 'read',
                    midnightMarketId: $("#nextRecord").val(),
                    output: 'json',
                    securityToken: securityToken

                },
                beforeSend: function () {
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success: function (data) {
                    // successful request; do something with the data
                    if (data.success == true) {
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        $("#midnightMarketId").val(data.data.midnightMarketId);
                        $("#stateId").val(data.data.stateId);
                        $("#midnightMarketLocation").val(data.data.midnightMarketLocation);
                        $("#dayId").val(data.data.dayId);
                        $("#midnightMarketGps").val(data.data.idnightMarketGps);

                        $("#firstRecord").val(data.firstRecord);
                        $("#previousRecord").val(data.previousRecord);
                        $("#nextRecord").val(data.nextRecord);
                        $("#lastRecord").val(data.lastRecord);

                        if (parseFloat(data.previousRecord) > 0) {
                            $("#previousRecordButton").removeClass();
                            $("#previousRecordButton").addClass("btn btn-info");
                        } else {
                            $("#previousRecordButton").removeClass();
                            $("#previousRecordButton").addClass("btn btn-info disabled");
                        }
                        if (parseFloat(data.nextRecord) == parseFloat('lastRecord')) {
                            $("#nextRecordButton").removeClass();
                            $("#nextRecordButton").addClass("btn btn-info disabled");
                        }

                    }

                },
                error: function (data) {
                    // failed request; give feedback to user
                    if (data.success == false) {
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        } else {

        }
    }
}