<?php 
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$CI =& get_instance();
$CI->load->model('Users_model');
$CI->load->model('Common_model');

$lasturl = @end($this->uri->segment_array());
$pageurl=$CI->uri->segment(2);
$newsid=$CI->uri->segment(3);
$urls=base_url();
if($lasturl!="")
{
$meta_description_details 	= $CI->Users_model->meta_description_details($lasturl);
if(!empty($meta_description_details ))
{
	$page_name			=$meta_description_details[0]['page_name'];
	$page_title			=$meta_description_details[0]['page_title'];
	$seo_title			=$meta_description_details[0]['seo_title'];
	$seo_key			=$meta_description_details[0]['seo_key'];
	$seo_desc			=$meta_description_details[0]['seo_desc']; 
	$images				=base_url().'adminpanel/images/metaimages/'.$meta_description_details[0]['images']; 
	$curls				=$meta_description_details[0]['url']; 
	$author				=$meta_description_details[0]['author'];
}
else
{
	
		$page_name="";
		$page_title="";
		$seo_title="";
		$seo_key="";
		$seo_desc="";
		$images="";
		$curls="";
		$author	="";
}	
}

if($pageurl!=""){

  $tblname = $pageurl;
  $newsid  = base64_decode($newsid);
  $news_description_details 	= $CI->Users_model->news_meta_description_details($newsid);
  
  
	  if(!empty($news_description_details )){
		  
		  
		  
		$priority=$news_description_details[0]['priority'];
		$uid=$news_description_details[0]['userid'];


		if($priority==1)
		{
		$newsname='schooling';
		}
		if($priority==2)
		{
		$newsname='highereducation';
		}
		if($priority==3)
		{
		$newsname='research-others';
		}
		if($priority==4)
		{
		$newsname='general-news';
		}

		if($priority==8)
		{
		$newsname='inspiring-stories';
		}
		if($priority==7)
		{
		$newsname='quotes';
		}
		if($uid==41  || $uid=='admin' || $priority==5)
		{
		$newsname='blog';
		}
		  
		  $ids         = $news_description_details[0]['id'];
		  $slug        = $news_description_details[0]['slug'];
		  $page_title  = $news_description_details[0]['page_title'];
		  $description = $news_description_details[0]['description'];
		  $image       = $news_description_details[0]['image'];
		  $count_news  = $news_description_details[0]['click_count'];
		  $video       = $news_description_details[0]['video_link'];
		  $likes       = $news_description_details[0]['likes'];
		  
		  $date        = $news_description_details[0]['date'];
		  $priority    = $news_description_details[0]['priority'];
		  $author      = $news_description_details[0]['author'];
		  $seo_title   = $news_description_details[0]['seo_title'];
		  $seo_key     = $news_description_details[0]['seo_keywords'];
		  $seo_desc    = $news_description_details[0]['seo_description'];
		  
		   $imgurl=base_url().'adminpanel/';
		  $images      = $imgurl.$image;
		  $curls       = $urls."/".$newsname."/".$newsid."/".$slug;
	  } 
     }



if($lasturl=="")
{
$CI =& get_instance();
$CI->load->model('Users_model');
$lasturl="";
$meta_description_details 	= $CI->Users_model->meta_description_details($lasturl);
$page_name=$meta_description_details[0]['page_name'];
$page_title=$meta_description_details[0]['page_title'];
$seo_title=$meta_description_details[0]['seo_title'];
$seo_key=$meta_description_details[0]['seo_key'];
$seo_desc=$meta_description_details[0]['seo_desc']; 
$images=base_url().'adminpanel/images/metaimages/'.$meta_description_details[0]['images']; 
$curls=$meta_description_details[0]['url']; 
$author= $meta_description_details[0]['author'];  

}






?>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="title" content="<?php echo $seo_title; ?>">
    <meta name="keyword" content="<?php echo $seo_key; ?>">
	<meta name="description" content="<?php echo $seo_desc; ?>">
	<meta name="author" content="<?php echo $author; ?>">
	<meta name="google-site-verification" content="rgCb9uqYt8vqT_YWwtTCOh6wuGONzo8widrArNXVyuc" />
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/bt_favicon.png"/>
    <title>Beyond Teaching | <?php echo $seo_title; ?></title>
    
    <link rel="image_src" content="image/jpeg/jpg/png" href="<?php echo $images; ?>" />
	
	    <meta property="og:title" content="<?php echo $seo_title; ?>">
        <meta property="og:description" content="<?php echo $seo_desc; ?>">
        <meta property="og:url" content="<?php echo $curls; ?>">
        <meta property="og:image" content="<?php echo $images; ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:site_name" content="Beyond teaching profiles teachers, educators, leaders, and covers Jobs, mentorship, innovation in teaching & education. Read, write & share stories here."/>
		
        
            <meta  name="twitter:card"  content="summary_large_image" >
            <meta  name="twitter:site"  content="@BT News" >
            <meta  name="twitter:title"  content="<?php echo $page_title; ?>" >
            <meta  name="twitter:description"  content="<?php echo $seo_desc; ?>" >
            
            <meta  property="fb:app_id"  content="164540280824587" >
            
            <link rel="canonical" href="<?php echo $url; ?>" />

    
  
    <!--Navigation links -->
    
	
    <link rel="icon" href="<?php echo $urls; ?>assets/images/bt_favicon.png" class="js-favicon">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $urls; ?>assets/images/bt_favicon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $urls; ?>assets/images/bt_favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $urls; ?>assets/images/bt_favicon.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $urls; ?>assets/images/bt_favicon.png">
    <link rel="mask-icon" href="<?php echo $urls; ?>assets/images/bt_favicon.png" color="#171717">
    <meta content="index, follow">
    <meta property="og:type" content="website">
	<meta name="p:domain_verify" content="5d15d93be57341b5a07bce2489a8d54e"/>
	
	