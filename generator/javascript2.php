
<?php

// calculate total field to loop

if (isset($data)) {
    $total = count($data);
// initilize dummy value
    $fieldName = '';
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
            $fieldName.=$data[$i]['columnName'] . ",";
        }
    }
    $fieldName = substr($fieldName, 0, -1);
    
    // show grid
    $str.="	function showGrid(page, securityToken, offset, limit,message) {\n";
    $str.="         \$.ajax({\n";
    $str.="             type	:   'POST',\n";
    $str.="		url	:   page,\n";
    $str.="		data    :   {\n";
    $str.="                 offset          :   offset,\n";
    $str.="                 limit           :   limit,\n";
    $str.="                 method          : 	'read',\n";
    $str.="                 type            : 	'list',\n";
    $str.="                 detail          : 	'body',\n";
    $str.="                 params          : 	{},\n";
    $str.="                 securityToken   :	securityToken\n,";
    $str.="                 message         :	message\n";
    $str.="		},\n";
    $str.="                 beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="		},\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.="             },\n";
    $str.="             error: function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="		}\n";
    $str.="         });\n";
    $str.="	}\n";
    
    // search all record
    $str.="     function ajaxQuerySearchAll(url, securityToken) {\n";
    $str.="         // unhide button search\n";
    $str.="         \$('#clearSearch').removeClass();\n";
    $str.="         \$('#clearSearch').addClass('btn');\n";
    $str.="         // unlimited for searching because  lazy paging.\n";
    $str.="         var queryGrid =\$('#query').val();\n";
    $str.="         var queryWidget =\$('#queryWidget').val();\n";
    
    // this is possible of future if customer required more complex search. but for now as it and simple
    $str.="         if(queryGrid != undefined) { \n";
    $str.="             if(queryGrid.length > 0 ) { \n";
    $str.="                 queryText = queryGrid; \n";
    $str.="             }  else {  \n";
    $str.="                 queryText = queryWidget; \n";
    $str.="             } \n";
    $str.="         } else { \n";
    $str.="                 queryText = queryWidget; \n";
    $str.="         }\n";
    $str.="         \$.ajax({\n";
    $str.="             type    :   'POST',\n";
    $str.="             url     :	url,\n";
    $str.="             data    : 	{\n";
    $str.="                 offset          :   0,\n";
    $str.="                 limit           :   99999,\n";
    $str.="                 method          :   'read',\n";
    $str.="                 type            :   'list',\n";
    $str.="                 detail          :   'body',\n";
    $str.="                 query           :   queryText,\n";
    $str.="                 params          :   { },\n";
    $str.="                 securityToken   :   securityToken\n";
    $str.="             },\n";
    $str.="             beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="             },\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.="		},\n";
    $str.="             error: function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="             }\n";
    $str.="         });\n";
    $str.="	}\n";
    
    // search all character
    $str.="	function ajaxQuerySearchAllCharacter(url, securityToken,character) {\n";
    $str.="         // unhide button search\n";
    $str.="         \$('#clearSearch').removeClass();\n";
    $str.="         \$('#clearSearch').addClass('btn');\n";
    $str.="         // unlimited for searching because  lazy paging.\n";
    $str.="         \$.ajax({\n";
    $str.="             type    : 	'POST',\n";
    $str.="             url     :	url,\n";
    $str.="             data    :   {\n";
    $str.="                 offset          :   0,\n";
    $str.="                 limit           :   99999,\n";
    $str.="                 method          :   'read',\n";
    $str.="                 type            :   'list',\n";
    $str.="                 detail          :   'body',\n";
    $str.="                 params          :   { },\n";
    $str.="                 securityToken   :   securityToken,\n";
    $str.="                 character       :   character\n";
    $str.="             },\n";
    $str.="             beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="             },\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.="		},\n";
    $str.="		error: function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="             }\n";
    $str.="         });\n";
    $str.="	}\n";
    
    // search all record date
    $str.="	function ajaxQuerySearchAllDate(url, securityToken,dateRangeStart,dateRangeEnd,dateRangeType,dateRangeExtraType) {\n";
    $str.="         // unhide button search\n";
    $str.="         \$('#clearSearch').removeClass();\n";
    $str.="         \$('#clearSearch').addClass('btn');\n";
    $str.="         // unlimited for searching because  lazy paging.\n";
    $str.="         if(dateRangeStart.length == 0)  {   dateRangeStart = \$('#dateRangeStart').val() } \n";
    $str.="         if(dateRangeEnd.length == 0)    {   dateRangeEnd = \$('#dateRangeEnd').val() } \n";
    $str.="		\$.ajax({\n";
    $str.="             type    : 	'POST',\n";
    $str.="             url     :	url,\n";
    $str.="             data    :   {\n";
    $str.="                 offset		:   0,\n";
    $str.="                 limit		:   99999,\n";
    $str.="                 method		:   'read',\n";
    $str.="                 type		:   'list',\n";
    $str.="                 detail		:   'body',\n";
    $str.="                 query		:   \$('#query').val(),\n";
    $str.="                 params		:   { },\n";
    $str.="                 securityToken	:   securityToken,\n";
    $str.="                 dateRangeStart	:   dateRangeStart,\n";
    $str.="                 dateRangeEnd	:   dateRangeEnd,\n";
    $str.="                 dateRangeType	:   dateRangeType,\n";
    $str.="                 dateRangeExtraType	:   dateRangeExtraType\n";
    $str.="             },\n";
    $str.="		beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="		},\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.="		},\n";
    $str.="             error: function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="		}\n";
    $str.="         });\n";
    $str.="	}\n";
    $str.="	function ajaxQuerySearchAllDateRange(url, securityToken) {\n";
    $str.="        ajaxQuerySearchAllDate(url, securityToken,$('#dateRangeStart').val(),$('#dateRangeEnd').val(),'between',''); \n";
    $str.="	}\n";
    
    // show form
    $str.="	function showForm(url, securityToken) {\n";
    $str.="         // unlimited for searching because  lazy paging.\n";
    $str.="         \$.ajax({\n";
    $str.="             type    :   'POST',\n";
    $str.="             url     :   url,\n";
    $str.="		data    :   {\n";
    $str.="                 method          :   'new',\n";
    $str.="                 type            :   'form',\n";
    $str.="                 securityToken   :   securityToken\n";
    $str.="		},\n";
    $str.="		beforeSend  :   function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="		},\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.="		},\n";
    $str.="		error   :   function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="		}\n";
    $str.="         });\n";
    $str.="	}\n";
    
    // form update
    $str.="	function showFormUpdate(url, securityToken, " . $data[0]['primaryKeyName'] . ") {\n";
    $str.="         \$('a[rel=tooltip]').tooltip('hide');  ";
    $str.="         // unlimited for searching because  lazy paging.\n";
    $str.="         \$.ajax({\n";
    $str.="             type	:   'POST',\n";
    $str.="    		url	:   url,\n";
    $str.="		data	:   {\n";
    $str.="                 method          :   'read',\n";
    $str.="                 type            :   'form',\n";
    $str.="                 " . $data[0]['primaryKeyName'] . "  :   " . $data[0]['primaryKeyName'] . ",\n";
    $str.="                 securityToken   :   securityToken\n";
    $str.="             },\n";
    $str.="             beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="		},\n";
    $str.="		success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                 \$('#centerViewport').html('');\n";
    $str.="                 \$('#centerViewport').empty();\n";
    $str.="                 \$('#centerViewport').removeClass();\n";
    $str.="                 \$('#centerViewport').addClass('container-fluid');\n";
    $str.="                 \$('#centerViewport').append(data);\n";
    $str.= "            },\n";
    $str.="             error: function () {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="             }\n";
    $str.="         });\n";
    $str.="	}\n";
    
    // delete delete modal
    $str.="	function showModalDelete(" . $fieldName . ") {\n";
    $str.="         // clear first old record if exist\n";
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
            $str.=" \$('#" . $data[$i]['columnName'] . "Preview').val('');\n";
