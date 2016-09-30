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
    $app->register(new Silex\Provider\UrlGeneratorServiceProvider());
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

    $app->delete("/stores", function() use ($app) {
        Store::deleteAll();
        return $app->redirect('/');
    });

    $app->get("/store/{id}", function($id) use($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        $other_brands = $store->getOtherBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'other_brands' => $other_brands));
    })
    ->bind('store');

    $app->patch("/store/{id}", function($id) use($app) {
        $store = Store::find($id);
        $store->update($_POST['store_name']);
        return $app->redirect($app['url_generator']->generate('store', array('id' => $id)));
    });

    $app->delete("/store/{id}", function($id) use($app) {
        $store = Store::find($id);
        $store->delete();
        return $app->redirect('/');
    });

    $app->post("/store/{id}/add_brand", function($id) use($app) {
        $store = Store::find($id);
        $store->addBrand($_POST['brand_id']);
        return $app->redirect($app['url_generator']->generate('store', array('id' => $id)));
    });

    $app->get("/brand/{id}", function($id) use($app) {
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        $other_stores = $brand->getOtherStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'other_stores' => $other_stores));
    })
    ->bind('brand');

    $app->post("/brand/{id}/add_store", function($id) use($app) {
        $brand = Brand::find($id);
        $brand->addStore($_POST['store_id']);
        return $app->redirect($app['url_generator']->generate('brand', array('id' => $id)));
    });

    return $app;
?>
