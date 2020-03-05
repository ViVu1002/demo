<?php
namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function uploadImages($images = 'image')
    {
        $image = request()->file($images);
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('picture', $name);
        return sprintf('picture/%s', $name);
    }
}

?>