// decode back
            $str.=" \$('#" . $data[$i]['columnName'] . "Preview').val(unescape(" . $data[$i]['columnName'] . "));\n\n";
        }
    }
    $str.="         // open modal box\n";
    $str.="         showMeModal('deletePreview', 1);\n";
    $str.="	}\n";
    
    // delete grid record
    $str.="	function deleteGridRecord(url, securityToken,urlList) {\n";
    $str.="         \$.ajax({\n";
    $str.="             type    : 	'POST',\n";
    $str.="             url     : 	url,\n";
    $str.="             data    :   {\n";
    $str.="                 method          :   'delete',\n";
    $str.="                 output          :   'json',\n";
    $str.="                 " . $data[0]['primaryKeyName'] . "	:   \$('#" . $data[0]['primaryKeyName'] . "Preview').val(),\n";
    $str.="                 securityToken   :   securityToken\n";
    $str.="             },\n";
    $str.="             beforeSend: function () {\n";
    $str.="                 // this is where we append a loading image\n";
    $str.="                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="             },\n";
    $str.="             success: function (data) {\n";
    $str.="                 // successful request; do something with the data\n";
    $str.="                 if (data.success == true) {\n";
    $str.="                     showMeModal('deletePreview',0);\n";
    $str.="                     showGrid(urlList,securityToken,0,14,'Record have beend deleted'); \n";
    $str.="                 } else if (data.success == false) {\n";
    $str.="                     \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="                 }\n";
    $str.="             },\n";
    $str.="             error: function (data) {\n";
    $str.="                 // failed request; give feedback to user\n";
    $str.="                 if (data.success == false) {\n";
    $str.="                      \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                 }\n";
    $str.="             }\n";
    $str.="         });\n";
    $str.="     }\n";
    
    // delete grid record checkbox
    $str.="     function deleteGridRecordCheckbox(url,securityToken,urlList) { \n";
    $str.="         var stringText='';\n";
    $str.="         var counter = 0; \n";
    $str.="         \$('input:checkbox[name=\"" . $data[0]['primaryKeyName'] . "[]\"]').each( function() {\n";
    $str.="             stringText=stringText+\"&" . $data[0]['primaryKeyName'] . "[]=\"+$(this).val();  \n";
    $str.="         });\n";

    $str.="//       \$('input:checkbox[name=\"isDraft[]\"]').each( function() { \n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               stringText=stringText+\"&isDraft[]=true\";\n";
    $str.="//           }else {\n";
    $str.="//               stringText=stringText+\"&isDraft[]=false\";\n";
    $str.="//           }\n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               counter++;\n";
    $str.="//           }\n";
    $str.="//       });\n";

    $str.="//      \$('input:checkbox[name=\"isDefault[]\"]').each( function() { \n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               stringText=stringText+\"&isDefault[]=true\";\n";
    $str.="//           }else {\n";
    $str.="//               stringText=stringText+\"&isDefault[]=false\";\n";
    $str.="//           }\n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               counter++;\n";
    $str.="//           }\n";
    $str.="//       });\n";

    $str.="//     \$('input:checkbox[name=\"isNew[]\"]').each( function() { \n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               stringText=stringText+\"&isNew[]=true\";\n";
    $str.="//           }else {\n";
    $str.="//               stringText=stringText+\"&isNew[]=false\";\n";
    $str.="//           }\n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               counter++;\n";
    $str.="//           }\n";
    $str.="//     });\n";

    $str.="//     \$('input:checkbox[name=\"isUpdate[]\"]').each( function() { \n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               stringText=stringText+\"&isUpdate[]=true\";\n";
    $str.="//           }else {\n";
    $str.="//               stringText=stringText+\"&isUpdate[]=false\";\n";
    $str.="//           }\n";
    $str.="//           if(\$(this).is(':checked')) {\n";
    $str.="//               counter++;\n";
    $str.="//           }\n";
    $str.="//     });\n";

    $str.="    \$('input:checkbox[name=\"isDelete[]\"]').each( function() {\n";
    $str.="         // to cater old code extjs\n";
    $str.="         if(\$(this).is(':checked')) {\n";
    $str.="             stringText=stringText+\"&isDelete[]=true\";\n";
    $str.="         }else {\n";
    $str.="             stringText=stringText+\"&isDelete[]=false\";\n";
    $str.="         }\n";
    $str.="         if(\$(this).is(':checked')) {\n";
    $str.="             counter++;\n";
    $str.="         }\n";
    $str.="     });\n";

    $str.="//   $('input:checkbox[name=\"isActive[]\"]').each( function() { \n";
    $str.="//       if(\$(this).is(':checked')) {\n";
    $str.="//           stringText=stringText+\"&isActive[]=true\";\n";
    $str.="//       }else {\n";
    $str.="//         stringText=stringText+\"&isActive[]=false\";\n";
    $str.="//       }\n";
    $str.="//       if($(this).is(':checked')) {\n";
    $str.="//         counter++;\n";
    $str.="//       }\n";
    $str.="//    });\n";

    $str.="//    $('input:checkbox[name=\"isReview[]\"]').each( function() { \n";
    $str.="//       if(\$(this).is(':checked')) {\n";
    $str.="//           stringText=stringText+\"&isReview[]=true\";\n";
    $str.="//       }else {\n";
    $str.="//         stringText=stringText+\"&isReview[]=false\";\n";
    $str.="//       }\n";
    $str.="//       if(\$(this).is(':checked')) {\n";
    $str.="//         counter++;\n";
    $str.="//       }\n";
    $str.="//     });\n";


    $str.="//    \$('input:checkbox[name=\"isPost[]\"]').each( function() { \n";
    $str.="//       if(\$(this).is(':checked')) {\n";
    $str.="//           stringText=stringText+\"&isPost[]=true\";\n";
    $str.="//       }else {\n";
    $str.="//           stringText=stringText+\"&isPost[]=false\";\n";
    $str.="//       }\n";
    $str.="//       if(\$(this).is(':checked')) {\n";
    $str.="//           counter++;\n";
    $str.="//       }\n";
    $str.="//    });\n";


    $str.="      if(counter == 0 ) {\n";
    $str.="         alert(\"You must at least check one record for delete record\")\n";
    $str.="         return false;\n";
    $str.="      } else {\n";
    $str.="         url = url + \"?\"+stringText;\n";
    $str.="      }\n";

    $str.="     \$.ajax({\n";
    $str.="         type	: 	'GET',\n";
    $str.="         url		: 	url,\n";
    $str.="         data	:	{\n";
    $str.="             method          :   'updateStatus',\n";
    $str.="             output          :	'json',\n";
    $str.="             securityToken   : 	securityToken\n";
    $str.="         },\n";
    $str.="         beforeSend: function () {\n";
    $str.="             // this is where we append a loading image\n";
    $str.="             \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="         }, \n";
    $str.="         success: function (data) {\n";
    $str.="             // successful request; do something with the data\n";
    $str.="             if (data.success == true) {\n";
    $str.="                 showGrid(urlList,securityToken,0,14,'Record have been deleted'); \n";
    $str.="             } else if (data.success == false) {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="             }else {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="             }\n";
    $str.="         },\n";
    $str.="         error: function (data) {\n";
    $str.="             // failed request; give feedback to user\n";
    $str.="             if (data.success == false) {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="             } else{\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="             }\n";
    $str.="         }\n";
    $str.="     });\n";
    $str.=" }\n";
    
    // update record
    $str.=" function auditRecord(url, securityToken) {\n";
    $str.="     var css = \$('#auditRecordButton').attr('class');\n";
    $str.="     if (css.search('disabled') > 0) {\n";
    $str.="         return false;   \n";
    $str.="     } else { return false;    }\n";
    $str.=" }\n";
    
    // new record
    $str.=" function newRecord(url, securityToken, type,updateAccess,deleteAccess) {\n";
    $str.="     var css = \$('#newRecordButton2').attr('class');\n";
    $str.="     if (css.search('disabled') > 0) {\n";
    $str.="         return false;\n";
    $str.="     } else {\n";
    $str.="         if (type == 1) {\n";
    $str.="             // new record and continue.Reset Current Record\n";
    $d = 0;
    for ($i = 0; $i < $total; $i++) {
// this field is auto update by session and id don't exist yet..
// extjs generate phantom id instead
        if ($data[$i]['columnName'] != 'executeBy' &&
                $data[$i]['columnName'] != 'executeTime' &&
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.="         \$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="         \$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="         \$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="		} else {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="                 \$.ajax({\n";
    $str.="                     type	:   'POST',\n";
    $str.="			url	:   url,\n";
    $str.="			data	:   {\n";
    $str.="                         method  :   'create',\n";
    $str.="                         output  :   'json',\n";
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="                 " . $data[$i]['columnName'] . "					: 	\$('#" . $data[$i]['columnName'] . "').val(),\n";
        }
    }
    $str.="                         securityToken   :   securityToken\n";
    $str.="                      },\n";
    $str.="                      beforeSend: function () {\n";
    $str.="                         // this is where we append a loading image\n";
    $str.="                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="                      },\n";
    $str.="                      success: function (data) {\n";
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                              // reseting field value\n";
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="								\$('#" . $data[$i]['columnName'] . "').val('');\n";
        }
    }
    $str.="							} else if (data.success == false) {\n";
    $str.="                                                         \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="							}\n";
    $str.="						},\n";
    $str.="						error: function (data) {\n";
    $str.="                                                 // failed request; give feedback to user\n";
    $str.="                                                 if (data.success == false) {\n";
    $str.="                                                     \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                                                 }\n";
    $str.="						}\n";
    $str.="					});\n";
    $str.="				}\n";
    $str.="			} else if (type == 2) {\n";
    $str.="                         // new record and update  or delete record\n";
    $d = 0;
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="     if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="     } else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.="             \$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="		\$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="		\$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="                 } else {\n";
    $str.="                     \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="			\$.ajax({\n";
    $str.="                         type    :   'POST',\n";
    $str.="                         url     :   url,\n";
    $str.="                         data    :   {\n";
    $str.="                             method  :   'create',\n";
    $str.="                             output  :   'json',\n";
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="							" . $data[$i]['columnName'] . "					: 	\$('#" . $data[$i]['columnName'] . "').val(),\n";
        }
    }
    $str.="                                 securityToken   :	securityToken\n";
    $str.="                             },\n";
    $str.="				beforeSend: function () {\n";
    $str.="                                 // this is where we append a loading image\n";
    $str.="                                 \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="                             },\n";
    $str.="                             success: function (data) {\n";
    $str.="                                 // successful request; do something with the data\n";
    $str.="                                 if (data.success == true) {\n";
    $str.="                                     \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                                     \$('#" . $data[0]['primaryKeyName'] . "').val(data." . $data[0]['primaryKeyName'] . "); \n";
