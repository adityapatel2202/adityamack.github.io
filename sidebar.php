<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php if(!empty($rowadmin['user_img'])){echo $rowadmin['user_img'];}else{ echo 'uploads/avatar.png';} ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $rowadmin['name']; ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
    <div class="menu_section">
        <h3>Admin Menu</h3>
        <ul class="nav side-menu">
            <li>
                <a href="index.php"><i class="fa fa-home"></i> Home </a>

            </li>
            <li>
                <a>
                    <i class="fa fa-cogs"></i> Restaurant Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a href="appsettings.php">Main Settings</a></li>                      
                    <li><a href="editresdetails.php">Restaurant Details</a></li>
                    

                </ul>
            </li>
<li><a href="profile.php"><i class="fa fa-github-alt"></i> Admin Settings</a></li>
            <li>
                <a href="category.php"><i class="fa fa-th"></i> Categories</a>

            </li>

           
            <li>
                <a href="menuitem.php"><i class="fa fa-cutlery"></i> Menu Item </a>

            </li>

 

<li>
                <a href="orderlist.php"><i class="fa fa-truck""></i> Order List </a>

            </li>

 <li>
                <a href="emailusers.php"><i class="fa fa-users fa-4"></i> Manage Users</a>

            </li>
 <li>
                <a>
                    <i class="fa fa-file-text"></i> Pages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
<li>
                <a href="faq.php"><i class="fa fa-info-circle"></i> FAQ</a></li>
<li>
                <a href="policy.php"><i class="fa fa-file"></i> Terms & Conditions</a></li>
</ul>
            </li>
<li>
                <a href="notification.php"><i class="fa fa-bell fa-4"></i> Push Notification</a>

            </li>
        </ul>
    </div>
    

</div>
<!-- /sidebar menu -->

</div>
</div>