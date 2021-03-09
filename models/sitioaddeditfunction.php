<?php
include_once '../controller/mysql_crud.php';
include_once '../controller/userfunction.php';

$action="";
if(isset($_GET['action'])){
	$action=$_GET['action'];
}
//adding new pig
if($action=="addsitio"){
	$crud = new CRUD();
	$crud->connect();
	if(checkbarangay($_GET['sitio_name']) == 0 ){
		$crud -> insert("sitio_tbl", array("sitio_id"=>'SITIO-'.$_GET['sitio_id'].generateCode(), "sitio_name"=>$_GET['sitio_name'], "brgy_id_fk"=>$_GET['sitio_id']));
		$rs = $crud -> getResult();
		if($rs){
			echo 1;
		}else{
			echo 0;
		}
	}
	$crud->disconnect();
}
function checkbarangay($brgy_name){
	$crud = new CRUD();
	$crud->connect();

	$crud -> sql("select * from sitio_tbl where sitio_name='". $brgy_name. "'");
	$rsf = $crud->getResult();
	$rowf = $crud->numRows();
	return $rowf;

	$crud->disconnect();
}

//sitio check if existing or not
if($action=="checksitiodetails"){
	$crud = new CRUD();
	$crud->connect();

	$crud -> sql("SELECT * FROM sitio_tbl WHERE sitio_name = '".$_GET['sitio_name']."'");
	$rs = $crud -> getResult();
	$row = $crud -> numRows();
	echo $row;
	$crud->disconnect();
}
//editing Sitio
if($action=="editsitio"){
	$crud = new CRUD();
	$crud->connect();
	$crud -> update("sitio_tbl", array("sitio_name"=>$_GET['sitio_namecc'], "brgy_id_fk"=>$_GET['brgy_id_fksitio']), "sitio_id='{$_GET['sitio_idedit']}'");
	$rs = $crud -> getResult();
	if($rs){
		echo 1;
	}else{
		echo 0;
	}
	$crud->disconnect();
}

?>
