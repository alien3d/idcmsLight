<?php
	$str.="function showGrid(page, securityToken, offset, limit) {\n";

	$str.="$.ajax({\n";
    $str.="type: 'POST',
    $str.="url: page,
    $str.="data: {
    $str.="offset: offset,
    $str.="limit: limit,
    $str.="method: 'read',
    $str.="type: 'list',
    $str.="detail: 'body',
    $str.="params: {},
    $str.="securityToken: securityToken
    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="},
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="$("#centerViewport").html("");
    $str.="$("#centerViewport").empty();
    $str.="$("#centerViewport").removeClass();
    $str.="$("#centerViewport").addClass("container-fluid");
    $str.="$('#centerViewport').append(data);
    $str.="},
    $str.="error: function () {
    $str.="// failed request; give feedback to user
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="}
    $str.="});
	$str.="}

	$str.="function ajaxQuerySearchAll(url, securityToken) {
    // unhide button search
    $str.="$("#clearSearch").removeClass();
    $str.="$("#clearSearch").addClass('btn');
    $str.="// unlimited for searching because  lazy paging.
    $str.="$.ajax({
    $str.="    type: 'POST',
    $str.="    url: url,
    $str.="    data: {
    $str.="        offset: 0,
    $str.="        limit: 99999,
    $str.="method: 'read',
    $str.="type: 'list',
    $str.="detail: 'body',
    $str.="query: $("#query").val(),
    $str.="params: {
    $str.="   
    $str.="},
    $str.="securityToken: securityToken
    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="},
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="$("#centerViewport").html("");
    $str.="$("#centerViewport").empty();
    $str.="$("#centerViewport").removeClass();
    $str.="$("#centerViewport").addClass("container-fluid");
	$str.="$('#centerViewport').append(data);
	$str.="},
    $str.="error: function () {
    $str.="// failed request; give feedback to user
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="}
    $str.="});
	$str.="}

	$str.="function showForm(url, securityToken) {
	$str.="// unlimited for searching because  lazy paging.
    $str.="$.ajax({
    $str.="type: 'POST',
    $str.="url: url,
    $str.="data: {
    $str.="method: 'new',
    $str.="type: 'form',
    $str.="securityToken: securityToken
    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="},
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="$("#centerViewport").html("");
    $str.="$("#centerViewport").empty();
    $str.="$("#centerViewport").removeClass();
    $str.="$("#centerViewport").addClass("container-fluid");
	$str.="$('#centerViewport').append(data);
	$str.=" \n";
    $str.="},
    $str.="error: function () {
    $str.="// failed request; give feedback to user
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="}
    $str.="});
	$str.="}

	$str.="function showFormUpdate(url, securityToken, midnightMarketId) {

    $str.="// unlimited for searching because  lazy paging.
    $str.="$.ajax({
    $str.="    type: 'POST',
    $str.="    url: url,
    $str.="data: {
    $str.="method: 'read',
    $str.="type: 'form',
    $str.="midnightMarketId: midnightMarketId,
    $str.="securityToken: securityToken
    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="},
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="$("#centerViewport").html("");
    $str.="$("#centerViewport").empty();
    $str.="$("#centerViewport").removeClass();
    $str.="$("#centerViewport").addClass("container-fluid");
	$str.="$('#centerViewport').append(data);
	$str.="},
    $str.="error: function () {
    $str.="// failed request; give feedback to user
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="}
    $str.="});
	$str.="}

	$str.="function showModalDelete(midnightMarketId, stateId, midnightMarketLocation, dayId) {
    $str.="// clear first old record if exist
    $str.="$("#midnightMarketIdPreview").val('');
    $str.="$("#stateIdPreview").html('');
    $str.="$("midnightMarketLocationPreview").html('');
    $str.="$("#dayIdPreview").html('');
    $str.="// asign variable        
    $str.="$("#midnightMarketIdPreview").val(midnightMarketId);
    $str.="$("#stateIdPreview").html(stateId);
    $str.="$("#midnightMarketLocationPreview").html(midnightMarketLocation);
    $str.="$("#dayIdPreview").html(dayId);
    $str.="// open modal box
    $str.="showMeModal('deletePreview', 1);
	$str.="}

	$str.="function deleteGridRecord(url, securityToken) {
    $str.="$.ajax({
    $str.="    type: 'POST',
    $str.="    url: url,
    $str.="   data: {
    $str.="        method: 'delete',
    $str.="        midnightMarketId: $("#midnightMarketIdPreview").val(),
    $str.="        securityToken: securityToken
    $str.="    },
    $str.="beforeSend: function () {
    $str.="        // this is where we append a loading image
    $str.="        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="    },
    $str.="    success: function (data) {
    $str.="        // successful request; do something with the data
    $str.="        if (data.success == true) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="
    $str.="        } else if (data.success == false) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
    $str.="        }

    $str.="    },
    $str.="error: function (data) {
    $str.="        // failed request; give feedback to user
    $str.="if (data.success == false) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="        }
    $str.="    }
    $str.="});
	$str.="}

	$str.="function auditRecord() {
    $str.="var css = $("#auditRecordButton").attr('class');
	$str.="if (css.search("disabled") > 0) {
    $str.="// access denied  
    $str.="} else {}
	$str.="}

	$str.="function newRecord(url, securityToken, type) {
    $str.="var css = $("#newRecordButton").attr('class');

    $str.="if (css.search("disabled") > 0) {
    $str.="// access denied  
    $str.="} else {
    $str.="if (type == 1) {
    $str.="// new record and continue
    $str.="if ($("#stateId").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
    $str.="$('#stateId').addClass("control-group error");
    $str.="$('#stateId').focus();
    $str.="} else if ($("#midnightMarketLocation").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="$('#midnightMarketLocation').addClass("control-group error");
    $str.="$('#midnightMarketLocation').focus();
    $str.="} else if ($("#dayId").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="$('#dayId').addClass("control-group error");
    $str.="$('#dayId').focus();
    $str.="} else {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');
	$str.="$.ajax({
    $str.="type: 'POST',
    $str.="url: url,
    $str.="data: {
    $str.="method: 'create',
    $str.="stateId: $("#stateId").val(),
    $str.="midnightMarketLocation: $("#midnightMarketLocation").val(),
    $str.="dayId: $("#dayId").val(),
    $str.="securityToken: securityToken

    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="                },
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="if (data.success == true) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="// reseting field value
    $str.="$("#stateId").val('');
    $str.="$("#midnightMarketLocation").val('');
	$str.="$("#dayId").val('');
    $str.="} else if (data.success == false) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');
    $str.="}
	$str.="},
    $str.="error: function (data) {
    $str.="// failed request; give feedback to user
	$str.="if (data.success == false) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="}
    $str.="}
    $str.="});
    $str.="}


    $str.="} else if (type == 2) {
    $str.="// new record and update
    $str.="// new record and continue
    $str.="if ($("#stateId").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
    $str.="$('#stateId').addClass("control-group error");
    $str.="$('#stateId').focus();
    $str.="} else if ($("#midnightMarketLocation").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="$('#midnightMarketLocation').addClass("control-group error");
    $str.="$('#midnightMarketLocation').focus();
    $str.="} else if ($("#dayId").val().length == 0) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="$('#dayId').addClass("control-group error");
    $str.="$('#dayId').focus();
    $str.="} else {
    $str.="$('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

    $str.="$.ajax({
    $str.="type: 'POST',
    $str.="url: url,
    $str.="data: {
    $str.="method: 'create',
    $str.="stateId: $("#stateId").val(),
    $str.="midnightMarketLocation: $("#midnightMarketLocation").val(),
    $str.="dayId: $("#dayId").val(),
    $str.="securityToken: securityToken

    $str.="},
    $str.="beforeSend: function () {
    $str.="// this is where we append a loading image
    $str.="$('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="},
    $str.="success: function (data) {
    $str.="// successful request; do something with the data
    $str.="if (data.success == true) {
    $str.="$('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="// reseting field value
    $str.="$("#religionTitle").val("");
    $str.="$("#religionDesc").val("");
    $str.="}

    $str.="},
    $str.="                error: function (data) {
    $str.="                    // failed request; give feedback to user
    $str.="                    if (data.success == false) {
    $str.="                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="                    }
    $str.="                }
    $str.="            });
    $str.="        }


    $str.="    } else if (type == 3) {
    $str.="        // new record and continue and print/preview(Open modal box)
    $str.="        // new record and continue
    $str.="        if ($("#stateId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
    $str.="            $('#stateId').addClass("control-group error");
    $str.="            $('#stateId').focus();
    $str.="        } else if ($("#midnightMarketLocation").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="           $('#midnightMarketLocation').addClass("control-group error");
    $str.="            $('#midnightMarketLocation').focus();
    $str.="        } else if ($("#dayId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="            $('#dayId').addClass("control-group error");
    $str.="           $('#dayId').focus();
    $str.="        } else {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

    $str.="            $.ajax({
    $str.="                type: 'POST',
    $str.="                url: url,
    $str.="                data: {
    $str.="                    method: 'create',
    $str.="                    stateId: $("#stateId").val(),
    $str.="                    midnightMarketLocation: $("#midnightMarketLocation").val(),
    $str.="                    dayId: $("#dayId").val(),
    $str.="                    securityToken: securityToken

    $str.="                },
    $str.="                beforeSend: function () {
    $str.="                    // this is where we append a loading image
    $str.="                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="                },
    $str.="                success: function (data) {
    $str.="                    // successful request; do something with the data
    $str.="                    if (data.success == true) {
    $str.="                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="                        // reseting field value
    $str.="                        $("#religionTitle").val('');
    $str.="                        $("#religionDesc").val('');

    $str.="                    }
    $str.="                },
    $str.="                error: function (data) {
    $str.="                    // failed request; give feedback to user
    $str.="                    if (data.success == false) {
    $str.="                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="                    }
    $str.="                }
    $str.="            });
    $str.="        }


    $str.="    } else if (type == 4) {
    $str.="        // new record and update and  print/preview(open modal box)
    $str.="        // new record and continue
    $str.="        if ($("#stateId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
    $str.="            $('#stateId').addClass("control-group error");
    $str.="            $('#stateId').focus();
    $str.="        } else if ($("#midnightMarketLocation").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="            $('#midnightMarketLocation').addClass("control-group error");
    $str.="            $('#midnightMarketLocation').focus();
    $str.="        } else if ($("#dayId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="            $('#dayId').addClass("control-group error");
    $str.="            $('#dayId').focus();
    $str.="        } else {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

    $str.="            $.ajax({
    $str.="                type: 'POST',
    $str.="                url: url,
    $str.="                data: {
    $str.="                    method: 'create',
    $str.="                    stateId: $("#stateId").val(),
    $str.="                    midnightMarketLocation: $("#midnightMarketLocation").val(),
    $str.="                    dayId: $("#dayId").val(),
    $str.="                    securityToken: securityToken
	$str.="},
    $str.="	beforeSend: function () {
    $str.="                   // this is where we append a loading image
    $str.="                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
    $str.="                },
    $str.="                success: function (data) {
    $str.="                    // successful request; do something with the data
    $str.="                    if (data.success == true) {
    $str.="                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
    $str.="                        // reseting field value
    $str.="                        $("#religionTitle").val("");
    $str.="                        $("#religionDesc").val("");
    $str.="                    }

    $str.="                },
    $str.="                error: function (data) {
    $str.="                    // failed request; give feedback to user
    $str.="                    if (data.success == false) {
    $str.="                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
    $str.="                    }
    $str.="                }
    $str.="            });
    $str.="        }
    $str.="    } else if (type == 5) {
    $str.="        // new record and listing
    $str.="        if ($("#stateId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
    $str.="            $('#stateId').addClass("control-group error");
    $str.="            $('#stateId').focus();
    $str.="        } else if ($("#midnightMarketLocation").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="            $('#midnightMarketLocation').addClass("control-group error");
    $str.="            $('#midnightMarketLocation').focus();
    $str.="        } else if ($("#dayId").val().length == 0) {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
    $str.="            $('#dayId').addClass("control-group error");
    $str.="            $('#dayId').focus();
    $str.="        } else {
    $str.="            $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

    $str.="            $.ajax({
    $str.="                type: 'POST',
     $str.="                url: url,
     $str.="                data: {
     $str.="                    method: 'create',
     $str.="                    stateId: $("#stateId").val(),
     $str.="                    midnightMarketLocation: $("#midnightMarketLocation").val(),
     $str.="                    dayId: $("#dayId").val(),
     $str.="                    securityToken: securityToken

     $str.="                },
      $str.="               beforeSend: function () {
     $str.="                    // this is where we append a loading image
     $str.="                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
     $str.="                },
     $str.="                success: function (data) {
     $str.="                    // successful request; do something with the data
     $str.="                    if (data.success == true) {
     $str.="                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
     $str.="                        // reseting field value
     $str.="                        $("#religionTitle").val("");
     $str.="                        $("#religionDesc").val("");
     $str.="                    }

     $str.="                },
     $str.="                error: function (data) {
     $str.="                    // failed request; give feedback to user
     $str.="                    if (data.success == false) {
     $str.="                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
     $str.="                    }
     $str.="                }
     $str.="            });
     $str.="        }
    
     $str.="        showMeDiv('tableDate', 0);
     $str.="        showMeDiv('formEntry', 1);
      $str.="   }
     $str.="}
 $str.="}

 $str.="function updateRecord(url, securityToken, type) {
     $str.="var css = $("#updateRecordButton").attr('class');

     $str.="if (css.search("disabled") > 0) {
        // access denied  
     $str.="} else {
     $str.="if (type == 1) {
     $str.="        // update record and continue
     $str.="        if ($("#stateId").val().length == 0) {
      $str.="           $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
      $str.="           $('#stateId').addClass("control-group error");
      $str.="           $('#stateId').focus();
      $str.="       } else if ($("#midnightMarketLocation").val().length == 0) {
      $str.="           $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
       $str.="          $('#midnightMarketLocation').addClass("control-group error");
      $str.="           $('#midnightMarketLocation').focus();
      $str.="       } else if ($("#dayId").val().length == 0) {
       $str.="          $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');
       $str.="          $('#dayId').addClass("control-group error");
       $str.="          $('#dayId').focus();
      $str.="       } else {
       $str.="          $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');
       $str.="          $.ajax({
        $str.="             type: 'POST',
         $str.="            url: url,
       $str.="              data: {
        $str.="                 method: 'save',
         $str.="                midnightMarketId: $("#midnightMarketId").val(),
         $str.="                stateId: $("#stateId").val(),
         $str.="                midnightMarketLocation: $("#midnightMarketLocation").val(),
         $str.="                dayId: $("#dayId").val(),
         $str.="                securityToken: securityToken
         $str.="            },
          $str.="           beforeSend: function () {
         $str.="                // this is where we append a loading image
         $str.="                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
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
?>