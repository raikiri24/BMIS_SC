<?php

if($usertype=="Administrator"){
$where = "ORDER BY sitio_name ASC";
}elseif($usertype=="BarangayCaptain" || $usertype=="Kagawad"){
$where = "WHERE brgy_id_fk='{$brgy_id}' ORDER BY sitio_name ASC ";
}

?>

<div class="content-wrapper" style="min-height: 1589.56px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of Sitio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sitio</a></li>
              <li class="breadcrumb-item active">Sitio List</li>
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
              SITIO.
            </div>
          </div>
          <h3 class="card-title">List of Sitio Details &nbsp;<a class="btn btn-primary btn-sm" data-toggle="modal" title="Add New Sitio" data-target="#modal-sitio"><i class="fa fa-plus" style="color:white;"></i></a></h3>
        </div>
        <div class="card-body table-responsive" style="display: block;">


          <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Sitio Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Barangay Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Action</th>

              </tr>
              </thead>
              <tbody>
                <?php
                  $c = 1;
                  $crud -> sql("SELECT * FROM sitio_tbl $where");
                  $rs_sitio = $crud -> getResult();

                  foreach($rs_sitio as $rs_sitioval){

                ?>

                <tr role="row" class="even">
                    <td class="sorting_1"><?php echo $c;?></td>
                    <td><?php echo $rs_sitioval['sitio_name'];?></td>
                    <td><?php echo getbrgyname($rs_sitioval['brgy_id_fk']);?></td>
                    <td>
                      <a href="#" title="EDIT" id="sitio_<?php echo $rs_sitioval['sitio_id']; ?>" onclick="editSitio('<?php echo $rs_sitioval['sitio_id']; ?>');" data-toggle="modal" data-target="#modal-editsitio" data-backdrop="static" data-results='<?php echo json_encode($rs_sitioval); ?>'>
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
  <div class="modal fade" id="modal-sitio">
          <div class="modal-dialog modal-sm">
            <form role="form" method="post" id="form_addsitio" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <div class="ribbon-wrapper">
                  <div class="ribbon bg-primary text-xs">
                    SITIO.
                  </div>
                </div>
                <h4 class="modal-title">Add New Sitio</h4>

              </div>
              <div class="modal-body">
                <div id="msgboxsitio"></div>
                <input type="hidden" name="sitio_id" id="sitio_id" value="<?php echo $brgy_id;?>">
                <div class="form-group">
                    <label for="text">Sitio</label>
                    <input type="text" class="form-control" id="sitio_name" name="sitio_name" placeholder="Enter Sitio Name" required onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btn_addsitio" name="btn_addsitio" class="btn btn-primary">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- this is the modal for Editing records of barangay information  -->
        <div class="modal fade" id="modal-editsitio">
                  <div class="modal-dialog modal-sm">
                    <form role="form" method="post" id="form_editsitio" enctype="multipart/form-data">

                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="ribbon-wrapper">
                          <div class="ribbon bg-danger text-xs">
                            SITIO EDIT.
                          </div>
                        </div>
                        <h4 class="modal-title">Update Sitio</h4>

                      </div>
                      <div class="modal-body">
                        <div id="msgboxsitioedit"></div>
                        <div class="form-group">
                          <input type="hidden" name="brgy_id_fksitio" id="brgy_id_fksitio" value="<?php echo $brgy_id;?>">
                          <input type="hidden" id="sitio_idedit" name="sitio_idedit">
                            <label for="text">Barangay</label>
                            <input type="text" class="form-control" id="sitio_namecc" name="sitio_namecc" placeholder="Enter Brgy Name" required>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn_editsitio" name="btn_editsitio" class="btn btn-danger">Update</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </form>
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<script type="text/javascript">
	function editSitio(id) {
		var result = $('#sitio_'+id).data("results");
		console.log(result);
    $("#sitio_idedit").val(result.sitio_id);
		$("#sitio_namecc").val(result.sitio_name);
	}
</script>