// disable the new button. new record only avaible upon pressing reset button
//$str.="								// reseting field value\n";
// new button segment
// remove classes
    $str.="                                     \$('#newRecordButton1').removeClass(); \n";
    $str.="                                     \$('#newRecordButton2').removeClass(); \n";
    $str.="                                     \$('#newRecordButton3').removeClass(); \n";
    $str.="                                     \$('#newRecordButton4').removeClass(); \n";
    $str.="                                     \$('#newRecordButton5').removeClass(); \n";
    $str.="                                     \$('#newRecordButton6').removeClass(); \n";
    $str.="                                     \$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="                                     \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton3').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton4').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton5').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton6').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton7').addClass('disabled'); \n";
// empty the  onClick field.
    $str.="                                     \$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
// update button segment
    $str.="                                    \$('#updateRecordButton1').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton2').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton3').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton4').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton5').removeClass(); \n";
// add disabled class
    // check if authorized or not.hackable here . but back end will check again.
    $str.="if(updateAccess == 1) {\n";
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="} else {\n";
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    $str.=" } else {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    $str.="}\n";
// end button segment
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
    $d = 0;
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="                					" . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="								\$('#" . $data[$i]['columnName'] . "').val('');\n";
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
    $d = 0;
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="        } else {\n";
    $str.="            \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="            \$.ajax({\n";
    $str.="                type	:   'POST',\n";
    $str.="                url	:   url,\n";
    $str.="                data :   {\n";
    $str.="                 method  :   'create',\n";
    $str.="                 output  :	'json',\n";
    for ($i = 0; $i < $total; $i++) {
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="                					" . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
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
    $str.="                        \$('#" . $data[0]['primaryKeyName'] . "').val(data." . $data[0]['primaryKeyName'] . "); \n";
// disable the new button. new record only avaible upon pressing reset button
//$str.="								// reseting field value\n";
// new button segment
// remove classes
    $str.="	\$('#newRecordButton1').removeClass(); \n";
    $str.="	\$('#newRecordButton2').removeClass(); \n";
    $str.="	\$('#newRecordButton3').removeClass(); \n";
    $str.="	\$('#newRecordButton4').removeClass(); \n";
    $str.="	\$('#newRecordButton5').removeClass(); \n";
    $str.="	\$('#newRecordButton6').removeClass(); \n";
    $str.="	\$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="	\$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="	\$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="	\$('#newRecordButton3').addClass('btn btn-success disabled'); \n";
    $str.="	\$('#newRecordButton4').addClass('btn btn-success disabled'); \n";
    $str.="	\$('#newRecordButton5').addClass('btn btn-success disabled'); \n";
    $str.="	\$('#newRecordButton6').addClass('btn btn-success disabled'); \n";
    $str.="	\$('#newRecordButton7').addClass('btn btn-success disabled'); \n";
// empty the  onClick field.
    $str.="	\$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
$str.="if(updateAccess == 1) {\n";
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="} else {\n";
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    $str.=" } else {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    $str.="}\n";

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
    $d = 0;
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
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
                $data[$i]['columnName'] != 'isConsolidation' &&
                $data[$i]['columnName'] != $data[0]['primaryKeyName']) {
            $str.="                					" . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
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
    
    //update record
    $str.="	function updateRecord(url, securityToken, type,deleteAccess) {\n";
    $str.="         var css = \$('#updateRecordButton2').attr('class');\n";
    $str.="         if (css.search('disabled') > 0) {\n";
    $str.="             // access denied\n";
    $str.="         } else {\n";
    $str.="             if (type == 1) {\n";
    $str.="                 // update record and continue\n";
    $d = 0;
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
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.="         \$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="         \$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="         \$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="       	} else {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="                 \$.ajax({\n";
    $str.="                     type	:   'POST',\n";
    $str.="                     url	:   url,\n";
    $str.="              	data	:   {\n";
    $str.="                         method  :   'save',\n";
    $str.="                         output  :	'json',\n";
    for ($i = 0; $i < $total; $i++) {
        $str.="                     " . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
    }
    $str.="                         securityToken			:	securityToken\n";
    $str.="            		},\n";
    $str.="           		beforeSend: function () {\n";
    $str.="                         // this is where we append a loading image\n";
    $str.="                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="           		},\n";
    $str.="            		success: function (data) {\n";
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";

    $str.=" if(deleteAccess==1) {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    $str.=" } else {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    $str.="}\n";
    $str.="                       } else if (data.success == false) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="                        }\n";
    $str.="                     },\n";
    $str.="            		error: function (data) {\n";
    $str.="                         // failed request; give feedback to user\n";
    $str.="                         if (data.success == false) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                         }\n";
    $str.="            		}\n";
    $str.="                 });\n";
    $str.="             }\n";
    $str.="         } else if (\$type == 2) {\n";
    $str.="             // update record  preview(modal box)\n";
    $d = 0;
    for ($i = 0; $i < $total; $i++) {
// this field is auto update by session
        if ($data[$i]['columnName'] != 'executeBy' &&
                $data[$i]['columnName'] != 'executeTime' &&
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
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.=" 				\$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="					\$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="    		} else {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="                     \$.ajax({\n";
    $str.="                         type    :   'POST',\n";
    $str.="                         url     : 	url,\n";
    $str.="                         data    :	{\n";
    $str.="                             method  :	'save',\n";
    $str.="                             output  :	'json',\n";
    for ($i = 0; $i < $total; $i++) {
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
            $str.="                	" . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
        }
    }
    $str.="                			securityToken			: 	securityToken\n";
    $str.="                                 },\n";
    $str.="                                     beforeSend: function () {\n";
    $str.="                                         // this is where we append a loading image\n";
    $str.="                                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="                                     },\n";
    $str.="            				success: function (data) {\n";
    $str.="                                         // successful request; do something with the data\n";
    $str.="                                         if (data.success == true) {\n";
    $str.="                                             \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
// enable the delete button
// enable the delete button
    $str.="                                             \$('#deleteRecordButton').removeClass(); \n";
    $str.="                                             \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="                                             \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\")\"); \n";

    $str.="                                         } else if (data.success == false) {\n";
    $str.="                                             \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="                                         }\n";
    $str.="            				},\n";
    $str.="            				error: function (data) {\n";
    $str.="                                         // failed request; give feedback to user\n";
    $str.="                                         if (data.success == false) {\n";
    $str.="                                             \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                                         }\n";
    $str.="            				}\n";
    $str.="                                 });\n";
    $str.="                             }\n";
    $str.="                         } else if (type == 3) {\n";
    $str.="                             // update record and listing\n";
    $d = 0;
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
            if ($i == 0) {
// first do nothing because it was primary key
            } else if ($d == 0) {
                $str.="	if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
                $d++;
            } else if ($d > 0) {
                $str.="	} else if (\$('#" . $data[$i]['columnName'] . "').val().length == 0) {\n";
            }
            $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Please Choose " . $data[$i]['columnName'] . " First</div>');\n";
            $str.="                 \$('#" . $data[$i]['columnName'] . "').addClass('control-group error');\n";
            $str.="                 \$('#" . $data[$i]['columnName'] . "').focus();\n\n";
            if ($d > 0) {
                $d++;
            }
        }
    }
    $str.="              } else {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>Form Complete</div>');\n";
    $str.="                 \$.ajax({\n";
    $str.="                     type    :   'POST',\n";
    $str.="                     url     :   url,\n";
    $str.="            		data    :   {\n";
    $str.="                         method  :   'save',\n";
    $str.="                         output  :   'json',\n";
    for ($i = 0; $i < $total; $i++) {
// this field is auto update by session
        if ($data[$i]['columnName'] != 'executeBy' &&
                $data[$i]['columnName'] != 'executeTime' &&
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
            $str.="                 " . $data[$i]['columnName'] . ": \$('#" . $data[$i]['columnName'] . "').val(),\n";
        }
    }
    $str.="                         securityToken: securityToken\n";
    $str.="            		},\n";
    $str.="                     beforeSend: function () {\n";
    $str.="                         // this is where we append a loading image\n";
    $str.="                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="            		},\n";
    $str.="            		success: function (data) {\n";
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
// enable the delete button
    $str.=" if(deleteAccess==1) {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    $str.=" } else {\n";
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    $str.="}\n";
    $str.="                         } else if (data.success == false) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="                         }\n";
    $str.="                     },\n";
    $str.="            		error: function (data) {\n";
    $str.="                         // failed request; give feedback to user\n";
    $str.="                         if (data.success == false) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                         }\n";
    $str.="                      }\n";
    $str.="                    });\n";
    $str.="                 }\n";
    $str.="		}\n";
    $str.="         }\n";
    $str.="	}\n";
    
    //delete record
    $str.="	function deleteRecord(url, securityToken,urlList,deleteAccess) {\n";
    $str.="         var css = \$('#deleteRecordButton').attr('class');\n";
    $str.="         if (css.search('disabled') > 0) {\n";
    $str.="             return false; \n";
    $str.="         } else {\n";
    $str.="             if(deleteAccess == 1 ) { ";
    $str.="             if(confirm('Are you sure delete the selected item ?')) { \n";
    $str.="                 var value=\$('#" . $data[0]['primaryKeyName'] . "').val(); \n";
    $str.="                 if(!value) {\n";
