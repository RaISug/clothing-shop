<?php 

require_once 'com/main/request/Request.php';

require_once 'com/main/dto/Pagination.php';

require_once 'com/main/database/ConnectionFactory.php';

require_once 'com/main/database/repository/CategoryRepository.php';
require_once 'com/main/database/repository/ProductRepository.php';
require_once 'com/main/database/repository/UserRepository.php';

require_once 'com/main/controller/Controller.php';
require_once 'com/main/controller/SimpleController.php';

require_once 'com/main/controller/products/create/CreateProductController.php';
require_once 'com/main/controller/products/update/UpdateProductController.php';
require_once 'com/main/controller/products/delete/DeleteProductController.php';
require_once 'com/main/controller/products/list/ListProductsController.php';
require_once 'com/main/controller/products/list/ListProductsByCategoryController.php';
require_once 'com/main/controller/products/list/ListProductsByTypeAndCategoryController.php';
require_once 'com/main/controller/products/list/ListProductsByTypeController.php';
require_once 'com/main/controller/products/list/SingleProductRetrievalController.php';

require_once 'com/main/controller/cart/AddingProductIntoCartController.php';
require_once 'com/main/controller/cart/RemovingProductFromCartController.php';
require_once 'com/main/controller/cart/ShowAllProductsInCartController.php';

require_once 'com/main/controller/users/CreateUserController.php';
require_once 'com/main/controller/users/ValidateCredentialsController.php';

require_once 'com/main/controller/categories/ListCategoriesController.php';
require_once 'com/main/controller/categories/DeleteCategoryController.php';
require_once 'com/main/controller/categories/CreateCategoryController.php';

require_once 'com/main/entity/Category.php';
require_once 'com/main/entity/Product.php';
require_once 'com/main/entity/User.php';

require_once 'com/main/entity/factory/CategoryFactory.php';
require_once 'com/main/entity/factory/UserFactory.php';
require_once 'com/main/entity/factory/ProductFactory.php';

require_once 'com/main/response/Response.php';
require_once 'com/main/response/ResponseBuilder.php';

require_once 'com/main/filter/RequestFilter.php';
require_once 'com/main/filter/request/AuthenticationFilter.php';
require_once 'com/main/filter/ResponseFilter.php';

require_once 'com/main/filter/request/AuthenticatedCallsRedirectionFilter.php';

require_once 'com/main/filter/response/JsonConverterFilter.php';
require_once 'com/main/filter/response/CategoriesRetrievalFilter.php';

require_once 'com/main/session/SessionService.php';

require_once 'com/main/files/File.php';
require_once 'com/main/files/Files.php';

require_once 'com/main/cart/Cart.php';
require_once 'com/main/cart/CartItem.php';

require_once 'com/main/exceptions/ResponseException.php';
require_once 'com/main/exceptions/BadRequestException.php';
require_once 'com/main/exceptions/UnauthorizedException.php';
require_once 'com/main/exceptions/InternalServerErrorException.php';

require_once 'com/main/services/FileService.php';
require_once 'com/main/services/OrderingService.php';
require_once 'com/main/services/PaginationService.php';

use request\Request as Request;
use controller\ListProductsController;
use controller\SingleProductRetrievalController;
use controller\AddingProductIntoCartController;
use controller\RemovingProductFromCartController;
use controller\ShowAllProductsInCartController;
use exception\ResponseException;
use controller\CreateProductController;
use controller\SimpleController;
use controller\CreateUserController;
use controller\ValidateCredentialsController;
use filter\AuthenticationFilter;
use filter\JsonConverterFilter;
use filter\AuthenticatedCallsRedirectionFilter;
use controller\ListProductsByCategoryController;
use controller\ListProductsByTypeAndCategoryController;
use controller\ListProductsByTypeController;
use controller\UpdateProductController;
use controller\DeleteProductController;
use controller\DeleteCategoryController;
use controller\CreateCategoryController;
use controller\ListCategoriesController;
use filter\CategoriesRetrievalFilter;

$request = new Request();

$requestFilters = array(
    new AuthenticationFilter(),
    new AuthenticatedCallsRedirectionFilter()
);

$controllers = array(
    new SingleProductRetrievalController(), 
    new ListProductsController(),
    new ListProductsByCategoryController(),
    new ListProductsByTypeAndCategoryController(),
    new ListProductsByTypeController(),
    new AddingProductIntoCartController(),
    new RemovingProductFromCartController(),
    new ShowAllProductsInCartController(),
    new CreateProductController(),
    new UpdateProductController(),
    new DeleteProductController(),
    new CreateUserController(),
    new ValidateCredentialsController(),
    new ListCategoriesController(),
    new DeleteCategoryController(),
    new CreateCategoryController(),
    new SimpleController()
);

$responseFilters = array(
    new JsonConverterFilter(),
    new CategoriesRetrievalFilter()
);

try {
    foreach ($requestFilters as $filter) {
        if ($filter->canHandle($request)) {
            $filter->filter($request);
        }
    }

    foreach ($controllers as $controller) {
        if ($controller->canHandle($request)) {
            $response = $controller->handle($request);

            foreach ($responseFilters as $filter) {
                if ($filter->canHandle($request, $response)) {
                    $filter->filter($response);
                }
            }

            $controller->display($response);

            break;
        }
    }
} catch (ResponseException $exception) {
    http_response_code($exception->statusCode());

    echo $exception->errorMessage();
}

// $file = fopen("logs.log", "w");

// fwrite($file, "test");

// fclose($file);



?>