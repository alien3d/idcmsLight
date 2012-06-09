	function showGrid(page, securityToken, offset, limit,message) {
         $.ajax({
             type	:   'POST',
		url	:   page,
		data    :   {
                 offset          :   offset,
                 limit           :   limit,
                 method          : 	'read',
                 type            : 	'list',
                 detail          : 	'body',
                 params          : 	{},
                 securityToken   :	securityToken
,                 message         :	message
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
         var queryGrid =$('#query').val();
         var queryWidget =$('#queryWidget').val();
         if(queryGrid.length > 0 ) { 
             queryText = queryGrid; 
         }  else {  
             queryText = queryWidget; 
         } 
         $.ajax({
             type    :   'POST',
             url     :	url,
             data    : 	{
                 offset          :   0,
                 limit           :   99999,
                 method          :   'read',
                 type            :   'list',
                 detail          :   'body',
                 query           :   queryText,
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
	function ajaxQuerySearchAllCharacter(url, securityToken,character) {
         // unhide button search
         $('#clearSearch').removeClass();
         $('#clearSearch').addClass('btn');
         // unlimited for searching because  lazy paging.
         $.ajax({
             type    : 	'POST',
             url     :	url,
             data    :   {
                 offset          :   0,
                 limit           :   99999,
                 method          :   'read',
                 type            :   'list',
                 detail          :   'body',
                 params          :   { },
                 securityToken   :   securityToken,
                 character       :   character
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
	function ajaxQuerySearchAllDate(url, securityToken,dateRangeStart,dateRangeEnd,dateRangeType,dateRangeExtraType) {
         // unhide button search
         $('#clearSearch').removeClass();
         $('#clearSearch').addClass('btn');
         // unlimited for searching because  lazy paging.
         if(dateRangeStart.length == 0)  {   dateRangeStart = $('#dateRangeStart').val() } 
         if(dateRangeEnd.length == 0)    {   dateRangeEnd = $('#dateRangeEnd').val() } 
		$.ajax({
             type    : 	'POST',
             url     :	url,
             data    :   {
                 offset		:   0,
                 limit		:   99999,
                 method		:   'read',
                 type		:   'list',
                 detail		:   'body',
                 query		:   $('#query').val(),
                 params		:   { },
                 securityToken	:   securityToken,
                 dateRangeStart	:   dateRangeStart,
                 dateRangeEnd	:   dateRangeEnd,
                 dateRangeType	:   dateRangeType,
                 dateRangeExtraType	:   dateRangeExtraType
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
	function ajaxQuerySearchAllDateRange(url, securityToken) {
        ajaxQuerySearchAllDate(url, securityToken,$('#dateRangeStart').val(),$('#dateRangeEnd').val(),'between',''); 
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
	function showFormUpdate(url, securityToken, raceId) {
		// unlimited for searching because  lazy paging.
                $('a[rel=tooltip]').tooltip('hide');  
		$.ajax({
    				type	: 	'POST',
    				url		:	url,
					data	: 	{
									method: 'read',
									type: 'form',
									raceId: raceId,
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
	function showModalDelete(raceId,raceSequence,raceCode,raceDesc) {
		// clear first old record if exist
		$('#raceIdPreview').val('');
		$('#raceIdPreview').val(unescape(raceId));

		$('#raceSequencePreview').val('');
		$('#raceSequencePreview').val(unescape(raceSequence));

		$('#raceCodePreview').val('');
		$('#raceCodePreview').val(unescape(raceCode));

		$('#raceDescPreview').val('');
		$('#raceDescPreview').val(unescape(raceDesc));

		// open modal box
		showMeModal('deletePreview', 1);
	}
	function deleteGridRecord(url, securityToken,urlList) {
         $.ajax({
             type    : 	'POST',
             url     : 	url,
             data    :   {
                 method				:   'delete',
                 output				:   'json',
                 raceId	:   $('#raceIdPreview').val(),
                 securityToken                   :   securityToken
             },
             beforeSend: function () {
                 // this is where we append a loading image
                 $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
             },
             success: function (data) {
                 // successful request; do something with the data
                 if (data.success == true) {
                     showMeModal('deletePreview',0);
                     showGrid(urlList,securityToken,0,14,'Record have beend deleted'); 
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
     function deleteGridRecordCheckbox(url,securityToken,urlList) { 
         var stringText='';
         var counter = 0; 
         $('input:checkbox[name="raceId[]"]').each( function() {
             stringText=stringText+"&raceId[]="+$(this).val();  
         });
//       $('input:checkbox[name="isDraft[]"]').each( function() { 
//           if($(this).is(':checked')) {
//               stringText=stringText+"&isDraft[]=true";
//           }else {
//               stringText=stringText+"&isDraft[]=false";
//           }
//           if($(this).is(':checked')) {
//               counter++;
//           }
//       });
//      $('input:checkbox[name="isDefault[]"]').each( function() { 
//           if($(this).is(':checked')) {
//               stringText=stringText+"&isDefault[]=true";
//           }else {
//               stringText=stringText+"&isDefault[]=false";
//           }
//           if($(this).is(':checked')) {
//               counter++;
//           }
//       });
//     $('input:checkbox[name="isNew[]"]').each( function() { 
//           if($(this).is(':checked')) {
//               stringText=stringText+"&isNew[]=true";
//           }else {
//               stringText=stringText+"&isNew[]=false";
//           }
//           if($(this).is(':checked')) {
//               counter++;
//           }
//     });
//     $('input:checkbox[name="isUpdate[]"]').each( function() { 
//           if($(this).is(':checked')) {
//               stringText=stringText+"&isUpdate[]=true";
//           }else {
//               stringText=stringText+"&isUpdate[]=false";
//           }
//           if($(this).is(':checked')) {
//               counter++;
//           }
//     });
    $('input:checkbox[name="isDelete[]"]').each( function() {
         // to cater old code extjs
         if($(this).is(':checked')) {
             stringText=stringText+"&isDelete[]=true";
         }else {
             stringText=stringText+"&isDelete[]=false";
         }
         if($(this).is(':checked')) {
             counter++;
         }
     });
//   $('input:checkbox[name="isActive[]"]').each( function() { 
//       if($(this).is(':checked')) {
//           stringText=stringText+"&isActive[]=true";
//       }else {
//         stringText=stringText+"&isActive[]=false";
//       }
//       if($(this).is(':checked')) {
//         counter++;
//       }
//    });
//    $('input:checkbox[name="isReview[]"]').each( function() { 
//       if($(this).is(':checked')) {
//           stringText=stringText+"&isReview[]=true";
//       }else {
//         stringText=stringText+"&isReview[]=false";
//       }
//       if($(this).is(':checked')) {
//         counter++;
//       }
//     });
//    $('input:checkbox[name="isPost[]"]').each( function() { 
//       if($(this).is(':checked')) {
//           stringText=stringText+"&isPost[]=true";
//       }else {
//           stringText=stringText+"&isPost[]=false";
//       }
//       if($(this).is(':checked')) {
//           counter++;
//       }
//    });
      if(counter == 0 ) {
         alert("You must at least check one record for delete record")
         return false;
      } else {
         url = url + "?"+stringText;
      }
     $.ajax({
         type	: 	'GET',
         url		: 	url,
         data	:	{
             method          :   'updateStatus',
             output          :	'json',
             securityToken   : 	securityToken
         },
         beforeSend: function () {
             // this is where we append a loading image
             $('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');
         }, 
         success: function (data) {
             // successful request; do something with the data
             if (data.success == true) {
                 showGrid(urlList,securityToken,0,14,'Record have been deleted'); 
             } else if (data.success == false) {
                 $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
             }else {
                 $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
             }
         },
         error: function (data) {
             // failed request; give feedback to user
             if (data.success == false) {
                 $('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');
             } else{
                 $('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');
             }
         }
     });
 }
 function auditRecord(url, securityToken) {
     var css = $('#auditRecordButton').attr('class');
     if (css.search('disabled') > 0) {
         return false;   
     } else { return false;    }
 }
 function newRecord(url, securityToken, type) {
 var css = $('#newRecordButton2').attr('class');
        
 if (css.search('disabled') > 0) {
 return false;
        
 } else {
 if (type == 1) {
    // new record and continue
	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

				} else {
					$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
					$.ajax({
						type	: 	'POST',
						url		: 	url,
						data	:	{
							method					:	'create',
							output					:	'json',
							raceSequence					: 	$('#raceSequence').val(),
							raceCode					: 	$('#raceCode').val(),
							raceDesc					: 	$('#raceDesc').val(),
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
								$('#raceSequence').val('');
								$('#raceCode').val('');
								$('#raceDesc').val('');
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
	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

				} else {
					$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
					$.ajax({
						type	:	'POST',
						url		: 	url,
						data	: 	{
							method					:	'create',
							output					:	'json',
							raceSequence					: 	$('#raceSequence').val(),
							raceCode					: 	$('#raceCode').val(),
							raceDesc					: 	$('#raceDesc').val(),
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
$('#raceId').val(data.raceId); 
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
	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

        		} else {
            		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            			$.ajax({
                		type	: 	'POST',
                		url		: 	url,
                		data	:	{
                    		method					:	'create',
							output					:	'json',
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
								$('#raceSequence').val('');
								$('#raceCode').val('');
								$('#raceDesc').val('');
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
	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

        } else {
            $('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            $.ajax({
                type	: 	'POST',
                url	: 	url,
                data	:	{
                		method					:	'create',
							output					:	'json',
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
$('#raceId').val(data.raceId); 
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
	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

        		} else {
            		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
            		$.ajax({
                		type	:	'POST',
                		url		: 	url,
                		data	: 	{
                    		method					:	'create',
							output					:	'json',
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceId First</div>');
					$('#raceId').addClass('control-group error');
					$('#raceId').focus();

	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

       		} else {
          		$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
          		$.ajax({
             			type	:	'POST',
            				url		: 	url,
              			data	: 	{
                 			method: 'save',
							output					:	'json',
                					raceId: $('#raceId').val(),
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
$('#deleteRecordButton').removeClass(); 
$('#deleteRecordButton').addClass('btn btn-danger'); 
$('#deleteRecordButton').attr('onClick', "deleteRecord(\""+url+"\",\""+securityToken+"\")"); 
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
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceId First</div>');
					$('#raceId').addClass('control-group error');
					$('#raceId').focus();

	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

    				} else {
        				$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
        				$.ajax({
        						type	: 	'POST',
         					url		: 	url,
								data	:	{
									method					:	'save',
							output					:	'json',
                					raceId: $('#raceId').val(),
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
$('#deleteRecordButton').removeClass(); 
$('#deleteRecordButton').addClass('btn btn-danger'); 
$('#deleteRecordButton').attr('onClick', "deleteRecord(\""+url+"\",\""+securityToken+"\")"); 
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
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceId First</div>');
					$('#raceId').addClass('control-group error');
					$('#raceId').focus();

	if ($('#raceSequence').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceSequence First</div>');
					$('#raceSequence').addClass('control-group error');
					$('#raceSequence').focus();

	} else if ($('#raceCode').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceCode First</div>');
					$('#raceCode').addClass('control-group error');
					$('#raceCode').focus();

	} else if ($('#raceDesc').val().length == 0) {
 				$('#infoPanel').html('<div class=alert alert-error>Please Choose raceDesc First</div>');
					$('#raceDesc').addClass('control-group error');
					$('#raceDesc').focus();

    					} else {
       					$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');
							$.ajax({
            					type: 'POST',
            					url: url,
            					data: {
                					method: 'save',
							output					:	'json',
                					raceId: $('#raceId').val(),
                					raceSequence: $('#raceSequence').val(),
                					raceCode: $('#raceCode').val(),
                					raceDesc: $('#raceDesc').val(),
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
$('#deleteRecordButton').removeClass(); 
$('#deleteRecordButton').addClass('btn btn-danger'); 
$('#deleteRecordButton').attr('onClick', "deleteRecord(\""+url+"\",\""+securityToken+"\")"); 
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
                 if(confirm('Are you sure delete the selected item ?')) { 
			
                     var value=$('#raceId').val(); 
                     if(!value) {
                         $('#infoPanel').html('<div class=alert alert-info>Please Contact Administrator</div>');
                     } else { 
                         $.ajax({
    				type	:	'POST',
    				url		: 	url,
    				data	: 	{
        				method				:	'delete',
							output					:	'json',
        				raceId	: 	$('#raceId').val(),
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
								$('#raceId').val('');
								$('#raceSequence').val('');
								$('#raceCode').val('');
								$('#raceDesc').val('');
								$('#executeBy').val('');
								$('#executeTime').val('');
	$('#newRecordButton1').removeClass(); 
	$('#newRecordButton2').removeClass(); 
	$('#newRecordButton1').addClass('btn btn-success'); 
	$('#newRecordButton2').addClass('btn btn-success dropdown-toggle'); 
	$('#newRecordButton1').attr('onClick', ''); 
	$('#newRecordButton2').attr('onClick', ''); 
	$('#newRecordButton3').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton4').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton5').attr('onClick', "newecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton6').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton7').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#updateRecordButton1').removeClass(); 
	$('#updateRecordButton2').removeClass(); 
	$('#updateRecordButton3').removeClass(); 
	$('#updateRecordButton4').removeClass(); 
	$('#updateRecordButton5').removeClass(); 
	$('#updateRecordButton1').addClass('btn btn-info disabled'); 
	$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); 
	$('#updateRecordButton1').attr('onClick', ''); 
	$('#updateRecordButton2').attr('onClick', ''); 
	$('#updateRecordButton3').attr('onClick', ''); 
	$('#updateRecordButton4').attr('onClick', ''); 
	$('#updateRecordButton5').attr('onClick', ''); 
	$('#deleteRecordButton').removeClass(); 
	$('#deleteRecordButton').addClass('btn btn-danger disabled'); 
	$('#deleteRecordButton').attr('onClick',''); 
	$('#postRecordButton').removeClass(); 
	$('#postRecordButton').addClass('btn btn-info'); 
	$('#postRecordButton').attr('onClick',''); 
	$('firstFirst').removeClass(); 
	$('firstFirst').addClass(); 
	$('firstFirst').attr('onClick', "firstRecord(\""+url+"\",\""+securityToken+"\")"); 
	$('#movePrevious').removeClass(); 
	$('#movePrevious').attr('onClick',''); 
	$('moveNext').removeClass(); 
	$('movePrevious').attr('onClick',''); 
	$('lastRecord').removeClass(); 
	$('lastRecord').addClass(); 
	$('lastRecord').attr('onClick',"lastRecord(\""+url+"\",\""+securityToken+"\")"); 
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
                 } else { 
		return false; 
		} 
		}
	}
	function resetRecord(url,securityToken) {
	$('#newRecordButton1').removeClass(); 
	$('#newRecordButton2').removeClass(); 
	$('#newRecordButton1').addClass('btn btn-success'); 
	$('#newRecordButton2').addClass('btn dropdown-toggle btn-success'); 
	$('#newRecordButton1').attr('onClick', ''); 
	$('#newRecordButton2').attr('onClick', ''); 
	$('#newRecordButton3').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton4').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton5').attr('onClick', "newecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton6').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#newRecordButton7').attr('onClick', "newRecord(\""+url+"\",\""+securityToken+"\",\""+1+"\")"); 
	$('#updateRecordButton1').removeClass(); 
	$('#updateRecordButton2').removeClass(); 
	$('#updateRecordButton3').removeClass(); 
	$('#updateRecordButton4').removeClass(); 
	$('#updateRecordButton5').removeClass(); 
	$('#updateRecordButton1').addClass('btn btn-info disabled'); 
	$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); 
	$('#updateRecordButton1').attr('onClick', ''); 
	$('#updateRecordButton2').attr('onClick', ''); 
	$('#updateRecordButton3').attr('onClick', ''); 
	$('#updateRecordButton4').attr('onClick', ''); 
	$('#updateRecordButton5').attr('onClick', ''); 
	$('#deleteRecordButton').removeClass(); 
	$('#deleteRecordButton').addClass('btn btn-danger disabled'); 
	$('#deleteRecordButton').attr('onClick',''); 
	$('#postRecordButton').removeClass(); 
	$('#postRecordButton').addClass('btn btn-info'); 
	$('#postRecordButton').attr('onClick',''); 
	$('firstFirst').removeClass(); 
	$('firstFirst').addClass(); 
	$('firstFirst').attr('onClick', "firstRecord(\""+url+"\",\""+securityToken+"\")"); 
	$('#movePrevious').removeClass(); 
	$('#movePrevious').attr('onClick',''); 
	$('moveNext').removeClass(); 
	$('movePrevious').attr('onClick',''); 
	$('lastRecord').removeClass(); 
	$('lastRecord').addClass(); 
	$('lastRecord').attr('onClick',"lastRecord(\""+url+"\",\""+securityToken+"\")"); 
								$('#raceId').val('');
								$('#raceSequence').val('');
								$('#raceCode').val('');
								$('#raceDesc').val('');
								$('#executeBy').val('');
								$('#executeTime').val('');
	}
	function postRecord() {
		var css = $('#postRecordButton').attr('class');
		if (css.search('disabled') > 0) {
                 return false;  
		} else {
                 return false;  
		}
	}
	function firstRecord(url, securityToken) {
		var css = $('#firstRecordButton').attr('class');
		if (css.search('disabled') > 0) {
			return false;  
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
                    			raceId	: 	data.firstRecord,
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
		$('#raceId').val(data.data.raceId);
		$('#raceSequence').val(data.data.raceSequence);
		$('#raceCode').val(data.data.raceCode);
		$('#raceDesc').val(data.data.raceDesc);
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
                 return false;
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
                        		raceId	: 	data.lastRecord,
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
		$('#raceId').val(data.data.raceId);
		$('#raceSequence').val(data.data.raceSequence);
		$('#raceCode').val(data.data.raceCode);
		$('#raceDesc').val(data.data.raceDesc);
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
     	return false;
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
               			raceId	: 	$('#previousRecord').val(),
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
		$('#raceId').val(data.data.raceId);
		$('#raceSequence').val(data.data.raceSequence);
		$('#raceCode').val(data.data.raceCode);
		$('#raceDesc').val(data.data.raceDesc);
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
                 return false;  
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
              		raceId	: 	$('#nextRecord').val(),
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
		$('#raceId').val(data.data.raceId);
		$('#raceSequence').val(data.data.raceSequence);
		$('#raceCode').val(data.data.raceCode);
		$('#raceDesc').val(data.data.raceDesc);
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
