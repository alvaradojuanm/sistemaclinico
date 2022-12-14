<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'clinic_patients', 
			'label' => 'Patients', 
			'icon' => '<i class="fa fa-user-plus "></i>'
		),
		
		array(
			'path' => 'doc', 
			'label' => 'Doctors', 
			'icon' => '<i class="fa fa-heartbeat "></i>'
		),
		
		array(
			'path' => 'appointment_new', 
			'label' => 'Appointment ', 
			'icon' => '<i class="fa fa-calendar "></i>'
		),
		
		array(
			'path' => 'clinic_prescription', 
			'label' => 'Prescriptions', 
			'icon' => '<i class="fa fa-cubes "></i>'
		),
		
		array(
			'path' => 'invoices', 
			'label' => 'Invoices', 
			'icon' => '<i class="fa fa-dollar "></i>','submenu' => array(
		array(
			'path' => 'invoices/Index', 
			'label' => 'Invoices', 
			'icon' => '<i class="fa fa-dollar "></i>'
		),
		
		array(
			'path' => 'invoices_concepts', 
			'label' => 'Concept', 
			'icon' => '<i class="fa fa-check-square-o "></i>'
		)
	)
		),
		
		array(
			'path' => '/', 
			'label' => 'Reports', 
			'icon' => '<i class="fa fa-pencil-square-o "></i>','submenu' => array(
		array(
			'path' => 'actives_patients', 
			'label' => 'Actives Patients', 
			'icon' => '<i class="fa fa-user-plus "></i>'
		),
		
		array(
			'path' => 'inactives_patients', 
			'label' => 'Inactives Patients', 
			'icon' => '<i class="fa fa-user-times "></i>'
		),
		
		array(
			'path' => 'invoice_cancelled', 
			'label' => 'Cancelled invoices', 
			'icon' => '<i class="fa fa-check-circle-o "></i>'
		),
		
		array(
			'path' => 'invoice_debt', 
			'label' => 'Debts Invoices', 
			'icon' => '<i class="fa fa-exclamation "></i>'
		),
		
		array(
			'path' => 'appointments', 
			'label' => 'Appointments', 
			'icon' => '<i class="fa fa-calendar "></i>'
		)
	)
		),
		
		array(
			'path' => 'users', 
			'label' => 'User Manager', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'app_logs', 
			'label' => 'Settings', 
			'icon' => '<i class="fa fa-cog "></i>','submenu' => array(
		array(
			'path' => 'app_logs', 
			'label' => 'View Logs', 
			'icon' => '<i class="fa fa-file-text-o "></i>'
		)
	)
		)
	);
		
	
	
			public static $rol = array(
		array(
			"value" => "Admin", 
			"label" => "Admin", 
		),
		array(
			"value" => "Doctor", 
			"label" => "Doctor", 
		),
		array(
			"value" => "Assistant", 
			"label" => "Assistant", 
		),);
		
			public static $gender = array(
		array(
			"value" => "Male", 
			"label" => "Male", 
		),
		array(
			"value" => "Female", 
			"label" => "Female", 
		),);
		
}