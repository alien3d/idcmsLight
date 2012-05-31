<?php	// calculate total field to loop
		$total = count($data);
		// initilize dummy value
		$fieldName='';
		for ($i = 0; $i < $total; $i++) {
			// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$fieldName.=$data[$i]['columnName'].",";
			}
		
		} 
		$fieldName= substr($fieldName,0,-1);
		$str.="	function showGrid(page, securityToken, offset, limit) {\n";
		$str.="		\$.ajax({\n";
		$str.="			type	: 	'POST',\n";
		$str.="			url		: 	page,\n";
		$str.="			data	: 	{\n";
		$str.="				offset			: 	offset,\n";
		$str.="				limit			: 	limit,\n";
		$str.="				method			: 	'read',\n";
		$str.="				type			: 	'list',\n";
		$str.="				detail			: 	'body',\n";
		$str.="				params			: 	{},\n";
		$str.="				securityToken	:	securityToken\n";
		$str.="			},\n";
		$str.="			beforeSend: function () {\n";
		$str.="				// this is where we append a loading image\n";
		$str.="				\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="			},\n";
		$str.="			success: function (data) {\n";
		$str.="				// successful request; do something with the data\n";
		$str.="				\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="				\$('#centerViewport').html('');\n";
		$str.="				\$('#centerViewport').empty();\n";
		$str.="				\$('#centerViewport').removeClass();\n";
		$str.="				\$('#centerViewport').addClass('container-fluid');\n";
		$str.="				\$('#centerViewport').append(data);\n";
		$str.="			},\n";
		$str.="				error: function () {\n";
		$str.="				// failed request; give feedback to user\n";
		$str.="				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="			}\n";
		$str.="		});\n";
		$str.="	}\n";
		$str.="	function ajaxQuerySearchAll(url, securityToken) {\n";
		$str.="		// unhide button search\n";
		$str.="		\$('#clearSearch').removeClass();\n";
		$str.="		\$('#clearSearch').addClass('btn');\n";
		$str.="		// unlimited for searching because  lazy paging.\n";
		$str.="		\$.ajax({\n";
		$str.="    			type	: 	'POST',\n";
		$str.="    			url		:	url,\n";
		$str.="    			data	: 	{\n";
		$str.="        				offset			: 	0,\n";
		$str.="        				limit			: 	99999,\n";
		$str.="						method			:	'read',\n";
		$str.="						type			: 	'list',\n";
		$str.="						detail			: 	'body',\n";
		$str.="						query			: 	\$('#query').val(),\n";
		$str.="						params			: 	{ },\n";
		$str.="						securityToken	:	securityToken\n";
		$str.="				},\n";
		$str.="				beforeSend: function () {\n";
		$str.="					// this is where we append a loading image\n";
		$str.="					\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="				},\n";
		$str.="				success: function (data) {\n";
		$str.="					// successful request; do something with the data\n";
		$str.="					\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="					\$('#centerViewport').html('');\n";
		$str.="					\$('#centerViewport').empty();\n";
		$str.="					\$('#centerViewport').removeClass();\n";
		$str.="					\$('#centerViewport').addClass('container-fluid');\n";
		$str.="					\$('#centerViewport').append(data);\n";
		$str.="				},\n";
		$str.="				error: function () {\n";
		$str.="					// failed request; give feedback to user\n";
		$str.="					\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="				}\n";
		$str.="		});\n";
		$str.="	}\n";
		$str.="	function showForm(url, securityToken) {\n";
		$str.="		// unlimited for searching because  lazy paging.\n";
		$str.="		\$.ajax({\n";
		$str.="			type: 'POST',\n";
		$str.="			url: url,\n";
		$str.="			data: {\n";
		$str.="					method: 'new',\n";
		$str.="					type: 'form',\n";
		$str.="					securityToken: securityToken\n";
		$str.="			},\n";
		$str.="			beforeSend: function () {\n";
		$str.="				// this is where we append a loading image\n";
		$str.="				\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="			},\n";
		$str.="			success: function (data) {\n";
		$str.="				// successful request; do something with the data\n";
		$str.="				\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="				\$('#centerViewport').html('');\n";
		$str.="				\$('#centerViewport').empty();\n";
		$str.="				\$('#centerViewport').removeClass();\n";
		$str.="				\$('#centerViewport').addClass('container-fluid');\n";
		$str.="				\$('#centerViewport').append(data);\n";
		$str.="			},\n";
		$str.="			error: function () {\n";
		$str.="				// failed request; give feedback to user\n";
		$str.="				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="			}\n";
		$str.="		});\n";
		$str.="	}\n";
		$str.="	function showFormUpdate(url, securityToken, " . $data[0]['tableName'] . "Id) {\n";
		$str.="		// unlimited for searching because  lazy paging.\n";
		$str.="		\$.ajax({\n";
		$str.="    				type	: 	'POST',\n";
		$str.="    				url		:	url,\n";
		$str.="					data	: 	{\n";
		$str.="									method: 'read',\n";
		$str.="									type: 'form',\n";
		$str.="									" . $data[0]['tableName'] . "Id: " . $data[0]['tableName'] . "Id,\n";
		$str.="									securityToken: securityToken\n";
		$str.="					},\n";
		$str.="					beforeSend: function () {\n";
		$str.="						// this is where we append a loading image\n";
		$str.="						\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="					},\n";
		$str.="					success: function (data) {\n";
		$str.="						// successful request; do something with the data\n";
		$str.="						\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="						\$('#centerViewport').html('');\n";
		$str.="						\$('#centerViewport').empty();\n";
		$str.="						\$('#centerViewport').removeClass();\n";
		$str.="						\$('#centerViewport').addClass('container-fluid');\n";
		$str.="						\$('#centerViewport').append(data);\n";
		$str.=					"},\n";
		$str.="					error: function () {\n";
		$str.="						// failed request; give feedback to user\n";
		$str.="						\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="					}\n";
		$str.="				});\n";
		$str.="	}\n";
		$str.="	function showModalDelete(".$fieldName.") {\n";
		$str.="		// clear first old record if exist\n";
		for ($i = 0; $i < $total; $i++) {
			// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="		\$('#".$data[$i]['columnName']."Preview').val('');\n";
				// decode back
				$str.="		\$('#".$data[$i]['columnName']."Preview').val(unescape(".$data[$i]['columnName']."));\n\n";
			}
		}
		$str.="		// open modal box\n";
		$str.="		showMeModal('deletePreview', 1);\n";
		$str.="	}\n";
		$str.="	function deleteGridRecord(url, securityToken) {\n";
		$str.="		\$.ajax({\n";
		$str.="    				type	: 	'POST',\n";
		$str.="    				url		: 	url,\n";
		$str.="   				data	:	{\n";
		$str.="        					method				:	'delete',\n";
		$str.="        					output				:	'json',\n";
		$str.="        					" . $data[0]['tableName'] . "Id	: 	\$('#" . $data[0]['tableName'] . "IdPreview').val(),\n";
		$str.="        					securityToken		: 	securityToken\n";
		$str.="    				},\n";
		$str.="					beforeSend: function () {\n";
		$str.="        				// this is where we append a loading image\n";
		$str.="       				\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="    				},\n";
		$str.="    				success: function (data) {\n";
		$str.="        				// successful request; do something with the data\n";
		$str.="        				if (data.success == true) {\n";
		$str.="            				\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="        				} else if (data.success == false) {\n";
		$str.="            				\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
		$str.="        				}\n";
		$str.="    				},\n";
		$str.="					error: function (data) {\n";
		$str.="        				// failed request; give feedback to user\n";
		$str.="						if (data.success == false) {\n";
		$str.="            				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="        				}\n";
		$str.="    				}\n";
		$str.="				});\n";
		$str.="		}\n";
		$str.="	function auditRecord(url, securityToken) {\n";
		$str.="		var css = \$('#auditRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
		$str.="			// access denied  \n";
		$str.="		}	 else {}\n";
		$str.="	}\n";
		$str.="	function newRecord(url, securityToken, type) {\n";
		$str.="		var css = \$('#newRecordButton2').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
		$str.="			// access denied\n";  
		$str.="		} else {\n";
		$str.="			if (type == 1) {\n";
		$str.="				// new record and continue\n";
		 $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session and id don't exist yet..
				// extjs generate phantom id instead
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="				} else {\n";
		$str.="					\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="					\$.ajax({\n";
		$str.="						type	: 	'POST',\n";
		$str.="						url		: 	url,\n";
		$str.="						data	:	{\n";
		$str.="							method					:	'create',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
				// filter unnessary field to create a new record
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="							".$data[$i]['columnName']."					: 	\$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
		$str.="							securityToken			: 	securityToken\n";
		$str.="						},\n";
		$str.="						beforeSend: function () {\n";
		$str.="							// this is where we append a loading image\n";
		$str.="							\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="                		},\n";
		$str.="						success: function (data) {\n";
		$str.="							// successful request; do something with the data\n";
		$str.="							if (data.success == true) {\n";
		$str.="								\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="								// reseting field value\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
		$str.="							} else if (data.success == false) {\n";
		$str.="								\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
		$str.="							}\n";
		$str.="						},\n";
		$str.="						error: function (data) {\n";
		$str.="							// failed request; give feedback to user\n";
		$str.="							if (data.success == false) {\n";
		$str.="								\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="							}\n";
		$str.="						}\n";
		$str.="					});\n";
		$str.="				}\n";
		$str.="			} else if (type == 2) {\n";
		$str.="				// new record and update\n";
		$str.="				// new record and continue\n";
		$d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="				} else {\n";
		$str.="					\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="					\$.ajax({\n";
		$str.="						type	:	'POST',\n";
		$str.="						url		: 	url,\n";
		$str.="						data	: 	{\n";
		$str.="							method					:	'create',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="							".$data[$i]['columnName']."Id					: 	\$('#".$data[$i]['columnName']."Id').val(),\n";
			}
		}
		$str.="							securityToken			:	securityToken\n";
		$str.="						},\n";
		$str.="						beforeSend: function () {\n";
		$str.="							// this is where we append a loading image\n";
		$str.="							\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="						},\n";
		$str.="						success: function (data) {\n";
		$str.="							// successful request; do something with the data\n";
		$str.="							if (data.success == true) {\n";
		$str.="								\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		// no need to reset . can continue update the record
		//$str.="								// reseting field value\n";
		
		$str.="							}\n";
		$str.="						},\n";
		$str.="                		error: function (data) {\n";
		$str.="                    		// failed request; give feedback to user\n";
		$str.="                    		if (data.success == false) {\n";
		$str.="                        		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                    		}\n";
		$str.="                		}\n";
		$str.="            		});\n";
		$str.="        		}\n";
		$str.="    		} else if (type == 3) {\n";
		$str.="        		// new record and continue and print/preview(Open modal box)\n";
		$str.="        		// new record and continue\n";
		 $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="        		} else {\n";
		$str.="            		\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="            			\$.ajax({\n";
		$str.="                		type	: 	'POST',\n";
		$str.="                		url		: 	url,\n";
		$str.="                		data	:	{\n";
		$str.="                    		method					:	'create',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
		$str.="                    		securityToken			: 	securityToken\n";
		$str.="                		},\n";
		$str.="                		beforeSend: function () {\n";
		$str.="                    		// this is where we append a loading image\n";
		$str.="                    		\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="                		},\n";
		$str.="                		success: function (data) {\n";
		$str.="                    		// successful request; do something with the data\n";
		$str.="                    		if (data.success == true) {\n";
		$str.="                        		\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="                        		// reseting field value\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
		if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
		$str.="                    		}\n";
		$str.="                		},\n";
		$str.="                		error: function (data) {\n";
		$str.="                    		// failed request; give feedback to user\n";
		$str.="                    		if (data.success == false) {\n";
		$str.="                        		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                    		}\n";
		$str.="                		}\n";
		$str.="            		});\n";
		$str.="        		}\n";
		$str.="    		} else if (type == 4) {\n";
		$str.="        		// new record and update and  print/preview(open modal box)\n";
		$str.="        		// new record and continue\n";
		 $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="        } else {\n";
		$str.="            \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="            \$.ajax({\n";
		$str.="                type	: 	'POST',\n";
		$str.="                url	: 	url,\n";
		$str.="                data	:	{\n";
		$str.="                		method					:	'create',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
					$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
		$str.="                    	securityToken			: 	securityToken\n";
		$str.="					},\n";
		$str.="					beforeSend: function () {\n";
		$str.="                 	// this is where we append a loading image\n";
		$str.="                    	\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="                	},\n";
		$str.="                	success: function (data) {\n";
		$str.="                    // successful request; do something with the data\n";
		$str.="                    if (data.success == true) {\n";
		$str.="                        \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		// no need to reset value
		//$str.="                        // reseting field value\n";
		
		$str.="                    }\n";
		$str.="                	},\n";
		$str.="                	error: function (data) {\n";
		$str.="                 	// failed request; give feedback to user\n";
		$str.="                    	if (data.success == false) {\n";
		$str.="                     	\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                    	}\n";
		$str.="                			}\n";
		$str.="            		});\n";
		$str.="        		}\n";
		$str.="    		} else if (type == 5) {\n";
		$str.="        		// new record and listing\n";
		 $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="        		} else {\n";
		$str.="            		\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="            		\$.ajax({\n";
		$str.="                		type	:	'POST',\n";
		$str.="                		url		: 	url,\n";
		$str.="                		data	: 	{\n";
		$str.="                    		method					:	'create',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'&&
				$data[$i]['columnName'] != ($data[0]['tableName'].'Id')) {
				$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
		$str.="                    		securityToken			: 	securityToken\n";
		$str.="                		},\n";
		$str.="               		beforeSend: function () {\n";
		$str.="                    		// this is where we append a loading image\n";
		$str.="                    		\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="                		},\n";
		$str.="                		success: function (data) {\n";
		$str.="                    		// successful request; do something with the data\n";
		$str.="                    		if (data.success == true) {\n";
		$str.="                        		\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		// no need to reset record instead redirect to list page again
		$str.="                    		}	\n";
		$str.="                		},\n";
		$str.="                		error: function (data) {\n";
		$str.="                    		// failed request; give feedback to user\n";
		$str.="                    		if (data.success == false) {\n";
		$str.="                        		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                    		}\n";
		$str.="                		}\n";
		$str.="            		});\n";
		$str.="        		}\n";    
		$str.="        		showMeDiv('tableDate', 0);\n";
		$str.="        		showMeDiv('formEntry', 1);\n";
		$str.="   		}\n";
		$str.="		}\n";
		$str.="	}\n";
		$str.="	function updateRecord(url, securityToken, type) {\n";
		$str.="		var css = \$('#updateRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
		$str.="   		// access denied\n";  
		$str.="		} else {\n";
		$str.="			if (type == 1) {\n";
		$str.="        		// update record and continue\n";
		 $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
		$str.="       		} else {\n";
		$str.="          		\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
		$str.="          		\$.ajax({\n";
		$str.="             			type	:	'POST',\n";
		$str.="            				url		: 	url,\n";
		$str.="              			data	: 	{\n";
		$str.="                 			method: 'save',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
			$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
		}
		$str.="                				securityToken			:	securityToken\n";
		$str.="            				},\n";
		$str.="           				beforeSend: function () {\n";
		$str.="                				// this is where we append a loading image\n";
		$str.="                				\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="           				},\n";
		$str.="            				success: function (data) {\n";
		$str.="               				// successful request; do something with the data\n";
		$str.="               				if (data.success == true) {\n";
		$str.="                   				\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="                   				// reseting field value\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
		$str.="               				} else if (data.success == false) {\n";
        $str.="                    				\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
        $str.="                				}\n";
        $str.="            				},\n";
        $str.="            				error: function (data) {\n";
        $str.="                				// failed request; give feedback to user\n";
        $str.="                				if (data.success == false) {\n";
        $str.="                    				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="                				}\n";
        $str.="            				}\n";
        $str.="        				});\n";
        $str.="    				}\n";
        $str.="				} else if (\$type == 2) {\n";
        $str.="    				// update record  preview(modal box)\n";
        $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
        $str.="    				} else {\n";
        $str.="        				\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";  
        $str.="        				\$.ajax({\n";
        $str.="        						type	: 	'POST',\n";
        $str.="         					url		: 	url,\n";
		$str.="								data	:	{\n";
		$str.="									method					:	'save',\n";
		$str.="							output					:	'json',\n";
        for ($i = 0; $i < $total; $i++) {
					if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
			$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
        $str.="                					securityToken			: 	securityToken\n";
        $str.="            					},\n";
        $str.="            					beforeSend: function () {\n";
        $str.="                					// this is where we append a loading image\n";
        $str.="                					\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
        $str.="            					},\n";
        $str.="            					success: function (data) {\n";
        $str.="                					// successful request; do something with the data\n";
        $str.="                					if (data.success == true) {\n";
        $str.="                    					\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
        $str.="                    					// reseting field value\n";
        for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
        $str.="                					} else if (data.success == false) {\n";
        $str.="                    					\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
        $str.="                					}\n";      
        $str.="            					},\n";
        $str.="            					error: function (data) {\n";
        $str.="                					// failed request; give feedback to user\n";
        $str.="                					if (data.success == false) {\n";
        $str.="                   	 				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="                					}\n";
        $str.="            					}\n";
        $str.="        					});\n";
        $str.="    					}\n";
        $str.="					} else if (type == 3) {\n";
        $str.="    					// update record and listing\n";
         $d=0;
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				if($i ==0) {
					// first do nothing because it was primary key
				}  else if($d==0)  {
					$str.="	if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";
					$d++;
				}  else  if($d > 0 ) { 
					$str.="	} else if (\$('#".$data[$i]['columnName']."').val().length == 0) {\n";		
				} 
				$str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose ".$data[$i]['columnName']." First</div>');\n";
				$str.="					\$('#".$data[$i]['columnName']."').addClass('control-group error');\n";
				$str.="					\$('#".$data[$i]['columnName']."').focus();\n\n";					
				if($d> 0 ) { 
					$d++;
				}
			}
		}
        $str.="    					} else {\n";
        $str.="       					\$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
        $str.="							\$.ajax({\n";
        $str.="            					type: 'POST',\n";
        $str.="            					url: url,\n";
        $str.="            					data: {\n";
        $str.="                					method: 'save',\n";
		$str.="							output					:	'json',\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation'
				) {
				$str.="                					".$data[$i]['columnName'].": \$('#".$data[$i]['columnName']."').val(),\n";
			}
		}
        $str.="                					dayId: \$('#dayId').val(),\n";
        $str.="                					securityToken: securityToken\n";
        $str.="            					},\n";
        $str.="            					beforeSend: function () {\n";
        $str.="                					// this is where we append a loading image\n";
        $str.="                					\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
        $str.="            					},\n";
        $str.="            					success: function (data) {\n";
        $str.="                					// successful request; do something with the data\n";
        $str.="                					if (data.success == true) {\n";
        $str.="                    					\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
        $str.="                    					// reseting field value\n";
        for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
        $str.="                					} else if (data.success == false) {\n";
        $str.="                    					\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
        $str.="                					}\n";
        $str.="            					},\n";
        $str.="            					error: function (data) {\n";
        $str.="                					// failed request; give feedback to user\n";
        $str.="                					if (data.success == false) {\n";
        $str.="                    					\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="                					}\n";
        $str.="            					}\n";
        $str.="        					});\n";
        $str.="   					}\n";
        $str.="				}\n";
		$str.="		}\n";
		$str.="	}\n";
		$str.="	function deleteRecord(url, securityToken) {\n";
		$str.="		var css = \$('#deleteRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
        $str.="			// access denied \n"; 
		$str.="		} else {\n";
		$str.="			\n";
        $str.="			\$.ajax({\n";
        $str.="    				type	:	'POST',\n";
        $str.="    				url		: 	url,\n";
        $str.="    				data	: 	{\n";
        $str.="        				method				:	'delete',\n";
		$str.="							output					:	'json',\n";
        $str.="        				" . $data[0]['tableName'] . "Id	: 	\$('#" . $data[0]['tableName'] . "Id').val(),\n";
        $str.="        				securityToken		: 	securityToken\n";
        $str.="    				},\n";
        $str.="    				beforeSend: function () {\n";
        $str.="        				// this is where we append a loading image\n";
        $str.="        				\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
        $str.="    				},\n";
        $str.="    				success: function (data) {\n";
        $str.="        				// successful request; do something with the data\n";
        $str.="        				if (data.success == true) {\n";
        $str.="            				\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
        $str.="            				// reseting field value\n";
        for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
        $str.="        				} else if (data.success == false) {\n";
        $str.="            				\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
        $str.="        				}\n";
        $str.="    				},\n";
        $str.="    				error: function (data) {\n";
        $str.="        				// failed request; give feedback to user\n";
        $str.="       		 		if (data.success == false) {\n";
        $str.="            				\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="        				}\n";
        $str.="    				}\n";
        $str.="				});\n";
		$str.="			}\n";
		$str.="	}\n";
		$str.="	function resetRecord() {\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="								\$('#".$data[$i]['columnName']."').val('');\n";
			}
		}
		$str.="	}\n";
		$str.="	function postRecord() {\n";
		$str.="		var css = \$('#postRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
        $str.="			// access denied  \n";
		$str.="		} else {\n";
        $str.="			// access granted  \n";
		$str.="		}\n";
		$str.="	}\n";
		$str.="	function firstRecord(url, securityToken) {\n";
		$str.="		var css = \$('#firstRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
        $str.="			// access denied  \n";
		$str.="		} else {\n";
        $str.="			\$.ajax({\n";
        $str.="    			type	: 'GET',\n";
        $str.="    			url		: url,\n";
        $str.="    			data	: {\n";
        $str.="        			method			:	'dataNavigationRequest',\n";
        $str.="        			dataNavigation	: 	'firstRecord',\n";
        $str.="        			output			: 	'json',\n";
        $str.="        			securityToken	: 	securityToken\n";
        $str.="    			},\n";
        $str.="    			beforeSend: function () {\n";
        $str.="        			// this is where we append a loading image\n";
        $str.="        			\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
        $str.="    			},\n";
        $str.="    			success: function (data) {\n";
        $str.="        			// successful request; do something with the data\n";
        $str.="        			if (data.success == true) {\n";
        $str.="            			\$.ajax({\n";
        $str.="                			type	: 	'POST',\n";
        $str.="               			url		: 	url,\n";
        $str.="                			data	:	{\n";
        $str.="                    			method				:	'read',\n";
        $str.="                    			" . $data[0]['tableName'] . "Id	: 	data.firstRecord,\n";
        $str.="                    			output				: 	'json',\n";
        $str.="                    			securityToken		: 	securityToken\n";
        $str.="                			},\n";
        $str.="                			beforeSend: function () {\n";
        $str.="                    			// this is where we append a loading image\n";
        $str.="                    			\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
        $str.="                			},\n";
        $str.="                			success: function (data) {\n";
        $str.="                    			// successful request; do something with the data\n";
        $str.="                    			if (data.success == true) {\n";
        $str.="                        			\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
        $str.="                        			// reseting field value\n";
        for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="		\$('#".$data[$i]['columnName']."').val(data.data.".$data[$i]['columnName'].");\n";	
			}
		}
        $str.="                        			if (data.nextRecord > 0) {\n";
        $str.="                            			\$('#previousRecordButton').removeClass();\n";
        $str.="                            			\$('#previousRecordButton').addClass('btn btn-info  disabled');\n";
        $str.="                            			\$('#nextRecordButton').removeClass();\n";
        $str.="                            			\$('#nextRecordButton').addClass('btn btn-info');\n";
		$str.="										\$('#firstRecord').val(data.firstRecord);\n";
        $str.="                            			\$('#previousRecord').val(data.previousRecord);\n";
        $str.="                           			\$('#nextRecord').val(data.nextRecord);\n";
        $str.="                           			\$('#lastRecord').val(data.lastRecord);\n";
        $str.="                       			}\n";
        $str.="                   			}\n";
        $str.="               			},\n";
        $str.="               			error: function (data) {\n";
        $str.="                   			// failed request; give feedback to user\n";
        $str.="                  			if (data.success == false) {\n";
        $str.="                      			\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="                 			}\n";
        $str.="              			}\n";
        $str.="         			});\n";
        $str.="    				} else {\n";
        $str.="       				\$('#infoPanel').html('<div class=alert alert-error>' + data.message + 'l</div>');\n";
        $str.="   				}\n";
        $str.="				},\n";
        $str.="			error: function (data) {\n";
        $str.="   			// failed request; give feedback to user\n";
        $str.="    			if (data.success == false) {\n";
        $str.="        			\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
        $str.="   			}\n";
        $str.="			}\n";
        $str.="		});\n";
		$str.="		}\n";
		$str.="	}\n";
		$str.="	function lastRecord(url, securityToken) {\n";
		$str.="		var css = \$('#lastRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
		$str.="   		// access denied\n";  
		$str.="		} else {\n";
		$str.="   		\$.ajax({\n";
		$str.="       		type	:	'GET',\n";
		$str.="       		url		: 	url,\n";
		$str.="      		data	: 	{\n";
		$str.="          		method: 'dataNavigationRequest',\n";
		$str.="          		dataNavigation: 'lastRecord',\n";
		$str.="          		output: 'json',\n";
		$str.="          		securityToken: securityToken\n";
		$str.="        		},\n";
		$str.="       		beforeSend: function () {\n";
		$str.="          		// this is where we append a loading image\n";
		$str.="           		\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="      		},\n";
		$str.="      		success: function (data) {\n";
		$str.="            		// successful request; do something with the data\n";
		$str.="            		if (data.success == true) {\n";
		$str.="                		\$.ajax({\n";
		$str.="                    		type	: 	'POST',\n";
		$str.="                   		url		: 	url,\n";
		$str.="                   		data	:	{\n";
		$str.="                        		method				: 	'read',\n";
		$str.="                        		" . $data[0]['tableName'] . "Id	: 	data.lastRecord,\n";
		$str.="                       		output				: 	'json',\n";
		$str.="                       		securityToken		:	securityToken\n";
		$str.="                    		},\n";
		$str.="                    		beforeSend: function () {\n";
		$str.="                       		// this is where we append a loading image\n";
		$str.="                        		\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="                   		},\n";
		$str.="                   		success: function (data) {\n";
		$str.="                        		// successful request; do something with the data\n";
		$str.="                       		if (data.success == true) {\n";
		$str.="                          		 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		$str.="                           		// reseting field value\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="		\$('#".$data[$i]['columnName']."').val(data.data.".$data[$i]['columnName'].");\n";	
			}
		}
		$str.="                            		if (data.lastRecord != 0) {\n";
		$str.="                               		\$('#previousRecordButton').removeClass();\n";
		$str.="                                		\$('#previousRecordButton').addClass('btn btn-info');\n";
		$str.="                               		\$('#nextRecordButton').removeClass();\n";
		$str.="                                		\$('#nextRecordButton').addClass('btn btn-info disabled');\n";
		$str.="                               		\$('#firstRecord').val(data.firstRecord);\n";
		$str.="                               		\$('#previousRecord').val(data.previousRecord);\n";
		$str.="                               		\$('#nextRecord').val(data.nextRecord);\n";
		$str.="                                		\$('#lastRecord').val(data.lastRecord);\n";
		$str.="                           		}\n";
		$str.="                       		}\n";
		$str.="                   		},\n";
		$str.="                   		error: function (data) {\n";
		$str.="                        		// failed request; give feedback to user\n";
		$str.="                       		if (data.success == false) {\n";
		$str.="                           		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                       		}\n";
		$str.="                  		}\n";
		$str.="              		});\n";
		$str.="           		} else {\n";
		$str.="              		\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
		$str.="            		}\n";
		$str.="        		},\n";
		$str.="       		error: function (data) {\n";
		$str.="           		// failed request; give feedback to user\n";
		$str.="           		if (data.success == false) {\n";
		$str.="              	 	\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="           		}\n";
		$str.="       		}\n";
		$str.="    		});\n";
		$str.="		}\n";
		$str.="	}\n";
		$str.="	function previousRecord(url, securityToken) {\n";
		$str.=" 	var css = \$('#previousRecordButton').attr('class');\n";
		$str.="   	if (css.search('disabled') > 0) {\n";
		$str.="     	// access denied\n";  
		$str.="   	} else {\n";
		$str.="      	\$('#newButton').removeClass();\n";
		$str.="       	if (\$('#previousRecord').val() == '' || \$('#previousRecord').val() == undefined) {\n";
		$str.="         	\$('#infoPanel').html('<div class=alert alert-error>testingo</div>');\n";
		$str.="     	}\n";
		$str.="       	if (parseFloat(\$('#previousRecord').val()) > 0 && parseFloat(\$('#previousRecord').val()) < parseFloat(\$('#lastRecord').val())) {\n";
		$str.="         	\$.ajax({\n";
		$str.="             		type	:	'POST',\n";
		$str.="             		url		: 	url,\n";
		$str.="            			data	: 	{\n";
		$str.="               			method				: 	'read',\n";
		$str.="               			" . $data[0]['tableName'] . "Id	: 	\$('#previousRecord').val(),\n";
		$str.="               			output				: 	'json',\n";
		$str.="               			securityToken		:	securityToken\n";
		$str.="          			},\n";
		$str.="           			beforeSend: function () {\n";
		$str.="               			// this is where we append a loading image\n";
		$str.="              			\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="          			},\n";
		$str.="          			success: function (data) {\n";
		$str.="              			// successful request; do something with the data\n";
		$str.="              			if (data.success == true) {\n";
		$str.="                  			\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime'&&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="		\$('#".$data[$i]['columnName']."').val(data.data.".$data[$i]['columnName'].");\n";	
			}			
		}
		$str.="                				\$('#firstRecord').val(data.firstRecord);\n";
		$str.="                  			\$('#previousRecord').val(data.previousRecord);\n";
		$str.="                				\$('#nextRecord').val(data.nextRecord);\n";
		$str.="                 			\$('#lastRecord').val(data.lastRecord);\n";
		$str.="                 			if (parseFloat(data.nextRecord) != parseFloat(data.lastRecord)) {\n";
		$str.="                     			\$('#nextRecordButton').removeClass();\n";
		$str.="                        			\$('#nextRecordButton').addClass('btn btn-info');\n";
		$str.="                     		} else {\n";
		$str.="                        			\$('#nextRecordButton').removeClass();\n";
		$str.="                      			 \$('#nextRecordButton').addClass('btn btn-info disabled');\n";
		$str.="                    			}\n";
		$str.="                   			if (parseFloat(data.previousRecord) == 0) {\n";
		$str.="                      			\$('#previousRecordButton').removeClass();\n";
		$str.="                       			\$('#previousRecordButton').addClass('btn btn-info disabled');\n";
		$str.="                   			}\n";
		$str.="              		}\n";
		$str.="          		},\n";
		$str.="           		error: function (data) {\n";
		$str.="             		 // failed request; give feedback to user\n";
		$str.="               		if (data.success == false) {\n";
		$str.="                   		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="               		}\n";
		$str.="           		}\n";
		$str.="        		});\n";
		$str.="     	} else {\n";
		$str.="         	// debugging purpose only\n";
		$str.="       	}\n";
		$str.="   	}\n";
		$str.="	}\n";
		$str.="	function nextRecord(url, securityToken) {\n";
		$str.="		var css = \$('#nextRecordButton').attr('class');\n";
		$str.="		if (css.search('disabled') > 0) {\n";
		$str.="    		// access denied  \n";
		$str.="		} else {\n";
		$str.="    		\$('#newButton').removeClass();\n";
		$str.="    		if (\$('#nextRecord').val() == '' || \$('#nextRecord').val() == undefined) {\n";
		$str.="        		\$('#infoPanel').html('<div class=alert alert-error>sdfd</div>');\n";
		$str.="    		}\n";
		$str.="    		if (parseFloat(\$('#nextRecord').val()) < parseFloat(\$('#lastRecord').val())) {\n";
		$str.="        		\$.ajax({\n";
		$str.="             	type	:	'POST',\n";
		$str.="             	url		: url,\n";
		$str.="          		data	: {\n";
		$str.="               		method				: 	'read',\n";
		$str.="              		" . $data[0]['tableName'] . "Id	: 	\$('#nextRecord').val(),\n";
		$str.="               		output				: 	'json',\n";
		$str.="               		securityToken		:	securityToken\n";
		$str.="           		},\n";
		$str.="            		beforeSend: function () {\n";
		$str.="               		// this is where we append a loading image\n";
		$str.="               		\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
		$str.="            		},\n";
		$str.="            		success: function (data) {\n";
		$str.="                		// successful request; do something with the data\n";
		$str.="               		if (data.success == true) {\n";
		$str.="                    		\$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
		for ($i = 0; $i < $total; $i++) {
				// this field is auto update by session
			if ($data[$i]['columnName'] != 'executeBy' &&
				$data[$i]['columnName'] != 'executeTime' &&
				$data[$i]['columnName'] != 'isDefault' &&
				$data[$i]['columnName'] != 'isApproved' &&
				$data[$i]['columnName'] != 'isPost' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isNew' &&
				$data[$i]['columnName'] != 'isDraft' &&
				$data[$i]['columnName'] != 'isUpdate' &&
				$data[$i]['columnName'] != 'isDelete' &&
				$data[$i]['columnName'] != 'isActive' &&
				$data[$i]['columnName'] != 'isSeperated' &&
				$data[$i]['columnName'] != 'isSingle' &&
				$data[$i]['columnName'] != 'isReview' &&
				$data[$i]['columnName'] != 'isConsolidation') {
				$str.="		\$('#".$data[$i]['columnName']."').val(data.data.".$data[$i]['columnName'].");\n";	
			}
		}
		$str.="                    		\$('#firstRecord').val(data.firstRecord);\n";
		$str.="                    		\$('#previousRecord').val(data.previousRecord);\n";
		$str.="                    		\$('#nextRecord').val(data.nextRecord);\n";
		$str.="                   		\$('#lastRecord').val(data.lastRecord);\n";
		$str.="                    		if (parseFloat(data.previousRecord) > 0) {\n";
		$str.="                       		\$('#previousRecordButton').removeClass();\n";
		$str.="                        		\$('#previousRecordButton').addClass('btn btn-info');\n";
		$str.="                   		} else {\n";
		$str.="                        		\$('#previousRecordButton').removeClass();\n";
		$str.="                       		\$('#previousRecordButton').addClass('btn btn-info disabled');\n";
		$str.="                   		}\n";
		$str.="                   		if (parseFloat(data.nextRecord) == parseFloat('lastRecord')) {\n";
		$str.="                        		\$('#nextRecordButton').removeClass();\n";
		$str.="                         	\$('#nextRecordButton').addClass('btn btn-info disabled');\n";
		$str.="                    		}\n";
		$str.="               		}\n";
		$str.="             	},\n";
		$str.="              	error: function (data) {\n";
		$str.="                 	// failed request; give feedback to user\n";
		$str.="                 	if (data.success == false) {\n";
		$str.="                     	 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
		$str.="                  	}\n";
		$str.="              	}\n";
		$str.="           	});\n";
		$str.="        	} else {\n";
		$str.="       	}\n";
		$str.="    }\n";
		$str.="	}\n";
?>