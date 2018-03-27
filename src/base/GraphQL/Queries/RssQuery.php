<<<<<<< HEAD
<?php
namespace GBFIC\MediaProvider\base\GraphQL\Queries;

use App\Models\Rss;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class RssQuery extends Query
{
    protected $attributes = [
        'name' => 'Rss Query',
        'description' => 'A query of RSS feeds'
    ];
		
	public function type()
	{
		return Type::listOf(GraphQL::type('rss'));
	}
	
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'name' => ['name' => 'email', 'type' => Type::string()],
			'order' => ['name' => 'orderby', 'description'=> 'ASC or DESC. Default: ASC', 'type'=> Type::string()]
		];
	}
	
	 public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
        };
        $user = Rss::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $user;
    }
=======
<?php
namespace GBFIC\MediaProvider\base\GraphQL\Queries;

use App\Models\Rss;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class RssQuery extends Query
{
    protected $attributes = [
        'name' => 'Rss Query',
        'description' => 'A query of RSS feeds'
    ];
		
	public function type()
	{
		return Type::listOf(GraphQL::type('rss'));
	}
	
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'name' => ['name' => 'email', 'type' => Type::string()],
			'order' => ['name' => 'orderby', 'description'=> 'ASC or DESC. Default: ASC', 'type'=> Type::string()]
		];
	}
	
	 public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }
        };
        $user = Rss::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $user;
    }
>>>>>>> 63d04d1d99263bd772a6b6ab627cd24131213e37
}