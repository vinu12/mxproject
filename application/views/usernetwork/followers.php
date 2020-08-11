<div class="container">
    <div class="section">
        <div class="row">
            <div class="site-content col-md-12">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="col-lg-12 ntwrk-heding nopadd">
                            <div class="col-lg-12 ntwrk-ttl nopadd">  <span>  Followers(<?php echo $countfollowers['0']['followers']; ?>) </span>  </div>

                            <?php
                            if(!empty($user_result))
                            {
                            foreach ($user_result as $key=>$userData) {
                               
							  
                              
                                $CI = & get_instance();
                                $CI->load->model('Users_model');
                                $resultData = $CI->Users_model->listUsercheck($userData['userid']);
                              
                                
                                 foreach ($resultData as $record) {
                                ?>
                                <div class="col-lg-4 ntwrk-usr"> <a href="<?php echo base_url(); ?>UserNetwork/profile/<?php echo base64_encode($record['id']); ?>"> 
                               <?php 
									
									$basepath=base_url(); 
									$maining=$record['photo'];
									$data=parse_url($maining, PHP_URL_SCHEME);

									if($data=='http' || $data=='https')
									{
									$img = $maining;
									}
									else if($data!='http' || $data!='https')
									{

									$img = $basepath.'adminpanel/'.$maining;

									}
									else
									{

									}

									if($maining=='')
									{
									$img = $basepath."assets/images/nophoto.png";

									}
									
									
									?>

                                            <img src="<?php echo $img ; ?>" class="img-responsive img-circle" style="width:100px; height:100px;" alt="user">
        


                                        <span class="ntwrk-usrname"> <?php echo ucfirst(strtolower($record['user_name'])); ?> </span>

    <?php if ($record['position'] != "") {
        ?>
                                            <p class="occupation ntwrk-occupation"> <?php echo $record['position']; ?> </p>
                                            <?php
                                        } else {
                                            ?>
                                            <p class="occupation ntwrk-occupation"> <?php echo "No Position"; ?> </p>
                                            <?php
                                        }
                                        ?>


                                        <?php if ($record['bio'] != "") {
                                            ?>
                                            <p class="ntwrk-shrt-bio"><?php echo substr($record['bio'], 0, 30); ?>..</p>

                                            <?php
                                        } else {
                                            ?>
                                            <p class="ntwrk-shrt-bio"><?php echo "No Bio Publised"; ?>..</p>
                                            <?php
                                        }
                                        ?>
                                    </a> 
                                    <div class="ntwrk-flw">

                                        <?php
                                        $logid = $this->session->userdata('logid');
                                        if ($logid != "") {
                                             $userid=$userData['id'];
                                            
                                           
                                            
                                            
                                        $CI =& get_instance();
                                        $CI->load->model('Users_model');
                                        $resultData = $CI->Users_model->checkfollowinguser($userid);
                                        
                                       
                                        if ($userid==$resultData){
                                         
                                         ?>
                                        <div id='followu<?php echo $userid; ?>'>
                                        <a  id='followdata<?php echo $userid; ?>' href="javascript:void(0);" onclick="followuser(<?php echo $userid; ?>);" ><button   class="follow-userside ntwrk-flw-btn"> Following  </button> </a> 
                                        </div>
                                        <?php 
                                         }
                                         else
                                         {
                                            
                                          ?>   
                                         <div id='followu<?php echo $userid; ?>'>
                                        <a  id='followdata<?php echo $userid; ?>' href="javascript:void(0);" onclick="followuser(<?php echo $userid; ?>);" ><button   class="follow-userside ntwrk-flw-btn"> Follow  </button> </a> 
                                        </div>
                                             
                                          <?php   
                                         }
                                         
                                         
                                         
                                         
                                         ?>
                                        
                                        <img id="process<?php echo $userid; ?>" src="<?php echo base_url(); ?>assets/images/loader.gif"  style="display:none;width:20px;height:20px;"> 

                                       
                                      <?php
                                                
                                        }
                                        else
                                        {
                                           ?>
                                         <a href="<?php base_url(); ?>login"><button class="follow-userside ntwrk-flw-btn"> Follow  </button> </a> 



                                       
                                        <?php 
                                            
                                        }
                                        ?>
                                    
                                    </div>

                                        



                                    </div>  

        <?php
    }
    }
    }
    else
    {
		?>
       <div align="center">NO Followers users</div>
	   <?php
    }
    ?>							



                            </div> <!-- End of Network-->
                            <div><?php echo '<div class="pagination">' . $links . '</div>'; ?></div>
                            <div class="clearfix"> </div>

                            <!--<div class="col-lg-12 seentwrk"> 
                          <a href="#"> <span class="see-ntwrk"> See More </span> </a>
                             
                                   
                            </div>-->



                        </div>



                        <div class="col-sm-4 hed-right ntwrk-sidebar ">

                            <!--  
                                                          <div class="col-lg-12 nopadd ltst-nws"> 
                              
                              <div class="col-lg-6"> <span class="my-head-ltst"><strong><i class="fa fa-clock-o fa-lg myicon" aria-hidden="true"></i> Latest News </strong>  </span> </div> 	
                     
                              
                              <div class="clearfix"> </div>
                                                          </div> -->

                            <div class="col-lg-12 ">
                                <ul class="sid-psthm">
                                    <li class="promotion-bnner"><a href="#"><span class="sd-image"><img src="<?php echo base_url(); ?>assets/images/writing-side3.jpg"></span> </a> <div class="clearfix"> </div> </li>

                                    <li class="promotion-bnner">


                                        <div class="col-lg-12 mid-bnr">





                                            <div id="myCarousel" class="carousel slide">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#myCarousel" data-slide-to="0" class="active" contenteditable="false"></li>
                                                    <li data-target="#myCarousel" data-slide-to="1" class="" contenteditable="false"></li>
                                                    <li data-target="#myCarousel" data-slide-to="2" class="" contenteditable="false"></li>

                                                </ol>
                                                <div class="carousel-inner">
                                                    <div class="item active" style="">
                                                        <img src="<?php echo base_url(); ?>assets/images/download-banner.jpg" alt="" class="img-responsive">

                                                    </div>


                                                    <div class="item ">
                                                        <img src="<<?php echo base_url(); ?>assets/images/content-banner.jpg" alt="" class="img-responsive">

                                                    </div>

                                                    <div class="item ">
                                                        <img src="<?php echo base_url(); ?>assets/images/data-privacy.jpg" alt="" class="img-responsive">

                                                    </div>



                                                </div>    

                                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                    <i class="fa fa-chevron-left mysldricon" aria-hidden="true"></i>
                                                </a> 

                                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                    <i class="fa fa-chevron-right mysldricon" aria-hidden="true"></i>
                                                </a>





                                            </div>


                                        </div>

                                    </li>
                                </ul>

                            </div>





                            <div class="col-lg-12 nopadd md-sidetrndng ntwrk-side">
                                <ul class="my-trnd trndng-ntwrk">
                                    <span class="trndng-btn"> Trending News</span>
                                    <img src="<?php echo base_url(); ?>assets/images/trending.jpg" alt="trending-image" class="trndng-pic img-responsive"> 


    <?php
    foreach ($trandingnews as $val) {
		
		$priority=$val['priority'];
									 $uid=$val['userid'];
									 
								
									if($priority==1)
									{
										$type='schooling';
									}
									if($priority==2)
									{
										$type='highereducation';
									}
									if($priority==3)
									{
										$type='research-others';
									}
									if($priority==4)
									{
										$type='general-news';
									}
									if($priority==8)
									{
										$type='inspiring-stories';
									}
									if($priority==7)
									{
										$type='quotes';
									}
									if($uid==41  || $uid=='admin' || $priority==5)
									{
										$type='blog';
									}
        ?>

                                        <li class="trnding-tophm">
                                            <li class="trnding-tophm">
                                            <a href="<?php echo base_url(); ?><?php if($type!="") { echo $type; } ?>/<?php echo $val['slug'] ?>/<?php  echo base64_encode($val['id']);?>">
                                                <img src="<?php echo base_url(); ?>adminpanel/<?php echo $val['image'] ?>" alt="trending-image" style="width:400px; height:150px;" class="trndng-pic"> 
                                                <p><?php echo ucfirst($val['slug']); ?> <br>

                                                    <span class="pst-tm"><?php echo $val['author']; ?>| <?php echo $val['readtime']; ?></span>
                                                </p>
                                            </a>


                                        </li>
        <?php
    }
    ?>						




                                    <li class="trnding-tophm ntwrk-seeall">
                                        <br>
                                        <br>
                                       <a href="<?php echo base_url(); ?>trending-news">
                                            <span class="pst-see"> See All News <span class="arw-right"> &gt; </span><div class="clearfix"> </div> </span> 
                                        </a>

                                    </li>









                                </ul>


                            </div>




                            <div class="clearfix"> </div>

                        </div> <!--End Side column4-->





                    </div>

                </div><!--/#content--> 





            </div>
        </div><!--/.section--> 


    </div><!--/.container-->


    
   
    
    <script>
        function followuser(userid)
        {
             $.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/followuserData",
		data:{userid:userid},
		beforeSend:function(){
		$('#process').show();
		
		
		}

		,success:function(response){
		if(response==1)
                {
                    
                    
                    $("#followu"+userid).html('<a  id="unfollowdata'+userid+' href="javascript:void(0);" onclick="unfollowData('+userid+');" ><button   class="follow-userside ntwrk-flw-btn"> Following  </button> </a> ');
                    
                }
		
		
		
		}});
            
            
            
    }
    
    
    function unfollowData(userid)
            {
                
                $.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/unfollowuserData",
		data:{userid:userid},
		beforeSend:function(){
		$('#process').show();
		
		
		}

		,success:function(response){
		if(response==1)
                {
                  
                    $("#followu"+userid).html('<a  id="followdata'+userid+' href="javascript:void(0);" onclick="followuser('+userid+');" ><button   class="follow-userside ntwrk-flw-btn"> Follow  </button> </a> ');
                    
                }
		
		
		
		}});
                
            }
        </script>