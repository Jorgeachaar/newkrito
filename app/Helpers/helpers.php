<?php 

function format_date($date){
	return date('d-m-Y',strtotime($date)); 
} 

function isActive($route) {
	// Request::is('/url') ? ' class="active"' : null
	// dd(Request::segment(1) );
	return Route::is($route) ? "active" : '';
}

function isActiveToArray($routes) {
	foreach ($routes as $route) {

		if ($route !== "" && strpos(Request::url(), route($route)) !== false) {
		    return "active";
		}
	}
	return "";
}
 
?>