// alert something wrong with the record and cannot be deleted.	
    $str.="                     \$('#infoPanel').html('<div class=alert alert-info>Please Contact Administrator</div>');\n";
    $str.="                 } else { \n";
    $str.="                     \$.ajax({\n";
    $str.="                         type            :	'POST',\n";
    $str.="                         url             : 	url,\n";
    $str.="                         data            : 	{\n";
    $str.="                             method          :	'delete',\n";
    $str.="                             output          :	'json',\n";
    $str.="                             " . $data[0]['primaryKeyName'] . "	: 	\$('#" . $data[0]['primaryKeyName'] . "').val(),\n";
    $str.="                             securityToken   :   securityToken\n";
    $str.="                         },\n";
    $str.="                         beforeSend: function () {\n";
    $str.="                             // this is where we append a loading image\n";
    $str.="                             \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="                         },\n";
    $str.="                         success: function (data) {\n";
    $str.="                             // successful request; do something with the data\n";
    $str.="                             if (data.success == true) {\n";
    $str.="                                 showGrid(urlList,securityToken,0,14,'Record have beend deleted'); \n";
    $str.="        			} else if (data.success == false) {\n";
    $str.="                                 \$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="        			}\n";
    $str.="                         },\n";
    $str.="                         error: function (data) {\n";
    $str.="                             // failed request; give feedback to user\n";
    $str.="                             if (data.success == false) {\n";
    $str.="                                 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="        			}\n";
    $str.="                         }\n";
    $str.="                     });\n";
    $str.="                 }\n";
    $str.="             } else { \n";
    $str.="                 return false; \n";
    $str.="		} \n";
    $str.="       }  }\n";
    $str.="	}\n";
    
    //reset record
    $str.="	function resetRecord(url,securityToken) {\n";
