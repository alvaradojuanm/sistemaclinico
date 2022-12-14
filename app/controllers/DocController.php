<?php 
/**
 * Doc Page Controller
 * @category  Controller
 */
class DocController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "doc";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("doc.id", 
			"doc.full_names", 
			"doc.address", 
			"doc.birthdate", 
			"doc.gender", 
			"doc.age", 
			"doc.Speciality", 
			"doc.register_date", 
			"doc.id_user", 
			"users.full_names AS users_full_names", 
			"doc.photo");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				doc.id LIKE ? OR 
				doc.full_names LIKE ? OR 
				doc.address LIKE ? OR 
				doc.birthdate LIKE ? OR 
				doc.gender LIKE ? OR 
				doc.age LIKE ? OR 
				doc.Speciality LIKE ? OR 
				doc.register_date LIKE ? OR 
				doc.update_date LIKE ? OR 
				doc.id_user LIKE ? OR 
				doc.photo LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "doc/search.php";
		}
		$db->join("users", "doc.id_user = users.id_user", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("doc.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Doctors";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("doc/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("doc.id", 
			"doc.full_names", 
			"doc.address", 
			"doc.birthdate", 
			"doc.gender", 
			"doc.age", 
			"doc.Speciality", 
			"doc.register_date", 
			"doc.update_date", 
			"doc.id_user", 
			"users.full_names AS users_full_names", 
			"doc.photo");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("doc.id", $rec_id);; //select record based on primary key
		}
		$db->join("users", "doc.id_user = users.id_user", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$this->write_to_log("view", "true");
			$record['update_date'] = human_date($record['update_date']);
			$page_title = $this->view->page_title = "View  Doctors";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
			$this->write_to_log("view", "false");
		}
		return $this->render_view("doc/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("full_names","address","birthdate","gender","age","Speciality","register_date","update_date","id_user","photo");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'full_names' => 'required',
				'address' => 'required',
				'birthdate' => 'required',
				'gender' => 'required',
				'age' => 'required',
				'Speciality' => 'required',
				'photo' => 'required',
			);
			$this->sanitize_array = array(
				'full_names' => 'sanitize_string',
				'address' => 'sanitize_string',
				'birthdate' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'age' => 'sanitize_string',
				'Speciality' => 'sanitize_string',
				'photo' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['register_date'] = datetime_now();
$modeldata['update_date'] = datetime_now();
$modeldata['id_user'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->write_to_log("add", "true");
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("doc");
				}
				else{
					$this->set_page_error();
					$this->write_to_log("add", "false");
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Doctors";
		$this->render_view("doc/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","full_names","address","birthdate","gender","age","Speciality","register_date","update_date","id_user","photo");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'full_names' => 'required',
				'address' => 'required',
				'birthdate' => 'required',
				'gender' => 'required',
				'age' => 'required',
				'Speciality' => 'required',
				'photo' => 'required',
			);
			$this->sanitize_array = array(
				'full_names' => 'sanitize_string',
				'address' => 'sanitize_string',
				'birthdate' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'age' => 'sanitize_string',
				'Speciality' => 'sanitize_string',
				'photo' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['register_date'] = datetime_now();
$modeldata['update_date'] = datetime_now();
$modeldata['id_user'] = USER_ID;
			if($this->validated()){
				$db->where("doc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->write_to_log("edit", "true");
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("doc");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
						$this->write_to_log("edit", "false");
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						$this->write_to_log("edit", "false");
						return	$this->redirect("doc");
					}
				}
			}
		}
		$db->where("doc.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Doctors";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("doc/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","full_names","address","birthdate","gender","age","Speciality","register_date","update_date","id_user","photo");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'full_names' => 'required',
				'address' => 'required',
				'birthdate' => 'required',
				'gender' => 'required',
				'age' => 'required',
				'Speciality' => 'required',
				'photo' => 'required',
			);
			$this->sanitize_array = array(
				'full_names' => 'sanitize_string',
				'address' => 'sanitize_string',
				'birthdate' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'age' => 'sanitize_string',
				'Speciality' => 'sanitize_string',
				'photo' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("doc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					$this->write_to_log("edit", "true");
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					$this->write_to_log("edit", "false");
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("doc.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->write_to_log("delete", "true");
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
			$this->write_to_log("delete", "false");
		}
		return	$this->redirect("doc");
	}
}
