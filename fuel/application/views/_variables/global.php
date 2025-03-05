<?php 

// declared here so we don't have to in each controller's variable file
$CI =& get_instance();

// generic global page variables used for all pages
$vars = array();
$vars['layout'] = 'main';
$vars['page_title'] = fuel_nav(array('render_type' => 'page_title', 'delimiter' => ' : ', 'order' => 'desc', 'home_link' => 'Home'));
$vars['meta_keywords'] = '';
$vars['meta_description'] = '';
$vars['js'] = array();
$vars['css'] = array();
$vars['body_class'] = uri_segment(1).' '.uri_segment(2);

//$vars['sidemenu'] = fuel_nav(array('container_tag'=>'div', 'depth'=>1, 'container_tag_class' => 'list-group','item_tag'=>'div', 'parent' => uri_segment(1)));
$vars['sidemenu'] = bootstrap_menu(array('parent' => uri_segment(1)), NULL, TRUE); // last arg switches toggle behaviour for drop-downs

// page specific variables
$pages = array();

?>