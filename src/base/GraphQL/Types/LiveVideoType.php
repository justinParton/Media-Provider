<<<<<<< HEAD
<?php
namespace GBFIC\MediaProvider\base\GraphQL\Types;

use App\Models\LiveVideo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LiveVideoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LiveVideo',
        'description' => 'A type',
        //'model' => LiveVideo::class, // define model for users type
    ];
    
    // define field of type
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the video'
            ],
        ];
    }
=======
<?php
namespace GBFIC\MediaProvider\base\GraphQL\Types;

use App\Models\LiveVideo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LiveVideoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LiveVideo',
        'description' => 'A type',
        //'model' => LiveVideo::class, // define model for users type
    ];
    
    // define field of type
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the video'
            ],
        ];
    }
>>>>>>> 63d04d1d99263bd772a6b6ab627cd24131213e37
}