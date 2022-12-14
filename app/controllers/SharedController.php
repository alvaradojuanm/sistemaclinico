<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * users_user_name_value_exist Model Action
     * @return array
     */
	function users_user_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("user_name", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * clinic_patients_id_status_option_list Model Action
     * @return array
     */
	function clinic_patients_id_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,status AS label FROM patients_status ORDER BY status ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * clinic_patients_id_status_default_value Model Action
     * @return Value
     */
	function clinic_patients_id_status_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  ps.id, ps.status FROM patients_status AS ps";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * appointment_new_id_patient_option_list Model Action
     * @return array
     */
	function appointment_new_id_patient_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_patient AS value , full_names AS label FROM clinic_patients ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * appointment_new_id_doc_option_list Model Action
     * @return array
     */
	function appointment_new_id_doc_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , full_names AS label FROM doc ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * clinic_prescription_additional_comments_option_list Model Action
     * @return array
     */
	function clinic_prescription_additional_comments_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , id AS label FROM patients_status ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * clinic_prescription_id_patient_option_list Model Action
     * @return array
     */
	function clinic_prescription_id_patient_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_patient AS value , full_names AS label FROM clinic_patients ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * clinic_prescription_id_doctor_option_list Model Action
     * @return array
     */
	function clinic_prescription_id_doctor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , full_names AS label FROM doc ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * clinic_prescription_id_appointment_option_list Model Action
     * @return array
     */
	function clinic_prescription_id_appointment_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_appointment AS value,descritption AS label FROM appointment_new ORDER BY id_appointment ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * invoices_id_patient_option_list Model Action
     * @return array
     */
	function invoices_id_patient_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_patient AS value , full_names AS label FROM clinic_patients ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * invoices_id_concept_option_list Model Action
     * @return array
     */
	function invoices_id_concept_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,concept AS label FROM invoices_concepts ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * invoices_id_invoice_status_option_list Model Action
     * @return array
     */
	function invoices_id_invoice_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,status AS label FROM invoice_status ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_users Model Action
     * @return Value
     */
	function getcount_users(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM users";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_patients Model Action
     * @return Value
     */
	function getcount_patients(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM clinic_patients";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_inactivespatients Model Action
     * @return Value
     */
	function getcount_inactivespatients(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM inactives_patients";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_activespatients Model Action
     * @return Value
     */
	function getcount_activespatients(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM actives_patients";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_appointments Model Action
     * @return Value
     */
	function getcount_appointments(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM appointments";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_invoices Model Action
     * @return Value
     */
	function getcount_invoices(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM invoices";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_doctors Model Action
     * @return Value
     */
	function getcount_doctors(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM doc";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prescriptions Model Action
     * @return Value
     */
	function getcount_prescriptions(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM clinic_prescription";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
