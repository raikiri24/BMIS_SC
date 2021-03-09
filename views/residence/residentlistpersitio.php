
<div class="content-wrapper" style="min-height: 1589.56px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php  if($usertype=="BarangayCaptain") { ?>
            <h1>List of Residence <select name="" id="">
              <option value="">--Please choose a Sitio--</option>
              <?php
                        $crud -> sql("SELECT * FROM sitio_tbl ORDER BY sitio_name ASC");
                        $rs_sitio = $crud -> getResult();
                        foreach ($rs_sitio as $rs_brgyval) {
                          echo '<option value="'.$rs_brgyval['sitio_id'].'" '.$s.'>'.ucwords($rs_brgyval['sitio_name']).'</option>';
                          }
                          ?>
            </select></h1> 
            
          <?php }
          else{?>
          <h1>List of Residence - <?php echo sitio_namesitio_name($sitio_id_user);?></h1>
          <?php }?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Residence</a></li>
              <li class="breadcrumb-item active">Residence List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-olive text-lg">
              Info.
            </div>
          </div>
          
		  
		  <div class="row">
		  <div class="col-md-3">
          <h3 class="card-title">List of Residence Details
		  	<a href="reports/residentlistpersitio.print.php?brgy_id=<?php echo $brgy_id;?>&sitio=<?php echo $sitio_id_user;?>" class="btn btn-default btn-flat" target="_blank"><i class="fa fa-print"></i></a>
		
		  </h3>
		  </div>
		  
			</div>
		  
		  
		  
		  
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">House Number</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Resident Names</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Gender</th>
                
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Birth Date</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Civil Status</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Religion</th>
                
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>

              </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
				  $crud -> sql("SELECT * FROM resident_tbl WHERE brgy_id_fk_resident='{$brgy_id}' AND sitio_id_fk_resident='{$sitio_id_user}' ORDER BY dateregistered ASC");
                  $rs_issued = $crud -> getResult();

                  foreach($rs_issued as $rs_issuedval){
					
					
					$house_id = gethouse_id($rs_issuedval['house_no_fk']);
					
					
						
					
					$id = getTblResVal("brgy_id_fk_house", "houseno_tbl", "house_id", "'{$rs_issuedval['house_no_fk']}'");
					$ids = getTblResVal("sitio_id_fk_house", "houseno_tbl", "house_id", "'{$rs_issuedval['house_no_fk']}'");
					
					$houseno = gethousenumber($rs_issuedval['house_no_fk']);
					//$brgy_name_issued = getbrgyname($id);
					$sitioname_Issued = getsitioname($ids);
					$or = getOrNumber($rs_issuedval['brgy_id_fk_resident']);
					$cedula = getCedulaId($rs_issuedval['brgy_id_fk_resident']);
					
                ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $houseno.' '.$sitioname_Issued;?></td>
                    <td><?php echo $rs_issuedval['fname'].' '.$rs_issuedval['mname'].' '.$rs_issuedval['lname'];?></td>
					<td><?php echo getidentityofAll($rs_issuedval['gender']);?></td>
					<td><?php echo date('F d Y', strtotime($rs_issuedval['bday']));?></td>
					<td><?php echo getCivilStatus($rs_issuedval['civil_status']);?></td>
					<td><?php 
						if($rs_issuedval['religion']=="0"){
							echo $rs_issuedval['religion_specify'];
						}else{
							echo getReligionName($rs_issuedval['religion']);
						}
						?></td>
					<td><a href="?brgypage=viewDetailsImage&resident_id=<?php echo $rs_issuedval['resident_id'];?>&house_id=<?php echo $rs_issuedval['house_no_fk'];?>" data-toggle="tooltip" title="View Details" class="btn btn-success btn-xs"><i class="fa fa-eye"></i>&nbsp;View Profile</a></td>
                </tr>
               <?php
					
               $c++;
             }

               ?>
            </tbody>
          <tfoot></tfoot>
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer" style="display: block;">
          Resident Profile
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

