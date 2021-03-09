<?PHP
  if(isset($_GET['brgypage'])){
    $brgypage = $_GET['brgypage'];
  }
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#405a51;" >
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../assets/AdminLTE/dist/img/AdminLTELogo.png" alt="BMIS" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">BMIS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../assets/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $fullname;?>&nbsp;<i>(<?php echo $brgy_name;?>)</i></a>
        <small style="color:lightgreen;font-weight:bold;"><center><i><?php echo $logname?></i></center></small>
		<?php if($usertype=="Kagawad"){?>
		<small style="color:lightgreen;font-weight:bold;"><center><i><?php echo "SITIO-".$sitio;?></i></center></small>
		<?php }?>
	 </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php //if($usertype=="SuperAdmin"){?>

			<?php if($usertype=="Kagawad" || $usertype=="SuperAdmin" || $usertype=="BarangayCaptain"){?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                  <p>
                    Residence
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                <?php if($usertype!="BarangayCaptain"){?>   
                  
                  <li class="nav-item">
                    <a href="?brgypage=residence" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Registered Residence</p>
                    </a>
                  </li>
                <?php  } ?>
				  <li class="nav-item">
                    <a href="?brgypage=residentlistpersitio" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Residence List</p>
                    </a>
                  </li>
				</ul>
              </li>
			<?php }?>
			  <?php if($usertype=="Secretary" || $usertype=="SuperAdmin"){?>

			<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-user-friends"></i>
              <p>
                Issuance of Clearance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">

               <li class="nav-item bg-olive">
                    <a href="?brgypage=issuedclearance&sitio_id_clearance" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Issuance of Clearance</p>
                    </a>
              </li>
            </ul>
          </li>





			  <?php }?>









			<?php if($usertype=="Administrator"){?>

			  <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-folder"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
				<?php if($usertype=="Administrator"){?>
                <li class="nav-item">
                  <a href="?brgypage=Residentlistdilg" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resident List</p>
                  </a>
                </li>
				 <li class="nav-item">
                  <a href="?brgypage=residentlistcountdilg" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>RESIDENT LIST COUNT BY AGE</p>
                  </a>
                </li>
				<?PHP }?>
				      </ul>
            </li>
			<?php }?>



			 <li class="nav-item has-treeview">

            <?php if($usertype=="SuperAdmin" || $usertype=="Administrator" || $usertype=="Secretary" || $usertype=="BarangayCaptain"){?>
              
              
              <a href="#" class="nav-link">
                <i class="fas fa-cogs"></i>
                <p>
                  Settings
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              
              <?PHP } ?>
              <ul class="nav nav-treeview" style="display: none;">
                <?php if($usertype=="SuperAdmin" || $usertype=="Administrator"){?>

                <li class="nav-item">
                  <a href="?brgypage=brgylist" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barangay</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?brgypage=businesstype" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add & Edit Business</p>
                  </a>
                </li>
				        <li class="nav-item">
                  <a href="?brgypage=religion" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Religion</p>
                  </a>
                </li>
                <?PHP }
                 if($usertype=="BarangayCaptain"){
                  ?>
                <li class="nav-item">
                  <a href="?brgypage=sitiolist" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sitio</p>
                  </a>
                </li>

				 <li class="nav-item">
                  <a href="?brgypage=logobarangay" class="nav-link bg-olive">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Brgy Logo</p>
                  </a>
                </li>
          	<?php }
            if($usertype=="Secretary" || $usertype=="Treasurer"){
            ?>

            <li class="nav-item">
              <a href="?brgypage=ORandCedula" class="nav-link bg-olive">
                <i class="far fa-circle nav-icon"></i>
                <p>O.R and Cedula</p>
              </a>
            </li>
          <?php } ?>



				</ul>
            </li>


			<?php if($usertype=="BarangayCaptain" || $usertype=="SuperAdmin" || $usertype=="Administrator"){?>
			<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-user-friends"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">

              <li class="nav-item">
                <a href="?brgypage=userlist" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="?brgypage=loginsession" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Session Logs</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="?brgypage=brgyofficial" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barangay Officials</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="?brgypage=designationactivate" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Activate Designation</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="?brgypage=listofpreviewsdesignation" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HISTORY OF PREVIEWS DESIGNATION</p>
                </a>
              </li>

            </ul>
          </li>
			<?php }?>
			<?php if($usertype=="BarangayHealthWorker"){?>
			 <li class="nav-item">
                <a href="?brgypage=BHWChildrensList" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LIST OF CHILDRENS</p>
                </a>
              </li>

		  <?php }?>


		   <!-- <li class="nav-item">
                <a href="?brgypage=calendar" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calendar of Activities</p>
                </a>
              </li>
			-->


		</ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
