<?php defined('BASEPATH') OR exit('No direct script access allowed');
 /**


* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-PDF-Generator-Library



*/


#require_once(dirname(__FILE__).'\dompdf\dompdf_config.inc.php');
#include_path(base_url().'applications/libr/dompdf/dompdf_config.inc.php');
#require_once(.'/dompdf/dompdf_config.inc.php');

#include_once BASEPATH.'libraries\dompdf\autoload.inc.php';
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;


class Pdf
{
    public function __construct(){
        
        // include autoloader
       
        // instantiate and use the dompdf class
        $pdf = new DOMPDF();
        
        $CI =& get_instance();
        $CI->dompdf = $pdf;
        
    }
}

?>