<?php
session_start();
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */
$str = str_replace('\\','/',dirname(__FILE__)."/comm/config.php");
require_once($str);
require_once(CLASS_PATH."QC.class.php");

