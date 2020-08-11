<!DOCTYPE html>
<html>
<head>
<title>Slide Contact Form - Demo Preview</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slide.css">
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'><!-- Including google font-->

<script src="<?php echo base_url(); ?>assets/js/slider.js"></script>

</head>
<body>
<div id="title">
<h3>Click Contact Us Button to Slide In Contact Form</h3>
</div>
<!-- Sliding div starts here -->
<div id="slider" style="right:-342px;">
<div id="sidebar" onclick="open_panel()"><img src="images/contact.png"></div>
<div id="header">
<h2>Contact Form</h2>
<p>This is my form.Please fill it out.It's awesome!</p>
<input name="dname" type="text" value="Your Name">
<input name="demail" type="text" value="Your Email">
<h4>Query type</h4>
<select>
<option>General Query</option>
<option>Presales</option>
<option>Technical</option>
<option>Others</option>
</select>
<textarea>Message</textarea>
<button>Send Message</button>
</div>
</div>
<!-- Sliding div ends here -->
</body>
</html>