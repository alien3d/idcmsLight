 // onload load the first 10 record first
    $(document).ready(function(){
            
    });
    
    function toggleChecked(status) {

        $(":checkbox").each( function() {
            //alert($(this).val());
            $(this).attr("checked",status);
        });
    }
    function ajaxQuery(page,type,offset,limit,params) {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                start: offset,
                perPage :limit,
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
    
     function hideButton() {
            $("#query").val('');
            $("#clearSearch").removeClass();
            $("#clearSearch").addClass('btn hide');
        }
    
