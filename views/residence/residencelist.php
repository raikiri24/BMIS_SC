<?php

if($usertype=="Administrator"){
$where = "ORDER BY house_id ASC";
}elseif($usertype=="SuperAdmin"){
$where = "ORDER BY house_id ASC";
}elseif($usertype=="BarangayCaptain"){
$where = "WHERE brgy_id_fk_house='{$brgy_id}'";
}elseif($usertype=="Kagawad"){
$where = "WHERE sitio_id_fk_house='{$sitio_id_user}' AND brgy_id_fk_house='{$brgy_id}'";
}

elseif($usertype=="Secretary"){
$where = "WHERE sitio_id_fk_house='{$sitio_id_user}'";
}

?>

<div class="content-wrapper" style="min-height: 1589.56px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of Residence-<?php echo sitio_namesitio_name($sitio_id_user);?></h1>
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
            <div class="ribbon bg-success text-lg">
              Residence.
            </div>
          </div>
          <h3 class="card-title">List of Residence Details &nbsp;<a class="btn btn-success btn-sm" data-toggle="modal" title="Add New Residence Number" data-target="#modal-houseno"><i class="fa fa-plus" style="color:white;"></i></a></h3>
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">House Number</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Total Male</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Total Female</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Employed/Unemployed</th>
        				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Total Voters</th>
        				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>

              </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM houseno_tbl $where");
                  $rs_house = $crud -> getResult();
                  foreach($rs_house as $rs_houseval){
                  ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $rs_houseval['house_no'].", &nbsp;".getbrgyname($rs_houseval['brgy_id_fk_house']).", ".getsitioname($rs_houseval['sitio_id_fk_house']);?></td>
                    <td><?php echo getCountofResidentMale($rs_houseval['house_id']);?></td>
                    <td><?php echo getCountofResidentFemale($rs_houseval['house_id']);?></td>
					<td>
						<?php echo countEmployeedResidentPersitioKagawadEmployedResidentList($rs_houseval['house_id'],$sitio_id_user);?>/
						<?php echo countEmployeedResidentPersitioKagawadUnemployedResidentList($rs_houseval['house_id'],$sitio_id_user);?>
					</td>
					<td>
						<?php echo countDILGTblResults("resident_tbl", "voter", "Yes", "house_no_fk", $rs_houseval['house_id']);?>
					</td>
                    <td>
                      <a href="?brgypage=viewresidence&house_id=<?php echo $rs_houseval['house_id'];?>" title="View Residence Details" class="btn btn-success btn-xs">View</a>
                    </td>

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
          Footer

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- this is the modal for adding new records of barangay information  -->
  <div class="modal fade" id="modal-houseno">
          <div class="modal-dialog modal-sm">
            <form role="form" method="post" id="form_addhouseNo" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <div class="ribbon-wrapper">
                  <div class="ribbon bg-success text-xs">
                    Residence.
                  </div>
                </div>
                <h5 class="modal-title">Add New House Number</h5>

              </div>
              <div class="modal-body">
                <div id="msgboxhouseno"></div>
                <input type="hidden" name="brgyhouse_id" id="brgyhouse_id" value="<?php echo $brgy_id;?>">
                <input type="hidden" name="sitiohouse_id" id="sitiohouse_id" value="<?php echo $sitio_id_user;?>">
                <div class="form-group">
                    <label for="text">House Number</label>
                    <input type="text" class="form-control" id="house_no" name="house_no" placeholder="Enter House Number" required>
                </div>
				<div class="form-group">
                    <label for="text">House Type:</label>
                    <select class="form-control" id="house_type" name="house_type">
						<option selected disabled>--SELECT HOUSE TYPE--</option>
						<option value="RESIDENTIAL">RESIDENTIAL</option>
						<option value="COMMERCIAL">COMMERCIAL</option>
					</select>
				</div>

				<div class="form-group" id="Businessseelecttype" style="display:none;">
                    <label for="text">Business Type:</label>
                    <select class="form-control" id="businesstypeID" name="businesstypeID">
						<option value="0" selected disabled>--SELECT BUSINESS TYPE--</option>
						<?php
							// $sql_b = "SELECT * FROM businesstype";
							// $qry_b = $mysqli->query($sql_b) or die($mysqli->error);
							// $row_b = $qry_b->num_rows;
							$crud -> sql("SELECT * FROM businesstype_tbl ORDER BY businesstype_id ASC");
							$rsbtype = $crud->getResult();
							foreach($rsbtype as $rsbtypeval){
						?>
							<option value="<?php echo $rsbtypeval['businesstype_id'];?>"><?php echo $rsbtypeval['businesstype_name'];?></option>'
							<?php

							}

							?>
					</select>
				</div>

              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_addhouseno" name="btn_addhouseno" class="btn btn-success">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