// new button segment
// remove classes
    $str.="         \$('#newRecordButton1').removeClass(); \n";
    $str.="	\$('#newRecordButton2').removeClass(); \n";
// add disabled class
    $str.="	\$('#newRecordButton1').addClass('btn btn-success'); \n";
    $str.="	\$('#newRecordButton2').addClass('btn dropdown-toggle btn-success'); \n";

// empty the  onClick field.
    $str.="	\$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#newRecordButton3').attr('onClick', \"newRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\")\"); \n";
    $str.="	\$('#newRecordButton4').attr('onClick', \"newRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\")\"); \n";
    $str.="	\$('#newRecordButton5').attr('onClick', \"newecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\")\"); \n";
    $str.="	\$('#newRecordButton6').attr('onClick', \"newRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\")\"); \n";
    $str.="	\$('#newRecordButton7').attr('onClick', \"newRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\")\"); \n";
// end new button segment
// update button segment
    $str.="	\$('#updateRecordButton1').removeClass(); \n";
    $str.="	\$('#updateRecordButton2').removeClass(); \n";
    $str.="	\$('#updateRecordButton3').removeClass(); \n";
    $str.="	\$('#updateRecordButton4').removeClass(); \n";
    $str.="	\$('#updateRecordButton5').removeClass(); \n";
// add disabled class
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
// toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
// drop down don't have  css class.blank empty
//$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
//$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
//$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
// put back the  onClick field
//@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";


// delete button segment
    $str.="	\$('#deleteRecordButton').removeClass(); \n";
    $str.="	\$('#deleteRecordButton').addClass('btn btn-danger disabled'); \n";
    $str.="	\$('#deleteRecordButton').attr('onClick',''); \n";
// end delete button segment
// post button segment
    $str.="	\$('#postRecordButton').removeClass(); \n";
    $str.="	\$('#postRecordButton').addClass('btn btn-info'); \n";
    $str.="	\$('#postRecordButton').attr('onClick',''); \n";
// end post button segment
// end button segment
// navigation segment
// disable move next
    $str.="	\$('firstFirst').removeClass(); \n";
    $str.="	\$('firstFirst').addClass(); \n";
    $str.="	\$('firstFirst').attr('onClick', \"firstRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\")\"); \n";
// disable move previous
    $str.="	\$('#movePrevious').removeClass(); \n";
    $str.="	\$('#movePrevious').attr('onClick',''); \n";
// enable the next record
    $str.="	\$('moveNext').removeClass(); \n";
    $str.="	\$('movePrevious').attr('onClick',''); \n";
// enable the last record
    $str.="	\$('lastRecord').removeClass(); \n";
    $str.="	\$('lastRecord').addClass(); \n";
    $str.="	\$('lastRecord').attr('onClick',\"lastRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\")\"); \n";
