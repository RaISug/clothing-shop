<?php 

require_once 'com/main/request/Request.php';

require_once 'com/main/dto/Pagination.php';

require_once 'com/main/database/ConnectionFactory.php';

require_once 'com/main/database/repository/OrderRepository.php';
require_once 'com/main/database/repository/CategoryRepository.php';
require_once 'com/main/database/repository/ProductRepository.php';
require_once 'com/main/database/repository/UserRepository.php';
require_once 'com/main/database/repository/CarouselRepository.php';
require_once 'com/main/database/repository/CollectionRepository.php';

require_once 'com/main/controller/Controller.php';
require_once 'com/main/controller/SimpleController.php';

require_once 'com/main/controller/products/create/CreateProductController.php';
require_once 'com/main/controller/products/update/UpdateProductController.php';
require_once 'com/main/controller/products/delete/DeleteProductController.php';
require_once 'com/main/controller/products/list/ListProductsController.php';
require_once 'com/main/controller/products/list/ListProductsByCategoryController.php';
require_once 'com/main/controller/products/list/ListProductsByTypeAndCategoryController.php';
require_once 'com/main/controller/products/list/ListProductsByTypeController.php';
require_once 'com/main/controller/products/list/ListProductsInCollectionController.php';
require_once 'com/main/controller/products/list/SingleProductRetrievalController.php';

require_once 'com/main/controller/cart/AddingProductIntoCartController.php';
require_once 'com/main/controller/cart/DecreaseProductQuantityInCartController.php';
require_once 'com/main/controller/cart/ShowAllProductsInCartController.php';
require_once 'com/main/controller/cart/RemoveProductFromCartController.php';

require_once 'com/main/controller/users/CreateUserController.php';
require_once 'com/main/controller/users/ValidateCredentialsController.php';

require_once 'com/main/controller/categories/ListCategoriesController.php';
require_once 'com/main/controller/categories/DeleteCategoryController.php';
require_once 'com/main/controller/categories/CreateCategoryController.php';

require_once 'com/main/controller/carousel/CreateCarouselController.php';
require_once 'com/main/controller/carousel/DeleteCarouselController.php';
require_once 'com/main/controller/carousel/ListCarouselController.php';

require_once 'com/main/controller/orders/CreateOrderController.php';
require_once 'com/main/controller/orders/DeleteOrderController.php';
require_once 'com/main/controller/orders/ListAllOrdersController.php';
require_once 'com/main/controller/orders/ListOrdersBetweenDatetimeController.php';
require_once 'com/main/controller/orders/ListOrdersInGivenDateController.php';
require_once 'com/main/controller/orders/UpdateOrderStatusController.php';
require_once 'com/main/controller/orders/SingleOrderRetrievalController.php';

require_once 'com/main/controller/collections/AddProductsToCollectionController.php';
require_once 'com/main/controller/collections/CreateCollectionController.php';
require_once 'com/main/controller/collections/ListCollectionsController.php';
require_once 'com/main/controller/collections/DeleteCollectionController.php';

require_once 'com/main/entity/Order.php';
require_once 'com/main/entity/Category.php';
require_once 'com/main/entity/Product.php';
require_once 'com/main/entity/User.php';
require_once 'com/main/entity/Carousel.php';
require_once 'com/main/entity/Collection.php';
require_once 'com/main/entity/ProductInCart.php';

require_once 'com/main/entity/factory/OrderFactory.php';
require_once 'com/main/entity/factory/CategoryFactory.php';
require_once 'com/main/entity/factory/UserFactory.php';
require_once 'com/main/entity/factory/ProductFactory.php';
require_once 'com/main/entity/factory/CarouselFactory.php';
require_once 'com/main/entity/factory/CollectionFactory.php';

require_once 'com/main/response/Response.php';
require_once 'com/main/response/ResponseBuilder.php';

require_once 'com/main/filter/RequestFilter.php';
require_once 'com/main/filter/request/AuthenticationFilter.php';
require_once 'com/main/filter/ResponseFilter.php';

