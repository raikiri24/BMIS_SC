
  <div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Session Log</a>
          </h1>
			</div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Log</a></li>
              <li class="breadcrumb-item active">Logs List</li>
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
              <i class="fas fa-user-friends"></i>
              LOGS
            </div>
          </div>
        <h3 class="card-title">LIST OF SESSION LOGS</h3>
       
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">LOG NAME</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">USER TYPE</th>
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">DATE LOG</th>
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">STATUS</th>
				
			  </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM userslog_tbl WHERE brgy_id_fk='{$brgy_id}' ORDER BY log_id ASC");
                  $rs_user = $crud -> getResult();

                  foreach($rs_user as $rs_userval){

                ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $rs_userval['log_name'];?></td>
                    <td><?php echo $rs_userval['log_type'];?></td>
					<td><?php echo $rs_userval['date_in'];?></td>
					<td><?php 
					if($rs_userval['log_status']=="ONLINE"){
						echo '<span class="text-success">'.$rs_userval['log_status'].'</span>';
						
					}else{
						echo '<span class="text-danger">'.$rs_userval['log_status'].'</span>';
						
					}
					?></td>
					
              </tr>
               <?php
               $c++;
               }
               ?>
            </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>
        <!-- /.card-body -->
      
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

