<?php

$f3=require('lib/base.php');

$f3->config('api/config.ini');

$db = $f3->get('DB');
$db_user = $f3->get('DB_USER');
$db_password = $f3->get('DB_PASSWORD');
$db_host = $f3->get('DB_HOST');
        
mysql_connect($db_host, $db_user, $db_password)
or die ("Could not connect to resource");
  
mysql_select_db($db)
or die ("Could not connect to database");

$key_query  = "SELECT * FROM $db.key_lookup";
      
$key_result = mysql_query($key_query);
      
while($row = mysql_fetch_row($key_result)) {
  $map_it_key = $row[1];
}

$libraries = array();

$library_query  = "SELECT * FROM $db.libraries ORDER BY display ASC";
      
$library_result = mysql_query($library_query);
      
while($row = mysql_fetch_row($library_result)) {
  $library_names[$row[1]] = $row[2];
  $library_codes[$row[2]] = $row[1];
}

$f3->set('library_names', $library_names);
$f3->set('library_codes', $library_codes);

$f3->set('map_it_key',$map_it_key);

$f3->set('AUTOLOAD','api/; web/;');

$f3->route('GET /api/locate', 'Locate->call_number');
$f3->route('GET /api/locate/@location/@collection/@callno', 'Locate->call_number');
$f3->route('GET /api/locate/barcode', 'Locate->barcode');
$f3->route('GET /api/locate/transfer', 'Locate->transfer');

$f3->route('GET /api/admin/display/@library', 'Admin->display');
$f3->route('POST /api/admin/delete', 'Admin->delete');
$f3->route('POST /api/admin/create', 'Admin->create');
$f3->route('GET /api/admin/create/barcode', 'Admin->create_with_barcode');
$f3->route('POST /api/admin/update/callno', 'Admin->update_callno');
$f3->route('POST /api/admin/update/floor', 'Admin->update_floor');
$f3->route('POST /api/admin/update/row', 'Admin->update_row');
$f3->route('POST /api/admin/update/collection', 'Admin->update_collection');
$f3->route('POST /api/admin/feedback', 'Admin->send_feedback');
$f3->route('GET /api/admin/mail', 'Admin->mail_test');

$f3->route('GET /map/@library/@floor/@row', function($f3, $params) {
    $template_path = 'web/maps/' . $params['library'] . '/' . $params['floor'] . '.html';
    $f3->set('library',$params['library']);
    $f3->set('floor',$params['floor']);
    $f3->set('row',$params['row']);
    $f3->set('www_root',$f3->get('MAP_IT_HOME'));
    $f3->set('ga_key', $f3->get('GOOGLE_ANALYTICS_KEY'));
    $f3->set('ga_domain', $f3->get('GOOGLE_ANALYTICS_DOMAIN'));
    $library_names = $f3->get('library_names');
    $f3->set('display',$library_names[$params['library']]);
    $f3->set('header','web/header.html');
    $f3->set('headermap', 'web/headermap.html');
    $f3->set('footer', 'web/footer.html');

    $template = new Template;
    echo $template->render($template_path);
});

$f3->route('GET /', function($f3) {
    $f3->set('www_root',$f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/index.html');
});

$f3->route('GET /documentation', function($f3) {
    $f3->set('www_root',$f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/documentation.html');
});

$f3->route('GET /admin', function($f3) {
    $f3->set('key',$f3->get('map_it_key'));
    $f3->set('user',$f3->get('ADMIN_USER'));
    $f3->set('password',$f3->get('ADMIN_PASSWORD'));
    $f3->set('www', $f3->get('MAP_IT_HOME'));
    $f3->set('db', $f3->get('DB'));
    $view=new View;
    echo $view->render('web/admin/data.html');
});

$f3->route('GET /admin/data', function($f3) {
    $f3->set('key',$f3->get('map_it_key'));
    $f3->set('user',$f3->get('ADMIN_USER'));
    $f3->set('password',$f3->get('ADMIN_PASSWORD'));
    $f3->set('www', $f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/admin/data.html');
});

$f3->route('GET /admin/app', function($f3) {
    $f3->set('key',$f3->get('map_it_key'));
    $f3->set('user',$f3->get('ADMIN_USER'));
    $f3->set('password',$f3->get('ADMIN_PASSWORD'));
    $f3->set('www',$f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/admin/app.html');
});

$f3->route('GET /admin/check', function($f3) {
    $f3->set('key',$f3->get('map_it_key'));
    $f3->set('user',$f3->get('ADMIN_USER'));
    $f3->set('password',$f3->get('ADMIN_PASSWORD'));
    $f3->set('www',$f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/admin/check.html');
});

$f3->route('GET /admin/maps', function($f3) {
    $f3->set('key',$f3->get('map_it_key'));
    $f3->set('user',$f3->get('ADMIN_USER'));
    $f3->set('password',$f3->get('ADMIN_PASSWORD'));
    $f3->set('www',$f3->get('MAP_IT_HOME'));
    $view=new View;
    echo $view->render('web/admin/maps.html');
});

$f3->run();

?>