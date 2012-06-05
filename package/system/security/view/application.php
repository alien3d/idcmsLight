<html>
    <body>
        <div class="well span2">
            <div>
                <div id="btnList">
                <!-- button type only be used on non critical only .. ie9 bugs -->
                <button type="button" name="menuBack" class="btn btn-inverse btn-small"><i class="icon-arrow-left"></i> Menu </button> <button type="button" value="New Record" name="newRecordButton" id="newRecordButton" class="btn btn-info btn-small"><i class="icon-plus"></i> New Record </button> 
                </div>
                <hr>
                <h3>Search</h3>
                <input type="text" name="searchText" id="searchText" class="span2">
                <hr>
                <h4>Date</h4>
                <a href="">Any Time</a><br>
                <a href="" rel="tooltip" title="Previous Day">&laquo;</a> <a href="">Today</a> <a href="" rel="tooltip" title="Next Day">&raquo;</a><br>
                <a href="" rel="tooltip" title="Previous Week">&laquo;</a> <a href="">Week</a> <a href="" rel="tooltip" title="Next Week">&raquo;</a><br>
                <a href="" rel="tooltip" title="Previous Month">&laquo;</a> <a href="">Month</a> <a href="" rel="tooltip" title="Next Month">&raquo;</a><br>
                <a href="" rel="tooltip" title="Previous Year">&laquo;</a> <a href="">Year</a> <a href="" rel="tooltip" title="Next Year">&raquo;</a><br>
                Range
                <div style="style:none">
                    <input type="date" name="range1" id="range1" class="span2"><br>
                    <input type="date" name="range2" id="range2" class="span2"><br>
                    <input type="button" name="searchDate" id="searchDate" value="Search" class="btn btn-info">
                </div>
                <div id="showChoosenDate">
                   here we appear range date choose by user.
                   Google  Style + idcms 1 style
                </div>
                <hr>
            </div>
        </div>
       
        
    </body>
    <script language="javascript">
        $(document).ready(function(){
                // load the system cell if session  and token exist; 
            $('#range1').datepicker({ 
                format :'d-m-yyyy'
            });
            $('#range2').datepicker({ 
                format :'d-m-yyyy'
            });  
        });
    </script>    
</html>