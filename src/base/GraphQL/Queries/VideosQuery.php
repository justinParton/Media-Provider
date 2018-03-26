<?php
namespace GBFIC\MediaProvider\base\GraphQL\Queries;

use App\Models\Video;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class VideosQuery extends Query
{
    protected $attributes = [
        'name' => 'Videos Query',
        'description' => 'A query for Videos'
    ];
		
	public function type()
	{
		return Type::listOf(GraphQL::type('videos'));
	}
	
	public function args()
	{
		return [
			'id' => ['name' => 'rssId', 'type' => Type::int()],
			'order' => ['name' => 'orderby', 'description'=> 'ASC or DESC', 'type'=> Type::string()]
		];
	}
	
	 public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['rssId'])) {
                $query->where('rss_id', $args['rssId'] );
            }
        };
        
       
        
        $user = Video::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate();
        return $user;
    }
}