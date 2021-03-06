<?php

namespace App\Policies;

use App\Idea;
use App\User;
use App\Nation;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\PolicyTrait;

class IdeaPolicy
{
    use HandlesAuthorization, PolicyTrait;

    /**
     * Determine whether the user can view any ideas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return is_egora() || is_egora('community');
    }
    
    public function viewIdi(User $user)
    {
        return is_egora();
    }
    
    public function viewIpi(User $user)
    {
        return is_egora('community');
    }
    
    public function administrate(User $user)
    {
        return $this->deny();
    }

    /**
     * Determine whether the user can view the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function view(User $user, Idea $idea)
    {
        if (is_egora('community')) {
            return $user->communities->contains($idea->community);
        }  
        
        return $idea->egora_id == current_egora_id();
    }
    
    public function like(User $user, Idea $idea)
    {
        if (is_egora()) {        
            if ($user->user_type->class == 'user' && $idea->nation->title=='Egora') {
                return $this->deny();
            }

            $nations = Nation::whereIn('title', ['Egora', 'Universal', $user->nation->title])->get()->pluck('id');

            if (!$nations->contains($idea->nation->id)) {
                return $this->deny();
            }
        }
        
        if (is_egora('community')) {
            
        }        
        return $this->allow();
    }
    
    public function invite_examine(User $user, Idea $idea, $notification) 
    {
        return (!isset($notification));
        
        // only allow invite for ideas in IP
        // return $user->liked_ideas->contains($idea) && (!isset($notification));
    }
    
    public function invite_response(User $user, Idea $idea) 
    {
        return $user->user_received_notifications->pluck('pivot.idea_id')->contains($idea->id);
    }
    
    public function unlike(User $user, Idea $idea)
    {
        return $this->allow();
    }

    public function move(User $user, Idea $idea, User $model)
    {
        return $user->liked_ideas->contains($idea) && $model->id == $user->id;
    }
    
    /**
     * Determine whether the user can create ideas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->allow();
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function update(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function delete(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can restore the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function restore(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the idea.
     *
     * @param  \App\User  $user
     * @param  \App\Idea  $idea
     * @return mixed
     */
    public function forceDelete(User $user, Idea $idea)
    {
        //
    }
}
