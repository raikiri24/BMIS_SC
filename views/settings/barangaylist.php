<?php

if($usertype=="Administrator" || $usertype=="SuperAdmin"){
$where = "ORDER BY brgy_name ASC";
}elseif($usertype=="BarangayCaptain" || $usertype=="Kagawad"){
$where = "WHERE brgy_id='{$brgy_id}' ORDER BY brgy_name ASC";
}
?>

<div class="content-wrapper" style="min-height: 1589.56px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of Barangay</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Barangay</a></li>
              <li class="breadcrumb-item active">Barangay List</li>
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
            <div class="ribbon bg-primary text-lg">
              BRGY.
            </div>
          </div>
          <h3 class="card-title">List of Barangay Details &nbsp;<a class="btn btn-primary btn-sm" data-toggle="modal" title="Add New Barangay" data-target="#modal-sm"><i class="fa fa-plus" style="color:white;"></i></a></h3>
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Barangay Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>

              </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM brgy_tbl $where");
                  $rs_brgy = $crud -> getResult();

                  foreach($rs_brgy as $rs_brgyval){

                ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $rs_brgyval['brgy_name'];?></td>
                    <td>
                      <a href="#" title="EDIT" id="brgy_<?php echo $rs_brgyval['brgy_id']; ?>" onclick="editBrgy('<?php echo $rs_brgyval['brgy_id']; ?>');" data-toggle="modal" data-target="#modal-editbrgy" data-backdrop="static" data-results='<?php echo json_encode($rs_brgyval); ?>'>
                      <i class="fa fa-edit fa-1x" STYLE="color:#771f1f;"></i></a>
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
  <div class="modal fade" id="modal-sm">
          <div class="modal-dialog modal-sm">
            <form role="form" method="post" id="form_addbarangay" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <div class="ribbon-wrapper">
                  <div class="ribbon bg-primary text-xs">
                    BRGY.
                  </div>
                </div>
                <h4 class="modal-title">Add New Barangay</h4>

              </div>
              <div class="modal-body">
                <div id="msgboxbrgy"></div>
                <div class="form-group">
                    <label for="text">Barangay</label>
                    <input type="text"  class="form-control" id="brgy_name" name="brgy_name" placeholder="Enter Brgy Name" required onkeyup="this.value = this.value.toUpperCase();" autofocus>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_addbrgy" name="btn_addbrgy" class="btn btn-primary">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- this is the modal for Editing records of barangay information  -->
        <div class="modal fade" id="modal-editbrgy">
                  <div class="modal-dialog modal-sm">
                    <form role="form" method="post" id="form_editbarangay" enctype="multipart/form-data">

                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="ribbon-wrapper">
                          <div class="ribbon bg-danger text-xs">
                            BRGY EDIT.
                          </div>
                        </div>
                        <h4 class="modal-title">Update Barangay</h4>

                      </div>
                      <div class="modal-body">
                        <div id="msgboxbrgyedit"></div>
                        <div class="form-group">
                          <input type="hidden" id="brgy_idedit" name="brgy_idedit">
                            <label for="text">Barangay</label>
                            <input type="text" class="form-control" id="brgy_namecc" name="brgy_namecc" placeholder="Enter Brgy Name" required onkeyup="this.value = this.value.toUpperCase();">
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn_editbrgy" name="btn_editbrgy" class="btn btn-danger">Update</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </form>
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<script type="text/javascript">
	function editBrgy(id) {
		var result = $('#brgy_'+id).data("results");
		console.log(result);
    $("#brgy_idedit").val(result.brgy_id);
		$("#brgy_namecc").val(result.brgy_name);
	}
</script>
