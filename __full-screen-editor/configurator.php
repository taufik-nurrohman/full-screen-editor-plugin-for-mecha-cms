<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <?php $fse_skin = File::open(PLUGIN . DS . basename(__DIR__) . DS . 'shell' . DS . 'full-screen.css')->read(); ?>
  <p><?php echo Form::textarea('css', $fse_skin, null, array('class' => array('textarea-block', 'code', 'MTE'))); ?></p>
  <p><?php echo Jot::button('action', $speak->update); ?></p>
</form>