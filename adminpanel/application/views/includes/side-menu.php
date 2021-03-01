<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?php echo base_url(); ?>admin/adminusers/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                </a>
            </li>

            <?php
            if ($role == 3) {
                ?>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>admin_adminuser/dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                    </a>
                </li>
    <?php
}
?>



<?php
if ($role == 1) {
    ?>




                <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>User management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/userListing">
                                <i class="fa fa-users"></i>
                                <span>View admin users</span>
                            </a></li>
                         <li><a href="<?php echo base_url(); ?>admin_adminusers/addNew">
                                <i class="fa fa-users"></i>
                                <span>Add admin users</span>
                            </a></li>
					
					  <li><a href="<?php echo base_url(); ?>admin_adminusers/liveuser">
                                <i class="fa fa-users"></i>
                                <span>View Live users</span>
                            </a></li>


                    </ul>
                </li>


				
				
				<!--<li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Cumulative management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/cumulativelist/add"><i class="fa fa-circle-o"></i> Add Cumulative</a></li>
						
						
							<li><a href="<?php echo base_url(); ?>admin_adminusers/cumulativelist"><i class="fa fa-circle-o"></i> Cumulative List</a></li>
						

                    </ul>
                </li>-->
				
				


                <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Program management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/publish_program"><i class="fa fa-circle-o"></i> Publish Program List</a></li>
						
						
							<li><a href="<?php echo base_url(); ?>admin_adminusers/addprogram"><i class="fa fa-circle-o"></i> Add Program List</a></li>
						



                    </ul>
                </li>
				
				
				<li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Publish Page SEO management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/pageseo"><i class="fa fa-circle-o"></i> Page seo</a></li>
						
						
							
						



                    </ul>
                </li>
				
				
				<li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Enquiry  Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/userenquiry"><i class="fa fa-circle-o"></i>Publish Enquiry</a></li>
						
						
							
						



                    </ul>
                </li>
				
				
				
				
				

               <!-- <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Advertisement management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/advertiseview"><i class="fa fa-circle-o"></i>Advertisement List</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/add_advertise"><i class="fa fa-circle-o"></i>Add Advertisement List</a></li>
                        

                    </ul>
                </li>
				
				
				
				 <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Deals management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/dealslist"><i class="fa fa-circle-o"></i>Deals List</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/adddealslist"><i class="fa fa-circle-o"></i>Add deals List</a></li>
                        

                    </ul>
                </li>


				
				 <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Workplace Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/addworkcategory"><i class="fa fa-circle-o"></i>Add Workplace Category</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/workcategorylist"><i class="fa fa-circle-o"></i>View Workplace Category List</a></li>
                        

                    </ul>
                </li>
				
				
				
				<!--<li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Meta description management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_commanlist/addmeta"><i class="fa fa-circle-o"></i>Add meta</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_commanlist/viewmeta"><i class="fa fa-circle-o"></i>View meta list</a></li>
                        

                    </ul>
                </li>
				
				
				


                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Blog management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/user_blog"><i class="fa fa-circle-o"></i>view blog</a></li>
                       
                      


                    </ul>
                </li>-->


               <!-- <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>COE Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        <li class="active"><a href="<?php echo base_url(); ?>admin_commanlist/addcoe"><i class="fa fa-circle-o"></i>Add COE</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_commanlist/coelist"><i class="fa fa-circle-o"></i>List COE</a></li>
                        


                    </ul>
                </li>-->


    <?php
}
?>


            <?php
            if ($role == 2) {
                ?>
                
				<li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Cumulative management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/cumulativelist/add"><i class="fa fa-circle-o"></i> Add Cumulative</a></li>
						
						
							<li><a href="<?php echo base_url(); ?>admin_adminusers/cumulativelist"><i class="fa fa-circle-o"></i> Cumulative List</a></li>
						

                    </ul>
                </li>
				
				


                <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Publish Feed management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                       
                        <li><a href="<?php echo base_url(); ?>admin_adminusers/publish_feed"><i class="fa fa-circle-o"></i> Publish Feed List</a></li>
						
						
							<li><a href="<?php echo base_url(); ?>admin_adminusers/add_feed"><i class="fa fa-circle-o"></i> Add Publish List</a></li>
						



                    </ul>
                </li>

                <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Advertisement management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/advertiseview"><i class="fa fa-circle-o"></i>Advertisement List</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/add_advertise"><i class="fa fa-circle-o"></i>Add Advertisement List</a></li>
                        

                    </ul>
                </li>
				
				
				
				 <li class="treeview active">
                    <a href="javascript:void(0);">
                        <i class="fa fa-folder"></i> <span>Deals management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/dealslist"><i class="fa fa-circle-o"></i>Deals List</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/adddealslist"><i class="fa fa-circle-o"></i>Add deals List</a></li>
                        

                    </ul>
                </li>


				
				 <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Workplace Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">
                        
                         <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/addworkcategory"><i class="fa fa-circle-o"></i>Add Workplace Category</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>admin_adminusers/workcategorylist"><i class="fa fa-circle-o"></i>View Workplace Category List</a></li>
                        

                    </ul>
                </li>
    <?php
}
if ($role == 1) {
    ?>
                <!-- <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Grade management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display:none!important;">

                        <li><a href="<?php echo base_url(); ?>admin_adminusers/viewdepartemployeelist"><i class="fa fa-circle-o"></i> View Employee Grade List</a></li>


                    </ul>
                </li>-->
    <?php
}
?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>