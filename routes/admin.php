<?php

Route::get('/', 'DashboardController@index')->name('admin_dashboard');

Route::get('/events', function(){
		return 'Admin Events';
	})
	->name('admin_events');

?>