// end navigation segment
    for ($i = 0; $i < $total; $i++) {
// this field is auto update by session
        if ($data[$i]['columnName'] != 'isDefault' &&
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
            $str.="								\$('#" . $data[$i]['columnName'] . "').val('');\n";
        }
    }
    $str.="	}\n";
    
    //post record
    $str.="	function postRecord() {\n";
    
    $str.="		var css = \$('#postRecordButton').attr('class');\n";
    $str.="		if (css.search('disabled') > 0) {\n";
    $str.="                 return false;  \n";
    $str.="		} else {\n";
    $str.="                 return false;  \n";
    $str.="		}\n";
    
    $str.="	}\n";
    
    // first record
    $str.="	function firstRecord(url, securityToken,updateAccess,deleteAccess) {\n";
    
    $str.="         var css = \$('#firstRecordButton').attr('class');\n";
    
    $str.="         if (css.search('disabled') > 0) {\n";
    
    $str.="             return false;  \n";
    
    $str.="         } else {\n";
    
    $str.="             \$.ajax({\n";
    $str.="                 type    :   'GET',\n";
    $str.="                 url     :   url,\n";
    $str.="                 data    :   {\n";
    $str.="                     method		:   'dataNavigationRequest',\n";
    $str.="                     dataNavigation	:   'firstRecord',\n";
    $str.="                     output		:   'json',\n";
    $str.="                     securityToken	:   securityToken\n";
    $str.="                 },\n";
    $str.="    			beforeSend: function () {\n";
    
    $str.="        			// this is where we append a loading image\n";
    $str.="        			\$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    
    $str.="    			},\n";
    $str.="    			success: function (data) {\n";
    
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    $str.="                             \$.ajax({\n";
    $str.="                                 type            : 	'POST',\n";
    $str.="                                 url             : 	url,\n";
    $str.="                                 data            :	{\n";
    $str.="                                 method          :	'read',\n";
    $str.="                                 " . $data[0]['primaryKeyName'] . "	:   data.firstRecord,\n";
    $str.="                                 output          : 	'json',\n";
    $str.="                                 securityToken   : 	securityToken\n";
    $str.="                         },\n";
    $str.="                         beforeSend: function () {\n";
    
    $str.="                             // this is where we append a loading image\n";
    $str.="                             \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    
    $str.="                         },\n";
    $str.="                         success: function (data) {\n";
    
    $str.="                             // successful request; do something with the data\n";
    $str.="                    		if (data.success == true) {\n";
    
    $str.="                                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                                 // reseting field value\n";
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
            $str.="		\$('#" . $data[$i]['columnName'] . "').val(data.data." . $data[$i]['columnName'] . ");\n";
        }
    }
    $str.="                                     if (data.nextRecord > 0) {\n";
    $str.="                                         \$('#previousRecordButton').removeClass();\n";
    $str.="                                         \$('#previousRecordButton').addClass('btn btn-info  disabled');\n";
    $str.="                                         \$('#previousRecordButton').attr('onClick','');\n";

    $str.="                                         \$('#nextRecordButton').removeClass();\n";
    $str.="                                         \$('#nextRecordButton').addClass('btn btn-info');\n";
    $str.="                                         \$('#nextRecordButton').attr('onClick','');\n";
    $str.="                                         \$('#nextRecordButton').attr('onClick', \"nextRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";

    
    $str.="                                         \$('#firstRecord').val(data.firstRecord);\n";
    $str.="                                         \$('#previousRecord').val(data.previousRecord);\n";
    $str.="                                         \$('#nextRecord').val(data.nextRecord);\n";
    $str.="                                         \$('#lastRecord').val(data.lastRecord);\n";
 
   // check if authorized or not.hackable here . but back end will check again.
    // new button segment
// remove classes
    $str.="                                     \$('#newRecordButton1').removeClass(); \n";
    $str.="                                     \$('#newRecordButton2').removeClass(); \n";
    $str.="                                     \$('#newRecordButton3').removeClass(); \n";
    $str.="                                     \$('#newRecordButton4').removeClass(); \n";
    $str.="                                     \$('#newRecordButton5').removeClass(); \n";
    $str.="                                     \$('#newRecordButton6').removeClass(); \n";
    $str.="                                     \$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="                                     \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton3').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton4').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton5').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton6').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton7').addClass('disabled'); \n";
// empty the  onClick field.
    $str.="                                     \$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
// update button segment
    $str.="                                    \$('#updateRecordButton1').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton2').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton3').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton4').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton5').removeClass(); \n";
    $str.="if(updateAccess == 1) {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    
    $str.="} else {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    
    $str.=" } else {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    
    $str.="}\n";  
    
    $str.="                                     }\n";
    $str.="                                 }\n";
    $str.="               		},\n";
    $str.="                             error: function (data) {\n";
    $str.="                                 // failed request; give feedback to user\n";
    $str.="                                 if (data.success == false) {\n";
    $str.="                                     \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                                 }\n";
    $str.="              		}\n";
    $str.="                         });\n";
    $str.="    			} else {\n";
    $str.="                         \$('#infoPanel').html('<div class=\'alert alert-error\'>' + data.message + '</div>');\n";
    $str.="                     }\n";
    $str.="                 },\n";
    $str.="                 error: function (data) {\n";
    $str.="   			// failed request; give feedback to user\n";
    $str.="    			if (data.success == false) {\n";
    $str.="        			\$('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');\n";
    $str.="   			}\n";
    $str.="                 }\n";
    $str.="		});\n";
    $str.="         }\n";
    $str.="	}\n";
    
    //update last record
    $str.="	function lastRecord(url, securityToken,updateAccess,deleteAccess) {\n";
    
    $str.="         var css = \$('#lastRecordButton').attr('class');\n";
    
    $str.="         if (css.search('disabled') > 0) {\n";
    
    $str.="             return false;\n";
    
    $str.="         } else {\n";
    
    $str.="             \$.ajax({\n";
    $str.="                 type    :   'GET',\n";
    $str.="                 url     :   url,\n";
    $str.="                 data    :   {\n";
    $str.="                         method          :   'dataNavigationRequest',\n";
    $str.="                         dataNavigation  :   'lastRecord',\n";
    $str.="                         output          :   'json',\n";
    $str.="                         securityToken   :   securityToken\n";
    $str.="                 },\n";
    $str.="                 beforeSend: function () {\n";
    
    $str.="                     // this is where we append a loading image\n";
    $str.="                     \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    
    $str.="                 },\n";
    $str.="                 success: function (data) {\n";
    $str.="                     // successful request; do something with the data\n";
    $str.="                     if (data.success == true) {\n";
    $str.="                         \$.ajax({\n";
    $str.="                         type    :   'POST',\n";
    $str.="                         url     :   url,\n";
    $str.="                         data    :   {\n";
    $str.="                             method          :   'read',\n";
    $str.="                             " . $data[0]['primaryKeyName'] . "  :   data.lastRecord,\n";
    $str.="                             output          :   'json',\n";
    $str.="                             securityToken   :   securityToken\n";
    $str.="                         },\n";
    $str.="                         beforeSend: function () {\n";
    $str.="                             // this is where we append a loading image\n";
    $str.="                             \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="                         },\n";
    $str.="                         success: function (data) {\n";
    
    $str.="                             // successful request; do something with the data\n";
    $str.="                             if (data.success == true) {\n";
    
    $str.="                                 \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
    $str.="                                 // reseting field value\n";
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
            $str.="		\$('#" . $data[$i]['columnName'] . "').val(data.data." . $data[$i]['columnName'] . ");\n";
        }
    }
    $str.="                            		if (data.lastRecord != 0) {\n";
    // enable the previous button
    $str.="                               		\$('#previousRecordButton').removeClass();\n";
    $str.="                                		\$('#previousRecordButton').addClass('btn btn-info');\n";
    $str.="                                             \$('#previousRecordButton').attr('onClick', \"previousRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";

    // disable the next button.End of the paging record
    $str.="                               		\$('#nextRecordButton').removeClass();\n";
    $str.="                                		\$('#nextRecordButton').addClass('btn btn-info disabled');\n";
    $str.="                                             \$('#nextRecordButton').attr('onClick','');\n";
    // set default value of paging record
    $str.="                               		\$('#firstRecord').val(data.firstRecord);\n";
    $str.="                               		\$('#previousRecord').val(data.previousRecord);\n";
    $str.="                               		\$('#nextRecord').val(data.nextRecord);\n";
    $str.="                                		\$('#lastRecord').val(data.lastRecord);\n";
    
    // check if authorized or not.hackable here . but back end will check again.
    // new button segment
