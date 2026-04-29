public function posts()
{
    return $this->hasMany(Post::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function isAdmin()
{
    return $this->role === 'admin';
}

