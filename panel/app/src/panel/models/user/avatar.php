<?php

namespace Kirby\Panel\Models\User;

use Dir;
use Exception;
use Error;
use F;
use Media;
use Thumb;

use Kirby\Panel\Event;
use Kirby\Panel\Upload;
use Kirby\Panel\Models\User;
use Kirby\Panel\Models\User\Avatar\UI as AvatarUI;

class Avatar extends \Avatar {

  public function __construct(User $user) {

    parent::__construct($user);

    if(!$this->exists()) {
      $this->root = $this->user->avatarRoot('{safeExtension}');
      $this->url  = purl('assets/images/avatar.png');
    }

  }

  public function form($action, $callback) {
    return panel()->form('avatars/' . $action, $this, $callback);
  }

  public function upload() {

    $root = $this->user->avatarRoot('{safeExtension}');
    if($this->exists()) {
      $event = $this->event('replace:action');
    } else {
      $event = $this->event('upload:action');
    }

    // create the avatar folder if it does not exist
    Dir::make(kirby()->roots()->avatars());

    $upload = new Upload($root, array(
      'accept' => function($upload) use($event) {
        if($upload->type() != 'image') {
          throw new Error(l('users.avatar.error.type'));
        }

        // check for permissions
        $event->target->upload = $upload;
        $event->check();

      }
    ));

    if(!$upload->file()) {
      throw $upload->error();
    }

    // delete old avatar in case the file extension changed
    // $this->root() still points to the root of the old avatar!
    if($upload->to() != $this->root()) f::remove($this->root());

    // flush the cache in case if the user data is
    // used somewhere on the site (i.e. for profiles)
    kirby()->cache()->flush();

    kirby()->trigger($event, $this);

  }

  public function delete() {

    if(!$this->exists()) {
      return true;
    }

    // create the delete event
    $event = $this->event('delete:action');

    // check for permissions
    $event->check();

    // delete the avatar file
    if(!parent::delete()) {
      throw new Exception(l('users.avatar.delete.error'));
    }

    // flush the cache in case if the user data is
    // used somewhere on the site (i.e. for profiles)
    kirby()->cache()->flush();

    kirby()->trigger($event, $this);

  }

  public function ui() {
    return new AvatarUI($this);
  }

  public function event($type, $args = []) {
    return new Event('panel.avatar.' . $type, array_merge([
      'user'   => $this->user,
      'avatar' => $this
    ], $args));
  }

}