// remove classes
    $str.="                                     \$('#newRecordButton1').removeClass(); \n";
    $str.="                                     \$('#newRecordButton2').removeClass(); \n";
    $str.="                                     \$('#newRecordButton3').removeClass(); \n";
    $str.="                                     \$('#newRecordButton4').removeClass(); \n";
    $str.="                                     \$('#newRecordButton5').removeClass(); \n";
    $str.="                                     \$('#newRecordButton6').removeClass(); \n";
    $str.="                                     \$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="                                     \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton3').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton4').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton5').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton6').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton7').addClass('disabled'); \n";
// empty the  onClick field.
    $str.="                                     \$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
// update button segment
    $str.="                                    \$('#updateRecordButton1').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton2').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton3').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton4').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton5').removeClass(); \n";
    $str.="if(updateAccess == 1) {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    
    $str.="} else {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    
    $str.=" } else {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    
    $str.="}\n";    
    
    $str.="                           		}\n";
    $str.="                                 }\n";
    $str.="                   		},\n";
    $str.="                   		error: function (data) {\n";
    $str.="                                 // failed request; give feedback to user\n";
    $str.="                                 if (data.success == false) {\n";
    $str.="                           		\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                                 }\n";
    $str.="                  		}\n";
    $str.="              		});\n";
    $str.="           		} else {\n";
    $str.="              		\$('#infoPanel').html('<div class=alert alert-error>' + data.message + '</div>');\n";
    $str.="            		}\n";
    $str.="        		},\n";
    $str.="       		error: function (data) {\n";
    $str.="                         // failed request; give feedback to user\n";
    $str.="                         if (data.success == false) {\n";
    $str.="              	 	\$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    $str.="                         }\n";
    $str.="       		}\n";
    $str.="    		});\n";
    $str.="		}\n";
    $str.="	}\n";
    
    // update previousRecord
    $str.="	function previousRecord(url, securityToken,updateAccess,deleteAccess) {\n";
    $str.="         var css = \$('#previousRecordButton').attr('class');\n";
    $str.="         if (css.search('disabled') > 0) {\n";
    $str.="     	return false;\n";
    $str.="         } else {\n";
    $str.="      	\$('#newButton').removeClass();\n";
    $str.="       	if (\$('#previousRecord').val() == '' || \$('#previousRecord').val() == undefined) {\n";
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>testingo</div>');\n";
    $str.="     	}\n";
    $str.="       	if (parseFloat(\$('#previousRecord').val()) > 0 && parseFloat(\$('#previousRecord').val()) < parseFloat(\$('#lastRecord').val())) {\n";
    $str.="                 \$.ajax({\n";
    $str.="                     type	:   'POST',\n";
    $str.="             	url	:   url,\n";
    $str.="            		data    :   {\n";
    $str.="                         method          : 	'read',\n";
    $str.="                         " . $data[0]['primaryKeyName'] . "	:   \$('#previousRecord').val(),\n";
    $str.="                         output          :   'json',\n";
    $str.="                         securityToken   :   securityToken\n";
    $str.="                     },\n";
    $str.="                     beforeSend: function () {\n";
    $str.="                         // this is where we append a loading image\n";
    $str.="                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    $str.="          		},\n";
    $str.="          		success: function (data) {\n";
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    $str.="                             \$('#infoPanel').html('<div class=alert alert-info>Loading Complete</div>');\n";
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
            $str.="                     \$('#" . $data[$i]['columnName'] . "').val(data.data." . $data[$i]['columnName'] . ");\n";
        }
    }
    
     // check if authorized or not.hackable here . but back end will check again.
    // new button segment
// remove classes
    $str.="                                     \$('#newRecordButton1').removeClass(); \n";
    $str.="                                     \$('#newRecordButton2').removeClass(); \n";
    $str.="                                     \$('#newRecordButton3').removeClass(); \n";
    $str.="                                     \$('#newRecordButton4').removeClass(); \n";
    $str.="                                     \$('#newRecordButton5').removeClass(); \n";
    $str.="                                     \$('#newRecordButton6').removeClass(); \n";
    $str.="                                     \$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="                                     \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton3').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton4').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton5').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton6').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton7').addClass('disabled'); \n";
// empty the  onClick field.
    $str.="                                     \$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
