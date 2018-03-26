<?php
namespace GBFIC\MediaProvider\base\GraphQL\Types;

use App\Models\Video;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class VideoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Video',
        'description' => 'A type',
        //'model' => Video::class, // define model for users type
    ];
    
    // define field of type
    public function fields()
    {
        return [
            'id' => [
              'type' => Type::nonNull(Type::id()),
              'description' => 'The id of the user'
            ],
            'rss_id' => [
              'type' => Type::nonNull(Type::int()),
              'description' => 'The Feed ID of the comment'
            ],
            'title' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The title of the comment'
            ],
            'video_id' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The video_id of the comment'
            ],
            'description' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The description of the comment'
            ],
            'pubDate' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The pubDate of the comment'
            ],
            'url' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The url of the comment'
            ],
            'length' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The length of the comment'
            ],
            'type' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The type of the comment'
            ],
            'thumb_url' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The thumb_url of the comment'
            ],
            'keywords' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The keywords of the comment'
            ],
            'status_code' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'The status_code of the comment'
            ],
            'created_at' => [
              'type' => Type::nonNull(Type::string()),
              'description' => 'Created At Date'
            ]
            
        ];
    }
}