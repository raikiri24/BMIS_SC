<?php
session_start();
//date_default_timezone_set("Asia/Manila");

include '../controller/loginfunction.php';
include '../controller/mysql_crud.php';
include '../controller/brgy_sitiofunction.php';
include '../controller/userfunction.php';
include '../controller/residentfunction.php';
include '../controller/dashboardfunction.php';
include '../controller/BHWfunction.php';
include '../controller/settingsfunction.php';

$crud = new CRUD();
$crud->connect();
$userid = "";
$username = "";
$usertype = "";
$brgypage = "";

if(!empty($_SESSION['user_id'])){
  $userid = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $usertype = $_SESSION['usertype'];
  $fullname = $_SESSION['fullname'];
  $password = $_SESSION['password'];
  $brgy_id = $_SESSION['brgy_id_fk'];
  $sitio_id_user = $_SESSION['sitio_id_fk'];
  $status = $_SESSION['status'];
  //$log_id = $_SESSION['log_id'];
   $logname="";
  $fullname="";
  // $photo="";
  if($usertype=="SuperAdmin"){
    $logname = "System Admin";
	$fullname = getFullName($userid);
  $brgy_name = "System";
}elseif($usertype=="Administrator"){
  $logname = "Administrator";
  $fullname = getFullName($userid);
  $brgy_name = "Santa Cruz DILG";
}
 else{
	  $logname = getRestriction($userid);
	  $fullname = getFullName($userid);
    $brgy_name = getbrgyname($brgy_id);
	$sitio = sitio_namesitio_name($sitio_id_user);
	  //$photo = getImage($userid);
  }
}if(empty($_SESSION['user_id'])){
  header('Location : ..\index.php');
}
$ornumbernot = getOrNumber($brgy_id);
$cedulanumbernot = getCedulaId($brgy_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Barangay Information System | V1.0 <?php echo (!empty($_SESSION['user_id'])) ? '-' .$logname:'' ; ?></title>

  <?PHP include 'templates/meta.php'?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?PHP include 'templates/header.php';?>
<?PHP include 'templates/side_navigation.php';?>

<?php
      // user setting
      if($brgypage=="userlist"){
        include 'users/userlist.php';
      // maintenance functionalities
      }elseif($brgypage=="brgylist"){
        include 'settings/barangaylist.php';
      }elseif($brgypage=="sitiolist"){
        include 'settings/sitiolist.php';
      }elseif($brgypage=="ORandCedula"){
  		include 'settings/OrandCedula.php';
  	  }elseif($brgypage=="logobarangay"){
  		include 'settings/logobarangay.php';
  	  }elseif($brgypage=="businesstype"){
  		include 'settings/businesstype.php';
  	  }elseif($brgypage=="religion"){
  		include 'settings/religion.php';
  	  }
	  //this is for the dashboard pages
  	  elseif($brgypage=="businesscount"){
  		include 'Dashboard/businesscount.php';
  	  }elseif($brgypage=="residencecount"){
  		include 'Dashboard/residencecount.php';
  	  }elseif($brgypage=="householdcount"){
  		include 'Dashboard/householdcount.php';
  	  }elseif($brgypage=="Votercount"){
  		include 'Dashboard/Votercount.php';
  	  }elseif($brgypage=="SeniorCount"){
  		include 'Dashboard/SeniorCount.php';
  	  }elseif($brgypage=="Indigentcount"){
  		include 'Dashboard/Indigentcount.php';
  	  }
    // this function is to show the list of details per barangay this is for barangay captain ACCESS
      elseif($brgypage=="listofhousehold"){
      include 'Dashboard/listofhousehold.php';
      }elseif($brgypage=="listofresidencedashboard"){
        include 'Dashboard/listofresidence.php';
      }elseif($brgypage=="listofbusinessdashboard"){
        include 'Dashboard/listofbusiness.php';
      }


      elseif($brgypage=="Deactivated"){
  		include 'users/deactivated.php';
  	  }elseif($brgypage=="loginsession"){
  		include 'users/loginsession.php';
  	  }elseif($brgypage=="userprofile"){
  		include 'users/userprofile.php';
  	  }elseif($brgypage=="calendar"){
  		include 'settings/calendar.php';
  	  }elseif($brgypage=="brgyofficial"){
  		include 'settings/barangayOfficial.php';
  	  }elseif($brgypage=="designationactivate"){
  		include 'settings/Designationactivate.php';
  	  }elseif($brgypage=="listofpreviewsdesignation"){
  		include 'settings/listofpreviewsdesignation.php';
  	  }elseif($brgypage=="sample"){
  		include 'settings/sample.php';
  	  }elseif($brgypage=="search"){
		include 'settings/search.php';
	  }


      //this is for the function for the list of residence
      elseif($brgypage=="residence"){
        include 'residence/residencelist.php';
      }elseif($brgypage=="viewresidence"){
        include 'residence/viewresidencedetails.php';
      }elseif($brgypage=="residenceedit"){
        include 'residence/residence.edit.php';
      }elseif($brgypage=="issuedclearance"){
  		include 'residence/issuedClearance.php';
  	  }elseif($brgypage=="printClearance"){
  		include 'residence/issuedClearanceReport.print.php';
  	  }elseif($brgypage=="BusinessPermit"){
  		  include 'residence/BusinessPermit.php';
  	  }elseif($brgypage=="BusinessPermitView"){
  		  include 'residence/BusinessPermitReportView.php';
  	  }elseif($brgypage=="BusinessPermitRenew"){
  		  include 'residence/BusinessPermitRenew.php';
  	  }elseif($brgypage=="BusinessPermitRenewReport"){
  		  include 'residence/businessPermitRenewReport.php';
  	  }elseif($brgypage=="blotter"){
  		  include 'residence/blotter.php';
  	  }elseif($brgypage=="blotterlist"){
  		  include 'residence/blotterlist.php';
  	  }elseif($brgypage=="viewblotterdetails"){
  		  include 'residence/viewblotterdetails.php';
  	  }elseif($brgypage=="monitoringschedule"){
  		  include 'residence/monitoringschedule.php';
  	  }elseif($brgypage=="upcommingmonitoringschedule"){
  		  include 'residence/upcomingmonitoringschedule.php';
  	  }elseif($brgypage=="viewDetailsImage"){
  		  include 'residence/viewDetailsandImage.php';
  	  }elseif($brgypage=="residentlistpersitio"){
  		  include 'residence/residentlistpersitio.php';
  	  }
	  // THIS IS FOR THE BHW ACCESS
  	  elseif($brgypage=="BHWChildrensList"){
  		  include 'BHW/listofChildren.php';
  	  }elseif($brgypage=="ListofChildrenPersitio"){
  		  include 'BHW/listofChildrenPerSitio.php';
  	  }
	  elseif($brgypage=="Residentlistdilg"){
		  include 'DILG_REPORTS/residentlistreport.dilg.php';
	  }elseif($brgypage=="residentlistcountdilg"){
		  include 'DILG_REPORTS/residentlistbyage.dilg.php';
	  }	  

  	   else{
  		if($usertype=="Administrator" || $usertype=="SuperAdmin"){
  		include 'templates/dashboardAdmin.php';
  		}elseif($usertype=="BarangayCaptain" || $usertype=="Secretary"){
  		include 'templates/dashboardBarangayCaptain.php';
  		}elseif($usertype=="Kagawad"){
  		include 'templates/dashboardKagawad.php';
  		}else{
          include 'templates/dashboard.php';
  		}
      }
?>
<?PHP include 'templates/sidebar.php';?>

<?PHP include 'templates/footer.php';?>
<?PHP include 'templates/script.php';?>
</div>


<!-- ./wrapper -->

<input type="hidden" id="usertype" value="<?php echo $logname; ?>">
<input type="hidden" id="userid" value="<?php echo $userid; ?>">
<input type="hidden" id="fullname" name="fullname" value="<?php echo $fullname; ?>">
<input type="hidden" id="brgy_id" name="brgy_id" value="<?php echo $brgy_id; ?>">
<input type="hidden" id="sitio_id_user" value="<?php echo $sitio_id_user; ?>">
<input type="hidden" id="status" value="<?php echo $status;?>">
<input type="hidden" name="usertypereport" value="<?php echo $usertype;?>" id="usertypereport">

<!--
<input type="text" id="log_id" value=<?php echo $log_id;?>>
-->
<script>
		updateAge();

      $(function () {
      $("#example1").DataTable();
	  $("#example3").DataTable();
	  $("#example4").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });

	//Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	 // Summernote
    $('.textarea').summernote()


      });


      $(function() {
         const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 2000
         });
         $('.toastrDefaultSuccess').click(function() {
           toastr.success('SuccessFully Save')
         });
         $('.toastrDefaultInfo').click(function() {
           toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
         });
         $('.toastrDefaultError').click(function() {
           toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
         });
         $('.toastrDefaultWarning').click(function() {
           toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
         });
       });

	// bkLib.onDomLoaded(function() {
		// new nicEditor().panelInstance('narrativereport');
	// });

</script>
</body>
</html>