// update button segment
    $str.="                                    \$('#updateRecordButton1').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton2').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton3').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton4').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton5').removeClass(); \n";
    $str.="if(updateAccess == 1) {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    
    $str.="} else {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    
    $str.=" } else {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    
    $str.="}\n";  
    
    $str.="                		\$('#firstRecord').val(data.firstRecord);\n";
    $str.="                  		\$('#previousRecord').val(data.previousRecord);\n";
    $str.="                		\$('#nextRecord').val(data.nextRecord);\n";
    $str.="                 		\$('#lastRecord').val(data.lastRecord);\n";
    
    $str.="                 		if (parseFloat(data.nextRecord) != parseFloat(data.lastRecord)) {\n";
    
    $str.="                                 \$('#nextRecordButton').removeClass();\n";
    $str.="                                 \$('#nextRecordButton').addClass('btn btn-info');\n";
    $str.="                                 \$('#nextRecordButton').attr('onClick','');\n";
    $str.="                                 \$('#nextRecordButton').attr('onClick', \"nextRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";


    $str.="                             } else {\n";
    
    $str.="                                 \$('#nextRecordButton').removeClass();\n";
    $str.="                                 \$('#nextRecordButton').addClass('btn btn-info disabled');\n";
    $str.="                                 \$('#nextRecordButton').attr('onClick','');\n";
    
    $str.="                    		}\n";
    $str.="                   		if (parseFloat(data.previousRecord) == 0) {\n";
    
    $str.="                                 \$('#previousRecordButton').removeClass();\n";
    $str.="                                 \$('#previousRecordButton').addClass('btn btn-info disabled');\n";
    $str.="                                 \$('#previousRecordButton').attr('onClick','');\n";
    
    $str.="                   		}\n";
    $str.="                         }\n";
    $str.="          		},\n";
    $str.="           		error: function (data) {\n";
    
    $str.="                          // failed request; give feedback to user\n";
    $str.="                         if (data.success == false) {\n";
    
    $str.="                             \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    
    $str.="                         }\n";
    $str.="           		}\n";
    $str.="                 });\n";
    $str.="     	} else {\n";
    $str.="         	// debugging purpose only\n";
    $str.="       	}\n";
    $str.="         }\n";
    $str.="	}\n";
    
    // update nextRecord
    $str.="	function nextRecord(url, securityToken,updateAccess,deleteAccess) {\n";
    $str.="         var css = \$('#nextRecordButton').attr('class');\n";
    
    $str.="         if (css.search('disabled') > 0) {\n";
    
    $str.="             return false;  \n";
    
    $str.="         } else {\n";
    
    $str.="    		\$('#newButton').removeClass();\n";
    $str.="    		if (\$('#nextRecord').val() == '' || \$('#nextRecord').val() == undefined) {\n";
    
    $str.="                 \$('#infoPanel').html('<div class=alert alert-error>sdfd</div>');\n";
    
    $str.="    		}\n";
    
    $str.="    		if (parseFloat(\$('#nextRecord').val()) < parseFloat(\$('#lastRecord').val())) {\n";
    
    $str.="                 \$.ajax({\n";
    $str.="             	type	:	'POST',\n";
    $str.="             	url	: url,\n";
    $str.="          		data	: {\n";
    
    $str.="                         method          : 	'read',\n";
    $str.="                         " . $data[0]['primaryKeyName'] . "  :   \$('#nextRecord').val(),\n";
    $str.="                         output          : 	'json',\n";
    $str.="                         securityToken   :   securityToken\n";
    
    $str.="           		},\n";
    $str.="            		beforeSend: function () {\n";
    
    $str.="                         // this is where we append a loading image\n";
    $str.="                         \$('#infoPanel').html('<div class=progress><img src=./images/loading.gif alt=Loading.../></div>');\n";
    
    $str.="            		},\n";
    $str.="            		success: function (data) {\n";
    
    $str.="                         // successful request; do something with the data\n";
    $str.="                         if (data.success == true) {\n";
    
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
            $str.="                     \$('#" . $data[$i]['columnName'] . "').val(data.data." . $data[$i]['columnName'] . ");\n";
        }
    }
    
    // check if authorized or not.hackable here . but back end will check again.
    // new button segment
// remove classes
    $str.="                                     \$('#newRecordButton1').removeClass(); \n";
    $str.="                                     \$('#newRecordButton2').removeClass(); \n";
    $str.="                                     \$('#newRecordButton3').removeClass(); \n";
    $str.="                                     \$('#newRecordButton4').removeClass(); \n";
    $str.="                                     \$('#newRecordButton5').removeClass(); \n";
    $str.="                                     \$('#newRecordButton6').removeClass(); \n";
    $str.="                                     \$('#newRecordButton7').removeClass(); \n";
// add disabled class
    $str.="                                     \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";
    $str.="                                     \$('#newRecordButton3').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton4').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton5').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton6').addClass('disabled'); \n";
    $str.="                                     \$('#newRecordButton7').addClass('disabled'); \n";
// empty the  onClick field.
    $str.="                                     \$('#newRecordButton1').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton2').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton3').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton4').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton5').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton6').attr('onClick', ''); \n";
    $str.="                                     \$('#newRecordButton7').attr('onClick', ''); \n";
// end new button segment
// update button segment
    $str.="                                    \$('#updateRecordButton1').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton2').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton3').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton4').removeClass(); \n";
    $str.="                                    \$('#updateRecordButton5').removeClass(); \n";
    $str.="if(updateAccess == 1) {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+1+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+2+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', \"updateRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+3+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";
    
    $str.="} else {\n";
    
    $str.="	\$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
    // toggle button
    $str.="	\$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
    // drop down don't have  css class.blank empty
    //$str.="	\$('#updateRecordButton3').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton4').addClass('btn btn-info'); \n";
    //$str.="	\$('#updateRecordButton5').addClass('btn btn-info'); \n";
    // put back the  onClick field
    //@todo.. what if the client have no access to update..
    $str.="	\$('#updateRecordButton1').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton2').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton3').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton4').attr('onClick', ''); \n";
    $str.="	\$('#updateRecordButton5').attr('onClick', ''); \n";        
    
    $str.="}\n";
    $str.=" if(deleteAccess==1) {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick', \"deleteRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";    
    
    $str.=" } else {\n";
    
    $str.="     \$('#deleteRecordButton').removeClass(); \n";
    $str.="     \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
    $str.="     \$('#deleteRecordButton').attr('onClick',''); \n";   
    
    $str.="}\n";   
    
    $str.="                    		\$('#firstRecord').val(data.firstRecord);\n";
    $str.="                    		\$('#previousRecord').val(data.previousRecord);\n";
    $str.="                    		\$('#nextRecord').val(data.nextRecord);\n";
    $str.="                   		\$('#lastRecord').val(data.lastRecord);\n";
    
    $str.="                    		if (parseFloat(data.previousRecord) > 0) {\n";
    
    $str.="                                 \$('#previousRecordButton').removeClass();\n";
    $str.="                                 \$('#previousRecordButton').addClass('btn btn-info');\n";
    $str.="                                 \$('#previousRecordButton').attr('onClick', \"previousRecord(\\\"\"+url+\"\\\",\\\"\"+securityToken+\"\\\",\\\"\"+updateAccess+\"\\\",\\\"\"+deleteAccess+\"\\\")\"); \n";

    
    $str.="                   		} else {\n";
    
    $str.="                                 \$('#previousRecordButton').removeClass();\n";
    $str.="                                 \$('#previousRecordButton').addClass('btn btn-info disabled');\n";
    $str.="                                 \$('#previousRecordButton').attr('onClick','');\n";
    
    $str.="                   		}\n";
    $str.="                   		if (parseFloat(data.nextRecord) == parseFloat(data.lastRecord)) {\n";
    
    $str.="                                 \$('#nextRecordButton').removeClass();\n";
    $str.="                                 \$('#nextRecordButton').addClass('btn btn-info disabled');\n";
    $str.="                                 \$('#nextRecordButton').attr('onClick','');\n";
    
    $str.="                    		}\n";
    $str.="                         }\n";
    $str.="             	},\n";
    $str.="              	error: function (data) {\n";
    
    $str.="                         // failed request; give feedback to user\n";
    $str.="                         if (data.success == false) {\n";
    
    $str.="                     	 \$('#infoPanel').html('<div class=alert alert-error>Error Could Load The Request Page</div>');\n";
    
    $str.="                         }\n";
    
    $str.="              	}\n";
    
    $str.="                 });\n";
    
    $str.="         } else {\n";
    
    $str.="         }\n";
    
    $str.="    }\n";
    
    $str.=" }\n";
}
?>