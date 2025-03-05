<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Base_module_model.php');

class Marquee_model extends Base_module_model
{
    public $required = array('headline','description');
    public $record_class = 'Marquee_item_model';

    function __construct()
    {
        parent::__construct('marquee'); // table name
    }

    function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'desc', $just_count = false)
    {
        $this->db->select('id, headline, description, new, published');
        $data = parent::list_items($limit, $offset, $col, $order);

    

        return $data;
    }


    // function on_before_save($values)
    // {
    //     //   echo 'test'; die;
    //
    //     if (!empty($values['release_date']))
    //       die;
    //         // $values['release_date'] = datetime_now();
    //         $values['release_date'] = date('Y-m-d', strtotime($values['release_date']));
    //     return $values;
    // }

    
	function on_before_clean($values)
	{
      
		
	
			
	}

    function form_fields($values = array(), $related = array())
    {
        $fields = parent::form_fields();
      
        return $fields;
    }

    function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query();
        $this->db->order_by('id', 'desc');
    }

    public function on_before_validate($values)
    {
       

        if (!empty($values['headline'])) {
            $headline = $values['headline'];
        
            // Validate headline: allows Hindi, English letters, numbers, spaces, and special characters (., /, [])
            // Limit input to a maximum of 150 characters
            if (!preg_match('/^[A-Za-z0-9\x{0900}-\x{097F}\-\/\.,\[\]\s]{1,150}$/u', $headline)) {
                $this->add_error(
                    'Only Hindi, English letters, numbers, spaces, and ., /, [] characters are allowed in the headline, with a maximum of 150 characters.',
                    'headline'
                );
                return;
            }
        }

       
       

        // Validate published field
        if (isset($values['published']) && !in_array($values['published'], ['yes', 'no'])) {
            $this->add_error('Invalid value for published.', 'published');
            return;
        }

      


       



        return $values;
    }
}

class Marquee_item_model extends Base_module_record
{
    
}
