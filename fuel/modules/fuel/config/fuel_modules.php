<?php 
/*
|--------------------------------------------------------------------------
| Built In Modules **** DO NOT MODIFY ****
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/

$config['modules'] = array();

// Pages module init values
$config['modules']['pages'] = array(
	'module_name' => 'Pages',
	'model_location' => 'fuel',
	'model_name' => 'fuel_pages_model',
	'display_field' => 'location',
	'table_headers' => array(
		'id', 
		'location', 
		'assign_role',
		'layout', 
		'last_modified',
		'published',
	),
	'default_col' => 'location',
	'default_order' => 'asc',
	'js_controller' => 'fuel.controller.PageController',
	'js_controller_params' => array('import_field' => 'vars--body'),
	'preview_path' => '{location}',
	'permission' => array(
		'pages', 'create', 'edit',
		'pages/upload' => 'pages/create',
		'publish', 'delete'
	),
	'instructions' => lang('pages_instructions'),
	'archivable' => TRUE,
	'sanitize_input' => array('template','php'),
	// 'list_actions' => array('pages/upload' => lang('btn_upload')),
	'item_actions' => array(
		'save', 'view', 'publish', 'delete', 'duplicate', 'replace', 'create',
		// 'others' => array('pages/upload' => lang('btn_upload'))
	),
	'advanced_search' => TRUE,
	'filters' => array(
		'layout' => array(
			'default' => 1,
			'label' => lang('form_label_layout'),
			'type' => 'select',
			'model' => 'fuel_pages_model',
			'model_params' => array('layout', 'layout'),
			'hide_if_one' => TRUE,
			'default' => '',
			'first_option' => 'Select a layout...',
		),
		'published' => array(
			'default' => 1,
			'label' => lang('form_label_published'),
			'type' => 'select',
			'options' => array('yes' => 'Published', 'no' =>'Unpublished'),
			'hide_if_one' => TRUE,
			'default' => '',
			'first_option' => 'Select only...',
		),
	),
);

// Pagevariables module init values
$config['modules']['pagevariables'] = array(
	'module_name' => 'Page Variables',
	'model_location' => 'fuel',
	'model_name' => 'fuel_pagevariables_model',
	'display_field' => 'name',
	'table_headers' => array(
		'id', 
		'location', 
		'name',
		'value',
		'type'
	),
	'sanitize_input' => array('template','php'),
	'default_col' => 'page_id',
	'default_order' => 'asc',
	'permission' => array(
		'create' => 'pages/create',
		'edit' => 'pages/edit',
		'publish' => 'pages/publish',
		'delete' => 'pages/delete'
	),
	'hidden' => TRUE
);

// Blocks module init values
$config['modules']['blocks'] = array(
	'module_name' => 'Blocks',
	'model_location' => 'fuel',
	'model_name' => 'fuel_blocks_model',
	'display_field' => 'name',
	'permission' => array(
		'blocks', 'create', 'edit',
		'blocks/upload' => 'blocks/create',
		'publish', 'delete'
	),
	'default_col' => 'name',
	'default_order' => 'asc',
	'js_controller' => 'fuel.controller.BlockController',
	'sanitize_input' => array('template','php'),
	// 'list_actions' => array('blocks/upload' => lang('btn_upload')),
	'item_actions' => array('save', 'view', 'publish', 'delete', 'duplicate', 'replace', 'create',
		// 'others' => array('blocks/upload' => lang('btn_upload'))
	)
);

// Navigation module init values
$config['modules']['navigation'] = array(
	'module_name' => 'Navigation',
	'model_location' => 'fuel',
	'model_name' => 'fuel_navigation_model',
	'display_field' => 'label',
	'default_col' => 'nav_key',
	'default_order' => 'asc',
	'js_controller' => 'fuel.controller.NavigationController',
	'preview_path' => '',
	'permission' => array(
		'navigation', 'create', 'edit',
		'navigation/upload' => 'navigation/create',
		'publish', 'delete'
	),
	'instructions' => lang('navigation_instructions'),
	'filters' => array(
		'group_id' => array(
			'default' => 1,
			'label' => lang('form_label_navigation_group'),
			'type' => 'select',
			'model' => 'fuel_navigation_groups_model',
			'hide_if_one' => TRUE
		)
	),
	'archivable' => TRUE,
	'list_actions' => array(
		// 'navigation/upload' => lang('btn_upload'),
		// 'navigation/download' => lang('btn_download')
	)
);

// Navigation module init values
$config['modules']['navigation_group'] = array(
	'module_name' => 'Navigation Groups',
	'model_location' => 'fuel',
	'model_name' => 'fuel_navigation_groups_model',
	'table_headers' => array(
		'id', 
		'name', 
		'published'
	),
	'permission' => 'navigation'
);

// Categories module init values
$config['modules']['categories'] = array(
	'module_name' => 'Categories',
	'model_location' => 'fuel',
	'model_name' => 'fuel_categories_model',
	// 'table_headers' => array(
	// 	'id', 
	// 	'name', 
	// 	'slug',
	// 	'context',
	// 	'parent_id',
	// 	'precedence',
	// 	'published',
	// ),
	'filters' => array(
		'context' => array(
			'label' => lang('form_label_context'),
			'type' => 'select',
			'model' => array(
				FUEL_FOLDER => array(
					'fuel_categories_model' => 'context_options_list'
				)
			),
			'first_option' => 'Select a context...'
		)
	)
);

// Tags module init values
$config['modules']['tags'] = array(
	'module_name' => 'Tags',
	'model_location' => 'fuel',
	'model_name' => 'fuel_tags_model',
	// 'table_headers' => array(
	// 	'id', 
	// 	'name', 
	// 	'slug',
	// 	'published'
	// )
);

// Assets module init values
$config['modules']['assets'] = array(
	'module_name' => 'Assets',
	'model_location' => 'fuel',
	'model_name' => 'fuel_assets_model',
	'table_headers' => array(
		'id',
		'name', 
		'preview/kb', 
		'link', 
		'last_updated',
	),
	'default_col' => 'name',
	'default_order' => 'asc',
	'js_controller' => 'fuel.controller.AssetsController',
	'display_field' => 'name',
	'preview_path' => '',
	'permission' => 'assets',
	'instructions' => lang('assets_instructions'),
	'filters' => array(
		'group_id' => array(
			'default' => 0,
			'label' => lang('form_label_asset_folder'),
			'type' => 'select',
			'options' => array(
				0 => 'images'
			),
			'default' => 'images'
		)
	),
	'archivable' => FALSE,
	'table_actions' => array('DELETE'),
	'rows_selectable' => FALSE,
	'create_action_name' => lang('btn_upload'),
	'sanitize_images' => FALSE
);

// Sitevariables module init values
$config['modules']['sitevariables'] = array(
	'module_name' => 'Site Variables',
	'model_location' => 'fuel',
	'model_name' => 'fuel_sitevariables_model',
	'table_headers' => array(
		'id', 
		'name', 
		'value', 
		'scope', 
		'active', 
	),
	'display_field' => 'name',
	'preview_path' => '',
	'permission' => 'sitevariables',
	'instructions' => lang('sitevariables_instructions'),
	'archivable' => FALSE,
	'item_actions' => array('save', 'activate', 'duplicate', 'create', 'delete'),
	'clear_cache_on_save' => FALSE
);
// User role group
$config['modules']['user_role'] = array(
	'module_name' => 'Departments',
	'model_location' => 'fuel',
	'js_controller' => 'fuel.controller.User_roleController',
	'model_name' => 'fuel_user_roles_model',
	'permission' => array(
		'create' => 'user_role/create',
		'edit' => 'user_role/edit',
		'publish' => 'user_role/publish',
		'delete' => 'user_role/delete'
	)
);

// Users module init values
$config['modules']['users'] = array(
	'module_name' => 'Users',
	'model_location' => 'fuel',
	'model_name' => 'fuel_users_model',
	'table_headers' => array(
		'id', 
		'email', 
		'user_name', 
		'first_name', 
		'last_name', 
		'super_admin',
		'department',
		'active'
	),
	'language_col' => FALSE, // so it won't render the dropdown filter select
	'js_controller' => 'fuel.controller.UserController',
	'display_field' => 'email',
	'preview_path' => '',
	'permission' => 'users',
	'instructions' => lang('users_instructions'),
	'archivable' => FALSE,
	'table_actions' => array(
		'EDIT',
		'DELETE' => array(
			'func' => function($cols){
					if ($cols['super_admin'] != "yes") { 
						$CI =& get_instance();
						$link = "";
						if ($CI->fuel->auth->has_permission($CI->permission, "delete") && isset($cols[$CI->model->key_field()]))
						{
							$url = site_url("/".$CI->config->item("fuel_path", "fuel").$CI->module_uri."/delete/".$cols[$CI->model->key_field()]);
							$link = "<a href=\"".$url."\">".lang("table_action_delete")."</a>";
							$link .= " <input type=\"checkbox\" name=\"delete[".$cols[$CI->model->key_field()]."]\" value=\"1\" id=\"delete_".$cols[$CI->model->key_field()]."\" class=\"multi_delete\"/>";
						}
						return $link;
					}
				}
			),
		'LOGIN' => array(
			'func' => function($cols){
				$CI =& get_instance();
				$link = "";
				$user = $CI->fuel->auth->user_data();
				if ($CI->fuel->auth->is_super_admin() && ($cols[$CI->model->key_field()] != $user["id"]))
				{
					$url = site_url("/".$CI->config->item("fuel_path", "fuel").$CI->module_uri."/login_as/".$cols[$CI->model->key_field()]);
					$link = "<a href=\"".$url."\">".lang("table_action_login_as")."</a>";
				}
				return $link;
				},
			),
		),
	'item_actions' => array('save', 'activate', 'duplicate', 'create', 'delete'),
	'clear_cache_on_save' => FALSE
);

// Permissions module init values
$config['modules']['permissions'] = array(
	'module_name' => 'Permissions',
	'model_location' => 'fuel',
	'model_name' => 'fuel_permissions_model',
	'table_headers' => array(
		'id', 
		'description', 
		'name', 
		'active', 
	),
	
	'display_field' => 'name',
	'preview_path' => '',
	'permission' => 'permissions',
	'instructions' => lang('permissions_instructions'),
	'archivable' => FALSE,
	'item_actions' => array('save', 'delete', 'create'),
	'clear_cache_on_save' => FALSE
);

// Logs module init values
$config['modules']['logs'] = array(
	'module_name' => 'Activity Log',
	'model_location' => 'fuel',
	'model_name' => 'fuel_logs_model',
	'table_headers' => array(
		'id', 
		'entry_date', 
		'name', 
		'message', 
		'type', 
	),
	'default_col' => 'entry_date',
	'default_order' => 'desc',
	'display_field' => 'message',
	'preview_path' => '',
	'permission' => 'logs',
	'archivable' => FALSE,
	'item_actions' => array(),
	'table_actions' => array(),
	'rows_selectable' => FALSE,
	'clear_cache_on_save' => FALSE,
	'filters' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Type:',
			'options' => array(
				'info' => 'info',
				'debug' => 'debug'
			),
			'first_option' => lang('label_select_one')
		)
	)
);

$config['modules']['notification'] = array(
	'module_name' => 'Notification',
	'model_location' => 'fuel',
	'model_name' => 'notification_model',
	'default_col' => 'release_date',
	'default_order' => 'desc',
	'permission' => 'notification',
	'filters' => array(
		'group_id' => array(
			'default' => 3,
			'label' => lang('form_label_notification_group'),
			'type' => 'select',
			'model' => 'fuel_notification_groups_model',
			'hide_if_one' => TRUE)
		),
	'preview_path' => 'notification/{slug}'
);







// Navigation module init values
$config['modules']['notification_group'] = array(
	'module_name' => 'Notification Groups',
	'model_location' => 'fuel',
	'model_name' => 'fuel_notification_groups_model',
	'table_headers' => array(
		'id', 
		'name', 
		'published'
	),
	'permission' => 'notification'
);

//Added by Jyoti to link imp_links model with imp_links view
$config['modules']['imp_links'] = array(
	'module_name' => 'imp_links',
	'model_location' => 'fuel',
	'model_name' => 'Imp_links_model',
	'default_col' => 'release_date',
	'default_order' => 'desc',
	'permission' => 'imp_links',
	// 'filters' => array(
	// 	'group_id' => array(
	// 		'default' => 3,
	// 		// 'label' => lang('Imp_links_model'),
	// 		'type' => 'select',
	// 		'model' => 'imp_links',
	// 		'hide_if_one' => TRUE)
	// 	),
	// 'preview_path' => 'notification/{slug}'
);
//Added by Jyoti to link news model with news view
$config['modules']['news'] = array(
	'module_name' => 'news',
	'model_location' => 'fuel',
	'model_name' => 'news_model',
	'default_col' => 'release_date',
	'default_order' => 'desc',
	'permission' => 'news',
	'filters' => array(
		'group_id' => array(
			'default' => 3,
			'label' => lang('form_label_notification_group'),
			'type' => 'select',
			'model' => 'fuel_notification_groups_model',
			'hide_if_one' => TRUE)
		),
	'preview_path' => 'notification/{slug}'
);


$config['modules']['slider'] = array(
	'module_name' => 'Slider',
	'model_location' => 'fuel',
	'model_name' => 'slider_model',
	'permission' => 'slider'
);

$config['modules']['courses'] = array(
	'module_name' => 'Courses',
	'model_location' => 'fuel',
	'item_actions' => array(
		'save', 'publish', 'delete', 'create'
	),
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'courses_model',
	'permission' => array(
		'create' => 'courses/create',
		'edit' => 'courses/edit',
		'publish' => 'courses/publish',
		'delete' => 'courses/delete'
	),
);

$config['modules']['faculties'] = array(
	'module_name' => 'Faculty Members',
	'model_location' => 'fuel',
	'item_actions' => array(
		'save', 'publish', 'delete', 'create'
	),
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'faculties_model',
	'permission' => array(
		'create' => 'faculties/create',
		'edit' => 'faculties/edit',
		'publish' => 'faculties/publish',
		'delete' => 'faculties/delete'
	),
);

$config['modules']['alumni'] = array(
	'module_name' => 'Alumni',
	'model_location' => 'fuel',
	'item_actions' => array(
		'save', 'publish', 'delete', 'create'
	),
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'alumni_model',
	'permission' => array(
		'create' => 'alumni/create',
		'edit' => 'alumni/edit',
		'publish' => 'alumni/publish',
		'delete' => 'alumni/delete'
	),
);


$config['modules']['placements'] = array(
	'module_name' => 'Students Placement',
	'model_location' => 'fuel',
	'item_actions' => array(
		'save', 'publish', 'delete', 'create'
	),
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'placements_model',
	'permission' => array(
		'create' => 'placements/create',
		'edit' => 'placements/edit',
		'publish' => 'placements/publish',
		'delete' => 'placements/delete'
	),
);

$config['modules']['departmental_news'] = array(
	'module_name' => 'Departmental News',
	'model_location' => 'fuel',
	'item_actions' => array(
		'save', 'publish', 'delete', 'create'
	),
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'depart_news_model',

	'permission' => array(
		'create' => 'departmental_news/create',
		'edit' => 'departmental_news/edit',
		'publish' => 'departmental_news/publish',
		'delete' => 'departmental_news/delete'
	),
);
$config['modules']['affiliated_college'] = array(
	'module_name' => 'Affiliated Colleges',
	'model_location' => 'fuel',
	'default_col' => 'college_type', //in admin table
	'default_order' => 'asc',
	'model_name' => 'affiliated_colleges_model',

	'permission' => 'affiliated_college'
);

$config['modules']['telephone_directory'] = array(
	'module_name' => 'Public TelePhone Directory',
	'model_location' => 'fuel',
	'default_col' => 'Department', //in admin table
	'default_order' => 'asc',
	'model_name' => 'telephone_directory_model',
	'permission' => array(
		'create' => 'telephone_directory/create',
		'edit' => 'telephone_directory/edit',
		'publish' => 'telephone_directory/publish',
		'delete' => 'telephone_directory/delete'
	),
);




$config['modules']['testimonial'] = array(
	'module_name' => '',
	'model_location' => 'fuel',
	'default_col' => 'name', //in admin table
	'default_order' => 'asc',
	'model_name' => 'testimonial_model',
	'permission' => array(
		'create' => 'testimonial/create',
		'edit' => 'testimonial/edit',
		'publish' => 'testimonial/publish',
		'delete' => 'testimonial/delete'
	),
);












//@include(APPPATH.'config/MY_fuel_modules.php');

/* End of file fuel_modules.php */
/* Location: ./modules/fuel/config/fuel_modules.php */