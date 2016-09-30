<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig", array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/add_store", function() use ($app) {
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app->redirect('/');
    });

    $app->post("/add_brand", function() use ($app) {
        $new_brand = new Brand($_POST['brand_name']);
        $new_brand->save();
        return $app->redirect('/');
    });

    $app->delete("/brands", function() use ($app) {
        Brand::deleteAll();
        return $app->redirect('/');
    });

    return $app;
?>
