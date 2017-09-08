A very simple Budget Your Trip API PHP client library.

Example usage:

require_once("categories.php");
$categories = new Categories("MY-API-KEY-HERE");
$list = $categories->getCategories();

require_once("costs.php");
$costs = new Costs("MY-API-KEY-HERE");
$france_data = $costs->getCountry("FR");