<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <input name="token" type="hidden" value="<?php echo $token; ?>">
  <?php $fse_skin = File::open(PLUGIN . DS . basename(__DIR__) . DS . 'shell' . DS . 'full-screen.css')->read(); ?>
  <p><textarea name="css" class="textarea-block code"><?php echo Text::parse(Guardian::wayback('css', $fse_skin))->to_encoded_html; ?></textarea></p>
  <p><button class="btn btn-action" type="submit"><i class="fa fa-check-circle"></i> <?php echo $speak->update; ?></button></p>
</form>