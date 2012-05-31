    function showGrid(page, securityToken, offset, limit) {
        $.ajax({
            type    :   'POST',
            url     :   page,
            data    :   {
                offset          :   offset,
                limit           :   limit,
                method          :   'read',
                type            :   'list',
                detail          :   'body',
                params          :   {},
                securityToken   :   securityToken
            },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
            },
            success: function (data) {
                // successful request; do something with the data
                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                $('#centerViewport').html('');
                $('#centerViewport').empty();
                $('#centerViewport').removeClass();
                $('#centerViewport').addClass('container-fluid');
                $('#centerViewport').append(data);
            },
                error: function () {
                // failed request; give feedback to user
                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
            }
        });
    }
    function ajaxQuerySearchAll(url, securityToken) {
        // unhide button search
        $('#clearSearch').removeClass();
        $('#clearSearch').addClass('btn');
        // unlimited for searching because  lazy paging.
        $.ajax({
                type    :   'POST',
                url     :   url,
                data    :   {
                        offset          :   0,
                        limit           :   99999,
                        method          :   'read',
                        type            :   'list',
                        detail          :   'body',
                        query           :   $('#query').val(),
                        params          :   { },
                        securityToken   :   securityToken
                },
                beforeSend: function () {
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                },
                success: function (data) {
                    // successful request; do something with the data
                    $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                    $('#centerViewport').html('');
                    $('#centerViewport').empty();
                    $('#centerViewport').removeClass();
                    $('#centerViewport').addClass('container-fluid');
                    $('#centerViewport').append(data);
                },
                error: function () {
                    // failed request; give feedback to user
                    $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
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
                    securityToken: securityToken
            },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
            },
            success: function (data) {
                // successful request; do something with the data
                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                $('#centerViewport').html('');
                $('#centerViewport').empty();
                $('#centerViewport').removeClass();
                $('#centerViewport').addClass('container-fluid');
                $('#centerViewport').append(data);
            },
            error: function () {
                // failed request; give feedback to user
                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
            }
        });
    }
    function showFormUpdate(url, securityToken, themeId) {
        // unlimited for searching because  lazy paging.
        $.ajax({
                    type    :   'POST',
                    url     :   url,
                    data    :   {
                                    method: 'read',
                                    type: 'form',
                                    themeId: themeId,
                                    securityToken: securityToken
                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                        $('#centerViewport').html('');
                        $('#centerViewport').empty();
                        $('#centerViewport').removeClass();
                        $('#centerViewport').addClass('container-fluid');
                        $('#centerViewport').append(data);
},
                    error: function () {
                        // failed request; give feedback to user
                        $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                    }
                });
    }
    function showModalDelete(themeId,themeSequence,themeCode,themeNote,themePath) {
        // clear first old record if exist
        $('#themeIdPreview').val('');
        $('#themeIdPreview').val(unescape(themeId));

        $('#themeSequencePreview').val('');
        $('#themeSequencePreview').val(unescape(themeSequence));

        $('#themeCodePreview').val('');
        $('#themeCodePreview').val(unescape(themeCode));

        $('#themeNotePreview').val('');
        $('#themeNotePreview').val(unescape(themeNote));

        $('#themePathPreview').val('');
        $('#themePathPreview').val(unescape(themePath));

        // open modal box
        showMeModal('deletePreview', 1);
    }
    function deleteGridRecord(url, securityToken) {
        $.ajax({
                    type    :   'POST',
                    url     :   url,
                data    :   {
                            method              :   'delete',
                            output              :   'json',
                            themeId :   $('#themeIdPreview').val(),
                            securityToken       :   securityToken
                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                        }
                    },
                    error: function (data) {
                        // failed request; give feedback to user
                        if (data.success == false) {
                            $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                        }
                    }
                });
        }
    function auditRecord(url, securityToken) {
        var css = $('#auditRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied  
        }    else {}
    }
    function newRecord(url, securityToken, type) {
        var css = $('#newRecordButton2').attr('class');
        if (css.search('disabled') > 0) {
            // access denied
        } else {
            if (type == 1) {
                // new record and continue
    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                    $.ajax({
                        type    :   'POST',
                        url     :   url,
                        data    :   {
                            method                  :   'create',
                            output                  :   'json',
                            themeSequence                   :   $('#themeSequence').val(),
                            themeCode                   :   $('#themeCode').val(),
                            themeNote                   :   $('#themeNote').val(),
                            themePath                   :   $('#themePath').val(),
                            securityToken           :   securityToken
                        },
                        beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                // reseting field value
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                            } else if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                            }
                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                            }
                        }
                    });
                }
            } else if (type == 2) {
                // new record and update
                // new record and continue
    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                    $.ajax({
                        type    :   'POST',
                        url     :   url,
                        data    :   {
                            method                  :   'create',
                            output                  :   'json',
                            themeSequence                   :   $('#themeSequence').val(),
                            themeCode                   :   $('#themeCode').val(),
                            themeNote                   :   $('#themeNote').val(),
                            themePath                   :   $('#themePath').val(),
                            securityToken           :   securityToken
                        },
                        beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
$('#themeId').val(data.themeId); 
    $('#newRecordButton1').removeClass(); 
    $('#newRecordButton2').removeClass(); 
    $('#newRecordButton3').removeClass(); 
    $('#newRecordButton4').removeClass(); 
    $('#newRecordButton5').removeClass(); 
    $('#newRecordButton6').removeClass(); 
    $('#newRecordButton7').removeClass(); 
    $('#newRecordButton1').addClass('btn btn-success disabled'); 
    $('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); 
    $('#newRecordButton3').addClass('btn btn-success disabled'); 
    $('#newRecordButton4').addClass('btn btn-success disabled'); 
    $('#newRecordButton5').addClass('btn btn-success disabled'); 
    $('#newRecordButton6').addClass('btn btn-success disabled'); 
    $('#newRecordButton7').addClass('btn btn-success disabled'); 
    $('#newRecordButton1').attr('onClick', ''); 
    $('#newRecordButton2').attr('onClick', ''); 
    $('#newRecordButton3').attr('onClick', ''); 
    $('#newRecordButton4').attr('onClick', ''); 
    $('#newRecordButton5').attr('onClick', ''); 
    $('#newRecordButton6').attr('onClick', ''); 
    $('#newRecordButton7').attr('onClick', ''); 
    $('#updateRecordButton1').removeClass(); 
    $('#updateRecordButton2').removeClass(); 
    $('#updateRecordButton3').removeClass(); 
    $('#updateRecordButton4').removeClass(); 
    $('#updateRecordButton5').removeClass(); 
    $('#updateRecordButton1').addClass('btn btn-info'); 
    $('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); 
    $('#updateRecordButton1').attr('onClick', ''); 
    $('#updateRecordButton2').attr('onClick', ''); 
    $('#updateRecordButton3').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
    $('#updateRecordButton4').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+2+"\")"); 
    $('#updateRecordButton5').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+3+"\")"); 
                            }
                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                            }
                        }
                    });
                }
            } else if (type == 3) {
                // new record and continue and print/preview(Open modal box)
                // new record and continue
    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                        $.ajax({
                        type    :   'POST',
                        url     :   url,
                        data    :   {
                            method                  :   'create',
                            output                  :   'json',
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                            securityToken           :   securityToken
                        },
                        beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                // reseting field value
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                            }
                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                            }
                        }
                    });
                }
            } else if (type == 4) {
                // new record and update and  print/preview(open modal box)
                // new record and continue
    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

        } else {
            $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            $.ajax({
                type    :   'POST',
                url :   url,
                data    :   {
                        method                  :   'create',
                            output                  :   'json',
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                        securityToken           :   securityToken
                    },
                    beforeSend: function () {
                    // this is where we append a loading image
                        $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                    // successful request; do something with the data
                    if (data.success == true) {
                        $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
$('#themeId').val(data.themeId); 
    $('#newRecordButton1').removeClass(); 
    $('#newRecordButton2').removeClass(); 
    $('#newRecordButton3').removeClass(); 
    $('#newRecordButton4').removeClass(); 
    $('#newRecordButton5').removeClass(); 
    $('#newRecordButton6').removeClass(); 
    $('#newRecordButton7').removeClass(); 
    $('#newRecordButton1').addClass('btn btn-success disabled'); 
    $('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); 
    $('#newRecordButton3').addClass('btn btn-success disabled'); 
    $('#newRecordButton4').addClass('btn btn-success disabled'); 
    $('#newRecordButton5').addClass('btn btn-success disabled'); 
    $('#newRecordButton6').addClass('btn btn-success disabled'); 
    $('#newRecordButton7').addClass('btn btn-success disabled'); 
    $('#newRecordButton1').attr('onClick', ''); 
    $('#newRecordButton2').attr('onClick', ''); 
    $('#newRecordButton3').attr('onClick', ''); 
    $('#newRecordButton4').attr('onClick', ''); 
    $('#newRecordButton5').attr('onClick', ''); 
    $('#newRecordButton6').attr('onClick', ''); 
    $('#newRecordButton7').attr('onClick', ''); 
    $('#updateRecordButton1').removeClass(); 
    $('#updateRecordButton2').removeClass(); 
    $('#updateRecordButton3').removeClass(); 
    $('#updateRecordButton4').removeClass(); 
    $('#updateRecordButton5').removeClass(); 
    $('#updateRecordButton1').addClass('btn btn-info'); 
    $('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); 
    $('#updateRecordButton1').attr('onClick', ''); 
    $('#updateRecordButton2').attr('onClick', ''); 
    $('#updateRecordButton3').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
    $('#updateRecordButton4').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+2+"\")"); 
    $('#updateRecordButton5').attr('onClick', "updateRecord(\""+url+"\",\""+securityToken+"\",\""+3+"\")"); 
                    }
                    },
                    error: function (data) {
                    // failed request; give feedback to user
                        if (data.success == false) {
                        $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                        }
                            }
                    });
                }
            } else if (type == 5) {
                // new record and listing
    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                    $.ajax({
                        type    :   'POST',
                        url     :   url,
                        data    :   {
                            method                  :   'create',
                            output                  :   'json',
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                            securityToken           :   securityToken
                        },
                    beforeSend: function () {
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                        success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                            }   
                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
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
        var css = $('#updateRecordButton2').attr('class');
        if (css.search('disabled') > 0) {
        // access denied
        } else {
            if (type == 1) {
                // update record and continue
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeId First</div>');
                    $('#themeId').addClass('control-group error');
                    $('#themeId').focus();

    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

            } else {
                $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                $.ajax({
                        type    :   'POST',
                            url     :   url,
                        data    :   {
                            method: 'save',
                            output                  :   'json',
                                    themeId: $('#themeId').val(),
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                                    isDefault: $('#isDefault').val(),
                                    isNew: $('#isNew').val(),
                                    isDraft: $('#isDraft').val(),
                                    isUpdate: $('#isUpdate').val(),
                                    isDelete: $('#isDelete').val(),
                                    isActive: $('#isActive').val(),
                                    isApproved: $('#isApproved').val(),
                                    isReview: $('#isReview').val(),
                                    isPost: $('#isPost').val(),
                                    executeBy: $('#executeBy').val(),
                                    executeTime: $('#executeTime').val(),
                                securityToken           :   securityToken
                            },
                        beforeSend: function () {
                                // this is where we append a loading image
                                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                            success: function (data) {
                            // successful request; do something with the data
                            if (data.success == true) {
                                $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                // reseting field value
                                $('#themeId').val('');
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                            } else if (data.success == false) {
                                    $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                                }
                            },
                            error: function (data) {
                                // failed request; give feedback to user
                                if (data.success == false) {
                                    $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                                }
                            }
                        });
                    }
                } else if ($type == 2) {
                    // update record  preview(modal box)
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeId First</div>');
                    $('#themeId').addClass('control-group error');
                    $('#themeId').focus();

    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                    } else {
                        $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                        $.ajax({
                                type    :   'POST',
                            url     :   url,
                                data    :   {
                                    method                  :   'save',
                            output                  :   'json',
                                    themeId: $('#themeId').val(),
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                                    securityToken           :   securityToken
                                },
                                beforeSend: function () {
                                    // this is where we append a loading image
                                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                                },
                                success: function (data) {
                                    // successful request; do something with the data
                                    if (data.success == true) {
                                        $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                        // reseting field value
                                $('#themeId').val('');
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                                    } else if (data.success == false) {
                                        $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                                    }
                                },
                                error: function (data) {
                                    // failed request; give feedback to user
                                    if (data.success == false) {
                                    $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                                    }
                                }
                            });
                        }
                    } else if (type == 3) {
                        // update record and listing
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeId First</div>');
                    $('#themeId').addClass('control-group error');
                    $('#themeId').focus();

    if ($('#themeSequence').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeSequence First</div>');
                    $('#themeSequence').addClass('control-group error');
                    $('#themeSequence').focus();

    } else if ($('#themeCode').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeCode First</div>');
                    $('#themeCode').addClass('control-group error');
                    $('#themeCode').focus();

    } else if ($('#themeNote').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themeNote First</div>');
                    $('#themeNote').addClass('control-group error');
                    $('#themeNote').focus();

    } else if ($('#themePath').val().length == 0) {
                $('#infoPanel').html('<div class=alert alert-error>Please Choose themePath First</div>');
                    $('#themePath').addClass('control-group error');
                    $('#themePath').focus();

                        } else {
                        $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    method: 'save',
                            output                  :   'json',
                                    themeId: $('#themeId').val(),
                                    themeSequence: $('#themeSequence').val(),
                                    themeCode: $('#themeCode').val(),
                                    themeNote: $('#themeNote').val(),
                                    themePath: $('#themePath').val(),
                                    dayId: $('#dayId').val(),
                                    securityToken: securityToken
                                },
                                beforeSend: function () {
                                    // this is where we append a loading image
                                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                                },
                                success: function (data) {
                                    // successful request; do something with the data
                                    if (data.success == true) {
                                        $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                        // reseting field value
                                $('#themeId').val('');
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                                    } else if (data.success == false) {
                                        $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                                    }
                                },
                                error: function (data) {
                                    // failed request; give feedback to user
                                    if (data.success == false) {
                                        $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                                    }
                                }
                            });
                    }
                }
        }
    }
    function deleteRecord(url, securityToken) {
        var css = $('#deleteRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied 
        } else {
            
            $.ajax({
                    type    :   'POST',
                    url     :   url,
                    data    :   {
                        method              :   'delete',
                            output                  :   'json',
                        themeId :   $('#themeId').val(),
                        securityToken       :   securityToken
                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                            // reseting field value
                                $('#themeId').val('');
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
                        } else if (data.success == false) {
                            $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                        }
                    },
                    error: function (data) {
                        // failed request; give feedback to user
                    if (data.success == false) {
                            $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
    }
    function resetRecord() {
                                $('#themeId').val('');
                                $('#themeSequence').val('');
                                $('#themeCode').val('');
                                $('#themeNote').val('');
                                $('#themePath').val('');
    }
    function postRecord() {
        var css = $('#postRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied  
        } else {
            // access granted  
        }
    }
    function firstRecord(url, securityToken) {
        var css = $('#firstRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied  
        } else {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : {
                    method          :   'dataNavigationRequest',
                    dataNavigation  :   'firstRecord',
                    output          :   'json',
                    securityToken   :   securityToken
                },
                beforeSend: function () {
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                },
                success: function (data) {
                    // successful request; do something with the data
                    if (data.success == true) {
                        $.ajax({
                            type    :   'POST',
                        url     :   url,
                            data    :   {
                                method              :   'read',
                                themeId :   data.firstRecord,
                                output              :   'json',
                                securityToken       :   securityToken
                            },
                            beforeSend: function () {
                                // this is where we append a loading image
                                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                            },
                            success: function (data) {
                                // successful request; do something with the data
                                if (data.success == true) {
                                    $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                    // reseting field value
        $('#themeId').val(data.data.themeId);
        $('#themeSequence').val(data.data.themeSequence);
        $('#themeCode').val(data.data.themeCode);
        $('#themeNote').val(data.data.themeNote);
        $('#themePath').val(data.data.themePath);
                                    if (data.nextRecord > 0) {
                                        $('#previousRecordButton').removeClass();
                                        $('#previousRecordButton').addClass('btn btn-info  disabled');
                                        $('#nextRecordButton').removeClass();
                                        $('#nextRecordButton').addClass('btn btn-info');
                                        $('#firstRecord').val(data.firstRecord);
                                        $('#previousRecord').val(data.previousRecord);
                                    $('#nextRecord').val(data.nextRecord);
                                    $('#lastRecord').val(data.lastRecord);
                                }
                            }
                        },
                        error: function (data) {
                            // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                            }
                        }
                    });
                    } else {
                    $('#infoPanel').html('<div class=alert alert-error>' + data.message + 'l</div>');
                }
                },
            error: function (data) {
            // failed request; give feedback to user
                if (data.success == false) {
                    $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
            }
            }
        });
        }
    }
    function lastRecord(url, securityToken) {
        var css = $('#lastRecordButton').attr('class');
        if (css.search('disabled') > 0) {
        // access denied
        } else {
        $.ajax({
            type    :   'GET',
            url     :   url,
            data    :   {
                method: 'dataNavigationRequest',
                dataNavigation: 'lastRecord',
                output: 'json',
                securityToken: securityToken
                },
            beforeSend: function () {
                // this is where we append a loading image
                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
            },
            success: function (data) {
                    // successful request; do something with the data
                    if (data.success == true) {
                        $.ajax({
                            type    :   'POST',
                        url     :   url,
                        data    :   {
                                method              :   'read',
                                themeId :   data.lastRecord,
                            output              :   'json',
                            securityToken       :   securityToken
                            },
                            beforeSend: function () {
                            // this is where we append a loading image
                                $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                        },
                        success: function (data) {
                                // successful request; do something with the data
                            if (data.success == true) {
                                 $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
                                // reseting field value
        $('#themeId').val(data.data.themeId);
        $('#themeSequence').val(data.data.themeSequence);
        $('#themeCode').val(data.data.themeCode);
        $('#themeNote').val(data.data.themeNote);
        $('#themePath').val(data.data.themePath);
                                    if (data.lastRecord != 0) {
                                    $('#previousRecordButton').removeClass();
                                        $('#previousRecordButton').addClass('btn btn-info');
                                    $('#nextRecordButton').removeClass();
                                        $('#nextRecordButton').addClass('btn btn-info disabled');
                                    $('#firstRecord').val(data.firstRecord);
                                    $('#previousRecord').val(data.previousRecord);
                                    $('#nextRecord').val(data.nextRecord);
                                        $('#lastRecord').val(data.lastRecord);
                                }
                            }
                        },
                        error: function (data) {
                                // failed request; give feedback to user
                            if (data.success == false) {
                                $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                            }
                        }
                    });
                } else {
                    $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
                    }
                },
            error: function (data) {
                // failed request; give feedback to user
                if (data.success == false) {
                    $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                }
            }
            });
        }
    }
    function previousRecord(url, securityToken) {
    var css = $('#previousRecordButton').attr('class');
    if (css.search('disabled') > 0) {
        // access denied
    } else {
        $('#newButton').removeClass();
        if ($('#previousRecord').val() == '' || $('#previousRecord').val() == undefined) {
            $('#infoPanel').html('<div class=alert alert-error>testingo</div>');
        }
        if (parseFloat($('#previousRecord').val()) > 0 && parseFloat($('#previousRecord').val()) < parseFloat($('#lastRecord').val())) {
            $.ajax({
                    type    :   'POST',
                    url     :   url,
                        data    :   {
                        method              :   'read',
                        themeId :   $('#previousRecord').val(),
                        output              :   'json',
                        securityToken       :   securityToken
                    },
                    beforeSend: function () {
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                        if (data.success == true) {
                            $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
        $('#themeId').val(data.data.themeId);
        $('#themeSequence').val(data.data.themeSequence);
        $('#themeCode').val(data.data.themeCode);
        $('#themeNote').val(data.data.themeNote);
        $('#themePath').val(data.data.themePath);
                                $('#firstRecord').val(data.firstRecord);
                            $('#previousRecord').val(data.previousRecord);
                                $('#nextRecord').val(data.nextRecord);
                            $('#lastRecord').val(data.lastRecord);
                            if (parseFloat(data.nextRecord) != parseFloat(data.lastRecord)) {
                                $('#nextRecordButton').removeClass();
                                    $('#nextRecordButton').addClass('btn btn-info');
                            } else {
                                    $('#nextRecordButton').removeClass();
                                 $('#nextRecordButton').addClass('btn btn-info disabled');
                                }
                            if (parseFloat(data.previousRecord) == 0) {
                                $('#previousRecordButton').removeClass();
                                $('#previousRecordButton').addClass('btn btn-info disabled');
                            }
                    }
                },
                error: function (data) {
                     // failed request; give feedback to user
                    if (data.success == false) {
                        $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                    }
                }
                });
        } else {
            // debugging purpose only
        }
    }
    }
    function nextRecord(url, securityToken) {
        var css = $('#nextRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied  
        } else {
            $('#newButton').removeClass();
            if ($('#nextRecord').val() == '' || $('#nextRecord').val() == undefined) {
                $('#infoPanel').html('<div class=alert alert-error>sdfd</div>');
            }
            if (parseFloat($('#nextRecord').val()) < parseFloat($('#lastRecord').val())) {
                $.ajax({
                type    :   'POST',
                url     : url,
                data    : {
                    method              :   'read',
                    themeId :   $('#nextRecord').val(),
                    output              :   'json',
                    securityToken       :   securityToken
                },
                    beforeSend: function () {
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
                    },
                    success: function (data) {
                        // successful request; do something with the data
                    if (data.success == true) {
                            $('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');
        $('#themeId').val(data.data.themeId);
        $('#themeSequence').val(data.data.themeSequence);
        $('#themeCode').val(data.data.themeCode);
        $('#themeNote').val(data.data.themeNote);
        $('#themePath').val(data.data.themePath);
                            $('#firstRecord').val(data.firstRecord);
                            $('#previousRecord').val(data.previousRecord);
                            $('#nextRecord').val(data.nextRecord);
                        $('#lastRecord').val(data.lastRecord);
                            if (parseFloat(data.previousRecord) > 0) {
                            $('#previousRecordButton').removeClass();
                                $('#previousRecordButton').addClass('btn btn-info');
                        } else {
                                $('#previousRecordButton').removeClass();
                            $('#previousRecordButton').addClass('btn btn-info disabled');
                        }
                        if (parseFloat(data.nextRecord) == parseFloat('lastRecord')) {
                                $('#nextRecordButton').removeClass();
                            $('#nextRecordButton').addClass('btn btn-info disabled');
                            }
                    }
                },
                error: function (data) {
                    // failed request; give feedback to user
                    if (data.success == false) {
                         $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
                    }
                }
            });
            } else {
        }
    }
    }
