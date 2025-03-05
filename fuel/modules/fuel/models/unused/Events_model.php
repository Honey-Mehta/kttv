<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(FUEL_PATH.'models/Base_module_model.php');

class Events_model extends Base_module_model 
{
    public $required = ['headline'];
    public $record_class = 'Events_item';
    public $parsed_fields = ['content'];
     
    function __construct()
    {
        parent::__construct('events'); // table name
    }

    function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = false) 
    {
        $this->db->select('id, headline, release_date, published');
        return parent::list_items($limit, $offset, $col, $order, $just_count);
    }

    function on_before_clean($values)
{
    if (empty($values['slug'])) $values['slug'] = url_title($values['headline'], 'dash', TRUE);

    // Handle release_date
    if (!empty($values['release_date'])) {
        // Reformat if provided
        // echo($values['release_date']);
        // die();
        $values['release_date'] = date('Y-m-d', strtotime($values['release_date']));
        var_dump($values['release_date']); die;
    } else {
        // Default to today's date
        $values['release_date'] = date('Y-m-d');
    }

    return $values;
}


    function form_fields($values = [], $related = [])
    {
        $fields = parent::form_fields($values, $related);
        $fields['slug']['comment'] = 'If no slug is provided, one will be created automatically.';
        $fields['release_date'] = [
            'type' => 'date',
            'label' => 'Release Date',
            'comment' => 'A release date will be automatically created if left blank.',
        ];
        return $fields;
    }

    function _common_query($display_unpublished_if_logged_in = NULL)
    {
        parent::_common_query($display_unpublished_if_logged_in); 
        $this->db->order_by('release_date desc');
    }

    public function get_all_news()
    {
        $query = $this->db->get('events');
        return $query->result_array();
    }
}

class Events_item_model extends Base_module_record 
{
    protected $_date_format = 'F d, Y';

    function get_url()
    {
        if (!empty($this->link)) return $this->link;
        return site_url('events/'.$this->slug);
    }

    function get_excerpt_formatted($char_limit = NULL, $readmore = '')
    {
        $this->_CI->load->helper('typography');
        $this->_CI->load->helper('text');
        $excerpt = $this->content;

        if (!empty($char_limit)) {
            $excerpt = strip_tags($excerpt);
            $excerpt = character_limiter($excerpt, $char_limit);
        }
        $excerpt = auto_typography($excerpt);
        $excerpt = $this->_parse($excerpt);

        if (!empty($readmore)) {
            $excerpt .= ' '.anchor($this->get_url(), $readmore, 'class="readmore"');
        }
        return $excerpt;
    }
}
