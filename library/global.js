 // onload load the first 10 record first
    $(document).ready(function(){
        // ajaxQuery('dummy.php','new',0,'');
        // testingValidation
        // testing alphanumeric
        validateMeAlphaNumeric('alphaNumeric');
        // testing numeric
        validateMeNumeric('numeric');
        // testing currency
        validateMeCurrency('currency');
        // testing email
        validateMeEmail('email'); 
        // testing password
        validateMePassword('password');
        // date
        $("#date").dateinput({
            format :'dd mmm yyyy'
        });
    });
    
    function toggleChecked(status) {

        $(":checkbox").each( function() {
            //alert($(this).val());
            $(this).attr("checked",status);
        });
    }
    function ajaxQuery(page,type,offset,params) {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                offset: offset,
                params : params
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                $('#infoPanel').empty();
                if(type == 'new') {
                    $('#tableBody').append(data.tableString);
                    $('#pagingHtml').append(data.pagingString);
                } else {
                    $('#tableBody').empty();
                    $('#pagingHtml').empty();
                    $('#tableBody').append(data.tableString);
                    $('#pagingHtml').append(data.pagingString);
                }
            },
            error:function(){
                // failed request; give feedback to user
                $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
            }
        });
    }
    function ajaxAudit() {
    
    }
    function ajaxNew(type) {
        
        if(type==1){
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
            

        } else if (type==2){
            // new record and update
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
    
            
        } else if (type==3){
            // new record and continue and print/preview(Open modal box)
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }    

            
        } else if (type==4){
            // new record and update and  print/preview(open modal box)
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        } else if (type==5){
            // new record and listing
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
    
            showMeDiv('tableDate',0);
            showMeDiv('formEntry',1);
        }
    }
    function ajaxUpdate () {
        if(type==1){
            // update record and continue
        } else  if ($type==2){
            // update record  preview(modal box)
            
        } else if (type==3){
            // update record and listing
            
        } 
        
    }
    function ajaxDelete() {
        if(type==1){
            // delete record and go first record
        } else if(type==2){
            // delete record and preview(open modal box)
        }
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionId : $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
            
    }
    function ajaxReset() {
        $("#religionId").val();
        $("#religionTitle").val();
        $("#religionDesc").val();
        
    }
    function ajaxPost() {
        
    }
    function ajaxFirst() {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionTitle: $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
    }
    function ajaxLast() {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionId: $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
        
    }
    function ajaxNext() {
        $('#newButton').removeClass();
        if ($('#nextRecord').val() == '' || $('#nextRecord').val() == undefined) {
            $('#infoPanel').html('<div class=\'alert alert-error\'>'+chooseRecordLabel+'</div>');
        }
        if ($('#nextRecord').val() <= $('#lastRecord').val()) {
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                   method: 'read',
                   religionId: $("#religionId").val(),
                   leafId: leafId,
                   isAdmin: isAdmin,
                   render : false
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        // reseting field value
                        $("#religionTitle").val("");
                        $("#religionDesc").val("");
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        }
    }
    function ajaxLast() {
        $("#newButton").removeClass();        
        $("#newButton").addClass(".disable");
        if($("#lastRecord").val() =='' || $("#lastRecord").value==undefined){
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                    
                     method: 'dataNavigationRequest',
                     leafId: leafId,
                     dataNavigation: 'lastRecord'
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        // navigation bar
                        if (data.nextRecord == 0) {
                            $('#previousButton').removeClass();
                            $('#previousButton').addClass(".disabled");
                        } else {
                            Ext.getCmp('previousButton').enable();
                            $('#previousButton').removeClass();
                            $('#previousButton').addClass(".active");
                        }
                        $('#firstRecord').val(data.firstRecord);
                        $('#previousRecord').val(data.previousRecord);
                        $('#nextRecord').val(data.nextRecord);
                        $('#lastRecord').val(data.lastRecord);
                        $('#endRecord').val((data.lastRecord + 1));
                        $('#nextButton').removeClass();
                        $('#nextButton').addClass(".disabled");
                        $('#previousButton').removeClass();
                        $('#previousButton').addClass(".active");
                        // end navigation bar
                        // start load data
                        $('#religionId').val(data.religionId);
                        $('#religionTitle').val(data.religionTitle);
                        $('#religionDesc').val(data.religionDesc);
                        // end load data.
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                       
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                    religionId: $("#religionId").val()
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        $('#firstRecord').val(data.firstRecord);
                        $('#previousRecord').val(data.previousRecord);
                        $('#nextRecord').val(data.nextRecord);
                        $('#lastRecord').val(data.lastRecord);
                        $('#endRecord').val((data.lastRecord + 1));
                        $('#nextButton').removeClass();
                        $('#nextButton').addClass(".disabled");
                        $('#previousButton').removeClass();
                        $('#previousButton').addClass(".active");
                        // end navigation bar
                        // start load data
                        $('#religionId').val(data.religionId);
                        $('#religionTitle').val(data.religionTitle);
                        $('#religionDesc').val(data.religionDesc);
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        }
        
    }
    function showMeModal(id,toggle){
        var activity='';
        if(toggle==1) {
            activity='show';
        }  else {
            activity ='hide';
        }     
        $("#"+id).modal(activity);       
    }
    function showMeDiv(id,toggle){
        if(toggle==1){
            $("#"+id).show(5,function(){
                $('#infoPanel').html('<div class=\'alert alert-info\'>Cak Cak</div>');

            }).slideDown('slow').fadeIn();
        } else {
            $("#"+id).hide(5,function(){
                $('#infoPanel').html('<div class=\'alert alert-info\'>Sorok jab</div>');
            });
        }
    }
    function showMeSideBar(counter,total) {
    	    for(i=1;i<total+1;i++) {
    			if("#common"+counter != "#common"+i) {
    				
        				$("#common"+i).each(function() {
        				$("#folder"+i).attr('src','images/icons/folder.png');
    					$(this).addClass("hide");
    				});
    			} else { 
    		
    				$("#common"+i).each(function() {
    					$("#folder"+i).attr('src','images/icons/folder-open.png');
    					$(this).removeClass();
    				});
    			} 
    		}
    	
    	
    }
    function validateMePassword(id){
        validateMeColor(id,0,'','');
        
        $('#'+id).keyup(function() {
            var password = $('#'+id).val();
            if(password.length==0){
                validateMeColor(id,1,'error','Please fill password field');

            }else if(password.length < 6){
                   
                validateMeColor(id,1,'warning','Weak Password');

            }else{
                var regex_simple = /^[a-z]$/;
                var regex_capital = /^[A-Z]$/;
                var regex_numbers = /^[0-9]$/;

                var simple_status  = '0';
                var capital_status = '0';
                var number_status  = '0';
                var status_count   = '0';

                for(i=0;i<password.length;i++){
                    var check_character = password.charAt(i);

                    if(regex_simple.test(check_character) && simple_status == '0'){
                        simple_status = '1';
                        status_count++;
                    }
                    if(regex_capital.test(check_character) && capital_status == '0'){
                        capital_status = '1';
                        status_count++;
                    }
                    if(regex_numbers.test(check_character) && number_status == '0'){
                        number_status = '1';
                        status_count++;
                    }
                }

                switch(status_count){
                    case 0:
                            
                        validateMeColor(id,1,'warning','Weak Password');

                        break;
                    case 1:

                            
                        validateMeColor(id,1,'success','Good Password');

                        break;

                    case 2:
                            
                        validateMeColor(id,1,'success','Strong Password');

                        break;

                    case 3:
                            
                        validateMeColor(id,1,'success','Superb Password');

                        break;
                }



            }
        });
       
    }
    
    function validateMeEmail(id){
        // reset first any old validation color
        validateMeColor(id,0,'','');
        // start validate
        $("#"+id).blur(function(){
            var email = $('#'+id).val();
            
            var reEmail = /^[A-Za-z0-9][a-zA-Z0-9._-][A-Za-z0-9]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
            if (email == '') {
               
                validateMeColor(id,1,'warning','Field cannot be empty');
            }else if(email.length > 60){
                
                validateMeColor(id,1,'warning','Email cannot exceed 60 characters');
            }else if(!reEmail.test(email)){
                
                validateMeColor(id,1,'error','Invalid Email');
            } else {
                validateMeColor(id,0,'','');
            }
        });
    }
    function validateMeAlphaNumeric(id) {
       
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9a-zA-Z]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9a-zA-Z]/g, "").replace(/^/, "") ); });
    }
    function validateMeNumeric(id){
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/^/, "") ); });
    }
    function validateMeCurrency(id){
        // by basic will have 
        
        
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); });
     
    }
    function validateMeDate(id){
        $("#"+id).focus();
    }
    function validateMeColor(id,toggle,type,text){
        cssClass='';
       
        if(toggle==1) {
            $("#"+id).focus();
            if (type=='warning'){
                cssClass="control-group warning";

            } else if (type=='error') {
                cssClass="control-group error";

            } else if (type=='success'){
                cssClass="control-group success";

            }
            $("#"+id+"Div").removeClass();
            $("#"+id+"Div").addClass(cssClass);
            // inline helper
            $("#"+id+"HelpMe").empty();
            $("#"+id+"HelpMe").html(text);
            
           
           
        }  else {
            cssClass="control-group"
            $("#"+id+"Div").removeClass();
            $("#"+id+"Div").addClass(cssClass);
            // inline helper
            $("#"+id+"HelpMe").empty();
        }     
         
    }
    function routing(id,total) {
    	// appear a  small tick icon.Preventing the usage of breadcrumb eating space
    	for(i=1;i<total+1;i++) {
    		$("#choosenLeaf"+i).html("");
    		if(id == i ) {
    			$("#choosenLeaf"+i).html("<img src='images/icons/tick-red.png' alt='Choosen Leaf' width=16 height=16>");
    		} 
    	}
    	// appear a load ajax icon like facebook style.
    	//$("#choosenLeafWaitingIcon"+i).html("<img src='images/loading.gif' alt='loading page'"); 
    }
    /**
     *  Rerouting page
     *  @param number identification of the page
     *  @param string either full  or sidebar only
     */
    
