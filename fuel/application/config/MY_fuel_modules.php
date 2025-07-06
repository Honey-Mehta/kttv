<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/


/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** /EXAMPLE ***********************************/



/*********************** OVERWRITES ************************************/

$config['module_overwrites']['categories']['hidden'] = TRUE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module
 

/*********************** /OVERWRITES ************************************/
$config['modules']['events'] = [
    'module_name' => 'events',
    'model_name' => 'Events_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'headline',
    'default_col' => 'release_date',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => 'events',
    'module_uri' => 'events',
    'table_headers' => ['id', 'headline', 'release_date', 'published'],  // Admin columns
];


$config['modules']['employees'] = [
    'module_name' => 'employees',
    'model_name' => 'Employees_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => 'employees',
    'module_uri' => 'employees',
    'table_headers' => ['id', 'name', 'designation', 'qualification', 'subject', 'experience', 'image', 'published'],  // Admin columns
];


$config['modules']['photo'] = [
    'module_name' => 'photo',
    'model_name' => 'Photo_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'photo/create',
		'edit' => 'photo/edit',
		'publish' => 'photo/publish',
		'delete' => 'photo/delete'
	),
    'module_uri' => 'photo',
    'table_headers' => ['id', 'name', 'description', 'image', 'published'],  // Admin columns
];


$config['modules']['colleges_course_list'] = [
    'module_name' => 'colleges_course_list',
    'model_name' => 'Affiliated_colleges_courses_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'course_name',
    'default_col' => 'id',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' =>  array(
		'create' => 'colleges_course_list/create',
		'edit' => 'colleges_course_list/edit',
		'publish' => 'colleges_course_list/publish',
		'delete' => 'colleges_course_list/delete'
	),
    'module_uri' => 'colleges_course_list',
    'table_headers' => ['id', 'college_name', 'course_name', 'course_level', 'branch_name', 'district_name', 'branch_mode', 'type', 'published'],  // Admin columns
    // 'filters' => ['college_name', 'course_name', 'course_level', 'branch_name', 'district_name'], // Add filters here

];



$config['modules']['faculty'] = [
    'module_name' => 'Faculty',
    'model_name' => 'Faculty_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => 'faculty', // Optional: Add permissions
    'table_headers' => ['id', 'name', 'designation', 'subject', 'published'],  // Admin columns

];

$config['modules']['admissions'] = [
    'module_name' => 'admissions',
    'model_name' => 'Admission_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'headline',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => 'admissions', // Optional: Add permissions
    'table_headers' => ['id', 'headline', 'pdf', 'description', 'release_date','published'],  // Admin columns

];



$config['modules']['course_name'] = [
    'module_name' => 'course_name',
    'model_name' => 'Course_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'course_name',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'course_name/create',
		'edit' => 'course_name/edit',
		'publish' => 'course_name/publish',
		'delete' => 'course_name/delete'
	),
    'module_uri' => 'course_name',

    'table_headers' => ['id', 'course_name', 'course_level', 'type', 'published'],  // Admin columns

];

$config['modules']['branch_name'] = [
    'module_name' => 'branch_name',
    'model_name' => 'Branch_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'branch_name',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'branch_name/create',
		'edit' => 'branch_name/edit',
		'publish' => 'branch_name/publish',
		'delete' => 'branch_name/delete'
	),
    'module_uri' => 'branch_name',

    'table_headers' => ['id', 'branch_name', 'published'],  // Admin columns

];




$config['modules']['branch_mode'] = [
    'module_name' => 'branch_mode',
    'model_name' => 'Branch_mode_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'branch_mode',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'branch_mode/create',
		'edit' => 'branch_mode/edit',
		'publish' => 'branch_mode/publish',
		'delete' => 'branch_mode/delete'
	),
    'module_uri' => 'branch_mode',

    'table_headers' => ['id', 'branch_mode', 'published'],  // Admin columns

];










$config['modules']['course_level'] = [
    'module_name' => 'course_level',
    'model_name' => 'CourseLevel_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'course_level',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'course_level/create',
		'edit' => 'course_level/edit',
		'publish' => 'course_level/publish',
		'delete' => 'course_level/delete'
	),
    'module_uri' => 'course_level',

    'table_headers' => ['id', 'course_level', 'published'],  // Admin columns

];


$config['modules']['district'] = [
    'module_name' => 'district',
    'model_name' => 'District_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'district_name',
    'default_col' => '',
    'default_order' => 'asc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'district/create',
		'edit' => 'district/edit',
		'publish' => 'district/publish',
		'delete' => 'district/delete'
	),
    'module_uri' => 'district',

    'table_headers' => ['id', 'district_name', 'published'],  // Admin columns

];







