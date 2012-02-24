  <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo $_SESSION['projectName']; ?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php 
              // of distinct first
              for($applicationCounter=0;$applicationcounter<$loopApplication;$applicationCounter++) {  ?>
              <li class="active dropdown"><?php echo $applicationData[$applicationCounter]; ?>
                  <?php for($moduleCounter=0;$moduleCounter<$loopModule;$moduleCounter++) { ?>
                  <ul class="dropdown-menu">
                      <?php for($folderCounter;$folderCounter<$loopFolder;$folderCounter++) { ?>
                        <li><a href=""></a></li>
                      <?php } ?>  
                      <li class="divider"></li>
                     
                  </ul>
                  <?php } ?>
              </li>
              <?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    </div>