<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');

class Admission_model extends Base_module_model
{
    public $required = array('headline');
    public $record_class = 'Admission_item_model';

    function __construct()
    {
        parent::__construct('admissions'); // table name
    }

    function list_items($limit = NULL, $offset = NULL, $col = 'release_date', $order = 'desc', $just_count = false)
    {
        $this->db->select('id, headline, release_date, published, description, pdf');
        $data = parent::list_items($limit, $offset, $col, $order);

        foreach ($data as $key => $value) {
            // Convert PDF field to a download link
            if (!empty($value['pdf'])) {
                $data[$key]['pdf'] = '<a href="' . img_path('admissions/' . $value['pdf']) . '" target="_blank">Download PDF</a>';
            }
        }

        return $data;
    }

    function on_before_clean($values)
    {
          
        if (!intval($values['release_date']))
            // $values['release_date'] = datetime_now();
            $values['release_date'] = date('Y-m-d', strtotime($values['release_date']));
        return $values;
    }

    function form_fields($values = array(), $related = array())
    {
        $fields = parent::form_fields();
        // $CI =& get_instance();
		// // notification group
		// if (empty ($CI->fuel_notification_groups_model)) {
		// 	$CI->load->module_model(FUEL_FOLDER, 'fuel_notification_groups_model');
		// }
		// $group_options = $CI->fuel_notification_groups_model->options_list();

        // PDF upload field
        $fields['pdf'] = array(
            'type' => 'asset',
            'multiple' => FALSE,
            'folder' => 'images/admissions', // Updated folder path
            'comment' => 'Upload a PDF file.',
        );

        // Title field
        $fields['headline'] = array(
            'type' => 'text',
            'label' => 'Headline',
            'comment' => 'Enter the headline for the admission record.',
        );

        $fields['release_date']['comment'] = 'A release date will automatically be created for you of the current date if left blank';


        // Description field
        $fields['description'] = array(
            'type' => 'textarea',
            'label' => 'Description',
            'comment' => 'Provide a brief description of the admission details.',
        );

        // Published field
        $fields['published'] = array(
            'type' => 'enum',
            'options' => array('yes' => 'Yes', 'no' => 'No'),
            'default' => 'yes',
            'label' => 'Published',
            'comment' => 'Select whether this record should be published.',
        );

        return $fields;
    }

    function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query();
        $this->db->order_by('release_date', 'desc');
    }

    public function on_before_validate($values)
    {
       

        // Validate PDF file
        if (!empty($values['pdf'])) {
            $pdf = $values['pdf'];
            if (!preg_match('/^[a-zA-Z0-9_\/-]+(?:\.[a-zA-Z0-9]{1,5})?$/', $pdf)) {
                $this->add_error('Only alphanumeric, slash characters, and single dot extension are allowed in PDF.', 'pdf');
                return;
            }

            $ext = pathinfo($pdf, PATHINFO_EXTENSION);
            if (strtolower($ext) !== 'pdf') {
                $this->add_error('Only PDF files are allowed.', 'pdf');
                return;
            }
        }

        // Validate published field
        if (isset($values['published']) && !in_array($values['published'], ['yes', 'no'])) {
            $this->add_error('Invalid value for published.', 'published');
            return;
        }

        $release_date = $values['release_date'];
		$is_dateValid=(bool)strtotime($release_date);
		if(!$is_dateValid){
			$this->add_error('Release date is invalid! Enter a valid date format.', 'release_date');
			return;
		}



        return $values;
    }
}

class Admission_item_model extends Base_module_record
{
    protected $_date_format = 'F d, Y';

    // Generate the full URL for the PDF
    function get_pdf_path()
    {
        return img_path('admissions/' . $this->pdf);
    }
}
