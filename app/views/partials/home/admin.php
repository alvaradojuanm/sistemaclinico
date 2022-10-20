<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="page-header"><h4>Welcome to Clinic System</h4></div>
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h6 ><?php
                        echo "User : ".USER_NAME."<BR>";
                            echo "Role : ".USER_ROLE ."<br>";
                                echo "Date :".date_now();
                            ?></h6>
                            <a  class="btn btn-primary" href="<?php print_link("clinic_patients/list") ?>">
                                <i class="fa fa-user-plus "></i>                                
                                New Patient 
                            </a>
                            <a  class="btn btn-primary" href="<?php print_link("doc/list") ?>">
                                <i class="fa fa-user-md "></i>                              
                                New Doctor 
                            </a>
                            <a  class="btn btn-primary" href="<?php print_link("appointment_new/list") ?>">
                                <i class="fa fa-calendar "></i>                             
                                New  appointment 
                            </a>
                            <a  class="btn btn-primary" href="<?php print_link("clinic_prescription/list") ?>">
                                <i class="fa fa-cubes "></i>                                
                                New Prescriptions 
                            </a>
                            <a  class="btn btn-primary" href="<?php print_link("app_logs/list") ?>">
                                <i class="fa fa-file-text-o "></i>                              
                                View Logs 
                            </a>
                            <a  class="btn btn-primary" href="<?php print_link("invoices/list") ?>">
                                <i class="fa fa-dollar "></i>                               
                                New Invoice 
                            </a>
                        </div>
                        <div class="col-md-6 comp-grid">
                        </div>
                    </div>
                </div>
            </div>
            <div  class="py-5">
                <div class="container">
                    <div class="page-header"><h4>General Dashboard</h4></div>
                    <div class="row ">
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_users();  ?>
                            <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("users/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-users "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Users</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_patients();  ?>
                            <a class="animated zoomIn record-count card bg-c-blue dashboard-card"  href="<?php print_link("clinic_patients/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-user-plus "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Patients</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_inactivespatients();  ?>
                            <a class="animated zoomIn record-count card bg-dark text-white"  href="<?php print_link("inactives_patients/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-user-times "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Inactives Patients</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_activespatients();  ?>
                            <a class="animated zoomIn record-count card bg-warning text-white"  href="<?php print_link("actives_patients/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-users "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Actives Patients</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_appointments();  ?>
                            <a class="animated zoomIn record-count card bg-success text-white"  href="<?php print_link("appointments/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-calendar-check-o "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Appointments</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_invoices();  ?>
                            <a class="animated zoomIn record-count card bg-warning text-white"  href="<?php print_link("invoices/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-calculator "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Invoices</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-4 comp-grid">
                            <?php $rec_count = $comp_model->getcount_doctors();  ?>
                            <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("doc/") ?>">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa fa-user-md "></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="flex-column justify-content align-center">
                                            <div class="title">Doctors</div>
                                            <small class=""></small>
                                        </div>
                                    </div>
                                    <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