$config['modules']['vc_message'] = [
    'module_name' => 'vc_message',
    'model_name' => 'VCmessage_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'vc_message',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'vc_message/create',
		'edit' => 'vc_message/edit',
		'publish' => 'vc_message/publish',
		'delete' => 'vc_message/delete'
	),
    'module_uri' => 'vc_message',
    'table_headers' => ['id','image','vc_message','signature','published'],  // Admin columns
];



$config['modules']['contact'] = [
    'module_name' => 'contact',
    'model_name' => 'Contact_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
   'permission' => array(
		'create' => 'contact/create',
		'edit' => 'contact/edit',
		'publish' => 'contact/publish',
		'delete' => 'contact/delete'
	),
    'module_uri' => 'contact',
    'table_headers' => ['id', 'name', 'email', 'location', 'contact_time','published'],  // Admin columns
];


$config['modules']['notifications'] = [
    'module_name' => 'notifications',
    'model_name' => 'Notifications_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'headline',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
   'permission' => array(
		'create' => 'notifications/create',
		'edit' => 'notifications/edit',
		'publish' => 'notifications/publish',
		'delete' => 'notifications/delete'
	),
    'module_uri' => 'notifications',
    'table_headers' => ['id', 'headline', 'description', 'release_date', 'pdf','published'],  // Admin columns
];



$config['modules']['notice_board'] = [
    'module_name' => 'notice_board',
    'model_name' => 'Notice_board_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'headline',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
   'permission' => array(
		'create' => 'notice_board/create',
		'edit' => 'notice_board/edit',
		'publish' => 'notice_board/publish',
		'delete' => 'notice_board/delete'
	),
    'module_uri' => 'notice_board',
    'table_headers' => ['id', 'headline', 'description','pdf','published'],  // Admin columns
];



$config['modules']['tender'] = [
    'module_name' => 'tender',
    'model_name' => 'Tender_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'tender/create',
		'edit' => 'tender/edit',
		'publish' => 'tender/publish',
		'delete' => 'tender/delete'
	),

    'module_uri' => 'tender',
    'table_headers' => ['id', 'name', 'description', 'tender_date', 'pdf','published'],  // Admin columns
];



$config['modules']['mission'] = array(
	'module_name' => 'mission',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'Mission_model',
	'permission' => array(
		'create' => 'mission/create',
		'edit' => 'mission/edit',
		'publish' => 'mission/publish',
		'delete' => 'mission/delete'
	),
);


$config['modules']['vision'] = array(
	'module_name' => '',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'Vision_model',
	'permission' => array(
		'create' => 'vision/create',
		'edit' => 'vision/edit',
		'publish' => 'vision/publish',
		'delete' => 'vision/delete'
	),
);



$config['modules']['about'] = array(
	'module_name' => 'about',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'About_model',
	'permission' => array(
		'create' => 'about/create',
		'edit' => 'about/edit',
		'publish' => 'about/publish',
		'delete' => 'about/delete'
	),
);




$config['modules']['marquee'] = array(
	'module_name' => 'marquee',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'Marquee_model',
	'permission' => array(
		'create' => 'marquee/create',
		'edit' => 'marquee/edit',
		'publish' => 'marquee/publish',
		'delete' => 'marquee/delete'
	),
);

$config['modules']['syllabus'] = array(
	'module_name' => 'syllabus',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'Syllabus_model',
	'permission' => array(
		'create' => 'syllabus/create',
		'edit' => 'syllabus/edit',
		'publish' => 'syllabus/publish',
		'delete' => 'syllabus/delete'
	),
);

$config['modules']['timetable'] = array(
	'module_name' => 'timetable',
	'model_location' => 'fuel',
	'default_col' => '', //in admin table
	'default_order' => 'asc',
	'model_name' => 'Timetable_model',
	'permission' => array(
		'create' => 'timetable/create',
		'edit' => 'timetable/edit',
		'publish' => 'timetable/publish',
		'delete' => 'timetable/delete'
	),
);

$config['modules']['ministers'] = [
    'module_name' => 'ministers',
    'model_name' => 'Ministers_model',
    'model_location' => '',  // Keep blank if using default location
    'display_field' => 'name',
    'default_col' => '',
    'default_order' => 'desc',
    'sanitize_input' => ['template', 'php'],
    'permission' => array(
		'create' => 'ministers/create',
		'edit' => 'ministers/edit',
		'publish' => 'ministers/publish',
		'delete' => 'ministers/delete'
	),
    'module_uri' => 'ministers',
    'table_headers' => ['id', 'name', 'description', 'image', 'seqno', 'published'],  // Admin columns
];