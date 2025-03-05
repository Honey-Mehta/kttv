<?php
class Asset_hooks
{

    public function __construct()
    {
    }

    function before_create_assets($data)
    {

        $CI =& get_instance();
        $newfilename = $data['file_name'];
        $subfolder = $CI->input->get_post('subfolder');
        if (count($_FILES) == 1) {
            foreach ($_FILES as $key => $file) {
                $fileNameUpload = $file['name'];
                $sizeUpload = $file['size'];
                $tempArrFileUpload = explode(".", $fileNameUpload);
                $newFileArr = explode(".", $newfilename);

                if (count($tempArrFileUpload) != 2 || !ctype_alpha($tempArrFileUpload[0])) {
                    $CI->fuel->admin->set_notification('Selected File Name is invalid! It should be contain only alphabets and single dot.', Fuel_admin::NOTIFICATION_ERROR);
                    redirect(current_url());
                } else if ($sizeUpload < 100) {
                    $CI->fuel->admin->set_notification('File should be greater than 100 bytes.', Fuel_admin::NOTIFICATION_ERROR);
                    redirect(current_url());
                // } else if (count($newFileArr) != 2 || !ctype_alpha($newFileArr[0]) || empty($newfilename)) {
                //     $CI->fuel->admin->set_notification('Invalid New file name! It should be contain only alphabets and single dot.', Fuel_admin::NOTIFICATION_ERROR);
                //     redirect(current_url());
                //
                //  } elseif (empty($subfolder) || !ctype_alpha($subfolder)) {
                //     $CI->fuel->admin->set_notification('Only alphabetic characters are allowed in Subfolder!', Fuel_admin::NOTIFICATION_ERROR);
                //     redirect(current_url());
                // 
                } 
                // elseif (empty($data['width']) || empty($data['height']) || $data['width'] <= 0 || $data['width'] > 400 || $data['height'] <= 0 || $data['height'] > 400) {
                //     $CI->fuel->admin->set_notification('Width and Height should be greater than 0 and less than 400 and must be numeric.', Fuel_admin::NOTIFICATION_ERROR);
                //     redirect(current_url());
                // }



                // if ($fileupload) {
                //     if (count($temp) != 2) {
                //         // $CI =& get_instance();
                //         $CI->fuel->admin->set_notification('Selected File Name is invalid! It should be contain alphanumeric characters and single dot.', Fuel_admin::NOTIFICATION_ERROR);
                //         redirect(current_url());
                //     } elseif ($size < 100) {
                //         $CI->fuel->admin->set_notification('File should be greater than 100 bytes.', Fuel_admin::NOTIFICATION_ERROR);
                //         redirect(current_url());
                //     } elseif (!ctype_alpha($data['file_name']) && count($ext2) != 2) {
                //         $CI->fuel->admin->set_notification('Invalid New file name! It should be contain only alphanumeric characters and single dot.', Fuel_admin::NOTIFICATION_ERROR);
                //         redirect(current_url());
                //     } elseif (!empty($subfolder) && !ctype_alpha($subfolder)) {
                //         // $CI =& get_instance();
                //         $CI->fuel->admin->set_notification('Only alphabetic characters are allowed in Subfolder!', Fuel_admin::NOTIFICATION_ERROR);
                //         redirect(current_url());
                //     }
                // } elseif (!ctype_digit($data['width'] > 0 && $data['width'] < 400 && $data['height'] > 0 && $data['height'] < 400)) {
                //     $CI->fuel->admin->set_notification('Width and Height should be greater than 0 and less than 400 and must be numeric.', Fuel_admin::NOTIFICATION_ERROR);
                //     redirect(current_url());
                // }
            }
        } else {
            $CI->fuel->admin->set_notification('Multiple selection not allowed in File!', Fuel_admin::NOTIFICATION_ERROR);
            redirect(current_url());
        }
        return $data;
    }
}

?>