 function showGrid(page, securityToken, offset, limit) {
        $.ajax({
            type	: 	'POST',
            url		: 	page,
            data	: 	{
                offset			: 	offset,
                limit			: 	limit,
                method			: 	'read',
                type			: 	'list',
                detail			: 	'body',
                params			: 	{},
                securityToken	:	securityToken
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
    			type	: 	'POST',
    			url		:	url,
    			data	: 	{
        				offset			: 	0,
        				limit			: 	99999,
                        method			:	'read',
                        type			: 	'list',
                        detail			: 	'body',
                        query			: 	$('#query').val(),
                        params			: 	{ },
                        securityToken	:	securityToken
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
    				type	: 	'POST',
    				url		:	url,
                    data	: 	{
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
    function showModalDelete(themeId,themeSequence,themeCode,themeNote,themePath,isDefault,isNew,isDraft,isUpdate,isDelete,isActive,isApproved,isReview,isPost) {
        // clear first old record if exist
        $('#themeIdPreview').val('');
        $('#themeIdPreview').val(themeId);

        $('#themeSequencePreview').val('');
        $('#themeSequencePreview').val(themeSequence);

        $('#themeCodePreview').val('');
        $('#themeCodePreview').val(themeCode);

        $('#themeNotePreview').val('');
        $('#themeNotePreview').val(themeNote);

        $('#themePathPreview').val('');
        $('#themePathPreview').val(themePath);

        $('#isDefaultPreview').val('');
        $('#isDefaultPreview').val(isDefault);

        $('#isNewPreview').val('');
        $('#isNewPreview').val(isNew);

        $('#isDraftPreview').val('');
        $('#isDraftPreview').val(isDraft);

        $('#isUpdatePreview').val('');
        $('#isUpdatePreview').val(isUpdate);

        $('#isDeletePreview').val('');
        $('#isDeletePreview').val(isDelete);

        $('#isActivePreview').val('');
        $('#isActivePreview').val(isActive);

        $('#isApprovedPreview').val('');
        $('#isApprovedPreview').val(isApproved);

        $('#isReviewPreview').val('');
        $('#isReviewPreview').val(isReview);

        $('#isPostPreview').val('');
        $('#isPostPreview').val(isPost);

        // open modal box
        showMeModal('deletePreview', 1);
    }
    function deleteGridRecord(url, securityToken) {
        $.ajax({
    				type	: 	'POST',
    				url		: 	url,
   				data	:	{
        					method				:	'delete',
        					themeId	: 	$('#themeIdPreview').val(),
        					securityToken		: 	securityToken
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
    function auditRecord() {
        var css = $('#auditRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied  
        }	 else {}
    }
    function newRecord(url, securityToken, type) {
        var css = $('#newRecordButton').attr('class');
        if (css.search('disabled') > 0) {
            // access denied
        } else {
            if (type == 1) {
                // new record and continue
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                    $.ajax({
                        type	: 	'POST',
                        url		: 	url,
                        data	:	{
                            method					:	'create',
                            themeId					: 	$('#themeId').val(),
                            themeSequence					: 	$('#themeSequence').val(),
                            themeCode					: 	$('#themeCode').val(),
                            themeNote					: 	$('#themeNote').val(),
                            themePath					: 	$('#themePath').val(),
                            isDefault					: 	$('#isDefault').val(),
                            isNew					: 	$('#isNew').val(),
                            isDraft					: 	$('#isDraft').val(),
                            isUpdate					: 	$('#isUpdate').val(),
                            isDelete					: 	$('#isDelete').val(),
                            isActive					: 	$('#isActive').val(),
                            isApproved					: 	$('#isApproved').val(),
                            isReview					: 	$('#isReview').val(),
                            isPost					: 	$('#isPost').val(),
                            securityToken			: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

                } else {
                    $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                    $.ajax({
                        type	:	'POST',
                        url		: 	url,
                        data	: 	{
                            method					:	'create',
                            themeIdId					: 	$('#themeIdId').val(),
                            themeSequenceId					: 	$('#themeSequenceId').val(),
                            themeCodeId					: 	$('#themeCodeId').val(),
                            themeNoteId					: 	$('#themeNoteId').val(),
                            themePathId					: 	$('#themePathId').val(),
                            isDefaultId					: 	$('#isDefaultId').val(),
                            isNewId					: 	$('#isNewId').val(),
                            isDraftId					: 	$('#isDraftId').val(),
                            isUpdateId					: 	$('#isUpdateId').val(),
                            isDeleteId					: 	$('#isDeleteId').val(),
                            isActiveId					: 	$('#isActiveId').val(),
                            isApprovedId					: 	$('#isApprovedId').val(),
                            isReviewId					: 	$('#isReviewId').val(),
                            isPostId					: 	$('#isPostId').val(),
                            securityToken			:	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

        		} else {
            		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            			$.ajax({
                		type	: 	'POST',
                		url		: 	url,
                		data	:	{
                    		method					:	'create',
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
                    		securityToken			: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

        } else {
            $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            $.ajax({
                type	: 	'POST',
                url	: 	url,
                data	:	{
                		method					:	'create',
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
                    	securityToken			: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

        		} else {
            		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            		$.ajax({
                		type	:	'POST',
                		url		: 	url,
                		data	: 	{
                    		method					:	'create',
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
                    		securityToken			: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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
        var css = $('#updateRecordButton').attr('class');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

       		} else {
          		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
          		$.ajax({
             			type	:	'POST',
            				url		: 	url,
              			data	: 	{
                 			method: 'save',
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
                				securityToken			:	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

    				} else {
        				$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
        				$.ajax({
        						type	: 	'POST',
         					url		: 	url,
                                data	:	{
                                    method					:	'save',
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
                					securityToken			: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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

    } else if ($('#isDefault').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDefault First</div>');
                    $('#isDefault').addClass('control-group error');
                    $('#isDefault').focus();

    } else if ($('#isNew').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isNew First</div>');
                    $('#isNew').addClass('control-group error');
                    $('#isNew').focus();

    } else if ($('#isDraft').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDraft First</div>');
                    $('#isDraft').addClass('control-group error');
                    $('#isDraft').focus();

    } else if ($('#isUpdate').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isUpdate First</div>');
                    $('#isUpdate').addClass('control-group error');
                    $('#isUpdate').focus();

    } else if ($('#isDelete').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isDelete First</div>');
                    $('#isDelete').addClass('control-group error');
                    $('#isDelete').focus();

    } else if ($('#isActive').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isActive First</div>');
                    $('#isActive').addClass('control-group error');
                    $('#isActive').focus();

    } else if ($('#isApproved').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isApproved First</div>');
                    $('#isApproved').addClass('control-group error');
                    $('#isApproved').focus();

    } else if ($('#isReview').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isReview First</div>');
                    $('#isReview').addClass('control-group error');
                    $('#isReview').focus();

    } else if ($('#isPost').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose isPost First</div>');
                    $('#isPost').addClass('control-group error');
                    $('#isPost').focus();

    					} else {
       					$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
                            $.ajax({
            					type: 'POST',
            					url: url,
            					data: {
                					method: 'save',
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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
    				type	:	'POST',
    				url		: 	url,
    				data	: 	{
        				method				:	'delete',
        				themeId	: 	$('#midnightMarketId').val(),
        				securityToken		: 	securityToken
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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
                                $('#isDefault').val('');
                                $('#isNew').val('');
                                $('#isDraft').val('');
                                $('#isUpdate').val('');
                                $('#isDelete').val('');
                                $('#isActive').val('');
                                $('#isApproved').val('');
                                $('#isReview').val('');
                                $('#isPost').val('');
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
    			type	: 'GET',
    			url		: url,
    			data	: {
        			method			:	'dataNavigationRequest',
        			dataNavigation	: 	'firstRecord',
        			output			: 	'json',
        			securityToken	: 	securityToken
    			},
    			beforeSend: function () {
        			// this is where we append a loading image
        			$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
    			},
    			success: function (data) {
        			// successful request; do something with the data
        			if (data.success == true) {
            			$.ajax({
                			type	: 	'POST',
               			url		: 	url,
                			data	:	{
                    			method				:	'read',
                    			themeId	: 	data.firstRecord,
                    			output				: 	'json',
                    			securityToken		: 	securityToken
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
        $('#isDefault').val(data.data.isDefault);
        $('#isNew').val(data.data.isNew);
        $('#isDraft').val(data.data.isDraft);
        $('#isUpdate').val(data.data.isUpdate);
        $('#isDelete').val(data.data.isDelete);
        $('#isActive').val(data.data.isActive);
        $('#isApproved').val(data.data.isApproved);
        $('#isReview').val(data.data.isReview);
        $('#isPost').val(data.data.isPost);
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
       		type	:	'GET',
       		url		: 	url,
      		data	: 	{
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
                    		type	: 	'POST',
                   		url		: 	url,
                   		data	:	{
                        		method				: 	'read',
                        		themeId	: 	data.lastRecord,
                       		output				: 	'json',
                       		securityToken		:	securityToken
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
        $('#isDefault').val(data.data.isDefault);
        $('#isNew').val(data.data.isNew);
        $('#isDraft').val(data.data.isDraft);
        $('#isUpdate').val(data.data.isUpdate);
        $('#isDelete').val(data.data.isDelete);
        $('#isActive').val(data.data.isActive);
        $('#isApproved').val(data.data.isApproved);
        $('#isReview').val(data.data.isReview);
        $('#isPost').val(data.data.isPost);
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
             		type	:	'POST',
             		url		: 	url,
            			data	: 	{
               			method				: 	'read',
               			themeId	: 	$('#previousRecord').val(),
               			output				: 	'json',
               			securityToken		:	securityToken
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
        $('#isDefault').val(data.data.isDefault);
        $('#isNew').val(data.data.isNew);
        $('#isDraft').val(data.data.isDraft);
        $('#isUpdate').val(data.data.isUpdate);
        $('#isDelete').val(data.data.isDelete);
        $('#isActive').val(data.data.isActive);
        $('#isApproved').val(data.data.isApproved);
        $('#isReview').val(data.data.isReview);
        $('#isPost').val(data.data.isPost);
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
             	type	:	'POST',
             	url		: url,
          		data	: {
               		method				: 	'read',
              		themeId	: 	$('#nextRecord').val(),
               		output				: 	'json',
               		securityToken		:	securityToken
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
        $('#isDefault').val(data.data.isDefault);
        $('#isNew').val(data.data.isNew);
        $('#isDraft').val(data.data.isDraft);
        $('#isUpdate').val(data.data.isUpdate);
        $('#isDelete').val(data.data.isDelete);
        $('#isActive').val(data.data.isActive);
        $('#isApproved').val(data.data.isApproved);
        $('#isReview').val(data.data.isReview);
        $('#isPost').val(data.data.isPost);
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