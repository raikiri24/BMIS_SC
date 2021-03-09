  <?php

if($usertype=="SuperAdmin"){
  $where = "ORDER BY fullname ASC";
}elseif($usertype=="Administrator" ){
  $where = "where usertype='BarangayCaptain' AND useractive='1' ORDER BY fullname ASC";
}elseif($usertype=="BarangayCaptain"){
  $where = "WHERE usertype NOT IN('SuperAdmin','Administrator','BarangayCaptain') AND brgy_id_fk='{$brgy_id}' && useractive='1' ORDER BY fullname ASC";
}elseif($usertype=="Kagawad" || $usertype=="Secretary") {
  $where = "WHERE usertype IN('Kagawad','Secretary') AND brgy_id_fk='{$brgy_id}' && useractive='1' ORDER BY fullname ASC";
}
?>
  <div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users List<a href="?brgypage=Deactivated" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>&nbsp;Deactivated Users</a>
          </h1>
			</div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header ">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-success text-lg">
              <i class="fas fa-user-friends"></i>
              User
            </div>
          </div>
          <?php if($usertype=="Administrator" || $usertype=="SuperAdmin"){?>
          <h3 class="card-title">List of User Details<a class="btn btn-success btn-sm" data-toggle="modal" title="Add New User" data-target="#modal-user"><i class="fa fa-user" style="color:white;"></i></a></h3>
        <?php }elseif($usertype=="BarangayCaptain"){?>
          <h3 class="card-title">List of User Details<a class="btn btn-success btn-sm" data-toggle="modal" title="Add New User" data-target="#modal-userunderbrgycaptain"><i class="fa fa-user" style="color:white;"></i></a></h3>
        <?php }?>
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Fullname</th>
                <?php if($usertype=="BarangayCaptain"){?>
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Username</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Password</th>
                <?php }?>
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Sitio</th>
                
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Barangay</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">User Type</th>
				<?php if($usertype=="BarangayCaptain"){?>
				<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
				<?php }?>
			  </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM users_tbl $where");
                  $rs_user = $crud -> getResult();

                  foreach($rs_user as $rs_userval){

                ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $rs_userval['fullname'];?></td>
                    <?php if($usertype=="BarangayCaptain"){?>
					<td><?php echo $rs_userval['username'];?></td>
					<td><?php echo $rs_userval['password'];?></td>
					<?php }?>
					<td><?php echo sitio_namesitio_name($rs_userval['sitio_id_fk']);?></td>
                    <td><?php echo getBrgyName($rs_userval['brgy_id_fk']);?></td>
                    <td><?php echo $rs_userval['usertype'];?></td>
					<td>
						<button type="button" id="btn_user_id_<?php echo $rs_userval['user_id']; ?>" class="btn btn-danger btn-xs" title="Deactivate this User" data-toggle="tooltip" value="<?php echo $rs_userval['user_id']; ?>" onclick="deactivateUser('<?php echo $rs_userval['user_id']; ?>');"><i class="fa fa-times"></i></button>
					</td>
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


  <!-- this is the modal for adding new records of barangay information  -->
    <div class="modal fade" id="modal-user">
            <div class="modal-dialog modal-sm">
              <form role="form" method="post" id="form_adduser" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="ribbon-wrapper">
                    <div class="ribbon bg-success text-xs">
                      User.
                    </div>
                  </div>
                  <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;Add New User</h4>

                </div>
                <div class="modal-body">
                  <div id="msgboxuser"></div>
                  <div class="form-group">
                      <label for="text">Fullname</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Fullname" required>
                  </div>
                  <div class="form-group">
                      <label for="text">Username</label>
                      <input type ="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                  </div>
                  <div class="form-group">
                      <label for="text">Password</label>
                      <input type="text" class="form-control" id="password" name="password" placeholder="Enter Desire Password" required>
                  </div>
                  <div class="form-group">
                      <label for="text">Restriction</label>
                      <select class="form-control" id="restriction" name="restriction">
                        <?php if($usertype=="Administrator"){?>
                              <option value="BarangayCaptain">Barangay Captain</option>
                        <?php }elseif($usertype=="BarangayCaptain"){?>
                              <option value="BarangayHealthWorker">Barangay Health Worker</option>
                              <option value="Secretary">Secretary</option>
                              <option value="Treasurer">Treasurer</option>
                              <option value="Kagawad">Kagawad</option>
                        <?php }else{?>
                              <option value="Administrator">Administrator</option>
                        <?php }?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="text">Barangay</label><small style="color:red;"><i>Disabled data have a existing user</i></small>
                      <select class="form-control" id="brgy_id" name="brgy_id">
                        <option value="" selected disabled>--SELECT BRGY--</option>
						<?php
                        $crud -> sql("SELECT * FROM brgy_tbl ORDER BY brgy_id ASC");
                        $rs_brgy = $crud -> getResult();
                        foreach ($rs_brgy as $rs_brgyval) {
											$s='';
      										if($rs_brgyval['brgy_id']==getUserID($rs_brgyval['brgy_id'])){
      											$s='disabled';
      										}
                          echo '<option value="'.$rs_brgyval['brgy_id'].'" '.$s.'>'.ucwords($rs_brgyval['brgy_name']).'</option>';
                          }
                          ?>
                      </select>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" id="btn_adduser" name="btn_adduser" class="btn btn-success">Save</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </form>
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->



          <!-- this is the modal for adding new records of barangay information  -->
            <div class="modal fade" id="modal-userunderbrgycaptain">
                    <div class="modal-dialog modal-xs">
                      <form role="form" method="post" id="form_adduserbc" enctype="multipart/form-data">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="ribbon-wrapper">
                            <div class="ribbon bg-success text-xs">
                              User.
                            </div>
                          </div>
                          <h4 class="modal-title"><i class="fa fa-user"></i>&nbsp;Add New Barangay User</h4>

                        </div>
                        <div class="modal-body">
                          <div id="msgboxuserbc"></div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">Fullname</label>
                                    <input type="text" class="form-control" id="fname_bc" name="fname_bc" placeholder="Enter Fullname" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">Username</label>
                                    <input type="text" class="form-control" id="username_bc" name="username_bc" placeholder="Enter Username" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                  <label for="text">Password</label>
                                  <input type="text" class="form-control" id="password_bc" name="password_bc" placeholder="Enter Desire Password" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">Restriction</label>
                                    <select class="form-control" id="restriction_bc" name="restriction_bc">
                                      <?php if($usertype=="Administrator"){?>
                                            <option value="BarangayCaptain">Barangay Captain</option>
                                      <?php }elseif($usertype=="BarangayCaptain"){?>
                                            <option value="BarangayHealthWorker">Barangay Health Worker</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Treasurer">Treasurer</option>
                                            <option value="Kagawad">Kagawad</option>
                                      <?php }else{?>
                                            <option value="Administrator">Administrator</option>
                                      <?php }?>
                                    </select>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">Barangay</label>
                                    <select class="form-control" id="brgy_id_bc" name="brgy_id_bc">
                                      <?php
                                      $crud -> sql("SELECT * FROM brgy_tbl WHERE brgy_id='{$brgy_id}' ORDER BY brgy_id ASC");
                                      $rs_brgy = $crud -> getResult();
                                      foreach ($rs_brgy as $rs_brgyval) {
                                        $s='';
                    										if($rs_brgyval['brgy_id']==getUserID($rs_brgyval['brgy_id'])){
                    											$s='selected';
                    										}
                                        echo '<option value="'.$rs_brgyval['brgy_id'].'" '.$s.'>'.ucwords($rs_brgyval['brgy_name']).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                               <div class="form-group" id="restriction_policy" style="display:none;">
                                   <label for="text">Sitio</label>
                                   <select class="form-control" id="sitio_id_bc" name="sitio_id_bc" required>
                                     <option value="0" >--SELECT SITIO--</option>
                                     <?php
                                     $crud -> sql("SELECT * FROM sitio_tbl WHERE brgy_id_fk='{$brgy_id}' ORDER BY sitio_id ASC");
                                     $rs_sitio = $crud -> getResult();
                                     foreach ($rs_sitio as $rs_sitioval) {
                                       $s='';
                                       if($rs_sitioval['sitio_id']==getUserID_Sitio_id($rs_sitioval['sitio_id'])){
                                         $s='disabled';
                                       }
										echo '<option value="'.$rs_sitioval['sitio_id'].'" '.$s.'>'.ucwords($rs_sitioval['sitio_name']).'</option>';
                                       }
                                       ?>
                                   </select>
                               </div>
                             </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn_adduserbc" name="btn_adduserbc" class="btn btn-success">Save</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </form>
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