require_once 'com/main/filter/request/AuthenticatedCallsRedirectionFilter.php';

require_once 'com/main/filter/response/JsonConverterFilter.php';
require_once 'com/main/filter/response/CategoriesRetrievalFilter.php';
require_once 'com/main/filter/response/CollectionsRetrievalFilter.php';
require_once 'com/main/filter/response/DropdownsRetrievalFilter.php';
require_once 'com/main/filter/response/CarouselsRetrievalFilter.php';

require_once 'com/main/session/SessionService.php';

require_once 'com/main/constants/Constants.php';

require_once 'com/main/files/File.php';
require_once 'com/main/files/Files.php';

require_once 'com/main/cart/Cart.php';
require_once 'com/main/cart/CartItem.php';

require_once 'com/main/exceptions/ResponseException.php';
require_once 'com/main/exceptions/BadRequestException.php';
require_once 'com/main/exceptions/UnauthorizedException.php';
require_once 'com/main/exceptions/InternalServerErrorException.php';
require_once 'com/main/exceptions/NotFoundException.php';

require_once 'com/main/services/FileService.php';
require_once 'com/main/services/OrderingService.php';
require_once 'com/main/services/PaginationService.php';
require_once 'com/main/services/EmailService.php';
require_once 'com/main/services/RedirectionService.php';
require_once 'com/main/services/TableBuilder.php';

require_once 'com/external/libraries/mailer/src/Exception.php';
require_once 'com/external/libraries/mailer/src/PHPMailer.php';
require_once 'com/external/libraries/mailer/src/SMTP.php';
require_once 'com/external/libraries/mailer/src/POP3.php';

use request\Request as Request;
use controller\ListProductsController;
use controller\SingleProductRetrievalController;
use controller\AddingProductIntoCartController;
use controller\DecreaseProductQuantityInCartController;
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
use controller\CreateCarouselController;
use controller\DeleteCarouselController;
use controller\ListCarouselController;
use controller\CreateOrderController;
use controller\DeleteOrderController;
use controller\ListOrdersBetweenDatetimeController;
use controller\ListOrdersInGivenDateController;
use controller\ListAllOrdersController;
use controller\UpdateOrderStatusController;
use controller\SingleOrderRetrievalController;
use controller\AddProductsToCollectionController;
use controller\CreateCollectionController;
use controller\ListCollectionsController;
use filter\CollectionsRetrievalFilter;
use controller\DeleteCollectionController;
use filter\DropdownsRetrievalFilter;
use filter\CarouselsRetrievalFilter;
use controller\ListProductsInCollectionController;
use controller\RemoveProductFromCartController;

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
    new ListProductsInCollectionController(),
    new AddingProductIntoCartController(),
    new DecreaseProductQuantityInCartController(),
    new ShowAllProductsInCartController(),
    new RemoveProductFromCartController(),
    new CreateProductController(),
    new UpdateProductController(),
    new DeleteProductController(),
    new CreateUserController(),
    new ValidateCredentialsController(),
    new ListCategoriesController(),
    new DeleteCategoryController(),
    new CreateCategoryController(),
    new CreateCarouselController(),
    new DeleteCarouselController(),
    new ListCarouselController(),
    new CreateOrderController(),
    new DeleteOrderController(),
    new UpdateOrderStatusController(),
    new ListOrdersBetweenDatetimeController(),
    new ListOrdersInGivenDateController(),
    new ListAllOrdersController(),
    new SingleOrderRetrievalController(),
    new AddProductsToCollectionController(),
    new CreateCollectionController(),
    new ListCollectionsController(),
    new DeleteCollectionController(),
    new SimpleController()
);

$responseFilters = array(
    new JsonConverterFilter(),
    new CategoriesRetrievalFilter(),
    new CollectionsRetrievalFilter(),
    new DropdownsRetrievalFilter(),
    new CarouselsRetrievalFilter()
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