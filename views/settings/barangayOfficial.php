<div class="content-wrapper" style="min-height: 1589.56px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Barangay Official</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Officials</a></li>
              <li class="breadcrumb-item active">Officials List</li>
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
              Officials.
            </div>
          </div>
          <h3 class="card-title">List of Barangay Officials Details &nbsp;
		  </h3>
		  <span class="text-danger" style="font-weight:bold;"><i>Once you click the update button the barangay official will no longer access to the system.</i></span>
		
        </div>
        <div class="card-body table-responsive" style="display: block;">
		<form method="get" id="form_removedesignation">
			<div id="msgboxdesignation"></div>
          <table id="" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">REMOVE DESIGNATION</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">FULLNAME</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">SITIO NAME</th>
            

              </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM users_tbl WHERE usertype='Kagawad' && useractive!='0'");
                  $rs_off = $crud -> getResult();

                  foreach($rs_off as $rs_offval){

                ?>

                <tr role="row" class="even">
                    <td><input type="checkbox" name="user_id[]" id="user_id_<?php echo $rs_offval['user_id'];?>" value="<?php echo $rs_offval['user_id']; ?>" >
					<input type="hidden" name="utype[]" id="utype" value="<?php echo $rs_offval['usertype'];?>">
					
					<input type="hidden" name="brgy_id_fk_users" id="brgy_id_fk_user" value="<?php echo $rs_offval['brgy_id_fk'];?>">
					
					<input type="hidden" name="sitio_id_fk_user[]" id="sitio_id_fk_user" value="<?php echo $rs_offval['sitio_id_fk'];?>">
					
					</td>
					
                    <td>
					<input type="hidden" name="userfname[]" id="userfname" value="<?php echo $rs_offval['fullname'];?>">
					
					<?php echo $rs_offval['fullname'];?></td>
                    <td><?php echo sitio_namesitio_name($rs_offval['sitio_id_fk']);?></td>
                   

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
          <div class="col-lg-3 col-md-3 col-sm-3">
				<button type="submit" class="btn btn-success" name="btn_removedesignation" id="btn_removedesignation">Update</button>
			</div>
        </div>
			
		</form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
