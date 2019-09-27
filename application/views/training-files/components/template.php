<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: template.php
*  Author: Saddam
*  Filepath: views / training-files / components / template.php
*/
?>
<?php $this->load->view('training-files/components/head'); ?>

<?php $this->load->view($content); ?>

<?php $this->load->view('training-files/components/foot'); ?>