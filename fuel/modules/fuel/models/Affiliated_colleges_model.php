<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');
class Affiliated_colleges_model extends Base_module_model {

	public $required = array('college_name','estd_year','college_type','city','address');
	public $filters = array('college_type'); // the default list view group value for filtering
	public $record_class = 'affiliated_college';
	//public $parsed_fields = array('content');
	
	function __construct()
	{
		parent::__construct('affiliated_college'); // table name
	}

	function list_items($limit = NULL, $offset = NULL, $col = 'created', $order = 'desc', $just_count = false)
	{
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}


	function form_fields($values = array(), $related = array())
	{	
		$fields = parent::form_fields();
		$fields['college_type']['options'] = array('Government College' => 'सरकारी महाविद्यालय', 'Aided College' => 'सहायता-प्राप्त महाविद्यालय', 'Private College' => 'निजी महाविद्यालय');
		$fields['college_type']['type'] = 'select';
		$fields['contact_no']['comment'] = 'This number will be published on public page.';

		unset($fields['created']);
		return $fields;

	}

	function on_before_clean($values)
	{
		//if (empty($values['slug'])) $valuestype['slug'] = url_title($values['headline'], 'dash', TRUE);
		$values['created'] = datetime_now();
		return $values;
	}


	function _common_query($display_unpublished_if_logged_in = NULL)
	{
		parent::_common_query(); // to do active and published
		//$this->db->select('user_role.name AS Department,course_name,duration,course_type,eligibility,published,'.$this->_tables['affiliated_college'].'.id');
		//$this->db->join($this->_tables['fuel_user_role'], $this->_tables['fuel_user_role'].'.id = '.$this->_tables['affiliated_college'].'.group_id', 'left');
		//$this->db->order_by('release_date desc');
	}
	public function on_before_validate($values)
	{
		//  validations
		// var_dump($values);
		// die;
		if (!empty($values['college_name'])) {
			$college_name = $values['college_name'];
			if (!ctype_alpha($college_name)) {
				$this->add_error('Only alphabetical characters allowed in college name', 'college_name');
				return;
			}
		}
		if (!empty($values['estd_year'])) {
			$estd_year = $values['estd_year'];
			if (!preg_match('(^[12]{1}\d{3}$)', $estd_year) || $estd_year > date('Y')) {
				$this->add_error('Invalid Estd year!', 'estd_year');
				return;
			}
		}
		if (!empty($values['address'])) {
			$address = $values['address'];
			if (!ctype_alnum($address)) {
				$this->add_error('Only alphanumeric characters allowed in address', 'address');
				return;
			}
		}
		if (!empty($values['city'])) {
			$city = $values['city'];
			if (!ctype_alpha($city)) {
				$this->add_error('Only alphabetical characters allowed in city', 'city');
				return;
			}
		}
		if (!empty($values['district'])) {
			$district = $values['district'];
			if (!ctype_alpha($district)) {
				$this->add_error('Only alphabetical characters allowed in district', 'district');
				return;
			}
		}
		if (!empty($values['contact_no'])) {
			$contact_no = $values['contact_no'];
			if (!preg_match('(^[6789]{1}\d{9}$)', $contact_no)) {
				$this->add_error('Invalid Contact Number!', 'contact_no');
				return;
			}
		}
		if (!empty($values['fax_no'])) {
			$fax_no = $values['fax_no'];
			if (!preg_match('(^[0]{1}\d{10}$)', $fax_no)) {
				$this->add_error('Invalid fax Number!', 'fax_no');
				return;
			}
		}
		if (!empty($values['email'])) {
			$email = $values['email'];
			if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
				$this->add_error('Enter valid email address.', 'email');
				return;
			}
		}
		if (!empty($values['website'])) {
			$website = $values['website'];
			if (!filter_var($website,FILTER_VALIDATE_URL)) {
				$this->add_error('Enter valid website address.', 'website');
				return;
			}
		}
		// address city district contact_no email fax_no website published created
		$published = $values['published'];
		if (!in_array($published, ['yes', 'no'])) {
			$this->add_error('Invalid published.', 'published');
			return;
		}
		
		return $values;
	}
}

class Affiliated_college_model extends Base_module_record {
	
}
?>
