<div class="bars bars-with-sidebar-left cf">

  <div class="sidebar sidebar-left">

    <a class="sidebar-toggle" href="#sidebar" data-hide="<?php _l('options.hide') ?>"><span><?php _l('options.show') ?></span></a>

    <div class="sidebar-content section">

      <?php if($user and $writable): ?>
      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
        <span class="hgroup-title"><?php _l('users.form.options.headline') ?></span>
      </h2>

      <ul class="nav nav-list sidebar-list">

        <li>
          <?php if($user->isCurrent()): ?>
          <a href="<?php echo purl('logout') ?>">
            <?php i('power-off', 'left') . _l('logout') ?>
          </a>
          <?php elseif($user->email()): ?>
          <a href="mailto:<?php echo $user->email() ?>">
            <?php i('envelope-square', 'left') . _l('users.form.options.message') ?>
          </a>
          <?php endif ?>
        </li>

        <?php if($user->ui()->delete()): ?>
        <li>
          <a data-modal title="#" data-shortcut="#" href="<?php __($user->url('delete')) ?>"<?php if($user->isLastAdmin()): ?> class="btn-disabled"<?php endif ?>>
            <?php i('trash-o', 'left') . _l('users.form.options.delete') ?>
          </a>
        </li>
        <?php endif ?>

      </ul>

      <?php if($user->avatar()->ui()->active()): ?>

        <h2 class="hgroup hgroup-single-line<?php e(!$user->avatar()->exists(), ' hgroup-compressed') ?> cf">
          <span class="hgroup-title"><?php _l('users.form.avatar.headline') ?></span>
        </h2>

        <?php if($user->avatar()->exists()): ?>
        <div class="field">
          <?php if($user->avatar()->ui()->replace()): ?>
          <a data-upload class="avatar avatar-large" href="#upload">
            <img src="<?php echo $user->avatar(150)->url()  ?>">
          </a>
          <?php else: ?>
          <span class="avatar avatar-large">
            <img src="<?php echo $user->avatar(150)->url()  ?>">
          </span>
          <?php endif ?>
        </div>
        <?php endif ?>

        <ul class="nav nav-list sidebar-list">

          <?php if($user->avatar()->exists()): ?>

            <?php if($user->avatar()->ui()->replace()): ?>
              <li>
                <a data-upload href="#upload">
                  <?php i('pencil', 'left') . _l('users.form.avatar.replace') ?>
                </a>
              </li>
            <?php endif ?>

            <?php if($user->avatar()->ui()->delete()): ?>
              <li>
                <a data-modal href="<?php __($user->url('avatar/delete')) ?>">
                  <?php i('trash-o', 'left') . _l('users.form.avatar.delete') ?>
                </a>
              </li>
            <?php endif ?>

          <?php elseif($user->avatar()->ui()->upload()): ?>
            <li>
              <a data-upload href="#upload">
                <?php i('cloud-upload', 'left') . _l('users.form.avatar.upload') ?>
              </a>
            </li>
          <?php endif ?>

        </ul>

      <?php endif ?>

      <?php elseif($user and !$writable): ?>
      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
        <span class="hgroup-title"><?php _l('users.form.options.headline') ?></span>
      </h2>

      <a class="btn btn-with-icon" href="<?php _u('users') ?>">
        <?php i('arrow-circle-left', 'left') . _l('users.form.back') ?>
      </a>

      <?php else: ?>
      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
        <span class="hgroup-title"><?php _l('users.index.add') ?></span>
      </h2>

      <a class="btn btn-with-icon" href="<?php _u('users') ?>">
        <?php i('arrow-circle-left', 'left') . _l('users.form.back') ?>
      </a>
      <?php endif ?>

    </div>
  </div>

  <div class="mainbar">
    <div class="section">
      <?php if(!$writable): ?>
      <div class="form">
        <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
          <span class="hgroup-title"><?php _l('users.form.error.permissions.title') ?></span>
        </h2>
        <div class="text">
          <p><?php _l('users.form.error.permissions.text') ?></p>
        </div>
        <div><a href="<?php __(url::current()) ?>" class="btn btn-rounded"><?php _l('pages.show.error.permissions.retry') ?></a></div>
      </div>
      <?php else: ?>
      <?php echo $form ?>
      <?php endif ?>
    </div>
  </div>

</div>

<?php echo $uploader ?>