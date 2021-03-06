<?php
/**
 * This is pretty much what every Controller should look like.
 * Some might include more than one model etc....
 *
 * @todo    Proper documentation
 */
use \MyRadio\MyRadioException;
use \MyRadio\MyRadio\URLUtils;
use \MyRadio\ServiceAPI\MyRadio_User;

if (!isset($_REQUEST['term'])) {
    throw new MyRadioException('Parameter \'term\' is required but was not provided');
}

$data = MyRadio_User::getInstance((int) $_REQUEST['term'])->getName();
URLUtils::dataToJSON($data);
