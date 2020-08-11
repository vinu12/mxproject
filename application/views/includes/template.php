<?php 




   $this->load->view('includes/header');



 ?>
<?php //$this->load->view('includes/side-menu.php'); ?>

<?php $this->load->view($main_content); ?>

<?php 

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>


<?php 


//$this->load->view('includes/slide'); 

    $this->load->view('includes/footer'); 
	
	

?>