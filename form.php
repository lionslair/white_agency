<?php if (!empty($_POST)): ?>
  <?php print output_error($error['form']); ?>
<?php endif; ?>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" name="comment-form">
<input type="hidden" name="<?php print $token_id; ?>" value="<?php print $token_value; ?>">

<div>
  <label for="name">Name</label>
  <?php print output_error($error['name']); ?>
  <input type="text" name="name" value="<?php print $params['name']; ?>" placeholder="Your Name"/>
</div>

<div>
  <label for="email">Email</label>
  <?php print $error['email']; ?>
    <?php print output_error($error['email']); ?>
  <input type="email" name="email" value="<?php print $params['email']; ?>" placeholder="you@exapmple.com"/>
</div>

<div>
  <label for="comment">Comment</label>
    <?php print output_error($error['comment']); ?>
  <textarea name="comment"><?php print $params['comment']; ?></textarea>
</div>

<div>
<input type="submit" value="submit">
</div>

</form>
