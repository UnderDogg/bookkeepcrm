<?php

namespace Bookkeeper\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Kenarkose\Sortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{

    use Sortable, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Sortable columns
     *
     * @var array
     */
    protected $sortableColumns = ['first_name', 'email', 'created_at'];

    /**
     * Default sortable key
     *
     * @var string
     */
    protected $sortableKey = 'first_name';

    /**
     * Default sortable direction
     *
     * @var string
     */
    protected $sortableDirection = 'asc';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'first_name' => 10,
            'last_name' => 10,
            'email' => 10
        ]
    ];

    /**
     * Password setter
     *
     * @param string $password
     * @return $this for chaining
     */
    public function setPassword($password)
    {
        $this->attributes['password'] = bcrypt($password);

        return $this;
    }

    /**
     * Static constructor for User
     *
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $user = new static($attributes);

        $user->setPassword($attributes['password']);

        $user->save();

        return $user;
    }

    public function presentAvatar()
    {
        return str_limit($this->first_name, 1, '') .
        str_limit($this->last_name, 1, '') .
        '<img src="http://www.gravatar.com/avatar/' . md5($this->email) . '?d=blank">';
    }

    public function presentFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
