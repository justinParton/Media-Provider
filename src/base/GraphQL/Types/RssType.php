<?php
namespace GBFIC\MediaProvider\base\GraphQL\Types;

use App\Models\Rss;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RssType extends GraphQLType
{
    protected $attributes = [
        'name' => 'RSS',
        'description' => 'A type',
        'model' => Rss::class, // define model for users type
    ];
    
    // define field of type
    public function fields()
    {
        return [
        	
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'args' => [
                	'first' => 	['type' => Type::int()]
                ],
                'description' => 'The id of the video'
            ],
            
            'name' => [
                'type' => Type::string(),
                'description' => 'The id of the video'
            ],
            
            'videos' => [
                'type' => Type::listOf(GraphQL::type('videos')),
                'args' => [
                	'order' => 	['type' => Type::string()]
                ],
                'description' => 'The videos of the rss feed'
            ],

            'liveVideo' => [
                'type' => Type::listOf(GraphQL::type('live_videos')),
                'description' => 'The Live Videos of the rss feed'
            ]
            
        ];
    }
}